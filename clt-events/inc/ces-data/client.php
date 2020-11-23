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
            'limit'      => 5,  // what does the limit argument do?  EC 
        ];
        // Validate arguments, fall back to default as needed
        $args['start_date'] = CES_API::merge_valid_date_param($defaults['start_date'], $args['start_date']);
        $args['end_date']   = CES_API::merge_valid_date_param($defaults['end_date'], $args['end_date']);
        if (!is_numeric($args['limit'])) {
            $args['limit'] = $defaults['limit'];
        }
        // Merge validated passed args with defaults.
        $args = array_merge($defaults, $args);
    
        // Prepare request
        $url = self::$API_BASE . '/events/json';

        if ( isset($args['start_date']) ) {
            $url = $url . '?start_date=' . $args['start_date'];
            // The CES API does nothing with an end_date without a start_date, so nest our ifs
            if (isset($args['end_date'])) {
                $url = $url . '&end_date=' . $args['start_date'];
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

        // Handle limit on # of returned events
        // Move limit/pagination handling to API request parameters if they become available
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
        return 'https://clt.odu.edu/events/' . $id;
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
            } catch (Exception $e) {
                $date = $default;
            }
        }
        return $date;
    }

  }


?>
