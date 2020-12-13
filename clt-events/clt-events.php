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
require_once CLT_EVENTS_DIR . '/inc/ces-data/event-cpt.php';

// Flush permalinks on activation so our clt-events archive works
// more: https://developer.wordpress.org/reference/functions/register_post_type/#flushing-rewrite-on-activation
register_activation_hook( __FILE__, 'clt_rewrite_flush' );
function clt_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    CLT_Events_CPT::register();
 
    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('ces_events_accordion', plugins_url( '/assets/js/accordion.js' , __FILE__ ), [], null, TRUE );
});


function enqueue_accordion_style() {
   wp_enqueue_style( 'ces_events_accordion_style', plugins_url( '/assets/css/accordion.css' , __FILE__ ), [], null );
}

add_action( 'wp_enqueue_scripts', 'enqueue_accordion_style' );

// note, calling the TNP_Composer method from this file, the index; seems to not work when called from /newsletter directory
function create_newsletter_blocks() {   
if (class_exists('TNP_Composer') ) {
        // Add our blocks, one-by-one
        
       // TNP_Composer::register_block(CLT_EVENTS_DIR . '/inc/newsletter/blocks/events-fetch');
        TNP_Composer::register_block(CLT_EVENTS_DIR . '/inc/newsletter/blocks/register');
       TNP_Composer::register_block(CLT_EVENTS_DIR . '/inc/newsletter/blocks/salutation-text');
       TNP_Composer::register_block(CLT_EVENTS_DIR . '/inc/newsletter/blocks/signature-panel');
       
    
        }
}
add_action('newsletter_register_blocks', 'create_newsletter_blocks');



?>
