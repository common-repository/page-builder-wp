<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Icon extends PBWP_Item_Loader
{

    protected $identity = 'typeicon';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $icon        = pbwp_get_item_options( $data, 'icon' );

        if ( $icon == '' ) {

            $icon     = 'fa fa-magic';
            $def_icon = [ 'fa fa-magic' ];
            pbwp_load_icon_library( $def_icon );

        }

        $item_markup .= '<div class="wpc_item_icon_cont">';
        $item_markup .= pbwp_create_icon_markup( $icon, 'wpc_item_icon' );
        $item_markup .= '</div>'; // End Icon Markup

        return $item_markup;

    }

}
