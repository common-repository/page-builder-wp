<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_List extends PBWP_Item_Loader
{

    protected $identity = 'typelist';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $list_icon        = [  ];
        $is_empty         = false;
        $shape            = pbwp_get_item_options( $data, 'list_shape', 'list_shape_circle' );
        $list_line_pos    = pbwp_get_item_options( $data, 'list_line_pos', 'top' );
        $inlineEditorList = '';

        $all_items = pbwp_get_item_group_data( $data );

        $item_markup .= '<div data-shape="'.esc_attr( $shape ).'" class="wpc_item_typelist '.esc_attr( $shape ).'">';

        foreach ( $all_items as $key => $val ) {

            $num       = $key + 1;
            $list_text = ( isset( $val[ 'list_content' ] ) ? ( ! $is_empty ? $val[ 'list_content' ] : $val[ 'list_content' ] ) : '' );

            if ( is_customize_preview() ) {

                $inlineEditorList = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => [ 'group' => 'group', 'index' => $key, 'key' => 'list_content', 'itemType' => $data[ 'type' ] ], 'encode' => true, 'toolbar' => true ] ) );

            }

            $item_markup .= '<div data-selector="'.esc_attr(  ( isset( $val[ 'id' ] ) ? $val[ 'id' ] : $key ) ).'" class="wpc_item_list_each">';

            if ( $shape == 'list_shape_icon' ) {
                // Push each icon to array
                $list_icon[  ] = ( isset( $val[ 'icon' ] ) ? $val[ 'icon' ] : 'fa fa-chevron-circle-right' );
                $item_markup .= '<div class="wpc_list_icon_cont">';
                $item_markup .= pbwp_create_icon_markup( $list_icon[ $key ], 'listIconMode' );
                $item_markup .= '</div>';
            } else {
                $item_markup .= '<div class="wpc_list_number_cont">';
                $item_markup .= '<div class="list_shape"><span class="wpc_list_number">'.esc_html( $num ).'</span></div>';
                $item_markup .= '</div>';
            }

            $item_markup .= '<div class="wpc_list_text_cont listposition_'.esc_attr( $list_line_pos ).' wpc_list_text" data-inline-editor="'.esc_attr( $inlineEditorList ).'">'.pbwp_wp_editor_safe_content( $list_text ).'</div>';
            $item_markup .= '</div>';

        }

        // Load icon library
        if ( $shape == 'list_shape_icon' ) {
            pbwp_load_icon_library( $list_icon );
        }

        $item_markup .= '</div>'; // End List Markup

        return $item_markup;

    }

}
