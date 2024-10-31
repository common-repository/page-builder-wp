<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Call_To_Action extends PBWP_Item_Loader
{

    protected $identity = 'typecta';

    public function render()
    {

        $data = $this->data;

        $item_markup            = '';
        $template               = pbwp_get_item_options( $data, 'template', 'cta_style_01' );
        $cta_ttl                = pbwp_get_item_options( $data, 'title', ( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : esc_html__( 'Your Title Here', 'page-builder-wp' ) ) );
        $cta_desc               = pbwp_get_texteditor_content( $data, 'desc', ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'page-builder-wp' ) ) );
        $cta_btn_txt            = pbwp_get_item_options( $data, 'btn-text', esc_html__( 'Click Me', 'page-builder-wp' ) );
        $cta_btn_link           = pbwp_get_item_options( $data, 'the_link', '#|_self' );
        $icon_pos               = pbwp_get_item_options( $data, 'position', 'left' );
        $btn_icon               = pbwp_get_item_options( $data, 'icon' );
        $title_inlineEditorData = $desc_inlineEditorData = $btn_inlineEditorData = '';

        // Escape first
        $cta_btn_txt = esc_html( $cta_btn_txt );

        if ( is_customize_preview() ) {

            $title_inlineEditorData = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'title', 'escapeHTML' => true ] ) );
            $desc_inlineEditorData  = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'desc', 'encode' => true, 'toolbar' => true ] ) );
            $btn_inlineEditorData   = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'btn-text', 'escapeHTML' => true ] ) );
            $cta_btn_txt            = '<span data-inline-editor="'.esc_attr( $btn_inlineEditorData ).'">'.$cta_btn_txt.'</span>';

        }

        $link_prop = explode( '|', $cta_btn_link );
        $link_prop = 'href="'.esc_url( $link_prop[ 0 ] ).'" target="'.esc_attr( $link_prop[ 1 ] ).'"';

        if ( $icon_pos == 'left' && $btn_icon ) {
            $link_inner = '<span class="cta-btn">'.pbwp_create_icon_markup( $btn_icon ).$cta_btn_txt.'</span>';
        } else

        if ( $icon_pos == 'right' && $btn_icon ) {
            $link_inner = '<span class="cta-btn">'.$cta_btn_txt.pbwp_create_icon_markup( $btn_icon ).'</span>';
        } else {
            $link_inner = '<span class="cta-btn">'.$cta_btn_txt.'</span>';
        }

        $item_markup .= '<div class="wpc_item_typecta '.esc_attr( $template ).'">';
        $item_markup .= '<div class="wpc_cta_content">';
        $item_markup .= '<h2 data-inline-editor="'.esc_attr( $title_inlineEditorData ).'" class="cta-title">'.esc_html( $cta_ttl ).'</h2>';
        $item_markup .= '<div data-inline-editor="'.esc_attr( $desc_inlineEditorData ).'" class="cta-desc">'.pbwp_wp_editor_safe_content( $cta_desc ).'</div>';
        $item_markup .= '</div>'; // End CTA content
        $item_markup .= '<div class="cta-link">';
        $item_markup .= '<a '.$link_prop.'>'.$link_inner.'</a>';
        $item_markup .= '</div>'; // End CTA Link
        $item_markup .= '</div>'; // End CTA Markup

        return $item_markup;

    }

}
