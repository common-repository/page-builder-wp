<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Line_Chart extends PBWP_Item_Loader
{

    protected $identity = 'typelinechart';

    public function render()
    {

        $data = $this->data;

        $item_markup     = '';
        $title           = pbwp_get_item_options( $data, 'title' );
        $type            = pbwp_get_item_options( $data, 'type', 'bar' );
        $is_legend       = pbwp_get_item_options( $data, 'show_legend', 'yes' );
        $is_hover_value  = pbwp_get_item_options( $data, 'show_hover_value', 'yes' );
        $x_axis          = pbwp_get_item_options( $data, 'x_axis', 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG' );
        $items_base      = $data[ 'config' ];
        $show_x_line     = pbwp_get_item_options( $data, 'x_gridline', 'yes' );
        $show_y_line     = pbwp_get_item_options( $data, 'y_gridline', 'yes' );
        $css             = pbwp_get_item_options( $data, 'css' );
        $x_axist_ttl_col = ( isset( $css[ '.wpc_chart_x_axist_col|chart_x_axist_col' ] ) ? $css[ '.wpc_chart_x_axist_col|chart_x_axist_col' ] : '#707070' );
        $y_axist_ttl_col = ( isset( $css[ '.wpc_chart_y_axist_col|chart_y_axist_col' ] ) ? $css[ '.wpc_chart_y_axist_col|chart_y_axist_col' ] : '#707070' );
        $grid_line_col   = ( isset( $css[ '.wpc_chart_line_axist_col|chart_grid_line_col' ] ) ? $css[ '.wpc_chart_line_axist_col|chart_grid_line_col' ] : '#e6e6e6' );

        $lc_data_front = [
            'id'             => $data[ 'id' ],
            'type'           => $type,
            'x_axis'         => $x_axis,
            'show_x_line'    => ( $show_x_line == 'yes' ? true : false ),
            'show_y_line'    => ( $show_y_line == 'yes' ? true : false ),
            'line_color'     => $grid_line_col,
            'x_axist_color'  => $x_axist_ttl_col,
            'y_axist_color'  => $y_axist_ttl_col,
            'is_legend'      => $is_legend,
            'is_hover_value' => $is_hover_value,
            'data'           => [  ],
         ];

        wp_enqueue_script( 'waypoints' );
        wp_enqueue_script( 'chartjs' );

        if ( $items_base ) {

            $all_items = pbwp_get_item_group_data( $data );

            foreach ( $all_items as $key => $val ) {

                $color       = ( isset( $val[ 'color' ] ) ? $val[ 'color' ] : '#5472D2' );
                $borderColor = pbwp_colorMaker( $color, -3 );

                $lc_data_front[ 'data' ][ 'labels' ]       = explode( ';', trim( $x_axis, ';' ) );
                $lc_data_front[ 'data' ][ 'datasets' ][  ] = [
                    'idx'             => ( isset( $val[ 'id' ] ) ? esc_html( $val[ 'id' ] ) : esc_html( $key ) ),
                    'label'           => ( isset( $val[ 'label' ] ) ? esc_html( $val[ 'label' ] ) : '' ),
                    'backgroundColor' => $color,
                    'borderColor'     => $borderColor,
                    'borderWidth'     => 2,
                    'borderRadius'    => 5,
                    'borderSkipped'   => false,
                    'data'            => explode( ';', isset( $val[ 'value' ] ) ? trim( $val[ 'value' ], ';' ) : '' ),
                 ];

            }

            $item_markup .= '<div data-lc_data="'.esc_attr( htmlentities( serialize( $lc_data_front ) ) ).'" class="wpc_linechart_cont">';
            /* if ( $title ) { */
            $item_markup .= '<h2 class="wpc_lc_title">'.esc_html( $title ).'</h2>';
            /* } */

            $item_markup .= '<div class="wpc_linechart_each">';
            $item_markup .= '<div class="wpc_linechart_item'.( $is_legend == 'yes' ? ' legend_active' : '' ).'">';
            $item_markup .= '<canvas width="100%" height="400" class="wpc_linechart_canvas" id="wpc_linechart_'.esc_attr( $data[ 'id' ] ).'"></canvas>';
            $item_markup .= '</div>'; // End Round Chart item
            if ( $is_legend == 'yes' ) {
                $item_markup .= '<div id="lc_legend_'.esc_attr( $data[ 'id' ] ).'" class="wpc_chart_legend"></div>';
            }
            $item_markup .= '</div>'; // End Line Chart Each
            $item_markup .= '</div>'; // End Line Chart Cont

        } else {

            $item_markup = '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'No item found, please create first', 'wp-composer' ).'</span>';

        }

        return $item_markup;

    }

}
