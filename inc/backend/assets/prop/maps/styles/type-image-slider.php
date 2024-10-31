<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'sl-pag',
            'Pagination',
        ),
        array(
            'sl-nav',
            'Navigation',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Bullet Color', 'page-builder-wp' ),
            'name'        => '.swiper-pagination-bullet-active|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sl-pag',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-slider',
            'label'       => esc_html__( 'Bullet Size', 'page-builder-wp' ),
            'name'        => '.swiper-pagination-bullet|width',
            'default'     => '8px',
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-slide-connect-with',
                    '.swiper-pagination-bullet|height',
                ),
                array(
                    'data-slide-connect-type',
                    'equal',
                ),
                array(
                    'data-slide-min',
                    8,
                ),
                array(
                    'data-slide-max',
                    25,
                ),
                array(
                    'data-slide-unit',
                    'px',
                ),
                array(
                    'data-group',
                    'sl-pag',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-slider',
            'label'       => esc_html__( 'Bullet Height', 'page-builder-wp' ),
            'name'        => '.swiper-pagination-bullet|height',
            'default'     => '8px',
            'custom_css'  => array(
                array(
                    'this',
                    'force_hideme',
                ),
            ),
            'custom_data' => array(
                array(
                    'data-slide-connect-with',
                    '.swiper-pagination-bullet|width',
                ),
                array(
                    'data-slide-connect-type',
                    'equal',
                ),
                array(
                    'data-slide-min',
                    8,
                ),
                array(
                    'data-slide-max',
                    25,
                ),
                array(
                    'data-slide-unit',
                    'px',
                ),
                array(
                    'data-group',
                    'sl-pag',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Navigation Color', 'page-builder-wp' ),
            'name'        => '.wpc_image_slider .swiper-button-next, .includethis. .wpc_image_slider .swiper-button-prev|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'sl-nav',
                ),
            ),
            'desc'        => null,
        ),
    ),
);