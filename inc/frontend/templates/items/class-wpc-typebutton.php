<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Button extends PBWP_Item_Loader
{

    protected $identity = 'typebutton';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $link_txt         = pbwp_get_item_options( $data, 'btn_text', esc_html__( 'My Button', 'page-builder-wp' ) );
        $btn_link         = pbwp_get_item_options( $data, 'the_link', '#|_self' );
        $btn_pos          = pbwp_get_item_options( $data, 'position', 'left' );
        $btn_icon         = pbwp_get_item_options( $data, 'icon' );
        $inlineEditorData = 'none';

        if ( is_customize_preview() ) {

            $inlineEditorData = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'btn_text', 'escapeHTML' => true ] ) );

            $link_txt = '<span data-inline-editor="'.esc_attr( $inlineEditorData ).'">'.esc_html( $link_txt ).'</span>';

        }

        $link_prop = explode( '|', $btn_link );
        $link_prop = 'href="'.esc_url( $link_prop[ 0 ] ).'" target="'.esc_attr( $link_prop[ 1 ] ).'"';

        if ( $btn_pos === 'left' && $btn_icon ) {
            $link_inner = pbwp_create_icon_markup( $btn_icon, 'wpc_button_icon_left' ).$link_txt;
        } else

        if ( $btn_pos === 'right' && $btn_icon ) {
            $link_inner = $link_txt.pbwp_create_icon_markup( $btn_icon, 'wpc_button_icon_right' );
        } else {
            $link_inner = $link_txt;
        }

        $item_markup .= '<div class="wpc_item_typebutton wpc_item_button">';
        $item_markup .= wp_kses_post( '<a '.$link_prop.'><span class="wpc_button_text">'.$link_inner.'</span></a>' );
        $item_markup .= '</div>'; // End Button Markup

        return $item_markup;

    }

}
