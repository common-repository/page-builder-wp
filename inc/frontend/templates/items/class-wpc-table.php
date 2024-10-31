<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Table extends PBWP_Item_Loader
{

    protected $identity = 'table';

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $items_base  = $data[ 'config' ];
        $header_val  = pbwp_get_item_options( $data, 'table_header_val', 'Brand, Type, Year, Country' );

        wp_enqueue_script( 'basictable' );

        if ( $items_base ) {

            $all_items = pbwp_get_item_group_data( $data );

            $item_markup .= '<div class="wpc_item_table">';
            $item_markup .= '<table class="wpc_table wpc_table_cont">';
            $item_markup .= '<thead><tr class="wpc_tabel_header">';

            // Generate table header value
            $tbl_val = explode( ',', $header_val );
            $tbl_val = array_map( 'trim', $tbl_val );

            foreach ( $tbl_val as $tblval ) {

                $item_markup .= '<th class="wpc_tbl_header">'.esc_html( $tblval ).'</th>';

            }

            $item_markup .= ' </tr></thead><tbody>';

            // Generate table cells
            foreach ( $all_items as $key => $item ) {

                $cell_data = ( isset( $item[ 'table_data' ] ) ? $item[ 'table_data' ] : '' );

                $each_cell = explode( "\n", $cell_data );
                $each_cell = array_map( 'trim', $each_cell );

                $item_markup .= '<tr>';
                foreach ( $each_cell as $cell ) {
                    $item_markup .= '<td class="'.( $key % 2 == 1 ? 'tbl_item_even ' : 'tbl_item_odd ' ).'wpc_tbl_each_cell">'.esc_html( $cell ).'</td>';
                }

                $item_markup .= '</tr>';

            }

            $item_markup .= '</tbody></table>';
            $item_markup .= '</div>'; // End Table Markup

        } else {

            $item_markup = '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'No table data found, please create first', 'wp-composer' ).'</span>';

        }

        return $item_markup;

    }

}
