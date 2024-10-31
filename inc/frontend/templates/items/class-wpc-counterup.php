<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Counter_Up extends PBWP_Item_Loader
{

    protected $identity = 'counterup';

    public function render()
    {

        $data = $this->data;

        $item_markup     = $iconmarkup     = $nummarkup     = $lblmarkup     = '';
        $count_to        = pbwp_get_item_options( $data, 'count_to', 100 );
        $count_to_suffix = pbwp_get_item_options( $data, 'count_to_suffix', 'k' );
        $label           = pbwp_get_item_options( $data, 'label', esc_html__( 'Download', 'wp-composer' ) );
        $is_icon         = pbwp_get_item_options( $data, 'cup_icon', 'yes' );
        $icon            = pbwp_get_item_options( $data, 'icon', 'fa fa-download' );
        $template        = pbwp_get_item_options( $data, 'template', 'cup_style_01' );
        $inlineEditorNum = $inlineEditorSfx = $inlineEditorLbl = 'none';

        if ( is_customize_preview() ) {

            $inlineEditorNum = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'count_to', 'escapeHTML' => true, 'applyChanges' => true ] ) );
            $inlineEditorSfx = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'count_to_suffix', 'escapeHTML' => true ] ) );
            $inlineEditorLbl = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'label', 'escapeHTML' => true ] ) );

        }

        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'counterup' );

        $item_markup .= '<div class="cup_item_cont">';

        if ( $is_icon == 'yes' && $icon != '' ) {
            $iconmarkup = '<div class="cup_icon_cont">'.pbwp_create_icon_markup( $icon, 'cup_icon' ).'</div>';
        }

        if ( $count_to != '' ) {
            $nummarkup = '<div class="cup_number_cont"><div data-inline-editor="'.esc_attr( $inlineEditorNum ).'" class="cup_number">'.esc_html( $count_to ).'</div><span data-inline-editor="'.esc_attr( $inlineEditorSfx ).'" class="cup_number_suffix">'.esc_html( $count_to_suffix ).'</span></div>';
        }

        if ( $label != '' ) {
            $lblmarkup = '<div class="cup_label_cont"><div data-inline-editor="'.esc_attr( $inlineEditorLbl ).'" class="cup_label">'.esc_html( $label ).'</div></div>';
        }

        if ( $template == 'cup_style_01' ) {
            $item_markup .= $iconmarkup.$nummarkup.$lblmarkup;
        } else

        if ( $template == 'cup_style_02' ) {
            $item_markup .= $iconmarkup.$lblmarkup.$nummarkup;
        } else {
            $item_markup .= $lblmarkup.$iconmarkup.$nummarkup;
        }

        $item_markup .= '</div>'; // End Counter Box

        return $item_markup;

    }

}
