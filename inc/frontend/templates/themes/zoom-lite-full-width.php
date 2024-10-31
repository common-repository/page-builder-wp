<?php

/**
 * Template Name: WP Composer Full Width
 *
 * This template displays the content full-width, with no sidebar.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_enqueue_style( 'wpc-templates', plugins_url( 'css/wp-composer-templates.css', __DIR__ ), [  ], PBWP_VERSION, 'all' );

get_header();?>

<div id="primary" class="site-content nosidebar">
    <?php do_action( 'zoom_before_wpc_content' );?>
    <div id="content" role="main">
        <?php
while ( have_posts() ): the_post();?>
	        <!-- SEO needs -->
	        <article <?php esc_attr( zoom_is_struct_data( 'article-before' ) );?>id="post-<?php the_ID();?>"
	            <?php post_class();?>>
	            <?php do_action( 'zoom_struct_data_author' );?>
	            <?php
    if ( ! is_front_page() || 'page' != get_option( 'show_on_front' ) ) {
        ?>
	            <header class="entry-header"><?php
    do_action( 'zoom_before_single_post' );?>
	                <h1 <?php esc_attr( zoom_is_struct_data( 'headline' ) );?>title="<?php the_title_attribute();?>"
	                    class="entry-title"><?php the_title();?></h1>
	                <?php
    do_action( 'zoom_struct_data_image_object', 'before' );
        zoom_theme_thumbs( 'featured_image_on_single', false, esc_html( get_theme_mod( 'post_single_thumb_size' ) ) );
        do_action( 'zoom_struct_data_image_object', 'after' );
        ?>
	            </header><!-- .entry-header -->
	            <?php }
    ?>
	            <div class="entry-content clearfixafter">
	                <?php the_content();?>
	            </div><!-- .entry-content -->
	        </article><!-- #post-<?php the_ID();?> -->
	        <?php endwhile; // end of the loop. ?>
    </div><!-- #content -->
    <?php do_action( 'zoom_after_wpc_content' );?>
</div><!-- #primary .site-content -->

<?php get_footer();?>