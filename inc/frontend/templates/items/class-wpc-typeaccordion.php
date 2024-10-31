<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Accordion extends PBWP_Item_Loader
{

    protected $identity = 'typeaccordion';

    public function render()
    {

        $data = $this->data;

        $item_markup      = '';
        $accr             = pbwp_get_item_options( $data, 'accordions', [  ], false, 'accordions' );
        $title            = pbwp_get_item_options( $data, 'title' );
        $gap              = pbwp_get_item_options( $data, 'gap', 0 );
        $nav_pos          = pbwp_get_item_options( $data, 'nav_pos', 'left' );
        $acc_style        = pbwp_get_item_options( $data, 'acc_style', 'modern' );
        $def_tab          = pbwp_get_item_options( $data, 'default', 'none' );
        $icon_list        = $acc_ids        = [  ];
        $custom_data_attr = 'data-item-type="typeAccordion"';

        $this->custom_data_attr = $custom_data_attr;

        $item_markup .= '<div class="wpc_loader_cont"><span class="itemloader"></span></div><div data-margin-bottom="'.esc_attr( $gap ).'" class="wpc_item_type_typeaccordion childs_main_cont">';

        $item_markup .= '<div class="acc_main_title"><h2>'.esc_html( $title ).'</h2></div>';

        if ( ! empty( $accr ) ) {

            $item_markup .= '<div class="wpc_accordion"><dl class="wpc_accordion_list_parent">';

            foreach ( $accr as $key => $acc ) {

                $acc         = (object) $acc;
                $acc_title   = '<span class="acc_title">'.esc_attr( $acc->title ).'</span>';
                $acc_ids[  ] = $acc->id;

                if ( $acc->use_icon == 'yes' && $acc->icon ) {

                    $icon_list[  ] = $acc->icon;

                    if ( $acc->icon_pos == 'before' ) {
                        $acc_title = pbwp_create_icon_markup( $acc->icon, 'before_title' ).$acc_title;
                    }

                    if ( $acc->icon_pos == 'after' ) {
                        $acc_title = $acc_title.pbwp_create_icon_markup( $acc->icon, 'after_title' );
                    }

                }

                $item_markup .= '<dt class="wpc_accordion_list acc_style_'.esc_attr( $acc_style ).'"><div '.( is_customize_preview() ? 'id="'.esc_attr( $acc->id ).'" data-tab_id="'.esc_attr( $acc->id ).'" ' : '' ).'aria-expanded="'.( $def_tab == $acc->id ? 'true' : 'false' ).'" aria-controls="'.esc_attr( $acc->id ).'" class="accordion_title accordionTitle accordionTitleBorder js_accordionTrigger acc_nav_'.esc_attr( $nav_pos ).' '.( $def_tab == $acc->id ? 'is-expanded' : 'is-collapsed' ).''.( $acc_style == 'minimalist' ? ' isflatMode' : '' ).'" id="'.esc_attr( $acc->id ).'">'.$acc_title.'</div></dt>';

                $item_markup .= '<dd class="accordion_content accordionItem '.( $def_tab == $acc->id ? 'is-expanded' : 'is-collapsed' ).'" data-tab_cont_id="'.esc_attr( $acc->id ).'" aria-hidden="'.( $def_tab == $acc->id ? 'false' : 'true' ).'"><div class="accordion_inner_content childs_parent_cont"></div></dd>';

            }

            $item_markup .= '</dl></div>';

            // Load icon set ( if use )
            if ( ! empty( $icon_list ) ) {
                pbwp_load_icon_library( $icon_list );
            }

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Accordion Error: '.esc_html__( 'No item found!', 'wp-composer' ).'</span>';

        }

        $item_markup .= '</div>'; // End Accordion Markup

        return $item_markup;

    }

}
