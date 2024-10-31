<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Image_Comparison extends PBWP_Item_Loader
{

    protected $identity = 'imagecomparison';

    public function render()
    {

        $data = $this->data;

        $item_markup  = '';
        $img_before   = pbwp_get_item_options( $data, 'img_before', '' );
        $img_after    = pbwp_get_item_options( $data, 'img_after', '' );
        $orientation  = pbwp_get_item_options( $data, 'orientation', 'horizontal' );
        $offset       = pbwp_get_item_options( $data, 'offset', 2 );
        $overlay      = pbwp_get_item_options( $data, 'overlay', 'yes' );
        $before_label = pbwp_get_item_options( $data, 'before_label', esc_html__( 'Before', 'page-builder-wp' ) );
        $after_label  = pbwp_get_item_options( $data, 'after_label', esc_html__( 'After', 'page-builder-wp' ) );

        wp_enqueue_style( 'twentytwenty' );
        wp_enqueue_script( 'eventmove' );
        wp_enqueue_script( 'twentytwenty' );

        $img_before = ( $img_before ? pbwp_get_attachment_image_src( $img_before ) : pbwp_frontend_asset_url( 'css/vendors/twentytwenty/before_after/before.jpg' ) );
        $img_after  = ( $img_after ? pbwp_get_attachment_image_src( $img_after ) : pbwp_frontend_asset_url( 'css/vendors/twentytwenty/before_after/after.jpg' ) );

        if ( is_customize_preview() ) {
            $this->custom_class = 'exclude_from_click_edit';
        }

        $item_markup .= '<div data-overlay="'.esc_attr(  ( $overlay === 'yes' ? false : true ) ).'" data-before-label="'.esc_attr( $before_label ).'" data-after-label="'.esc_attr( $after_label ).'" data-offset="'.esc_attr( $offset ).'" data-orientation="'.esc_attr( $orientation ).'" class="wpc_ba_container twentytwenty-container">';
        $item_markup .= '<img class="wpc_ba_img" src="'.esc_url( is_array( $img_before ) ? $img_before[ 'full_size_uri' ] : $img_before ).'" />';
        $item_markup .= '<img class="wpc_ba_img" src="'.esc_url( is_array( $img_after ) ? $img_after[ 'full_size_uri' ] : $img_after ).'" />';
        $item_markup .= '</div>';

        return $item_markup;

    }

}
