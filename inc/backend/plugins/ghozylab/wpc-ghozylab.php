<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'pbwp_item_category_list', 'pbwp_add_ghozylab_item_cat' );
add_filter( 'pbwp_item_list', 'pbwp_add_ghozylab_items' );
add_filter( 'pbwp_editor_maps', 'pbwp_add_ghozylab_maps' );

function pbwp_add_ghozylab_item_cat( $cats )
{

    $cats['ghozylab'] = 'GhozyLab Plugins';

    return $cats;

}

function pbwp_add_ghozylab_items( $items )
{

    $extra_items = array();

    // Contact Form
    if ( defined( 'PBWP_GHOZYLAB_FORM' ) ) {
        $extra_items['ghozylabForm'] = array( 'name' => 'Contact Form', 'category' => 'ghozylab', 'wpc_item' => true );
    }

    // Image Slider
    if ( defined( 'PBWP_GHOZYLAB_SLIDER' ) ) {
        $extra_items['ghozylabSlider'] = array( 'name' => 'Image Slider', 'category' => 'ghozylab', 'wpc_item' => true );
    }

    // Instagram Feed
    if ( defined( 'PBWP_GHOZYLAB_INSTAGRAM' ) ) {
        $extra_items['ghozylabInstagram'] = array( 'name' => 'Instagram Feed', 'category' => 'ghozylab', 'wpc_item' => true );
    }

    // Image Gallery
    if ( defined( 'PBWP_GHOZYLAB_GALLERY' ) ) {
        $extra_items['ghozylabGallery'] = array( 'name' => 'Easy Media Gallery', 'category' => 'ghozylab', 'wpc_item' => true );
    }

    // Easy notify
    if ( defined( 'PBWP_GHOZYLAB_NOTIFY' ) ) {
        $extra_items['ghozylabEasyNotify'] = array( 'name' => 'Easy Notify', 'category' => 'ghozylab', 'wpc_item' => true );
    }

    foreach ( $extra_items as $key => $val ) {

        $items[$key] = $val;

    }

    return $items;

}

function pbwp_add_ghozylab_maps( $maps )
{

    // GhozyLab Contact Form
    if ( defined( 'PBWP_GHOZYLAB_FORM' ) ) {

        $maps['addons']['ghozylabForm'] = array(
            'tabs'     => array(
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ),
            'template' => array(
                'general-panel'  => array(
                    'fields' => array(
                        array(
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Select Form', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => pbwp_get_ghozylab_plugins_media_id( 'easycontactform', 'Form' ),
                            'desc'        => esc_html__( 'Choose previously created contact form from the drop down list.', 'page-builder-wp' ),
                        ),
                        'xtra-class',
                    ),
                ),
                'advanced-panel' => array(),
            ),
        );

    }

    // GhozyLab Slider
    if ( defined( 'PBWP_GHOZYLAB_SLIDER' ) ) {

        $maps['addons']['ghozylabSlider'] = array(
            'tabs'     => array(
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ),
            'template' => array(
                'general-panel'  => array(
                    'fields' => array(
                        array(
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Select Slider', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => pbwp_get_ghozylab_plugins_media_id( 'easyimageslider', 'Slider' ),
                            'desc'        => esc_html__( 'Choose previously created slider from the drop down list.', 'page-builder-wp' ),
                        ),
                        'xtra-class',
                    ),
                ),
                'advanced-panel' => array(),
            ),
        );

    }

    // GhozyLab Instagram
    if ( defined( 'PBWP_GHOZYLAB_INSTAGRAM' ) ) {

        $maps['addons']['ghozylabInstagram'] = array(
            'tabs'     => array(
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ),
            'template' => array(
                'general-panel'  => array(
                    'fields' => array(
                        array(
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Select Feed', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => pbwp_get_ghozylab_plugins_media_id( 'ginstagramfeed', 'Feed' ),
                            'desc'        => esc_html__( 'Choose previously created feed from the drop down list.', 'page-builder-wp' ),
                        ),
                        'xtra-class',
                    ),
                ),
                'advanced-panel' => array(),
            ),
        );

    }

    // GhozyLab Gallery
    if ( defined( 'PBWP_GHOZYLAB_GALLERY' ) ) {

        $maps['addons']['ghozylabGallery'] = array(
            'tabs'     => array(
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ),
            'template' => array(
                'general-panel'  => array(
                    'fields' => array(
                        array(
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Select Gallery', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => pbwp_get_ghozylab_plugins_media_id( 'easymediagallery', 'Gallery' ),
                            'desc'        => esc_html__( 'Choose previously created gallery from the drop down list.', 'page-builder-wp' ),
                        ),
                        'xtra-class',
                    ),
                ),
                'advanced-panel' => array(),
            ),
        );

    }

    // Easy Notify
    if ( defined( 'PBWP_GHOZYLAB_NOTIFY' ) ) {

        $maps['addons']['ghozylabEasyNotify'] = array(
            'tabs'     => array(
                esc_html__( 'GENERAL', 'page-builder-wp' ),
                esc_html__( 'ADVANCED', 'page-builder-wp' ),
            ),
            'template' => array(
                'general-panel'  => array(
                    'fields' => array(
                        array(
                            'type'        => 'field-select',
                            'label'       => esc_html__( 'Select Notify', 'page-builder-wp' ),
                            'name'        => 'id',
                            'default'     => 'none',
                            'custom_css'  => null,
                            'custom_data' => null,
                            'choices'     => pbwp_get_ghozylab_plugins_media_id( 'easynotify', 'Notify' ),
                            'desc'        => esc_html__( 'Choose previously created Notify from the drop down list.', 'page-builder-wp' ),
                        ),
                        'xtra-class',
                    ),
                ),
                'advanced-panel' => array(),
            ),
        );

    }

    return $maps;

}

function pbwp_get_ghozylab_plugins_media_id( $postType, $msg = null )
{

    $ctype  = get_posts( 'post_type="'.$postType.'"&numberposts=-1' );
    $all_id = array();

    $all_id[] = array( 'none', '---'.esc_html__( 'Select', 'page-builder-wp' ).' '.$msg.'---' );

    if ( $ctype ) {
        foreach ( $ctype as $ce ) {
            $all_id[] = array( $ce->ID, $ce->post_title );
        }

    }

    return $all_id;

}