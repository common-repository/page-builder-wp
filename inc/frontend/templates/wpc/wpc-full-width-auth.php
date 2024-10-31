<?php

/**
 * Template Name: WP Composer Full Width (Auth)
 *
 * This template displays the content full-width, with no sidebar.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_enqueue_style( 'wpc-templates', plugins_url( 'css/wp-composer-templates.css', __DIR__ ), [  ], PBWP_VERSION, 'all' );
get_header();?>

<div id="wpc_primary" class="wpc-site-content nosidebar">
    <div id="wpc_content">
        <?php
do_action( 'pbwp_tpl_full_width_auth_before_content' );

while ( have_posts() ): the_post();?>
        <!-- SEO needs -->
        <article id="post-<?php the_ID();?>"
            <?php post_class();?>>
            <div class="wpc-entry-content clearfixafter">
                <?php

    if ( is_user_logged_in() ) {
        the_content();
    } else {
        echo '<div class="secure_login_form">';
        wp_login_form();
        echo '<span class="secure_lost_password"><a href="'.esc_url( wp_lostpassword_url( get_permalink() ) ).'">'.esc_html__( 'Lost your password?', 'page-builder-wp' ).'</a></span>';
        echo '</div>';
    }

    ?>
            </div><!-- .wpc-entry-content -->
        </article><!-- #post-<?php the_ID();?> -->
        <?php endwhile; // end of the loop. ?>
        <?php do_action( 'pbwp_tpl_full_width_auth_after_content' );?>
    </div><!-- #wpc_content -->
</div><!-- #wpc_primary .wpc-site-content -->

<?php get_footer();?>