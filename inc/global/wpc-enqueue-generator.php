<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_scripts_path( $type, $handle )
{

    $scripts = apply_filters( 'pbwp_frontend_editor_enqueue_script_url', [
        'link'   => [
            'animate'            => pbwp_frontend_asset_url( 'css/vendors/animate/animate.min.css' ),
            'icomoon'            => pbwp_frontend_asset_url( 'css/iconfonts/icomoon/icomoon.css' ),
            'fontello'           => pbwp_frontend_asset_url( 'css/iconfonts/fontello/css/fontello.css' ),
            'openiconic'         => pbwp_frontend_asset_url( 'css/iconfonts/openiconic/css/open-iconic-bootstrap.min.css' ),
            'fontawesome'        => pbwp_frontend_asset_url( 'css/iconfonts/fontawesome/font-awesome.min.css' ),
            'materialicons'      => pbwp_frontend_asset_url( 'css/iconfonts/gmi/gmi.css' ),
            'justvector'         => pbwp_frontend_asset_url( 'css/iconfonts/justvector/stylesheets/justvector.css' ),
            'paymentfont'        => pbwp_frontend_asset_url( 'css/iconfonts/paymentfont/css/paymentfont.min.css' ),
            'dashicons'          => includes_url( '/css/dashicons.min.css' ),
            'owl-carousel'       => pbwp_frontend_asset_url( 'css/vendors/owlcarousel/owl.carousel.min.css' ),
            'owl-carousel-theme' => pbwp_frontend_asset_url( 'css/vendors/owlcarousel/owl.theme.default.min.css' ),
            'flipster-theme'     => pbwp_frontend_asset_url( 'css/vendors/flipster/jquery.flipster.min.css' ),
            'opensans'           => esc_url( PBWP_GOOGLE_FONTS_URL ).'=Open+Sans:wght@300;400;500;600&display=swap',
            'fullcalendar'       => pbwp_frontend_asset_url( 'css/vendors/fullcalendar/main.min.css' ),
            'twentytwenty'       => pbwp_frontend_asset_url( 'css/vendors/twentytwenty/twentytwenty.min.css' ),
            'lightcase'          => pbwp_frontend_asset_url( 'css/vendors/lightbox/lightcase/lightcase.min.css' ),
            'prettyphoto'        => pbwp_frontend_asset_url( 'css/vendors/lightbox/prettyphoto/prettyPhoto.min.css' ),
            'photobox'           => pbwp_frontend_asset_url( 'css/vendors/lightbox/photobox/photobox.min.css' ),
            'youtubegallerywall' => pbwp_frontend_asset_url( 'css/vendors/ytg/youtubegallerywall.min.css' ),
            'swiper'             => pbwp_frontend_asset_url( 'css/vendors/swiper/swiper-bundle.min.css' ),
         ],
        'script' => [
            'lazyload'           => pbwp_frontend_asset_url( 'js/vendors/lazyload/jquery.lazyload.min.js' ),
            'waypoints'          => pbwp_frontend_asset_url( 'js/vendors/waypoints/jquery.waypoints.min.js' ),
            'counterup'          => pbwp_frontend_asset_url( 'js/vendors/counterup/jquery.counterup.min.js' ),
            'skrollr'            => pbwp_frontend_asset_url( 'js/vendors/skrollrcustom/skrollrCustom.min.js' ),
            'owl-carousel'       => pbwp_frontend_asset_url( 'js/vendors/owlcarousel/owl.carousel.min.js' ),
            'flipster'           => pbwp_frontend_asset_url( 'js/vendors/flipster/jquery.flipster.min.js' ),
            'fullcalendar'       => pbwp_frontend_asset_url( 'js/vendors/fullcalendar/main.min.js' ),
            'eventmove'          => pbwp_frontend_asset_url( 'js/vendors/twentytwenty/jquery.event.move.min.js' ),
            'twentytwenty'       => pbwp_frontend_asset_url( 'js/vendors/twentytwenty/jquery.twentytwenty.min.js' ),
            'lightcase'          => pbwp_frontend_asset_url( 'js/vendors/lightbox/lightcase/lightcase.min.js' ),
            'prettyphoto'        => pbwp_frontend_asset_url( 'js/vendors/lightbox/prettyphoto/jquery.prettyPhoto.min.js' ),
            'photobox'           => pbwp_frontend_asset_url( 'js/vendors/lightbox/photobox/jquery.photobox.min.js' ),
            'basictable'         => pbwp_frontend_asset_url( 'js/vendors/basictable/jquery.basictable.min.js' ),
            'chartjs'            => pbwp_frontend_asset_url( 'js/vendors/chartjs/Chart.min.js' ),
            'youtube-iframe-api' => esc_url( PBWP_YOUTUBE_API ),
            'youtubegallerywall' => pbwp_frontend_asset_url( 'js/vendors/ytg/youtubegallerywall.min.js' ),
            'validate'           => pbwp_frontend_asset_url( 'js/vendors/validate/jquery.validate.min.js' ),
            'swiper'             => pbwp_frontend_asset_url( 'js/vendors/swiper/swiper-bundle.min.js' ),
         ],
     ] );

    return isset( $scripts[ $type ][ $handle ] ) ? $scripts[ $type ][ $handle ] : '';

}

function pbwp_get_enqueue_list( $itemType )
{

    $itemType = strtolower( $itemType );

    $enqueue_list = apply_filters( 'pbwp_frontend_editor_item_enqueue_list', [
        'counterup'         => [
            [
                'type'   => 'script',
                'name'   => 'counterup',
                'direct' => true,
             ],
         ],
        'imagecomparison'   => [
            [
                'type'   => 'link',
                'name'   => 'twentytwenty',
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'eventmove',
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'twentytwenty',
                'direct' => true,
             ],
         ],
        'imageflipster'     => [
            [
                'type'   => 'link',
                'name'   => 'flipster-theme',
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'flipster',
                'direct' => true,
             ],
         ],
        'imagegallery'      => [
            [
                'type'   => 'link',
                'name'   => 'icomoon',
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'photobox',
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'prettyphoto',

                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'photobox',
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'prettyphoto',
                'direct' => true,
             ],
         ],
        'imageslider'       => [
            [
                'type'   => 'script',
                'name'   => 'swiper',
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'swiper',
                'direct' => true,
             ],
         ],
        'newsletterform'    => [
            [
                'type'   => 'script',
                'name'   => 'validate',
                'direct' => true,
             ],
         ],
        'table'             => [
            [
                'type'   => 'script',
                'name'   => 'basictable',
                'direct' => true,
             ],
         ],
        'typeeventcalendar' => [
            [
                'type'   => 'link',
                'name'   => 'opensans',
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'fullcalendar',
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'fullcalendar',
                'direct' => true,
             ],
         ],
        'typeimage'         => [
            [
                'type'   => 'link',
                'name'   => 'icomoon',
                'direct' => true,
             ],
         ],
        'typelinechart'     => [
            [
                'type'   => 'script',
                'name'   => 'chartjs',
                'direct' => true,
             ],
         ],
        'typeroundchart'    => [
            [
                'type'   => 'script',
                'name'   => 'chartjs',
                'direct' => true,
             ],
         ],
        'youtubegallery'    => [
            [
                'type'   => 'script',
                'name'   => 'youtubegallerywall',
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'youtubegallerywall',
                'direct' => true,
             ],
         ],
        'alertbox'          => [
            [
                'type'   => 'link',
                'name'   => 'icomoon',
                'direct' => true,
             ],
         ],
        'typeicon'          => [
            [
                'type'   => 'link',
                'name'   => 'fontawesome',
                'direct' => true,
             ],
         ],
        'typetimeline'      => [
            [
                'type'   => 'link',
                'name'   => 'fontawesome',
                'direct' => true,
             ],
         ],
        'testimonial'       => [
            [
                'type'   => 'link',
                'name'   => 'fontawesome',
                'direct' => true,
             ],
         ],
        'wooproductpage'    => pbwp_get_woo_enqueue_list(),

     ] );

    $item_scripts = isset( $enqueue_list[ $itemType ] ) ? $enqueue_list[ $itemType ] : false;

    if ( ! $item_scripts ) {
        return false;
    }

    if ( $itemType === 'wooproductpage' ) {
        return $enqueue_list[ $itemType ];
    }

    foreach ( $item_scripts as $key => $script ) {
        $item_scripts[ $key ][ 'path' ] = pbwp_scripts_path( $script[ 'type' ], $script[ 'name' ] );
    }

    return $item_scripts;

}

function pbwp_get_woo_enqueue_list()
{

    if ( class_exists( 'WC_Frontend_Scripts' ) ) {

        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        $woo_scripts = [
            [
                'type'   => 'script',
                'name'   => 'zoom',
                'path'   => plugins_url( 'assets/js/zoom/jquery.zoom'.$suffix.'.js', WC_PLUGIN_FILE ),
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'flexslider',
                'path'   => plugins_url( 'assets/js/flexslider/jquery.flexslider'.$suffix.'.js', WC_PLUGIN_FILE ),
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'photoswipe-ui-default',
                'path'   => plugins_url( 'assets/js/photoswipe/photoswipe-ui-default'.$suffix.'.js', WC_PLUGIN_FILE ),
                'direct' => true,
             ],
            [
                'type'   => 'script',
                'name'   => 'wc-single-product',
                'path'   => plugins_url( 'assets/js/frontend/single-product'.$suffix.'.js', WC_PLUGIN_FILE ),
                'direct' => true,
             ],
            [
                'type'   => 'link',
                'name'   => 'photoswipe-default-skin',
                'path'   => plugins_url( 'assets/css/photoswipe/default-skin/default-skin.min.css', WC_PLUGIN_FILE ),
                'direct' => true,
             ],
         ];

        return $woo_scripts;

    }

}
