<?php
/*
Plugin Name: WP Composer (Lite)
Plugin URI: https://wpcomposer.com/
Description: A WordPress page builder designed for efficiency and speed, allowing quick creation of diverse layouts with streamlined functionality.
Author: PT. GHOZY LAB LLC
Text Domain: page-builder-wp
Domain Path: /languages
Version: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Author URI: https://ghozylab.com/plugins/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Composer
{

    /**
     * Core singleton class
     * @var self - pattern realization
     */
    private static $_instance;

    public $paths;
    public $plugin_name;

    /**
     * Setter for paths
     *
     * @since 1.0.0
     * @access protected
     *
     * @param $paths
     */
    protected function setPaths( $paths )
    {
        $this->paths = $paths;
    }

    /**
     * Gets absolute path for file/directory in filesystem.
     *
     * @since 1.0.0
     * @access public
     *
     * @param $name - name of path dir
     * @param string $file - file name or directory inside path
     *
     * @return string
     */
    public function path( $name, $file = '' )
    {
        $path = $this->paths[ $name ].( strlen( $file ) > 0 ? '/'.preg_replace( '/^\//', '', $file ) : '' );

        return apply_filters( 'pbwp_path_filter', $path );
    }

    public function __construct()
    {

        define( 'PBWP_PATH', dirname( __FILE__ ) );
        define( 'PBWP_NAME', 'WP Composer' );
        define( 'PBWP_ITEM_NAME', PBWP_NAME );
        define( 'PBWP_HUB_URL', 'https://hub.wpcomposer.com' );
        define( 'PBWP_APP_URL', 'https://app.wpcomposer.com' );
        define( 'PBWP_MY_URL', 'https://my.wpcomposer.com' );
        define( 'PBWP_GOOGLE_FONTS_API', 'https://www.googleapis.com/webfonts/v1/webfonts' );
        define( 'PBWP_GOOGLE_FONTS_URL', 'https://fonts.googleapis.com/css?family' );
        define( 'PBWP_GOOGLE_MAPS_API', 'https://maps.google.com/maps/api' );
        define( 'PBWP_YOUTUBE_API', 'https://www.youtube.com/iframe_api' );
        define( 'PBWP_REST_NAMESPACE', 'wp_composer/v1' );
        define( 'PBWP_VERSION', '1.0.3' );
        define( 'PBWP_ICON_LIB_VERSION', '1.0' );
        define( 'PBWP_SHAPE_DIVIDER_VERSION', '1.0.1' );
        define( 'PBWP_FIELD_MAPS_VERSION', '1.1.10' );
        define( 'PBWP_ITEM_META_DATA', false );
        define( 'PBWP_MIN_PHP_VERSION', '7.2' );
        define( 'PBWP_MIN_WP_VERSION', '5.2' );
        define( 'PBWP_DIR', substr( plugin_dir_url( __FILE__ ), 0, -1 ) );
        register_activation_hook( __FILE__, [ $this, '__wpc_go' ] );

        $this->setPaths( [
            'APP_ROOT'             => PBWP_PATH,
            'WP_ROOT'              => preg_replace( '/$\//', '', ABSPATH ),
            'APP_DIR'              => basename( plugin_basename( PBWP_PATH ) ),
            'BACKEND'              => PBWP_PATH.'/inc/backend',
            'BACK_ADDONS'          => PBWP_PATH.'/inc/backend/addons',
            'BACK_PLUGINS'         => PBWP_PATH.'/inc/backend/plugins',
            'BACK_HELPERS'         => PBWP_PATH.'/inc/backend/helpers',
            'BACK_PAGES'           => PBWP_PATH.'/inc/backend/pages',
            'FRONTEND'             => PBWP_PATH.'/inc/frontend',
            'FRONT_CONTENT'        => PBWP_PATH.'/inc/frontend/content',
            'CLASSES_DIR'          => PBWP_PATH.'/inc/backend/classes',
            'CUSTOMIZER_DIR'       => PBWP_PATH.'/inc/backend/customizer',
            'BACK_REST_API'        => PBWP_PATH.'/inc/backend/rest_api',
            'MAP_STYLE_FIELDS'     => PBWP_PATH.'/inc/backend/assets/prop/maps/styles',
            'ASSETS_PROP_BACK_DIR' => PBWP_PATH.'/inc/backend/assets/prop',
            'DIST_DIR'             => '/dist',
            'ASSETS_BACK_DIR'      => '/inc/backend/assets',
            'ASSETS_FRONT_DIR'     => '/inc/frontend/assets',
            'ASSETS_GLOBAL_DIR'    => '/inc/global/assets',
            'SHORTCODES_DIR'       => PBWP_PATH.'/inc/frontend/shortcodes',
            'TEMPLATES_DIR'        => PBWP_PATH.'/inc/frontend/templates',
            'ITEMS_DIR'            => PBWP_PATH.'/inc/frontend/templates/items',
            'GLOBAL_DIR'           => PBWP_PATH.'/inc/global',
            'GLOBAL_VENDOR_DIR'    => PBWP_PATH.'/inc/global/vendors',
         ] );

        // Load all items class
        require_once $this->path( 'ITEMS_DIR', 'wpc-item-loader.php' );
        $this->itemLoader();

        require_once $this->path( 'GLOBAL_DIR', 'wpc-sanitize.php' );
        require_once $this->path( 'GLOBAL_DIR', 'wpc-filters.php' );
        require_once $this->path( 'GLOBAL_DIR', 'wpc-backwards-compatibility.php' );
        require_once $this->path( 'GLOBAL_DIR', 'class-wpc-fonts-manager.php' );
        require_once $this->path( 'GLOBAL_DIR', 'wpc-enqueue-generator.php' );
        require_once $this->path( 'GLOBAL_DIR', 'wpc-helpers.php' );
        require_once $this->path( 'TEMPLATES_DIR', 'wpc-template-helpers.php' );
        require_once $this->path( 'FRONT_CONTENT', 'wpc-content-maker.php' );
        require_once $this->path( 'FRONT_CONTENT', 'wpc-fronteditor-content-maker.php' );
        require_once $this->path( 'GLOBAL_DIR', 'class-wpc-rest-api.php' );
        require_once $this->path( 'BACK_REST_API', 'class-wpc-backend-rest-route.php' );

        /* Add hooks */
        add_action( 'plugins_loaded', [ $this, 'pluginsLoaded' ], 9 );
        add_action( 'init', [ $this, 'init' ] );
        add_filter( 'the_content', 'pbwp_generate_content', 100 );
        add_action( 'admin_bar_menu', 'pbwp_front_edit_link', 100 );
        add_filter( 'plugin_action_links', [ $this, 'pbwp_settings_link' ], 10, 2 );
        add_filter( 'pbwp_notify_count', 'pbwp_set_notify_count' );
        add_action( 'admin_enqueue_scripts', 'pbwp_enqueue_admin_script' );
        add_action( 'do_meta_boxes', 'pbwp_set_metabox' );
        add_action( 'admin_init', [ $this, 'admin_init_redirect' ] );
        add_shortcode( 'pbwp_raw_shortcode', 'pbwp_raw_code' );
        add_action( 'wp_footer', 'pbwp_footer_notes', 1000 );

        $this->setPluginName( $this->path( 'APP_DIR', 'page-builder-wp.php' ) );

    }

    /**
     * @since 1.0.0
     *
     */
    public static function getInstance()
    {

        if ( ! ( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Cloning disabled
     */
    public function __clone()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

    /**
     * Serialization disabled
     */
    public function __sleep()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

    /**
     * De-serialization disabled
     */
    public function __wakeup()
    {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'page-builder-wp' ), '1.0.0.0' );
    }

    /**
     * @since 1.0.0
     *
     */
    public function setPluginName( $name )
    {
        $this->plugin_name = $name;
    }

    /**
     * Get absolute url for WPC asset file.
     *
     * Assets are css, javascript, less files and images.
     *
     * @since 1.0.0
     *
     * @param $file
     *
     * @return string
     */
    public function assetUrl( $file, $backend = false, $custom = false )
    {

        $ASSETS_FRONT_DIR = 'ASSETS_FRONT_DIR';
        if ( $custom ) {
            $ASSETS_FRONT_DIR = $custom;
        }

        return preg_replace( '/\s/', '%20', plugins_url( $this->path(  ( $backend ? 'ASSETS_BACK_DIR' : $ASSETS_FRONT_DIR ), $file ), __FILE__ ) );
    }

    /**
     * Load all items class
     *
     * @since  1.0.0
     * @access private
     */

    private function itemLoader()
    {

        $itemDir = $this->path( 'ITEMS_DIR', '' );

        foreach ( glob( "{$itemDir}/*.php" ) as $filename ) {

            if ( strpos( $filename, 'class-wpc-' ) !== false ) {
                require_once $filename;
            }

        }

    }

    /**
     * Callback function WP plugin_loaded action hook. Loads locale
     *
     * @since  1.0.0
     * @access public
     */
    public function pluginsLoaded()
    {
        /* Setup locale */
        load_plugin_textdomain( 'page-builder-wp', false, $this->path( 'APP_DIR', 'languages' ) );

        PBWP_Page_Templater::get_instance();

    }

    /**
     * Load 3rdparty Addons
     *
     * @since  1.0.0
     * @access public
     */
    public function addons()
    {

        require_once $this->path( 'BACK_ADDONS', 'wpc-addons-manager.php' );
        require_once $this->path( 'BACK_ADDONS', 'wpc-addons-controls.php' );

    }

    /**
     * Load 3rdparty Plugins
     *
     * @since  1.0.0
     * @access public
     */
    public function plugins()
    {

        require_once $this->path( 'BACK_PLUGINS', 'wpc-3rdparty-plugins.php' );

    }

    /**
     * Plugin Init
     *
     * @since  1.0.0
     * @access public
     */
    public function init()
    {

        if ( pbwp_is_maintenance() ) {

            global $pagenow;
            $current_user = wp_get_current_user();

            if ( ! 'wp-login.php' == $pagenow || ! user_can( $current_user, 'administrator' ) ) {
                add_action( 'template_redirect', [ $this, 'pbwp_maintenance_redirect' ] );
            }

        }

        do_action( 'pbwp_before_init' );
        do_action( 'pbwp_addon_init' );

        /* Load Rest API Class */
        new PBWP_REST_Api();
        new PBWP_BACKEND_REST_Route();

        if ( is_admin() ) {

            require_once $this->path( 'BACKEND', 'wpc-ajax.php' );
            require_once $this->path( 'BACKEND', 'wpc-functions.php' );
            require_once $this->path( 'BACK_PAGES', 'wpc-pages-content.php' );
            require_once $this->path( 'BACK_PAGES', 'wpc-welcome.php' );

            if ( current_user_can( 'activate_plugins' ) ) {

                require_once $this->path( 'BACK_PAGES', 'settings/wpc-settings.php' );

            }

            if ( pbwp_get_deprecated_items() ) {
                add_filter( 'pbwp_item_category_list', 'pbwp_insert_deprecated_cat' );
            }

            if ( version_compare( $GLOBALS[ 'wp_version' ], '5.0-beta', '>' ) ) {
                /* WP > 5 beta */
                add_filter( 'use_block_editor_for_post_type', 'pbwp_use_gutenberg', 10, 2 );
            } else {
                /* WP < 5 beta */
                add_filter( 'gutenberg_can_edit_post_type', 'pbwp_use_gutenberg', 10, 2 );
            }

            /* Post list properties */
            add_filter( 'post_row_actions', 'pbwp_custom_action_row', 10, 2 );
            add_filter( 'page_row_actions', 'pbwp_custom_action_row', 10, 2 );
            add_filter( 'display_post_states', 'pbwp_add_post_state', 10, 2 );

        }

        if ( is_customize_preview() && ! pbwp_is_disabled() ) {

            $wpc_session = filter_input( INPUT_GET, 'wpc_session', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

            if ( ! empty( $wpc_session ) ) {
                // Disable WordPress Heartbeat API when user editing the page/post using WP Composer
                wp_deregister_script( 'heartbeat' );
            }

            require_once $this->path( 'BACKEND', 'wpc-i18n.php' );
            require_once $this->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
            require_once $this->path( 'CLASSES_DIR', 'class-wpc-customize-control.php' );
            require_once $this->path( 'BACKEND', 'customizer/wpc-customizer.php' );

            /* Load all supported plugins & addons support files */
            $this->addons();
            $this->plugins();

        }

        do_action( 'pbwp_after_init' );
        do_action( 'pbwp_frontend_template' );

    }

    /**
     * First Load Actions
     *
     * @since  1.0.0
     * @access public
     * Check compatibility from version to version. This function will also checks:
     * PHP and WordPress minimum version
     * New feature
     * New option or available update
     * Add or remove all plugin support
     */
    public function __wpc_go()
    {

        $this->pbwp_check_environment();
        add_option( 'pbwp_plugin_activated', 'wpc-activate' );
        pbwp_upgrade_check();

    }

    /**
     * Admin Init Redirect
     *
     * @since  1.0.0
     * @access public
     */
    public function admin_init_redirect()
    {
        $activated_plugin = get_option( 'pbwp_plugin_activated' );

        if ( $activated_plugin === 'wpc-activate' && current_user_can( 'activate_plugins' ) ) {
            // Remove the option to prevent repeated redirections
            delete_option( 'pbwp_plugin_activated' );
            // Redirect after the 'init' action has occurred
            wp_redirect( admin_url( 'admin.php?page=wpc-welcome' ) );
            exit;
        }
    }

    /**
     * Create Link to setting page in page plugins
     *
     * @since  1.0.0
     * @access public
     */
    public function pbwp_settings_link( $link, $file )
    {

        static $this_plugin;

        if ( ! $this_plugin ) {
            $this_plugin = plugin_basename( __FILE__ );
        }

        if ( $file == $this_plugin ) {
            $settings_link = '<a href="'.add_query_arg( [ 'page' => 'wpc-global-settings' ], admin_url( 'admin.php' ) ).'">'.esc_html__( 'Settings', 'page-builder-wp' ).'</a>';
            array_unshift( $link, $settings_link );
        }

        return $link;

    }

    /**
     * Enable Maintenance Mode
     *
     * @since  1.0.0
     * @access public
     */
    public function pbwp_maintenance_redirect()
    {

        include $this->path( 'TEMPLATES_DIR', 'maintenance/wpc-maintenance.php' );
        exit;

    }

    public function pbwp_check_environment()
    {
        // Check PHP version
        if ( version_compare( phpversion(), PBWP_MIN_PHP_VERSION, '<' ) ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );

            wp_die(
                sprintf(
                    /* translators: %1$s is a placeholder for the php version */
                    esc_html__( 'WP Composer Plugin has been deactivated because it requires PHP version %s or higher for optimal performance. Please upgrade your PHP to ensure compatibility.', 'page-builder-wp' ),
                    esc_html( PBWP_MIN_PHP_VERSION )
                ),
                esc_html__( 'Plugin Deactivated', 'page-builder-wp' ),
                [ 'response' => 400 ]
            );

        }

        // Check WordPress version
        if ( version_compare( get_bloginfo( 'version' ), PBWP_MIN_WP_VERSION, '<' ) ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );

            wp_die(
                sprintf(
                    /* translators: %1$s is a placeholder for the WP version */
                    esc_html__( 'WP Composer Plugin has been deactivated because it requires WordPress version %s or higher for optimal performance. Please upgrade your WordPress to ensure compatibility.', 'page-builder-wp' ),
                    esc_html( PBWP_MIN_WP_VERSION )
                ),
                esc_html__( 'Plugin Deactivated', 'page-builder-wp' ),
                [ 'response' => 400 ]
            );

        }

    }

}

/**
 * @var PBWP_Composer $pbwp_manager - instance of composer management.
 * @since 1.0.0
 */
global $pbwp_manager;

if ( ! $pbwp_manager ) {

    $pbwp_manager = PBWP_Composer::getInstance();

}
