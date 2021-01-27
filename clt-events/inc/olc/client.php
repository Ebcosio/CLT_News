<?php


/**
 * @class OLC_WP_API singleton class.
 */
class OLC_WP_API {
    // Hold the class instance.
    private static $instance = null;
    private static $API_BASE = 'https://olc.clt.odu.edu/wp-json';
    private $users_arr = []; // Keyed by BP id
    private $activities = []; // Thread-level cache data structure for activities endpoint calls

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        
    }
   
    /**
     * Gives you access to non-static methods and use of the request level
     * cache, when implemented.
     * @return &OLC_WP_API, singleton instance
     */
    public static function get_instance()
    {
        // The object is created from within the class itself
        // only if the class has no instance.
        if (self::$instance == null)
        {
            self::$instance = new OLC_WP_API();
        }

        return self::$instance;
    }

    /**
     * Gets events from the CES API.
     * 
     * Usage note: this method is not static, so you need to call
     * get_instance, then use the pointer you get to call this method.
     * 
     * NOTE: Without authentication, trying to `include` user profiles in
     * the response results in a 401. There is a workaround, see this->get_user
     * 
     * @param array $args Options -
     * type - array - LIMIT resutls to these types of activities (e.g. 'avatar_change')
     * @uses json_decode()
     * @return array Associative array of activity arrays, as provided by json_decode()
     */
    public function get_activity($args = []) {        
        $defaults = [
            'per_page' => 10
            // one or more of one of new_member, new_avatar, updated_profile, activity_update, activity_comment, friendship_accepted, friendship_created, created_group, joined_group, group_details_updated, new_blog_post, new_blog_comment.
        ];
        // Merge validated passed args with defaults.
        $args = array_merge($defaults, $args);

        // Check $this->activities array for a cached copy of the activity
        // feed we requested, given the parameters supplied
        $instance_cache_key = OLC_WP_API::build_activity_cache_key($args);
        if ( array_key_exists($instance_cache_key, $this->activities) ) {
            return $this->activities[ $instance_cache_key ];
        }
    
        // Prepare request
        $url = self::$API_BASE . '/buddypress/v1/activity?per_page=' . $args['per_page'];    

        // DEBUG, to stop the request before it takes off
        // return json_decode( "[]", true );

        // @TODO: check cache before request
        $response = wp_remote_get($url);

        // Handle errors with network
        if (is_wp_error($response) ||
        (clt_array_key_path_exists($response, ['response', 'code']) && $response['response']['code']  >= 300  )
        ) {
            return -1;
        }

        // Parse events and simultaneously handle errors in body
        $events = json_decode( wp_remote_retrieve_body( $response ), true );

        // json_decode returns null if it can't parse the JSON, also returns other types that we don't want
        if (!is_array($events)) {
            return -1;
        }

        // Store in the (singleton) class instance's thread-level memory cache for future requests
        $this->activities[ $instance_cache_key ] = $events;

        // var_dump($this->activities); // DEBUG

        return $events;
    }

    /**
     * Returns a key for $this->activities which will be unique for all possible values provided to
     * the documented key-value pairs of the $args array passed to $this->get_activity()
     * @param array $args - the $args object, with defaults merged in, from $this->get_activity()
     * @return string cache array key
     */
    private static function build_activity_cache_key($args): string {
        // 'per_page' is the only argument at this time; others will be added later
        return 'per_page=' . $args['per_page'];
    }

    public function get_user(int $id, $args = []) {
        
        $defaults = [];
        // Merge validated passed args with defaults.
        $args = array_merge($defaults, $args);
    
        // Check data-strucutre cache, return if found.
        // NOTE: this is simple. It might become necessary later to check if
        // the supplied $args would invalidate the cache. Obviously, it doesn't
        // make that check right now.
        $instance_cache_key = $id; // In the interest of readability, even if another var is allocated
        if ( array_key_exists($instance_cache_key, $this->users_arr) ) {
            return $this->users_arr[ $instance_cache_key ];
        }

        // @TODO: check a WordPress transient cache
    
        // Prepare HTTP request
        // This 401s:
        // https://olc.clt.odu.edu/wp-json/buddypress/v1/members/11
        // but this does not:
        // https://olc.clt.odu.edu/wp-json/buddypress/v1/members/?per_page=1&include=11
        // Note: when querying the API for individual's user profiles, we have to do it
        // one at a time because we can't pass an array of user ids to `include`)
        // Because it is the collection route (base for the resource), it will return the
        // results as a JSON array.
        $url = self::$API_BASE . '/buddypress/v1/members/?per_page=1&include=' . $id;    
        
        // DEBUG, to stop the request before it takes off
        // return json_decode( "[]", true );

        // Perform remote request
        $response = wp_remote_get($url);

        // Handle errors with network
        if (is_wp_error($response) ||
        (clt_array_key_path_exists($response, ['response', 'code']) && $response['response']['code']  >= 300  )
        ) {
            return -1;
        }

        // Parse user's array and simultaneously handle errors in body
        $user_arr = json_decode( wp_remote_retrieve_body( $response ), true );
        // json_decode returns null if it can't parse the JSON, also returns other types that we don't want
        // Also ensures we have a user in the aray and the id property we need for cache
        if (!is_array($user_arr) || !is_array($user_arr[0]) || !$user_arr[0]['id']) {
            return -1;
        }
        // Pick lone user from the returned array (see comments at $url variable)
        $user = $user_arr[0];

        // Cache response object for future calls in this thread.

        // Sanity check on $instance_cache_key; even though it's already assigned from $id param,
        // we don't assume that the API responded with the ID we asked for.
        $instance_cache_key = $user['id'];
        // Store the response in our data structure
        $this->users_arr[$instance_cache_key] = $user;

        // @TODO: insert to WP transient cache (could totally be async if that's an option)

        return $user;
    }
  }


?>
