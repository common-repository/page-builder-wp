<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'maps-maps',
            'Maps',
        ),
        array(
            'maps-content-ttl',
            'Marker Title',
        ),
        array(
            'maps-content-desc',
            'Marker Description',
        ),
        array(
            'maps-marker-img',
            'Marker Boxes',
        ),
        array(
            'maps-marker-i',
            'Marker IMAGE',
        ),
        array(
            'maps-marker-icon',
            'Marker ICON',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-code-editor',
            'label'       => esc_html__( 'Maps Styles', 'page-builder-wp' ),
            'name'        => '.wpc_maps_styles|map_styles',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-mode',
                    'application/ld+json',
                ),
                array(
                    'data-size',
                    300,
                ),
                array(
                    'data-group',
                    'maps-maps',
                ),
                array(
                    'data-unsupported-devices',
                    'tablet, smartphone',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-border',
            'label'       => esc_html__( 'Border', 'page-builder-wp' ),
            'name'        => '.wpc_maps_canvas|border',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-border',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-maps',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.wpc_maps_canvas|padding',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-padding',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-maps',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.wpc_maps_canvas|margin',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-margin',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-maps',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.wpc_maps_title|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_maps_desc|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_maps_desc|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_maps_desc|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.wpc_maps_desc|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.wpc_maps_desc|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-content-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.marker_tpl_style_01|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-img',
                ),
                array(
                    'data-add-css-relation',
                    array(
                        array(
                            'selector' => '.wpc_maps_main_style_01:after',
                            'property' => 'border-top-color'
                        ),
                    ),
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Width', 'page-builder-wp' ),
            'name'        => '.marker_tpl_style_01|width',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-img',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text',
            'label'       => esc_html__( 'Box Shadow', 'page-builder-wp' ),
            'name'        => '.marker_tpl_style_01, .includethis. .wpc_maps_main_style_01:before|box-shadow',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'style',
                    'width:50%;',
                ),
                array(
                    'data-group',
                    'maps-marker-img',
                ),
            ),
            'desc'        => esc_html__( 'Paste your CSS on field above, for example: 0 22px 25px -15px rgba(0, 0, 0, 0.2);', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Content Area Padding', 'page-builder-wp' ),
            'name'        => '.wpc_maps_content|padding',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-padding',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-img',
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => 'img.wpc_maps_media_img|border-radius',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.m-f-u-li-link .wpc-i-move',
                    'corner-arrow',
                ),
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-border-radius',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-i',
                ),
            ),
            'custom_tags' => array(
                array(
                    'placeholder',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.wpc_maps_media|padding',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-padding',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-i',
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Marker Color', 'page-builder-wp' ),
            'name'        => '.marker_tpl_style_02|border-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-icon',
                ),
                array(
                    'data-add-css-relation',
                    array(
                        array(
                            'selector' => '.marker_tpl_style_02:after',
                            'property' => 'border-top-color'
                        ),
                    ),
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Icon Size', 'page-builder-wp' ),
            'name'        => 'i.wpc_maps_icon|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Color', 'page-builder-wp' ),
            'name'        => 'i.wpc_maps_icon|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Background Color', 'page-builder-wp' ),
            'name'        => '.marker_tpl_style_02|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'maps-marker-icon',
                ),
            ),
            'desc'        => null,
        ),
    ),
);