<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Alert_Box extends PBWP_Item_Loader
{

    protected $identity = 'alertbox';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $alert_text  = pbwp_get_item_options( $data, 'text', ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'page-builder-wp' ) ), true );
        $icon_pos    = pbwp_get_item_options( $data, 'position', 'left' );
        $alert_icon  = pbwp_get_item_options( $data, 'icon' );

        if ( is_customize_preview() ) {
            $alert_text = '<h4 data-inline-editor="'.esc_attr( htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'text', 'encode' => true ] ) ) ).'">'.pbwp_wp_editor_safe_content( $alert_text ).'</h4>';
        } else {
            $alert_text = '<h4>'.pbwp_wp_editor_safe_content( $alert_text ).'</h4>';
        }

        if ( $alert_icon == '' ) {
            wp_enqueue_style( 'icomoon' );
            $alert_icon = 'icomoon-info2';
        }

        if ( $icon_pos == 'left' && $alert_icon ) {
            $alert = '<div class="alert_icon_cont">'.pbwp_create_icon_markup( $alert_icon, 'item_alert_icon' ).'</div><div class="alert_text">'.$alert_text.'</div>';
        } else

        if ( $icon_pos == 'right' && $alert_icon ) {
            $alert = '<div class="alert_text">'.$alert_text.'</div><div class="alert_icon_cont">'.pbwp_create_icon_markup( $alert_icon, 'item_alert_icon' ).'</div>';
        } else {
            $alert = '<div class="alert_text">'.$alert_text.'</div>';
        }

        $item_markup .= '<div class="wpc_item_alertbox alert_icon_pos_'.esc_attr( $icon_pos ).'">';
        $item_markup .= $alert;
        $item_markup .= '</div>'; // End AlertBox Markup

        return $item_markup;

    }

}
