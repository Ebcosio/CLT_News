<?php
/**
 * The template for displaying archive for CLT events
 *
 */

get_header(); ?>

<div class="wrap">

  <?php if ( have_posts() ) : ?>
    <header class="page-header">
      <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    </header><!-- .page-header -->
  <?php endif; ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php
    // The actual "archive" part - list clt-events CPTs, which represent monthly archives
    // of events from CLT. Each CPT archive is populated with data from CES.
    if ( have_posts() ) : ?>
      <?php
      // Start the Loop.
      while ( have_posts() ) :
        the_post(); ?>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php   
      endwhile;

      the_posts_pagination(
        array(
          'prev_text'          => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
          'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
        )
      );

    else :

      get_template_part( 'template-parts/post/content', 'none' );

    endif;
    ?>

    </main><!-- #main -->
  </div><!-- #primary -->
  <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php
get_footer();
