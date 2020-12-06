<?php
/**
 * The template for displaying a month's worth of CLT events
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            // Start the Loop.
            while ( have_posts() ) :
                the_post();

                if (class_exists('CLT_EVENTS_CPT')) :
                    echo do_shortcode( '[ces_events '
                        . 'start_date="' . CLT_EVENTS_CPT::startDateFromSlug() . '" '
                        . 'end_date="' . CLT_EVENTS_CPT::endDateFromSlug()
                        . '" ]' );
                endif;

                the_content();

                the_post_navigation(
                    array(
                        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
                    )
                );

            endwhile; // End the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
   <aside  class="widget-area clt-sidebar" role="complementary" aria-label="CLT News sidebar">
<?php dynamic_sidebar( 'sidebar-1' ); ?>
		
</aside>
	
</div><!-- .wrap -->

<?php
get_footer();
