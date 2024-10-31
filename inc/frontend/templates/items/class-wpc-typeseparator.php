<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Separator extends PBWP_Item_Loader
{

    protected $identity = 'typeseparator';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $sep_type         = pbwp_get_item_options( $data, 'type', 'line' );
        $sep_icon         = pbwp_get_item_options( $data, 'icon' );
        $sep_text         = pbwp_get_item_options( $data, 'text', esc_html__( 'My Separator Text', 'page-builder-wp' ) );
        $inlineEditorData = 'none';

        if ( is_customize_preview() ) {

            $inlineEditorData = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'text', 'escapeHTML' => true ] ) );

        }

        if ( $sep_type == 'line-icon' ) {
            $sep_cont = pbwp_create_icon_markup( $sep_icon, 'separator_icon' );
        } else

        if ( $sep_type == 'line-text' ) {
            $sep_cont = '<p data-inline-editor="'.esc_attr( $inlineEditorData ).'" class="separator_text">'.esc_html( $sep_text ).'</p>';
        } else {
            $sep_cont = '';
        }

        $item_markup .= '<div class="wpc_item_typeseparator wpc_separator_type_'.esc_attr( $sep_type ).'">';
        $item_markup .= '<span class="separator_line wpc_separator_'.esc_attr( $sep_type ).'"></span>';
        $item_markup .= $sep_cont;
        $item_markup .= '</div>'; // End Separator Markup

        return $item_markup;

    }

}
