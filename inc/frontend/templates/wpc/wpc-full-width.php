<?php

/**
 * Template Name: WP Composer Full Width
 *
 * This template displays the content full-width, with no sidebar.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_enqueue_style( 'wpc-templates', plugins_url( 'templates/css/wp-composer-templates.css', __DIR__ ), [  ], PBWP_VERSION, 'all' );
get_header();?>

<div id="wpc_primary" class="wpc-site-content nosidebar">
    <div id="wpc_content">
        <?php
while ( have_posts() ): the_post();?>
        <!-- SEO needs -->
        <article id="post-<?php the_ID();?>"
            <?php post_class();?>>
            <div class="wpc-entry-content clearfixafter">
                <?php the_content();?>
            </div><!-- .wpc-entry-content -->
        </article><!-- #post-<?php the_ID();?> -->
        <?php endwhile; // end of the loop. ?>
    </div><!-- #wpc_content -->
</div><!-- #wpc_primary .wpc-site-content -->

<?php get_footer();?>