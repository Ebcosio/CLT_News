<?php


/**
 * @class OLC_WP_API singleton class.
 */
class OLC_WP_API {
    // Hold the class instance.
    private static $instance = null;
    private static $API_BASE = 'https://olc.clt.odu.edu/wp-json';
    
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
     * Gets events from the CES API
     * Implementation note: this method is not static, so you need to call
     * get_instance, then use the pointer you get to call this method.
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

        return $events;
    }
  }


?>
