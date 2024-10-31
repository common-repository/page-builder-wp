<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Text_Editor extends PBWP_Item_Loader
{

    protected $identity = 'texteditor';

    public function render()
    {

        $item_markup      = '';
        $content          = pbwp_get_texteditor_content( $this->data, 'text-editor' );
        $inlineEditorData = 'none';

        if ( is_customize_preview() ) {

            $inlineEditorData = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'text-editor', 'encode' => true, 'toolbar' => true ] ) );

        }

        $item_markup .= '<div data-inline-editor="'.esc_attr( $inlineEditorData ).'" class="text_editor_content">';

        if (  ( $content == '' || $content == '<p>&nbsp;</p>' ) && is_customize_preview() ) {

            $item_markup .= '<span class="wpc-error-msg is-correct"><i class="wpc-i-correct"></i><span class="wpc_empty_texteditor">'.esc_html__( 'Empty content, please write something :)', 'page-builder-wp' ).'</span></span>';

        }

        $item_markup .= pbwp_wp_editor_safe_content( $content );

        $item_markup .= '</div>'; /* End Text Editor Markup */

        return $item_markup;

    }

}
