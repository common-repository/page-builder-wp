<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Image_Gallery extends PBWP_Item_Loader
{

    protected $identity = 'imagegallery';

    public function render()
    {

        $data = $this->data;

        $item_markup           = '';
        $gal_ids               = pbwp_get_item_options( $data, 'img_id' );
        $gal_type              = pbwp_get_item_options( $data, 'gallery_type', 'masonry' );
        $gal_col               = pbwp_get_item_options( $data, 'columns', 3 );
        $gal_size              = pbwp_get_item_options( $data, 'size', 'medium' );
        $gal_size_custom       = pbwp_get_item_options( $data, 'custom_size', '250x250' );
        $gal_onclick           = pbwp_get_item_options( $data, 'action', 'lightbox' );
        $gal_lightbox_style    = pbwp_get_item_options( $data, 'lightbox_style', 'lightcase' );
        $gal_lightbox_pp_theme = pbwp_get_item_options( $data, 'prettyphoto_theme', 'light_square' );
        $gal_link              = pbwp_get_item_options( $data, 'the_link', '', true );
        $gal_link_target       = pbwp_get_item_options( $data, 'target', '_blank' );
        $gal_hover_effect      = pbwp_get_item_options( $data, 'hover_effect', 'yes' );
        $hover_effect_style    = pbwp_get_item_options( $data, 'hover_effect_style', 'fadeIn-top' );
        $gal_icon              = pbwp_get_item_options( $data, 'icon' );
        $gal_desc              = pbwp_get_item_options( $data, 'img_desc', '_desc' );
        $gal_is_title          = pbwp_get_item_options( $data, 'hover_title', 'yes' );

        $gal_data_front = [
            'id'               => $data[ 'id' ],
            'onClick'          => $gal_onclick,
            'prettyPhotoTheme' => $gal_lightbox_pp_theme,
            'lightbox_style'   => $gal_lightbox_style,
            'layout_mode'      => $gal_type,
            'custom_data_src'  => '.wpc_grid_gallery',
         ];

        $item_markup .= '<div data-gallery_data="'.htmlentities( serialize( $gal_data_front ) ).'" class="wpc_gallery_item">';

        if ( is_customize_preview() ) {

            $lbox = [ 'photobox', 'lightcase', 'prettyphoto' ];

            foreach ( $lbox as $key ) {
                wp_enqueue_style( $key );
                wp_enqueue_script( $key );
            }

        }

        if ( $gal_onclick == 'lightbox' ) {

            wp_enqueue_style( $gal_lightbox_style );
            wp_enqueue_script( $gal_lightbox_style );

        }

        // Load masonry script
        wp_enqueue_script( 'jquery-masonry' );

        if ( $gal_ids == '' || is_array( $gal_ids ) ) {
            $gal_ids = pbwp_pick_wpc_dummy_random_image_id( 10, true );
        }

        if ( $gal_ids != '' ) {
            // List of gallery ID
            $img_ids = explode( ',', $gal_ids );
            // For custom links
            $links = explode( "\n", $gal_link );
            $links = array_filter( $links, 'trim' );

            $item_markup .= '<div class="gallery_post_cont masonry wpc_use_masonry">';

            foreach ( $img_ids as $key => $imgID ) {

                $imgdata          = get_the_title( $imgID );
                $img_title        = ( $imgdata ? $imgdata : '' );
                $img_prop         = pbwp_get_attachment_image_src( $imgID, $gal_size, $gal_size_custom, $gal_desc );
                $img_alt          = $img_prop[ 'alt' ];
                $img_thumb        = $img_prop[ 'url' ];
                $img_desc         = $img_prop[ 'desc' ];
                $img_link_markup  = '';
                $img_title_markup = '';
                $custom_link      = '';
                $photobox_thumb   = '';
                $overlay_ready    = false;

                // Open in Lightbox
                if ( $gal_onclick == 'lightbox' ) {

                    // Full size image URL
                    $i_url     = wp_get_attachment_image_src( $imgID, 'full' );
                    $i_url_src = ( isset( $i_url[ 0 ] ) ? $i_url[ 0 ] : 'https://assets.wpcomposer.com/placehold/sqrpop/ec3d62/fff&text=Image+Not+Found' );

                    switch ( $gal_lightbox_style ) {

                        case 'lightcase':

                            $img_link_markup = '<a href="'.esc_url( $i_url_src ).'" class="showcase" data-rel="lightcase:'.esc_attr( $data[ 'id' ] ).':slideshow" title="'.esc_attr( $img_desc ).'">';

                            break;

                        case 'photobox':

                            $img_link_markup = '<a href="'.esc_url( $i_url_src ).'" data-rel="photobox_'.esc_attr( $data[ 'id' ] ).'">';

                            break;

                        case 'prettyphoto':

                            $img_link_markup = '<a data-pb-caption="'.esc_attr( $img_desc ).'" href="'.esc_url( $i_url_src ).'" rel="prettyPhoto['.esc_attr( $data[ 'id' ] ).']">';

                            break;

                        default:

                    }

                }

                // Custom Link
                if ( $gal_onclick == 'link' ) {

                    $custom_link     = ( isset( $links[ $key ] ) && $links[ $key ] ? $links[ $key ] : '#' );
                    $img_link_markup = '<a href="'.esc_url( $custom_link ).'" target="'.esc_attr( $gal_link_target ).'">';

                }

                // Hover Effect
                if ( $gal_hover_effect == 'yes' ) {

                    if ( $gal_icon == '' ) {
                        wp_enqueue_style( 'icomoon' );
                        $gal_icon = 'icomoon-camera';
                    }

                    $overlay_ready = true;

                    $img_title_markup .= '<div class="overlay_info '.esc_attr( $hover_effect_style ).'">';
                    if ( $gal_icon ) {
                        $icon_title = '';
                        if ( strpos( $gal_icon, 'material-icons' ) !== false ) {
                            $split      = explode( ' ', $gal_icon );
                            $icon_title = $split[ 1 ];
                        }

                        $img_title_markup .= '<i class="'.esc_attr( $gal_icon ).'">'.esc_html( $icon_title ).'</i>';
                    }

                    if ( $img_title && $gal_is_title == 'yes' ) {
                        $img_title_markup .= '<span class="gallery_title">'.esc_html( $img_title ).'</span>';
                    }

                    $img_title_markup .= '</div>';

                } else {

                    $overlay_ready    = false;
                    $img_title_markup = ( $img_title && $gal_is_title == 'yes' ? '<span class="wpc_gallery_title">'.esc_html( $img_title ).'</span>' : '' );

                }

                // Gallery items
                $gallery_markup = '';
                $gallery_markup .= '<div class="wpc_i_gallery_item wpc_col_'.$gal_col.( $overlay_ready ? ' wpc_img_overlay_cont ' : ' ' ).'wpc_masonry_item is-loading"><span class="itemloader"></span>'.$img_link_markup;

                if ( $overlay_ready ) {
                    $gallery_markup .= '<div class="wpc_img_overlay"></div>';
                }

                // Masonry Markup
                if ( $gal_type == 'grid' ) {
                    // Thumbnail size correction
                    $grid_thumb = $img_thumb;

                    if ( $gal_size == 'custom' ) {
                        $grid_thumb = $img_thumb;
                    }

                    if ( $gal_col <= 4 && ( $gal_size == 'thumbnail' || $gal_size == 'medium' ) ) {

                        $grid_thumb = wp_get_attachment_image_src( $imgID, 'large' );

                        if ( ! isset( $grid_thumb[ 0 ] ) ) {
                            $grid_thumb = wp_get_attachment_image_src( $imgID, 'full' );
                        }

                        $grid_thumb = ( isset( $grid_thumb[ 0 ] ) ? $grid_thumb[ 0 ] : 'https://assets.wpcomposer.com/placehold/300x300/ec3d62/fff&text=Image+Not+Found' );

                    }

                    if ( $gal_lightbox_style == 'photobox' ) {
                        $photobox_thumb = 'data-photo-thumb="'.esc_url( $grid_thumb ).'" ';
                    }

                    $img_ttl_mk = ( $img_desc && $gal_onclick == 'lightbox' && $gal_lightbox_style == 'photobox' ? ' data-pb-caption="'.esc_attr( $img_desc ).'"' : '' );

                    $gallery_markup .= '<div '.$photobox_thumb.'class="wpc_grid_gallery wpc_img__background" style="background-image: url('.esc_url( $grid_thumb ).')"'.$img_ttl_mk.'></div>';

                }

                if ( $gal_type == 'masonry' ) {

                    $img_ttl_mk = ( $img_desc && $gal_onclick == 'lightbox' && ( $gal_lightbox_style == 'photobox' || $gal_lightbox_style == 'prettyphoto' ) ? ' data-pb-caption="'.esc_attr( $img_desc ).'"' : '' );

                    $gallery_markup .= '<img alt="'.esc_attr( $img_alt ).'" class="wpc-g-img" src="'.esc_url( $img_thumb ).'"'.$img_ttl_mk.'>';

                }

                $gallery_markup .= $img_title_markup.( $gal_onclick == 'link' || $gal_onclick == 'lightbox' ? '</a>' : '' ).'</div>';

                $item_markup .= $gallery_markup;

            }

            $item_markup .= '</div>'; // End ig_post_cont

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>Image Gallery Error: '.esc_html__( 'No image found!', 'wp-composer' ).'</span>';

        }

        $item_markup .= '</div>'; // End Image Gallery Markup

        return $item_markup;

    }

}
