<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Pricing_Box extends PBWP_Item_Loader
{

    protected $identity = 'typepricing';

    public function render()
    {

        $data = $this->data;

        $items           = $all_items           = $price_markup           = $title_markup           = $item_markup           = '';
        $template        = pbwp_get_item_options( $data, 'template', 'pc_style_01' );
        $title           = pbwp_get_item_options( $data, 'title', esc_html__( 'Your Title Here', 'wp-composer' ) );
        $items           = pbwp_get_item_options( $data, 'items', '', true );
        $price           = pbwp_get_item_options( $data, 'price', 99 );
        $price_per       = pbwp_get_item_options( $data, 'price_per', '/month' );
        $curr            = pbwp_get_item_options( $data, 'currency', '$' );
        $curr_format     = pbwp_get_item_options( $data, 'currency_format', 'before' );
        $icon            = pbwp_get_item_options( $data, 'icon' );
        $link_txt        = pbwp_get_item_options( $data, 'button_text', esc_html__( 'Buy Now', 'wp-composer' ) );
        $btn_link        = pbwp_get_item_options( $data, 'the_link', '#|_self' );
        $link_prop       = explode( '|', $btn_link );
        $link_prop       = 'href="'.esc_url( $link_prop[ 0 ] ).'" target="'.esc_attr( $link_prop[ 1 ] ).'" class="pc_button"';
        $inlineEditorTtl = $inlineEditorPrc = $inlineEditorPrcPer = $inlineEditorCur = $inlineEditorPcItem = $inlineEditorBtn = 'none';

        // Escape first
        $link_txt = esc_html( $link_txt );

        if ( is_customize_preview() ) {

            $inlineEditorTtl    = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'title', 'escapeHTML' => true, 'noBackground' => true ] ) );
            $inlineEditorPrc    = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'price', 'escapeHTML' => true ] ) );
            $inlineEditorCur    = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'currency', 'escapeHTML' => true ] ) );
            $inlineEditorPrcPer = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'price_per', 'escapeHTML' => true ] ) );
            $inlineEditorBtn    = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'button_text', 'escapeHTML' => true ] ) );
            $inlineEditorPcItem = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'items', 'escapeHTML' => true, 'extractHTML' => true, 'encode' => true ] ) );

        }

        $title_markup = '<div data-inline-editor="'.esc_attr( $inlineEditorTtl ).'" class="pc_title">'.esc_html( $title ).'</div>';
        $price_markup .= '<div class="pc_price_cont">';

        if ( $curr_format == 'before' ) {
            $price_markup .= '<span data-inline-editor="'.esc_attr( $inlineEditorCur ).'" class="pc_price_curr">'.esc_html( $curr ).'</span>';
        }

        $price_markup .= '<span data-inline-editor="'.esc_attr( $inlineEditorPrc ).'" class="pc_price">'.esc_html( $price ).'</span>';

        if ( $curr_format == 'after' ) {
            $price_markup .= '<span data-inline-editor="'.esc_attr( $inlineEditorCur ).'" class="pc_price_curr">'.esc_html( $curr ).'</span>';
        }

        if ( $price_per != 'none' ) {
            $price_markup .= '<span data-inline-editor="'.esc_attr( $inlineEditorPrcPer ).'" class="pc_price_per">'.esc_html( $price_per ).'</span>';
        }

        $price_markup .= '</div>'; // End Price

        $allowed = [
            'strong' => [  ],
            'em'     => [  ],
            'b'      => [  ],
            'i'      => [ 'class' => [  ] ],
            'span'   => [ 'class' => [  ] ],
         ];

        if ( $items ) {

            $items = explode( "\n", $items );
            $items = array_map( 'trim', $items );

            foreach ( $items as $key => $item ) {

                $all_items .= '<span class="pc_item'.( $key % 2 == 1 ? ' item_even' : ' item_odd' ).( is_customize_preview() ? ' live_editor_lists' : '' ).'">'.wp_kses( $item, $allowed ).'</span>';

            }

        }

        $item_markup .= '<div class="pc_box'.esc_attr( ' '.$template ).'">';
        $item_markup .= '<div class="pc_header">';

        if ( $template == 'pc_style_01' ) {
            $item_markup .= $title_markup;
        }

        if ( $template == 'pc_style_02' ) {
            $item_markup .= $price_markup;
        }

        if ( $icon != '' ) {
            $item_markup .= '<div class="pc_icon_cont">';
            $item_markup .= pbwp_create_icon_markup( $icon, 'pc_icon' );
            $item_markup .= '</div>'; // End Icon
        }

        if ( $template == 'pc_style_01' || $template == 'pc_style_03' ) {
            $item_markup .= $price_markup;
        }

        if ( $template == 'pc_style_02' || $template == 'pc_style_05' ) {
            $item_markup .= $title_markup;
        }

        $item_markup .= '</div>'; // End Pricing Header
        $item_markup .= '<div data-inline-editor="'.$inlineEditorPcItem.'" class="pc_item_cont">'.$all_items.'</div>';

        // End Items Container

        if ( $template == 'pc_style_04' || $template == 'pc_style_05' ) {
            $item_markup .= $price_markup;
        }

        if ( $template == 'pc_style_03' || $template == 'pc_style_04' ) {
            $item_markup .= $title_markup;
        }

        $item_markup .= '<div class="pc_footer"><a '.$link_prop.'><span data-inline-editor="'.esc_attr( $inlineEditorBtn ).'" class="pc_button_text">'.esc_html( $link_txt ).'</span></a></div>'; // End Footer
        $item_markup .= '</div>';

        return $item_markup;

    }

}
