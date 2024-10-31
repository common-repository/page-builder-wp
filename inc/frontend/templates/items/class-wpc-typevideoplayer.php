<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Video_Player extends PBWP_Item_Loader
{

    protected $identity = 'typevideoplayer';

    public function render()
    {

        $data = $this->data;

        $item_markup  = '';
        $vid_source   = pbwp_get_item_options( $data, 'vid_url' );
        $vid_fw       = pbwp_get_item_options( $data, 'fullwidth', 'yes' );
        $vid_width    = pbwp_get_item_options( $data, 'video-width', 640 );
        $vid_height   = pbwp_get_item_options( $data, 'video-height', 360 );
        $vid_poster   = pbwp_get_item_options( $data, 'img_id', 'none' );
        $vid_autoplay = pbwp_get_item_options( $data, 'autoplay', 'no' );

        if ( $vid_source ) {

            $useMediaElement = ( strpos( $vid_source, 'vimeo.com' ) !== false || strpos( $vid_source, 'youtu.be' ) !== false || strpos( $vid_source, 'youtube.com' ) !== false || strpos( $vid_source, '.mp4' ) !== false ? true : false );

            // Attributes of the shortcode.
            $attr = [
                'src'     => esc_url( $vid_source ),
                'height'  => (int) $vid_height,
                'width'   => (int) $vid_width,
                'preload' => 'auto',
             ];

            if ( $vid_autoplay == 'yes' ) {
                $attr[ 'autoplay' ] = 'on';
                $attr[ 'muted' ]    = 'muted';
            }

            if ( $vid_poster && $vid_poster != 'none' ) {
                $poster_opt       = pbwp_get_attachment_image_src( (int) $vid_poster );
                $attr[ 'poster' ] = esc_url( $poster_opt[ 'full_size_uri' ] );
            }

            if ( (int) $vid_height <= 0 || $vid_fw == 'yes' ) {
                unset( $attr[ 'height' ] );
            }

            if ( (int) $vid_width <= 0 || $vid_fw == 'yes' ) {
                unset( $attr[ 'width' ] );
            }

            $item_markup .= '<div class="wpc_item_video_player'.( $vid_fw == 'yes' ? ' fwvideo' : '' ).( $useMediaElement ? ' wpcvid_mediaelement' : ' wpcvid_non_mediaelement' ).'">';

            if ( $useMediaElement ) {

                if ( $useMediaElement === 'wp_print_scripts' ) {
                    wp_print_scripts( [ 'mediaelement-vimeo', 'wp-mediaelement' ] );
                }

                wp_enqueue_style( 'wp-mediaelement' );
                wp_enqueue_script( 'mediaelement-vimeo' );

                $content = '';
                $item_markup .= wp_video_shortcode( $attr, $content );

            } else {

                add_filter( 'embed_oembed_html', [ $this, 'pbwp_modify_embed_markup' ] );

                global $wp_embed;
                $item_markup .= $wp_embed->run_shortcode( '[embed'.( isset( $attr[ 'width' ] ) ? ' width="'.esc_attr( $attr[ 'width' ] ).'"' : '' ).( isset( $attr[ 'height' ] ) ? ' height="'.esc_attr( $attr[ 'height' ] ).'"' : '' ).']'.esc_url( $vid_source ).'[/embed]' );

            }

            $item_markup .= '</div>'; // End Video Markup

        } else {

            $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>'.esc_html__( 'Video format url incorrect', 'page-builder-wp' ).'</span>';

        }

        return $item_markup;

    }

    public function pbwp_modify_embed_markup( $code )
    {

        $video_markup = str_replace( '<iframe ', '<iframe class="wp-video" ', $code );

        return $video_markup;

    }

}
