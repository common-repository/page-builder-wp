<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Tab extends PBWP_Item_Loader
{

    protected $identity = 'typetab';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $tabs             = pbwp_get_item_options( $data, 'tabs', [  ], false, 'tabs' );
        $style            = pbwp_get_item_options( $data, 'tabstyle', 'horizontal' );
        $h_align          = pbwp_get_item_options( $data, 'horizontal-align', 'left' );
        $v_pos            = pbwp_get_item_options( $data, 'vertical-pos', 'left' );
        $def_tab          = pbwp_get_item_options( $data, 'default', 'none' );
        $icon_list        = $tab_ids        = [  ];
        $the_pos          = $the_align          = '';
        $custom_data_attr = 'data-item-type="typeTAB"';

        $this->custom_data_attr = $custom_data_attr;
        $this->use_clear_both   = true;

        $item_markup .= '<div class="type_tab_configurations tabs_mode_'.esc_attr( $style ).' tabs_align_pos_'.esc_attr( $v_pos ).'">';
        $item_markup .= '<div class="wpc_loader_cont"><span class="itemloader"></span></div><div class="wpc_item_type_typetab childs_main_cont">';

        if ( ! empty( $tabs ) ) {

            /* Tabs Position Class */
            if ( $style == 'horizontal' ) {

                $the_align = 'horizontal_mode horizontal_align_'.$h_align;

            }

            if ( $style == 'vertical' ) {

                $the_pos = ' vertical_'.$v_pos;

            }

            foreach ( $tabs as $key => $tab ) {
                $tab         = (object) $tab;
                $tab_ids[  ] = $tab->id;
            }

            // Backwards compatibility
            if ( $def_tab === 'none' || $def_tab === '' || $def_tab === 0 ) {
                $def_tab = $tab_ids[ 0 ];
            }

            $tab_content_html = '';

            $tab_content_html .= '<div class="wpc_tab_content_cont">';

            foreach ( $tab_ids as $key => $id ) {

                $tab_content_html .= '<div data-tab_cont_id="'.esc_attr( $id ).'" class="wpc_tab_content'.( $id == $def_tab ? ' active_tab' : '' ).'"><div class="wpc_tab_content_inner childs_parent_cont"></div></div>';

            }

            $tab_content_html .= '</div>';

            /* If tab style is vertical left */
            if ( trim( $the_pos ) == 'vertical_right' ) {
                $item_markup .= $tab_content_html;
            }

            $item_markup .= '<div class="tabbed tab_round '.esc_attr( $the_align ).''.esc_attr( $the_pos ).'"><ul class="tabbed_list">';

            foreach ( $tabs as $key => $tab ) {

                $tab       = (object) $tab;
                $tab_title = '<span class="tab_title">'.esc_attr( $tab->title ).'</span>';

                if ( $tab->use_icon == 'yes' && $tab->icon ) {

                    $icon_list[  ] = $tab->icon;
                    if ( $tab->icon_pos == 'before' ) {
                        $tab_title = pbwp_create_icon_markup( $tab->icon, 'before_title' ).$tab_title;
                    }

                    if ( $tab->icon_pos == 'after' ) {
                        $tab_title = $tab_title.pbwp_create_icon_markup( $tab->icon, 'after_title' );
                    }

                }

                $item_markup .= '<li id="'.esc_attr( $tab->id ).'" data-tab_id="'.esc_attr( $tab->id ).'" style="z-index:'.esc_attr( count( $tabs ) - $key ).';" class="the_tab'.( $tab->id == $def_tab ? ' active' : '' ).'">'.$tab_title.'</li>';

            }

            $item_markup .= '</ul></div>';

            /* Load icon set ( if use ) */
            if ( ! empty( $icon_list ) ) {
                pbwp_load_icon_library( $icon_list );
            }

            /* If tab style is not vertical left */
            if ( trim( $the_pos ) != 'vertical_right' ) {
                $item_markup .= $tab_content_html;
            }

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Tabs Error: '.esc_html__( 'No tab found!', 'wp-composer' ).'</span>';

        }

        $item_markup .= '</div>'; // End Tab Markup
        $item_markup .= '</div>'; // End Tab Parent

        return $item_markup;

    }

}
