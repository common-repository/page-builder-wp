<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'pc-title',
            'Title',
        ),
        array(
            'pc-price',
            'Price',
        ),
        array(
            'pc-price-cur',
            'Currency',
        ),

        array(
            'pc-price-per',
            'Per',
        ),
        array(
            'pc-item',
            'Items',
        ),
        array(
            'pc-icon',
            'Icon',
        ),
        array(
            'pc-btn',
            'Button',
        ),
        array(
            'pc-box',
            'Pricing Box',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title Color', 'page-builder-wp' ),
            'name'        => '.pc_title|color',
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
            'name'        => '.pc_title|font-family',
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
            'name'        => '.pc_title|font-size',
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
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.pc_title|font-style',
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
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.pc_title|line-height',
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
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_title|text-transform',
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
            'label'       => esc_html__( 'Text Alignment', 'page-builder-wp' ),
            'name'        => '.pc_title|text-align',
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
            'name'        => '.pc_title|font-weight',
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
            'label'       => esc_html__( 'Title Background Color', 'page-builder-wp' ),
            'name'        => '.pc_title|background',
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
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.pc_title|padding',
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
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.pc_title|margin',
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
                    'pc-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.pc_price|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.pc_price|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.pc_price|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.pc_price|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_price|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.pc_price|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Alignment', 'page-builder-wp' ),
            'name'        => '.pc_price|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.pc_price|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-vertical-align',
            'label'       => esc_html__( 'Vertical Align', 'page-builder-wp' ),
            'name'        => 'span.pc_price|vertical-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Price Area Background', 'page-builder-wp' ),
            'name'        => '.pc_price_cont|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.pc_price_cont|padding',
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
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.pc_price_cont|margin',
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
                    'pc-price',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.pc_price_curr|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-vertical-align',
            'label'       => esc_html__( 'Vertical Align', 'page-builder-wp' ),
            'name'        => 'span.pc_price_curr|vertical-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-cur',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.pc_price_per|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.pc_price_per|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.pc_price_per|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.pc_price_per|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.pc_price_per|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_price_per|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.pc_price_per|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-vertical-align',
            'label'       => esc_html__( 'Vertical Align', 'page-builder-wp' ),
            'name'        => 'span.pc_price_per|vertical-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-price-per',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.pc_item|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.pc_item|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.pc_item|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.pc_item|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Line Height', 'page-builder-wp' ),
            'name'        => '.pc_item|line-height',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_item|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-alignment',
            'label'       => esc_html__( 'Text Alignment', 'page-builder-wp' ),
            'name'        => '.pc_item|text-align',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.pc_item|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Odd Items Background Color', 'page-builder-wp' ),
            'name'        => '.pc_item.item_odd|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Even Items Background Color', 'page-builder-wp' ),
            'name'        => '.pc_item.item_even|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.pc_item|padding',
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
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
            'name'        => '.pc_item|margin',
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
                    'pc-item',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Color', 'page-builder-wp' ),
            'name'        => '.pc_icon|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Icon Size', 'page-builder-wp' ),
            'name'        => '.pc_icon|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Icon Area Background', 'page-builder-wp' ),
            'name'        => '.pc_icon_cont|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.pc_icon_cont|padding',
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
                    'pc-icon',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.pc_button_text, .includethis. a.pc_button:active, .includethis. a.pc_button:visited|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.pc_button_text|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.pc_button_text|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.pc_button_text|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.pc_button_text|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Color', 'page-builder-wp' ),
            'name'        => '.pc_button|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Text Color', 'page-builder-wp' ),
            'name'        => 'a.pc_button:hover .pc_button_text|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'on Hover Button Color', 'page-builder-wp' ),
            'name'        => '.pc_button:hover|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-display',
            'label'       => esc_html__( 'Display', 'page-builder-wp' ),
            'name'        => '.pc_button|display',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.pc_button|border-radius',
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
                    'pc-btn',
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
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => 'a.pc_button|padding',
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
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Area Background', 'page-builder-wp' ),
            'name'        => '.pc_footer|background',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-border',
            'label'       => esc_html__( 'Button Area Border', 'page-builder-wp' ),
            'name'        => '.pc_footer|border',
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
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Button Area Padding', 'page-builder-wp' ),
            'name'        => '.pc_footer|padding',
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
                    'pc-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.pc_box|background',
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
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.pc_box|color-gradient',
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
            'type'        => 'field-corners',
            'label'       => esc_html__( 'On Hover Box Position', 'page-builder-wp' ),
            'name'        => '.pc_box:hover|margin',
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
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Border Radius', 'page-builder-wp' ),
            'name'        => '.pc_box|border-radius',
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
                    'pc-box',
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
            'name'        => '.pc_box|border',
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
    ),
);