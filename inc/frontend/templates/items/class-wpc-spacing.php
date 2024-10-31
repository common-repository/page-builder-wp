<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Spacing extends PBWP_Item_Loader
{

    protected $identity = 'spacing';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $height      = pbwp_get_item_options( $data, 'spacing', 25 );

        $item_markup .= '<div style="height: '.esc_attr( $height ).'px;" class="wpc_item_spacing">';

        if ( is_customize_preview() ) {
            $item_markup .= '<span class="wpc-error-msg is-correct" style="height: '.esc_attr( $height ).'px;"><span class="wpc_spacing_height"><i class="wpc-i-correct"></i><strong>'.esc_html__( 'Spacing Height', 'page-builder-wp' ).': '.esc_html( $height ).'px</strong>&nbsp;&nbsp;( '.esc_html__( 'This green block only visible in edit mode', 'page-builder-wp' ).' )</span></span>';
        }

        $item_markup .= '</div>'; // End Spacing Markup
        $item_markup .= '<div class="wpc_front_clear_both"></div>';

        return $item_markup;

    }

}
