<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_getting_started_page()
{

    ob_start();
    ?>
<div class="wpc_feature_section wpc_getting_started">
    <p><?php esc_html_e( 'There are no complicated instruction to start using WP Composer. You can choose one of our three link provided with just one click and you will redirected to the editor instantly.', 'page-builder-wp' );?>
    </p>
    <div class="wpc_how_to_start_screenshot">
        <div class="wpc_the_col"><img class="img_preview"
                src="<?php echo esc_url( pbwp_distribution_url( 'images/preview/edit_link/edit_link_one.png' ) ); ?>"
                width="502" height="284" alt="WP Composer Edit Link" />
            <div class="link_img_desc">
                <p><?php esc_html_e( 'Go to Page/Post list and move your cursor to post title, you will see the Edit link there', 'page-builder-wp' );?>
                </p>
            </div>
        </div>
        <div class="wpc_the_col"><img class="img_preview"
                src="<?php echo esc_url( pbwp_distribution_url( 'images/preview/edit_link/edit_link_two.png' ) ); ?>"
                width="502" height="284" alt="WP Composer Edit Button" />
            <div class="link_img_desc">
                <p><?php esc_html_e( 'Edit your current post/create new first, find in right side of post editor', 'page-builder-wp' );?>
                </p>
            </div>
        </div>
        <div class="wpc_the_col"><img class="img_preview"
                src="<?php echo esc_url( pbwp_distribution_url( 'images/preview/edit_link/edit_link_three.png' ) ); ?>"
                width="502" height="284" alt="WP Composer Edit Button" />
            <div class="link_img_desc">
                <p><?php esc_html_e( 'See your site in live mode, and find the Editor link in the Admin Toolbar', 'page-builder-wp' );?>
                </p>
            </div>
        </div>
        <div class="wpc_clear_both"></div>
    </div>
</div>
<?php
$getting_started = ob_get_clean();

    echo wp_kses_post( $getting_started );

}

function pbwp_support_page()
{

    ob_start();

    wp_enqueue_style( 'youtubegallerywall', pbwp_frontend_asset_url( 'css/vendors/ytg/youtubegallerywall.min.css' ), [  ], PBWP_VERSION );
    wp_enqueue_script( 'youtubegallerywall', pbwp_frontend_asset_url( 'js/vendors/ytg/youtubegallerywall.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

    ?>
<div class="support_page_main"><?php
if ( has_filter( 'pbwp_notice_message' ) ) {?>
    <input class="tabs-sel" id="tab3" type="radio" name="tabs" checked>
    <label data-render-target="actions" class="tabs_menu wpc_rec_act"
        for="tab3"><?php esc_html_e( 'Need Your Action', 'page-builder-wp' );?></label>
    <?php }?>
    <input class="tabs-sel" id="tab1" type="radio" name="tabs"
        <?php if ( ! has_filter( 'pbwp_notice_message' ) ) {echo 'checked';}?>>
    <label data-render-target="video_tuts" class="tabs_menu"
        for="tab1"><?php esc_html_e( 'Video Tutorial', 'page-builder-wp' );?></label>
    <section id="content1">
        <div class="wpc_feature_section wpc_video_tutorials">
            <?php pbwp_video_tutorials_center();?>
        </div>
    </section>
    <?php

    if ( has_filter( 'pbwp_notice_message' ) ) {?>
    <section id="content3">
        <div class="wpc_feature_section">
            <?php pbwp_recommended_action_screen();?>
        </div>
    </section>
    <?php }
    ?>
</div>

<?php
$support_page = ob_get_clean();

    echo wp_kses( $support_page, pbwp_wp_kses_allowed_html() );

}

function pbwp_video_tutorials_center()
{

    ob_start();

    ?>
<div class="wpc_feature_section">
    <div class="wpc_panel_title">
        <p>
            <?php esc_html_e( 'Welcome to our video tutorials page! The video list below showcases our latest tutorials. New videos will automatically appear here as soon as they are released. To ensure you\'re always up-to-date, you can also manually refresh the list by clicking the button below.', 'page-builder-wp' );?>
        </p>
        <span
            class="button button-primary refresh-video"><?php esc_html_e( 'Refresh Video List', 'page-builder-wp' );?></span>
    </div>
    <div class="wpc_video_tutorials_cont">
        <div class="panelloader ploader"></div>
    </div>
</div>
<?php
$video_tuts = ob_get_clean();

    echo wp_kses_post( $video_tuts );

}

function pbwp_recommended_action_screen()
{

    $notice_msg = [  ];

    if ( has_filter( 'pbwp_notice_message' ) ) {

        $notice_msg = apply_filters( 'pbwp_notice_message', $notice_msg );

        foreach ( $notice_msg as $key => $val ) {

            echo '<div class="wpc-action-required-box">';
            echo '<h3>'.esc_html( $val[ 'title' ] ).'</h3>';
            echo wp_kses_post( $val[ 'content' ] );
            echo '</div>';

        }

    }

}

/* These all content of recommendation page */
function pbwp_upgrade_php7_notice( $notice )
{
    $noticephp7 = [
        /* translators: %s is a placeholder for PHP version */
        'title'   => sprintf( esc_html__( 'Upgrade PHP %1$s to 7 or above', 'page-builder-wp' ), PHP_VERSION ),
        'content' => '<p>'.esc_html__( 'Why you need to upgrade to PHP 7 or above? There are three main benefits to keeping PHP up-to-date:', 'page-builder-wp' ).'</p><ul><li>'.esc_html__( 'WP Composer will run very fast, making your work more efficient.', 'page-builder-wp' ).'</li><li>'.esc_html__( 'Your website will be faster as the latest version of PHP is more efficient. Updating to the latest supported version can deliver a huge performance increase, up to 3 or 4x faster for older versions.', 'page-builder-wp' ).'</li><li>'.esc_html__( 'Your website will be more secure. PHP, like WordPress, is maintained by its community. Because PHP is so popular, it is a target for hackers - but the latest version will have the latest security features. Older versions of PHP do not have this, so updating is essential to keep your WordPress site secure.', 'page-builder-wp' ).'</li></ul><p><strong>'.esc_html__( 'If you want to upgrade WordPress to PHP 7 or above, you can contact your hosting company and ask them to help', 'page-builder-wp' ).'</strong></p>',
     ];

    // Add "translators:" comment for the title
    /* translators: %s is a placeholder for PHP version */
    $noticephp7[ 'title' ] = sprintf( esc_html__( 'Upgrade PHP %s to 7 or above', 'page-builder-wp' ), PHP_VERSION );

    // Apply esc_html to the content
    $noticephp7[ 'content' ] = wp_kses_post( $noticephp7[ 'content' ] );

    array_push( $notice, $noticephp7 );

    return $notice;
}

function pbwp_required_max_input_vars( $notice )
{

    $max_input = [
        'title'   => esc_html__( 'Increase your PHP max_input_vars', 'page-builder-wp' ),
        'content' => '<p>'.esc_html__( 'The max_input_vars PHP directive affects how many input variables may be accepted. It is important that we set a limit in order to guard against DOS attacks. But, if the limit is too low, it may prevent the WP Composer from loading properly. We recommnend that you ask your hosting support to increase max_input_vars to 3000 or 5000', 'page-builder-wp' ).'</p>',
     ];

    array_push( $notice, $max_input );

    return $notice;

}

/* END of recommendation page */