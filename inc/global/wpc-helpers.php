<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_id_length()
{

    return apply_filters( 'pbwp_id_length', 7 );

}

function pbwp_uniqueMe()
{

    $_chars    = md5( uniqid( wp_rand(), true ) );
    $_charcode = '';

    for ( $l = 0; $l < pbwp_id_length(); $l++ ) {
        $temp = str_shuffle( $_chars );
        $_charcode .= $temp[ 0 ];
    }

    // Check if the first character is a number
    if ( is_numeric( $_charcode[ 0 ] ) ) {
        $_charcode[ 0 ] = chr( wp_rand( 97, 122 ) );
    }

    return $_charcode;

}

function pbwp_get_user_role()
{

    return apply_filters( 'pbwp_user_role', [ 'administrator', 'editor' ] );

}

if ( ! function_exists( 'pbwp_addons' ) ) {
    /**
     * WP Composer Addons manager.
     * @since 1.0.0
     * @return PBWP_Addons_Manager
     */
    function pbwp_addons()
    {

        if ( class_exists( 'PBWP_Addons_Manager' ) ) {
            return PBWP_Addons_Manager::getInstance();
        }

    }

}

if ( ! function_exists( 'pbwp_addon_control' ) ) {
    /**
     * WP Composer Controls manager.
     * @since 1.0.0
     * @return pbwp_addon_control
     */
    function pbwp_addon_control()
    {

        if ( class_exists( 'PBWP_Addon_Control' ) ) {
            return PBWP_Addon_Control::getInstance();
        }

    }

}

if ( ! function_exists( 'pbwp_manager' ) ) {
    /**
     * WP Composer manager.
     * @since 1.0.0
     * @return PBWP_Composer
     */
    function pbwp_manager()
    {
        return PBWP_Composer::getInstance();
    }

}

if ( ! function_exists( 'pbwp_distribution_url' ) ) {
    /**
     * Get full url for backend assets.
     *
     * @param string $file
     *
     * @since 1.0.0
     * @return string
     */
    function pbwp_distribution_url( $file )
    {
        return preg_replace( '/\s/', '%20', plugins_url( pbwp_manager()->path( 'DIST_DIR', $file ), __DIR__ ) );
    }

}

if ( ! function_exists( 'pbwp_backend_asset_url' ) ) {
    /**
     * Get full url for backend assets.
     *
     * @param string $file
     *
     * @since 1.0.0
     * @return string
     */
    function pbwp_backend_asset_url( $file )
    {
        return pbwp_manager()->assetUrl( $file, 'backend' );
    }

}

if ( ! function_exists( 'pbwp_frontend_asset_url' ) ) {
    /**
     * Get full url for frontend assets.
     *
     * @param string $file
     *
     * @since 1.0.0
     * @return string
     */
    function pbwp_frontend_asset_url( $file )
    {
        return pbwp_manager()->assetUrl( $file );
    }

}

if ( ! function_exists( 'pbwp_global_asset_url' ) ) {
    /**
     * Get full url for global assets.
     *
     * @param string $file
     *
     * @since 1.0.0
     * @return string
     */
    function pbwp_global_asset_url( $file, $backend = false, $custom = false )
    {
        return pbwp_manager()->assetUrl( $file, $backend, $custom );
    }

}

if ( ! function_exists( 'pbwp_front_get_option' ) ) {
    // Get WP Composer Global options
    function pbwp_front_get_option( $opt )
    {

        $wpc_opt = get_option( 'pbwp_globals' );

        if ( isset( $wpc_opt ) && is_array( $wpc_opt ) && array_key_exists( $opt, $wpc_opt ) ) {
            return $wpc_opt[ $opt ];
        }

        return false;

    }

}

if ( ! function_exists( 'pbwp_get_supported_post_types' ) ) {

    function pbwp_get_supported_post_types( $inString = false )
    {

        $general_sst      = pbwp_front_get_option( 'stt_general' );
        $general_postType = ( isset( $general_sst[ 'wpc_post_type' ] ) ? $general_sst[ 'wpc_post_type' ] : 'post, page' );
        $general_array    = array_map( 'trim', explode( ',', $general_postType ) );

        if ( $inString ) {
            return $general_postType;
        }

        return $general_array;

    }

}

function pbwp_is_allowed_post_type( $post_type )
{

    $post_types = pbwp_get_supported_post_types();

    if ( ! in_array( $post_type, $post_types ) ) {
        return false;
    }

    return true;

}

function pbwp_on_debug_mode()
{

    $general_sst = pbwp_front_get_option( 'stt_general' );

    return ( isset( $general_sst[ 'wpc_debug' ] ) && trim( $general_sst[ 'wpc_debug' ] ) === 'active' ? true : false );

}

function pbwp_get_item_refresh_after_insert()
{

    return apply_filters( 'pbwp_item_in_refresh_after_insert', [ 'typeMaps', 'contactForm' ] );

}

function pbwp_get_google_maps_api_key()
{

    $general_sst = pbwp_front_get_option( 'stt_general' );

    return ( isset( $general_sst[ 'gmaps_key' ] ) ? trim( $general_sst[ 'gmaps_key' ] ) : '' );

}

if ( ! function_exists( 'pbwp_frontend_script' ) ) {
    /**
     * Enqueue all plugins scripts
     *
     * @since 1.0.0
     * @return url
     */
    function pbwp_frontend_script()
    {

        if ( ! pbwp_is_on_post() || pbwp_is_disabled() ) {
            return;
        }

        if ( ! function_exists( 'pbwp_i18n' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-i18n.php' );
        }

        wp_enqueue_style( 'pbwpstyle', pbwp_distribution_url( 'css/frontendCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION, 'all' );

        wp_register_script( 'phpunserialize', pbwp_frontend_asset_url( 'js/vendors/phpunserialize/phpunserialize.min.js' ), [
            'jquery',
         ], PBWP_VERSION, true );

        wp_register_script( 'pbwpjs', pbwp_distribution_url( 'js/frontendJs.bundle.js' ), [
            'jquery', 'imagesloaded',
         ], PBWP_VERSION, true );

        wp_register_script( 'pbwpjs-connector', pbwp_distribution_url( 'js/frontendConnectorJs.bundle.js' ), [
            'jquery', 'imagesloaded',
         ], PBWP_VERSION, true );

        wp_enqueue_script( 'phpunserialize' );
        wp_enqueue_script( 'pbwpjs' );

        if ( is_customize_preview() ) {
            wp_enqueue_script( 'pbwpjs-connector' );
        }

        wp_localize_script( 'pbwpjs', 'wp_composer', [
            'is_RTL'               => is_rtl(),
            'ajax_url'             => admin_url( 'admin-ajax.php' ),
            'wpc_ajax_nonce'       => wp_create_nonce( 'wpc_ajax_nonce' ),
            'wpc_gmaps_url'        => PBWP_GOOGLE_MAPS_API,
            'wpc_gmaps_key'        => esc_html( pbwp_get_google_maps_api_key() ),
            'postID'               => get_the_ID(),
            'postTitle'            => htmlspecialchars_decode( get_the_title(), ENT_NOQUOTES ),
            'is_customize_preview' => is_customize_preview(),
            'asset_url'            => esc_url( pbwp_frontend_asset_url( '/' ) ),
            'wpc_version'          => PBWP_VERSION,
            'wpc_console'          => false,
            'lang'                 => pbwp_i18n( 'items' ),
         ] );

        // Animation
        wp_register_style( 'animate', pbwp_frontend_asset_url( 'css/vendors/animate/animate.min.css' ), [  ], PBWP_VERSION, 'all' );
        // Register icon fonts
        wp_register_style( 'icomoon', pbwp_frontend_asset_url( 'css/iconfonts/icomoon/icomoon.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'fontello', pbwp_frontend_asset_url( 'css/iconfonts/fontello/css/fontello.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'openiconic', pbwp_frontend_asset_url( 'css/iconfonts/openiconic/css/open-iconic-bootstrap.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'fontawesome', pbwp_frontend_asset_url( 'css/iconfonts/fontawesome/font-awesome.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'materialicons', pbwp_frontend_asset_url( 'css/iconfonts/gmi/gmi.css' ), [  ], PBWP_VERSION, 'all' );

        wp_register_style( 'justvector', pbwp_frontend_asset_url( 'css/iconfonts/justvector/stylesheets/justvector.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'paymentfont', pbwp_frontend_asset_url( 'css/iconfonts/paymentfont/css/paymentfont.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'dashicons', includes_url( '/css/dashicons.min.css' ), [  ], PBWP_VERSION );

        // Register Vendor CSS / JS
        wp_register_script( 'lazyloadjquery', pbwp_frontend_asset_url( 'js/vendors/lazyload/jquery.lazyload.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'waypoints', pbwp_frontend_asset_url( 'js/vendors/waypoints/jquery.waypoints.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'counterup', pbwp_frontend_asset_url( 'js/vendors/counterup/jquery.counterup.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'skrollr', pbwp_frontend_asset_url( 'js/vendors/skrollrcustom/skrollrCustom.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'stickystack', pbwp_frontend_asset_url( 'js/vendors/stickystack/jquery.stickystack.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_style( 'owl-carousel', pbwp_frontend_asset_url( 'css/vendors/owlcarousel/owl.carousel.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_style( 'owl-carousel-theme', pbwp_frontend_asset_url( 'css/vendors/owlcarousel/owl.theme.default.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'owl-carousel', pbwp_frontend_asset_url( 'js/vendors/owlcarousel/owl.carousel.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        wp_register_style( 'flipster-theme', pbwp_frontend_asset_url( 'css/vendors/flipster/jquery.flipster.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'flipster', pbwp_frontend_asset_url( 'js/vendors/flipster/jquery.flipster.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        wp_register_style( 'swiper', pbwp_frontend_asset_url( 'css/vendors/swiper/swiper-bundle.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'swiper', pbwp_frontend_asset_url( 'js/vendors/swiper/swiper-bundle.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        wp_register_style( 'opensans', esc_url( PBWP_GOOGLE_FONTS_URL ).'=Open+Sans:wght@300;400;500;600&display=swap', [  ], PBWP_VERSION, 'all' );

        wp_register_style( 'fullcalendar', pbwp_frontend_asset_url( 'css/vendors/fullcalendar/main.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'fullcalendar-locales', pbwp_frontend_asset_url( 'js/vendors/fullcalendar/locales-all.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'fullcalendar', pbwp_frontend_asset_url( 'js/vendors/fullcalendar/main.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        wp_register_style( 'twentytwenty', pbwp_frontend_asset_url( 'css/vendors/twentytwenty/twentytwenty.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'eventmove', pbwp_frontend_asset_url( 'js/vendors/twentytwenty/jquery.event.move.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'twentytwenty', pbwp_frontend_asset_url( 'js/vendors/twentytwenty/jquery.twentytwenty.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        // All Lightboxs
        wp_register_style( 'lightcase', pbwp_frontend_asset_url( 'css/vendors/lightbox/lightcase/lightcase.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'lightcase', pbwp_frontend_asset_url( 'js/vendors/lightbox/lightcase/lightcase.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_style( 'prettyphoto', pbwp_frontend_asset_url( 'css/vendors/lightbox/prettyphoto/prettyPhoto.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'prettyphoto', pbwp_frontend_asset_url( 'js/vendors/lightbox/prettyphoto/jquery.prettyPhoto.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_style( 'photobox', pbwp_frontend_asset_url( 'css/vendors/lightbox/photobox/photobox.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'photobox', pbwp_frontend_asset_url( 'js/vendors/lightbox/photobox/jquery.photobox.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'basictable', pbwp_frontend_asset_url( 'js/vendors/basictable/jquery.basictable.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'chartjs', pbwp_frontend_asset_url( 'js/vendors/chartjs/Chart.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'youtube-iframe-api', esc_url( PBWP_YOUTUBE_API ), [  ], PBWP_VERSION, false );
        wp_register_style( 'youtubegallerywall', pbwp_frontend_asset_url( 'css/vendors/ytg/youtubegallerywall.min.css' ), [  ], PBWP_VERSION, 'all' );
        wp_register_script( 'youtubegallerywall', pbwp_frontend_asset_url( 'js/vendors/ytg/youtubegallerywall.min.js' ), [ 'jquery' ], PBWP_VERSION, false );
        wp_register_script( 'validate', pbwp_frontend_asset_url( 'js/vendors/validate/jquery.validate.min.js' ), [ 'jquery' ], PBWP_VERSION, false );

        // 3rdParty Scripts
        do_action( 'pbwp_frontend_enqueue_styles' );
        do_action( 'pbwp_frontend_enqueue_scripts', [ 'jquery' ] );

    }

}

add_action( 'wp_enqueue_scripts', 'pbwp_frontend_script' );

if ( ! function_exists( 'pbwp_frontend_head' ) ) {
    /**
     * Generate CSS to <head>
     *
     *
     * @since 1.0.0
     * string
     */
    function pbwp_frontend_head()
    {
    }

}

add_action( 'wp_head', 'pbwp_frontend_head', 999 );

if ( ! function_exists( 'pbwp_body_classes' ) ) {
    /**
     * Adding our Class to BODY
     *
     *
     * @since 1.0.0
     * @return array
     */
    function pbwp_body_classes( $classes )
    {

        if ( ! pbwp_is_on_post() ) {
            return $classes;
        }

        global $post;

        if ( isset( $post->ID ) && pbwp_get_global_options( $post->ID, 'is_wpc' ) == 'yes' && is_customize_preview() ) {
            $classes[  ] = 'wpc_disabled_on_this_page';
        }

        $classes[  ] = 'wp-composer-css';

        return $classes;

    }

}

add_filter( 'body_class', 'pbwp_body_classes' );

/**
 * Inline CSS Compressor
 *
 * @since 1.0
 */
function pbwp_css_compress( $minify )
{

    if ( empty( $minify ) || ! isset( $minify ) ) {
        return $minify;
    }

    if ( ! class_exists( 'pbwpcss' ) ) {
        include_once pbwp_manager()->path( 'GLOBAL_VENDOR_DIR', '/pbwpcss/class.pbwpcss.php' );
    }

    $pbwpcss = new pbwpcss();
    // Set some options :
    $pbwpcss->set_cfg( 'optimise_shorthands', 1 );
    $pbwpcss->set_cfg( 'template', apply_filters( 'pbwp_css_compress_level', 'highest' ) );
    // Parse the CSS to array
    $pbwpcss->parse( $minify );
    $css_code_opt = $pbwpcss->print;
    $custom_css   = $css_code_opt->css;
    // Remove all no value css property
    $minify = pbwp_array_filter_recursive( $custom_css );
    // Set css with the clean one
    $pbwpcss->css = $minify;
    // Set back to the optimized CSS Code
    $minify = $pbwpcss->print->plain();

    return $minify;

}

function pbwp_render_css()
{

    global $post;

    if ( ! isset( $post->ID ) ) {
        return;
    }

    $final_css            = '';
    $g_fonts              = [ 'fonts' => [  ] ];
    $icon_fonts           = [  ];
    $wpc_data             = pbwp_get_global_options( $post->ID, 'all' );
    $use_sticky           = $use_skrollr           = $use_video_bg           = false;
    $css_devices          = [ 'desktop', 'tablet', 'smartphone' ];
    $final_row_css        = $final_col_css        = $final_item_css        = [  ];
    $all_items_inline_css = [  ];

    if ( isset( $wpc_data[ 'builder' ] ) && count( $wpc_data[ 'builder' ] ) > 0 ) {

        if ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] ) && $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] == 'yes' ) {
            return;
        }

        foreach ( $css_devices as $device ) {

            foreach ( $wpc_data[ 'builder' ] as $key => $val ) {

                if ( isset( $val[ 'config' ][ 'row_disable' ] ) && $val[ 'config' ][ 'row_disable' ] == 'yes' ) {
                    continue;
                }

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

                $row_css = ( isset( $config[ 'css' ] ) ? $config[ 'css' ] : '' );

                if ( is_array( $row_css ) ) {

                    if ( is_array( $row_no_padding ) ) {
                        // Row No Padding
                        $row_css[ 'desktop' ][ $row_no_padding[ 0 ] ]    = $row_no_padding[ 1 ];
                        $row_css[ 'tablet' ][ $row_no_padding[ 0 ] ]     = $row_no_padding[ 1 ];
                        $row_css[ 'smartphone' ][ $row_no_padding[ 0 ] ] = $row_no_padding[ 1 ];
                    }

                    /* Here we implement the responsive mode for desktop, tablet and smartphone mode */
                    if ( array_key_exists( $device, $row_css ) && ! empty( $row_css[ $device ] ) ) {
                        /* Parse inline first */
                        $row_css = pbwp_generate_inline_css( $row_css[ $device ], $row_sel, true );
                        /* Store the css rules that has been parsed */
                        $final_row_css[ $device ][  ] = $row_css[ 'css' ];

                        if ( ! empty( $row_css[ 'fonts' ] ) ) {
                            $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $row_css[ 'fonts' ] );
                        }

                    }

                    if ( isset( $val[ 'config' ] ) && isset( $val[ 'config' ][ 'animate' ] ) ) {
                        pbwp_animation_creator( $val, true );
                    }

                }

                // Row video background & Parallax
                if ( isset( $config[ 'parallax' ] ) && $config[ 'parallax' ] == 'yes' && isset( $config[ 'img_id' ] ) && $config[ 'img_id' ] != '' ) {
                    $use_skrollr = true;
                }

                // Video Background
                if ( isset( $config[ 'videobg' ] ) && $config[ 'videobg' ] == 'yes' && isset( $config[ 'videobgurl' ] ) && $config[ 'videobgurl' ] != '' ) {
                    $use_video_bg = true;
                }

                // Sticky Mode
                if ( isset( $config[ 'use_sticky' ] ) && $config[ 'use_sticky' ] == 'yes' ) {
                    $use_sticky = true;
                }

                foreach ( $val[ 'row_cols' ] as $ky => $vl ) {

                    $colCfg  = ( isset( $vl[ 'config' ] ) ? $vl[ 'config' ] : [  ] );
                    $col_sel = '.wpc_col[id="'.$vl[ 'id' ].'"]';
                    // Set the column size
                    $colSize = explode( '-', ( isset( $col_mode[ $ky ] ) ? $col_mode[ $ky ] : '1-1' ) );
                    $colSize = ( isset( $colSize[ 0 ] ) ? (int) $colSize[ 0 ] : 1 ) / ( isset( $colSize[ 1 ] ) ? (int) $colSize[ 1 ] : 1 );
                    $colSize = $colSize > 0 ? $colSize * 100 : 100;

                    $col_css = ( isset( $colCfg[ 'css' ] ) ? $colCfg[ 'css' ] : [  ] );
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
                        // Column CSS width via CSS ( Stylings Mode ) ( Priority 1 )
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
                    if ( array_key_exists( $device, $col_css ) && ! empty( $col_css[ $device ] ) ) {
                        /* Parse inline first */
                        $temptCSS = pbwp_generate_inline_css( $col_css[ $device ], $col_sel, true );
                        /* Store the css rules that has been parsed */
                        $final_col_css[ $device ][  ] = $temptCSS[ 'css' ];

                        if ( ! empty( $temptCSS[ 'fonts' ] ) ) {
                            $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $temptCSS[ 'fonts' ] );
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

                    if ( isset( $vl[ 'config' ] ) && isset( $vl[ 'config' ][ 'animate' ] ) ) {
                        pbwp_animation_creator( $vl, true );
                    }

                    foreach ( $vl[ 'items' ] as $k => $v ) {

                        // Need to fix corrupted item caused by order that failed
                        if ( ! isset( $v[ 'type' ] ) ) {
                            pbwp_fix_missing_items( $post->ID, $key, $ky, $k );
                            continue;
                        }

                        $itemtype = strtolower( $v[ 'type' ] );

                        // Check Animation
                        if ( isset( $v[ 'config' ][ 'animate' ] ) ) {
                            pbwp_animation_creator( $v, true );
                        }

                        // Check icons
                        if ( isset( $v[ 'config' ][ 'general' ] ) ) {

                            // check for icon in Pricing Table item type
                            if ( $itemtype == 'typepricing' && is_array( $v[ 'config' ][ 'general' ] ) ) {

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

                            if ( isset( $v[ 'config' ][ 'general' ] ) && is_array( $v[ 'config' ][ 'general' ] ) && array_key_exists( 'icon', $v[ 'config' ][ 'general' ] ) ) {
                                $icon_fonts[  ] = $v[ 'config' ][ 'general' ][ 'icon' ];
                            }

                            if ( is_array( $v[ 'config' ][ 'general' ] ) && array_key_exists( 'featured_icon', $v[ 'config' ][ 'general' ] ) ) {
                                $icon_fonts[  ] = $v[ 'config' ][ 'general' ][ 'featured_icon' ];
                            }

                        }

                        $css = ( isset( $v[ 'config' ][ 'css' ] ) ? $v[ 'config' ][ 'css' ] : '' );

                        if ( is_array( $css ) ) {
                            /* Here we implement the responsive mode for desktop, tablet and smartphone mode */
                            if ( array_key_exists( $device, $css ) && ! empty( $css[ $device ] ) ) {
                                /* Parse inline first */
                                $css = pbwp_generate_inline_css( $css[ $device ], '.wpc_item_'.$v[ 'id' ] );
                                /* Store the css rules that has been parsed */
                                $final_item_css[ $device ][  ] = $css[ 'css' ];

                                if ( ! empty( $css[ 'fonts' ] ) ) {
                                    $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $css[ 'fonts' ] );
                                }
                                /* Generate inline css */
                                if ( $v[ 'type' ] === 'typeList' || $v[ 'type' ] === 'typeMaps' || $v[ 'type' ] === 'typePricing' || $v[ 'type' ] === 'typeTimeline' ) {
                                    $all_items_inline_css[  ] = pbwp_item_inline_css( $v );
                                }

                            }

                        }

                    }

                }

            }

        }

        // Sticky
        if ( $use_sticky ) {
            pbwp_load_sticky_js();
        }

        // Parallax
        if ( $use_skrollr ) {
            pbwp_load_skrollr_js();
        }

        // video background
        if ( $use_video_bg ) {
            pbwp_load_youtube_iframe_api_js();
        }

        // enqueue Google fonts
        if ( ! empty( $g_fonts[ 'fonts' ] ) ) {
            pbwp_load_google_fonts( $g_fonts[ 'fonts' ] );
        }

        // enqueue icon fonts
        if ( ! empty( $icon_fonts ) ) {
            pbwp_load_icon_library( $icon_fonts );
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

        // Render Global Custom CSS if defined
        if ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] ) && $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] ) {
            $final_css .= base64_decode( $wpc_data[ 'global' ][ 'config' ][ 'global_css' ] );
        }

        // Append item inline css into final css
        $final_css = $final_css.implode( '', $all_items_inline_css );

        // Sanitize the output
        $allowed_tags = wp_kses_allowed_html( 'post' );
        $inline_css   = wp_kses( stripslashes_deep( pbwp_css_compress( $final_css ) ), $allowed_tags );
        wp_add_inline_style( 'pbwpstyle', htmlspecialchars_decode( $inline_css, ENT_QUOTES ) );

    }

}

add_action( 'wp_enqueue_scripts', 'pbwp_render_css', 999 );

function pbwp_load_sticky_js()
{

    wp_enqueue_script( 'stickystack' );

}

function pbwp_load_skrollr_js()
{

    wp_enqueue_script( 'skrollr' );

}

function pbwp_load_youtube_iframe_api_js()
{

    wp_enqueue_script( 'youtube-iframe-api' );

}

function pbwp_generate_inline_css( $css, $selector, $bodyClass = false, $isFront = false )
{
    // All css properties that need to mark as !important
    $mark_as_important = apply_filters( 'pbwp_inline_css_mark_important', [ 'color', 'overflow', 'font-size', 'border-right-color', 'border-left-color' ] );
    $exception_keys    = apply_filters( 'pbwp_inline_css_exception_keys', [ 'map_styles', 'chart_item_border', 'chart_y_axist_col', 'chart_x_axist_col', 'chart_grid_line_col', 'use-add-property' ] );
    $bg_props          = [ 'background-image', 'background-repeat', 'background-position', 'background-attachment', 'background-size' ];
    $supported_units   = apply_filters( 'pbwp_inline_css_supported_units', [ 'px', '%', 'em', 'vm', 'rem' ] );
    $frontClass        = '';
    $bodyClass         = $bodyClass ? 'body.wp-composer-css ' : '';
    // Sanitize
    $selector = esc_attr( $selector );

    ob_start();

    if ( ! $isFront && is_customize_preview() ) {
        $frontClass = '.wpc_unmodified';
    }

    $google_fonts = $new = [  ];

    foreach ( $css as $key => $val ) {

        $key = apply_filters( 'pbwp_elements_css_selector', $key );

        $parts = explode( '|', $key );

        if ( ! isset( $parts[ 1 ] ) ) {
            continue;
        }

        if ( ! isset( $new[ $parts[ 0 ] ] ) ) {
            $new[ $parts[ 0 ] ] = [  ];
        }

        $new[ $parts[ 0 ] ][ $parts[ 1 ] ] = $val;

    }

    foreach ( $new as $key => $subarray ) {

        $bg_img_clue = $has_bg = false;

        $selectorFrontClass = $frontClass.$selector;

        $key = apply_filters( 'pbwp_elements_css_selector_before_parsing', $key );

        // For double class ( selector ) on same field
        if ( strpos( $key, '.includethis.' ) !== false ) {
            $key = str_replace( '.includethis.', $selectorFrontClass, $key );
        }

        if ( strpos( $key, '.self.' ) !== false ) {
            $key = str_replace( '.self.', $selectorFrontClass, $key );
        }

        if ( strpos( $key, '.addclass.' ) !== false ) {
            $key = str_replace( '.addclass.', $selectorFrontClass, $key );
        }

        $key = apply_filters( 'pbwp_elements_css_selector_after_parsing', $key, $selectorFrontClass );

        $finalSelector = $selectorFrontClass.' ';

        if ( strpos( $key, ',' ) === false && strpos( $key, $selectorFrontClass ) !== false ) {
            $finalSelector = '';
        }

        $key = esc_attr( $key );

        echo esc_attr( $bodyClass.$finalSelector.$key."{\n" );

        foreach ( $subarray as $key2 => $val ) {
            // enqueue Google Fonts
            if ( $key2 == 'font-family' && $val != '' ) {
                $google_fonts[  ] = rawurlencode( $val );
            }

            /* Exceptions ( Custom )------------------------------------------------------------------------------------- */
            if ( in_array( $key2, $exception_keys ) ) {
                continue;
            }

            // On / Off for using feature
            if ( $key2 == 'bg_control_only' ) {
                if ( $val == 'yes' ) {
                    $bg_img_clue = true;
                }

                continue;
            }

            // Skip when value only unit
            if ( in_array( $val, $supported_units ) ) {
                continue;
            }

            // Adding !important to override the current CSS style in frontend editor
            if ( in_array( $key2, $mark_as_important ) && $val != '' ) {
                $val = $val.' !important';
            }

            // Custom Background Image
            if ( $bg_img_clue ) {

                if ( $key2 == 'background-image' ) {
                    if ( $val != '' ) {
                        $bg     = pbwp_get_attachment_image_src( $val, 'full' );
                        $val    = 'url('.esc_url( $bg[ 'url' ] ).')';
                        $has_bg = true;
                    } else {
                        continue;
                    }

                }

                if ( ! $has_bg && in_array( $key2, $bg_props ) ) {
                    $bg_img_clue = false;
                    continue;
                }

            } else {

                if ( in_array( $key2, $bg_props ) ) {
                    continue;
                }

            }

            // Replace inherit to 0
            if ( $key2 == 'margin' || $key2 == 'padding' || $key2 == 'border-radius' ) {
                $val = str_replace( 'inherit', '0', $val );
            }

            // Add !important for 0px padding to avoid conflict with NO PADDING feature in row and column
            if ( ( $key2 == 'padding' || $key2 == 'margin' ) && $val ) {
                $val = $val.' !important';
            }

            // For border
            if ( $key2 == 'border' ) {

                $border    = '';
                $bordr     = explode( '|', $val );
                $bor_pos   = explode( ' ', $bordr[ 0 ] );
                $bor_param = [ 'border-top:', 'border-right:', 'border-bottom:', 'border-left:' ];

                if ( isset( $bordr[ 1 ] ) && $bordr[ 1 ] == 'none' ) {

                    echo 'border: none;'.";\n";

                } else {

                    foreach ( $bor_pos as $posKey => $pos ) {
                        if ( $pos ) {
                            $border .= $bor_param[ $posKey ].''.$pos.';';
                        }

                    }

                    if ( isset( $bordr[ 1 ] ) ) {
                        $border .= 'border-style:'.$bordr[ 1 ].';';
                    }

                    if ( isset( $bordr[ 2 ] ) ) {
                        $border .= 'border-color:'.$bordr[ 2 ].';';
                    }

                }

                echo esc_attr( $border )."\n";

                continue;

            }

            // For color gradient
            if ( $key2 == 'color-gradient' ) {
                continue;
            }

            // All excluding the above exceptions
            echo esc_attr( $key2 ).':'.esc_attr( $val ).";\n";

        }

        echo "}\n";

    }

    $class = ob_get_clean();

    return $class = [ 'css' => $class, 'fonts' => $google_fonts ];

}

function pbwp_css_break_and_modify( $css, $addSelector = '', $isDecode = false )
{

    if ( $css ) {
        $css = ( $isDecode ? base64_decode( $css ) : $css );
    }

    if ( ! class_exists( 'pbwpcss' ) ) {
        include_once pbwp_manager()->path( 'GLOBAL_VENDOR_DIR', '/pbwpcss/class.pbwpcss.php' );
    }

    $pbwpcss = new pbwpcss();

    // Set some options :
    $pbwpcss->set_cfg( 'optimise_shorthands', 1 );
    $pbwpcss->set_cfg( 'template', 'high' );

    // Parse the CSS
    $pbwpcss->parse( $css );

    // Get back the optimized CSS Code
    $css_code_opt = $pbwpcss->print;
    $custom_css   = $css_code_opt->css;

    $final_css = '';

    foreach ( $custom_css as $isMediaQuery => $eachSelector ) {

        if ( is_string( $isMediaQuery ) ) {
            $final_css .= $isMediaQuery.'{';
        }

        // Add Row / Col unique selector here
        foreach ( $eachSelector as $eachRules => $rules ) {

            $final_css .= $addSelector.' '.$eachRules.'{';

            foreach ( $rules as $eachProperty => $value ) {

                $final_css .= $eachProperty.': '.$value.';';

            }

            $final_css .= '}';

        }

        if ( is_string( $isMediaQuery ) ) {
            $final_css .= '}';
        }

    }

    return $final_css;

}

function pbwp_load_google_fonts( $fonts, $returnURL = false )
{

    $user_fonts = pbwp_front_get_option( 'user_fonts' );
    $uri        = 'https://fonts.googleapis.com/css?family=';
    $used_fonts = $returnFonts = [  ];

    if ( empty( $fonts ) ) {
        return;
    }

    if ( ! is_array( $user_fonts ) || count( $user_fonts ) === 0 ) {
        return;
    }

    foreach ( $fonts as $val ) {

        if ( isset( $user_fonts[ $val ] ) ) {
            $used_fonts[ $val ] = $user_fonts[ $val ];
        }

    }

    foreach ( $used_fonts as $family => $cfg ) {

        $params = urldecode( $family );
        $params = str_replace( ' ', '+', $params );

        if ( isset( $cfg[ 3 ] ) ) {
            $params .= ':'.$cfg[ 3 ];
        } else {
            $params .= ':'.$cfg[ 1 ];
        }

        if ( isset( $cfg[ 2 ] ) ) {
            $params .= '&subset='.$cfg[ 2 ];
        } else {
            $params .= '&subset='.$cfg[ 0 ];
        }

        $unique = strtolower( str_replace( ' ', '-', urldecode( $family ) ) );

        $final_font_url = PBWP_Fonts_Manager::set_local( $uri.$params );

        if ( $returnURL ) {
            $returnFonts[  ] = [ 'name' => $unique, 'path' => $final_font_url, 'type' => 'link', 'direct' => true ];
        } else {
            wp_enqueue_style( $unique, $final_font_url, false, PBWP_VERSION );
        }

    }

    if ( $returnURL && is_array( $returnFonts ) ) {
        $returnFonts = array_intersect_key( $returnFonts, array_unique( array_map( 'serialize', $returnFonts ) ) );

        return $returnFonts;
    }

}

function pbwp_load_icon_library( $icons, $returnURL = false )
{

    $fontIconsList = [ 'icomoon-' => 'icomoon', 'icon-' => 'fontello', 'oi oi-' => 'openiconic', 'fa fa-' => 'fontawesome', 'material-icons' => 'materialicons', 'jv-' => 'justvector', 'pf pf-' => 'paymentfont', 'dashicons' => 'dashicons' ];
    $fontIconsPath = [
        'icomoon'       => 'css/iconfonts/icomoon/icomoon.css',
        'fontello'      => 'css/iconfonts/fontello/css/fontello.css',
        'openiconic'    => 'css/iconfonts/openiconic/css/open-iconic-bootstrap.min.css',
        'fontawesome'   => 'css/iconfonts/fontawesome/font-awesome.min.css',
        'materialicons' => 'css/iconfonts/gmi/gmi.css',
        'justvector'    => 'css/iconfonts/justvector/stylesheets/justvector.css',
        'paymentfont'   => 'css/iconfonts/paymentfont/css/paymentfont.min.css',
        'dashicons'     => includes_url( '/css/dashicons.min.css' ) ];
    $returnIcons = [  ];

    foreach ( $icons as $iconClass ) {

        foreach ( $fontIconsList as $fontKeys => $handleName ) {

            if ( strpos( $iconClass, $fontKeys ) !== false ) {

                if ( $returnURL ) {
                    $returnIcons[  ] = [ 'name' => $handleName, 'path' => $fontIconsPath[ $handleName ], 'type' => 'link', 'direct' => ( $handleName == 'dashicons' ? true : false ) ];
                } else {
                    wp_enqueue_style( $handleName );
                }

            }

        }

    }

    if ( $returnURL && is_array( $returnIcons ) ) {
        $returnIcons = array_intersect_key( $returnIcons, array_unique( array_map( 'serialize', $returnIcons ) ) );

        return $returnIcons;
    }

}

function pbwp_set_full_width( $template )
{

    global $post;

    if ( ! isset( $post->ID ) ) {
        return $template;
    }

    $wpc_data   = pbwp_get_global_options( $post->ID, 'all' );
    $wpc_global = ( isset( $wpc_data[ 'global' ] ) ? $wpc_data[ 'global' ][ 'config' ] : [  ] );
    $isNotEmpty = ( isset( $wpc_data[ 'builder' ] ) && count( $wpc_data[ 'builder' ] ) >= 1 ? true : false );

    // Just return if full-width / WP Composer option on disabled mode
    if ( ! isset( $wpc_global[ 'global_disable_wpc' ] ) || ! isset( $wpc_global[ 'global_fullwidth' ] ) ) {
        return $template;
    }

    if ( $wpc_global[ 'global_disable_wpc' ] == 'yes' ) {
        return $template;
    }

    if ( $wpc_global[ 'global_fullwidth' ] != 'yes' ) {
        return $template;
    }

    if ( ! $isNotEmpty ) {
        return $template;
    }

    // If it is nont a single post/page/post-type, don't apply the template from the plugin.
    if ( ! is_singular() ) {
        return $template;
    }

    $template = PBWP_PATH.'/inc/frontend/templates/wpc-full-width.php';

    // Just to be safe, we check if the file exist first
    if ( file_exists( $template ) ) {
        return $template;
    }

}

add_filter( 'template_include', 'pbwp_set_full_width', 99 );

function pbwp_get_global_options( $id, $opt )
{

    $val = '';

    $wpc_data = base64_decode( get_post_meta( $id, 'wp_composer', true ) );
    $wpc_data = json_decode( $wpc_data, true );

    if ( ! is_array( $wpc_data ) ) {
        $wpc_data = [  ];
    }

    if ( isset( $wpc_data ) && $opt == 'all' ) {

        $val = $wpc_data;

    }

    if ( isset( $wpc_data ) && isset( $wpc_data[ 'builder' ] ) ) {

        if ( $opt == 'builder' ) {
            $val = $wpc_data[ 'builder' ];
        }

    }

    if ( isset( $wpc_data ) && isset( $wpc_data[ 'global' ] ) ) {

        if ( $opt == 'global' ) {
            $val = $wpc_data[ 'global' ][ 'config' ];
        }

        if ( $opt == 'is_wpc' ) {
            $val = ( isset( $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] ) ? $wpc_data[ 'global' ][ 'config' ][ 'global_disable_wpc' ] : 'no' );
        }

        if ( $opt == 'is_fullwidth' ) {
            $val = $wpc_data[ 'global' ][ 'config' ][ 'global_fullwidth' ];
        }

    }

    return $val;

}

function pbwp_get_item_data_by_id( $postID, $itemID )
{

    $data = pbwp_get_global_options( $postID, 'builder' );

    $search_path = pbwp_search_by_id( $itemID, $data, [  ] );

    if ( empty( $search_path ) ) {
        return [  ];
    }

    array_pop( $search_path );

    foreach ( $search_path as $key => $value ) {

        $data = $data[ $value ];

    }

    return $data;

}

function pbwp_get_item_config_by_id( $postID, $itemID )
{

    $configData = pbwp_get_item_data_by_id( $postID, $itemID );

    return ( $configData[ 'config' ] === null ? [  ] : $configData[ 'config' ] );

}

function pbwp_search_by_id( $search_value, $array, $id_path )
{

    if ( is_array( $array ) && count( $array ) > 0 ) {

        $temp_path = [  ];

        foreach ( $array as $key => $value ) {

            $temp_path = $id_path;
            // Adding current key to search path
            array_push( $temp_path, $key );

            if ( is_array( $value ) && count( $value ) > 0 ) {
                $res_path = pbwp_search_by_id(
                    $search_value, $value, $temp_path );

                if ( $res_path != null ) {
                    return $res_path;
                }

            } else

            if ( $value == $search_value ) {
                return $temp_path;
            }

        }

    }

    return null;

}

function pbwp_fix_missing_items( $postID, $rowIdx, $colIdx, $itemIdx )
{
    /* Get maindata */
    $mainData = pbwp_get_global_options( $postID, 'all' );

    /* Modify */
    if ( ! isset( $mainData[ 'builder' ][ $rowIdx ][ 'row_cols' ][ $colIdx ][ 'items' ][ $itemIdx ] ) || $mainData[ 'builder' ][ $rowIdx ][ 'row_cols' ][ $colIdx ][ 'items' ][ $itemIdx ] === null ) {
        unset( $mainData[ 'builder' ][ $rowIdx ][ 'row_cols' ][ $colIdx ][ 'items' ][ $itemIdx ] );
    }

    /* Sanitize data */
    $sanitized = pbwp_data_sanitation( $mainData, false );
    /* Update data */
    delete_post_meta( $postID, 'wp_composer' );
    add_post_meta( $postID, 'wp_composer', $sanitized, true );

    return;

}

function pbwp_is_disabled()
{

    $wpc_stt = get_option( 'pbwp_globals' );

    if ( isset( $wpc_stt[ 'stt_general' ] ) && isset( $wpc_stt[ 'stt_general' ][ 'disable_plugin' ] ) && $wpc_stt[ 'stt_general' ][ 'disable_plugin' ] === 'active' ) {
        return true;
    }

    return false;

}

function pbwp_is_maintenance()
{

    $wpc_stt = get_option( 'pbwp_globals' );

    if ( isset( $wpc_stt[ 'stt_general' ] ) && isset( $wpc_stt[ 'stt_general' ][ 'wpc_maintenance' ] ) && $wpc_stt[ 'stt_general' ][ 'wpc_maintenance' ] === 'active' ) {
        return true;
    }

    return false;

}

function pbwp_is_has_row( $id )
{

    $bldr = pbwp_get_global_options( $id, 'builder' );

    if ( $bldr == '' || count( $bldr ) <= 0 ) {
        return false;
    }

    return true;

}

function pbwp_is_on_post( $onlyBuilder = false )
{

    global $post;

    if ( ! isset( $post->ID ) ) {
        return false;
    }

    $wpc_data = pbwp_get_global_options( $post->ID, 'all' );

    if ( $onlyBuilder ) {

        if ( isset( $wpc_data[ 'builder' ] ) && count( $wpc_data[ 'builder' ] ) > 0 ) {
            return true;
        }

    } else {

        if ( isset( $wpc_data ) ) {
            return true;
        }

    }

    return false;

}

function pbwp_create_icon_markup( $class = '', $addClass = '', $size = '' )
{

    $icon_title = $custom_size = '';

    if ( $class == '' ) {
        return;
    }

    if ( strpos( $class, 'material-icons' ) !== false ) {
        $split      = explode( ' ', $class );
        $icon_title = $split[ 1 ];
    }

    if ( $size ) {
        $custom_size = 'style="height: '.esc_attr( $size ).'; width: '.esc_attr( $size ).';" ';
    }

    return '<i '.$custom_size.'class="'.esc_attr( $class ).' '.esc_attr( $addClass ).'">'.esc_html( $icon_title ).'</i>';

}

function pbwp_create_social_icon_markup( $socials = [  ] )
{

    $socialMarkup = '';

    foreach ( $socials as $key => $val ) {

        $socialMarkup .= '<li><a href="'.esc_url( $val[ 'link' ] ).'" target="_blank"><i class="wpc_ftr_social_icon wpc-i-'.esc_attr( $val[ 'icon' ] ).'"></i></a></li>';

    }

    return $socialMarkup;

}

function pbwp_set_css_breakpoints( $device, $return = false )
{

    $devicesSpt        = [ 'desktopDISABLED', 'tablet', 'smartphone' ];
    $breakpoint_markup = '';

    /* Prevent wrong devices */
    if ( ! in_array( $device, $devicesSpt ) ) {
        return '';
    }

    $devices = pbwp_generate_css_breakpoints();

    foreach ( $devices[ $device ] as $rules => $res ) {

        $breakpoint_markup = '@media';
        $i                 = 0;

        foreach ( $res as $key => $each ) {

            $breakpoint_markup .= '('.$key.': '.$each.')';

            if ( count( $res ) == 2 && $i == 0 ) {
                $breakpoint_markup .= ' and ';
            }

            $i++;
        }

        $breakpoint_markup .= '{';

    }

    if ( $return ) {
        return $breakpoint_markup;
    }

    echo wp_kses_post( $breakpoint_markup );

}

function pbwp_generate_css_breakpoints()
{

    $devices = [
        'desktop'    => [
            'rules' => [
                'min-width' => '1200px',
             ],
         ],
        'tablet'     => [
            'rules' => [
                'min-width' => '720px',
                'max-width' => '1080px',
             ],
         ],
        'smartphone' => [
            'rules' => [
                'min-width' => '320px',
                'max-width' => '500px',
             ],
         ],
     ];

    return apply_filters( 'pbwp_css_devices_breakpoints', $devices );

}

function pbwp_get_item_options( $data = [  ], $optionKey = '', $default = '', $decode = false, $customKey = '', $htmlMode = false, $use_kses = false, $fixP = false )
{

    $item_config = '';
    $type        = apply_filters( 'pbwp_default_item_options_base', 'general' );

    if ( $customKey ) {

        if ( ! isset( $data[ $customKey ] ) ) {
            return esc_html( $default );
        }

        $item_config = $data[ $customKey ];

        return ( isset( $item_config ) && $item_config != '' ? ( $decode ? pbwp_base64_decode( $item_config ) : $item_config ) : $default );

    }

    if ( ! isset( $data[ 'config' ] ) || ( isset( $data[ 'config' ] ) && ! is_array( $data[ 'config' ] ) ) ) {
        return esc_html( $default );
    }

    if ( ! isset( $data[ 'config' ][ $type ] ) ) {
        return esc_html( $default );
    }

    $item_config = $data[ 'config' ];

    if ( isset( $item_config[ $type ][ $optionKey ] ) && $item_config[ $type ][ $optionKey ] != '' ) {
        if ( $decode ) {
            $value = pbwp_base64_decode( $item_config[ $type ][ $optionKey ] );
        } else {
            $value = $item_config[ $type ][ $optionKey ];
        }
    } else {
        $value = $default;
    }

    if ( $htmlMode || $use_kses ) {
        $value = $value;
    } else {
        $value = esc_html( $value );
    }

    if ( $use_kses ) {
        $value = wp_kses( $value, pbwp_wp_kses_allowed_html() );
    }

    if ( $fixP && $value !== '' ) {
        $value = pbwp_remove_br_empty_p( $value );
    }

    return $value;

}

function pbwp_get_texteditor_content( $data, $key, $default = '' )
{

    $content = pbwp_get_item_options( $data, $key, $default, true, '', true, true );

    return $content;

}

function pbwp_wp_version_compare( $compareTo )
{

    if ( version_compare( get_bloginfo( 'version' ), $compareTo, '>=' ) ) {
        return true;
    } else {
        return false;
    }

}

function pbwp_curl( $url )
{

    $response = wp_remote_get( $url );

    // Check for errors
    if ( is_wp_error( $response ) ) {
        return false;
    }

    // Get the response body
    $body = wp_remote_retrieve_body( $response );

    // Decode JSON if needed

    return json_decode( $body );

}

function pbwp_number_format( $num, $dec = 3 )
{

    $num = number_format( $num, apply_filters( 'pbwp_number_format', $dec ) );

    return $num;

}

function pbwp_array_filter_key( $input, $callback )
{

    if ( ! is_array( $input ) ) {
        trigger_error( 'array_filter_key() expects parameter 1 to be array, '.esc_html( gettype( $input ) ).' given', E_USER_WARNING );

        return null;
    }

    if ( empty( $input ) ) {
        return $input;
    }

    $filteredKeys = array_filter( array_keys( $input ), $callback );

    if ( empty( $filteredKeys ) ) {
        return [  ];
    }

    $input = array_intersect_key( array_flip( $filteredKeys ), $input );

    return $input;

}

/* Make any HEX color lighter or darker
---------------------------------------------------------- */
/**
 * @param $colour
 * @param $to
 *
 * @return string
 */
function pbwp_colorMaker( $colour, $to = 10 )
{

    if ( ! class_exists( 'PBWP_Color_Helper' ) ) {
        require_once pbwp_manager()->path( 'GLOBAL_VENDOR_DIR', '/phpcolors/Class.Color.php' );
    }

    $color = $colour;

    if ( stripos( $colour, 'rgba(' ) !== false ) {

        $rgb       = str_replace( [ 'rgba', 'rgb', '(', ')' ], '', $colour );
        $rgb       = explode( ',', $rgb );
        $rgb_array = [ 'R' => $rgb[ 0 ], 'G' => $rgb[ 1 ], 'B' => $rgb[ 2 ] ];
        $alpha     = $rgb[ 3 ];

        try {

            $color     = PBWP_Color_Helper::rgbToHex( $rgb_array );
            $color_obj = new PBWP_Color_Helper( $color );
            if ( $to >= 0 ) {
                $color = $color_obj->lighten( $to );
            } else {
                $color = $color_obj->darken( abs( $to ) );
            }

            $rgba           = $color_obj->hexToRgb( $color );
            $rgba[  ]       = $alpha;
            $css_rgba_color = 'rgba('.implode( ', ', $rgba ).')';

            return $css_rgba_color;

        } catch ( Exception $e ) {
            // In case of error return same as given
            return $colour;

        }

    } else

    if ( stripos( $colour, 'rgb(' ) !== false ) {

        $rgb       = str_replace( [ 'rgba', 'rgb', '(', ')' ], '', $colour );
        $rgb       = explode( ',', $rgb );
        $rgb_array = [ 'R' => $rgb[ 0 ], 'G' => $rgb[ 1 ], 'B' => $rgb[ 2 ] ];

        try {

            $color = PBWP_Color_Helper::rgbToHex( $rgb_array );

        } catch ( Exception $e ) {
            // In case of error return same as given
            return $colour;

        }

    }

    try {

        $color_obj = new PBWP_Color_Helper( $color );

        if ( $to >= 0 ) {
            $color = $color_obj->lighten( $to );
        } else {
            $color = $color_obj->darken( abs( $to ) );
        }

        return '#'.$color;

    } catch ( Exception $e ) {

        return $colour;

    }

}

function pbwp_change_rgba_opacity( $color, $opacity = '0.2' )
{

    $color   = str_replace( ' ', '', $color );
    $col_num = '';

    if ( preg_match( '#\((.*?)\)#', $color, $matches ) ) {

        $col_num = $matches[ 1 ];
        $col_num = explode( ',', $col_num );

        if ( isset( $col_num[ 3 ] ) ) {
            $col_num[ 3 ] = $opacity;
        } else {
            $col_num[  ] = $opacity;
        }

        return 'rgba('.implode( ',', $col_num ).')';

    }

    return $color;

}

function pbwp_is_tab_child( $data )
{

    if ( isset( $data[ 'childOf' ] ) ) {

        return ' data-parent_id="'.esc_attr( $data[ 'childOf' ] ).'" style="visibility:hidden"';

    } else {

        return '';

    }

}

function pbwp_visibility_breakpoint( $data )
{

    $config = ( isset( $data[ 'config' ] ) ? $data[ 'config' ] : [  ] );

    if ( isset( $config[ 'advanced' ] ) && isset( $config[ 'advanced' ][ 'visibility_breakpoint' ] ) && $config[ 'advanced' ][ 'visibility_breakpoint' ] && ! is_customize_preview() ) {

        return ' wpc_visible_'.$config[ 'advanced' ][ 'visibility_breakpoint' ];

    }

    return '';

}

function pbwp_visibility_breakpoint_status( $config )
{

    $status = true;

    if ( isset( $config[ 'advanced' ] ) && isset( $config[ 'advanced' ][ 'visibility_display' ] ) && $config[ 'advanced' ][ 'visibility_display' ] && ! is_customize_preview() ) {

        if ( $config[ 'advanced' ][ 'visibility_display' ] === 'never' ) {
            $status = false;
        }

        if ( $config[ 'advanced' ][ 'visibility_display' ] === 'logged_in' && ! is_user_logged_in() ) {
            $status = false;
        }

        if ( $config[ 'advanced' ][ 'visibility_display' ] === 'logged_out' && is_user_logged_in() ) {
            $status = false;
        }

    }

    return $status;

}

function pbwp_get_app_inline_css( $data, $css = '', $itemType = false )
{

    $css = pbwp_get_position_app( $data, $css );
    $css = pbwp_get_transform_app( $data, $css );
    $css = pbwp_get_filters_app( $data, $css );
    $css = pbwp_get_boxshadow_app( $data, $css, $itemType );

    return $css;

}

function pbwp_get_boxshadow_app( $data, $css, $itemType )
{

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) && isset( $data[ 'config' ][ 'advanced' ][ 'app_boxshadow_data' ] ) ) {

        try {

            $boxshadowData = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ 'app_boxshadow_data' ], true ) );

            if ( is_object( $boxshadowData ) && isset( $boxshadowData->css ) && $boxshadowData->css ) {

                $selector = '';

                if ( $itemType ) {
                    $customSelector = pbwp_app_custom_selector();

                    if ( array_key_exists( strtolower( $itemType ), $customSelector ) ) {
                        $selector = ' '.$customSelector[ strtolower( $itemType ) ];
                    }

                }

                if ( isset( $boxshadowData->onHover ) && $boxshadowData->onHover ) {
                    $css[ 'desktop' ][ '.addclass..wpc__app_boxshadow'.esc_html( $selector ).'|transition' ] = 'box-shadow 0.3s';
                    $selector                                                                                  = $selector.':hover';
                }

                $css[ 'desktop' ][ '.addclass..wpc__app_boxshadow'.esc_html( $selector ).'|box-shadow' ]         = $boxshadowData->css;
                $css[ 'desktop' ][ '.addclass..wpc__app_boxshadow'.esc_html( $selector ).'|-webkit-box-shadow' ] = $boxshadowData->css;
                $css[ 'desktop' ][ '.addclass..wpc__app_boxshadow'.esc_html( $selector ).'|-moz-box-shadow' ]    = $boxshadowData->css;

            }

        } catch ( Exception $e ) {

            return $css;

        }

    }

    return $css;

}

function pbwp_get_filters_app( $data, $css )
{

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) && isset( $data[ 'config' ][ 'advanced' ][ 'app_filters_data' ] ) ) {

        try {

            $filtersData = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ 'app_filters_data' ], true ) );

            if ( is_object( $filtersData ) ) {

                if ( isset( $filtersData->css ) && $filtersData->css ) {
                    $css[ 'desktop' ][ '.addclass..wpc__app_filters|filter' ] = $filtersData->css;
                }

            }

        } catch ( Exception $e ) {

            return $css;

        }

    }

    return $css;

}

function pbwp_get_position_app( $data, $css )
{

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) && isset( $data[ 'config' ][ 'advanced' ][ 'app_position_data' ] ) ) {

        try {

            $positionData = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ 'app_position_data' ], true ) );

            if ( is_object( $positionData ) && ( isset( $positionData->positionMode ) && $positionData->positionMode !== 'default' ) ) {

                foreach ( $positionData as $subKey => $each ) {

                    if ( $subKey === 'css' && is_object( $each ) ) {

                        foreach ( $each as $cssKey => $cssValue ) {
                            $css[ 'desktop' ][ '.addclass..wpc__app_position|'.$cssKey ] = $cssValue;
                        }

                    }

                }

            }

        } catch ( Exception $e ) {

            return $css;

        }

    }

    return $css;

}

function pbwp_get_scroll_effects_app( $data )
{

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) && isset( $data[ 'config' ][ 'advanced' ][ 'app_scrolleffects_data' ] ) ) {

        try {

            $scrollFxData     = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ 'app_scrolleffects_data' ], true ) );
            $state            = false;
            $effects          = [  ];
            $transformAppData = pbwp_get_transform_app( $data, '', true );

            if ( is_object( $scrollFxData ) ) {

                foreach ( $scrollFxData as $each ) {

                    if ( isset( $each->data ) && isset( $each->data->state ) && $each->data->state === 'on' ) {
                        $effects[  ] = $each;
                    }

                }

                if ( ! empty( $effects ) ) {
                    return [ 'data' => $effects, 'config' => [ 'triggerAt' => $data[ 'config' ][ 'advanced' ][ 'scroll_effects_trigger' ] ], 'transformAppData' => $transformAppData ? $transformAppData : false ];
                }

                return $state;

            }

        } catch ( Exception $e ) {

            return false;

        }

    }

    return false;

}

function pbwp_get_transform_app( $data, $css = '', $cssOnly = false )
{

    if ( ! $cssOnly ) {
        if ( pbwp_get_scroll_effects_app( $data ) ) {
            return $css;
        }
    }

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) && isset( $data[ 'config' ][ 'advanced' ][ 'app_transform_data' ] ) ) {

        try {

            $defaultConfig = pbwp_get_transform_default_config();
            $transformData = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ 'app_transform_data' ], true ) );
            $transforms    = [  ];

            if ( is_object( $transformData ) ) {

                foreach ( $transformData as $each ) {

                    if ( isset( $each->data ) && ( $defaultConfig[ $each->type ] !== (array) $each->data ) ) {
                        $transforms[ $each->type ] = $each;
                    }

                }

                if ( ! empty( $transforms ) ) {
                    return pbwp_generate_transform_css( $transforms, $css, $cssOnly );
                }

            }

            return $cssOnly ? false : $css;

        } catch ( Exception $e ) {

            return $cssOnly ? false : $css;

        }

    }

    return $cssOnly ? false : $css;

}

function pbwp_generate_transform_css( $transforms, $css, $cssOnly )
{

    $temp_css = [  ];
    $origin   = 'center';

    foreach ( $transforms as $key => $each ) {

        if ( $each->type === 'scale' ) {
            $scaleX       = $each->data->scaleX / 100;
            $scaleY       = $each->data->scaleY / 100;
            $temp_css[  ] = 'scaleX('.$scaleX.') scaleY('.$scaleY.')';
        }

        if ( $each->type === 'translate' ) {
            $temp_css[  ] = 'translateX('.esc_html( $each->data->translateX.$each->unit ).') translateY('.esc_html( $each->data->translateY.$each->unit ).')';
        }

        if ( $each->type === 'skew' ) {
            $temp_css[  ] = 'skewX('.esc_html( $each->data->skewX.$each->unit ).') skewY('.esc_html( $each->data->skewY.$each->unit ).')';
        }

        if ( $each->type === 'rotate' ) {
            $temp_css[  ] = 'rotateX('.esc_html( $each->data->rotateX.$each->unit ).') rotateY('.esc_html( $each->data->rotateY.$each->unit ).') rotateZ('.esc_html( $each->data->rotateZ.$each->unit ).')';
        }

        if ( $each->type === 'origin' ) {
            $origin = $each->data->x.$each->unit.' '.$each->data->y.$each->unit;
        }

    }

    if ( $cssOnly ) {
        return [ 'origin' => esc_html( $origin ), 'transform' => $temp_css ];
    }

    $css[ 'desktop' ][ '.addclass..wpc__app_transform|transform' ]        = join( ' ', $temp_css );
    $css[ 'desktop' ][ '.addclass..wpc__app_transform|transform-origin' ] = $origin;

    return $css;

}

function pbwp_get_active_app_class( $data, $appname = '' )
{

    $apps = [
        'filters'      => 'app_filters_data',
        'transform'    => 'app_transform_data',
        'position'     => 'app_position_data',
        'boxshadow'    => 'app_boxshadow_data',
        'scrolleffect' => 'app_scrolleffects_data',
     ];

    $transformConfig = pbwp_get_transform_default_config();

    if ( $appname ) {
        $apps = array_intersect_key( $apps, array_flip( [ $appname ] ) );
    }

    if ( isset( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'advanced' ] ) ) {

        try {

            $classes = [  ];

            foreach ( $apps as $key => $app ) {

                if ( isset( $data[ 'config' ][ 'advanced' ][ $app ] ) ) {

                    $appData = json_decode( base64_decode( $data[ 'config' ][ 'advanced' ][ $app ], true ) );

                    if ( is_object( $appData ) ) {

                        $key = esc_html( $key );

                        foreach ( $appData as $subKey => $each ) {

                            if ( isset( $each->data ) ) {

                                if ( $key === 'transform' && ( $transformConfig[ $each->type ] !== (array) $each->data ) ) {
                                    $classes[  ] = 'wpc__app_'.$key;
                                }

                                if ( $key === 'scrolleffect' && isset( $each->data->state ) && $each->data->state === 'on' ) {
                                    $classes[  ] = 'wpc__app_'.$key;
                                }

                            } else {

                                if ( $key === 'position' && $subKey === 'css' && is_object( $each ) && ( isset( $appData->positionMode ) && $appData->positionMode !== 'default' ) ) {
                                    $classes[  ] = 'wpc__app_'.$key;
                                }

                                if ( $key === 'filters' && $subKey === 'css' && $each ) {
                                    $classes[  ] = 'wpc__app_'.$key;
                                }

                                if ( $key === 'boxshadow' && $subKey === 'css' && $each ) {
                                    $classes[  ] = 'wpc__app_'.$key;
                                }

                            }

                        }

                    }

                }

            }

            if ( ! empty( $classes ) ) {
                return ' '.implode( ' ', $classes );
            }

        } catch ( Exception $e ) {
            return '';
        }

    }

    return '';

}

function pbwp_get_transform_default_config()
{

    return [
        'scale'     => [
            'scaleY' => 100,
            'scaleX' => 100,
         ],
        'translate' => [
            'translateY' => 0,
            'translateX' => 0,
         ],
        'rotate'    => [
            'rotateZ' => 0,
            'rotateX' => 0,
            'rotateY' => 0,
         ],
        'skew'      => [
            'skewY' => 0,
            'skewX' => 0,
         ],
        'origin'    => [
            'y' => 50,
            'x' => 50,
         ],
     ];

}

function pbwp_app_custom_selector()
{

    return apply_filters( 'pbwp_app_custom_selector', [
        'blog'              => '.wpc_blog_item',
        'table'             => '.wpc_table_cont',
        'typetab'           => '.wpc_item_type_typetab',
        'typepricing'       => '.pc_box',
        'pricinglist'       => '.pcrlist_box',
        'contactform'       => '.wpc_form_main',
        'featurebox'        => '.ftre_box',
        'testimonial'       => '.testi_box',
        'testimonialslider' => '.wpc_test_slider_box',
        'counterup'         => '.cup_item_cont',
        'alertbox'          => '.wpc_item_alertbox',
        'productbox'        => '.prd_box',
        'typeimage'         => '.wpc_single_image',
        'typeaccordion'     => '.wpc_accordion',
        'typecta'           => '.wpc_item_typecta',
        'typeicon'          => '.wpc_item_icon',
        'singletitle'       => '.wpc_item_title',
        'typebutton'        => '.wpc_item_button',
        'newsletterform'    => '.wpc_nf_body',
        'typefbpost'        => '.fb_each_post',
        'typefbpagefeed'    => '.fb_each_post',
        'typeinstagram'     => '.insta_each_post_inner',
        'typetimeline'      => '.wpc-timeline-content',
        'typevideoplayer'   => '.wpc_item_video_player .wp-video',
        'typeeventcalendar' => '.fc .fc-view-harness',
     ] );

}

function pbwp_item_inline_css( $itemData )
{

    if ( $itemData[ 'type' ] === 'typeTimeline' ) {

        $tmline     = '';
        $border_col = pbwp_get_item_styles( $itemData[ 'config' ][ 'css' ], '.wpc-timeline-content:before|use-add-property', '', true );
        $selector   = '.wpc_item_'.esc_html( $itemData[ 'id' ] ).' .wpc-timeline-content:before';

        if ( isset( $border_col ) && ! empty( $border_col ) ) {
            $tmline .= pbwp_create_multi_devices_inline_css( $selector, $border_col, [ 'border-left-color', 'border-right-color' ], true );
        }

        return $tmline;

    }

    if ( $itemData[ 'type' ] === 'typeList' ) {

        $id          = $itemData[ 'id' ];
        $css         = ( isset( $itemData[ 'config' ][ 'css' ] ) ? $itemData[ 'config' ][ 'css' ] : '#e67e22' );
        $shape       = pbwp_get_item_options( $itemData, 'list_shape', 'list_shape_circle' );
        $listpos     = pbwp_get_item_options( $itemData, 'list_line_pos', 'top' );
        $selector    = '.wpc_item_'.esc_attr( $id ).' .wpc_item_typelist.'.esc_attr( $shape ).'';
        $css_devices = [ 'desktop', 'tablet', 'smartphone' ];
        $color       = '#e67e22';
        $noCss       = true;
        $shapeCss    = '';

        foreach ( $css_devices as $device ) {

            if ( is_array( $css ) && array_key_exists( $device, $css ) && ! empty( $css[ $device ] ) ) {

                $cssBreakpoint = pbwp_set_css_breakpoints( $device, true );

                if ( $cssBreakpoint != '' ) {
                    $shapeCss .= $cssBreakpoint;
                }

                if ( isset( $css[ $device ][ '.list_shape_col|background' ] ) && $css[ $device ][ '.list_shape_col|background' ] != '' ) {
                    $color = $css[ $device ][ '.list_shape_col|background' ];
                }

                if ( $listpos != 'no' ) {
                    $shapeCss .= $selector.' .wpc_list_text_cont {border-'.esc_attr( $listpos ).': 1px solid '.esc_attr( pbwp_change_rgba_opacity( $color, '0.2' ) ).';}';
                }

                if ( $shape == 'list_shape_icon' ) {

                } else {

                    if ( $shape == 'list_shape_circle' || $shape == 'list_shape_square' ) {
                        $shapeCss .= $selector.' .list_shape { background: '.esc_attr( $color ).';}';
                        $shapeCss .= $selector.' .wpc_list_number {top: 50%;transform: translateY(-50%);}';
                    }

                    if ( $shape == 'list_shape_triangle' ) {
                        $shapeCss .= $selector.' .list_shape {border-bottom: 30px solid '.esc_attr( $color ).';}';
                        $shapeCss .= $selector.' .wpc_list_number {top: 50%;transform: translateY(23%);left:-3px;}';
                    }

                    if ( $shape == 'list_shape_pentagon' ) {
                        $shapeCss .= $selector.' .wpc_list_number {top: -27px;}';
                        $shapeCss .= $selector.' .list_shape {border-color: '.esc_attr( $color ).' transparent;}';
                        $shapeCss .= $selector.' .list_shape:before {border-color: transparent transparent '.esc_attr( $color ).';}';
                    }

                    if ( $shape == 'list_shape_hexagon' ) {
                        $shapeCss .= $selector.' .wpc_list_number {top: -3px;}';
                        $shapeCss .= $selector.' .list_shape {background-color:'.esc_attr( $color ).';}';
                        $shapeCss .= $selector.' .list_shape:before {border-bottom: 8.66px solid '.esc_attr( $color ).';}';
                        $shapeCss .= $selector.' .list_shape:after {border-top: 8.66px solid '.esc_attr( $color ).';}';
                    }

                    if ( $shape == 'list_shape_octagon' ) {
                        $shapeCss .= $selector.' .wpc_list_number {-webkit-transform: rotate(-45deg);-moz-transform: rotate(-45deg);transform: rotate(-45deg);top: 3px;}';
                        $shapeCss .= $selector.' .list_shape:after {background-color: '.esc_attr( $color ).';}';
                    }

                }

                if ( $cssBreakpoint != '' ) {
                    $shapeCss .= '}';
                }

                $noCss = false;

            } else {

                if ( $listpos != 'no' && $noCss ) {
                    $shapeCss .= $selector.' .wpc_list_text_cont {border-'.esc_attr( $listpos ).': 1px solid '.esc_attr( pbwp_change_rgba_opacity( $color, '0.2' ) ).';}';
                }

                $noCss = false;

            }

        }

        return $shapeCss;

    }

    if ( $itemData[ 'type' ] === 'typeMaps' ) {

        $maps       = '';
        $marker_tpl = pbwp_get_item_options( $itemData, 'map_marker_template', 'style_01' );

        if ( $marker_tpl == 'style_01' ) {

            $b_col = pbwp_get_item_styles( $itemData[ 'config' ][ 'css' ], '.marker_tpl_style_01|background', '', true );

            if ( isset( $b_col ) && ! empty( $b_col ) ) {

                $selector = '#maps_canvas_'.esc_html( $itemData[ 'id' ] ).' .wpc_maps_main_style_01:after';
                $maps .= pbwp_create_multi_devices_inline_css( $selector, $b_col, 'border-top-color' );

            }

        }

        if ( $marker_tpl === 'style_02' ) {

            $m2_bcol = pbwp_get_item_styles( $itemData[ 'config' ][ 'css' ], '.marker_tpl_style_02|border-color', '', true );

            if ( isset( $m2_bcol ) && ! empty( $m2_bcol ) ) {

                $selector = '#maps_canvas_'.esc_html( $itemData[ 'id' ] ).' .marker_tpl_style_02:after';
                $maps .= pbwp_create_multi_devices_inline_css( $selector, $m2_bcol, 'border-top-color' );

            }

            $icon_size = '20px';
            $font_size = (float) $icon_size;

            $sel     = '#maps_canvas_'.esc_html( $itemData[ 'id' ] ).'';
            $m2_icon = pbwp_get_item_styles( $itemData[ 'config' ][ 'css' ], 'i.wpc_maps_icon|font-size', '', true );

            foreach ( $m2_icon as $iSize ) {

                $cssBreakpoint = pbwp_set_css_breakpoints( $iSize[ 'device' ], true );

                if ( $cssBreakpoint != '' ) {
                    $maps .= $cssBreakpoint;
                }

                $font_size = (float) $iSize[ 'value' ];

                $maps .= $sel.' .wpc_custom_marker {left: -'.$font_size.'px;} '.$sel.' .wpc_custom_marker .marker_tpl_style_02:after {left: calc(50% + 9px);} '.$sel.' .wpc_custom_marker .marker_tpl_style_02:before {left: calc(50% - 9px);}';

                $maps .= $sel.' .wpc_custom_marker .marker_tpl_style_02 .wpc_maps_icon {width: '.$font_size.'px; height: '.$font_size.'px;}';

                if ( $cssBreakpoint != '' ) {
                    $maps .= '}';
                }

            }

        }

        return $maps;

    }

    if ( $itemData[ 'type' ] === 'typePricing' ) {

        if ( isset( $itemData[ 'config' ][ 'css' ] ) ) {

            $pricing     = '';
            $css         = $itemData[ 'config' ][ 'css' ];
            $css_devices = [ 'desktop', 'tablet', 'smartphone' ];
            $padding     = '20px 0 20px 0;';
            $template    = pbwp_get_item_options( $itemData, 'template', 'pc_style_01' );

            foreach ( $css_devices as $device ) {

                if ( array_key_exists( $device, $css ) && ! empty( $css[ $device ] ) ) {

                    if ( isset( $css[ $device ][ '.pc_icon_cont|background' ] ) || isset( $css[ $device ][ '.pc_price_cont|background' ] ) ) {

                        $selector = '.wpc_item_'.esc_attr( $itemData[ 'id' ] );

                        $cssBreakpoint = pbwp_set_css_breakpoints( $device, true );

                        if ( $cssBreakpoint != '' ) {
                            $pricing .= $cssBreakpoint;
                        }

                        if ( $template == 'pc_style_02' ) {
                            $padding = '20px;';
                        }

                        $pricing .= $selector.' .pc_icon_cont {padding:'.$padding.'}';
                        $pricing .= $selector.' .pc_price_cont {padding:'.$padding.'}';

                        if ( $cssBreakpoint != '' ) {
                            $pricing .= '}';
                        }

                    }

                }

            }

            return $pricing;

        }

    }

}

function pbwp_get_attachment_image_src( $id, $size = 'medium', $custom_size = null, $get_desc = null, $pchldr_size = '300x300' )
{

    if ( $id == '' ) {
        return pbwp_missing_image_handler( $pchldr_size );
    }

    if ( $size == 'custom' && $custom_size ) {
        $custom_size = explode( 'x', strtolower( $custom_size ) );
        $img         = wp_get_attachment_image_src( $id, 'full' );

        if ( ! isset( $img[ 0 ] ) ) {
            return pbwp_missing_image_handler( $pchldr_size );
        }

        $img = pbwp_image_resize( $img[ 0 ], [ ( isset( $custom_size[ 0 ] ) ? $custom_size[ 0 ] : 250 ), ( isset( $custom_size[ 1 ] ) ? $custom_size[ 1 ] : 250 ) ], true );

    } else {
        $img = wp_get_attachment_image_src( $id, $size );

        // Prevent empty image
        if ( ! isset( $img[ 0 ] ) ) {
            $img = esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) );
        } else {
            $img = $img[ 0 ];
        }

    }

    $img_desc      = '';
    $alt_img       = esc_attr( pbwp_generate_image_alt( $id, $img ) );
    $full_size_uri = wp_get_attachment_image_src( $id, 'full' );
    $full_size_uri = ( isset( $full_size_uri[ 0 ] ) ? $full_size_uri[ 0 ] : esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) ) );

    if ( $get_desc ) {

        if ( $get_desc == '_desc' ) {
            // Get image description
            $attachment = get_post( $id );

            $img_desc = ( isset( $attachment ) ? $attachment->post_content : '' );

        }

        if ( $get_desc == '_alt' ) {
            $img_desc = $alt_img;
        }

    }

    return [ 'url' => esc_url( $img ), 'alt' => esc_html( $alt_img ), 'desc' => esc_html( $img_desc ), 'full_size_uri' => esc_url( $full_size_uri ) ];

}

function pbwp_missing_image_handler( $pchldr_size )
{

    return [ 'url' => esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) ), 'alt' => esc_attr( 'WP Composer' ), 'desc' => '', 'full_size_uri' => esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) ) ];

}

function pbwp_image_resize( $url, $size = null, $crop = true, $single = true )
{

    if ( ! $url ) {
        return esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) );
    }

    if ( $size == null ) {
        $size = [ 250, 250 ];
    }

    $width  = isset( $size[ 0 ] ) && $size[ 0 ] ? $size[ 0 ] : 250;
    $height = isset( $size[ 1 ] ) && $size[ 1 ] ? $size[ 1 ] : 250;

    if ( ! class_exists( 'PBWP_Aq_Resize' ) ) {
        require_once pbwp_manager()->path( 'GLOBAL_VENDOR_DIR', '/aq_resizer/aq_resizer.php' );
    }

    return aq_resize( $url, $width, $height, true );

}

function pbwp_generate_image_alt( $id, $full_path )
{

    $img_alt = get_post_meta( $id, '_wp_attachment_image_alt', true );

    if ( $img_alt == '' ) {

        $img_name = basename( $full_path );

        // Get filename of image
        if ( strpos( $img_name, '.' ) == false ) {
            $img_name = 'wp_composer.temp';
        }

        $img_alt = substr( $img_name, 0, strrpos( $img_name, '.' ) ); // Get name without extention
        $img_alt = preg_replace( '/[^A-Za-z0-9\x]/', ' ', $img_alt );

    }

    return ucwords( $img_alt );

}

function pbwp_animation_creator( $data, $enqueue = false )
{

    if ( isset( $data[ 'config' ][ 'animate' ] ) ) {

        $animation = $data[ 'config' ][ 'animate' ];

        if ( ! isset( $animation[ 'anim_effect' ] ) || $animation[ 'anim_effect' ] == '' ) {
            return '';
        }

        if ( $enqueue ) {
            wp_enqueue_script( 'waypoints' );
            wp_enqueue_style( 'animate' );

            return;

        }

        $effect = ' wpc_animate_e_'.$animation[ 'anim_effect' ];
        $speed  = ( isset( $animation[ 'anim_speed' ] ) && $animation[ 'anim_speed' ] ? ' wpc_animate_s_'.$animation[ 'anim_speed' ] : '' );
        $delay  = ( isset( $animation[ 'anim_delay' ] ) && $animation[ 'anim_delay' ] ? ' wpc_animate_d_'.$animation[ 'anim_delay' ] : '' );

        return 'wpc_animate_animated'.esc_attr( $effect ).esc_attr( $speed ).esc_attr( $delay ).' ';

    } else {

        return '';

    }

}

function pbwp_encrypt_decrypt( $action, $string )
{

    $output         = false;
    $encrypt_method = 'AES-256-CBC';
    $secret_key     = base64_encode( get_site_url().'wpcskey' );
    $secret_iv      = base64_encode( get_site_url().'wpcsiv' );

    if ( version_compare( PHP_VERSION, '5', '<' ) ) {

        $td = mcrypt_module_open( 'tripledes', '', 'ecb', '' );
        $iv = mcrypt_create_iv( mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND );
        mcrypt_generic_init( $td, $secret_key, $iv );

        if ( $action == 'encrypt' ) {
            $output = base64_encode( mcrypt_generic( $td, $string ) );
        } else

        if ( $action == 'decrypt' ) {
            $output = mdecrypt_generic( $td, base64_decode( $string ) );
        }

        mcrypt_generic_deinit( $td );
        mcrypt_module_close( $td );

        return $output;

    }

    // hash
    $key = hash( 'sha256', $secret_key );

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt( $string, $encrypt_method, $key, 0, $iv );
    } else

    if ( $action == 'decrypt' ) {
        $output = openssl_decrypt( $string, $encrypt_method, $key, 0, $iv );
    }

    return $output;

}

function pbwp_generate_customizer_link( $id, $post = '', $frontEditor = false )
{

    if ( ! $post ) {
        $post = (object) [ 'post_type' => get_post_type( $id ), 'post_title' => get_the_title( $id ) ];
    }

    $wpc_params = apply_filters( 'pbwp_editor_builder_params', [
        'section'   => 'wpc_sections_control',
        'postID'    => $id,
        'postType'  => $post->post_type,
        'postTitle' => htmlspecialchars_decode( $post->post_title, ENT_NOQUOTES ),
        'permalink' => get_permalink( $id ),
     ] );

    if ( $frontEditor ) {
        $wpc_params = array_merge( $wpc_params, [ 'previewer' => true ] );
    }

    $wpc_params = base64_encode( wp_json_encode( $wpc_params ) );
    $link       = add_query_arg( apply_filters( 'pbwp_editor_link_params', [ 'wpc_session' => $wpc_params ] ), admin_url( 'customize.php' ) );

    return esc_url( $link );

}

function pbwp_front_edit_link( $wp_admin_bar )
{

    if ( is_user_logged_in()
        && ! is_admin()
        && current_user_can( 'edit_theme_options' )
        && pbwp_is_allowed_post_type( get_post_type( get_the_ID() ) ) ) {

        if ( pbwp_is_disabled() ) {
            return $wp_admin_bar;
        }

        if ( ! is_object( $wp_admin_bar ) ) {
            global $wp_admin_bar;
        }

        if ( is_singular() ) {

            add_filter( 'pbwp_editor_builder_params', 'pbwp_editor_builder_params_filter', 99, 2 );

            $wp_admin_bar->add_menu( [
                'id'    => 'wpc_inline-admin-bar-link',
                'title' => esc_html__( 'Edit with WP Composer', 'page-builder-wp' ),
                'href'  => esc_url( pbwp_generate_customizer_link( get_the_ID() ) ),
                'meta'  => [ 'class' => 'wpc-direct-link' ],
             ] );

        }

    }

}

function pbwp_editor_link_params_filter( $params, $add = '' )
{

    $add = add_query_arg( [ 'action' => 'pbwp_safe_return' ], admin_url( 'admin-ajax.php' ) );

    $params = array_merge( $params, [ 'return' => $add ] );

    return $params;

}

function pbwp_editor_builder_params_filter( $params, $add = '' )
{

    global $wp;

    $add = [
        'nonce' => wp_create_nonce( 'wpc-safe-return' ),
        'url'   => isset( $_SERVER[ 'REQUEST_URI' ] ) ? esc_url_raw( wp_unslash( $_SERVER[ 'REQUEST_URI' ] ) ) : home_url( $wp->request ),
     ];

    $params = array_merge( $params, [ 'previewer' => true, 'return_params' => $add ] );

    return $params;

}

function pbwp_is_compatible_theme()
{
    // Each array items are theme slug
    $themes = apply_filters( 'pbwp_supported_themes', [ 'zoom-lite', 'zoom-pro' ] );

    if ( in_array( get_template(), $themes ) ) {
        return get_template();
    }

    return false;

}

function pbwp_is_on_localhost()
{

    $localhost = [
        '127.0.0.1',
        '::1',
     ];

    if ( in_array( $_SERVER[ 'REMOTE_ADDR' ], $localhost ) ) {
        return true;
    }

    return false;

}

/**
 * Check if Gutenberg is active.
 * Must be used not earlier than plugins_loaded action fired.
 *
 * @return bool
 */
function pbwp_is_gutenberg_active()
{

    $gutenberg    = false;
    $block_editor = false;

    if ( has_filter( 'replace_editor', 'gutenberg_init' ) ) {
        // Gutenberg is installed and activated.
        $gutenberg = true;
    }

    if ( version_compare( $GLOBALS[ 'wp_version' ], '5.0-beta', '>' ) ) {
        // Block editor.
        $block_editor = true;
    }

    if ( ! $gutenberg && ! $block_editor ) {
        return false;
    }

    include_once ABSPATH.'wp-admin/includes/plugin.php';

    if ( ! is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
        return true;
    }

    $use_block_editor = ( get_option( 'classic-editor-replace' ) === 'no-replace' );

    return $use_block_editor;

}

function pbwp_get_item_styles( $css, $key, $inDevice = '', $get_value = false )
{

    $status      = false;
    $all_values  = [  ];
    $css_devices = [ 'desktop', 'tablet', 'smartphone' ];

    foreach ( $css_devices as $device ) {

        if ( array_key_exists( $device, $css ) && ! empty( $css[ $device ] ) ) {

            if ( $inDevice != '' ) {
                $device = $inDevice;
            }

            if ( isset( $css[ $device ][ $key ] ) ) {

                if ( isset( $css[ $device ][ $key ] ) && $css[ $device ][ $key ] != '' ) {
                    $all_values[  ] = [ 'device' => $device, 'key' => $key, 'value' => $css[ $device ][ $key ] ];
                }

                if ( $get_value && $inDevice != '' ) {
                    return $all_values;
                }

                $status = true;
            } else {
                $status = false;
            }

        }

    }

    if ( $get_value ) {
        return $all_values;
    }

    return $status;

}

function pbwp_create_multi_devices_inline_css( $selector, $css, $paramReplacer = '', $useImportant = false )
{

    $inline_css = '';
    $selector   = esc_html( $selector );

    foreach ( $css as $each ) {

        $cssBreakpoint = pbwp_set_css_breakpoints( $each[ 'device' ], true );

        if ( $cssBreakpoint != '' ) {
            $inline_css .= $cssBreakpoint;
        }

        $cssProp = explode( '|', $each[ 'key' ] );

        if ( is_array( $paramReplacer ) ) {
            $inline_css .= $selector.'{';

            foreach ( $paramReplacer as $eachProp ) {
                $inline_css .= $eachProp.':'.$each[ 'value' ].( $useImportant ? ' !important' : '' ).';';
            }

            $inline_css .= '}';

        } else {
            $inline_css .= esc_html( $selector ).'{'.( $paramReplacer != '' ? esc_html( $paramReplacer ) : esc_html( $cssProp[ 1 ] ) ).': '.esc_html( $each[ 'value' ] ).( $useImportant ? ' !important' : '' ).';}';
        }

        if ( $cssBreakpoint != '' ) {
            $inline_css .= '}';
        }

    }

    return $inline_css;

}

function pbwp_get_svg_code( $type )
{

    if ( ! function_exists( 'pbwp_shape_divider_shapes' ) ) {
        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'shapes/wpc-divider-shapes.php' );
    }

    $svg = pbwp_shape_divider_shapes( $type );

    return pbwp_get_specific_html_tag( $svg, 'svg' );

}

function pbwp_svg_set_gradient( $svg, $colors )
{

    // Gradient unique ID
    $uid       = uniqid();
    $col_start = $colors[ 0 ];
    $col_end   = $colors[ 1 ];
    // Gradient style
    $defs       = '<defs><linearGradient id="'.$uid.'" '.apply_filters( 'pbwp_divider_linear_gradient_style', 'x1="0" x2="1" y1="0" y2="1"' ).'><stop offset="0%" stop-color="'.esc_attr( $col_start ).'"></stop><stop offset="100%" stop-color="'.esc_attr( $col_end ).'"></stop></linearGradient></defs></svg>';
    $gradPath   = '<path fill="url(#'.$uid.')" ';
    $gradCircle = '<circle fill="url(#'.$uid.')" ';

    // Append Gradient style, remove fill class and add fill ID
    $svg = str_replace( [ '</svg>', 'class="wpc-shape-fill"', '<path', '<circle' ], [ $defs, '', $gradPath, $gradCircle ], $svg );

    return $svg;

}

function pbwp_wp_editor_safe_content( $content )
{

    $content = wp_kses_post( $content );
    $content = pbwp_js_remove_wpautop( $content, true );
    $content = shortcode_unautop( $content );
    $content = do_shortcode( $content );
    $content = wptexturize( $content );

    return html_entity_decode( $content, ENT_COMPAT, 'UTF-8' );

}

function pbwp_js_remove_wpautop( $content, $autop = false )
{

    if ( $autop ) {
        $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content )."\n" );
    }

    return $content;

}

function pbwp_remove_br_empty_p( $content )
{
    // Create a new DOMDocument
    $dom = new DOMDocument();

    // Load the HTML content
    libxml_use_internal_errors( true );
    $dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
    libxml_clear_errors();

    // Get all <br> tags and remove them
    $brTags = $dom->getElementsByTagName( 'br' );
    foreach ( $brTags as $brTag ) {
        $brTag->parentNode->removeChild( $brTag );
    }

    // Get all empty <p></p> tags and remove them
    $emptyPTags = $dom->getElementsByTagName( 'p' );
    foreach ( $emptyPTags as $emptyPTag ) {
        if ( trim( $emptyPTag->nodeValue ) == '' ) {
            $emptyPTag->parentNode->removeChild( $emptyPTag );
        }
    }

    // Get all <p><br></p> tags and remove them
    $pBrTags = $dom->getElementsByTagName( 'p' );
    foreach ( $pBrTags as $pBrTag ) {
        if ( $pBrTag->childNodes->length == 1 && $pBrTag->childNodes->item( 0 )->nodeName == 'br' ) {
            $pBrTag->parentNode->removeChild( $pBrTag );
        }
    }

    // Get all empty <p>&nbsp;</p> tags and remove them
    $nbspPTags = $dom->getElementsByTagName( 'p' );
    foreach ( $nbspPTags as $nbspPTag ) {
        $nodeValue = html_entity_decode( $nbspPTag->nodeValue, ENT_QUOTES, 'UTF-8' );
        if ( trim( $nodeValue ) == '' ) {
            $nbspPTag->parentNode->removeChild( $nbspPTag );
        }
    }

    // Get all empty <p> tags with whitespace and remove them
    $whitespacePTags = $dom->getElementsByTagName( 'p' );
    foreach ( $whitespacePTags as $whitespacePTag ) {
        $nodeValue = html_entity_decode( $whitespacePTag->nodeValue, ENT_QUOTES, 'UTF-8' );
        if ( preg_replace( '/\s/', '', $nodeValue ) === '' ) {
            $whitespacePTag->parentNode->removeChild( $whitespacePTag );
        }
    }
    // Save the modified HTML content
    $cleanHtml = $dom->saveHTML();

    return $cleanHtml;

}

function pbwp_remove_html_comment_tags( $content )
{

    $content = preg_replace( '/<!--(.*)-->/Uis', '', $content );
    $pattern = "/<p[^>]*>(\s|&nbsp;)*<\\/p[^>]*>/";
    $content = preg_replace( $pattern, '', $content );

    return trim( $content );

}

function pbwp_get_active_wpcomposer_post_id()
{
    $ids      = [  ];
    $meta_key = 'wp_composer';
    $all      = wp_cache_get( 'pbwp_get_active_wpcomposer_post_id' );

    if ( false === $all ) {

        global $wpdb;
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $all = $wpdb->get_results( $wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta
        INNER JOIN $wpdb->posts ON $wpdb->postmeta.post_id = $wpdb->posts.ID
        WHERE meta_key = %s",
            $meta_key
        ), ARRAY_A );

        wp_cache_set( 'pbwp_get_active_wpcomposer_post_id', $all );

    }

    if ( isset( $all ) && count( $all ) !== 0 ) {
        array_walk_recursive( $all, function ( $v, $k ) use ( &$ids ) {
            $ids[  ] = $v;
        } );
    }

    return $ids;
}

function pbwp_findKeys( $array, $find )
{

    foreach ( $array as $key => $value ) {

        if ( in_array( $key, $find ) && is_array( $value ) ) {
            return true;
        } elseif ( is_array( $value ) && pbwp_findKeys( $value, $find ) ) {
            return true;
        }

    }

    return false;

}

function pbwp_get_item_group_data( $data, $auto_encode = true )
{

    $all_items = '';

    if ( is_array( $data[ 'config' ] ) && isset( $data[ 'config' ][ 'group' ] ) && ! empty( $data[ 'config' ][ 'group' ] ) ) {

        $all_items = $data[ 'config' ][ 'group' ];

        if ( $auto_encode ) {

            // Auto decode value
            foreach ( $all_items as $key => $each ) {

                foreach ( $each as $k => $value ) {
                    if ( pbwp_is_base64_encoded( $value ) ) {
                        $all_items[ $key ][ $k ] = pbwp_str_to_utf8( pbwp_base64_decode( $value, true ) );
                    }

                }

            }

        }

    } else {

        $all_items = pbwp_get_item_group_params( $data[ 'type' ], 'defaultvalue' );

    }

    return $all_items;

}

function pbwp_get_item_group_params( $type, $key )
{

    if ( ! function_exists( 'pbwp_maps' ) ) {
        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'maps/wpc-maps.php' );
    }

    $field_maps = pbwp_maps();

    if ( isset( $field_maps[ 'maps' ][ $type ] ) && isset( $field_maps[ 'maps' ][ $type ][ 'template' ] ) && isset( $field_maps[ 'maps' ][ $type ][ 'template' ][ 'group-panel' ] ) && isset( $field_maps[ 'maps' ][ $type ][ 'template' ][ 'group-panel' ][ $key ] ) ) {
        return $field_maps[ 'maps' ][ $type ][ 'template' ][ 'group-panel' ][ $key ];
    }

    return [  ];

}

function pbwp_get_specific_html_tag( $str, $tag = 'span' )
{

    if ( preg_match_all( '/<'.$tag.'(.*?)>(.*?)<\/'.$tag.'>/', $str, $matches ) ) {
        return implode( '', $matches[ 0 ] );
    }

    return '';

}

function pbwp_str_to_utf8( $str )
{

    $decoded = utf8_decode( $str );

    if ( mb_detect_encoding( $decoded, 'UTF-8', true ) === false ) {
        return $str;
    }

    return $decoded;

}

function pbwp_is_base64_encoded( string $str ): bool
{

    if ( is_array( $str ) ) {
        return false;
    }

    if ( ! apply_filters( 'pbwp_validate_decoded_string', true ) ) {
        return pbwp_base64_decode( $str, true );
    }

    if ( (bool) preg_match( '/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $str ) === false ) {
        return false;
    }

    $decoded = base64_decode( $str, true );

    if ( $decoded === false ) {
        return false;
    }

    $encoding = mb_detect_encoding( $decoded );

    if ( ! in_array( $encoding, [ 'UTF-8', 'ASCII' ], true ) ) {
        return false;
    }

    return $decoded !== false && base64_encode( $decoded ) === $str;

}

function pbwp_base64_decode( $str, $skipCheck = false )
{

    if ( is_array( $str ) ) {
        return false;
    }

    if ( $skipCheck ) {
        return base64_decode( $str );
    }

    if ( pbwp_is_base64_encoded( $str ) ) {
        return base64_decode( $str );
    }

    return $str;

}

function pbwp_array_filter_recursive( $input )
{

    foreach ( $input as &$value ) {

        if ( is_array( $value ) ) {
            $value = pbwp_array_filter_recursive( $value );
        }

    }

    return array_filter( $input, 'pbwp_array_filter_func' );

}

function pbwp_array_filter_func( $var )
{

    if ( is_array( $var ) ) {
        // Beta
        return pbwp_array_filter_recursive( $var );
    }

    return ( $var !== null && $var !== false && $var !== '' );

}

function pbwp_generate_hotkeys()
{

    $hotkeys = [
        [
            'desc' => esc_html__( 'Insert Row', 'page-builder-wp' ),
            'key'  => 'alt+1',
         ],
        [
            'desc' => esc_html__( 'Insert Item', 'page-builder-wp' ),
            'key'  => 'a',
         ],
        [
            'desc' => esc_html__( 'Open Online Library', 'page-builder-wp' ),
            'key'  => 't',
         ],
        [
            'desc' => esc_html__( 'Open Fonts Manager', 'page-builder-wp' ),
            'key'  => 'f',
         ],
        [
            'desc' => esc_html__( 'Open Templates Manager', 'page-builder-wp' ),
            'key'  => 'm',
         ],
        [
            'desc' => esc_html__( 'Open Navigator', 'page-builder-wp' ),
            'key'  => 'n',
         ],
        [
            'desc' => esc_html__( 'Open Backend Editor', 'page-builder-wp' ),
            'key'  => 'b',
         ],
        [
            'desc' => esc_html__( 'Open Global Settings', 'page-builder-wp' ),
            'key'  => 'g',
         ],
        [
            'desc' => esc_html__( 'Toggle UI Themes', 'page-builder-wp' ),
            'key'  => 's',
         ],
        [
            'desc' => esc_html__( 'Toggle Responsive Preview Mode', 'page-builder-wp' ),
            'key'  => 'r',
         ],
        [
            'desc' => esc_html__( 'Dismiss Active Panel', 'page-builder-wp' ),
            'key'  => 'esc',
         ],
        [
            'desc' => esc_html__( 'Undo', 'page-builder-wp' ),
            'key'  => 'ctrl+z',
         ],
        [
            'desc' => esc_html__( 'Redo', 'page-builder-wp' ),
            'key'  => 'ctrl+y',
         ],
        [
            'desc'           => esc_html__( 'Save Changes', 'page-builder-wp' ),
            'key'            => 'ctrl+s',
            'target'         => '*',
            'preventDefault' => true,
         ],
        [
            'desc' => esc_html__( 'Editor Normal Mode', 'page-builder-wp' ),
            'key'  => '1',
         ],
        [
            'desc' => esc_html__( 'Editor Dock to Left', 'page-builder-wp' ),
            'key'  => '2',
         ],
        [
            'desc' => esc_html__( 'Editor Dock to Right', 'page-builder-wp' ),
            'key'  => '3',
         ],
        [
            'desc' => esc_html__( 'Editor Fullscreen Mode', 'page-builder-wp' ),
            'key'  => '4',
         ],
        [
            'desc'           => esc_html__( 'Back to Previous Page', 'page-builder-wp' ),
            'key'            => 'ctrl+b',
            'target'         => '*',
            'preventDefault' => true,
         ],
        [
            'desc' => esc_html__( 'Refresh Editor', 'page-builder-wp' ),
            'key'  => 'shift+r',
         ],
        [
            'desc' => esc_html__( 'Open Keyboard Shortcuts', 'page-builder-wp' ),
            'key'  => 'k',
         ],
     ];

    return apply_filters( 'pbwp_hotkeys', $hotkeys );

}

function pbwp_get_favorites_items()
{

    $fav = pbwp_front_get_option( 'user_item_favorites' );

    if ( isset( $fav ) && is_array( $fav ) && count( $fav ) > 0 ) {
        return $fav;
    } else {
        return [  ];
    }

}

function pbwp_pick_wpc_dummy_random_image_id( $count, $retString = false, $start_from = false )
{

    if ( ! function_exists( 'pbwp_get_option' ) ) {
        require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
    }

    if ( ! isset( $count ) || $count > 10 ) {
        $count = 10;
    }

    $result = [  ];

    $all = get_option( 'pbwp_default_multiple_images' );

    if ( is_array( $all ) && ! empty( $all ) ) {

        if ( $start_from ) {
            $result = array_slice( $all, $start_from );
        } else {
            $result = array_intersect_key( $all, array_flip( (array) array_rand( $all, $count ) ) );
        }

        foreach ( $result as $k => $img ) {

            if ( ! isset( wp_get_attachment_image_src( $img )[ 0 ] ) ) {
                $all[ $k ]    = (string) pbwp_pick_wpmedia_random_image_id();
                $result[ $k ] = $all[ $k ];
                update_option( 'pbwp_default_multiple_images', pbwp_array_sanitation( $all ) );
                continue;
            }

        }

    } else {

        foreach ( range( 1, $count ) as $img ) {
            $result[  ] = (string) pbwp_pick_wpmedia_random_image_id();
        }

    }

    return $retString ? implode( ',', $result ) : $result;

}

function pbwp_filesystem()
{

    global $wp_filesystem;

    if ( ! function_exists( '\WP_Filesystem' ) ) {
        include ABSPATH.'wp-admin/includes/file.php';
    }

    \WP_Filesystem();

    return $wp_filesystem;

}

/**
 * Custom Allowed HTML Tags
 *
 */
function pbwp_wp_kses_allowed_html( $mode = false )
{

    $custom_allowed_tags = [
        'a'        => [
            'itemprop' => true,
         ],
        'aside'    => [
            'data-section' => true,
         ],
        'canvas'   => [
            'class'  => true,
            'height' => true,
            'id'     => true,
            'width'  => true,
            'style'  => true,
         ],
        'div'      => [
            'itemscope' => true,
            'itemprop'  => true,
            'itemtype'  => true,
         ],
        'h1'       => [
            'itemprop' => true,
            'data-*'   => true,
         ],
        'svg'      => [
            'xmlns'               => true,
            'fill'                => true,
            'viewbox'             => true,
            'preserveaspectratio' => true,
            'shape-rendering'     => true,
            'role'                => true,
            'aria-hidden'         => true,
            'focusable'           => true,
            'height'              => true,
            'width'               => true,
            'class'               => true,
            'stroke-linejoin'     => true,
            'stroke-miterlimit'   => true,
            'data-*'              => true,
            'clip-rule'           => true,
            'fill-rule'           => true,
            'fill-opacity'        => true,
            'style'               => true,
            'transform'           => true,
         ],
        'path'     => [
            'style'        => true,
            'd'            => true,
            'fill'         => true,
            'fill-opacity' => true,
            'class'        => true,
            'opacity'      => true,
            'transform'    => true,
         ],
        'g'        => [
            'id'    => true,
            'fill'  => true,
            'style' => true,
         ],
        'circle'   => [
            'cx'        => true,
            'cy'        => true,
            'r'         => true,
            'fill'      => true,
            'class'     => true,
            'opacity'   => true,
            'transform' => true,
            'style'     => true,
         ],
        'line'     => [
            'x1'           => true,
            'y1'           => true,
            'x2'           => true,
            'y2'           => true,
            'stroke'       => true,
            'stroke-width' => true,
            'class'        => true,
            'opacity'      => true,
            'style'        => true,
         ],
        'form'     => [
            'method' => true,
            'class'  => true,
            'action' => true,
            'role'   => true,
            'data-*' => true,
            'id'     => true,
            'style'  => true,
         ],
        'input'    => [
            'type'         => true,
            'class'        => true,
            'id'           => true,
            'value'        => true,
            'accept'       => true,
            'checked'      => true,
            'readonly'     => true,
            'name'         => true,
            'min'          => true,
            'max'          => true,
            'step'         => true,
            'placeholder'  => true,
            'autocomplete' => true,
            'data-*'       => true,
            'onblur'       => true,
            'onfocus'      => true,
            'style'        => true,
         ],
        'textarea' => [
            'type'         => true,
            'rows'         => true,
            'cols'         => true,
            'class'        => true,
            'id'           => true,
            'value'        => true,
            'name'         => true,
            'readonly'     => true,
            'maxlength'    => true,
            'spellcheck'   => true,
            'placeholder'  => true,
            'autocomplete' => true,
            'data-*'       => true,
            'style'        => true,
         ],
        'select'   => [
            'id'     => true,
            'class'  => true,
            'name'   => true,
            'data-*' => true,
            'style'  => true,
         ],
        'option'   => [
            'id'       => true,
            'class'    => true,
            'selected' => true,
            'disabled' => true,
            'value'    => true,
            'data-*'   => true,
            'style'    => true,
         ],
        'optgroup' => [
            'label' => true,
            'class' => true,
         ],
        'meta'     => [
            'itemscope' => true,
            'itemprop'  => true,
            'itemtype'  => true,
            'itemType'  => true,
            'content'   => true,
         ],
        'article'  => [
            'itemprop'  => true,
            'itemscope' => true,
            'itemtype'  => true,
         ],
        'iframe'   => [
            'id'              => true,
            'src'             => true,
            'class'           => true,
            'height'          => true,
            'width'           => true,
            'frameborder'     => true,
            'allowfullscreen' => true,
            'data-*'          => true,
            'style'           => true,
         ],
        'source'   => [
            'src'    => true,
            'type'   => true,
            'data-*' => true,
         ],
     ];

    // Get the default allowed tags for post content
    $default_allowed_tags = wp_kses_allowed_html( 'post' );

    // Merge arrays
    $merged_allowed_tags = pbwp_array_merge_recursive_custom( $default_allowed_tags, $custom_allowed_tags );

    if ( $mode ) {
        if ( $mode === 'html' ) {
            $custom_html_tags = [
                'html' => [
                    'xmlns' => true,
                    'style' => true,
                 ],
                'head' => [  ],
                'meta' => [
                    'charset' => true,
                    'name'    => true,
                 ],
                'body' => [
                    'class' => true,
                    'style' => true,
                 ],
                'link' => [
                    'rel'   => true,
                    'id'    => true,
                    'href'  => true,
                    'media' => true,
                 ],
             ];

            $merged_allowed_tags = pbwp_array_merge_recursive_custom( $merged_allowed_tags, $custom_html_tags );
        }
    }

    // Apply filters if needed
    $merged_allowed_tags = apply_filters( 'pbwp_custom_allowed_tags', $merged_allowed_tags );

    return $merged_allowed_tags;

}

function pbwp_array_merge_recursive_custom( $array1, $array2 )
{

    foreach ( $array2 as $key => $value ) {
        if ( is_array( $value ) && isset( $array1[ $key ] ) && is_array( $array1[ $key ] ) ) {
            $array1[ $key ] = pbwp_array_merge_recursive_custom( $array1[ $key ], $value );
        } else {
            $array1[ $key ] = $value;
        }
    }

    return $array1;

}

function pbwp_disable_content_encoding( $args )
{

    $args[ 'headers' ][ 'Accept-Encoding' ] = 'identity';

    return $args;

}

function pbwp_raw_code( $atts )
{

    extract( shortcode_atts( [
        'data'   => '',
        'decode' => true,
     ], $atts ) );

    if ( $decode ) {
        $data = pbwp_base64_decode( $data );
    }

    $content = do_shortcode( $data );

    return $content;

}

function pbwp_footer_notes()
{

    echo "\n".'<!--'."\n";
    echo "__        ______     ____
    \ \      / /  _ \   / ___|___  _ __ ___  _ __   ___  ___  ___ _ __
     \ \ /\ / /| |_) | | |   / _ \| '_ ` _ \| '_ \ / _ \/ __|/ _ \ '__|
      \ V  V / |  __/  | |__| (_) | | | | | | |_) | (_) \__ \  __/ |
       \_/\_/  |_|      \____\___/|_| |_| |_| .__/ \___/|___/\___|_|
                                            |_|
                                            ".PHP_EOL;
    echo '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -'."\n";
    echo esc_html__( 'Page generated by WP Composer plugin', 'page-builder-wp' )."\n";
    echo sprintf(
        esc_html__( ' - Plugin version: %s', 'page-builder-wp' ),
        esc_html( PBWP_VERSION )
    )."\n";
    echo sprintf(
        esc_html__( ' - Plugin URL: %s', 'page-builder-wp' ),
        'https://wpcomposer.com/'
    )."\n";
    echo '-->'."\n";

}
