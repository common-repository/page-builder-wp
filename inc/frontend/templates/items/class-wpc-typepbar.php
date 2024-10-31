<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Progress_Bar extends PBWP_Item_Loader
{

    protected $identity = 'typepbar';

    public function render()
    {

        $data = $this->data;

        $item_markup   = '';
        $style         = pbwp_get_item_options( $data, 'style', 'animated striped' );
        $unit          = pbwp_get_item_options( $data, 'units', '%' );
        $label_pos     = pbwp_get_item_options( $data, 'label_pos', 'middle' );
        $items_base    = $data[ 'config' ];
        $pb_data_front = [
            'id' => $data[ 'id' ],
         ];
        $inlineEditorPbLbl = $inlineEditorPbVal = $inlineEditorPbUnt = '';

        if ( $items_base ) {

            wp_enqueue_script( 'waypoints' );

            $all_items = pbwp_get_item_group_data( $data );

            $item_markup .= '<div data-pb_data="'.esc_attr( htmlentities( serialize( $pb_data_front ) ) ).'" class="wpc_pbar_cont">';
            $item_markup .= '<div class="wpc_pbars">';

            foreach ( $all_items as $key => $val ) {

                $label = ( isset( $val[ 'label' ] ) ? $val[ 'label' ] : '' );
                $value = ( isset( $val[ 'value' ] ) ? $val[ 'value' ] : '' );

                // Escape first
                $value = esc_html( $value );

                if ( is_customize_preview() ) {

                    $inlineEditorPbLbl = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => [ 'group' => 'group', 'index' => $key, 'key' => 'label', 'itemType' => $data[ 'type' ] ], 'escapeHTML' => false ] ) );
                    $inlineEditorPbVal = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => [ 'group' => 'group', 'index' => $key, 'key' => 'value', 'itemType' => $data[ 'type' ] ], 'escapeHTML' => false, 'applyChanges' => true ] ) );
                    $inlineEditorPbUnt = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'units', 'escapeHTML' => false, 'applyChanges' => true ] ) );

                }

                $labelMarkup = '<div class="wpc_bar_label_cont'.( $label_pos == 'top' ? ' label_top_pos' : '' ).'"><span data-inline-editor="'.esc_attr( $inlineEditorPbLbl ).'" class="wpc_bar_label">'.esc_html( $label ).'</span><span data-inline-editor="'.esc_attr( $inlineEditorPbVal ).'" class="wpc_label_units">'.esc_html( $value ).'</span><span data-inline-editor="'.esc_attr( $inlineEditorPbUnt ).'" class="pb_unit_after">'.esc_html( $unit ).'</span></div>';

                if ( $label_pos == 'top' ) {
                    $item_markup .= $labelMarkup;
                }

                $item_markup .= '<div data-selector="'.esc_attr(  ( isset( $val[ 'id' ] ) ? $val[ 'id' ] : $key ) ).'" class="wpc_bar_item">'.$labelMarkup.'<span class="wpc_bar '.esc_attr( $style ).'" data-bar_value="'.esc_attr( $value ).'"></span></div>';

            }

            $item_markup .= '</div>'; // End Progress Item
            $item_markup .= '</div>'; // End Progress Bar Markup

        } else {

            $item_markup = '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'No item found, please create first', 'wp-composer' ).'</span>';

        }

        return $item_markup;

    }

}
