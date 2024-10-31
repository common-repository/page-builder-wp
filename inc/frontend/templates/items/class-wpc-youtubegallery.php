<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Youtube_Gallery extends PBWP_Item_Loader
{

    protected $identity = 'youtubegallery';

    public function render()
    {

        $data = $this->data;

        $item_markup    = '';
        $vid_col        = pbwp_get_item_options( $data, 'vid_col', 3 );
        $ytg_data_front = [
            'autoplay' => pbwp_get_item_options( $data, 'autoplay', 'yes' ),
         ];

        wp_enqueue_style( 'youtubegallerywall' );
        wp_enqueue_script( 'youtubegallerywall' );

        $all_items = pbwp_get_item_group_data( $data );

        $item_markup .= '<div class="wpc_item_youtubegallery">';
        $item_markup .= '<ul data-ytg_data="'.esc_attr( htmlentities( serialize( $ytg_data_front ) ) ).'" class="wpc_ytg_cont" id="ytg'.esc_attr( $data[ 'id' ] ).'">';

        $vid_col_w = 100 / $vid_col;

        foreach ( $all_items as $val ) {

            $vid_url   = ( isset( $val[ 'url' ] ) ? $val[ 'url' ] : 'https://www.youtube.com/watch?v=1y_kfWUCFDQ' );
            $thumb_ver = ( isset( $val[ 'thumb_ver' ] ) ? $val[ 'thumb_ver' ] : 'mqdefault' );

            $item_markup .= '<li class="wpc_ytg_each" style="width: '.esc_attr( $vid_col_w ).'%;" data-thumb_version="'.esc_attr( $thumb_ver ).'"><a href="'.esc_url( $vid_url ).'"></a></li>';

        }

        $item_markup .= '</ul>';  // End Video Gallery Cont
        $item_markup .= '</div>'; // End Video Gallery Markup

        return $item_markup;

    }

}
