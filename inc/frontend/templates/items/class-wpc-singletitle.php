<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Single_Title extends PBWP_Item_Loader
{

    protected $identity = 'singletitle';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $title            = pbwp_get_item_options( $data, 'title', esc_html__( 'My Custom Heading', 'page-builder-wp' ) );
        $title_type       = pbwp_get_item_options( $data, 'type', 'h2' );
        $inlineEditorData = 'none';

        if ( is_customize_preview() ) {

            $inlineEditorData = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'title', 'escapeHTML' => true ] ) );

        }

        $item_markup .= '<div class="wpc_item_singletitle">';
        $item_markup .= '<'.esc_attr( $title_type ).' class="wpc_item_title" data-inline-editor="'.esc_attr( $inlineEditorData ).'">'.pbwp_wp_editor_safe_content( $title ).'</'.esc_attr( $title_type ).'>';
        $item_markup .= '</div>'; // End Single Title Markup

        return $item_markup;

    }

}
