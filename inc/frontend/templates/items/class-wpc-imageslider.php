<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Image_Slider extends PBWP_Item_Loader
{

    protected $identity = 'imageslider';

    public function render()
    {

        $data = $this->data;

        $item_markup    = '';
        $slider_ids     = pbwp_get_item_options( $data, 'img_id' );
        $effect         = pbwp_get_item_options( $data, 'effect', 'fade' );
        $speed          = pbwp_get_item_options( $data, 'speed', 1500 );
        $autoplay_delay = pbwp_get_item_options( $data, 'autoplay_delay', 3 );
        $navigation     = pbwp_get_item_options( $data, 'navigation', 'yes' );
        $pagination     = pbwp_get_item_options( $data, 'pagination', 'yes' );
        $use_thumb      = pbwp_get_item_options( $data, 'use_thumb', 'no' );

        $slider_data_front = [
            'effect'         => $effect,
            'speed'          => (int) $speed,
            'autoplay_delay' => (int) $autoplay_delay,
            'navigation'     => $navigation == 'yes' ? true : false,
            'pagination'     => $pagination == 'yes' ? true : false,
            'use_thumb'      => $use_thumb == 'yes' ? true : false,
         ];

        wp_enqueue_style( 'swiper' );
        wp_enqueue_script( 'swiper' );

        if ( $slider_ids == '' || is_array( $slider_ids ) ) {
            $slider_ids = pbwp_pick_wpc_dummy_random_image_id( 10, true, 10 );
        }

        if ( $slider_ids != '' ) {

            $slider_ids           = explode( ',', $slider_ids );
            $img_markup           = '';
            $transform_origin_pos = 0;
            $transform_origin     = [ 'center center', 'left top', 'right top', 'left bottom', 'right bottom' ];

            $item_markup .= '<div data-slider_data="'.esc_attr( htmlentities( serialize( $slider_data_front ) ) ).'" class="wpc_image_slider_item">';

            $item_markup .= '<div '.( is_rtl() ? 'dir="rtl" ' : '' ).'class="swiper wpc_image_slider __'.esc_attr( $effect ).'_effect">';
            $item_markup .= '<div class="swiper-wrapper">';

            foreach ( $slider_ids as $k => $each ) {

                $i_url          = wp_get_attachment_image_src( $each, 'full' );
                $i_url_src      = ( isset( $i_url[ 0 ] ) ? $i_url[ 0 ] : 'https://assets.wpcomposer.com/placehold/960x450/ec3d62/fff&text=Image+Not+Found' );
                $transform_attr = $effect === 'kenburn' ? 'data-transform-origin="'.$transform_origin[ $transform_origin_pos ].'" ' : '';

                $img_markup .= '<div class="swiper-slide"><img '.$transform_attr.'loading="lazy" class="swiper-slide-img" src="'.esc_attr( $i_url_src ).'"><div class="swiper-lazy-preloader"></div></div>';

                $transform_origin_pos = $transform_origin_pos + 1;

                if ( $transform_origin_pos > count( $transform_origin ) - 1 ) {
                    $transform_origin_pos = 0;
                }

            }

            $item_markup .= $img_markup;

            $item_markup .= '</div>';

            if ( $navigation === 'yes' ) {
                $item_markup .= '<div class="swiper-button-prev"></div>';
                $item_markup .= '<div class="swiper-button-next"></div>';
            }

            if ( $pagination === 'yes' ) {
                $item_markup .= '<div class="swiper-pagination"></div>';
            }

            $item_markup .= '</div>';

            if ( $use_thumb === 'yes' ) {
                $item_markup .= '<div '.( is_rtl() ? 'dir="rtl" ' : '' ).'thumbsSlider="" class="swiper wpc_image_slider_thumb">';
                $item_markup .= '<div class="swiper-wrapper">';
                $item_markup .= $img_markup;
                $item_markup .= '</div>';
                $item_markup .= '</div>';
            }

            $item_markup .= '</div>';

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Image Slider Error: '.esc_html__( 'No image found!', 'wp-composer' ).'</span>';

        }

        return $item_markup;

    }

}
