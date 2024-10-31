<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'pc-title',
            'Post Title & Post Description',
        ),
        array(
            'pc-meta',
            'Post Meta',
        ),
        array(
            'pc-rm',
            'Read More Button',
        ),
        array(
            'pc-box',
            'Box',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_title|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_blog_title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_blog_title|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.wpc_blog_title|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Alignment', 'page-builder-wp' ),
            'name'        => '.wpc_blog_title|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Description Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_excerpt|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_blog_excerpt|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_blog_excerpt|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.wpc_blog_excerpt|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_meta, .includethis. .blog_meta_date:before, .includethis. .blog_meta_author:before|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-meta',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_blog_meta|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-meta',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.wpc_blog_meta|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-meta',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more, .includethis. .wpc_blog_read_more a|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more, .includethis. .wpc_blog_read_more a|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more, .includethis. .wpc_blog_read_more a|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Text Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more:hover, .includethis. .wpc_blog_read_more:hover a|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Button Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_read_more:hover|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-rm',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.wpc_blog_item_inner|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-border',
            'label'       => esc_html__( 'Border', 'page-builder-wp' ),
            'name'        => '.wpc_blog_item_inner|border',
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
                    'pc-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.wpc_blog_item_inner|padding',
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
                    'pc-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.wpc_blog_item_inner|margin',
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
                    'pc-box',
                ),
            ),
            'desc'        => null,
        ),
    ),
);