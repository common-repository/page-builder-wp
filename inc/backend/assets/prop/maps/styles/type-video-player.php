<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'fields' => array(
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Alignment', 'page-builder-wp' ),
            'name'        => '.wpc_item_video_player|justify-content',
            'default'     => 'center',
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.wpc_item_video_player|margin',
            'default'     => null,
            'custom_css'  => array(
                array(
                    '.wpc-corners-wrp',
                    'wpc-css-field-margin',
                ),
            ),
            'custom_data' => null,
            'desc'        => null,
        ),
    ),
);