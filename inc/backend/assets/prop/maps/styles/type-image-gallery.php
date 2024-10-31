<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'gl-ovly',
            'Title &amp; Overlay',
        ),
        array(
            'gl-image',
            'Images',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Font Color', 'page-builder-wp' ),
            'name'        => '.wpc_gallery_title, .includethis. .gallery_title|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_gallery_title, .includethis. .gallery_title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_gallery_title, .includethis. .gallery_title|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Overlay Icon Color', 'page-builder-wp' ),
            'name'        => '.overlay_info i|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Overlay Icon Size', 'page-builder-wp' ),
            'name'        => '.overlay_info i|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Overlay and Title Background Color', 'page-builder-wp' ),
            'name'        => '.wpc_img_overlay, .includethis. .wpc_gallery_title|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'gl-ovly',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.wpc_i_gallery_item .wpc_grid_gallery, .includethis. .wpc_i_gallery_item .wpc-g-img, .includethis. .wpc_i_gallery_item .wpc_img_overlay|border-radius',
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
                    'gl-image',
                ),
            ),
            'custom_tags' => array(
                array(
                    'placeholder',
                ),
            ),
            'desc'        => esc_html__( 'If you want to keep things perfectly round, use an image with the same width and height. Anything else will still be rounded, but you will end up with an elliptic shape which may or may not be desirable.', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-border',
            'label'       => esc_html__( 'Border', 'page-builder-wp' ),
            'name'        => '.wpc_i_gallery_item .wpc_grid_gallery, .includethis. .wpc_i_gallery_item .wpc-g-img|border',
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
                    'gl-image',
                ),
            ),
            'desc'        => null,
        ),
    ),
);