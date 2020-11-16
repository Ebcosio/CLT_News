<?php 
/**
 * 1. shortcode function definitions
 * 2. template function definitions
 */


defined('ABSPATH') || die;

/**********************************************
 * shortcode function definitions
 */

// Add Shortcode
function ces_events_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'start_date' => null,
            'end_date'   => null,
            'limit'      => 5,
		),
		$atts,
		'ces_events'
    );

    $CES = CES_API::get_instance();
    $events = $CES->get_events([
        'start_date' => $atts['start_date'],
        'end_date'   => $atts['end_date'],
        'limit'      => $atts['limit'],
    ]);

    if ($events == -1) {
        return '<div class="ces-shortcode"><p class="error">' . __('Error encountered when displaying events', CLT_EVENTS_TRANS) . '</p></div>';
    }

    // var_dump($events);
    ob_start();

    echo '<div class="ces-shortcode"><ul class="ces-event-list">';
     foreach ($events as $event) { ?>
        <?php if ( !$event["is_cancelled"]) : ?>
         <li class="ces-event">
             <h3><?php echo esc_html($event['title']); ?></h3>
             <span class="ces-event-delivery-types">
                 <?php echo CES_API::format_delivery_methods($event['delivery_styles']); ?>
            </span>
             <span class="ces-event-dates"><?php echo $event['event_dates']; ?></span>
             <a class="ces-event-register-link register-link" target="_blank"
                href="<?php echo CES_API::link_to_ces_event($event['id']) ?>">
                <?php _e('Register for this event', CLT_EVENTS_TRANS); ?>
             </a>
             <button class="accordion">
                 <?php _e('Description and objectives', CLT_EVENTS_TRANS); ?>
            </button>
             <div class="panel-hidden">
                <?php echo wp_kses_post($event['description']); ?>            
             </div>
        </li>
        <?php endif; ?>
     <?php }
     echo '</ul></div>';
    
    $ob_str = ob_get_contents();
    ob_end_clean();
    return $ob_str;

}

add_shortcode( 'ces_events', 'ces_events_shortcode' );


/**********************************************
 * template function definitions
 */
