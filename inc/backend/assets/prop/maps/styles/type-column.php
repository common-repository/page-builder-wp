<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'col-col',
            'Column Styles',
        ),
        array(
            'col-custom',
            'Custom CSS',
        ),
    ),
    'fields' => apply_filters( 'pbwp_item_css_fields', array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|color-gradient',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-display',
            'label'       => esc_html__( 'Display', 'page-builder-wp' ),
            'name'        => '.self.|display',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-float',
            'label'       => esc_html__( 'Float', 'page-builder-wp' ),
            'name'        => '.self.|float',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Items Alignment', 'page-builder-wp' ),
            'name'        => '.self.|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-overflow',
            'label'       => esc_html__( 'Overflow', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|overflow',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Min Height', 'page-builder-wp' ),
            'name'        => '.self.|min-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Width', 'page-builder-wp' ),
            'name'        => '.self.|width',
            'default'     => null,
            'custom_css'  => array(
                array(
                    'this',
                    'force_hideme',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
                array(
                    'data-unsupported-devices',
                    'desktop, tablet, smartphone',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Height', 'page-builder-wp' ),
            'name'        => '.self.|height',
            'default'     => null,
            'custom_css'  => array(
                array(
                    'this',
                    'force_hideme',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-group',
                    'col-col',
                ),
                array(
                    'data-unsupported-devices',
                    'desktop, tablet, smartphone',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|padding',
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
                    'col-col',
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
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|border-radius',
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
                    'col-col',
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
            'type'        => 'field-border',
            'label'       => esc_html__( 'Border', 'page-builder-wp' ),
            'name'        => '.self. .wpc_column_inner|border',
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
                    'col-col',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-code-editor',
            'label'       => esc_html__( 'Custom CSS', 'page-builder-wp' ),
            'name'        => 'custom_css',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-mode',
                    'css',
                ),
                array(
                    'data-group',
                    'col-custom',
                ),
                array(
                    'data-unsupported-devices',
                    'tablet, smartphone',
                ),
            ),
            'desc'        => esc_html__( 'The above CSS will be applied to all elements inside this Column', 'page-builder-wp' ),
        ),
    ), '.self. .wpc_column_inner', 'col-col', 1 ),
);