<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex,nofollow">
    <title><?php esc_html_e( 'Maintenance Mode', 'page-builder-wp' );?></title>
    <meta name="description" content="">
    <?php

// Maintenance Mode
wp_enqueue_style( 'wpc-maintenance', plugins_url( 'maintenance/main_data/style.css', __DIR__ ), [  ], PBWP_VERSION, 'all' );
wp_enqueue_script( 'wpc-maintenance', plugins_url( 'maintenance/main_data/main.js', __DIR__ ), [  ], PBWP_VERSION, false );

$wpc_stt  = get_option( 'pbwp_globals' );
$end_time = ( isset( $wpc_stt[ 'stt_general' ] ) && isset( $wpc_stt[ 'stt_general' ][ 'wpc_maintenance_end' ] ) && $wpc_stt[ 'stt_general' ][ 'wpc_maintenance_end' ] !== '' ? $wpc_stt[ 'stt_general' ][ 'wpc_maintenance_end' ] : '1970-01-01' );

wp_localize_script( 'wpc-maintenance', 'wpc_maintenance', [
    'dateEnd' => esc_html( $end_time ),
 ] );

global $wp_styles;
wp_styles()->do_items();
wp_print_head_scripts();

?>
</head>

<body>
    <div class="preloader" id="preloader">
        <div id="loader"></div>
    </div>
    <div class="content-wrap">
        <div class="logo-box">
            <img src="<?php echo esc_url( plugins_url( 'maintenance/main_data/logo.png', __DIR__ ) ); ?>">
        </div>
        <div class="cta-box">
            <?php
            /* translators: %s is a placeholder for the highlighted_text */
$h1_text          = esc_html__( 'We Will Be Back %s', 'page-builder-wp' );
$highlighted_text = esc_html__( 'Soon!', 'page-builder-wp' );
?>
            <h1><?php printf( esc_html( $h1_text ), '<span class="highlight">'.esc_html( $highlighted_text ).'</span>' );?></h1>
            <p><?php esc_html_e( 'We are using this time to give our website a revamp!', 'page-builder-wp' );?></p>
        </div>
        <div class="countdown">
            <p class="timer-cta"><?php esc_html_e( 'We will relaunch our website in', 'page-builder-wp' );?>:</p>
            <ul class="timer">
                <li>
                    <div class="time-box"><span class="time" id="days">0</span> <span
                            class="time-txt"><?php esc_html_e( 'Days', 'page-builder-wp' );?></span></div>
                </li>
                <li>
                    <div class="time-box"><span class="time" id="hours">0</span> <span
                            class="time-txt"><?php esc_html_e( 'Hours', 'page-builder-wp' );?></span>
                    </div>
                </li>
                <li>
                    <div class="time-box"><span class="time" id="minutes">0</span> <span
                            class="time-txt"><?php esc_html_e( 'Minutes', 'page-builder-wp' );?></span>
                    </div>
                </li>
                <li>
                    <div class="time-box"><span class="time" id="seconds">0</span> <span
                            class="time-txt"><?php esc_html_e( 'Seconds', 'page-builder-wp' );?></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>