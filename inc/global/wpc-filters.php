<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* 
 * This filter is used to adapt if there is a change in the CSS selector
 * Example usage:
 * 
 * function additional_key_mappings($keyMappings) {
 *     // Add or modify key mappings
 *     $keyMappings['.old_selector|property'] = '.new_selector i|new_property';
 *     return $keyMappings;
 * }
 * add_filter('wpc_elements_css_selector_mappings', 'additional_key_mappings', 10, 1);
 * 
 */
function pbwp_elements_css_selector_func( $key )
{
    $keyMappings = [
        '.wpc_scl_each|font-size'                => '.wpc_scl_each i|font-size',
        '.wpc_item_button|text-align'            => '.wpc_button_text|justify-content',
        '.wpc_item_singletitle|text-align'       => '.wpc_item_singletitle|justify-content',
        '.self.|background'                      => '.self.|background-color',
        '.self. > .wpc_row_container|background' => '.self. > .wpc_row_container|background-color',
        '.self. .wpc_column_inner|background'    => '.self. .wpc_column_inner|background-color',
        '.wpc_item_typecta|background'           => '.wpc_item_typecta|background-color',
        '.wpc_form_main|background'              => '.wpc_form_main|background-color',
        '.ftre_box|background'                   => '.ftre_box|background-color',
        '.wpc_nf_body|background'                => '.wpc_nf_body|background-color',
        '.prd_box|background'                    => '.prd_box|background-color',
     ];

    $keyMappings = apply_filters( 'pbwp_elements_css_selector_mappings', $keyMappings );

    return $keyMappings[ $key ] ?? $key;
}

add_filter( 'pbwp_elements_css_selector', 'pbwp_elements_css_selector_func', 10, 1 );

function pbwp_elements_css_selector_before( $key )
{

    /* Accorodion Header */
    if ( strpos( $key, 'accordionTitle.is-expanded' ) !== false ) {
        $key = str_replace( '.is-expanded', '', $key );
    }

    return $key;

}

add_filter( 'pbwp_elements_css_selector_before_parsing', 'pbwp_elements_css_selector_before', 10, 1 );

function pbwp_elements_css_selector_after( $key, $selector )
{
    $selectorMappings = [
        '.text_editor_content'  => true,
        '.wpc_timeline_content' => true,
        '.cta-desc'             => true,
        '.alert_text'           => false,
     ];

    if ( isset( $selectorMappings[ $key ] ) && $selectorMappings[ $key ] ) {
        $key .= ', '.$selector.' '.$key.' p';
    } elseif ( $key == '.alert_text' ) {
        $key .= ', '.$selector.' '.$key.' h4';
    }

    return $key;
}

add_filter( 'pbwp_elements_css_selector_after_parsing', 'pbwp_elements_css_selector_after', 10, 2 );

function pbwp_elements_css_property_changes( $property )
{

    /* All elements */
    if ( $property == 'background' ) {
        $property = 'background-color';
    }

    return $property;

}

add_filter( 'pbwp_elements_css_property', 'pbwp_elements_css_property_changes', 10, 1 );

function pbwp_live_editor_selector_replacer( $selectors )
{

    $replacer = [
        '.list_shape_col' => '.list_shape',
        '.wpc_scl_each'   => [ 'font-size', '.wpc_scl_each i' ],
        '.alert_text'     => [ 'color', '.alert_text h4' ],
     ];

    $selectors = array_merge( $selectors, $replacer );

    return $selectors;

}

add_filter( 'pbwp_live_editor_selector_replacer', 'pbwp_live_editor_selector_replacer', 10, 1 );

function pbwp_live_editor_mark_important( $items )
{

    $replacer = [
        'color',
        'overflow',
        'font-size',
        'font-family',
        'line-height',
        'padding',
        'margin',
     ];

    $items = array_merge( $items, $replacer );

    return $items;

}

add_filter( 'pbwp_live_editor_css_mark_important', 'pbwp_live_editor_mark_important', 10, 1 );

function pbwp_live_editor_bg_to_bgcolor( $items )
{

    $replacer = [
        '.self.|background',
        '.self. > .wpc_row_container|background',
        '.self. .wpc_column_inner|background',
        '.wpc_item_typecta|background',
        '.wpc_form_main|background',
        '.ftre_box|background',
        '.wpc_nf_body|background',
        '.prd_box|background',
     ];

    $items = array_merge( $items, $replacer );

    return $items;

}

add_filter( 'pbwp_live_editor_css_bg_to_bgcolor', 'pbwp_live_editor_bg_to_bgcolor', 10, 1 );
