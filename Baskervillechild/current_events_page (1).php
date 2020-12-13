
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

<div class="announcements-wrapper" role="region" aria-label="section for CLT Announcements ">
	<h2>
		Announcements from CLT
	</h2>
	<?php 
	   $query2 = new WP_Query( array( 'category_name' => 'Announcements' ) );   
			
	
			
			while ( $query2->have_posts() ) {
   				 $query2->the_post();
				
			?>	 <h3><?php echo get_the_title(); ?></h3>
 
        <?php the_content(); 
			
		
		}
				
			?>
	<hr>
			</div>
			
		
	           <h2>Events and Workshops</h2>
				<?php echo do_shortcode( '[ces_events]'); ?>
			                   

			<?php
			while ( have_posts() ) :
				the_post();
                              // eventually delete some regular autopopulated page content, e.g. Search, Archives
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
	
	<aside  class="widget-area clt-sidebar" role="complementary" aria-label="CLT News sidebar">
<?php dynamic_sidebar( 'sidebar-1' ); ?>
		
</aside>
		
</div><!-- .wrap -->


<?php

get_footer();

