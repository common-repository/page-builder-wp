<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_generate_content( $content )
{

    if ( pbwp_is_disabled() ) {
        return $content;
    }

    $cnt          = '';
    $ui_sst       = pbwp_front_get_option( 'user_interface' );
    $wpc_data     = pbwp_get_global_options( get_the_ID(), 'all' );
    $rowCount     = ( isset( $wpc_data[ 'builder' ] ) ? count( $wpc_data[ 'builder' ] ) : 0 );
    $use_wpc      = ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] ) ? $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] : '' );
    $is_fullwidth = ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_fullwidth' ] ) && $rowCount >= 1 ? $wpc_data[ 'global' ][ 'config' ][ 'global_fullwidth' ] : '' );
    $on_tour      = ( isset( $ui_sst[ 'show_tour' ] ) && $ui_sst[ 'show_tour' ] == 'yes' && ! is_rtl() && $rowCount <= 0 ? ' onTour' : '' );

    if ( $wpc_data && is_array( $wpc_data ) && isset( $wpc_data[ 'builder' ] ) && $rowCount >= 1 && ! empty( $wpc_data[ 'builder' ] ) && $use_wpc != 'yes' ) {

        if ( is_customize_preview() ) {
            $cnt .= '<div data-current_post_id="'.esc_attr( get_the_ID() ).'" class="wpc_previewer_main_cont'.esc_attr( $on_tour ).'">';
        } else {
            $cnt .= '<div class="wpcomposer_container">';
        }

        // Display WP Composer content entirely
        $wpc_content = pbwp_generate_rows( $wpc_data[ 'builder' ], $is_fullwidth );
        if ( pbwp_on_debug_mode() ) {
            $cnt .= do_shortcode( $wpc_content );
        } else {
            $cnt .= wp_kses( $wpc_content, pbwp_wp_kses_allowed_html() );
        }

        // If on previewer mode
        if ( is_customize_preview() ) {

            if ( count( $wpc_data[ 'builder' ] ) > 0 ) {

                if ( ! class_exists( 'PBWP_Markup_Creator' ) ) {
                    require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
                }

                $creator = new PBWP_Markup_Creator();

            }

            $cnt .= ''.( count( $wpc_data[ 'builder' ] ) > 0 ? '<div class="wpc_previewer_add_row">'.$creator->columnLists( true ).'</div>' : '' ).'</div>';

        } else {
            $cnt .= '</div>';
        }

        // If on previewer mode
        $content = $cnt;

    } else {

        if ( is_customize_preview() && isset( $wpc_data[ 'builder' ] ) && is_singular() && $use_wpc != 'yes' ) {

            wp_enqueue_style( 'pbwpstyle', pbwp_distribution_url( 'css/frontendCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION, 'all' );

            $cnt .= '<div data-current_post_id="'.esc_attr( get_the_ID() ).'" class="wpc_previewer_main_cont'.esc_attr( $on_tour ).'"><div class="wpc_frontend_blank_page"><div class="wpc_blank-brand"><img src="'.esc_url( PBWP_DIR.'/inc/dist/images/wpc_120.png' ).'" class="wpc_brand_image"></div><div class="wpc_blank-header">'.esc_html__( 'You have blank page. Start adding row', 'page-builder-wp' ).'</div><div class="wpc_blank-action"><span class="wpc_create_row wpc-button-flat wpc-button-color-blue wpc-button-size-sm" data-wpc-editor-link="'.esc_url( pbwp_generate_customizer_link( get_the_ID() ) ).'">'.esc_html__( 'Create New Row', 'page-builder-wp' ).'</span></div></div></div>';

            $content = $cnt;

        }

    }

    // Check if the filter is hooked
    if ( has_filter( 'pbwp_execute_wpc_raw_code_shortcode' ) ) {
        // Use apply_filters to trigger the filter and display the message
        $has_shortcode = apply_filters( 'pbwp_execute_wpc_raw_code_shortcode', '' );
        if ( $has_shortcode === 'has_pbwp_raw_shortcode' && ! pbwp_on_debug_mode() ) {
            $content = do_shortcode( $content );
        }
        // Remove the filter to avoid affecting other content
        remove_filter( 'pbwp_execute_wpc_raw_code_shortcode', '', 10 );
    }

    return $content;

}

function pbwp_generate_rows( $data, $is_fullwidth = false, $isRowInner = false, $usePostID = false )
{

    $row_content = '';
    $rowCount    = count( $data );

    if ( $rowCount <= 0 ) {
        return;
    }

    foreach ( $data as $key => $val ) {

        $col_mode     = ( isset( $val[ 'col_mode' ] ) ? $val[ 'col_mode' ] : '1-1' );
        $colFormat    = explode( '_', $col_mode );
        $config       = ( isset( $val[ 'config' ] ) ? $val[ 'config' ] : [  ] );
        $has_fill     = false;
        $row_class    = $row_data_attr    = '';
        $row_disabled = ( isset( $config[ 'row_disable' ] ) && $config[ 'row_disable' ] == 'yes' ? true : false );

        if ( isset( $val[ 'inner_of' ] ) && $val[ 'inner_of' ] != '' && ! $isRowInner ) {
            continue;
        }

        if ( ! pbwp_visibility_breakpoint_status( $config ) ) {
            continue;
        }

        // Video Background Markup
        $videobg = (object) pbwp_generate_videobg( $config );

        if ( $videobg->use_videobg ) {
            $row_data_attr .= $videobg->videobg_data_attr;
            $has_fill = $videobg->has_fill;
        }

        // Parallax Background Markup
        $parallax = (object) pbwp_generate_parallax( $config );

        if ( $parallax->use_parallax ) {
            $row_data_attr .= $parallax->parallax_data_attr;
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
            $row_class .= ' wpc_on_sticky wpc_on_sticky_'.$val[ 'id' ];

            $sticky_data = [
                'id'           => '.wpc_on_sticky_'.$val[ 'id' ],
                'shadow_color' => isset( $config[ 'sticky_shadow_color' ] ) ? esc_attr( $config[ 'sticky_shadow_color' ] ) : 'rgba(0, 0, 0, 0.25)',
             ];

            $row_data_attr .= ' data-wpc-sticky="'.esc_attr( htmlentities( serialize( $sticky_data ) ) ).'"';
        }

        if ( $is_fullwidth === 'yes' && ! $isRowInner ) {
            $row_data_attr .= ' data-wpc-fw="fullwidth"';
        }

        if ( $isRowInner ) {
            $row_class .= ' is_row_inner';

            if ( is_customize_preview() ) {
                $row_data_attr .= ' data-inner_of="'.esc_attr( $val[ 'inner_of' ] ).'"';
            }

        }

        if ( isset( $config[ 'advanced' ] ) && isset( $config[ 'advanced' ][ 'visibility_breakpoint' ] ) && $config[ 'advanced' ][ 'visibility_breakpoint' ] && ! is_customize_preview() ) {
            $row_class .= ' wpc_visible_'.esc_attr( $config[ 'advanced' ][ 'visibility_breakpoint' ] );
        }

        // Animate
        $row_class .= ' '.pbwp_animation_creator( $val );
        // Frontend class
        $row_class .= is_customize_preview() ? ' wpc_unmodified' : '';

        $rowMarkupOpenTag  = '<div data-wpc-type="row" id="'.esc_attr( $val[ 'id' ] ).'" class="wpc_row'.esc_attr( $row_class ).'" '.$row_data_attr.'><div class="wpc_row_container"><div class="wpc_wrap_columns">';
        $rowMarkupCloseTag = '</div></div></div>';

        if ( $row_disabled ) {

            if ( is_customize_preview() ) {
                $row_content .= $rowMarkupOpenTag.'<div class="wpc_row_disabled"><span class="wpc-error-msg"><i class="wpc-i-info"></i>'.esc_html__( 'This row is in disable mode', 'page-builder-wp' ).'</span></div>'.$rowMarkupCloseTag;
            }

        } else {
            $row_content .= $rowMarkupOpenTag;
            $row_content .= pbwp_generate_columns( $val, $colFormat, $usePostID );
            $row_content .= $rowMarkupCloseTag;
        }

    }

    return $row_content;

}

function pbwp_generate_columns( $cols, $colFormat, $usePostID )
{

    $col_content = '';

    foreach ( $cols[ 'row_cols' ] as $key => $val ) {

        $col_class = $col_data_attr = '';
        $config    = ( isset( $val[ 'config' ] ) ? $val[ 'config' ] : [  ] );
        $has_fill  = false;

        if ( isset( $val[ 'config' ] ) ) {

            $config = $val[ 'config' ];

            if ( ! pbwp_visibility_breakpoint_status( $config ) ) {
                continue;
            }

        }

        // Video Background Markup
        $videobg = (object) pbwp_generate_videobg( $config );

        if ( $videobg->use_videobg ) {
            $col_data_attr .= $videobg->videobg_data_attr;
            $has_fill = $videobg->has_fill;
        }

        // Parallax Background Markup
        $parallax = (object) pbwp_generate_parallax( $config );

        if ( $parallax->use_parallax ) {
            $col_data_attr .= $parallax->parallax_data_attr;
            $col_class .= $parallax->parallax_class;
            $has_fill = $parallax->has_fill;
        }

        $has_fill = pbwp_has_fill(  ( isset( $config[ 'css' ] ) ? $config[ 'css' ] : [  ] ), $has_fill );

        if ( $has_fill ) {
            $col_class .= ' has_fill';
        }

        if ( isset( $config[ 'advanced' ] ) && isset( $config[ 'advanced' ][ 'visibility_breakpoint' ] ) && $config[ 'advanced' ][ 'visibility_breakpoint' ] && ! is_customize_preview() ) {
            $col_class .= ' wpc_visible_'.$config[ 'advanced' ][ 'visibility_breakpoint' ];
        }

        // Animate
        $col_class .= ' '.pbwp_animation_creator( $val );
        $col_class .= is_customize_preview() ? ' wpc_unmodified' : '';

        $col_content .= '<div data-wpc-type="column" data-col-cell="'.esc_attr( isset( $colFormat[ $key ] ) ? $colFormat[ $key ] : '1-1' ).'" id="'.esc_attr( $val[ 'id' ] ).'" class="wpc_col'.esc_attr(  ( isset( $config[ 'col_class' ] ) && $config[ 'col_class' ] ? ' '.$config[ 'col_class' ] : '' ) ).$col_class.'"'.$col_data_attr.'>';
        $col_content .= '<div class="wpc_column_inner">';
        $col_content .= '<div class="wpc_items_wrapper'.( is_customize_preview() ? ' wpc_items_wrapper_no_item' : '' ).' ">';

        if ( isset( $val[ 'items' ] ) ) {
            $col_content .= pbwp_generate_items( $val[ 'items' ], false, $usePostID );
        }

        $col_content .= '</div></div></div>'; /* End column Wrapper > End column Container > End column */

    }

    return $col_content;

}

function pbwp_generate_items( $itms, $isBuilder, $usePostID = false )
{

    $pstID = null;
    $items = null;

    if ( $isBuilder ) {

        $pstID    = $itms->postID;
        $wpc_data = pbwp_get_global_options( $pstID, 'all' );

        if ( ! isset( $wpc_data[ 'builder' ] ) ) {
            return [  ];
        }

        if ( ! isset( $wpc_data[ 'builder' ][ $itms->rowIndex ][ 'row_cols' ][ $itms->columnIndex ][ 'items' ] ) ) {
            return [  ];
        }

        if ( ! isset( $wpc_data[ 'builder' ][ $itms->rowIndex ][ 'row_cols' ][ $itms->columnIndex ][ 'items' ][ $itms->itemIndex ] ) ) {
            return [  ];
        }

        $itms = [ $wpc_data[ 'builder' ][ $itms->rowIndex ][ 'row_cols' ][ $itms->columnIndex ][ 'items' ][ $itms->itemIndex ] ];

    }

    foreach ( $itms as $key => $val ) {

        if ( ! isset( $val[ 'type' ] ) ) {
            // Need to skip corrupted item caused by order that failed
            continue;
        }

        if ( ! is_customize_preview() && isset( $val[ 'disable' ] ) && $val[ 'disable' ] && ! $isBuilder ) {
            echo '';
            continue;
        }

        if ( $isBuilder || $usePostID ) {

            if ( $usePostID ) {
                $pstID = $usePostID;
            }

            $val[ 'postID' ] = $pstID;
        }

        if ( isset( $val[ 'config' ] ) ) {

            $config = $val[ 'config' ];

            if ( ! pbwp_visibility_breakpoint_status( $config ) ) {
                continue;
            }

        }

        $type = strtolower( $val[ 'type' ] );
        // Render content
        if ( class_exists( 'PBWP_Item_Loader' ) ) {
            $result = new PBWP_Item_Loader( $type, $val, $isBuilder );
            $items .= $result->render();
        }

    }

    if ( $items == null && is_customize_preview() ) {
        $items = '<div data-e-action="add" class="wpc_front_no_item" title="'.esc_attr( esc_html__( 'Add More Item', 'page-builder-wp' ) ).'"><i data-e-action="add" class="wpc-if-add-normal front_empty_add_new"></i></div>';
    }

    return $items;

}

function pbwp_generate_videobg( $config, $arrayAttr = false )
{

    $has_fill      = $has_video      = $use_videobg      = false;
    $vid_data_attr = '';

    if ( isset( $config[ 'videobg' ] ) && $config[ 'videobg' ] == 'yes' && isset( $config[ 'videobgurl' ] ) && $config[ 'videobgurl' ] != '' ) {

        if ( $arrayAttr ) {

            $is_loop_attr  = ( isset( $config[ 'dis_videobg_loop' ] ) && $config[ 'dis_videobg_loop' ] == 'yes' ? [ 'wpc_video_bg_loop' => esc_attr( $config[ 'dis_videobg_loop' ] ) ] : '' );
            $vid_data_attr = [ 'wpc_video_bg' => esc_url( $config[ 'videobgurl' ] ) ];

            if ( is_array( $is_loop_attr ) ) {
                $vid_data_attr = array_merge( $vid_data_attr, $is_loop_attr );
            }

        } else {
            $is_loop_attr = ( isset( $config[ 'dis_videobg_loop' ] ) && $config[ 'dis_videobg_loop' ] == 'yes' ? ' data-wpc_video_bg_loop="'.esc_attr( $config[ 'dis_videobg_loop' ] ).'"' : '' );
            $vid_data_attr .= ' data-wpc_video_bg="'.esc_url( $config[ 'videobgurl' ] ).'"'.$is_loop_attr.'';
        }

        $has_fill = $has_video = $use_videobg = true;
    }

    return [ 'use_videobg' => $use_videobg, 'videobg_data_attr' => $vid_data_attr, 'has_fill' => $has_fill, 'has_video' => $has_video ];

}

function pbwp_generate_parallax( $config, $arrayAttr = false )
{

    $has_fill    = $use_parallax    = false;
    $prllx_class = $prllx_data_attr = '';
    $has_video   = ( isset( $config[ 'videobg' ] ) && $config[ 'videobg' ] == 'yes' && isset( $config[ 'videobgurl' ] ) && $config[ 'videobgurl' ] ? true : false );

    if ( isset( $config[ 'parallax' ] ) && $config[ 'parallax' ] == 'yes' && isset( $config[ 'img_id' ] ) && $config[ 'img_id' ] != '' && ! $has_video ) {

        $i_url     = wp_get_attachment_image_src( $config[ 'img_id' ], 'full' );
        $par_speed = ( isset( $config[ 'parallax_speed' ] ) ? $config[ 'parallax_speed' ] : '1.5' );
        $prllx_class .= ' wpc_parallax wpc_on_parallax';

        $i_url_src = ( isset( $i_url[ 0 ] ) ? $i_url[ 0 ] : esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) ) );
        $i_h       = ( isset( $i_url[ 2 ] ) ? $i_url[ 2 ] : 350 );

        if ( $arrayAttr ) {
            $prllx_data_attr = [ 'wpc-parallax-img' => esc_url( $i_url_src ), 'wpc-parallax-speed' => esc_attr( $par_speed ), 'wpc-parallax-height' => esc_attr( $i_h ) ];
        } else {
            $prllx_data_attr .= ' data-wpc-parallax-img="'.esc_url( $i_url_src ).'" data-wpc-parallax-speed="'.esc_attr( $par_speed ).'" data-wpc-parallax-height="'.esc_attr( $i_h ).'"';
        }

        $has_fill = $use_parallax = true;

    }

    return [ 'use_parallax' => $use_parallax, 'parallax_class' => $prllx_class, 'parallax_data_attr' => $prllx_data_attr, 'has_fill' => $has_fill ];

}

function pbwp_generate_divider( $config, $arrayAttr = false )
{

    $use_divider   = false;
    $divider_class = $svgData = $divider_top = $divider_bottom = '';
    $defaultConfig = wp_json_encode( [ 'top' => [
        'shape'          => 'none',
        'customShape'    => '',
        'fillColor'      => '#009eed',
        'gradientColors' => [ '#2c5fab', '#b25ebf' ],
        'gradientMode'   => false,
        'flip'           => false,
        'overflow'       => false,
        'animation'      => false,
        'height'         => 150,
        'width'          => 100,
        'svgProp'        => [
            'noInvert' => false,
         ],
     ], 'bottom' => [
        'shape'          => 'wave',
        'customShape'    => '',
        'fillColor'      => '#009eed',
        'gradientColors' => [ '#2c5fab', '#b25ebf' ],
        'flip'           => false,
        'overflow'       => false,
        'animation'      => false,
        'height'         => 150,
        'width'          => 100,
        'svgProp'        => [
            'noInvert' => false,
         ],
     ],
     ] );

    if ( isset( $config[ 'shapedivider' ] ) && $config[ 'shapedivider' ] == 'yes' ) {

        $use_divider = true;

        if ( isset( $config[ 'shapedivider_data' ] ) && $config[ 'shapedivider_data' ] != '' ) {
            $svgData = json_decode( base64_decode( $config[ 'shapedivider_data' ], true ) );
        } else {
            $svgData = json_decode( $defaultConfig, false );
        }

        if ( $svgData->top->shape == 'none' && $svgData->bottom->shape == 'none' ) {
            $divider_class = '';
        } else {
            $divider_class = ' shapedivider_mode';
        }

        if ( $svgData->top->shape !== 'none' ) {
            $divider_top = pbwp_generate_divider_markup( $svgData->top, 'top' );
        }

        if ( $svgData->bottom->shape !== 'none' ) {
            $divider_bottom = pbwp_generate_divider_markup( $svgData->bottom, 'bottom' );
        }

    }

    return ( [ 'use_divider' => $use_divider, 'dividerMarkup' => $divider_top.$divider_bottom, 'divider_class' => $divider_class, 'divider_data_attr' => false, 'has_fill' => false ] );

}

function pbwp_generate_divider_markup( $shapeData, $pos )
{

    $svgProp = [  ];
    $svgWrap = $svg = '';

    // Add svg position based on settings
    $svgProp[  ] = $pos.'_position';

    if ( $shapeData->flip ) {
        $svgProp[  ] = 'flip_mode';
    }

    if ( $shapeData->overflow ) {
        $svgProp[  ] = 'overflow_on';
    }

    if ( $shapeData->animation ) {
        $svgProp[  ] = 'animation_mode';
    }

    if ( $shapeData->svgProp->noInvert ) {

        if ( $pos == 'top' ) {
            $svgProp[  ] = 'invert_mode';
        }

    } else {

        if ( $pos == 'bottom' ) {
            $svgProp[  ] = 'invert_mode';
        }

    }

    if ( $shapeData->shape == 'custom' ) {

        if ( $shapeData->customShape == '' ) {
            return '';
        }

        $svg = $shapeData->customShape;
    } else {
        $svg = pbwp_get_svg_code( $shapeData->shape );
    }

    if ( isset( $shapeData->gradientMode ) && $shapeData->gradientMode ) {
        $svg = pbwp_svg_set_gradient( $svg, $shapeData->gradientColors );
    }

    $svgWrap = '<div class="shapedivider_cont wpc_shapedivider_cont '.( ! empty( $svgProp ) ? implode( ' ', $svgProp ) : '' ).'">'.$svg.'</div>';

    return $svgWrap;

}

function pbwp_has_fill( $css, $has_fill )
{

    $css_devices = [ 'desktop', 'tablet', 'smartphone' ];

    foreach ( $css_devices as $device ) {

        if ( array_key_exists( $device, $css ) ) {

            if ( array_key_exists( '.self.|bg_control_only', $css[ $device ] ) && array_key_exists( '.self.|background-image', $css[ $device ] ) ) {

                if ( $css[ $device ][ '.self.|background-image' ] != '' && $css[ $device ][ '.self.|bg_control_only' ] == 'yes' ) {
                    $has_fill = true;
                }

            }

        }

    }

    return $has_fill;

}
