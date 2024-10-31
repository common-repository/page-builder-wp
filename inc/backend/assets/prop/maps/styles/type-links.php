<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

return array(
    'group'  => array(
        array(
            'link-title',
            'Title',
        ),
        array(
            'links-title',
            'Links',
        ),
        array(
            'links-box',
            'Box',
        ),
    ),
    'fields' => pbwp_links_style_fields(),
);

function pbwp_links_style_fields()
{

    $fields = array();

    $selectorGroup = array(
        array(
            'selector' => '.wpc_links_title h4|',
            'group'    => 'link-title',
        ),
        array(
            'selector' => 'a.wpc_link_each|',
            'group'    => 'links-title',
        ),
        array(
            'selector' => '.wpc_item_links|',
            'group'    => 'links-box',
        ),
    );

    foreach ( $selectorGroup as $each ) {

        if ( $each['group'] === 'links-box' ) {
            $fields = array_merge( array(
                array(
                    'type'        => 'field-corners',
                    'label'       => esc_html__( 'Padding', 'page-builder-wp' ),
                    'name'        => $each['selector'].'padding',
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
                            $each['group'],
                        ),
                    ),
                    'desc'        => null,
                ),
                array(
                    'type'        => 'field-corners',
                    'label'       => esc_html__( 'Margin', 'page-builder-wp' ),
                    'name'        => $each['selector'].'margin',
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
                            $each['group'],
                        ),
                    ),
                    'desc'        => null,
                ),
            ), $fields );
        } else {
            $fields = array_merge( pbwp_typography_template( $each['selector'], $each['group'] ), $fields );
        }

    }

    return $fields;

}