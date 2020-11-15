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
	$args = array(
	// add timeout arg
	'timeout' => 120,
	);		
			
			
	$response = wp_remote_get( 'https://clt.odu.edu/events/events/json', $args );
  //$status = wp_remote_retrieve_header( $response, 'status');
  
			
		   if(is_wp_error($response)){
			//	$obj->error = true;
             //   $obj->message = 'Data currently unavailable';
			 //  $events = json_encode($obj);
			
			// add error handler and timeout handler
		   }
			else {
			$events = wp_remote_retrieve_body( $response ); 
		   	   }
	
			?>
                    
				
			
<script>
	 // function call from script sheet parse_events.js
	 var eventsJson = <?php echo $events ?>;
	 parseEvents(eventsJson);
	
	
	</script> 

		

			<?php
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
