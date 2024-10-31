<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Maps extends PBWP_Item_Loader
{

    protected $identity = 'typemaps';

    public function render()
    {

        $data = $this->data;

        $item_markup     = '';
        $maps_url        = pbwp_get_item_options( $data, 'map_url' );
        $maps_marker     = pbwp_get_item_options( $data, 'map_custom_marker', 'no' );
        $marker_title    = pbwp_get_item_options( $data, 'map_marker_title', 'WP Composer' );
        $marker_desc     = pbwp_get_item_options( $data, 'map_marker_desc', base64_encode( 'A WordPress page builder designed for efficiency and speed, allowing quick creation of diverse layouts with streamlined functionality.' ) );
        $marker_icon     = pbwp_get_item_options( $data, 'icon' );
        $marker_img      = pbwp_get_item_options( $data, 'img_id' );
        $marker_tpl      = pbwp_get_item_options( $data, 'map_marker_template', 'style_01' );
        $marker_img_sz   = pbwp_get_item_options( $data, 'size', 'medium' );
        $marker_img_cs   = pbwp_get_item_options( $data, 'custom_size', '250x250' );
        $maps_height     = pbwp_get_item_options( $data, 'map_height', '350px' );
        $maps_zoom_level = pbwp_get_item_options( $data, 'map_zoom_level', 18 );
        $marker_content  = '';
        $maps_data       = [
            'maps'              => ( $maps_url ? $maps_url : 'none' ),
            'maps_height'       => $maps_height,
            'maps_id'           => $data[ 'id' ],
            'maps_marker_title' => $marker_title,
            'maps_marker'       => $maps_marker,
            'marker_content'    => base64_encode( $marker_content ),
            'marker_template'   => $marker_tpl,
            'maps_zoom_level'   => $maps_zoom_level,
         ];

        if ( $maps_marker == 'yes' ) {

            if ( ! isset( $data[ 'config' ][ 'css' ] ) ) {

                $data[ 'config' ][ 'css' ][ 'desktop' ]    = [  ];
                $data[ 'config' ][ 'css' ][ 'tablet' ]     = [  ];
                $data[ 'config' ][ 'css' ][ 'smartphone' ] = [  ];

            }

            if ( $marker_tpl == 'style_01' ) {

                $marker_desc = base64_decode( $marker_desc );

                $marker_img     = pbwp_get_attachment_image_src( $marker_img, $marker_img_sz, $marker_img_cs, null, '140x140' );
                $marker_content = '<div class="marker_tpl_style_01"><span class="wpc_maps_marker_close">&#10006;</span><div class="wpc_maps_media"><img class="wpc_maps_media_img" alt="'.esc_attr( $marker_img[ 'alt' ] ).'" src="'.esc_url( $marker_img[ 'url' ] ).'"/></div><div class="wpc_maps_content"><div class="wpc_maps_title">'.esc_html( $marker_title ).'</div><div class="wpc_maps_desc">'.pbwp_wp_editor_safe_content( $marker_desc ).'</div></div></div>';

            }

            if ( $marker_tpl == 'style_02' ) {

                if ( $marker_icon == '' ) {
                    $marker_icon = 'fa fa-magic';
                    wp_enqueue_style( 'fontawesome' );
                }

                $marker_icon    = pbwp_create_icon_markup( $marker_icon, 'wpc_maps_icon', '' );
                $marker_content = '<div class="marker_tpl_style_02">'.$marker_icon.'</div>';

            }

        }

        if ( isset( $data[ 'config' ][ 'css' ] ) && isset( $data[ 'config' ][ 'css' ][ 'desktop' ] ) && isset( $data[ 'config' ][ 'css' ][ 'desktop' ][ '.wpc_maps_styles|map_styles' ] ) ) {
            $maps_data[ 'maps_styles' ] = $data[ 'config' ][ 'css' ][ 'desktop' ][ '.wpc_maps_styles|map_styles' ];
        }

        $maps_data[ 'marker_content' ] = base64_encode( $marker_content );

        $item_markup .= '<div data-maps="'.esc_attr( htmlentities( serialize( $maps_data ) ) ).'" class="wpc_item_google_maps">';
        $item_markup .= '<div class="wpc_maps_canvas" id="maps_canvas_'.esc_attr( $data[ 'id' ] ).'" style="height: '.esc_attr(  ( is_numeric( $maps_height ) ? $maps_height.'px' : $maps_height ) ).';"></div>';
        $item_markup .= '</div>'; // End Maps Markup

        return $item_markup;

    }

}
