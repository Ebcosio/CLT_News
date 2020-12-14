<?php get_header(); ?>

<div class="wrapper section medium-padding" id="site-content">
										
	<div class="section-inner">
	
		<div class="content fleft">
												        
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php
					$format = get_post_format();
				    ?>
					
				
					<div class="post-header">

						<?php if ( get_the_title() ) : ?>
						
						    <h1 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

						<?php endif; ?>
					    
					</div><!-- .post-header -->
														                                    	    
					<div class="post-content">
						
						<?php 
                        if (class_exists('CLT_EVENTS_CPT')) :
                            echo do_shortcode( '[ces_events '
                                . 'start_date="' . CLT_EVENTS_CPT::startDateFromSlug() . '" '
                                . 'end_date="' . CLT_EVENTS_CPT::endDateFromSlug()
                                . '" ]' );
                        endif;
                        the_content();                                                                                      
						wp_link_pages();
						?>
						
						<div class="clear"></div>
									        
					</div><!-- .post-content -->
					            					
					<div class="post-meta-container">
						
						<div class="post-meta">
						
							<p class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></p>
							
							<div class="clear"></div>
							
							<div class="post-nav">
							
								<?php

								$prev_post = get_previous_post();
								$next_post = get_next_post();

								if ( $prev_post ) :
									?>
								
									<a class="post-nav-prev" href="<?php the_permalink( $prev_post->ID ); ?>"><?php _e( 'Previous month', 'baskerville' ); ?></a>
							
									<?php 
								endif; 

								if ( $next_post ) :
									?>
									
									<a class="post-nav-next" href="<?php the_permalink( $next_post->ID ); ?>"><?php _e( 'Next month', 'baskerville' ); ?></a>
							
									<?php 
								endif; 
								
								edit_post_link( __( 'Edit CLT event month', 'baskerville' ) ); 
								
								?>
									
								<div class="clear"></div>
							
							</div><!-- .post-nav -->
						
						</div><!-- .post-meta -->
						
						<div class="clear"></div>
							
					</div><!-- .post-meta-container -->
												                        
				<?php endwhile; endif; ?>
		
			</div><!-- .post -->
		
		</div><!-- .content -->
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div><!-- .section-inner -->

</div><!-- .wrapper -->
		
<?php get_footer(); ?>
