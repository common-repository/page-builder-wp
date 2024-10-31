<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'ftre-ttl',
            'Title',
        ),
        array(
            'ftre-desc',
            'Description',
        ),
        array(
            'ftre-misc',
            'Misc Text',
        ),
        array(
            'ftre-image',
            'Image &amp; Icon',
        ),
        array(
            'ftre-button',
            'Button',
        ),
        array(
            'ftre-box',
            'Box',
        ),
    ),
    'fields' => apply_filters( 'pbwp_item_css_fields', array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Letter Spacing', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|letter-spacing',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Align', 'page-builder-wp' ),
            'name'        => '.ftre_title, .includethis. .ftre_title h4|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-ttl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Letter Spacing', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|letter-spacing',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Align', 'page-builder-wp' ),
            'name'        => '.ftre_desc, .includethis. .ftre_desc p|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-desc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Align', 'page-builder-wp' ),
            'name'        => '.ftre_misc, .includethis. .ftre_misc h5|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-misc',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Max Image Width', 'page-builder-wp' ),
            'name'        => '.ftre_image img|max-width',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Max Image Height', 'page-builder-wp' ),
            'name'        => '.ftre_image img|max-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Icon Size', 'page-builder-wp' ),
            'name'        => '.ftre_icon|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Color', 'page-builder-wp' ),
            'name'        => '.ftre_icon|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-flex-vertical-align',
            'label'       => esc_html__( 'Image or Icon Vertical Align', 'page-builder-wp' ),
            'name'        => '.fbox_media_side|align-self',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => esc_html__( 'This option only work when you use Template No 2 or 3', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Image or Icon Box Background Color', 'page-builder-wp' ),
            'name'        => '.ftre_box_media|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Image or Icon Box Padding', 'page-builder-wp' ),
            'name'        => '.ftre_box_media|padding',
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
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Image or Icon Box Border Radius', 'page-builder-wp' ),
            'name'        => '.ftre_box_media|border-radius',
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
                    'ftre-image',
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
            'label'       => esc_html__( 'Image or Icon Box Border', 'page-builder-wp' ),
            'name'        => '.ftre_box_media|border',
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
                    'ftre-image',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.ftre_button_text|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.ftre_button_text|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Text Size', 'page-builder-wp' ),
            'name'        => '.ftre_button_text|font-size',
            'default'     => '18px',
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.ftre_button_text|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Color', 'page-builder-wp' ),
            'name'        => '.ftre_button|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Text Color', 'page-builder-wp' ),
            'name'        => '.ftre_button_a:hover .ftre_button_text|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Button Color', 'page-builder-wp' ),
            'name'        => '.ftre_button:hover|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-flex-horizontal-align',
            'label'       => esc_html__( 'Button Align', 'page-builder-wp' ),
            'name'        => '.ftre_button_a|align-self',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.ftre_button|padding',
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
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.ftre_button|margin',
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
                    'ftre-button',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.ftre_button|border-radius',
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
                    'ftre-button',
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
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.ftre_box|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.ftre_box|color-gradient',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.ftre_box|border-radius',
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
                    'ftre-box',
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
            'name'        => '.ftre_box|border',
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
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.ftre_box|margin',
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
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.ftre_box|padding',
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
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-slider',
            'label'       => esc_html__( 'Image Box Width', 'page-builder-wp' ),
            'name'        => '.fbox_media_side|width',
            'default'     => '30%',
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-slide-connect-with',
                    '.fbox_content_side|width',
                ),
                array(
                    'data-slide-connect-type',
                    'opposite',
                ),
                array(
                    'data-slide-unit',
                    '%',
                ),
                array(
                    'data-group',
                    'ftre-box',
                ),
            ),
            'desc'        => esc_html__( 'This option will work when you use Image as media type and use template 02 or 03', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-slider',
            'label'       => esc_html__( 'Content Box Width', 'page-builder-wp' ),
            'name'        => '.fbox_content_side|width',
            'default'     => '70%',
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-slide-connect-with',
                    '.fbox_media_side|width',
                ),
                array(
                    'data-slide-connect-type',
                    'opposite',
                ),
                array(
                    'data-slide-unit',
                    '%',
                ),
                array(
                    'data-group',
                    'ftre-box',
                ),
            ),
            'desc'        => esc_html__( 'This option will work when you use Image as media type and use template 02 or 03', 'page-builder-wp' ),
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Content Box Padding', 'page-builder-wp' ),
            'name'        => '.ftre_box_content|padding',
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
                    'ftre-box',
                ),
            ),
            'desc'        => null,
        ),
    ), '.ftre_box', 'ftre-box', 46 ),
);