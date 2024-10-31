<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_menu_pages()
{

    add_menu_page( esc_html__( 'WP Composer Welcome Page', 'page-builder-wp' ), esc_html( PBWP_NAME ), 'manage_options', 'wpc-welcome', 'pbwp_welcome_screen', esc_url( pbwp_distribution_url( 'images/menu_logo.png' ) ), 21 );
    add_submenu_page( 'wpc-welcome', esc_html__( 'General Settings', 'page-builder-wp' ), esc_html__( 'General Settings', 'page-builder-wp' ), 'manage_options', 'wpc-global-settings', 'pbwp_global_settings_screen' );

    if ( current_user_can( 'manage_options' ) ) {
        global $submenu;

        if ( isset( $submenu[ 'wpc-welcome' ][ 0 ][ 0 ] ) ) {
            $submenu[ 'wpc-welcome' ][ 0 ][ 0 ] = esc_html__( 'About', 'page-builder-wp' ).apply_filters( 'pbwp_notify_count', '' );
        }

    }

}

add_action( 'admin_menu', 'pbwp_menu_pages' );

function pbwp_set_notify_count( $str )
{

    $cnt = 0;

    if ( version_compare( PHP_VERSION, '7', '<' ) ) {

        $cnt = $cnt + 1;

        add_filter( 'pbwp_notice_message', 'pbwp_upgrade_php7_notice' );

    }

    if ( function_exists( 'ini_get' ) ) {

        if ( (int) ini_get( 'max_input_vars' ) < 3000 ) {

            $cnt = $cnt + 1;

            add_filter( 'pbwp_notice_message', 'pbwp_required_max_input_vars' );

        }
    }

    return ( $cnt > 0 ? '<span class="wpc_notify_count"><span class="wpc_notify_count_num">'.esc_html( $cnt ).'</span></span>' : '' );

}

function pbwp_welcome_screen()
{

    wp_enqueue_style( 'wpc-pages' );
    wp_enqueue_script( 'wpc-pages' );

    ob_start();

    $active_tab   = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $allowed_tabs = [ 'pbwp_getting_started_page', 'pbwp_support_page' ];

    if ( empty( $active_tab ) ) {
        $active_tab = 'pbwp_getting_started_page';
    }

    ?>
<div id="wpc-welcome-page" class="wrap about-wrap wpc_pages">
    <div class="wpc_title_cont">
        <h1><?php /* translators: %1$s is a placeholder for the plugin name */
        printf( esc_html__( 'Welcome to %s', 'page-builder-wp' ), esc_html( PBWP_NAME ) );?></h1>
        <hr class="wpc_style_01">
        <div class="about-text custom_about_text">
            <?php esc_html_e( 'A WordPress page builder designed for efficiency and speed, allowing quick creation of diverse layouts with streamlined functionality.', 'page-builder-wp' );?>
        </div>
    </div>

    <div class="wpc_logo_cont">
        <div class="wpc_badge"><img width="120" height="120" src="<?php echo esc_url( pbwp_distribution_url( 'images/wpc_logo.png' ) ); ?>"></div>
        <span class="wpc_version"><?php
        /* translators: %1$s is a placeholder for the plugin version */
        printf( esc_html__( 'Version %s', 'page-builder-wp' ), esc_html( PBWP_VERSION ) );?></span>
    </div>

    <h2 class="nav-tab-wrapper wp-clearfix">
        <a href="<?php echo esc_url( add_query_arg( [ 'tab' => 'pbwp_getting_started_page' ] ) ); ?>"
            class="nav-tab <?php echo ( $active_tab == 'pbwp_getting_started_page' ? 'nav-tab-active' : '' ); ?>"
            role="tab" data-toggle="tab"><?php esc_html_e( 'Getting Started', 'page-builder-wp' );?></a>
        <a href="<?php echo esc_url( add_query_arg( [ 'tab' => 'pbwp_support_page' ] ) ); ?>"
            class="nav-tab <?php echo ( $active_tab == 'pbwp_support_page' ? 'nav-tab-active' : '' ); ?>" role="tab"
            data-toggle="tab"><?php esc_html_e( 'Support', 'page-builder-wp' );?><?php echo wp_kses( apply_filters( 'pbwp_notify_count', '' ), pbwp_wp_kses_allowed_html() ); ?></a>
    </h2>
    <?php
if ( in_array( $active_tab, $allowed_tabs ) ) {
        $active_tab();
    }

    ?>
</div> <!-- END WRAP -->
<?php
$welcome_screen = ob_get_clean();

    echo wp_kses( $welcome_screen, pbwp_wp_kses_allowed_html() );

}
