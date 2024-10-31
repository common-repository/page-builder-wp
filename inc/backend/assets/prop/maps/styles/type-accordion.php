<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'accr-header',
            'Header Area',
        ),
        array(
            'accr-body',
            'Accordion Body',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title and Icon Color', 'page-builder-wp' ),
            'name'        => '.accordion_title .acc_title, .includethis. .accordion_title i|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.accordion_title .acc_title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Title and Icon Size', 'page-builder-wp' ),
            'name'        => '.accordion_title .acc_title, .includethis. .accordion_title i|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.accordion_title .acc_title|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Alignment', 'page-builder-wp' ),
            'name'        => '.accordion_title|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Header Background Color', 'page-builder-wp' ),
            'name'        => '.accordionTitle, .includethis. .accordionTitle.is-expanded:not(.isflatMode)|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.accordionTitle, .includethis. .accordionTitle.is-expanded:not(.isflatMode)|color-gradient',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Header Border Color', 'page-builder-wp' ),
            'name'        => '.accordionTitle.accordionTitleBorder|border-bottom-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Header Background Color', 'page-builder-wp' ),
            'name'        => '.accordionTitle:hover|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Navigation Icon Color', 'page-builder-wp' ),
            'name'        => '.accordionTitle:before|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-header',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.wpc_accordion dd|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'accr-body',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.accordion_inner_content|padding',
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
                    'accr-body',
                ),
            ),
            'desc'        => null,
        ),
    ),
);