<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Image extends PBWP_Item_Loader
{

    protected $identity = 'typeimage';

    public function render()
    {

        $data = $this->data;

        $item_markup  = $sing_img  = '';
        $img_id       = pbwp_get_item_options( $data, 'img_id', pbwp_pick_wpc_dummy_random_image_id( 1, true ) );
        $img_size     = pbwp_get_item_options( $data, 'size' );
        $custom_size  = pbwp_get_item_options( $data, 'custom_size', '250x250' );
        $is_lazy      = pbwp_get_item_options( $data, 'img_lazyload' );
        $overlay      = pbwp_get_item_options( $data, 'img_overlay', 'no' );
        $icon         = pbwp_get_item_options( $data, 'icon' );
        $use_filter   = pbwp_get_item_options( $data, 'use_img_ig_filter' );
        $image_filter = pbwp_get_item_options( $data, 'img_ig_filters', 'hefe' );

        if ( $use_filter != 'yes' ) {
            $image_filter = 'normal';
        }

        if ( $overlay == 'yes' || is_customize_preview() ) {

            wp_enqueue_style( 'lightcase' );
            wp_enqueue_script( 'lightcase' );

            if ( $icon == '' ) {
                wp_enqueue_style( 'icomoon' );
                $icon = 'icomoon-camera';
            }

        }

        if ( $is_lazy == 'yes' || is_customize_preview() ) {
            wp_enqueue_script( 'lazyloadjquery' );
        }

        $sing_img = pbwp_get_attachment_image_src( $img_id, $img_size, $custom_size );

        $item_markup .= '<div class="wpc-item-image wpc-img-lazy '.( $overlay == 'yes' ? ' wpc_img_overlay_cont wpc_img_inline_block' : '' ).'">';

        if ( $overlay == 'yes' ) {
            $item_markup .= '<a class="showcase" data-rel="lightcase" href="'.esc_url( $sing_img[ 'full_size_uri' ] ).'">';
            $item_markup .= '<div class="wpc_img_overlay"></div>';
        }

        $item_markup .= '<img alt="'.esc_attr( $sing_img[ 'alt' ] ).'" class="wpc-image-filter-'.esc_attr( $image_filter ).' wpc_image_filter_ready wpc_single_image'.( $is_lazy == 'yes' ? ' wpc_lazyLoad' : '' ).'" '.( $is_lazy == 'yes' ? 'data-' : '' ).'src="'.esc_url( $sing_img[ 'url' ] ).'"/>';

        if ( $overlay == 'yes' ) {

            $icon_title = '';
            if ( strpos( $icon, 'material-icons' ) !== false ) {
                $split      = explode( ' ', $icon );
                $icon_title = $split[ 1 ];
            }

            $item_markup .= '<div class="overlay_info fadeIn-top">';
            $item_markup .= '<i class="'.esc_attr( $icon ).'">'.esc_html( $icon_title ).'</i>';
            $item_markup .= '<span class="gallery_title">'.esc_html( $sing_img[ 'alt' ] ).'</span>';
            $item_markup .= '</div>';

            $item_markup .= '</a>';

        }

        $item_markup .= '</div>'; // End Image Markup

        return $item_markup;

    }

}
