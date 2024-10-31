<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'lst-txt',
            'Text',
        ),
        array(
            'lst-lst',
            esc_html__( 'List Number & Icon Style', 'page-builder-wp' )
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_list_text|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_list_text, .includethis. .wpc_list_number|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_list_text|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.wpc_list_text|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.wpc_list_text|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'List Number & Icon Color', 'page-builder-wp' ),
            'name'        => '.wpc_list_number, .includethis. .listIconMode|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-lst',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'List Shapes Color', 'page-builder-wp' ),
            'name'        => '.list_shape_col|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-lst',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'List Icon Size', 'page-builder-wp' ),
            'name'        => '.listIconMode|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'lst-lst',
                ),
            ),
            'desc'        => null,
        ),
    ),
);