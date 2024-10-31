<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Social_Link extends PBWP_Item_Loader
{

    protected $identity = 'sociallink';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $all_items   = pbwp_get_item_group_data( $data );

        $item_markup .= '<div class="wpc_item_sociallink">';
        $item_markup .= '<ul class="wpc_scl_cont">';

        foreach ( $all_items as $item ) {

            $sc_link = ( isset( $item[ 'sc_link' ] ) ? $item[ 'sc_link' ] : '#' );
            $sc_type = ( isset( $item[ 'sc_type' ] ) ? $item[ 'sc_type' ] : 'facebook' );

            $item_markup .= '<li class="wpc_scl_each_cont"><a class="wpc_scl_each wpc_scl_'.esc_attr( $sc_type ).'" href="'.esc_url( $sc_link ).'" target="blank"><i class="wpc-i-'.esc_attr( $sc_type ).'"></i></a></li>';

        }

        $item_markup .= '</ul>';  // End Social Link Cont
        $item_markup .= '</div>'; // End Social Link Markup

        return $item_markup;

    }

}
