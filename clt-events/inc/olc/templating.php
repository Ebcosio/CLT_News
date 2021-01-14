<?php

function olc_buddypress_activity($atts) {

    // Attributes
    $atts = shortcode_atts(
        array(),
        $atts,
        'olc_buddypress_activity'
    );

    $olc = OLC_WP_API::get_instance();
    $recent_activity = $olc->get_activity();
    
    if (!is_array($recent_activity)) {
        return '<div class="olc-activity"><i>Failed to load OLC activity feed.</i></div>';
    }
    ob_start();

        // var_dump($recent_activity);
    ?>
    <div class="olc-activity">
        <ul class="activity-list">
        <?php
            $num_activities = count($recent_activity);
            for ($i = 0; $i < $num_activities; $i++):
                $activity = $recent_activity[$i];
        ?>
            <li class="activity-item">
                <a href="<?php echo esc_url($activity['link']); ?>"
                  class="olc-profile-pic">
                    <img src="<?php echo esc_url($activity['user_avatar']['thumb']) ?>" alt="User's profile picture">
                </a>
                <p>
                    <?php echo $activity['title']; ?>
                </p>

                    <?php if ( clt_array_key_path_exists($activity, ['content', 'rendered']) &&
                        strlen($activity['content']['rendered']) > 0 ) : ?>
                        <p>
                            <?php echo clt_plain_text_excerpt($activity['content']['rendered']); ?>
                            <a href="<?php echo esc_url($activity['link']); ?>" rel="nofollow">Read more</a>
                        </p>
                    <?php endif; ?>   
            </li>
        <?php
        endfor; ?>
        </ul>
    </div>
    <?php
    $ob_str = ob_get_contents();
    ob_end_clean();
    return $ob_str;
}

add_shortcode( 'olc_buddypress_activity', 'olc_buddypress_activity' );
?>
