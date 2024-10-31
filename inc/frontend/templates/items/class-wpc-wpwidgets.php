<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Wp_Widgets extends PBWP_Item_Loader
{

    protected $identity = [ 'wprcpost', 'wprccom', 'wpcat', 'wptcloud', 'wpmeta', 'wpvideo', 'wpaudio' ];

    public function render()
    {

        $data = $this->data;

        $item_markup  = '';
        $type         = strtolower( $data[ 'type' ] );
        $instance     = [ 'title' => pbwp_get_item_options( $data, 'title' ) ];
        $args         = [ 'before_widget' => '<div class="widget %1$s item_wp_widget">', 'after_widget' => '</div>' ];
        $widget_class = [ 'wprcpost' => 'WP_Widget_Recent_Posts', 'wprccom' => 'WP_Widget_Recent_Comments', 'wpcat' => 'WP_Widget_Categories', 'wptcloud' => 'WP_Widget_Tag_Cloud', 'wpmeta' => 'WP_Widget_Meta', 'wpvideo' => 'WP_Widget_Media_Video', 'wpaudio' => 'WP_Widget_Media_Audio' ];
        $widget       = $widget_class[ $type ];

        if ( $type == 'wpvideo' ) {
            $instance[ 'attachment_id' ] = pbwp_get_item_options( $data, 'video_url' );
        }

        if ( $type == 'wpaudio' ) {
            $instance[ 'attachment_id' ] = pbwp_get_item_options( $data, 'audio_url' );
        }

        if ( $type == 'wptcloud' ) {
            $instance[ 'taxonomy' ] = pbwp_get_item_options( $data, 'taxonomy' );
        }

        if ( $type == 'wprccom' ) {
            $instance[ 'number' ] = pbwp_get_item_options( $data, 'number', 5 );
        }

        if ( $type == 'wprcpost' ) {
            $show_date               = ( pbwp_get_item_options( $data, 'show_date', true ) == 'yes' ? true : false );
            $instance[ 'number' ]    = pbwp_get_item_options( $data, 'number', 5 );
            $instance[ 'show_date' ] = $show_date;
        }

        if ( $type == 'wpcat' ) {
            $instance[ 'count' ]        = ( pbwp_get_item_options( $data, 'count' ) == 'yes' ? true : false );
            $instance[ 'dropdown' ]     = ( pbwp_get_item_options( $data, 'dropdown' ) == 'yes' ? true : false );
            $instance[ 'hierarchical' ] = ( pbwp_get_item_options( $data, 'hierarchical' ) == 'yes' ? true : false );
        }

        $this->custom_class = 'wpc_wpwidget';

        $item_markup .= '<div class="wpc_wpwidget_cont">';
        ob_start();
        the_widget( $widget, $instance, $args );
        $item_markup .= ob_get_clean();
        $item_markup .= '</div>';

        return $item_markup;

    }

}
