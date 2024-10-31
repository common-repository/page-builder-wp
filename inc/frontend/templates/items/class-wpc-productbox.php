<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Product_Box extends PBWP_Item_Loader
{

    protected $identity = 'productbox';

    public function render()
    {

        $data = $this->data;

        $item_markup     = '';
        $title           = pbwp_get_item_options( $data, 'title', esc_html__( 'Your Product Title Here', 'page-builder-wp' ) );
        $desc            = pbwp_get_texteditor_content( $data, 'productdesc', ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'page-builder-wp' ) ) );
        $misc            = pbwp_get_item_options( $data, 'misc', esc_html__( 'Your Misc Text Here', 'page-builder-wp' ) );
        $prd_img         = pbwp_get_item_options( $data, 'img_id' );
        $prd_size        = pbwp_get_item_options( $data, 'size', 'medium' );
        $custom_size     = pbwp_get_item_options( $data, 'custom_size', '250x250' );
        $link_txt        = pbwp_get_item_options( $data, 'btn_text', esc_html__( 'My Button', 'page-builder-wp' ) );
        $btn_link        = pbwp_get_item_options( $data, 'the_link', '#|_self' );
        $btn_pos         = pbwp_get_item_options( $data, 'position', 'left' );
        $btn_icon        = pbwp_get_item_options( $data, 'icon' );
        $use_filter      = pbwp_get_item_options( $data, 'use_img_ig_filter' );
        $image_filter    = pbwp_get_item_options( $data, 'img_ig_filters', 'hefe' );
        $inlineEditorTtl = $inlineEditorDesc = $inlineEditorMisc = $inlineEditorBtn = 'none';

        // Escape first
        $link_txt = esc_html( $link_txt );

        if ( $use_filter != 'yes' ) {
            $image_filter = 'normal';
        }

        if ( is_customize_preview() ) {

            $inlineEditorTtl  = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'title', 'escapeHTML' => true ] ) );
            $inlineEditorDesc = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'productdesc', 'toolbar' => true, 'encode' => true ] ) );
            $inlineEditorMisc = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'misc', 'escapeHTML' => true ] ) );
            $inlineEditorBtn  = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'btn_text', 'escapeHTML' => true ] ) );

            $link_txt = '<span data-inline-editor="'.esc_attr( $inlineEditorBtn ).'">'.$link_txt.'</span>';

        }

        $link_prop = explode( '|', $btn_link );
        $link_prop = 'href="'.esc_url( $link_prop[ 0 ] ).'" target="'.esc_attr( $link_prop[ 1 ] ).'"';

        if ( $btn_pos == 'left' && $btn_icon ) {
            $link_inner = '<span class="prd_button_text">'.pbwp_create_icon_markup( $btn_icon ).$link_txt.'</span>';
        } else

        if ( $btn_pos == 'right' && $btn_icon ) {
            $link_inner = '<span class="prd_button_text">'.$link_txt.pbwp_create_icon_markup( $btn_icon ).'</span>';
        } else {
            $link_inner = '<span class="prd_button_text">'.$link_txt.'</span>';
        }

        $prd_img = pbwp_get_attachment_image_src( $prd_img, $prd_size, $custom_size );

        $item_markup .= '<div class="prd_box">';

        if ( is_array( $prd_img ) ) {
            $item_markup .= '<div class="prd_image"><img class="wpc-image-filter-'.esc_attr( $image_filter ).' wpc_image_filter_ready" src="'.esc_url( $prd_img[ 'url' ] ).'" alt="'.esc_attr( $prd_img[ 'alt' ] ).'"/></div>';
        }

        // End Image
        $item_markup .= '<div data-inline-editor="'.esc_attr( $inlineEditorTtl ).'" class="prd_title">'.esc_html( $title ).'</div>';

        // End Title
        if ( $misc && $misc != 'none' || $misc == esc_html__( 'Your Misc Text Here', 'page-builder-wp' ) ) {
            $item_markup .= '<div data-inline-editor="'.esc_attr( $inlineEditorMisc ).'" class="prd_misc">'.esc_html( $misc ).'</div>';
        }

        // End Misc
        if ( trim( wpautop( $desc ), "\n" ) != '<p>none</p>' && trim( $desc, "\n" ) != '' ) {
            $item_markup .= '<div data-inline-editor="'.esc_attr( $inlineEditorDesc ).'" class="prd_desc">'.pbwp_wp_editor_safe_content( $desc ).'</div>';
        }

        // End ProductBox Text
        $item_markup .= '<div class="prd_button">';
        $item_markup .= '<a '.$link_prop.'>'.$link_inner.'</a>';
        $item_markup .= '</div></div>'; // End Button Markup > ProductBox Box

        return $item_markup;

    }

}
