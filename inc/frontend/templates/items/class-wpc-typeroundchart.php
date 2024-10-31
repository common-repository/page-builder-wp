<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Round_Chart extends PBWP_Item_Loader
{

    protected $identity = 'typeroundchart';

    public function render()
    {

        $data = $this->data;

        $item_markup    = '';
        $title          = pbwp_get_item_options( $data, 'title' );
        $type           = pbwp_get_item_options( $data, 'type', 'doughnut' );
        $is_legend      = pbwp_get_item_options( $data, 'show_legend', 'yes' );
        $is_hover_value = pbwp_get_item_options( $data, 'show_hover_value', 'yes' );
        $gap            = pbwp_get_item_options( $data, 'gap', 0 );
        $css            = pbwp_get_item_options( $data, 'css' );
        $border_col     = ( isset( $css[ '.wpc_chart_item_border_only|chart_item_border' ] ) ? $css[ '.wpc_chart_item_border_only|chart_item_border' ] : '#ffffff' );
        $items_base     = $data[ 'config' ];
        $rc_data_front  = [
            'id'             => $data[ 'id' ],
            'type'           => $type,
            'is_legend'      => $is_legend,
            'is_hover_value' => $is_hover_value,
            'gap'            => (int) $gap,
            'rData'          => [  ],
         ];

        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'chartjs' );

        if ( $items_base ) {

            $all_items = pbwp_get_item_group_data( $data );

            foreach ( $all_items as $key => $val ) {

                $rc_data_front[ 'rData' ][ 'idx' ][  ]                                 = ( isset( $val[ 'id' ] ) ? esc_html( $val[ 'id' ] ) : esc_html( $key ) );
                $rc_data_front[ 'rData' ][ 'labels' ][  ]                              = ( isset( $val[ 'label' ] ) ? esc_html( $val[ 'label' ] ) : esc_html__( 'No Label', 'wp-composer' ) );
                $rc_data_front[ 'rData' ][ 'datasets' ][ 0 ][ 'backgroundColor' ][  ]  = ( isset( $val[ 'color' ] ) ? $val[ 'color' ] : '' );
                $rc_data_front[ 'rData' ][ 'datasets' ][ 0 ][ 'borderColor' ][  ]      = $border_col;
                $rc_data_front[ 'rData' ][ 'datasets' ][ 0 ][ 'hoverBorderColor' ][  ] = $border_col;
                $rc_data_front[ 'rData' ][ 'datasets' ][ 0 ][ 'data' ][  ]             = ( isset( $val[ 'value' ] ) ? $val[ 'value' ] : '' );

            }

            $item_markup .= '<div data-rc_data="'.esc_attr( htmlentities( serialize( $rc_data_front ) ) ).'" class="wpc_rchart_cont">';
            $item_markup .= '<h2 class="wpc_rc_title">'.esc_html( $title ).'</h2>';
            $item_markup .= '<div class="wpc_rchart_each">';
            $item_markup .= '<div class="wpc_rchart_item'.( $is_legend == 'yes' ? ' legend_active' : '' ).'">';
            $item_markup .= '<canvas width="100%" height="100%" class="wpc_rchart_canvas" id="wpc_rchart_'.esc_attr( $data[ 'id' ] ).'"></canvas>';
            $item_markup .= '</div>'; // End Round Chart item
            if ( $is_legend == 'yes' ) {
                $item_markup .= '<div id="rc_legend_'.esc_attr( $data[ 'id' ] ).'" class="wpc_chart_legend"></div>';
            }
            $item_markup .= '</div>'; // End Round Chart Each
            $item_markup .= '</div>'; // End Round Chart Cont

        } else {

            $item_markup = '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'No item found, please create first', 'wp-composer' ).'</span>';

        }

        return $item_markup;

    }

}
