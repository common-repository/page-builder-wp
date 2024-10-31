<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Fonts_Manager
{

    private static $instance = null;

    private function __construct()
    {

    }

    public static function get_instance()
    {

        if ( self::$instance === null ) {
            self::$instance = new PBWP_Fonts_Manager();
        }

        return self::$instance;

    }

    public static function pbwp_filesystem()
    {

        global $wp_filesystem;

        if ( ! function_exists( '\WP_Filesystem' ) ) {
            include ABSPATH.'wp-admin/includes/file.php';
        }

        \WP_Filesystem();

        return $wp_filesystem;

    }

    public static function create( $fonts )
    {

        $user_fonts = self::get_fonts();
        $uri        = self::get_font_url();
        $used_fonts = [  ];

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

            self::set_local( $uri.$params );

        }

    }

    public static function get_folder()
    {

        $wpUploadDir   = wp_upload_dir();
        $upload_dir    = wp_get_upload_dir();
        $slugOfBaseUrl = str_replace( [
            'http://',
            'https://',
         ], '', $wpUploadDir[ 'baseurl' ] );

        // replace wp-content/uploads with ''
        $slugOfBaseUrl = str_replace( 'wp-content/uploads', '', $slugOfBaseUrl );
        $slugOfBaseUrl = sanitize_title( $slugOfBaseUrl );

        $folder = $upload_dir[ 'error' ] ? WP_CONTENT_DIR.'/uploads/wpc-fonts/'.$slugOfBaseUrl : $upload_dir[ 'basedir' ].'/wpc-fonts/'.$slugOfBaseUrl;

        return $folder;

    }

    public static function set_local( $src )
    {

        if ( self::get_settings( 'local_fonts' ) !== 'active' ) {
            return $src;
        }

        $src = urldecode( $src );
        preg_match( '/family=([^&:]+)/', $src, $matches );
        $fontSlug = strtolower( sanitize_title( $matches[ 1 ] ) );

        $wpUploadDir   = wp_upload_dir();
        $slugOfBaseUrl = str_replace( [
            'http://',
            'https://',
         ], '', $wpUploadDir[ 'baseurl' ] );

        $slugOfBaseUrl      = str_replace( 'wp-content/uploads', '', $slugOfBaseUrl );
        $slugOfBaseUrl      = sanitize_title( $slugOfBaseUrl );
        $src                = preg_replace( '/&ver=[^&]+/', '', $src );
        $srcChecksum        = 'wpc-google-fonts-'.$fontSlug;
        $font_base_dir      = $wpUploadDir[ 'basedir' ].'/wpc-fonts';
        $font_base_dir_slug = $font_base_dir.'/'.$slugOfBaseUrl;
        $fontFile           = $font_base_dir_slug.'/'.$fontSlug.'/'.$srcChecksum.'.css';
        $font_base_url      = $wpUploadDir[ 'baseurl' ].'/wpc-fonts/'.$slugOfBaseUrl.'/'.$fontSlug.'/';

        // use wp filesystem to check if file exists
        $filesystem = self::pbwp_filesystem();

        if ( ! is_object( $filesystem ) ) {
            return $src;
        }

        if ( ! $filesystem->is_dir( $font_base_dir ) ) {
            $filesystem->mkdir( $font_base_dir );
        }

        if ( ! $filesystem->is_dir( $font_base_dir_slug ) ) {
            $filesystem->mkdir( $font_base_dir_slug );
        }

        if ( ! $filesystem->is_dir( $font_base_dir_slug.'/'.$fontSlug ) ) {
            $filesystem->mkdir( $font_base_dir_slug.'/'.$fontSlug );
        }

        if ( ! $filesystem->exists( $fontFile ) ) {
            // if file doesn't exist, download it
            $fontContents = self::get_font_css_from_url( $src );

            $filesystem->put_contents( $fontFile, self::generate_fonts_css( $fontContents, $font_base_dir_slug.'/'.$fontSlug ) );

        }

        return $font_base_url.$srcChecksum.'.css';

    }

    public static function generate_fonts_css( $css, $font_base_dir, $minify = true )
    {

        $filesystem   = self::pbwp_filesystem();
        $font_version = '';
        $pbwpcss      = self::pbwpcss();

        if ( $minify ) {

            $pbwpcss->set_cfg( 'optimise_shorthands', 1 );
            $pbwpcss->set_cfg( 'template', apply_filters( 'pbwp_css_compress_level', 'highest' ) );

        }

        $pbwpcss->parse( $css );
        $font_urls = [  ];
        $fonts_css = $pbwpcss->css;

        foreach ( $fonts_css as $key => $all_fonts ) {

            foreach ( $all_fonts as $k => $each_font ) {

                $srctmp = '';

                if ( isset( $each_font[ 'src' ] ) ) {

                    if ( $font_version === '' ) {

                        if ( preg_match( '/v(\d+)/', $each_font[ 'src' ], $m ) ) {
                            $font_version = 'v'.$m[ 1 ];
                        }

                    }

                    if ( preg_match( '/url\(([^\)]*)\)/', $each_font[ 'src' ], $m ) ) {
                        $srctmp = $m[ 1 ];
                    }

                    if ( ! in_array( $srctmp, $font_urls ) ) {
                        $font_urls[  ] = $srctmp;
                    }

                    $all_fonts[ $k ][ 'src' ] = 'url('.basename( $each_font[ 'src' ] );

                }

            }

            $fonts_css[ $key ] = $all_fonts;

        }

        $pbwpcss->css = $fonts_css;
        $finalcss     = $pbwpcss->print->plain();

        foreach ( $font_urls as $url ) {

            if ( ! $filesystem->exists( $font_base_dir.'/'.basename( $url ) ) ) {

                self::download_fonts( $url, $font_base_dir );

            }

        }

        // Set font version
        $filesystem->put_contents( $font_base_dir.'/version.txt', $font_version );

        return $finalcss;

    }

    public static function download_fonts( $url, $font_base_dir )
    {

        $filesystem   = self::pbwp_filesystem();
        $fileContents = wp_remote_get( $url, [
            'sslverify' => false,
            'timeout'   => 30,
         ] );

        if ( is_wp_error( $fileContents ) ) {
            $fileContents = wp_remote_get( $url, [
                'timeout' => 30,
             ] );

            if ( is_wp_error( $fileContents ) ) {
                return false;
            }

        }

        $filesystem->put_contents( $font_base_dir.'/'.basename( $url ), $fileContents[ 'body' ] );

        return true;

    }

    public static function remove_font( $font_folder )
    {

        $folder        = self::get_folder();
        $WP_Filesystem = self::pbwp_filesystem();

        if ( $WP_Filesystem->is_dir( $folder.'/'.$font_folder ) ) {

            $WP_Filesystem->delete( $folder.'/'.$font_folder, true );

        }

    }

    public static function fonts_manage( $font_data )
    {

        if ( self::get_settings( 'local_fonts' ) !== 'active' ) {
            return;
        }

        $font_type = $font_data[ 'font_data' ][ 'family' ];
        $font_type = urldecode( $font_type );
        $font_type = strtolower( sanitize_title( $font_type ) );

        switch ( $font_data[ 'cmd' ] ) {

            case 'add':

                self::create( [ $font_data[ 'font_data' ][ 'family' ] ] );

                break;

            case 'update':

                self::remove_font( $font_type );

                self::create( [ $font_data[ 'font_data' ][ 'family' ] ] );

                break;

            case 'delete':

                self::remove_font( $font_type );

                break;

            default:
                break;

        }

    }

    public static function fonts_update()
    {

        if ( self::get_settings( 'local_fonts' ) !== 'active' ) {
            return esc_html__( 'Please enable Local Google Fonts option first from General Settings', 'page-builder-wp' );
        }

        $all_fonts = self::get_fonts();

        if ( ! empty( $all_fonts ) ) {

            $folder        = self::get_folder();
            $WP_Filesystem = self::pbwp_filesystem();

            foreach ( array_keys( $all_fonts ) as $font ) {

                $font_name = strtolower( sanitize_title( rawurldecode( $font ) ) );

                if ( $WP_Filesystem->is_dir( $folder.'/'.$font_name ) && $WP_Filesystem->exists( $folder.'/'.$font_name.'/version.txt' ) ) {

                    $v = $WP_Filesystem->get_contents( $folder.'/'.$font_name.'/version.txt' );

                    if ( $v !== false ) {
                        $current_version = str_replace( 'v', '', $v );
                        // No need to fclose when using WP_Filesystem
                    }

                    $latest_version = self::get_latest_font_version( $font );

                    if ( is_numeric( $current_version ) ) {

                        if ( version_compare( $latest_version, $current_version, '>' ) ) {

                            self::remove_font( $font_name );
                            self::create( [ $font ] );

                        } else {
                            continue;
                        }

                    }

                } else {
                    self::create( [ $font ] );
                }

            }

            return esc_html__( 'All fonts have been successfully updated', 'page-builder-wp' );

        }

        return false;

    }

    public static function get_latest_font_version( $font_name )
    {

        $font_url = self::get_font_url();
        $css      = self::get_font_css_from_url( $font_url.$font_name );
        $pbwpcss  = self::pbwpcss();

        $pbwpcss->parse( $css );
        $fonts_css    = $pbwpcss->css;
        $font_version = '';

        foreach ( $fonts_css as $all_fonts ) {

            foreach ( $all_fonts as $each_font ) {

                if ( isset( $each_font[ 'src' ] ) ) {

                    if ( $font_version === '' ) {

                        if ( preg_match( '/v(\d+)/', $each_font[ 'src' ], $m ) ) {
                            return $m[ 1 ];
                        }

                    }

                }

            }

        }

        return false;

    }

    public static function get_font_css_from_url( $src )
    {

        $format = self::get_settings( 'local_fonts_format', 'woff2' );

        $fontContents = wp_remote_get( esc_url_raw( $src ), [
            'timeout'    => 30,
            'user-agent' => self::set_user_agent( $format ),
         ] );

        if ( is_wp_error( $fontContents ) ) {
            // try again
            $fontContents = wp_remote_get( esc_url_raw( $src ), [
                'timeout'    => 30,
                'user-agent' => self::set_user_agent( $format ),
             ] );

            if ( is_wp_error( $fontContents ) ) {
                return $src;
            }

        }

        return wp_remote_retrieve_body( $fontContents );

    }

    public static function get_settings( $opt, $default = false )
    {

        $general_sst = pbwp_front_get_option( 'stt_general' );

        if ( isset( $general_sst[ $opt ] ) && $general_sst[ $opt ] ) {
            return $general_sst[ $opt ];
        }

        return $default;

    }

    public static function get_fonts()
    {

        $fonts = pbwp_front_get_option( 'user_fonts' );

        if ( isset( $fonts ) && is_array( $fonts ) && count( $fonts ) > 0 ) {
            return $fonts;
        } else {
            return [  ];
        }

    }

    public static function get_font_url()
    {

        return apply_filters( 'pbwp_google_font_url', PBWP_GOOGLE_FONTS_URL.'=' );

    }

    public static function pbwpcss()
    {

        if ( ! class_exists( 'pbwpcss' ) ) {
            include_once pbwp_manager()->path( 'GLOBAL_VENDOR_DIR', '/pbwpcss/class.pbwpcss.php' );
        }

        return new pbwpcss();

    }

    public static function set_user_agent( $format )
    {

        $format = apply_filters( 'pbwp_google_fonts_format', $format );

        $user_agents = [
            'eot'   => 'Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.1; Trident/4.0; GTB7.4; InfoPath.2; SV1; .NET CLR 3.3.69573; WOW64; en-US)',
            'ttf'   => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; de-at) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1',
            'svg'   => 'Mozilla/5.0(iPad; U; CPU iPhone OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B314 Safari/531.21.10gin_lib.cc',
            'woff'  => 'Mozilla/5.0 (iPad; CPU OS 6_0 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10A5355d Safari/8536.25',
            'woff2' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',
         ];

        if ( isset( $user_agents[ $format ] ) ) {
            return $user_agents[ $format ];
        }

        return null;

    }

}

PBWP_Fonts_Manager::get_instance();
