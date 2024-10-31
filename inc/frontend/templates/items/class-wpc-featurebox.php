<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {exit;}

class PBWP_Feature_Box extends PBWP_Item_Loader
{

    protected $identity = 'featurebox';

    public function render()
    {

        $data = $this->data;

        $item_markup     = $media_parent_start     = $media_parent_end     = $content_side_style     = '';
        $title           = pbwp_get_item_options( $data, 'title', esc_html__( 'Your Title Here', 'wp-composer' ) );
        $desc            = pbwp_get_texteditor_content( $data, 'featuredesc', ( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'wp-composer' ) ) );
        $misc            = pbwp_get_item_options( $data, 'misc', esc_html__( 'Your Misc Text Here', 'wp-composer' ) );
        $ftre_tpl        = pbwp_get_item_options( $data, 'template', 'fbox_style_01' );
        $ftre_media      = pbwp_get_item_options( $data, 'media_type', 'none' );
        $ftre_img        = pbwp_get_item_options( $data, 'img_id' );
        $ftre_icon       = pbwp_get_item_options( $data, 'featured_icon' );
        $ftre_size       = pbwp_get_item_options( $data, 'size', 'medium' );
        $custom_size     = pbwp_get_item_options( $data, 'custom_size', '250x250' );
        $use_button      = pbwp_get_item_options( $data, 'feature_box_btn' );
        $link_txt        = pbwp_get_item_options( $data, 'btn_text', esc_html__( 'My Button', 'wp-composer' ) );
        $btn_link        = pbwp_get_item_options( $data, 'the_link', '#|_self' );
        $btn_pos         = pbwp_get_item_options( $data, 'position', 'left' );
        $btn_icon        = pbwp_get_item_options( $data, 'icon' );
        $show_social     = pbwp_get_item_options( $data, 'feature_box_social_link', 'no' );
        $ftre_img_w      = pbwp_get_item_options( $data, 'feature_box_img_width_type', 'no' );
        $use_filter      = pbwp_get_item_options( $data, 'use_img_ig_filter' );
        $image_filter    = pbwp_get_item_options( $data, 'img_ig_filters', 'hefe' );
        $social_link     = [  ];
        $inlineEditorTtl = $inlineEditorDesc = $inlineEditorMisc = $inlineEditorBtn = 'none';

        // Escape first
        $link_txt = esc_html( $link_txt );

        if ( $use_filter != 'yes' ) {
            $image_filter = 'normal';
        }

        if ( is_customize_preview() ) {

            $inlineEditorTtl  = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'title', 'escapeHTML' => true ] ) );
            $inlineEditorDesc = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'featuredesc', 'toolbar' => true, 'encode' => true ] ) );
            $inlineEditorMisc = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'misc', 'escapeHTML' => true ] ) );
            $inlineEditorBtn  = htmlentities( serialize( [ 'type' => 'liveEdit', 'key' => 'btn_text', 'escapeHTML' => true ] ) );

            $link_txt = '<span data-inline-editor="'.$inlineEditorBtn.'">'.$link_txt.'</span>';

        }

        foreach ( [ 'facebook', 'twitter', 'instagram', 'google-plus', 'youtube' ] as $key => $val ) {

            if ( pbwp_get_item_options( $data, 'feature_box_sc_'.$val ) != '' ) {
                $social_link[ $key ] = [ 'icon' => $val, 'link' => pbwp_get_item_options( $data, 'feature_box_sc_'.$val ) ];
            }

        }

        $link_prop = explode( '|', $btn_link );
        $link_prop = 'href="'.esc_url( $link_prop[ 0 ] ).'" target="'.esc_attr( $link_prop[ 1 ] ).'"';

        if ( $btn_pos == 'left' && $btn_icon ) {
            $link_inner = '<span class="ftre_button_text">'.pbwp_create_icon_markup( $btn_icon ).$link_txt.'</span>';
        } else

        if ( $btn_pos == 'right' && $btn_icon ) {
            $link_inner = '<span class="ftre_button_text">'.$link_txt.pbwp_create_icon_markup( $btn_icon ).'</span>';
        } else {
            $link_inner = '<span class="ftre_button_text">'.$link_txt.'</span>';
        }

        if ( $ftre_tpl == 'fbox_style_02' || $ftre_tpl == 'fbox_style_03' ) {
            $content_side_style = ( $ftre_media != 'none' ? ' fbox_content_side' : '' );
            $media_parent_start = '<div class="fbox_media_side">';
            $media_parent_end   = '</div>';
        }

        $ftre_img = pbwp_get_attachment_image_src( $ftre_img, $ftre_size, $custom_size );

        $ftr_media = $media_parent_start.'<div class="ftre_box_media">'.( $ftre_icon && $ftre_media == 'icon' ? pbwp_create_icon_markup( $ftre_icon, 'ftre_icon' ) : '' ).( is_array( $ftre_img ) && $ftre_media == 'image' ? '<div class="ftre_image'.( $ftre_img_w == 'yes' ? ' no_blur' : '' ).'"><img class="wpc-image-filter-'.esc_attr( $image_filter ).' wpc_image_filter_ready" alt="'.esc_attr( $ftre_img[ 'alt' ] ).'" src="'.esc_url( $ftre_img[ 'url' ] ).'"/></div>' : '' ).'</div>'.$media_parent_end;

        $item_markup .= '<div class="ftre_box">';
        $item_markup .= '<div class="ftre_box_template_'.esc_attr( $ftre_tpl ).( $ftre_media == 'image' ? ' fbox_type_image' : '' ).'">';

        if (  ( $ftre_tpl == 'fbox_style_01' || $ftre_tpl == 'fbox_style_02' ) && $ftre_media != 'none' ) {
            $item_markup .= $ftr_media;
        }

        $item_markup .= '<div class="ftre_box_content'.esc_attr( $content_side_style ).'">';

        if ( $title != 'none' ) {
            $item_markup .= '<div class="ftre_title"><h4 data-inline-editor="'.esc_attr( $inlineEditorTtl ).'">'.esc_html( $title ).'</h4></div>';
        }

        if ( $misc != 'none' && $misc || $misc == esc_html__( 'Your Misc Text Here', 'wp-composer' ) ) {
            $item_markup .= '<div class="ftre_misc"><h5 data-inline-editor="'.esc_attr( $inlineEditorMisc ).'">'.esc_html( $misc ).'</h5></div>';
        }

        if ( trim( wpautop( $desc ), "\n" ) != '<p>none</p>' && trim( $desc, "\n" ) != '' ) {
            $item_markup .= '<div data-inline-editor="'.esc_attr( $inlineEditorDesc ).'" class="ftre_desc'.( $misc != 'none' && $misc || $title != 'none' && $title ? ' ftre_desc_has_ttl_misc' : '' ).'">'.pbwp_wp_editor_safe_content( $desc ).'</div>';
        }

        if ( ! empty( $social_link ) && $show_social == 'yes' ) {

            $item_markup .= '<ul class="ftre_social_link">';
            $item_markup .= pbwp_create_social_icon_markup( $social_link );
            $item_markup .= '</ul>'; // End Button Markup

        }

        if ( $use_button == 'yes' ) {
            $item_markup .= '<a '.$link_prop.' class="ftre_button_a"><div class="ftre_button">';
            $item_markup .= $link_inner;
            $item_markup .= '</div></a>'; // End Button Markup
        }

        $item_markup .= '</div>';

        // End FeatureBox Content

        if ( $ftre_tpl == 'fbox_style_03' && $ftre_media != 'none' ) {
            $item_markup .= $ftr_media;
        }

        $item_markup .= '</div></div>'; // End FeatureBox Box Inner > End FeatureBox Box

        return $item_markup;

    }

}
