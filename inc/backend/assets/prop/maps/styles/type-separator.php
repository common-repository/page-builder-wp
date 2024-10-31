<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'sep-separator',
            'Separator',
        ),
        array(
            'sep-icon',
            'Icon',
        ),
        array(
            'sep-text',
            'Text',
        ),
        array(
            'sep-box',
            'Box'
        )
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.separator_line|border-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-separator',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-select',
            'label'       => esc_html__( 'Style', 'page-builder-wp' ),
            'name'        => '.separator_line|border-style',
            'default'     => 'solid',
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-separator',
                ),
            ),
            'desc'        => null,
            'choices'     => array(
                array(
                    'solid',
                    'Solid',
                ),
                array(
                    'dotted',
                    'Dotted',
                ),
                array(
                    'dashed',
                    'Dashed',
                ),
                array(
                    'double',
                    'Double',
                ),
                array(
                    'groove',
                    'Groove',
                ),
                array(
                    'ridge',
                    'Ridge',
                ),
                array(
                    'inset',
                    'Inset',
                ),
                array(
                    'outset',
                    'Outset',
                ),
                array(
                    'initial',
                    'Initial',
                ),
                array(
                    'inherit',
                    'Inherit',
                ),
            ),
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Height', 'page-builder-wp' ),
            'name'        => '.separator_line|border-width',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-separator',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Width', 'page-builder-wp' ),
            'name'        => '.separator_line|width',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-separator',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Alignment', 'page-builder-wp' ),
            'name'        => '.wpc_separator_type_line|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-separator',
                ),
            ),
            'desc'        => esc_html__( 'This option only work when you use separator type Line', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Color', 'page-builder-wp' ),
            'name'        => '.separator_icon|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Icon Size', 'page-builder-wp' ),
            'name'        => '.separator_icon|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.separator_text|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Background Color', 'page-builder-wp' ),
            'name'        => '.separator_text|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.separator_text|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.separator_text|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.separator_text|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.separator_text|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sep-text',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.separator_text|border-radius',
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
                    'sep-text',
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
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.self.|margin',
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
                    'sep-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.self.|padding',
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
                    'sep-box',
                ),
            ),
            'desc'        => null,
        ),
    ),
);