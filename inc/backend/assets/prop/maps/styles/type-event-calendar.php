<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'ec-title',
            'Title',
        ),
        array(
            'ec-tbl',
            'Table',
        ),
        array(
            'ec-tbl-txt',
            'Table Text',
        ),
        array(
            'ec-btn',
            'Button',
        ),
    ),
    'fields' => array(
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Color', 'page-builder-wp' ),
            'name'        => '.fc-toolbar-title|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.fc-toolbar-title|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.fc-toolbar-title|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.fc-toolbar-title|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.fc-toolbar-title|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-title',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Header Color', 'page-builder-wp' ),
            'name'        => '.fc-col-header-cell .fc-scrollgrid-sync-inner|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Border Color', 'page-builder-wp' ),
            'name'        => '.fc-theme-standard td, .includethis. .fc-theme-standard th, .includethis. .fc-theme-standard .fc-scrollgrid|border-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
            'name'        => '.wpc_event_calendar_cont table, .includethis. .fc-theme-standard .fc-list-day-cushion|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color-gradient',
            'label'       => esc_html__( 'Use Gradient Color', 'page-builder-wp' ),
            'name'        => '.wpc_event_calendar_cont table, .includethis. .fc-theme-standard .fc-list-day-cushion|color-gradient',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-corners',
            'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
            'name'        => '.wpc_event_calendar_cont table|padding',
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
                    'ec-tbl',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Header Text Color', 'page-builder-wp' ),
            'name'        => 'a.fc-col-header-cell-cushion|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Header Text Font Family', 'page-builder-wp' ),
            'name'        => 'a.fc-col-header-cell-cushion|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Header Text Font Size', 'page-builder-wp' ),
            'name'        => 'a.fc-col-header-cell-cushion|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Header Text Font Weight', 'page-builder-wp' ),
            'name'        => 'a.fc-col-header-cell-cushion|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Header Text Font Style', 'page-builder-wp' ),
            'name'        => 'a.fc-col-header-cell-cushion|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Date Color', 'page-builder-wp' ),
            'name'        => '.fc-daygrid-day-number|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Date Font Family', 'page-builder-wp' ),
            'name'        => '.fc-daygrid-day-number|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Date Font Size', 'page-builder-wp' ),
            'name'        => '.fc-daygrid-day-number|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Date Font Weight', 'page-builder-wp' ),
            'name'        => '.fc-daygrid-day-number|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Date Font Style', 'page-builder-wp' ),
            'name'        => '.fc-daygrid-day-number|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Events Info Color', 'page-builder-wp' ),
            'name'        => '.fc-timegrid-slot-label-cushion, .includethis. .fc-timegrid-axis-cushion, .includethis. .fc-list-day-text, .includethis. .fc-list-day-side-text, .includethis. .fc-list-event-title, .includethis. .fc-list-event-time|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Events Info Font Family', 'page-builder-wp' ),
            'name'        => '.fc-timegrid-slot-label-cushion, .includethis. .fc-timegrid-axis-cushion, .includethis. .fc-list-day-text, .includethis. .fc-list-day-side-text, .includethis. .fc-list-event-title, .includethis. .fc-list-event-time|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Events Info Font Size', 'page-builder-wp' ),
            'name'        => '.fc-timegrid-slot-label-cushion, .includethis. .fc-timegrid-axis-cushion, .includethis. .fc-list-day-text, .includethis. .fc-list-day-side-text, .includethis. .fc-list-event-title, .includethis. .fc-list-event-time|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Events Info Font Weight', 'page-builder-wp' ),
            'name'        => '.fc-timegrid-slot-label-cushion, .includethis. .fc-timegrid-axis-cushion, .includethis. .fc-list-day-text, .includethis. .fc-list-day-side-text, .includethis. .fc-list-event-title, .includethis. .fc-list-event-time|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Events Info Font Style', 'page-builder-wp' ),
            'name'        => '.fc-timegrid-slot-label-cushion, .includethis. .fc-timegrid-axis-cushion, .includethis. .fc-list-day-text, .includethis. .fc-list-day-side-text, .includethis. .fc-list-event-title, .includethis. .fc-list-event-time|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-tbl-txt',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Text Color', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-fonts-picker',
            'label'       => esc_html__( 'Font Family', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|font-family',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-number',
            'label'       => esc_html__( 'Font Size', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|font-size',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-weight',
            'label'       => esc_html__( 'Font Weight', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|font-weight',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-font-style',
            'label'       => esc_html__( 'Font Style', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|font-style',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Color', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary, .includethis. .wpc_ec_locales_selector|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
        array(
            'type'        => 'field-color',
            'label'       => esc_html__( 'Button Color On Hover and Selected', 'page-builder-wp' ),
            'name'        => '.fc .fc-button-primary:hover, .includethis. .fc .fc-button-primary:not(:disabled):active, .includethis. .fc .fc-button-primary:not(:disabled).fc-button-active, .includethis. .wpc_ec_locales_selector:hover|background-color',
            'default'     => null,
            'custom_css'  => null,
            'custom_data' => array(
                array(
                    'data-group',
                    'ec-btn',
                ),
            ),
            'desc'        => null,
        ),
    ),
);