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
?>

<!-- Accordion Configuration Options

data-allow-toggle
Allow for each toggle to both open and close its section. Makes it possible for all sections to be closed. Assumes only one section may be open.

data-allow-multiple
Allow for multiple accordion sections to be expanded at the same time. Assumes data-allow-toggle otherwise the toggle on open sections would be disabled.

Ex:
<div id="accordionGroup" class="Accordion" data-allow-multiple>
<div id="accordionGroup" class="Accordion" data-allow-toggle>
-->
<div id="accordionGroup" class="Accordion" data-allow-toggle><ul>
    <?php foreach ($events as $event): ?>
   <li> <h3 id="title-heading"><?php echo esc_html($event['title']); ?></h3>
    <p class="ces-event-info">
        <span class="ces-event-delivery-types" aria-label="format of delivery for this event">
            <?php echo CES_API::format_delivery_methods($event['delivery_styles']); ?>
        </span>
        <span class="ces-event-dates" aria-label="dates for this event"><?php echo $event['event_dates']; ?></span>
    </p>
    <button aria-expanded="false"
            class="Accordion-trigger"
            aria-controls="event-desc-<?php echo esc_attr($event['id']); ?>"
            id="event-desc-trigger-<?php echo esc_attr($event['id']); ?>">
    <?php _e('Description and objectives', CLT_EVENTS_TRANS); ?>
    </button>
    <div id="event-desc-<?php echo esc_attr($event['id']); ?>"
        role="region"
        aria-labelledby="event-desc-trigger-<?php echo esc_attr($event['id']); ?>"
        class="Accordion-panel"
        hidden
        >
        <div>
            <!-- Variable content within section, may include any type of markup or interactive widgets. -->
            <?php echo wp_kses_post($event['description']); ?>
        </div>
    </div>
    <a class="ces-event-register-link register-link" target="_blank"
            href="<?php echo CES_API::link_to_ces_event($event['id']) ?>"
            aria-labelledby="register for title-heading" 
            >
            <?php _e('Register for this event', CLT_EVENTS_TRANS); ?>
	   </a> </li>
    <?php endforeach; ?>
	</ul></div>

<?php
    $ob_str = ob_get_contents();
    ob_end_clean();
    return $ob_str;
}

add_shortcode( 'ces_events', 'ces_events_shortcode' );


/**********************************************
 * template function definitions
 */
