<?php

/**
 * Sanitize data
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_sanitize_options( $values )
{

    array_walk_recursive( $values, 'pbwp_sanitize_options_func' );

    return ! empty( $values ) ? $values : [  ];

}

function pbwp_sanitize_options_func( &$value, $key )
{

    $value = wp_kses_post( force_balance_tags( $value ) );

}

/**
 * Recursive sanitation for text or array
 *
 * @param $array_or_string (array|string)
 * @return mixed
 */
function pbwp_array_sanitation( $array_or_string )
{

    if ( is_string( $array_or_string ) ) {

        $array_or_string = sanitize_text_field( $array_or_string );

    } elseif ( is_array( $array_or_string ) ) {

        foreach ( $array_or_string as $key => &$value ) {

            if ( is_array( $value ) ) {
                $value = pbwp_array_sanitation( $value );
            } else {
                $value = sanitize_text_field( $value );
            }

        }

    }

    return $array_or_string;

}

/**
 * Decode data and recursive sanitation for text or array
 *
 * @param $data (array|string)
 * @return mixed
 */
function pbwp_data_sanitation( $data, $decode = true, $returnEncode = true )
{

    if ( $decode ) {

        $tempData = base64_decode( $data );
        $data     = json_decode( $tempData, true );
    }

    $sanitized = pbwp_array_sanitation( $data );

    if ( $returnEncode ) {
        $decoded = base64_encode( wp_json_encode( $sanitized ) );

        return $decoded;
    }

    return $sanitized;

}
