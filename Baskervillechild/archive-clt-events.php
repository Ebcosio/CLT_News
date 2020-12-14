<?php

/*
Template Name: Archive template
*/

get_header(); ?>

<div class="wrapper section medium-padding" id="site-content">

	<div class="section-inner">

		<div class="content fleft">
					
			<div class="post">
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
											
					<div class="post-header">
                        <a href="<?php the_permalink(); ?>"
                          aria-label="<?php echo get_the_title() . __(' events archive'); ?>">
					        <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
                        </a>
				    </div><!-- .post-header -->
					<div class="post-content">	                                        
						<?php 
						the_content();
						?>									            			                        
					</div><!-- .post-content -->
																
					<div class="clear"></div>
				
				<?php endwhile; endif; ?>
	
			</div><!-- .post -->
				
		</div><!-- .content -->
		
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>
	
	</div><!-- .section-inner -->
	
</div><!-- .wrapper section-inner -->
								
<?php get_footer(); ?>
