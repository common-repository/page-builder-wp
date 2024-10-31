<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'tab-tabs',
            'Tabs',
        ),
        array(
            'tab-tabshover',
            'Tabs on Hover',
        ),
        array(
            'tab-tabsactive',
            'Tabs Active',
        ),
        array(
            'tab-body',
            'Tab Container',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title and Icon Color', 'page-builder-wp' ),
            'name'        => '.the_tab|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.the_tab, .includethis. .the_tab:before, .includethis. .the_tab:after|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
                array(
                    'data-add-css-relation',
                    array(
                        array(
                            'selector' => '.the_tab:before',
                            'property' => 'background-color'
                        ),
                        array(
                            'selector' => '.the_tab:after',
                            'property' => 'background-color'
                        ),
                    ),
                ),
            ),
            'desc'        => null,
        ),        
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Title and Icon Size', 'page-builder-wp' ),
            'name'        => '.the_tab|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.the_tab .tab_title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.the_tab|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-text-transform',
            'label'       => esc_html__( 'Text Transform', 'page-builder-wp' ),
            'name'        => '.the_tab|text-transform',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabs',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title and Icon Color', 'page-builder-wp' ),
            'name'        => '.the_tab:hover, .includethis. .the_tab:hover:before, .includethis. .the_tab:hover:after|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabshover',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.the_tab:hover, .includethis. .the_tab:hover:before, .includethis. .the_tab:hover:after|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabshover',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Title and Icon Color', 'page-builder-wp' ),
            'name'        => '.the_tab.active, .includethis. .the_tab.active:before, .includethis. .the_tab.active:after|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabsactive',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.the_tab.active, .includethis. .the_tab.active:before, .includethis. .the_tab.active:after|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-tabsactive',
                ),
                array(
                    'data-inlinecss',
                    'yes',
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Border Color', 'page-builder-wp' ),
            'name'        => '.wpc_tab_content, .includethis. .tabbed.tab_round ul li:before, .includethis. .tabbed.tab_round ul li:after, .includethis. .horizontal_mode .tabbed_list .the_tab, .includethis. .tabbed.vertical_right .tabbed_list .the_tab, .includethis. .tabbed.vertical_left .tabbed_list .the_tab|border-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-body',
                ),
                array(
                    'data-add-css-relation',
                    array(
                        array(
                            'selector' => '.tabbed.tab_round ul li:before',
                            'property' => 'border-color'
                        ),
                        array(
                            'selector' => '.tabbed.tab_round ul li:after',
                            'property' => 'border-color'
                        ),
                    ),
                ),
            ),
            'desc'        => null,
        ),

        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.wpc_tab_content|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-body',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.wpc_tab_content|color-gradient',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'tab-body',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.wpc_tab_content_inner|padding',
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
                    'tab-body',
                ),
            ),
            'desc'        => null,
        ),
    ),
);