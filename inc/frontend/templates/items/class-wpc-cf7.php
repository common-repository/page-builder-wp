<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_CF7 extends PBWP_Item_Loader
{

    protected $identity = 'cf7';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $formID      = pbwp_get_item_options( $data, 'cf7_form', 'none' );

        $item_markup .= '<div class="wpc_item_cf7">';

        if ( $formID == '' || $formID == 'none' ) {
            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Contact Form 7 Error: '.esc_html__( 'No Form found!', 'page-builder-wp' ).'</span>';
        } else {
            $item_markup .= do_shortcode( '[contact-form-7 id="'.esc_html( $formID ).'"]' );
        }

        $item_markup .= '</div>'; // End Contact Form 7 Markup

        return $item_markup;

    }

}
