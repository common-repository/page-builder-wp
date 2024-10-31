<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_GhozyLab_Plugins extends PBWP_Item_Loader
{

    protected $identity = [ 'ghozylabform', 'ghozylabslider', 'ghozylabgallery', 'ghozylabinstagram', 'ghozylabeasynotify' ];

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $type        = strtolower( $data[ 'type' ] );
        $label       = $data[ 'label' ];
        $id          = pbwp_get_item_options( $data, 'id', '' );

        $item_markup .= '<div class="wpc_item_ghozylabplugins">';

        if ( $id == '' || $id == 'none' ) {
            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'Please set the ID first', 'page-builder-wp' ).'</span></div>';

            return $item_markup;
        }

        if ( $type == 'ghozylabform' ) {

            if ( defined( 'ECF_VERSION' ) ) {
                $item_markup .= '[easy-contactform id="'.esc_html( $id ).'"]';
            } else {
                $item_markup .= $this->plugin_not_active_handle( $label );
            }

        }

        if ( $type == 'ghozylabslider' ) {

            if ( defined( 'EWIC_VERSION' ) ) {
                $item_markup .= '[espro-slider id="'.esc_html( $id ).'"]';
            } else {
                $item_markup .= $this->plugin_not_active_handle( $label );
            }

        }

        if ( $type == 'ghozylabinstagram' ) {

            if ( defined( 'IFLITE_VERSION' ) || defined( 'IFPRO_VERSION' ) ) {
                $item_markup .= '[ghozylab-instagram feed="'.esc_html( $id ).'"]';
            } else {
                $item_markup .= $this->plugin_not_active_handle( $label );
            }

        }

        if ( $type == 'ghozylabgallery' ) {

            if ( defined( 'EASYMEDIA_VERSION' ) ) {
                $item_markup .= '[easymedia-gallery med="'.esc_html( $id ).'"]';
            } else {
                $item_markup .= $this->plugin_not_active_handle( $label );
            }

        }

        if ( $type == 'ghozylabeasynotify' ) {

            if ( function_exists( 'enoty_get_option' ) ) {

                $defaultnoty = enoty_get_option( 'easynotify_defaultnotify' );

                if ( isset( $_COOKIE[ 'notify-'.$defaultnoty.'' ] ) ) {

                    $item_markup .= '[easy-notify id="'.esc_html( $id ).'"]';

                }

                if ( is_customize_preview() ) {
                    $item_markup .= '<span class="wpc-error-msg is-correct"><i class="wpc-i-correct"></i>'.esc_html__( 'Click here to edit Easy Notify item', 'page-builder-wp' ).'</span>';
                }

            } else {

                $item_markup .= $this->plugin_not_active_handle( $label );

            }

        }

        $item_markup .= '</div>'; // End GhozyLab Plugins Markup

        add_filter( 'pbwp_execute_wpc_raw_code_shortcode', function () {
            return 'has_pbwp_raw_shortcode';
        } );

        return $item_markup;

    }

    protected function plugin_not_active_handle( $name = '' )
    {

        if ( is_customize_preview() ) {

            return '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html( $name ).' '.esc_html__( 'plugin not active!', 'page-builder-wp' ).'</span>';

        }

    }

}
