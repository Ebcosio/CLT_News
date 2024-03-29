<?php


/**
 * @class CES_API singleton class.
 * It is possible events will get fetch from multiple parts of a rendered page,
 * say a sidebar as well as main content. Doing a singleton class like this
 * allows us to cache CES events in memory for this request, to avoid
 * multiple network calls whenvever possible. That caching is not implemented right now.
 * https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
 */
class CES_API {
    // Hold the class instance.
    private static $instance = null;
    private static $API_BASE = 'https://clt.odu.edu/events';
    
    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        // For development environment
        if (defined('CLT_EVENTS_DEV')) {
            self::$API_BASE = 'http://ces-stub:8080';
        }

        // @TODO: instantiate a data structure to cache event data after http requests
        // this is very good for the requests for a date range on the archival pages, but will we need a cache for the Curren Events query? 
    }
   
    /**
     * Gives you access to non-static methods and use of the request level
     * cache, when implemented.
     * @return &CES_API, singleton instance
     */
    public static function get_instance()
    {
        // The object is created from within the class itself
        // only if the class has no instance.
        if (self::$instance == null)
        {
            self::$instance = new CES_API();
        }

        return self::$instance;
    }

    /**
     * Gets events from the CES API
     * Implementation note: this method is not static, so you need to call
     * get_instance, then use the pointer you get to call this method.
     * @param array $args Options
     * @uses json_decode()
     * @return array Associative array of event arrays, as provided by json_decode()
     */
    public function get_events($args) {        
        $defaults = [
            'start_date' => (new DateTime())->format('Y-m-d'),
            'end_date'   => null,
        // Limits number of events returned by this method.
        // a negative value means "unlimited"
        //
        // Implementation note: The limit parameter is not part of the API request.
        // We just return a subarray of the response with the appropriate
        // number of events in it. 
        // Should CES implement a limit parameter,
        // this code's behavior should be refactored to save bandwidth.
            'limit'      => -1,
            'exclude'    => []
        ];
        // Validate arguments, fall back to default as needed
        $args['start_date'] = CES_API::merge_valid_date_param($defaults['start_date'], $args['start_date']);
        $args['end_date']   = CES_API::merge_valid_date_param($defaults['end_date'], $args['end_date']);
        if (!array_key_exists('limit', $args) || !is_numeric($args['limit'])) {
            $args['limit'] = $defaults['limit'];
        }

        // Merge in exclude array if valid
        if (!array_key_exists('exclude', $args) || !is_array($args['exclude']) ) {
            $args['exclude'] = [];
        }
        $args['exclude'] = array_merge($defaults['exclude'], $args['exclude'] );

        // Merge validated passed args with defaults.
        $args = array_merge($defaults, $args);
    
        // Prepare request
        $url = self::$API_BASE . '/events/json';

        if ( isset($args['start_date']) ) {
            $url = $url . '?start_date=' . $args['start_date'];
            // The CES API does nothing with an end_date without a start_date, so nest our ifs
            if (isset($args['end_date'])) {
                $url = $url . '&end_date=' . $args['end_date'];
            }
        }

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

        // Remove any excluded events from the array
        CES_API::remove_excluded($events, $args['exclude']);

        // Handle limit on # of returned events
        // Move limit/pagination handling to API request parameters if they become available
        // See comment at default limit option at beginning of method definition.
        $lim = $args['limit'];
        if ( isset($args['limit']) && 0 < $lim && $lim < count($events) ) {
            array_splice($events, $lim); // NOTE: if doing a request-level cache, return a deep copy instead instead of doing this
        }

        return $events;
    }

    /**
     * Build a link to the CES page for a given event
     * @param numeric The event ID
     * @return string The link to CES's page for the given event
     */
    public static function link_to_ces_event($id) {
        return esc_url('https://clt.odu.edu/events/' . $id);
    }
    
    /**
     * Makes a safe string representation of the delivery_methods field
     * @param array The array referenced by an event's delivery_styles key,
     * as decoded by @method get_events
     * @return string A sanitized, comma-separated list of delivery methods
     */
    public static function format_delivery_methods($deliveryArr) {
        if (!isset($deliveryArr) || !is_array($deliveryArr)) {
            return '';
        }
        $out = esc_html($deliveryArr[0]['title']);
        for ($i = 1; $i < count($deliveryArr); $i++) {
            $out .= ', ' . esc_html($deliveryArr[$i]['title']);
        }
        return  $out;
    }

    /**
     * For templating, determine if the user should be given the option to register for
     * a given event
     * @param array - an Event record, as returned by CES_API::get_events()
     * @return Boolean - whether the user can register for an event
     */
    public static function should_offer_registration($event) {
        try {
            return !($event['is_reg_closed'] ||  $event['is_event_over'] || $event['is_cancelled']);
        } catch(Exception $e) {
            return false;
        }
    }
    
    
    /**
     * To validate a date string and use a provided fallback if validation fails.
     * @param string|null $default The value to use if validation of $provided fails.
     * @param string|null $provided The value to validate and return if correct
     * @param string|null A date, as string, with format 'T-m-d'.
     */
    private static function merge_valid_date_param($default, $provided) {
        if (!isset($provided)) { // Sending null to DateTime constructor will not throw, so do a check
            $date = $default;
        } else {
            try {
                $date = new DateTime($provided);
                $date = $date->format('Y-m-d');
            } catch (Error $e) {
                $date = $default;
            }
        }
        return $date;
    }

    /**
     * Removes events from $events_arr if their id properties are in the $exclude_arr
     * @Pre: $event_arr produced as from CES_API::get_events method.
     * @param array& $event_arr by reference for modification
     * @param array& $exclude_arr list of event ids that need to be excluded,
     *                pass-by-reference is for speed only- it's not modified
     * @return void - modifies $event_arr as needed
     */
    private static function remove_excluded(&$event_arr, &$exclude_arr) {
        $i=0;
        while ($i < count($event_arr)) {
            foreach($exclude_arr as $exc_id) {
                if ( $event_arr[$i]['id'] == $exc_id) {
                    array_splice($event_arr, $i, 1); // Remove this event from the array
                    $i--; // To keep $i at current position for next iteration
                }
            }
            $i++;
        }
    }

  }


?>
