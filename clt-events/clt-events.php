<?php

/**
 * Plugin Name: CLT Events Functionality
 * Plugin URI: https://github.com/Ebcosio/CLT_News
 * Description: Facilitates fetching events from CES and augmenting newsletter emails
 * Version: 1.0.0
 * Author: Ebcosio and john-hix
 *
 * @package odu-clt-wp-events
*/

defined('ABSPATH') || die;

define('CLT_EVENTS_VER', '1.0.0');
define('CLT_EVENTS_DIR', plugin_dir_path( __FILE__ ) );
define('CLT_EVENTS_TRANS', 'clt-events-plugin');

// define('CLT_EVENTS_DEV', true); // Signals development environment; CES http calls will go to a stub

// For displaying CES events on this WP site
require_once CLT_EVENTS_DIR . '/inc/utils/index.php';
require_once CLT_EVENTS_DIR . '/inc/ces-data/client.php'; // Exposes CES_API globally.
require_once CLT_EVENTS_DIR . '/inc/ces-data/templating.php';



add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('ces_events_accordion', plugins_url( '/assets/js/accordion.js' , __FILE__ ), [], null, TRUE );
});


function enqueue_accordion_style() {
   wp_enqueue_style( 'ces_events_accordion_style', plugins_url( '/assets/css/accordion.css' , __FILE__ ), [], null );
}

add_action( 'wp_enqueue_scripts', 'enqueue_accordion_style' );



?>
