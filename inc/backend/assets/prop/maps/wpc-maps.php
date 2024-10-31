<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
DO NOT FORGET TO CHANGE MAPS VERSION in wp-composer.php ( PBWP_FIELD_MAPS_VERSION ) every time you add/remove a field(s)
 */

if ( ! function_exists( 'pbwp_get_option' ) ) {
    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
}

function pbwp_maps()
{

    return [ 'maps' => [
        'textEditor'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'              => 'field-texteditor',
                            'label'             => null,
                            'name'              => 'text-editor',
                            'default'           => '',
                            'frontend_selector' => '.text_editor_content',
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => [
                    'group'  => [
                        [
                            'txt-txt',
                            'Content',
                        ],
                        [
                            'txt-box',
                            'Box',
                        ],
                    ],
                    'fields' => pbwp_typography_template( '.text_editor_content|', 'txt-txt' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeImage'         => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'sing-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image Size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'large',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Instagram-like Filters?', 'page-builder-wp' ),
                            'name'        => 'use_img_ig_filter',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, your can apply Instagram-like filters to your images easily', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-image-filters',
                            'label'       => esc_html__( 'Available Filters', 'page-builder-wp' ),
                            'name'        => 'img_ig_filters',
                            'default'     => 'hefe',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Overlay Effect?', 'page-builder-wp' ),
                            'name'        => 'img_overlay',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, overlay effect will appear when users hover over an image', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Overlay Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The icon show on center of overlay layer', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Image Lazy Load?', 'page-builder-wp' ),
                            'name'        => 'img_lazyload',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enable this option will enhance performance on your website by loading images only as they enter the viewport or a scrollable area', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-image.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'imageGallery'      => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-picker',
                                    'multiple_image',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'mlt-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Gallery Type', 'page-builder-wp' ),
                            'name'        => 'gallery_type',
                            'default'     => 'masonry',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'grid',
                                    'Grid',
                                ],
                                [
                                    'masonry',
                                    'Masonry',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Gallery Columns', 'page-builder-wp' ),
                            'name'        => 'columns',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    6,
                                ],
                            ],
                            'desc'        => esc_html__( 'Number of columns for grid/masonry', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image Size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'On click Action', 'page-builder-wp' ),
                            'name'        => 'action',
                            'default'     => 'lightbox',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-action',
                                    'onclickaction',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'noaction',
                                    esc_html__( 'No Action', 'page-builder-wp' ),
                                ],
                                [
                                    'lightbox',
                                    esc_html__( 'Open on Lightbox', 'page-builder-wp' ),
                                ],
                                [
                                    'link',
                                    esc_html__( 'Open Custom Link', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Custom links', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-gallery-group',
                                    'link',
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Lightbox Styles', 'page-builder-wp' ),
                            'name'        => 'lightbox_style',
                            'default'     => 'lightcase',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-gallery-group',
                                    'lightbox',
                                ],
                            ],
                            'desc'        => esc_html__( 'Select the appropriate type of lightbox', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'lightcase',
                                    'Lightcase',
                                ],
                                [
                                    'photobox',
                                    'Photobox',
                                ],
                                [
                                    'prettyphoto',
                                    'prettyPhoto',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'prettyPhoto Themes', 'page-builder-wp' ),
                            'name'        => 'prettyphoto_theme',
                            'default'     => 'light_square',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-gallery-group',
                                    'lightbox',
                                ],
                            ],
                            'desc'        => esc_html__( 'Select the theme for prettyPhoto lightbox', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'default',
                                    'Default',
                                ],
                                [
                                    'dark_rounded',
                                    'Dark Rounded',
                                ],
                                [
                                    'light_square',
                                    'Light Square',
                                ],
                                [
                                    'dark_square',
                                    'Dark Square',
                                ],
                                [
                                    'facebook',
                                    'Facebook Style',
                                ],
                                [
                                    'light_rounded',
                                    'Light Rounded',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Custom Link Target', 'page-builder-wp' ),
                            'name'        => 'target',
                            'default'     => '_blank',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-gallery-group',
                                    'link',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    '_self',
                                    esc_html__( 'Same Window', 'page-builder-wp' ),
                                ],
                                [
                                    '_blank',
                                    esc_html__( 'New Window', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Overlay Hover Effect', 'page-builder-wp' ),
                            'name'        => 'hover_effect',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enable to add layer overlay will show up when hover on the image', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Hover Effect Styles', 'page-builder-wp' ),
                            'name'        => 'hover_effect_style',
                            'default'     => 'fadeIn-top',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'fadeIn-top',
                                    esc_html__( 'fadeIn Top', 'page-builder-wp' ),
                                ],
                                [
                                    'fadeIn-right',
                                    esc_html__( 'fadeIn Right', 'page-builder-wp' ),
                                ],
                                [
                                    'fadeIn-bottom',
                                    esc_html__( 'fadeIn Bottom', 'page-builder-wp' ),
                                ],
                                [
                                    'fadeIn-left',
                                    esc_html__( 'fadeIn Left', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The icon show on center of overlay layer', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Title', 'page-builder-wp' ),
                            'name'        => 'hover_title',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The title will show on bottom of overlay layer. The title is based on your image title attribute', 'page-builder-wp' ),
                        ],
                        [
                            'type'       => 'field-select',
                            'label'      => esc_html__( 'Lightbox Image Descriptions Based on?', 'page-builder-wp' ),
                            'name'       => 'img_desc',
                            'default'    => '_desc',
                            'custom_css' => null,
                            'desc'       => esc_html__( 'Image description will appear on Lightbox Mode', 'page-builder-wp' ),
                            'choices'    => [
                                [
                                    '_desc',
                                    esc_html__( 'Image Description', 'page-builder-wp' ),
                                ],
                                [
                                    '_alt',
                                    esc_html__( 'Image Alt Text', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-image-gallery.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'imageSlider'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-picker',
                                    'multiple_image',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'mlt-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Efects', 'page-builder-wp' ),
                            'name'        => 'effect',
                            'default'     => 'slide',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'fade',
                                    'Fade',
                                ],
                                [
                                    'cube',
                                    'Cube',
                                ],
                                [
                                    'flip',
                                    'Flip',
                                ],
                                [
                                    'slide',
                                    'Slide',
                                ],
                                [
                                    'shift',
                                    'Shift',
                                ],
                                [
                                    'kenburn',
                                    'Kenburn',
                                ],
                                [
                                    'carousel_basic',
                                    'Carousel Basic',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Transition Speed', 'page-builder-wp' ),
                            'name'        => 'speed',
                            'default'     => 1500,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-step',
                                    100,
                                ],
                                [
                                    'data-slide-min',
                                    100,
                                ],
                                [
                                    'data-slide-max',
                                    5000,
                                ],
                                [
                                    'data-slide-unit',
                                    'ms',
                                ],
                            ],
                            'desc'        => esc_html__( 'Duration of transition between slides (in milliseconds)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Slider Autoplay Delay', 'page-builder-wp' ),
                            'name'        => 'autoplay_delay',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    0,
                                ],
                                [
                                    'data-slide-max',
                                    15,
                                ],
                                [
                                    'data-slide-unit',
                                    'sc',
                                ],
                            ],
                            'desc'        => esc_html__( 'Delay between transitions (in seconds). Set to 0 to disable auto play', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Navigation', 'page-builder-wp' ),
                            'name'        => 'navigation',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show navigation arrow in left and right side of gallery', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Pagination', 'page-builder-wp' ),
                            'name'        => 'pagination',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show bullets pagination in bottom center of gallery', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Gallery Thumbs', 'page-builder-wp' ),
                            'name'        => 'use_thumb',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show thumbs in bottom of gallery', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-image-slider.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'imageCarousel'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-picker',
                                    'multiple_image',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'mlt-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image Size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'large',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Items per Slide', 'page-builder-wp' ),
                            'name'        => 'items_per_slide',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    15,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number of items displayed per slide', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Slider Speed', 'page-builder-wp' ),
                            'name'        => 'speed',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    60,
                                ],
                            ],
                            'desc'        => esc_html__( 'Duration of animation between slides (in seconds)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Autoplay', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The carousel automatically plays when site loaded', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Image Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show image title on the bottom area', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Dots Navigation', 'page-builder-wp' ),
                            'name'        => 'dot_nav',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show the DOT navigation in the bottom of the carousel', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Progress Bar', 'page-builder-wp' ),
                            'name'        => 'pbar',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    60,
                                ],
                            ],
                            'desc'        => esc_html__( 'Visualize the progression of displaying photos. NOTE: If this option is enable your item per slide will be changed to one item', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Auto height', 'page-builder-wp' ),
                            'name'        => 'auto_height',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This plugin will automatically set the Carousel container height based on each image height. NOTE: If this option is enable your item per slide will be changed to one item', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'onClick Open on Lightbox', 'page-builder-wp' ),
                            'name'        => 'lightbox',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Display clicked image in the lightbox', 'page-builder-wp' ),
                        ],
                        [
                            'type'       => 'field-select',
                            'label'      => esc_html__( 'Lightbox Image Descriptions Based on?', 'page-builder-wp' ),
                            'name'       => 'img_desc',
                            'default'    => '_desc',
                            'custom_css' => null,
                            'desc'       => esc_html__( 'Image description will appear on Lightbox Mode', 'page-builder-wp' ),
                            'choices'    => [
                                [
                                    '_desc',
                                    esc_html__( 'Image Description', 'page-builder-wp' ),
                                ],
                                [
                                    '_alt',
                                    esc_html__( 'Image Alt Text', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Image LazyLoad?', 'page-builder-wp' ),
                            'name'        => 'lazyload',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Delays loading of images. Images outside of viewport wont be loaded before user scrolls to them', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-image-carousel.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'imageFlipster'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-picker',
                                    'multiple_image',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'mlt-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image Size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Style', 'page-builder-wp' ),
                            'name'        => 'style',
                            'default'     => 'carousel',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'carousel',
                                    'Carousel',
                                ],
                                [
                                    'coverflow',
                                    'Coverflow',
                                ],
                                [
                                    'wheel',
                                    'Wheel',
                                ],
                                [
                                    'flat',
                                    'Flat',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Autoplay', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Flipster will automatically advance to next item after that number of seconds', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Slide Duration', 'page-builder-wp' ),
                            'name'        => 'autoplay_time',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    15,
                                ],
                            ],
                            'desc'        => esc_html__( 'Speed of the autoplay', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Loop', 'page-builder-wp' ),
                            'name'        => 'loop',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If on, loop around when the start or end is reached', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Side Navigation', 'page-builder-wp' ),
                            'name'        => 'nav',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If on, Flipster will insert Previous / Next buttons with SVG arrows', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Shadow', 'page-builder-wp' ),
                            'name'        => 'shadow',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If on, Flipster will generate box-shadow around each image', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-image-flipster.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'spacing'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'  => [
                    'fields' => [
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Height', 'page-builder-wp' ),
                            'name'        => 'spacing',
                            'default'     => 25,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    500,
                                ],
                                [
                                    'data-slide-unit',
                                    'px',
                                ],
                                [
                                    'data-live-preview',
                                    '.wpc_item_spacing, .includethis. .is-correct|height|px !important',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        'xtra-class',
                    ],
                ],
                'advanced-panel' => [],
            ],
        ],
        'singleTitle'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title Text', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Type', 'page-builder-wp' ),
                            'name'        => 'type',
                            'default'     => 'h2',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'h1',
                                    'H1',
                                ],
                                [
                                    'h2',
                                    'H2',
                                ],
                                [
                                    'h3',
                                    'H3',
                                ],
                                [
                                    'h4',
                                    'H4',
                                ],
                                [
                                    'h5',
                                    'H5',
                                ],
                                [
                                    'h6',
                                    'H6',
                                ],
                                [
                                    'div',
                                    'DIV',
                                ],
                                [
                                    'span',
                                    'Span',
                                ],
                                [
                                    'p',
                                    'P',
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-single-title.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeIcon'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => 'fa fa-magic',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-icon.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeMaps'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Map Location', 'page-builder-wp' ),
                            'name'        => 'map_url',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-number',
                            'label'       => esc_html__( 'Map Height', 'page-builder-wp' ),
                            'name'        => 'map_height',
                            'default'     => 350,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Zoom Level', 'page-builder-wp' ),
                            'name'        => 'map_zoom_level',
                            'default'     => 18,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    0,
                                ],
                                [
                                    'data-slide-max',
                                    18,
                                ],
                                [
                                    'data-slide-unit',
                                    'x',
                                ],
                            ],
                            'desc'        => esc_html__( 'The initial resolution at which to display the map. Zoom 0 corresponds to a map of the Earth fully zoomed out, and larger zoom levels zoom in at a higher resolution', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Custom Marker?', 'page-builder-wp' ),
                            'name'        => 'map_custom_marker',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Marker Template', 'page-builder-wp' ),
                            'name'        => 'map_marker_template',
                            'default'     => 'style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'style_01',
                                    'maps_tpl_01',
                                    '/preview/maps/style_01.png',
                                ],
                                [
                                    'style_02',
                                    'maps_tpl_02',
                                    '/preview/maps/style_02.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Marker Title', 'page-builder-wp' ),
                            'name'        => 'map_marker_title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Marker Description', 'page-builder-wp' ),
                            'name'        => 'map_marker_desc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Marker Image', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'map-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear as your maps marker', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-maps.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeFBPost'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Facebook User ID', 'page-builder-wp' ),
                            'name'        => 'fb_user_id',
                            'default'     => null,
                            'custom_css'  => [ [ 'this', 'wpc_disabled_input' ] ],
                            'custom_data' => [
                                [
                                    'readonly',
                                    'readonly',
                                ],
                            ],
                            'desc'        => esc_html__( 'This field will be filled in automatically after you authorize our App', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Facebook Access Token', 'page-builder-wp' ),
                            'name'        => 'fb_access_token',
                            'default'     => null,
                            'custom_css'  => [ [ 'this', 'wpc_disabled_input' ] ],
                            'custom_data' => [
                                [
                                    'readonly',
                                    'readonly',
                                ],
                                [
                                    'data-scope',
                                    'user_posts',
                                ],
                            ],
                            'desc'        => esc_html__( 'This field will be filled in automatically after you authorize our App', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Display Type', 'page-builder-wp' ),
                            'name'        => 'fb_display_type',
                            'default'     => 'masonry',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'list',
                                    'List',
                                ],
                                [
                                    'masonry',
                                    'Masonry',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Column Number', 'page-builder-wp' ),
                            'name'        => 'fb_col',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    6,
                                ],
                            ],
                            'desc'        => esc_html__( 'Number of columns for grid/masonry', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of posts', 'page-builder-wp' ),
                            'name'        => 'fb_num_post',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    50,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number of posts displayed', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of words per post', 'page-builder-wp' ),
                            'name'        => 'fb_num_words',
                            'default'     => 25,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    200,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number of words in each facebook post, for example: 25. Leave this field empty to show the full post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Image?', 'page-builder-wp' ),
                            'name'        => 'fb_post_img',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show featured image of the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Like Count?', 'page-builder-wp' ),
                            'name'        => 'fb_post_like',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show the Like count link in the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Comment Count?', 'page-builder-wp' ),
                            'name'        => 'fb_post_comment_count',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show Comment count link in the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Time?', 'page-builder-wp' ),
                            'name'        => 'fb_post_time',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show how long it was since a post was published', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-facebook-post.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeFBPageFeed'    => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Facebook User ID', 'page-builder-wp' ),
                            'name'        => 'fb_user_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                                [
                                    'this',
                                    'wpc_disabled_input',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'readonly',
                                    'readonly',
                                ],
                            ],
                            'desc'        => esc_html__( 'This field will be filled in automatically after you authorize our App', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Facebook Access Token', 'page-builder-wp' ),
                            'name'        => 'fb_access_token',
                            'default'     => null,
                            'custom_css'  => [ [ 'this', 'wpc_disabled_input' ] ],
                            'custom_data' => [
                                [
                                    'readonly',
                                    'readonly',
                                ],
                                [
                                    'data-scope',
                                    'pages_read_user_content, pages_read_engagement',
                                ],
                            ],
                            'desc'        => esc_html__( 'This field will be filled in automatically after you authorize our App', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-grab-page',
                            'label'       => esc_html__( 'Pages', 'page-builder-wp' ),
                            'name'        => 'fb_page_id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'Select Pages', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Page List', 'page-builder-wp' ),
                            'name'        => 'fb_pages',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This field will be filled in automatically after you authorize our App', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Display Type', 'page-builder-wp' ),
                            'name'        => 'fb_display_type',
                            'default'     => 'masonry',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'list',
                                    'List',
                                ],
                                [
                                    'masonry',
                                    'Masonry',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Column Number', 'page-builder-wp' ),
                            'name'        => 'fb_col',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    6,
                                ],
                            ],
                            'desc'        => esc_html__( 'Number of columns for grid/masonry', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of posts', 'page-builder-wp' ),
                            'name'        => 'fb_num_post',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    50,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number of posts displayed', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of words per post', 'page-builder-wp' ),
                            'name'        => 'fb_num_words',
                            'default'     => 25,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    200,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number of words in each facebook post, for example: 25. Leave this field empty to show the full post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Image?', 'page-builder-wp' ),
                            'name'        => 'fb_post_img',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show featured image of the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Like Count?', 'page-builder-wp' ),
                            'name'        => 'fb_post_like',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show the Like count link in the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Comment Count?', 'page-builder-wp' ),
                            'name'        => 'fb_post_comment_count',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show Comment count link in the Facebook post', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Time?', 'page-builder-wp' ),
                            'name'        => 'fb_post_time',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Show how long it was since a post was published', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-facebook-page-feed.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeButton'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Text', 'page-builder-wp' ),
                            'name'        => 'btn_text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'placeholder',
                                    esc_attr__( 'My Button Text', 'page-builder-wp' ),
                                ],
                                [
                                    'style',
                                    'width: 50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'This text will appears on the button.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear before or after your button. You can set the icon position using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Position', 'page-builder-wp' ),
                            'name'        => 'position',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'on Click Link to', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when the button clicked', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-button.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeVideoPlayer'   => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Video Link', 'page-builder-wp' ),
                            'name'        => 'vid_url',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter your video URL in field above. For example: https://www.youtube.com/watch?v=j6PbonHsqW0', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Video Fullwidth', 'page-builder-wp' ),
                            'name'        => 'fullwidth',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Stretch the video to fit the content width', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Video Width', 'page-builder-wp' ),
                            'name'        => 'video-width',
                            'default'     => 640,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Video Height', 'page-builder-wp' ),
                            'name'        => 'video-height',
                            'default'     => 360,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Video Autoplay', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Note: This feature only work for YouTube, Vimeo and MP4', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Video Poster', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => esc_html__( 'Note: This feature only work for YouTube, Vimeo and MP4', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-video-player.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'youtubeGallery'    => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'    => [
                    'defaultvalue' => [
                        [
                            'url'       => 'https://www.youtube.com/watch?v=1y_kfWUCFDQ',
                            'thumb_ver' => 'mqdefault',
                        ],
                        [
                            'url'       => 'https://www.youtube.com/watch?v=D0a0aNqTehM',
                            'thumb_ver' => 'mqdefault',
                        ],
                        [
                            'url'       => 'https://www.youtube.com/watch?v=5oGyBXv6_eg',
                            'thumb_ver' => 'mqdefault',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Video URL', 'page-builder-wp' ),
                            'name'        => 'url',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Thumbnails Version', 'page-builder-wp' ),
                            'name'        => 'thumb_ver',
                            'default'     => 'mqdefault',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'YouTube offers several thumbnail versions you can use instead', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'mqdefault',
                                    esc_html__( 'Default', 'page-builder-wp' ),
                                ],
                                [
                                    '0',
                                    esc_html__( 'Version 1', 'page-builder-wp' ),
                                ],
                                [
                                    '1',
                                    esc_html__( 'Version 2', 'page-builder-wp' ),
                                ],
                                [
                                    '2',
                                    esc_html__( 'Version 3', 'page-builder-wp' ),
                                ],
                                [
                                    '3',
                                    esc_html__( 'Version 4', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Video Gallery Columns', 'page-builder-wp' ),
                            'name'        => 'vid_col',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    6,
                                ],
                            ],
                            'desc'        => esc_html__( 'By default, show 3 columns of video thumbnails', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Autoplay?', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the video will automatically plays when site loaded', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'advanced-panel' => [],
            ],
        ],
        'socialLink'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'    => [
                    'defaultvalue' => [
                        [
                            'sc_type' => 'facebook',
                            'sc_link' => 'https://www.facebook.com/ghozylabinc',
                        ],
                        [
                            'sc_type' => 'twitter',
                            'sc_link' => 'https://twitter.com/ghozylab',
                        ],
                        [
                            'sc_type' => 'instagram',
                            'sc_link' => 'https://www.instagram.com/ghozylab',
                        ],
                        [
                            'sc_type' => 'youtube',
                            'sc_link' => 'https://www.youtube.com/user/GhozyLab',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Social Media', 'page-builder-wp' ),
                            'name'        => 'sc_type',
                            'default'     => 'facebook',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select available social media', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'facebook',
                                    esc_html__( 'Facebook', 'page-builder-wp' ),
                                ],
                                [
                                    'twitter',
                                    esc_html__( 'Twitter', 'page-builder-wp' ),
                                ],
                                [
                                    'instagram',
                                    esc_html__( 'Instagram', 'page-builder-wp' ),
                                ],
                                [
                                    'youtube',
                                    esc_html__( 'YouTube', 'page-builder-wp' ),
                                ],
                                [
                                    'google-plus',
                                    esc_html__( 'Google+', 'page-builder-wp' ),
                                ],
                                [
                                    'linkedin',
                                    esc_html__( 'LinkedIn', 'page-builder-wp' ),
                                ],
                                [
                                    'pinterest-p',
                                    esc_html__( 'Pinterest', 'page-builder-wp' ),
                                ],
                                [
                                    'wordpress',
                                    esc_html__( 'WordPress', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'LINK', 'page-builder-wp' ),
                            'name'        => 'sc_link',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'sc_link_field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        'xtra-class',
                    ],
                ],
                'style-panel'    => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-social-link.php' ),
                'advanced-panel' => [],
            ],
        ],
        'links'             => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'title'  => 'About us',
                            'link'   => 'https://ghozylab.com/plugins/about/',
                            'target' => '_blank',
                        ],
                        [
                            'title'  => 'Contact us',
                            'link'   => 'https://ghozylab.com/plugins/submit-support-request/',
                            'target' => '_blank',
                        ],
                        [
                            'title'  => 'Privacy policy',
                            'link'   => 'https://ghozylab.com/plugins/privacy-policy/',
                            'target' => '_blank',
                        ],
                        [
                            'title'  => 'Terms & Conditions',
                            'link'   => 'https://ghozylab.com/plugins/terms-conditions/',
                            'target' => '_blank',
                        ],
                        [
                            'title'  => 'Affiliate Program',
                            'link'   => 'https://ghozylab.com/plugins/affiliate-program/',
                            'target' => '_blank',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'              => 'field-text',
                            'label'             => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'              => 'title',
                            'default'           => null,
                            'frontend_selector' => 'a.wpc_link_each',
                            'custom_css'        => [
                                [
                                    'self',
                                    'sc_link_field',
                                ],
                            ],
                            'custom_data'       => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'              => esc_html__( 'Just type "none" to hide the field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'URL', 'page-builder-wp' ),
                            'name'        => 'link',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'sc_link_field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Link Target', 'page-builder-wp' ),
                            'name'        => 'target',
                            'default'     => '_blank',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    '_self',
                                    esc_html__( 'Same Window', 'page-builder-wp' ),
                                ],
                                [
                                    '_blank',
                                    esc_html__( 'New Window', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Links Title', 'page-builder-wp' ),
                            'name'        => 'link_title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter text used as links title (Note: located above content item).', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-links.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeInstagram'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Access token', 'page-builder-wp' ),
                            'name'        => 'token',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Click button bellow to generate your Instagram Access Token', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of Items', 'page-builder-wp' ),
                            'name'        => 'photo_number',
                            'default'     => 6,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    15,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the number of items ( image or video ) displayed on first load', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Number of Columns', 'page-builder-wp' ),
                            'name'        => 'col_number',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    '1',
                                    '1',
                                ],
                                [
                                    '2',
                                    '2',
                                ],
                                [
                                    '3',
                                    '3',
                                ],
                                [
                                    '4',
                                    '4',
                                ],
                                [
                                    '5',
                                    '5',
                                ],
                                [
                                    '6',
                                    '6',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image / Video Resolution', 'page-builder-wp' ),
                            'name'        => 'resolution',
                            'default'     => 'standard_resolution',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'low_resolution',
                                    esc_html__( 'Low Resolution', 'page-builder-wp' ),
                                ],
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'standard_resolution',
                                    esc_html__( 'Standard Resolution', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Open media into Lightbox?', 'page-builder-wp' ),
                            'name'        => 'in_lightbox',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If Enable, Any click on your Instagram images will opened in lightbox', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Profile Picture', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'ig-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => esc_html__( 'This image will show in the media footer', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Load More Button Text', 'page-builder-wp' ),
                            'name'        => 'loadmore_text',
                            'default'     => esc_html__( 'Load More', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on button load more feed', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-instagram.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeTwitter'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Username', 'page-builder-wp' ),
                            'name'        => 'username',
                            'default'     => 'natgeowild',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of Tweets', 'page-builder-wp' ),
                            'name'        => 'tweets_number',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    20,
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Theme', 'page-builder-wp' ),
                            'name'        => 'twitter_theme',
                            'default'     => 'light',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'light',
                                    esc_html__( 'Light', 'page-builder-wp' ),
                                ],
                                [
                                    'dark',
                                    esc_html__( 'Dark', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Header?', 'page-builder-wp' ),
                            'name'        => 'show_header',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Footer?', 'page-builder-wp' ),
                            'name'        => 'show_footer',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Border?', 'page-builder-wp' ),
                            'name'        => 'show_border',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Background?', 'page-builder-wp' ),
                            'name'        => 'show_background',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Display Maximum Width', 'page-builder-wp' ),
                            'name'        => 'maxwidth',
                            'default'     => 1000,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-step',
                                    1,
                                ],
                                [
                                    'data-slide-min',
                                    300,
                                ],
                                [
                                    'data-slide-max',
                                    1200,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the maximum width of the widget. Must be between 300 and 1200 inclusive', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeCTA'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Select Template', 'page-builder-wp' ),
                            'name'        => 'template',
                            'default'     => 'cta_style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'cta_style_01',
                                    'cta_bg_01',
                                    '/preview/cta/style_01.png',
                                ],
                                [
                                    'cta_style_02',
                                    'cta_bg_02',
                                    '/preview/cta/style_02.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter your Call to Action title', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Description', 'page-builder-wp' ),
                            'name'        => 'desc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter your Call to Action description', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Text', 'page-builder-wp' ),
                            'name'        => 'btn-text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter text button', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'Button on Click URL', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when the button clicked', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Button Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear before or after your button. You can set the icon position using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Position', 'page-builder-wp' ),
                            'name'        => 'position',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-call-to-action.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeSeparator'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Separator Type', 'page-builder-wp' ),
                            'name'        => 'type',
                            'default'     => 'line',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'line',
                                    'Line',
                                ],
                                [
                                    'line-icon',
                                    'Line with Icon',
                                ],
                                [
                                    'line-text',
                                    'Line with Text',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear in center of the separator', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Separator Text', 'page-builder-wp' ),
                            'name'        => 'text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'This text will appear in center of the separator', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-separator.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typePricing'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Select Template', 'page-builder-wp' ),
                            'name'        => 'template',
                            'default'     => 'pc_style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'pc_style_01',
                                    'pcbox_bg_01',
                                    '/preview/pcbox/style_01.png',
                                ],
                                [
                                    'pc_style_02',
                                    'pcbox_bg_02',
                                    '/preview/pcbox/style_02.png',
                                ],
                                [
                                    'pc_style_03',
                                    'pcbox_bg_03',
                                    '/preview/pcbox/style_03.png',
                                ],
                                [
                                    'pc_style_04',
                                    'pcbox_bg_04',
                                    '/preview/pcbox/style_04.png',
                                ],
                                [
                                    'pc_style_05',
                                    'pcbox_bg_05',
                                    '/preview/pcbox/style_05.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Price', 'page-builder-wp' ),
                            'name'        => 'price',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Currency', 'page-builder-wp' ),
                            'name'        => 'currency',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Currency Position', 'page-builder-wp' ),
                            'name'        => 'currency_format',
                            'default'     => 'before',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'before',
                                    esc_html__( 'Before - 10', 'page-builder-wp' ),
                                ],
                                [
                                    'after',
                                    esc_html__( 'After - 10', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Per', 'page-builder-wp' ),
                            'name'        => 'price_per',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'placeholder',
                                    esc_attr__( 'For example : /Month', 'page-builder-wp' ),
                                ],
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Just type "none" to hide the field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Pricing Table Items', 'page-builder-wp' ),
                            'name'        => 'items',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter each item here and make sure to divide item with linebreaks (Enter).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Label', 'page-builder-wp' ),
                            'name'        => 'button_text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'Link Button', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when the button clicked', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-pricing-table.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'pricingList'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Media Type', 'page-builder-wp' ),
                            'name'        => 'media_type',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select the type media of your product', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'image',
                                    'Image',
                                ],
                                [
                                    'icon',
                                    'Icon',
                                ],
                                [
                                    'none',
                                    esc_html__( 'No Media', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Image', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'pricinglist-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Instagram-like Filters?', 'page-builder-wp' ),
                            'name'        => 'use_img_ig_filter',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, your can apply Instagram-like filters to your images easily', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-image-filters',
                            'label'       => esc_html__( 'Available Filters', 'page-builder-wp' ),
                            'name'        => 'img_ig_filters',
                            'default'     => 'hefe',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Force Image Size to Auto', 'page-builder-wp' ),
                            'name'        => 'img_width_type',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Default image size in CSS is 100%, but you can turn this ON if you face blur image even if you have used full image size', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'media_icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Description', 'page-builder-wp' ),
                            'name'        => 'desc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Price', 'page-builder-wp' ),
                            'name'        => 'price',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Set as Featured', 'page-builder-wp' ),
                            'name'        => 'is_featured',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, the featured badge will appear near the product title', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-pricing-list.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'alertBox'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Message Text', 'page-builder-wp' ),
                            'name'        => 'text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'height:110px;',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Position', 'page-builder-wp' ),
                            'name'        => 'position',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-alert-box.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'testimonial'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Image Avatar', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'tst-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Avatar size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Instagram-like Filters?', 'page-builder-wp' ),
                            'name'        => 'use_img_ig_filter',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, your can apply Instagram-like filters to your images easily', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-image-filters',
                            'label'       => esc_html__( 'Available Filters', 'page-builder-wp' ),
                            'name'        => 'img_ig_filters',
                            'default'     => 'hefe',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,

                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Testimonial', 'page-builder-wp' ),
                            'name'        => 'testitext',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Just type "none" to hide the description field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Miscellaneous Info', 'page-builder-wp' ),
                            'name'        => 'misc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'You can use this field to display any information, for example your site URL. Just type "none" to hide the field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Star Rating', 'page-builder-wp' ),
                            'name'        => 'star_rating',
                            'default'     => '5',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set testimonial star rating', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'hide',
                                    esc_html__( 'Hide', 'page-builder-wp' ),
                                ],
                                [
                                    '1',
                                    esc_html__( '1 star', 'page-builder-wp' ),
                                ],
                                [
                                    '2',
                                    esc_html__( '2 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '3',
                                    esc_html__( '3 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '4',
                                    esc_html__( '4 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '5',
                                    esc_html__( '5 Stars', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-testimonial.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'testimonialSlider' => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'testimonial' => 'WP Composer transformed my website design experience! It\'s incredibly user-friendly, and I created a stunning site in no time. 5 stars!',
                            'name'        => 'Sarah M',
                            'star'        => '5',
                        ],
                        [
                            'testimonial' => 'WP Composer is a game-changer! With its intuitive interface, I effortlessly built a professional website. Highly recommend this WordPress plugin!',
                            'name'        => 'John D',
                            'star'        => '5',
                        ],
                        [
                            'testimonial' => 'WP Composer is pure magic! Building my website was a breeze, thanks to its powerful features. It\'s a must-have for anyone using WordPress',
                            'name'        => 'Alex R',
                            'star'        => '5',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'              => 'field-texteditor',
                            'label'             => esc_html__( 'Testimonial', 'page-builder-wp' ),
                            'name'              => 'testimonial',
                            'frontend_selector' => '.testi_testimonial',
                            'default'           => null,
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'              => 'field-text',
                            'label'             => esc_html__( 'Name', 'page-builder-wp' ),
                            'name'              => 'name',
                            'frontend_selector' => '.testi_name',
                            'default'           => null,
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Star Rating', 'page-builder-wp' ),
                            'name'        => 'star',
                            'default'     => '5',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set testimonial star rating', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    '1',
                                    esc_html__( '1 star', 'page-builder-wp' ),
                                ],
                                [
                                    '2',
                                    esc_html__( '2 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '3',
                                    esc_html__( '3 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '4',
                                    esc_html__( '4 Stars', 'page-builder-wp' ),
                                ],
                                [
                                    '5',
                                    esc_html__( '5 Stars', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Slide Delay', 'page-builder-wp' ),
                            'name'        => 'delay',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    15,
                                ],
                            ],
                            'desc'        => esc_html__( 'The delay time before moving on to a new slide', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Slide Auto Play', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the carousel automatically plays when site loaded', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-testimonial-slider.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'productBox'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Product Image', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'prdctbox-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Instagram-like Filters?', 'page-builder-wp' ),
                            'name'        => 'use_img_ig_filter',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, your can apply Instagram-like filters to your images easily', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-image-filters',
                            'label'       => esc_html__( 'Available Filters', 'page-builder-wp' ),
                            'name'        => 'img_ig_filters',
                            'default'     => 'hefe',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Product Name', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => null,

                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Description', 'page-builder-wp' ),
                            'name'        => 'productdesc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Just type "none" to hide the description field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Miscellaneous Info', 'page-builder-wp' ),
                            'name'        => 'misc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'You can use this field to display any information, for example your site URL. Just type "none" to hide the field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Text', 'page-builder-wp' ),
                            'name'        => 'btn_text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'placeholder',
                                    esc_attr__( 'My Button Text', 'page-builder-wp' ),
                                ],
                                [
                                    'style',
                                    'width: 50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'This text will appears on the button.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear before or after your button. You can set the icon position using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Position', 'page-builder-wp' ),
                            'name'        => 'position',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'on Click Link to', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when the button clicked', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-product-box.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'featureBox'        => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Select Template', 'page-builder-wp' ),
                            'name'        => 'template',
                            'default'     => 'fbox_style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'fbox_style_01',
                                    'fbox_bg_01',
                                    '/preview/fbox/style_01.png',
                                ],
                                [
                                    'fbox_style_02',
                                    'fbox_bg_02',
                                    '/preview/fbox/style_02.png',
                                ],
                                [
                                    'fbox_style_03',
                                    'fbox_bg_03',
                                    '/preview/fbox/style_03.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Media Type', 'page-builder-wp' ),
                            'name'        => 'media_type',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select feature box media type', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'image',
                                    'Image',
                                ],
                                [
                                    'icon',
                                    'Icon',
                                ],
                                [
                                    'none',
                                    esc_html__( 'No Media', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Feature Box Image', 'page-builder-wp' ),
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'frtrdbox-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Image size', 'page-builder-wp' ),
                            'name'        => 'size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    esc_html__( 'Thumbnail', 'page-builder-wp' ),
                                ],
                                [
                                    'medium',
                                    esc_html__( 'Medium', 'page-builder-wp' ),
                                ],
                                [
                                    'large',
                                    esc_html__( 'Large', 'page-builder-wp' ),
                                ],
                                [
                                    'full',
                                    esc_html__( 'Full', 'page-builder-wp' ),
                                ],
                                [
                                    'custom',
                                    esc_html__( 'Custom Size', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Custom Size', 'page-builder-wp' ),
                            'name'        => 'custom_size',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'Separate image Height and Width with x. For example 250x250', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Instagram-like Filters?', 'page-builder-wp' ),
                            'name'        => 'use_img_ig_filter',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, your can apply Instagram-like filters to your images easily', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-image-filters',
                            'label'       => esc_html__( 'Available Filters', 'page-builder-wp' ),
                            'name'        => 'img_ig_filters',
                            'default'     => 'hefe',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Force Image Size to Auto', 'page-builder-wp' ),
                            'name'        => 'feature_box_img_width_type',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Default image size in CSS is 100%, but you can turn this ON if you face blur image even if you have used full image size', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'featured_icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Just type "none" to hide the field', 'page-builder-wp' ),

                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Description', 'page-builder-wp' ),
                            'name'        => 'featuredesc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Just type "none" to hide the description field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Miscellaneous Info', 'page-builder-wp' ),
                            'name'        => 'misc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'You can use this field to display any information, for example your site URL. Just type "none" to hide the field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Button?', 'page-builder-wp' ),
                            'name'        => 'feature_box_btn',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Text', 'page-builder-wp' ),
                            'name'        => 'btn_text',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'placeholder',
                                    esc_attr__( 'My Button Text', 'page-builder-wp' ),
                                ],
                                [
                                    'style',
                                    'width: 50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'This text will appears on the button.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear before or after your button. You can set the icon position using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Position', 'page-builder-wp' ),
                            'name'        => 'position',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'on Click Link to', 'page-builder-wp' ),
                            'name'        => 'the_link',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when the button clicked', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Social Icon?', 'page-builder-wp' ),
                            'name'        => 'feature_box_social_link',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Facebook URL', 'page-builder-wp' ),
                            'name'        => 'feature_box_sc_facebook',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Twitter URL', 'page-builder-wp' ),
                            'name'        => 'feature_box_sc_twitter',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Instagram URL', 'page-builder-wp' ),
                            'name'        => 'feature_box_sc_instagram',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Google+ URL', 'page-builder-wp' ),
                            'name'        => 'feature_box_sc_google-plus',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'YouTube URL', 'page-builder-wp' ),
                            'name'        => 'feature_box_sc_youtube',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-feature-box.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeTimeline'      => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'timeline_title'       => 'My First Timeline',
                            'timeline_content'     => 'Cherish your visions and your dreams as they are the children of your soul, the blueprints of your ultimate achievements.',
                            'timeline_date'        => '2001-02-20',
                            'timeline_circle_icon' => 'fa fa-wordpress',
                        ],
                        [
                            'timeline_title'       => 'My Second Timeline',
                            'timeline_content'     => 'Whatever the mind of man can conceive and believe, it can achieve. Thoughts are things!',
                            'timeline_date'        => '2007-15-04',
                            'timeline_circle_icon' => 'fa fa-code',
                        ],
                        [
                            'timeline_title'       => 'My Third Timeline',
                            'timeline_content'     => 'Strong, deeply rooted desire is the starting point of all achievement.',
                            'timeline_date'        => '2011-11-09',
                            'timeline_circle_icon' => 'fa fa-plug',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'              => 'field-text',
                            'label'             => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'              => 'timeline_title',
                            'frontend_selector' => '.wpc_timeline_title',
                            'default'           => null,
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'              => 'field-texteditor',
                            'label'             => esc_html__( 'Content', 'page-builder-wp' ),
                            'name'              => 'timeline_content',
                            'default'           => null,
                            'frontend_selector' => '.wpc_timeline_content',
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'              => 'field-date',
                            'label'             => esc_html__( 'Date', 'page-builder-wp' ),
                            'name'              => 'timeline_date',
                            'default'           => null,
                            'frontend_selector' => '.wpc_timeline_date',
                            'custom_css'        => null,
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Circle Icon', 'page-builder-wp' ),
                            'name'        => 'timeline_circle_icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Timeline Layout', 'page-builder-wp' ),
                            'name'        => 'timeline_layout',
                            'default'     => 'center',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'center',
                                    'Center',
                                ],
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Timeline Date Position', 'page-builder-wp' ),
                            'name'        => 'timeline_date_pos',
                            'default'     => 'outside',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'outside',
                                    'Outside of Content Box',
                                ],
                                [
                                    'inside',
                                    'Inside of Content Box',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Animation', 'page-builder-wp' ),
                            'name'        => 'timeline_animation',
                            'default'     => 'bounce_02',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'bounce_01',
                                    'Bounce 1',
                                ],
                                [
                                    'bounce_02',
                                    'Bounce 2',
                                ],
                                [
                                    'none',
                                    'Disable',
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-timeline.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeEventCalendar' => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'event_title'       => 'IT Seminar',
                            'event_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'event_all_day'     => 'no',
                            'event_start_date'  => gmdate( 'Y-m-d' ).' 10:00:00',
                            'event_end_date'    => gmdate( 'Y-m-d', strtotime( '+3 days' ) ).' 17:00:00',
                            'event_color'       => '#35c700',
                        ],
                        [
                            'event_title'       => 'I/O Extended',
                            'event_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'event_all_day'     => 'no',
                            'event_start_date'  => gmdate( 'Y-m-d', strtotime( '+2 days' ) ).' 10:00:00',
                            'event_end_date'    => gmdate( 'Y-m-d', strtotime( '+2 days' ) ).' 12:00:00',
                            'event_color'       => '#fa3d3d',
                        ],
                        [
                            'event_title'       => 'Coding Club',
                            'event_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'event_all_day'     => 'yes',
                            'event_start_date'  => gmdate( 'Y-m-d', strtotime( '+5 days' ) ),
                            'event_end_date'    => gmdate( 'Y-m-d', strtotime( '+7 days' ) ),
                            'event_color'       => '#3788d8',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'event_title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-texteditor',
                            'label'       => esc_html__( 'Content', 'page-builder-wp' ),
                            'name'        => 'event_description',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'All Day?', 'page-builder-wp' ),
                            'name'        => 'event_all_day',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You can set the event all day without specific time', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-date',
                            'label'       => esc_html__( 'Start Date', 'page-builder-wp' ),
                            'name'        => 'event_start_date',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'date_custom_init',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-format',
                                    'dateTime',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-date',
                            'label'       => esc_html__( 'End Date', 'page-builder-wp' ),
                            'name'        => 'event_end_date',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'date_custom_init',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-format',
                                    'dateTime',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-color',
                            'label'       => esc_html__( 'Event Color', 'page-builder-wp' ),
                            'name'        => 'event_color',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Source', 'page-builder-wp' ),
                            'name'        => 'event_source',
                            'default'     => 'manual',
                            'custom_css'  => [
                                [
                                    'this',
                                    'event_source_selector',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'manual',
                                    'Manual',
                                ],
                                [
                                    'google_calendar',
                                    'Google Calendar',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Google Calendar API Key', 'page-builder-wp' ),
                            'name'        => 'event_google_calendar_apikey',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Google Calendar ID', 'page-builder-wp' ),
                            'name'        => 'event_google_calendar_id',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You can use multiple id separated by comma', 'page-builder-wp' ),
                        ],
                        /* array(
                        'type'        => 'field-select',
                        'label'       => esc_html__( 'Calendar Themes', 'page-builder-wp' ),
                        'name'        => 'event_themes',
                        'default'     => 'default',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'desc'        => null,
                        'choices'     => wpc_generate_event_calendar_themes(),
                        ), */
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Locales?', 'page-builder-wp' ),
                            'name'        => 'event_show_locales',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You can tailor the event calendar for certain languages', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Title?', 'page-builder-wp' ),
                            'name'        => 'event_show_title',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Business Hours?', 'page-builder-wp' ),
                            'name'        => 'event_show_businesshours',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-event-calendar.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeList'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'list_content' => 'Cherish your visions and your dreams as they are the children of your soul, the blueprints of your ultimate achievements.',
                            'icon'         => 'fa fa-chevron-circle-right',
                        ],
                        [
                            'list_content' => 'Whatever the mind of man can conceive and believe, it can achieve. Thoughts are things!',
                            'icon'         => 'fa fa-chevron-circle-right',
                        ],
                        [
                            'list_content' => 'Strong, deeply rooted desire is the starting point of all achievement.',
                            'icon'         => 'fa fa-chevron-circle-right',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'              => 'field-texteditor',
                            'label'             => esc_html__( 'Text', 'page-builder-wp' ),
                            'name'              => 'list_content',
                            'default'           => null,
                            'frontend_selector' => '.wpc_list_text',
                            'custom_css'        => [
                                [
                                    'self',
                                    'list-text-editor',
                                ],
                            ],
                            'custom_data'       => null,
                            'desc'              => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'List Shapes', 'page-builder-wp' ),
                            'name'        => 'list_shape',
                            'default'     => 'list_shape_circle',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'list_shape_icon',
                                    'Custom Icon',
                                ],
                                [
                                    'list_shape_circle',
                                    'Circle (with number)',
                                ],
                                [
                                    'list_shape_square',
                                    'Square (with number)',
                                ],
                                [
                                    'list_shape_triangle',
                                    'Triangle (with number)',
                                ],
                                [
                                    'list_shape_pentagon',
                                    'Pentagon (with number)',
                                ],
                                [
                                    'list_shape_hexagon',
                                    'Hexagon (with number)',
                                ],
                                [
                                    'list_shape_octagon',
                                    'Octagon (with number)',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'List Line Position', 'page-builder-wp' ),
                            'name'        => 'list_line_pos',
                            'default'     => 'top',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'top',
                                    'Top',
                                ],
                                [
                                    'bottom',
                                    'Bottom',
                                ],
                                [
                                    'no',
                                    'Disable (No List)',
                                ],
                            ],
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-list.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'counterUp'         => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Select Template', 'page-builder-wp' ),
                            'name'        => 'template',
                            'default'     => 'cup_style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'cup_style_01',
                                    'cup_bg_01',
                                    '/preview/cup/style_01.png',
                                ],
                                [
                                    'cup_style_02',
                                    'cup_bg_02',
                                    '/preview/cup/style_02.png',
                                ],
                                [
                                    'cup_style_03',
                                    'cup_bg_03',
                                    '/preview/cup/style_03.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Targeted number', 'page-builder-wp' ),
                            'name'        => 'count_to',
                            'default'     => 100,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'The targeted number to count up to (From zero to x). It supports counting up integers (ex: 110), floats (ex: 0.1234) or formatted numbers (ex: 1,234,567.00)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Number Suffix', 'page-builder-wp' ),
                            'name'        => 'count_to_suffix',
                            'default'     => 'k',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:25%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'It can be units number, length, &#37; or any text you need', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label', 'page-builder-wp' ),
                            'name'        => 'label',
                            'default'     => esc_html__( 'Download', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'style',
                                    'width:50%;',
                                ],
                            ],
                            'desc'        => esc_html__( 'The text description of the counter', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Icon?', 'page-builder-wp' ),
                            'name'        => 'cup_icon',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => 'fa fa-download',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This icon will appear before the number', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-counter-up.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'htmlRAW'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-code-editor',
                            'label'       => esc_html__( 'Raw HTML', 'page-builder-wp' ),
                            'name'        => 'code',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-mode',
                                    'htmlmixed',
                                ],
                            ],
                            'desc'        => null,
                        ],
                    ],
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],

        'imageComparison'   => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Image Before', 'page-builder-wp' ),
                            'name'        => 'img_before',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => esc_html__( 'Image After', 'page-builder-wp' ),
                            'name'        => 'img_after',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Orientation', 'page-builder-wp' ),
                            'name'        => 'orientation',
                            'default'     => 'horizontal',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'horizontal',
                                    'Horizontal',
                                ],
                                [
                                    'vertical',
                                    'Vertical',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Offset', 'page-builder-wp' ),
                            'name'        => 'offset',
                            'default'     => 2,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-step',
                                    1,
                                ],
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'How far from the left the slider should be by default', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Overlay?', 'page-builder-wp' ),
                            'name'        => 'overlay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Before Label', 'page-builder-wp' ),
                            'name'        => 'before_label',
                            'default'     => esc_html__( 'Before', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'After Label', 'page-builder-wp' ),
                            'name'        => 'after_label',
                            'default'     => esc_html__( 'After', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typePBAR'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'label' => 'Development',
                            'value' => 90,
                        ],
                        [
                            'label' => 'Design',
                            'value' => 80,
                        ],
                        [
                            'label' => 'Marketing',
                            'value' => 70,
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label', 'page-builder-wp' ),
                            'name'        => 'label',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'pbar-label',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-selector',
                                    '.wpc_bar_label',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Value', 'page-builder-wp' ),
                            'name'        => 'value',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    100,
                                ],
                            ],
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Style', 'page-builder-wp' ),
                            'name'        => 'style',
                            'default'     => 'animated striped',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'wpc_pb_default',
                                    'Default',
                                ],
                                [
                                    'striped',
                                    'With Stripes Style',
                                ],
                                [
                                    'animated striped',
                                    'With Stripes Animation',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Units', 'page-builder-wp' ),
                            'name'        => 'units',
                            'default'     => '%',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Label Position', 'page-builder-wp' ),
                            'name'        => 'label_pos',
                            'default'     => 'middle',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'middle',
                                    'Middle',
                                ],
                                [
                                    'top',
                                    'Top',
                                ],
                            ],
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-progress-bar.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeTAB'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'  => [
                    'fields' => [
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Tabs Style', 'page-builder-wp' ),
                            'name'        => 'tabstyle',
                            'default'     => 'horizontal',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'horizontal',
                                    'Horizontal Tabs',
                                ],
                                [
                                    'vertical',
                                    'Vertical Tabs',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Horizontal Tab Alignment', 'page-builder-wp' ),
                            'name'        => 'horizontal-align',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'center',
                                    'Center',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Vertical Tab Position', 'page-builder-wp' ),
                            'name'        => 'vertical-pos',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Default Tab', 'page-builder-wp' ),
                            'name'        => 'default',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => [
                                [
                                    'none',
                                    'None',
                                ],
                            ],
                            'desc'        => esc_html__( 'The active tab will automatically selected when site loaded', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'    => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-tab.php' ),
                'advanced-panel' => [],
            ],
        ],
        'tabsEDITOR'        => [
            'tabs'     => [
                'TAB EDITOR',
            ],
            'template' => [
                'tab-editor' => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'ID', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'ID', 'page-builder-wp' ),
                            'name'        => 'fancy_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '[name=fancy_id]',
                                    'is-disabled_ready_copy',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'tabeditor',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-tabs-type',
                                    'typetabs',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Icon?', 'page-builder-wp' ),
                            'name'        => 'use_icon',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Placement', 'page-builder-wp' ),
                            'name'        => 'icon_pos',
                            'default'     => 'before',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'before',
                                    'Before Title',
                                ],
                                [
                                    'after',
                                    'After Title',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'typeAccordion'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'  => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Accordion Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter accordion title (Note: It is located above the content)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Gap', 'page-builder-wp' ),
                            'name'        => 'gap',
                            'default'     => 0,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    35,
                                ],
                            ],
                            'desc'        => esc_html__( 'The gap between each accordion items', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Accordion Styles', 'page-builder-wp' ),
                            'name'        => 'acc_style',
                            'default'     => 'modern',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You cannot set the background of the accordion title if the style is set to Minimalist', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'modern',
                                    'Modern',
                                ],
                                [
                                    'minimalist',
                                    'Minimalist',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Navigation Position', 'page-builder-wp' ),
                            'name'        => 'nav_pos',
                            'default'     => 'left',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select accordion navigation icon (+ icon) position', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'left',
                                    'Left',
                                ],
                                [
                                    'right',
                                    'Right',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Default Accordion Tab', 'page-builder-wp' ),
                            'name'        => 'default',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => [
                                [
                                    'none',
                                    'None',
                                ],
                            ],
                            'desc'        => esc_html__( 'The active accordion tab will automatically selected when site loaded', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'    => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-accordion.php' ),
                'advanced-panel' => [],
            ],
        ],
        'accordionsEDITOR'  => [
            'tabs'     => [
                'ACCORDION EDITOR',
            ],
            'template' => [
                'general-editor' => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'ID', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'ID', 'page-builder-wp' ),
                            'name'        => 'fancy_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '[name=fancy_id]',
                                    'is-disabled_ready_copy',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'tabeditor',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-tabs-type',
                                    'typeaccordion',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Icon?', 'page-builder-wp' ),
                            'name'        => 'use_icon',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-icon',
                            'label'       => esc_html__( 'Icon', 'page-builder-wp' ),
                            'name'        => 'icon',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Icon Placement', 'page-builder-wp' ),
                            'name'        => 'icon_pos',
                            'default'     => 'before',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'before',
                                    'Before Title',
                                ],
                                [
                                    'after',
                                    'After Title',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'typeRoundChart'    => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'label' => 'Sales',
                            'value' => 50,
                            'color' => '#5472D2',
                        ],
                        [
                            'label' => 'Members',
                            'value' => 80,
                            'color' => '#FE6C61',
                        ],
                        [
                            'label' => 'Downloads',
                            'value' => 110,
                            'color' => '#FFD430',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label', 'page-builder-wp' ),
                            'name'        => 'label',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'rchrt-label',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-selector',
                                    '.legend_title_block',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Value', 'page-builder-wp' ),
                            'name'        => 'value',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-color',
                            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
                            'name'        => 'color',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-live-editor',
                                    'typeroundchart',
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter text used as Round Chart title (Note: located above content item).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Chart Type', 'page-builder-wp' ),
                            'name'        => 'type',
                            'default'     => 'doughnut',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select type of chart', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'pie',
                                    'Pie',
                                ],
                                [
                                    'doughnut',
                                    'Doughnut',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Legend?', 'page-builder-wp' ),
                            'name'        => 'show_legend',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will have legend', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Hover Values?', 'page-builder-wp' ),
                            'name'        => 'show_hover_value',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will show values on hover', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'GAP', 'page-builder-wp' ),
                            'name'        => 'gap',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the Select gap size for each item', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-round-chart.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'typeLineChart'     => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'label' => 'Sales',
                            'value' => '10; 15; 20; 25; 27; 25; 23; 25',
                            'color' => '#5472D2',
                        ],
                        [
                            'label' => 'Downloads',
                            'value' => '25; 18; 16; 17; 20; 25; 30; 35',
                            'color' => '#FE6C61',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label', 'page-builder-wp' ),
                            'name'        => 'label',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'self',
                                    'lchrt-label',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-selector',
                                    '.legend_title_block',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Y-axis Values', 'page-builder-wp' ),
                            'name'        => 'value',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter values for axis ( Note: separate values with ; ).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-color',
                            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
                            'name'        => 'color',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-live-editor',
                                    'typelinechart',
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter text used as Line Chart title (Note: located above content item).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Chart Type', 'page-builder-wp' ),
                            'name'        => 'type',
                            'default'     => 'bar',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select type of chart', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'bar',
                                    'Bar',
                                ],
                                [
                                    'line',
                                    'Line',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'X-axis Values', 'page-builder-wp' ),
                            'name'        => 'x_axis',
                            'default'     => esc_html__( 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter values for axis ( Note: separate values with ; ).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Legend?', 'page-builder-wp' ),
                            'name'        => 'show_legend',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will have legend', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Hover Values?', 'page-builder-wp' ),
                            'name'        => 'show_hover_value',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will show values on hover', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show X gridLines?', 'page-builder-wp' ),
                            'name'        => 'x_gridline',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will have X to Y line for each item', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Y gridLines?', 'page-builder-wp' ),
                            'name'        => 'y_gridline',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, chart will have Y to X line for each item', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-line-chart.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'blog'              => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-post-type',
                            'label'       => esc_html__( 'Post Types', 'page-builder-wp' ),
                            'name'        => 'post_type',
                            'default'     => 'post',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select source for post carousel', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Order by', 'page-builder-wp' ),
                            'name'        => 'orderby',
                            'default'     => 'ID',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'ID',
                                    esc_html__( 'Post ID', 'page-builder-wp' ),
                                ],
                                [
                                    'author',
                                    esc_html__( 'Author', 'page-builder-wp' ),
                                ],
                                [
                                    'title',
                                    esc_html__( 'Title', 'page-builder-wp' ),
                                ],
                                [
                                    'name',
                                    esc_html__( 'Post name (post slug)', 'page-builder-wp' ),
                                ],
                                [
                                    'date',
                                    esc_html__( 'Date', 'page-builder-wp' ),
                                ],
                                [
                                    'modified',
                                    esc_html__( 'Last Modified Date', 'page-builder-wp' ),
                                ],
                                [
                                    'rand',
                                    esc_html__( 'Random Order', 'page-builder-wp' ),
                                ],
                                [
                                    'comment_count',
                                    esc_html__( 'Number of Comments', 'page-builder-wp' ),
                                ],
                                [
                                    'menu_order',
                                    esc_html__( 'Menu Order', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Sort Order', 'page-builder-wp' ),
                            'name'        => 'order',
                            'default'     => 'DESC',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'DESC',
                                    esc_html__( 'Descending (DESC)', 'page-builder-wp' ),
                                ],
                                [
                                    'ASC',
                                    esc_html__( 'Ascending (ASC)', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Total Post to Show', 'page-builder-wp' ),
                            'name'        => 'total_posts',
                            'default'     => 6,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    20,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the total number of posts to display, or you can set to 0 if you want to show all posts', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Specific Post/Page IDs (Optional)', 'page-builder-wp' ),
                            'name'        => 'posts_in',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter page/posts IDs to display only those records (Note: separate values by commas (,)). Use this field in conjunction with "Post types" field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Categories (Optional)', 'page-builder-wp' ),
                            'name'        => 'post_cats',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show thumbnail', 'page-builder-wp' ),
                            'name'        => 'is_thumb',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post thumbnail ( Featured Image ) will appear on each slider item', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Thumbnail size', 'page-builder-wp' ),
                            'name'        => 'thumb_size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    'Thumbnail',
                                ],
                                [
                                    'medium',
                                    'Medium',
                                ],
                                [
                                    'large',
                                    'Large',
                                ],
                                [
                                    'full',
                                    'Full',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Description ( Excerpt )', 'page-builder-wp' ),
                            'name'        => 'is_desc',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post content will appear on description field in Excerpt mode', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Post Description Length', 'page-builder-wp' ),
                            'name'        => 'desc_length',
                            'default'     => 30,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    10,
                                ],
                                [
                                    'data-slide-max',
                                    100,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number above will display your post description text up to x words. By default the number of words is 30.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Meta', 'page-builder-wp' ),
                            'name'        => 'is_postmeta',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post date and post author will displayed on bottom', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Read More Button', 'page-builder-wp' ),
                            'name'        => 'is_readmore',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the Read More Button will displayed on bottom', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Read More Label', 'page-builder-wp' ),
                            'name'        => 'readmore_label',
                            'default'     => esc_html__( 'Read More...', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Blog Columns', 'page-builder-wp' ),
                            'name'        => 'columns',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    6,
                                ],
                            ],
                            'desc'        => esc_html__( 'Number of columns for blog', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-blog.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'postCarousel'      => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-post-type',
                            'label'       => esc_html__( 'Post Types', 'page-builder-wp' ),
                            'name'        => 'post_type',
                            'default'     => 'post',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select source for post carousel', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Order by', 'page-builder-wp' ),
                            'name'        => 'orderby',
                            'default'     => 'ID',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'ID',
                                    esc_html__( 'Post ID', 'page-builder-wp' ),
                                ],
                                [
                                    'author',
                                    esc_html__( 'Author', 'page-builder-wp' ),
                                ],
                                [
                                    'title',
                                    esc_html__( 'Title', 'page-builder-wp' ),
                                ],
                                [
                                    'name',
                                    esc_html__( 'Post name (post slug)', 'page-builder-wp' ),
                                ],
                                [
                                    'date',
                                    esc_html__( 'Date', 'page-builder-wp' ),
                                ],
                                [
                                    'modified',
                                    esc_html__( 'Last Modified Date', 'page-builder-wp' ),
                                ],
                                [
                                    'rand',
                                    esc_html__( 'Random Order', 'page-builder-wp' ),
                                ],
                                [
                                    'comment_count',
                                    esc_html__( 'Number of Comments', 'page-builder-wp' ),
                                ],
                                [
                                    'menu_order',
                                    esc_html__( 'Menu Order', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Sort Order', 'page-builder-wp' ),
                            'name'        => 'order',
                            'default'     => 'DESC',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'DESC',
                                    esc_html__( 'Descending (DESC)', 'page-builder-wp' ),
                                ],
                                [
                                    'ASC',
                                    esc_html__( 'Ascending (ASC)', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Total Post to Show', 'page-builder-wp' ),
                            'name'        => 'total_posts',
                            'default'     => 6,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    20,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the total number of posts to display, or you can set to 0 if you want to show all posts', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Specific Post/Page IDs (Optional)', 'page-builder-wp' ),
                            'name'        => 'posts_in',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter page/posts IDs to display only those records (Note: separate values by commas (,)). Use this field in conjunction with "Post types" field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Categories (Optional)', 'page-builder-wp' ),
                            'name'        => 'post_cats',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter categories by names to narrow output (Note: only listed categories will be displayed, divide categories with linebreak (Enter)).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Posts per Slide', 'page-builder-wp' ),
                            'name'        => 'posts_per_page',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the number of posts displayed per slide', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show thumbnail', 'page-builder-wp' ),
                            'name'        => 'is_thumb',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post thumbnail ( Featured Image ) will appear on each slider item', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Thumbnail size', 'page-builder-wp' ),
                            'name'        => 'thumb_size',
                            'default'     => 'medium',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set the image size : Thumbnail, Medium, Large or Full', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'thumbnail',
                                    'Thumbnail',
                                ],
                                [
                                    'medium',
                                    'Medium',
                                ],
                                [
                                    'large',
                                    'Large',
                                ],
                                [
                                    'full',
                                    'Full',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Description ( Excerpt )', 'page-builder-wp' ),
                            'name'        => 'is_desc',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post content will appear on description field in Excerpt mode', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Post Description Length', 'page-builder-wp' ),
                            'name'        => 'desc_length',
                            'default'     => 30,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    10,
                                ],
                                [
                                    'data-slide-max',
                                    100,
                                ],
                            ],
                            'desc'        => esc_html__( 'The number above will display your post description text up to x words. By default the number of words is 30.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Meta', 'page-builder-wp' ),
                            'name'        => 'is_postmeta',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the post date and post author will displayed on bottom', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Read More Button', 'page-builder-wp' ),
                            'name'        => 'is_readmore',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the Read More Button will displayed on bottom', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Read More Label', 'page-builder-wp' ),
                            'name'        => 'readmore_label',
                            'default'     => esc_html__( 'Read More...', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Slide Delay', 'page-builder-wp' ),
                            'name'        => 'delay',
                            'default'     => 3,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    15,
                                ],
                            ],
                            'desc'        => esc_html__( 'The delay time before moving on to a new slide', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Slide Auto Play', 'page-builder-wp' ),
                            'name'        => 'autoplay',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If ON, the carousel automatically plays when site loaded', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-post-carousel.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'contactForm'       => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Email Recipient', 'page-builder-wp' ),
                            'name'        => 'recipient',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This is email address that will receive any incoming email', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Email Subject', 'page-builder-wp' ),
                            'name'        => 'subject',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text used as the subject for your incoming email', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Form Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label Name Field', 'page-builder-wp' ),
                            'name'        => 'label_name',
                            'default'     => esc_html__( 'Name', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on top of form name field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label Email Field', 'page-builder-wp' ),
                            'name'        => 'label_email',
                            'default'     => esc_html__( 'Email', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on top of form email field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label Subject Field', 'page-builder-wp' ),
                            'name'        => 'label_subject',
                            'default'     => esc_html__( 'Subject', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on top of form subject field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Label Message Field', 'page-builder-wp' ),
                            'name'        => 'label_message',
                            'default'     => esc_html__( 'Message', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on top of form message field', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Button Text', 'page-builder-wp' ),
                            'name'        => 'button_text',
                            'default'     => esc_html__( 'SEND', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This text will appear on form send button', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Action After Email Sent', 'page-builder-wp' ),
                            'name'        => 'sent_action',
                            'default'     => 'message',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You can set what action to sender when email sent successfully', 'page-builder-wp' ),
                            'choices'     => [
                                [
                                    'message',
                                    'Show Message',
                                ],
                                [
                                    'redirect',
                                    'Redirect to Specific URL',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Sent Message', 'page-builder-wp' ),
                            'name'        => 'sent_message',
                            'default'     => esc_html__( 'Thank you for contacting me. I will respond you ASAP', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set message when email sent successfully', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-link',
                            'label'       => esc_html__( 'Redirect URL', 'page-builder-wp' ),
                            'name'        => 'sent_redirect',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Set target link when email sent successfully', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use reCAPTCHA?', 'page-builder-wp' ),
                            'name'        => 'form_recaptcha',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'reCAPTCHA prevents any spam or bots from entering data into fields on your form', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Site Key', 'page-builder-wp' ),
                            'name'        => 'form_recaptcha_site_key',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Secret Key', 'page-builder-wp' ),
                            'name'        => 'form_recaptcha_secret_key',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Form Width', 'page-builder-wp' ),
                            'name'        => 'form_width',
                            'default'     => 100,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    100,
                                ],
                                [
                                    'data-slide-min',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'The Width of form on percent', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-contact-form.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'newsletterForm'    => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-radio-images',
                            'label'       => esc_html__( 'Template', 'page-builder-wp' ),
                            'name'        => 'template',
                            'default'     => 'style_01',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'style_01',
                                    'nf_style_01',
                                    '/preview/nform/style_01.png',
                                ],
                                [
                                    'style_02',
                                    'nf_style_02',
                                    '/preview/nform/style_02.png',
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'The title of your newsletter form. Type "none" to hide the title', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Description', 'page-builder-wp' ),
                            'name'        => 'desc',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-none-support',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'The description of your newsletter form. Type "none" to hide the description', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Submit Button Label', 'page-builder-wp' ),
                            'name'        => 'btn_txt',
                            'default'     => esc_html__( 'Subscribe', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Email Placeholder Label', 'page-builder-wp' ),
                            'name'        => 'email_placeholder',
                            'default'     => esc_html__( 'Your Email Address', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Fullname Placeholder Label', 'page-builder-wp' ),
                            'name'        => 'fullname_placeholder',
                            'default'     => esc_html__( 'Your Fullname', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Success Subscription Message', 'page-builder-wp' ),
                            'name'        => 'subscribe_ok_msg',
                            'default'     => esc_html__( 'Thank You For Subscribing!', 'page-builder-wp' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Services', 'page-builder-wp' ),
                            'name'        => 'services',
                            'default'     => 'mailchimp',
                            'custom_css'  => [
                                [
                                    '[name=services]',
                                    'wpc_newsletter_services',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'mailchimp',
                                    esc_html__( 'MailChimp', 'page-builder-wp' ),
                                ],
                                [
                                    'getresponse',
                                    esc_html__( 'GetResponse', 'page-builder-wp' ),
                                ],
                                [
                                    'campaign_monitor',
                                    esc_html__( 'Campaign Monitor', 'page-builder-wp' ),
                                ],
                                [
                                    'mad_mimi',
                                    esc_html__( 'Mad Mimi', 'page-builder-wp' ),
                                ],
                                [
                                    'aweber',
                                    esc_html__( 'Aweber', 'page-builder-wp' ),
                                ],
                                [
                                    'email',
                                    esc_html__( 'Email Notification', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'MailChimp API Key', 'page-builder-wp' ),
                            'name'        => 'mailchimp_api_key',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mailchimp',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-grab-list',
                            'label'       => esc_html__( 'Mailing List', 'page-builder-wp' ),
                            'name'        => 'mailchimp_list',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mailchimp',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'None', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Double Opt-in?', 'page-builder-wp' ),
                            'name'        => 'mailchimp_double_optin',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mailchimp',
                                ],
                            ],
                            'desc'        => esc_html__( 'If ON, when someone signs up for your email list and you will automatically send a confirmation email with a link that they must click before they\'re added to your list', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-getresponse-notes',
                            'label'       => '',
                            'name'        => 'getresponse_notes',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Redirect URL', 'page-builder-wp' ),
                            'name'        => 'getresponse_redirect_url',
                            'default'     => add_query_arg( [ 'page' => 'wpc-welcome' ], admin_url( 'admin.php' ) ),
                            'custom_css'  => [
                                [
                                    'self',
                                    'getresponse_redirect_url',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                                [
                                    'readonly',
                                    'true',
                                ],
                                [
                                    'style',
                                    'width: 70%',
                                ],
                            ],
                            'custom_html' => [
                                [
                                    'tags',
                                    '<span class="copy_auth_url dashicons dashicons-admin-page"></span>',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Client ID', 'page-builder-wp' ),
                            'name'        => 'getresponse_cid',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Secret Key', 'page-builder-wp' ),
                            'name'        => 'getresponse_skey',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                            ],
                            'custom_html' => [
                                [
                                    'tags',
                                    '<span class="wpc_generate_gr_at_button wpc-button-flat wpc-button-color-blue wpc-button-size-small button-config">'.esc_html__( 'Generate Access Token', 'page-builder-wp' ).'</span>',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'GetResponse API Key', 'page-builder-wp' ),
                            'name'        => 'getresponse_api_key',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-grab-list',
                            'label'       => esc_html__( 'Mailing List', 'page-builder-wp' ),
                            'name'        => 'getresponse_list',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'getresponse',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'None', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Campaign Monitor Client ID', 'page-builder-wp' ),
                            'name'        => 'campaign_monitor_client_id',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'campaign_monitor',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Campaign Monitor API Key', 'page-builder-wp' ),
                            'name'        => 'campaign_monitor_api_key',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'campaign_monitor',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-grab-list',
                            'label'       => esc_html__( 'Mailing List', 'page-builder-wp' ),
                            'name'        => 'campaign_monitor_list',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'campaign_monitor',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'None', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Mad Mimi Username ( email )', 'page-builder-wp' ),
                            'name'        => 'mad_mimi_username',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mad_mimi',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Mad Mimi API Key', 'page-builder-wp' ),
                            'name'        => 'mad_mimi_api_key',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mad_mimi',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-grab-list',
                            'label'       => esc_html__( 'Mailing List', 'page-builder-wp' ),
                            'name'        => 'mad_mimi_list',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'mad_mimi',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'None', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Aweber Auth Code', 'page-builder-wp' ),
                            'name'        => 'aweber_auth_code',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'aweber',
                                ],
                            ],
                            'custom_html' => [
                                [
                                    'tags',
                                    '<span class="wpc_aweber_con_dis_button wpc-button-flat wpc-button-color-blue wpc-button-size-small button-config">'.esc_html__( 'Connect', 'page-builder-wp' ).'</span>',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-textarea',
                            'label'       => '',
                            'name'        => 'aweber_data',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_css'  => [
                                [
                                    'this',
                                    'hidden-field',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'data-service',
                                    'aweber',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-grab-list',
                            'label'       => esc_html__( 'Mailing List', 'page-builder-wp' ),
                            'name'        => 'aweber_list',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'aweber',
                                ],
                            ],
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'none',
                                    esc_html__( 'None', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Email Receipt', 'page-builder-wp' ),
                            'name'        => 'email_receipt',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-service',
                                    'email',
                                ],
                            ],
                            'desc'        => esc_html__( 'When someone signs up for your email list and system will automatically send a confirmation to email above', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use Fullname Field?', 'page-builder-wp' ),
                            'name'        => 'use_name',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enable, the fullname field will appear on your Newsletter Form', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-news-letter.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'table'             => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'group-panel'     => [
                    'defaultvalue' => [
                        [
                            'table_data' => 'Honda
                            Accord
                            2009
                            Japan',
                        ],
                        [
                            'table_data' => 'Toyota
                            Camry
                            2012
                            Japan',
                        ],
                        [
                            'table_data' => 'Hyundai
                            Elantra
                            2010
                            Korea',
                        ],
                        [
                            'table_data' => 'Proton
                            Savvy
                            2005
                            Malaysia',
                        ],
                    ],
                    'itemfields'   => [
                        [
                            'type'        => 'field-textarea',
                            'label'       => esc_html__( 'Table Cell Data', 'page-builder-wp' ),
                            'name'        => 'table_data',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-clean_newline',
                                    'yes',
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter data for each cell (Note: divide data with linebreaks (Enter)).', 'page-builder-wp' ),
                        ],
                    ],
                    'fields'       => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Header Column Values', 'page-builder-wp' ),
                            'name'        => 'table_header_val',
                            'default'     => 'Brand, Type, Year, Country',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Enter value for each Column ( Note: separate values with comma ).', 'page-builder-wp' ),
                        ],
                        'xtra-class',
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-table.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'globalEDITOR'      => [
            'tabs'     => [
                esc_html__( 'BACKEND SETTINGS', 'page-builder-wp' ),
                esc_html__( 'FRONTEND SETTINGS', 'page-builder-wp' ),
                esc_html__( 'TEMPLATE MANAGER', 'page-builder-wp' ),
            ],
            'template' => [
                'global-backend-editor'  => [
                    'fields' => [
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Panel Width', 'page-builder-wp' ),
                            'name'        => 'global_panel_width',
                            'default'     => pbwp_get_builder_default_settings( 'width' ),
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-min',
                                    275,
                                ],
                                [
                                    'data-slide-max',
                                    650,
                                ],
                                [
                                    'data-slide-unit',
                                    'px',
                                ],
                                /* array(
                            'data-slide-realtime',
                            true,
                            ), */
                            ],
                            'desc'        => esc_html__( 'This setting is only applied if you use dock mode. In this case dock right or left mode.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Tooltips display?', 'page-builder-wp' ),
                            'name'        => 'global_tooltips',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'A brief description will appear when you hover the function icon.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Save Expand / Collapse Action?', 'page-builder-wp' ),
                            'name'        => 'global_save_expcoll',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The expand or collapse action will be saved, so this change will be applied every time the row is loaded.', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'global-frontend-editor' => [
                    'fields' => [
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Disable WP Composer', 'page-builder-wp' ),
                            'name'        => 'global_disable_wpc',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'You can turn it ON to disable WP Composer in this page and show your original content.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-template',
                            'label'       => esc_html__( 'Layout', 'page-builder-wp' ),
                            'name'        => 'global_layout',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Select to change the layout of your page, post or custom post type. The list of layout is depend of your theme.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Force Fullwidth?', 'page-builder-wp' ),
                            'name'        => 'global_fullwidth',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'This option will force this page template to full width ( no sidebar ).', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-code-editor',
                            'label'       => esc_html__( 'Custom CSS', 'page-builder-wp' ),
                            'name'        => 'global_css',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-mode',
                                    'css',
                                ],
                            ],
                            'desc'        => esc_html__( 'The above CSS will be applied to all elements in this page', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'template-template'      => [],
            ],
        ],
        'rowEDITOR'         => [
            'tabs'     => [
                esc_html__( 'ROW EDITOR', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'row-editor'      => [
                    'fields' => [
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Disable this Row', 'page-builder-wp' ),
                            'name'        => 'row_disable',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked the row will not be visible on the public side of your website. You can switch it back any time.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'No Padding for All Columns and Items', 'page-builder-wp' ),
                            'name'        => 'row_no_padding',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, all columns and Items inside this row will be set to no padding. This is good if you want to display an images to fill all the area.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Columns Gap', 'page-builder-wp' ),
                            'name'        => 'row_col_gap',
                            'default'     => 0,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    35,
                                ],
                                [
                                    'data-slide-unit',
                                    'px',
                                ],
                            ],
                            'desc'        => esc_html__( 'Set the gap between columns in this row', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Disable Column Gap on Tablet and Mobile', 'page-builder-wp' ),
                            'name'        => 'row_col_gap_disable',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, the column gap will be set to 0 on Tablet and Mobile devices', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use video background', 'page-builder-wp' ),
                            'name'        => 'videobg',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, video will be used as row background.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'YouTube Link', 'page-builder-wp' ),
                            'name'        => 'videobgurl',
                            'default'     => esc_url( 'https://www.youtube.com/watch?v=L14nXRxJILg' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Add YouTube link.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Disable Video Loop?', 'page-builder-wp' ),
                            'name'        => 'dis_videobg_loop',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, video will be played once.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Parallax', 'page-builder-wp' ),
                            'name'        => 'parallax',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Add parallax type background for this row. Please set specified background image using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'rowparallax-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Parallax Speed', 'page-builder-wp' ),
                            'name'        => 'parallax_speed',
                            'default'     => 1.5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-step',
                                    0.1,
                                ],
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Shape Dividers', 'page-builder-wp' ),
                            'name'        => 'shapedivider',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Add shape divider to top or bottom for this row.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-shapedivider',
                            'label'       => null,
                            'name'        => 'shapedivider_data',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.field-textarea-editor',
                                    'shapedividerdata',
                                ],
                            ],
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Sticky', 'page-builder-wp' ),
                            'name'        => 'use_sticky',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'The sticky option makes the row and its content fixed at the top of the page', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-color',
                            'label'       => esc_html__( 'Sticky Shadow Color', 'page-builder-wp' ),
                            'name'        => 'sticky_shadow_color',
                            'default'     => 'rgba(0, 0, 0, 0.25)',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Extra Class', 'page-builder-wp' ),
                            'name'        => 'row_class',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-row.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'columnEDITOR'      => [
            'tabs'     => [
                esc_html__( 'COLUMN EDITOR', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'column-editor'   => [
                    'fields' => [
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Parallax', 'page-builder-wp' ),
                            'name'        => 'parallax',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Add parallax type background for this column. Please set specified background image using option below.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'img_id',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'image-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'colparallax-img-url',
                                ],
                                [
                                    'data-media-type',
                                    'image',
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Parallax Speed', 'page-builder-wp' ),
                            'name'        => 'parallax_speed',
                            'default'     => 1.5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-step',
                                    0.1,
                                ],
                                [
                                    'data-slide-min',
                                    1,
                                ],
                                [
                                    'data-slide-max',
                                    10,
                                ],
                            ],
                            'desc'        => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Use video background', 'page-builder-wp' ),
                            'name'        => 'videobg',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, video will be used as column background.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'YouTube Link', 'page-builder-wp' ),
                            'name'        => 'videobgurl',
                            'default'     => esc_url( 'https://www.youtube.com/watch?v=L14nXRxJILg' ),
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Add YouTube link.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Disable Video Loop', 'page-builder-wp' ),
                            'name'        => 'dis_videobg_loop',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, video will be played once.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'No Padding for All Items', 'page-builder-wp' ),
                            'name'        => 'col_no_padding',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If checked, all Items inside this column will be set to no padding. This is good if you want to display an images to fill all the area.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Force All Items to Vertical Centering', 'page-builder-wp' ),
                            'name'        => 'col_center_v',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enabled, all items inside this column will be center in vertical.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Force Display to Block', 'page-builder-wp' ),
                            'name'        => 'col_is_block',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'If enabled, this column will displayed as a block element and has full of width.', 'page-builder-wp' ),
                        ],
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Extra Class', 'page-builder-wp' ),
                            'name'        => 'col_class',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'page-builder-wp' ),
                        ],
                    ],
                ],
                'style-panel'     => require_once pbwp_manager()->path( 'MAP_STYLE_FIELDS', 'type-column.php' ),
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpRCPost'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of Posts to Show', 'page-builder-wp' ),
                            'name'        => 'number',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    50,
                                ],
                            ],
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Date?', 'page-builder-wp' ),
                            'name'        => 'show_date',
                            'default'     => 'yes',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpRCCom'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-slider',
                            'label'       => esc_html__( 'Number of Comments to Show', 'page-builder-wp' ),
                            'name'        => 'number',
                            'default'     => 5,
                            'custom_css'  => null,
                            'custom_data' => [
                                [
                                    'data-slide-max',
                                    50,
                                ],
                            ],
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpCAT'             => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',

                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Display as dropdown', 'page-builder-wp' ),
                            'name'        => 'dropdown',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Post Counts', 'page-builder-wp' ),
                            'name'        => 'count',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-switch',
                            'label'       => esc_html__( 'Show Hierarchy', 'page-builder-wp' ),
                            'name'        => 'hierarchical',
                            'default'     => 'no',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpTCloud'          => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Taxonomy', 'page-builder-wp' ),
                            'name'        => 'taxonomy',
                            'default'     => 'post_tag',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                            'choices'     => [
                                [
                                    'category',
                                    esc_html__( 'Categories', 'page-builder-wp' ),
                                ],
                                [
                                    'post_tag',
                                    esc_html__( 'Tags', 'page-builder-wp' ),
                                ],
                                [
                                    'link_category',
                                    esc_html__( 'Link Category', 'page-builder-wp' ),
                                ],
                            ],
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpMETA'            => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpVideo'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'video_url',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'video-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'video-url',
                                ],
                                [
                                    'data-media-type',
                                    'video',
                                ],
                            ],
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
        'wpAudio'           => [
            'tabs'     => [
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'STYLING', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
                esc_html__( 'PRESETS', 'page-builder-wp' ),
            ],
            'template' => [
                'general-panel'   => [
                    'fields' => [
                        [
                            'type'        => 'field-text',
                            'label'       => esc_html__( 'Title', 'page-builder-wp' ),
                            'name'        => 'title',
                            'default'     => null,
                            'custom_css'  => null,
                            'custom_data' => null,
                            'desc'        => null,
                        ],
                        [
                            'type'        => 'field-media-picker',
                            'label'       => null,
                            'name'        => 'audio_url',
                            'default'     => null,
                            'custom_css'  => [
                                [
                                    '.media-holder',
                                    'audio-holder',
                                ],
                            ],
                            'custom_data' => [
                                [
                                    'id',
                                    'audio-url',
                                ],
                                [
                                    'data-media-type',
                                    'audio',
                                ],
                            ],
                            'desc'        => null,
                        ],
                    ],
                ],
                'style-panel'     => [
                    'fields' => pbwp_typography_template( '.item_wp_widget|' ),
                ],
                'advanced-panel'  => [],
                'preset-template' => [],
            ],
        ],
    ],
    ];

}

function pbwp_typography_template( $cName, $group = false )
{

    $typography_fields = [ [
        'type'        => 'field-color',
        'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
        'name'        => ''.$cName.'color',
        'default'     => null,
        'custom_css'  => null,
        'custom_data' => null,
        'desc'        => null,
    ],
        [
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => ''.$cName.'font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => ''.$cName.'font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => ''.$cName.'font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => ''.$cName.'font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Alignment', 'page-builder-wp' ),
            'name'        => ''.$cName.'text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => ''.$cName.'line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-number',
            'label'       => esc_html__( 'Letter Spacing', 'page-builder-wp' ),
            'name'        => ''.$cName.'letter-spacing',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ],

    ];

    if ( $group ) {

        foreach ( $typography_fields as $k => $fld ) {

            $typography_fields[ $k ][ 'custom_data' ] = [
                [
                    'data-group',
                    $group,
                ],
            ];

        }

    }

    return apply_filters( 'pbwp_typography_fields', $typography_fields, $cName );

}

add_filter( 'pbwp_typography_fields', 'pbwp_texteditor_typography_fields', 11, 2 );

function pbwp_texteditor_typography_fields( $fields, $cName )
{

    if ( $cName != '.text_editor_content|' ) {
        return $fields;
    }

    $newFields = [ [
        'type'        => 'field-corners',
        'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
        'name'        => '.self.|margin',
        'default'     => null,
        'custom_css'  => [
            [
                '.wpc-corners-wrp',
                'wpc-css-field-margin',
            ],
        ],
        'custom_data' => [
            [
                'data-group',
                'txt-box',
            ],
        ],
        'desc'        => null,
    ],
        [
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.text_editor_content|padding',
            'default'     => null,
            'custom_css'  => [
                [
                    '.wpc-corners-wrp',
                    'wpc-css-field-padding',
                ],
            ],
            'custom_data' => [
                [
                    'data-group',
                    'txt-box',
                ],
            ],
            'desc'        => null,

        ],
    ];

    foreach ( $newFields as $each ) {

        $fields[  ] = $each;

    }

    return $fields;

}

add_filter( 'pbwp_item_css_fields', 'pbwp_background_image_fields_template', 10, 4 );
add_filter( 'pbwp_item_timeline_css_fields', 'pbwp_background_image_fields_template', 10, 4 );

function pbwp_background_image_fields_template( $fields, $cName, $group, $after )
{

    if ( ! isset( $cName ) || $cName == '' ) {
        $cName = '';
    }

    $bg_properties = [
        [
            'type'        => 'field-switch',
            'label'       => esc_html__( 'Use Background Image', 'page-builder-wp' ),
            'name'        => $cName.'|bg_control_only',
            'default'     => 'no',
            'custom_css'  => [
                [
                    'this',
                    'background-field-switch',
                ],
            ],
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-media-picker',
            'label'       => null,
            'name'        => $cName.'|background-image',
            'default'     => null,
            'custom_css'  => [
                [
                    '.media-holder',
                    'image-holder',
                ],
                [
                    'this',
                    'field-background-props',
                ],
            ],
            'custom_data' => [
                [
                    'data-media-type',
                    'image',
                ],
                [
                    'data-group',
                    $group,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-background-repeat',
            'label'       => esc_html__( 'BG repeat', 'page-builder-wp' ),
            'name'        => $cName.'|background-repeat',
            'default'     => 'no-repeat',
            'custom_css'  => null,
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
                [
                    'data-force-empty',
                    true,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-background-position',
            'label'       => esc_html__( 'BG position', 'page-builder-wp' ),
            'name'        => $cName.'|background-position',
            'default'     => 'center center',
            'custom_css'  => null,
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
                [
                    'data-force-empty',
                    true,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-background-attachment',
            'label'       => esc_html__( 'BG Attachment', 'page-builder-wp' ),
            'name'        => $cName.'|background-attachment',
            'default'     => 'scroll',
            'custom_css'  => null,
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
                [
                    'data-force-empty',
                    true,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-background-size',
            'label'       => esc_html__( 'BG Size', 'page-builder-wp' ),
            'name'        => $cName.'|background-size',
            'default'     => 'cover',
            'custom_css'  => null,
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
                [
                    'data-force-empty',
                    true,
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-background-blend-mode',
            'label'       => esc_html__( 'Blend Mode', 'page-builder-wp' ),
            'name'        => $cName.'|background-blend-mode',
            'default'     => 'normal',
            'custom_css'  => null,
            'choices'     => [
                [
                    'color',
                    'Color',
                ],
                [
                    'color-dodge',
                    'Color Dodge',
                ],
                [
                    'color-burn',
                    'Color Burn',
                ],
                [
                    'darken',
                    'Darken',
                ],
                [
                    'difference',
                    'Difference',
                ],
                [
                    'exclusion',
                    'Exclusion',
                ],
                [
                    'hard-light',
                    'Hard Light',
                ],
                [
                    'hue',
                    'Hue',
                ],
                [
                    'inherit',
                    'Inherit',
                ],
                [
                    'initial',
                    'Initial',
                ],
                [
                    'lighten',
                    'Lighten',
                ],
                [
                    'luminosity',
                    'Luminosity',
                ],
                [
                    'multiply',
                    'Multiply',
                ],
                [
                    'normal',
                    'Normal',
                ],
                [
                    'overlay',
                    'Overlay',
                ],
                [
                    'revert',
                    'Revert',
                ],
                [
                    'revert-layer',
                    'Revert Layer',
                ],
                [
                    'saturation',
                    'Saturation',
                ],
                [
                    'screen',
                    'Screen',
                ],
                [
                    'soft-light',
                    'Soft Light',
                ],
                [
                    'unset',
                    'Unset',
                ],
            ],
            'custom_data' => [
                [
                    'data-group',
                    $group,
                ],
                [
                    'data-force-empty',
                    true,
                ],
            ],
            'desc'        => null,
        ],

    ];

    $bg_fields = [];

    foreach ( $bg_properties as $k => $v ) {
        $bg_fields[  ] = $bg_properties[ $k ];
    }

    array_splice( $fields, (int) $after, 0, $bg_fields );

    return $fields;

}

function pbwp_border_spacing_template( $cName, $group = false )
{

    $border_spacing_fields = [
        [
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => ''.$cName.'padding',
            'default'     => null,
            'custom_css'  => [
                [
                    '.wpc-corners-wrp',
                    'wpc-css-field-padding',
                ],
            ],
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => ''.$cName.'margin',
            'default'     => null,
            'custom_css'  => [
                [
                    '.wpc-corners-wrp',
                    'wpc-css-field-margin',
                ],
            ],
            'custom_data' => null,
            'desc'        => null,
        ],
        [
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => ''.$cName.'border-radius',
            'default'     => null,
            'custom_css'  => [
                [
                    '.m-f-u-li-link .wpc-i-move',
                    'corner-arrow',
                ],
                [
                    '.wpc-corners-wrp',
                    'wpc-css-field-border-radius',
                ],
            ],
            'custom_data' => null,
            'custom_tags' => [
                [
                    'placeholder',
                ],
            ],
            'desc'        => null,
        ],
        [
            'type'        => 'field-border',
            'label'       => esc_html__( 'Border', 'page-builder-wp' ),
            'name'        => ''.$cName.'border',
            'default'     => null,
            'custom_css'  => [
                [
                    '.wpc-corners-wrp',
                    'wpc-css-field-border',
                ],
            ],
            'custom_data' => null,
            'desc'        => null,
        ],

    ];

    if ( $group ) {

        foreach ( $border_spacing_fields as $k => $fld ) {

            $border_spacing_fields[ $k ][ 'custom_data' ] = [
                [
                    'data-group',
                    $group,
                ],
            ];

        }

    }

    return apply_filters( 'pbwp_border_spacing_fields', $border_spacing_fields, $cName );

}
