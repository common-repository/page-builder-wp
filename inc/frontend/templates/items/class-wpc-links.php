<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Links extends PBWP_Item_Loader
{

    protected $identity = 'links';

    public function render()
    {

        $data = $this->data;

        $item_markup = $inlineEditor = $inlineEditorTitle = '';
        $title       = pbwp_get_item_options( $data, 'link_title', 'Links' );
        $all_items   = pbwp_get_item_group_data( $data );

        if ( is_customize_preview() ) {
            $inlineEditorTitle = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'link_title', 'escapeHTML' => true ] ) );
        }

        $item_markup .= '<div class="wpc_item_links">';

        if ( $title != 'none' ) {
            $item_markup .= '<div class="wpc_links_title"><h4 data-inline-editor="'.esc_attr( $inlineEditorTitle ).'">'.esc_html( $title ).'</h4></div>';
        }

        $item_markup .= '<ul class="wpc_links_cont">';

        foreach ( $all_items as $key => $item ) {

            if ( is_customize_preview() ) {
                $inlineEditor = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => [ 'group' => 'group', 'index' => $key, 'key' => 'title', 'itemType' => $data[ 'type' ] ], 'escapeHTML' => true ] ) );
            }

            $item_markup .= '<li class="wpc_links_each_cont" data-selector="'.esc_attr(  ( isset( $item[ 'id' ] ) ? $item[ 'id' ] : $key ) ).'"><a data-inline-editor="'.esc_attr( $inlineEditor ).'" class="wpc_link_each" href="'.esc_url( $item[ 'link' ] ).'" target="'.esc_attr( $item[ 'target' ] ).'">'.esc_html( $item[ 'title' ] ).'</a></li>';

        }

        $item_markup .= '</ul>';  // End Links Cont
        $item_markup .= '</div>'; // End Links Markup

        return $item_markup;

    }

}
