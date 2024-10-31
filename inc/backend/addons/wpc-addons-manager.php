<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Addons_Manager
{

    public $base_name     = null;
    public $addons_config = null;

    /**
     * Core singleton class
     * @var self - pattern realization
     */
    private static $_instance;

    /**
     * Addon types.
     *
     * Holds the list of all the addon types.
     *
     * @since 1.0.0
     * @access private
     *
     */
    private $_addons_types = null;

    /**
     * Addons manager constructor.
     *
     * Initializing WPC addons manager.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {

        $this->init_addons();

    }

    /**
     * Init addons.
     *
     * and register each addon.
     *
     * @since 1.0.0
     * @access private
     */
    private function init_addons()
    {

        $this->_addons_types = [];
        $this->addons_config = [];

        do_action( 'pbwp_register_addon', $this );

        // Load addons if available
        $this->set_addons();

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

    public function register( $addon_instance )
    {

        if ( is_null( $this->_addons_types ) ) {
            $this->init_addons();
        }

        $this->insert_addon( $addon_instance );

        return true;

    }

    /**
     * Unregister addon type.
     *
     * Removes addon type from the list of registered addon types.
     *
     * @since 1.0.0
     * @access public
     *
     * @param string $name addon base_name.
     *
     * @return boolean Whether the addon was unregistered.
     */
    public function unregister( $name )
    {

        if ( ! isset( $this->_addons_types[$name] ) ) {
            return false;
        }

        unset( $this->_addons_types[$name] );

        return true;

    }

    /**
     * Insert an addon.
     *
     *
     * @since 1.0.0
     * @access private
     */
    private function insert_addon( $instance )
    {

        $addon_params = $instance->addon_params;

        if ( $addon_params ) {
            $base_name = $addon_params['base_name'];

            if ( ! $this->is_addon_active( $base_name ) ) {

                if ( $this->validate_base_name( $base_name ) ) {
                    $this->_addons_types[$base_name] = $instance;
                }

            }

        } else {
            return false;
        }

    }

    public function set_addons()
    {

        $addons = $this->get_addons();

        if ( $addons ) {

            foreach ( $addons as $key => $addon ) {
                $this->addons_config[$key] = $addon->addon_params;
            }

            add_filter( 'pbwp_item_category_list', [$this, 'add_custom_category'] );
            add_filter( 'pbwp_item_list', [$this, 'insert_to_item_list'] );
            add_filter( 'pbwp_supported_addons_list', [$this, 'insert_to_addons_list'] );

        }

    }

    public function insert_to_item_list( $items )
    {

        if ( $this->addons_config ) {

            foreach ( $this->addons_config as $key => $config ) {

                if ( isset( $config['base_name'] ) ) {
                    $category = isset( $config['custom_category'] ) && is_array( $config['custom_category'] ) && isset( $config['custom_category']['slug'] ) ? $config['custom_category']['slug'] : ( isset( $config['category'] ) ? $config['category'] : 'content' );

                    $items[$config['base_name']] = array( 'name' => $config['addon_name'], 'category' => $category );
                }

            }

            return $items;

        }

        return $items;

    }

    public function insert_to_addons_list( $list )
    {

        if ( $this->addons_config ) {

            foreach ( $this->addons_config as $key => $config ) {

                if ( isset( $config['base_name'] ) ) {
                    $list = array_merge( array( $config['base_name'] ), $list );
                }

            }

            return $list;

        }

        return $list;

    }

    public function add_custom_category( $cats )
    {

        if ( $this->addons_config ) {

            foreach ( $this->addons_config as $key => $config ) {

                if ( isset( $config['custom_category'] ) && is_array( $config['custom_category'] ) ) {
                    $cats[$config['custom_category']['slug']] = $config['custom_category']['name'];
                }

            }

            return $cats;

        }

        return $cats;

    }

    /**
     * Get addons.
     *
     *
     * @since 1.0.0
     * @access public
     */
    public function get_addons( $type = '' )
    {

        if ( is_null( $this->_addons_types ) ) {
            $this->init_addons();
        }

        if ( $type ) {
            return isset( $this->_addons_types[$type] ) ? $this->_addons_types[$type] : null;
        }

        return $this->_addons_types;

    }

    /**
     * Get addons.
     *
     *
     * @since 1.0.0
     * @access public
     */
    public function get_addons_basename()
    {

        if ( is_null( $this->_addons_types ) ) {
            $this->init_addons();
        }

        if ( $this->_addons_types ) {

            return array_keys( $this->_addons_types );

        }

        return $this->_addons_types;

    }

    /**
     * Get addon types config.
     *
     * Retrieve all the registered addons with config for each addons.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Registered addon types with each addon config.
     */
    public function get_addon_config( $type )
    {

        if ( $type ) {
            return $this->get_addons( $type ) ? $this->get_addons( $type )->addon_params : null;
        }

        return false;

    }

    /**
     * Get addon base_name by $instance.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array base_name.
     */
    public function get_addon_base_by_instance( $instance )
    {

        $addons          = $this->get_addons();
        $instance_params = isset( $instance->addon_params ) ? $instance->addon_params : null;

        if ( $instance_params && isset( $instance_params['base_name'] ) && array_key_exists( $instance_params['base_name'], $addons ) ) {
            return $instance_params['base_name'];
        }

        return false;

    }

    /**
     * Get addons status.
     *
     *
     * @since 1.0.0
     * @access public
     */
    public function is_addon_active( $type )
    {

        if ( array_key_exists( $type, $this->_addons_types ) ) {
            return true;
        }

        return false;

    }

    /**
     * Validation base_name name format.
     *
     *
     * @since 1.0.0
     * @access public
     */
    public function validate_base_name( $base_name )
    {

        if ( preg_match( '/^[a-zA-Z0-9\_]{0,40}$/', $base_name ) ) {
            return true;
        }

        return false;

    }

}

new PBWP_Addons_Manager;