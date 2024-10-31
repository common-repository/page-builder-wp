<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Color', 'page-builder-wp' ),
            'name'        => '.wpc_item_icon|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Icon Size', 'page-builder-wp' ),
            'name'        => '.wpc_item_icon_cont .wpc_item_icon|font-size',
            'default'     => '24px',
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Alignment', 'page-builder-wp' ),
            'name'        => '.wpc_item_icon_cont|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ),
        array(
            'type'        => 'field-display',
            'label'       => esc_html__( 'Display', 'page-builder-wp' ),
            'name'        => '.wpc_item_icon_cont|display',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.wpc_item_icon_cont|margin',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-margin',
                ),
            ),
            'custom_data' => null,
            'desc'        => null,
        ),
    ),
);