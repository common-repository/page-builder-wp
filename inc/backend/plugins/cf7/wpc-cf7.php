<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'pbwp_supported_plugins_list', 'pbwp_add_cf7_to_supported_plugins' );
add_filter( 'pbwp_item_list', 'pbwp_add_cf7_items' );
add_filter( 'pbwp_editor_maps', 'pbwp_add_cf7_editor_maps' );

function pbwp_add_cf7_to_supported_plugins( $plugins )
{

    $plugins = array_merge( array( 'cf7' ), $plugins );

    return $plugins;

}

function pbwp_add_cf7_items( $items )
{

    $extra_items = array(
        'cf7' => array( 'name' => 'Contact Form 7', 'category' => 'content', 'wpc_item' => true ),
    );

    foreach ( $extra_items as $key => $val ) {

        $items[$key] = $val;

    }

    return $items;

}

function pbwp_add_cf7_editor_maps( $maps )
{
    // Contact Form 7 Item
    $maps['addons']['cf7'] = array(
        'tabs'     => array(
            esc_html__( 'GENERAL', 'page-builder-wp' ),
        ),
        'template' => array(
            'general-panel' => array(
                'fields' => array(
                    array(
                        'type'        => 'field-select',
                        'label'       => esc_html__( 'Select Form', 'page-builder-wp' ),
                        'name'        => 'cf7_form',
                        'default'     => 'none',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'choices'     => pbwp_get_cf7_forms(),
                        'desc'        => esc_html__( 'Choose previously created contact form from the drop down list.', 'page-builder-wp' ),
                    ),
                    'xtra-class',
                ),
            ),
        ),
    );

    return $maps;

}

function pbwp_get_cf7_forms()
{

    $cf7       = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $all_forms = array();

    $all_forms[] = array( 'none', '---'.esc_html__( 'Select Form', 'page-builder-wp' ).'---' );

    if ( $cf7 ) {

        foreach ( $cf7 as $cform ) {
            $all_forms[] = array( $cform->ID, $cform->post_title );
        }

    }

    return $all_forms;

}