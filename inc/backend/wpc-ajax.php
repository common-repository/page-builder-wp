<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_http_prepare_download_log()
{

    if ( ! class_exists( 'WP_Debug_Data' ) ) {
        require_once ABSPATH.'wp-admin/includes/class-wp-debug-data.php';
    }

    if ( class_exists( 'WP_Debug_Data' ) ) {

        $info = WP_Debug_Data::debug_data();

        if ( isset( $info[ 'wp-paths-sizes' ] ) ) {
            unset( $info[ 'wp-paths-sizes' ] );
        }

        $info = str_replace( [ '`', "\r" ], '', WP_Debug_Data::format( $info, 'debug' ) );

        if ( check_ajax_referer( 'wpc-download-log', 'nonce' ) && isset( $_GET[ 'wpc-download-log' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET[ 'nonce' ] ) ), 'wpc-download-log' ) ) {

            $url      = wp_parse_url( home_url() );
            $host     = sanitize_file_name( $url[ 'host' ] );
            $filename = sprintf( '%s-diagnostic-log-%s.txt', $host, gmdate( 'YmdHis' ) );
            header( 'Content-Description: File Transfer' );
            header( 'Content-Type: application/octet-stream' );
            header( 'Content-Length: '.strlen( trim( $info ) ) );
            header( 'Content-Disposition: attachment; filename='.$filename );
            echo esc_html( trim( $info ) );
            wp_die();

        }

    } else {
        wp_die();
    }

}

add_action( 'wp_ajax_pbwp_http_prepare_download_log', 'pbwp_http_prepare_download_log' );

function pbwp_safe_return()
{
    $back_url = admin_url();

    if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) ) {
        $referer = esc_url_raw( wp_unslash( $_SERVER[ 'HTTP_REFERER' ] ) );

        $query_string = wp_parse_url( $referer, PHP_URL_QUERY );
        parse_str( $query_string, $queries );

        $sanitized_queries = array_map( 'sanitize_text_field', wp_unslash( sanitize_text_field( $queries ) ) );

        if ( isset( $sanitized_queries[ 'wpc_session' ] ) && $sanitized_queries[ 'wpc_session' ] ) {
            $redirect_str = base64_decode( $sanitized_queries[ 'wpc_session' ] );
            $params       = json_decode( $redirect_str, true );
            $params       = isset( $params[ 'return_params' ] ) ? $params[ 'return_params' ] : admin_url( 'admin.php' );

            if ( isset( $params[ 'nonce' ] ) && wp_verify_nonce( wp_unslash( sanitize_text_field( $params[ 'nonce' ] ) ), 'wpc-safe-return' ) && isset( $params[ 'url' ] ) ) {
                $back_url = esc_url_raw( $params[ 'url' ] );
            }
        }
    }

    echo '<html><head><meta http-equiv="refresh" content="0;URL='.esc_attr( $back_url ).'" /></head></html>';
    wp_die();
}

add_action( 'wp_ajax_pbwp_safe_return', 'pbwp_safe_return' );
