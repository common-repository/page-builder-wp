<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_frontend_generate_content( $mainData, $new_item = false )
{

    $mainData = (object) $mainData;

    if ( ! isset( $mainData->type ) || ! isset( $mainData->postID ) || ! isset( $mainData->id ) ) {
        return wp_json_encode( [  ] );
    }

    $dat = $data = [  ];

    if ( $mainData->type == 'row' ) {
        $data = pbwp_frontend_generate_row( $mainData );
    }

    if ( $mainData->type == 'column' ) {
        $data = pbwp_frontend_generate_column( $mainData );
    }

    if ( $mainData->type == 'item' || $mainData->type == 'tab' ) {
        $data = pbwp_generate_items( $mainData, true );
        // Sanitize final html markup
        $data = wp_kses( $data, pbwp_wp_kses_allowed_html() );

        // Check if the filter is hooked
        if ( has_filter( 'pbwp_execute_wpc_raw_code_shortcode' ) ) {
            // Use apply_filters to trigger the filter and display the message
            $has_shortcode = apply_filters( 'pbwp_execute_wpc_raw_code_shortcode', '' );
            if ( $has_shortcode === 'has_pbwp_raw_shortcode' ) {
                $data = do_shortcode( $data );
            }
            // Remove the filter to avoid affecting other content
            remove_filter( 'pbwp_execute_wpc_raw_code_shortcode', '', 10 );
        }

    }

    if ( $mainData->type == 'tab' ) {
        $dat[ 'needToMoveChild' ] = true;
    }

    $dat = array_merge( $dat, [ 'markup' => wp_json_encode( $data ), 'inlineData' => wp_json_encode( pbwp_frontend_render_css( $mainData, $new_item ) ), 'id' => $mainData->id, 'original_type' => $mainData->type, 'type' => ( $mainData->type == 'tab' ? 'item' : $mainData->type ) ] );

    return $dat;

}

function pbwp_frontend_generate_row( $mainData )
{

    $wpc_data      = pbwp_get_global_options( $mainData->postID, 'all' );
    $is_fullwidth  = ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_fullwidth' ] ) ? $wpc_data[ 'global' ][ 'config' ][ 'global_fullwidth' ] : '' );
    $row           = $wpc_data[ 'builder' ][ $mainData->rowIndex ];
    $innerRow      = ( isset( $row[ 'inner_of' ] ) && $row[ 'inner_of' ] != '' ? true : false );
    $config        = ( isset( $row[ 'config' ] ) ? $row[ 'config' ] : [  ] );
    $has_fill      = false;
    $row_class     = '';
    $row_data_attr = $add_data = [  ];

    // Video Background Markup
    $videobg = (object) pbwp_generate_videobg( $config, true );

    if ( $videobg->use_videobg ) {
        $row_data_attr = array_merge( $row_data_attr, $videobg->videobg_data_attr );
        $has_fill      = $videobg->has_fill;
    }

    // Parallax Background Markup
    $parallax = (object) pbwp_generate_parallax( $config, true );

    // Shapedivider
    $divider = (object) pbwp_generate_divider( $config, true );

    if ( $divider->use_divider ) {
        $add_data[  ] = [ 'type' => 'divider', 'use_divider' => $divider->use_divider, 'dividerMarkup' => $divider->dividerMarkup ];
        $row_class .= $divider->divider_class;
    } else {
        $add_data[  ] = [ 'type' => 'divider', 'use_divider' => false ];
    }

    if ( $parallax->use_parallax ) {
        $row_data_attr = array_merge( $row_data_attr, $parallax->parallax_data_attr );
        $row_class .= $parallax->parallax_class;
        $has_fill = $parallax->has_fill;
    }

    $has_fill = pbwp_has_fill(  ( isset( $config[ 'css' ] ) ? $config[ 'css' ] : [  ] ), $has_fill );

    if ( $has_fill ) {
        $row_class .= ' has_fill';
    }

    if ( isset( $config[ 'row_class' ] ) && $config[ 'row_class' ] ) {
        $row_class .= ' '.$config[ 'row_class' ];
    }

    if ( isset( $config[ 'use_sticky' ] ) && $config[ 'use_sticky' ] == 'yes' ) {
        $row_class .= ' wpc_on_sticky wpc_on_sticky_'.$row[ 'id' ];

        $sticky_data = [
            'id'           => '.wpc_on_sticky_'.$row[ 'id' ],
            'shadow_color' => isset( $config[ 'sticky_shadow_color' ] ) ? esc_attr( $config[ 'sticky_shadow_color' ] ) : 'rgba(0, 0, 0, 0.25)',
         ];

        $row_data_attr = array_merge( $row_data_attr, [ 'wpc-sticky' => serialize( $sticky_data ) ] );
    }

    if ( $is_fullwidth == 'yes' && ! $innerRow ) {
        $row_data_attr = array_merge( $row_data_attr, [ 'wpc-fw' => 'fullwidth' ] );
    }

    if ( $innerRow ) {
        $row_class .= ' is_row_inner';
    }

    $scroll_effects = pbwp_get_scroll_effects_app( $row );

    if ( $scroll_effects ) {
        $row_data_attr = array_merge( $row_data_attr, [ 'scroll-effects' => serialize( $scroll_effects ) ] );
        $row_data_attr = array_merge( $row_data_attr, [ 'scroll-id' => md5( $row[ 'id' ] ) ] );
    }

    // Add active app class
    $row_class .= pbwp_get_active_app_class( $row );

    // Animate
    $row_class .= ' '.pbwp_animation_creator( $row );

    return [ 'class' => $row_class, 'attribute' => $row_data_attr, 'add_data' => $add_data ];

}

function pbwp_frontend_generate_column( $mainData )
{

    $wpc_data      = pbwp_get_global_options( $mainData->postID, 'all' );
    $row           = $wpc_data[ 'builder' ][ $mainData->rowIndex ];
    $column        = $row[ 'row_cols' ][ $mainData->columnIndex ];
    $col_mode      = ( isset( $row[ 'col_mode' ] ) ? $row[ 'col_mode' ] : '1-1' );
    $colFormat     = explode( '_', $col_mode );
    $col_class     = $has_fill     = '';
    $col_data_attr = [  ];
    $config        = ( isset( $column[ 'config' ] ) ? $column[ 'config' ] : [  ] );

    // Video Background Markup
    $videobg = (object) pbwp_generate_videobg( $config, true );

    if ( $videobg->use_videobg ) {
        $col_data_attr = array_merge( $col_data_attr, $videobg->videobg_data_attr );
        $has_fill      = $videobg->has_fill;
    }

    // Parallax Background Markup
    $parallax = (object) pbwp_generate_parallax( $config, true );

    if ( $parallax->use_parallax ) {
        $col_data_attr = array_merge( $col_data_attr, $parallax->parallax_data_attr );
        $col_class .= $parallax->parallax_class;
        $has_fill = $parallax->has_fill;
    }

    if ( isset( $config[ 'col_class' ] ) && $config[ 'col_class' ] ) {
        $col_class .= ' '.$config[ 'col_class' ];
    }

    $has_fill = pbwp_has_fill(  ( isset( $config[ 'css' ] ) ? $config[ 'css' ] : [  ] ), $has_fill );

    if ( $has_fill ) {
        $col_class .= ' has_fill';
    }

    $scroll_effects = pbwp_get_scroll_effects_app( $column );

    if ( $scroll_effects ) {
        $col_data_attr = array_merge( $col_data_attr, [ 'scroll-effects' => serialize( $scroll_effects ) ] );
        $col_data_attr = array_merge( $col_data_attr, [ 'scroll-id' => md5( $column[ 'id' ] ) ] );
    }

    // Add active app class
    $col_class .= pbwp_get_active_app_class( $column );

    // Animate
    $col_class .= ' '.pbwp_animation_creator( $column );

    return [ 'class' => $col_class, 'attribute' => $col_data_attr, 'cell' => $colFormat[ $mainData->columnIndex ] ];

}

function pbwp_frontend_render_css( $elementData = null, $new_item = false, $custom_data = false )
{

    if ( is_null( $elementData ) ) {
        return [  ];
    }

    $final_css            = '';
    $g_fonts              = [ 'fonts' => [  ] ];
    $icon_fonts           = $custom_row_css           = $custom_col_css           = [  ];
    $wpc_data             = ( $custom_data ? $custom_data : pbwp_get_global_options( $elementData->postID, 'all' ) );
    $use_sticky           = $use_skrollr           = $use_video_bg           = false;
    $all_inline_data      = [ 'enqueue' => [  ], 'inlineCSS' => [  ], 'animation_class' => [  ] ];
    $css_devices          = [ 'desktop', 'tablet', 'smartphone' ];
    $final_row_css        = $final_col_css        = $final_item_css        = [  ];
    $all_items_inline_css = [  ];

    if ( isset( $wpc_data[ 'builder' ] ) && count( $wpc_data[ 'builder' ] ) > 0 ) {

        if ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] ) && $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] == 'yes' ) {
            return;
        }

        foreach ( $css_devices as $device ) {

            foreach ( $wpc_data[ 'builder' ] as $key => $val ) {

                $row_divider = $svgData = '';
                $config      = ( isset( $val[ 'config' ] ) ? $val[ 'config' ] : [  ] );
                $row_sel     = '.wpc_row[id="'.esc_attr( $val[ 'id' ] ).'"]';
                $col_mode    = ( isset( $val[ 'col_mode' ] ) && $val[ 'col_mode' ] ? $val[ 'col_mode' ] : '1_1' );
                $col_mode    = explode( '_', $col_mode );
                $col_padding = ( isset( $val[ 'config' ][ 'row_col_gap' ] ) && $val[ 'config' ][ 'row_col_gap' ] > 0 ? [ '.self.|padding', $val[ 'config' ][ 'row_col_gap' ] / 2 .'px' ] : '' );

                // Row No Padding
                if ( isset( $config[ 'row_no_padding' ] ) && $config[ 'row_no_padding' ] == 'yes' ) {
                    $row_no_padding = [ '.self. > .wpc_row_container|padding', '0 !important' ];
                    $col_no_padding = [ '.self. > .wpc_column_inner|padding', '0 !important' ];
                    $itm_no_padding = [ '.self. > .wpc_column_inner > .wpc_items_wrapper > .wpc_item|margin', '0 !important' ];
                } else {
                    $row_no_padding = '';
                    $col_no_padding = '';
                    $itm_no_padding = '';
                }

                // Shape divider
                if ( isset( $config[ 'shapedivider' ] ) && $config[ 'shapedivider' ] == 'yes' ) {

                    if ( isset( $config[ 'shapedivider_data' ] ) && $config[ 'shapedivider_data' ] != '' ) {
                        $svgData = json_decode( base64_decode( $config[ 'shapedivider_data' ], true ) );

                        $row_divider = [
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.top_position svg|height',
                                'value' => $svgData->top->height.'px',
                             ],
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.top_position svg|width',
                                'value' => 'calc('.$svgData->top->width.'% + 1.3px)',
                             ],
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.bottom_position svg|height',
                                'value' => $svgData->bottom->height.'px',
                             ],
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.bottom_position svg|width',
                                'value' => 'calc('.$svgData->bottom->width.'% + 1.3px)',
                             ],
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.top_position .wpc-shape-fill|fill',
                                'value' => $svgData->top->fillColor,
                             ],
                            [
                                'key'   => '.self. > .wpc_shapedivider_cont.bottom_position .wpc-shape-fill|fill',
                                'value' => $svgData->bottom->fillColor,
                             ],
                         ];

                    }

                }

                $row_css = ( isset( $config[ 'css' ] ) ? $config[ 'css' ] : '' );

                if ( is_array( $row_css ) ) {

                    // Get app css
                    $row_css = pbwp_get_app_inline_css( $val, $row_css );

                    if ( is_array( $row_divider ) ) {

                        foreach ( $row_divider as $dk => $dval ) {

                            $row_css[ 'desktop' ][ $dval[ 'key' ] ]    = $dval[ 'value' ];
                            $row_css[ 'tablet' ][ $dval[ 'key' ] ]     = $dval[ 'value' ];
                            $row_css[ 'smartphone' ][ $dval[ 'key' ] ] = $dval[ 'value' ];

                        }

                    }

                    if ( is_array( $row_no_padding ) ) {
                        // Row No Padding
                        $row_css[ 'desktop' ][ $row_no_padding[ 0 ] ]    = $row_no_padding[ 1 ];
                        $row_css[ 'tablet' ][ $row_no_padding[ 0 ] ]     = $row_no_padding[ 1 ];
                        $row_css[ 'smartphone' ][ $row_no_padding[ 0 ] ] = $row_no_padding[ 1 ];
                    }

                    if ( isset( $row_css[ 'desktop' ][ 'custom_css' ] ) ) {
                        $custom_row_css[ $key ][ 'sel' ] = $row_sel;
                        $custom_row_css[ $key ][ 'css' ] = $row_css[ 'desktop' ][ 'custom_css' ];
                        unset( $row_css[ 'desktop' ][ 'custom_css' ], $row_css[ 'tablet' ][ 'custom_css' ], $row_css[ 'smartphone' ][ 'custom_css' ] );
                    }

                    /* Here we implement the responsive mode for desktop, tablet and smartphone mode */
                    if (  ( $elementData->type == 'row' && $elementData->id == $val[ 'id' ] ) || isset( $elementData->generateAll ) ) {

                        if ( array_key_exists( $device, $row_css ) && ! empty( $row_css[ $device ] ) ) {
                            /* Parse inline first */
                            $row_css = pbwp_generate_inline_css( $row_css[ $device ], $row_sel, true, true );
                            /* Store the css rules that has been parsed */
                            $final_row_css[ $device ][  ] = $row_css[ 'css' ];

                            if ( ! empty( $row_css[ 'fonts' ] ) ) {
                                $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $row_css[ 'fonts' ] );
                            }

                        }

                    }

                }

                // Row video background & Parallax
                if ( isset( $config[ 'parallax' ] ) && $config[ 'parallax' ] == 'yes' && isset( $config[ 'img_id' ] ) && $config[ 'img_id' ] != '' ) {
                    $use_skrollr = true;
                }

                if ( isset( $config[ 'videobg' ] ) && $config[ 'videobg' ] == 'yes' && isset( $config[ 'videobgurl' ] ) && $config[ 'videobgurl' ] != '' ) {
                    $use_video_bg = true;
                }

                // Sticky Mode
                if ( isset( $config[ 'use_sticky' ] ) && $config[ 'use_sticky' ] == 'yes' ) {
                    $use_sticky = true;
                }

                if ( isset( $val[ 'config' ][ 'row_disable' ] ) && $val[ 'config' ][ 'row_disable' ] == 'yes' ) {
                    continue;
                }

                foreach ( $val[ 'row_cols' ] as $ky => $vl ) {

                    $colCfg  = ( isset( $vl[ 'config' ] ) ? $vl[ 'config' ] : [  ] );
                    $col_sel = '.wpc_col[id="'.$vl[ 'id' ].'"]';
                    // Set the column size
                    $colSize = explode( '-', ( isset( $col_mode[ $ky ] ) ? $col_mode[ $ky ] : '1-1' ) );
                    $colSize = ( isset( $colSize[ 0 ] ) ? (int) $colSize[ 0 ] : 1 ) / ( isset( $colSize[ 1 ] ) ? (int) $colSize[ 1 ] : 1 );
                    $colSize = $colSize > 0 ? $colSize * 100 : 100;

                    $col_css = ( isset( $colCfg[ 'css' ] ) ? $colCfg[ 'css' ] : [  ] );

                    if ( isset( $col_css[ 'desktop' ][ 'custom_css' ] ) ) {
                        $custom_col_css[ $ky ][ 'sel' ] = $col_sel;
                        $custom_col_css[ $ky ][ 'css' ] = $col_css[ 'desktop' ][ 'custom_css' ];
                        unset( $col_css[ 'desktop' ][ 'custom_css' ], $col_css[ 'tablet' ][ 'custom_css' ], $col_css[ 'smartphone' ][ 'custom_css' ] );
                    }

                    // Get app css
                    $col_css = pbwp_get_app_inline_css( $vl, $col_css );

                    /* Column width correction
                    Via Column Editor ( Priority 2 ) */
                    if ( is_array( $col_padding ) ) {

                        $col_css[ 'desktop' ][ $col_padding[ 0 ] ]    = $col_padding[ 1 ];
                        $col_css[ 'tablet' ][ $col_padding[ 0 ] ]     = ( isset( $val[ 'config' ][ 'row_col_gap_disable' ] ) && $val[ 'config' ][ 'row_col_gap_disable' ] == 'yes' ? '0 !important' : $col_padding[ 1 ] );
                        $col_css[ 'smartphone' ][ $col_padding[ 0 ] ] = ( isset( $val[ 'config' ][ 'row_col_gap_disable' ] ) && $val[ 'config' ][ 'row_col_gap_disable' ] == 'yes' ? '0 !important' : $col_padding[ 1 ] );

                    }

                    // Col No Padding
                    if ( isset( $colCfg[ 'col_no_padding' ] ) && $colCfg[ 'col_no_padding' ] == 'yes' ) {
                        $col_no_padding = [ '.self. > .wpc_column_inner|padding', '0 !important' ];
                        $itm_no_padding = [ '.self. > .wpc_column_inner > .wpc_items_wrapper > .wpc_item|margin', '0 !important' ];
                    }

                    if ( is_array( $col_no_padding ) ) {
                        // Row No Padding
                        $col_css[ 'desktop' ][ $col_no_padding[ 0 ] ] = $col_no_padding[ 1 ];
                        $col_css[ 'desktop' ][ $itm_no_padding[ 0 ] ] = $itm_no_padding[ 1 ];

                        $col_css[ 'tablet' ][ $col_no_padding[ 0 ] ] = $col_no_padding[ 1 ];
                        $col_css[ 'tablet' ][ $itm_no_padding[ 0 ] ] = $itm_no_padding[ 1 ];

                        $col_css[ 'smartphone' ][ $col_no_padding[ 0 ] ] = $col_no_padding[ 1 ];
                        $col_css[ 'smartphone' ][ $itm_no_padding[ 0 ] ] = $itm_no_padding[ 1 ];

                        // Reset to next column (if no padding of row is disabled)
                        if ( ! isset( $config[ 'row_no_padding' ] ) || ( isset( $config[ 'row_no_padding' ] ) && $config[ 'row_no_padding' ] != 'yes' ) ) {
                            $col_no_padding = $itm_no_padding = '';
                        }

                    }

                    if ( isset( $colCfg[ 'col_is_block' ] ) && $colCfg[ 'col_is_block' ] == 'yes' ) {

                        $col_css[ 'desktop' ][ '.self.|width' ]   = '100%';
                        $col_css[ 'desktop' ][ '.self.|display' ] = 'block';

                        $col_css[ 'tablet' ][ '.self.|width' ]   = '100%';
                        $col_css[ 'tablet' ][ '.self.|display' ] = 'block';

                        $col_css[ 'smartphone' ][ '.self.|width' ]   = '100%';
                        $col_css[ 'smartphone' ][ '.self.|display' ] = 'block';

                    } else {

                        $col_css[ 'desktop' ][ '.self.|width' ] = esc_html( pbwp_number_format( $colSize, 3 ) ).'%';

                    }

                    if ( isset( $colCfg[ 'col_center_v' ] ) && $colCfg[ 'col_center_v' ] == 'yes' ) {

                        $vertical_css = [
                            '.self. > .wpc_column_inner > .wpc_items_wrapper|display'         => 'flex',
                            '.self. > .wpc_column_inner > .wpc_items_wrapper|flex-direction'  => 'column',
                            '.self. > .wpc_column_inner > .wpc_items_wrapper|justify-content' => 'center',
                            '.self. > .wpc_column_inner > .wpc_items_wrapper|height'          => '100%',
                         ];

                        if ( ! isset( $col_css[ 'desktop' ] ) ) {
                            $col_css[ 'desktop' ] = [  ];
                        }

                        if ( ! isset( $col_css[ 'tablet' ] ) ) {
                            $col_css[ 'tablet' ] = [  ];
                        }

                        if ( ! isset( $col_css[ 'smartphone' ] ) ) {
                            $col_css[ 'smartphone' ] = [  ];
                        }

                        $col_css[ 'desktop' ]    = array_merge( $col_css[ 'desktop' ], $vertical_css );
                        $col_css[ 'tablet' ]     = array_merge( $col_css[ 'tablet' ], $vertical_css );
                        $col_css[ 'smartphone' ] = array_merge( $col_css[ 'smartphone' ], $vertical_css );

                    }

                    /* Here we implement the responsive mode for desktop, tablet and smartphone mode */
                    if (  ( $elementData->type == 'column' && $elementData->id == $vl[ 'id' ] ) || isset( $elementData->generateAll ) || isset( $elementData->includeColums ) ) {

                        if ( array_key_exists( $device, $col_css ) && ! empty( $col_css[ $device ] ) ) {
                            /* Parse inline first */
                            $temptCSS = pbwp_generate_inline_css( $col_css[ $device ], $col_sel, true, true );
                            /* Store the css rules that has been parsed */
                            $final_col_css[ $device ][  ] = $temptCSS[ 'css' ];

                            if ( ! empty( $temptCSS[ 'fonts' ] ) ) {
                                $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $temptCSS[ 'fonts' ] );
                            }

                        }

                    }

                    // Column video background & Parallax
                    if ( isset( $colCfg[ 'parallax' ] ) && $colCfg[ 'parallax' ] == 'yes' && isset( $colCfg[ 'img_id' ] ) && $colCfg[ 'img_id' ] != '' ) {
                        $use_skrollr = true;
                    }

                    if ( isset( $colCfg[ 'videobg' ] ) && $colCfg[ 'videobg' ] == 'yes' && isset( $colCfg[ 'videobgurl' ] ) && $colCfg[ 'videobgurl' ] != '' ) {
                        $use_video_bg = true;
                    }

                    if ( ! isset( $vl[ 'items' ] ) ) {
                        continue;
                    }

                    foreach ( $vl[ 'items' ] as $k => $v ) {

                        if ( is_object( $elementData ) && ( $elementData->type == 'item' && $elementData->id == $v[ 'id' ] ) || isset( $elementData->generateAll ) || isset( $elementData->includeItems ) ) {

                            $itemtype = strtolower( $v[ 'type' ] );

                            // Check Animation
                            if ( isset( $v[ 'config' ][ 'animate' ] ) ) {

                                $all_inline_data[ 'enqueue' ][  ]     = [ 'name' => 'animate', 'path' => 'css/vendors/animate/animate.min.css', 'type' => 'link', 'direct' => false ];
                                $all_inline_data[ 'animation_class' ] = pbwp_animation_creator( $v, false );

                            }

                            /* Only for new item */
                            if ( pbwp_get_enqueue_list( $v[ 'type' ] ) ) {
                                $all_inline_data[ 'enqueue' ] = array_merge( $all_inline_data[ 'enqueue' ], pbwp_get_enqueue_list( $v[ 'type' ] ) );
                            }

                            // Check icons
                            if ( isset( $v[ 'config' ][ 'general' ] ) && ( $itemtype != 'typelist' || $itemtype != 'typetimeline' || $itemtype != 'typetab' || $itemtype != 'typeaccordion' ) ) {

                                if ( is_array( $v[ 'config' ][ 'general' ] ) && array_key_exists( 'icon', $v[ 'config' ][ 'general' ] ) ) {
                                    $icon_fonts[  ] = $v[ 'config' ][ 'general' ][ 'icon' ];
                                }

                                if ( is_array( $v[ 'config' ][ 'general' ] ) && array_key_exists( 'featured_icon', $v[ 'config' ][ 'general' ] ) ) {
                                    $icon_fonts[  ] = $v[ 'config' ][ 'general' ][ 'featured_icon' ];
                                }

                            }

                            // Check icon for typemaps item type
                            if ( $itemtype == 'typemaps' && isset( $v[ 'config' ][ 'general' ] ) && is_array( $v[ 'config' ][ 'general' ] ) && ! isset( $v[ 'config' ][ 'general' ][ 'icon' ] ) ) {
                                $icon_fonts[  ] = 'fa fa-';
                            }

                            // Check icon for Pricing Table item type
                            if ( $itemtype == 'typepricing' && is_array( $v[ 'config' ] ) ) {

                                $items = pbwp_get_item_options( $v, 'items', '', true );

                                if ( $items ) {

                                    $items          = explode( "\n", $items );
                                    $items          = array_filter( $items, 'trim' );
                                    $containingIcon = false;

                                    foreach ( $items as $key => $item ) {

                                        if ( strpos( $item, '<i class="fa' ) !== false && ! $containingIcon ) {
                                            $icon_fonts[  ] = 'fa fa-';
                                            $containingIcon = true;
                                        }

                                    }

                                }

                            }

                            if ( $itemtype == 'typelist' || $itemtype == 'typetimeline' ) {

                                $icon_k = 'icon';

                                if ( $itemtype == 'typetimeline' ) {
                                    $icon_k = 'timeline_circle_icon';
                                }

                                if ( isset( $v[ 'config' ] ) && is_array( $v[ 'config' ] ) ) {

                                    $all_list_icons = [  ];

                                    $all_items = pbwp_get_item_group_data( $v );

                                    foreach ( $all_items as $lk => $lv ) {

                                        // Skip rules only for typelist item because that item has option to disable for using icon at once
                                        if ( $itemtype == 'typelist' && isset( $v[ 'config' ][ 'general' ][ 'list_shape' ] ) && $v[ 'config' ][ 'general' ][ 'list_shape' ] !== 'list_shape_icon' ) {
                                            continue;
                                        }

                                        $all_list_icons[  ] = ( isset( $lv[ $icon_k ] ) ? $lv[ $icon_k ] : 'fa fa-chevron-circle-right' );

                                    }

                                    $all_inline_data[ 'enqueue' ] = array_merge( $all_inline_data[ 'enqueue' ], pbwp_load_icon_library( $all_list_icons, true ) );

                                }

                            }

                            if ( $itemtype == 'typetab' || $itemtype == 'typeaccordion' ) {

                                $typebase = 'tabs';

                                if ( $itemtype == 'typeaccordion' ) {
                                    $typebase = 'accordions';
                                }

                                if ( isset( $v[ $typebase ] ) && is_array( $v[ $typebase ] ) ) {

                                    $all_list_icons = [  ];

                                    foreach ( $v[ $typebase ] as $lk => $lv ) {

                                        if ( isset( $lv[ 'icon' ] ) && $lv[ 'icon' ] != '' ) {
                                            $all_list_icons[  ] = $lv[ 'icon' ];
                                        }

                                    }

                                    $all_inline_data[ 'enqueue' ] = array_merge( $all_inline_data[ 'enqueue' ], pbwp_load_icon_library( $all_list_icons, true ) );

                                }

                            }

                            $css = ( isset( $v[ 'config' ][ 'css' ] ) ? $v[ 'config' ][ 'css' ] : '' );

                            if ( is_array( $css ) ) {

                                // Get app css
                                $css = pbwp_get_app_inline_css( $v, $css, $itemtype );

                                /* Here we implement the responsive mode for desktop, tablet and smartphone mode */
                                if ( array_key_exists( $device, $css ) && ! empty( $css[ $device ] ) ) {
                                    /* Parse inline first */
                                    $css = pbwp_generate_inline_css( $css[ $device ], '.wpc_item_'.$v[ 'id' ], false, true );
                                    /* Store the css rules that has been parsed */
                                    $final_item_css[ $device ][  ] = $css[ 'css' ];

                                    if ( ! empty( $css[ 'fonts' ] ) ) {
                                        $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $css[ 'fonts' ] );
                                    }

                                }

                                /* Generate inline css */
                                if ( $itemtype === 'typelist' || $itemtype === 'typemaps' || $itemtype === 'typepricing' || $itemtype === 'typeTimeline' ) {
                                    $all_items_inline_css[  ] = pbwp_item_inline_css( $v );
                                }

                            }

                        }

                    }

                }

            }

        }

        /* Parallax */
        if ( $use_skrollr ) {
            $all_inline_data[ 'enqueue' ][  ] = [ 'name' => 'skrollr', 'path' => 'js/vendors/skrollrcustom/skrollrCustom.min.js', 'type' => 'script', 'direct' => false ];
        }

        /* video background */
        if ( $use_video_bg ) {
            $all_inline_data[ 'enqueue' ][  ] = [ 'name' => 'youtube-iframe-api', 'path' => esc_url( PBWP_YOUTUBE_API ), 'type' => 'script', 'direct' => true ];
        }

        /* Sticky */
        if ( $use_sticky ) {
            $all_inline_data[ 'enqueue' ][  ] = [ 'name' => 'stickystack', 'path' => 'js/vendors/stickystack/jquery.stickystack.min.js', 'type' => 'script', 'direct' => false ];
        }

        /* enqueue Google fonts */
        if ( ! empty( $g_fonts[ 'fonts' ] ) && is_array( pbwp_load_google_fonts( $g_fonts[ 'fonts' ], true ) ) ) {
            $all_inline_data[ 'enqueue' ] = array_merge( $all_inline_data[ 'enqueue' ], pbwp_load_google_fonts( $g_fonts[ 'fonts' ], true ) );
        }

        /* enqueue icon fonts */
        if ( ! empty( $icon_fonts ) ) {
            $all_inline_data[ 'enqueue' ] = array_merge( $all_inline_data[ 'enqueue' ], pbwp_load_icon_library( $icon_fonts, true ) );
        }

        foreach ( $css_devices as $device ) {
            /* Set the css breakpoints for each devices */
            $cssBreakpoint = pbwp_set_css_breakpoints( $device, true );

            if ( $cssBreakpoint != '' ) {
                $final_css .= $cssBreakpoint;
            }

            if ( isset( $final_row_css[ $device ] ) ) {
                $final_css .= implode( "\n", $final_row_css[ $device ] );
            }

            if ( isset( $final_col_css[ $device ] ) ) {
                $final_css .= implode( "\n", $final_col_css[ $device ] );
            }

            if ( isset( $final_item_css[ $device ] ) ) {
                $final_css .= implode( "\n", $final_item_css[ $device ] );
            }

            /* Close css breakpoint */
            if ( $cssBreakpoint != '' ) {
                $final_css .= '}';
            }

        }

        /* Render Column Custom CSS */
        if ( ! empty( $custom_col_css ) ) {
            foreach ( $custom_col_css as $colCusCSS => $eachColCusCSS ) {
                $final_css .= pbwp_css_break_and_modify( $eachColCusCSS[ 'css' ], $eachColCusCSS[ 'sel' ], true );
            }

        }

        /* Render Row Custom CSS */
        if ( ! empty( $custom_row_css ) ) {
            foreach ( $custom_row_css as $rowCusCSS => $eachRowCusCSS ) {
                $final_css .= pbwp_css_break_and_modify( $eachRowCusCSS[ 'css' ], $eachRowCusCSS[ 'sel' ], true );
            }

        }

        /* Render Global Custom CSS if defined */
        if ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] ) && $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] ) {
            $final_css .= base64_decode( $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] );
        }

        // Append item inline css into final css
        $final_css = $final_css.implode( '', $all_items_inline_css );

        /* Sanitize the output */
        $allowed_tags = wp_kses_allowed_html( 'post' );
        $inline_css   = wp_kses( stripslashes_deep( pbwp_css_compress( $final_css ) ), $allowed_tags );

        // Remove duplicate script
        if ( is_array( $all_inline_data[ 'enqueue' ] ) ) {

            $all_inline_data[ 'enqueue' ] = array_intersect_key(
                $all_inline_data[ 'enqueue' ],
                array_unique( array_column( $all_inline_data[ 'enqueue' ], 'path' ) )
            );

        }

        $all_inline_data[ 'inlineCSS' ][ 'id' ]  = $elementData->id;
        $all_inline_data[ 'inlineCSS' ][ 'css' ] = htmlspecialchars_decode( $inline_css, ENT_QUOTES );

    }

    return $all_inline_data;

}
