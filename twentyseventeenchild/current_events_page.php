<?php /* Template Name: Current_events_page */ ?>

<?php
/**
 * The template for displaying current events pages
 *
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area" style="width: 75%; float: left;">
		<main id="main" class="site-main" role="main">

<div class="announcements-wrapper">
	<?php 
	   $query2 = new WP_Query( array( 'category_name' => 'Announcements' ) );   
			
	
			
			while ( $query2->have_posts() ) {
   				 $query2->the_post();
				
				// add custom template part for Announcement posts, or custom post type with appropriate styling
				get_template_part( 'template-parts/post/content', get_post_format() );
  
			
		
		}
				
			?>
	<hr>
			</div>
			
			<div id="events-display">
				
	<h2>Events</h2>
			</div>
	<?php 
	// Get event data from CES and display it
	echo do_shortcode( '[ces_events]');

			while ( have_posts() ) :
				the_post();
                // add custom template part for these posts
				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End the loop.
			?>
</main><!-- #main -->
		</div><!-- #primary -->
			<?php //get_sidebar(); ?>
	<div style="width: 25%; float: right;">
	<aside  class="widget-area" role="complementary" style="padding-left: 50px;">
<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
			</div>
			
		
	
</div><!-- .wrap -->






<?php

get_footer();
