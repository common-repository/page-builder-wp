<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Html_Raw extends PBWP_Item_Loader
{

    protected $identity = 'htmlraw';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $code        = pbwp_get_item_options( $data, 'code' );

        if ( trim( $code ) === '' ) {
            if ( is_customize_preview() ) {
                $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'No CODE!', 'page-builder-wp' ).'</span>';
            }

        } else {

            if ( pbwp_on_debug_mode() ) {
                return pbwp_base64_decode( $code );
            }
            $item_markup .= '[pbwp_raw_shortcode data="'.esc_attr( $code ).'"]';

            add_filter( 'pbwp_execute_wpc_raw_code_shortcode', function () {
                return 'has_pbwp_raw_shortcode';
            } );
        }

        return $item_markup;

    }

}
