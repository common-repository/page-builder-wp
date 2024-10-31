<?php
/**
 * Template Name: WP Composer - Full Width
 *
 * This template displays the content full-width, with no sidebar.
 *
 * @package WP Composer
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
do_action( 'pbwp_before_content_wrapper' );
?>
    <div class="wpc_full_width">
    	<div class="wpc_fw"></div>
            <?php while ( have_posts() ): the_post();
    the_content();
endwhile;?>
    </div><!-- #wpc-fullwidth -->
<?php
do_action( 'pbwp_after_content_wrapper' );
get_footer();?>