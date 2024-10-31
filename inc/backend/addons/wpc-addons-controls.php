<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Addon_Control
{

    private static $_instance = null;
    private $addon_control    = null;
    private $new_panel        = null;

    /**
     * Addon Control manager constructor.
     *
     * Initializing WPC Addon Control.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {

        $this->init_controls();

    }

    /**
     * Init controls.
     *
     * @since 1.0.0
     * @access private
     */
    private function init_controls()
    {

        do_action( 'pbwp_addons_control', $this );
        add_filter( 'pbwp_editor_maps', [$this, 'set_main_control'] );
        add_filter( 'pbwp_addons_maps', [$this, 'panel_manager'] );

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

    public function add_general_control( $instance, $controls )
    {

        $addon_params = $instance->addon_params;

        $this->addon_control[$addon_params['base_name']] = array( 'instance' => $instance, 'controls' => $controls );

    }

    public function add_panel( $instance, $panel_data )
    {

        $this->new_panel[uniqid()] = array( 'instance' => $instance, 'params' => $panel_data );

    }

    public function panel_manager( $maps )
    {

        if ( $this->new_panel && is_array( $this->new_panel ) ) {

            foreach ( $this->new_panel as $key => $panel ) {

                $addon_params = $panel['instance']->addon_params;
                $use_label    = false;
                $type         = $panel_id         = $panel_label         = '';
                $panel_fields = array();
                $panel_params = $panel['params'];

                if ( ! pbwp_addons()->is_addon_active( $addon_params['base_name'] ) ) {
                    continue;
                }

                if ( $addon_params && isset( $addon_params['base_name'] ) ) {

                    if ( isset( $panel_params['type'] ) ) {

                        $type     = $panel_params['type'];
                        $panel_id = $type;

                        if ( $type == 'style' ) {

                            if ( isset( $panel_params['mode_group'] ) && $panel_params['mode_group'] ) {
                                $panel_fields = $panel_params['fields'];
                            } else {
                                $panel_fields = array( 'fields' => $panel_params['fields'] );
                            }

                            if ( ! isset( $panel_params['label'] ) ) {
                                $panel_params['label'] = esc_html__( 'STYLING', 'page-builder-wp' );
                            }

                        }

                        if ( $type == 'animate' ) {

                            if ( ! isset( $panel_params['label'] ) ) {
                                $panel_params['label'] = esc_html__( 'ANIMATE', 'page-builder-wp' );
                            }

                        }

                        if ( $type == 'group' ) {

                            $panel_fields = $panel_params['fields'];

                            if ( ! isset( $panel_params['label'] ) ) {
                                $panel_params['label'] = esc_html__( 'GENERAL', 'page-builder-wp' );
                            }

                        }

                    } else {

                        $panel_fields = array( 'fields' => $panel_params['fields'] );
                        $panel_id     = $panel_params['panel_id'];

                        if ( ! isset( $panel_params['label'] ) ) {
                            $panel_params['label'] = esc_html__( 'CUSTOM PANEL', 'page-builder-wp' );
                        }

                    }

                    if ( isset( $panel_params['label'] ) ) {
                        $panel_label = $panel_params['label'];
                        $use_label   = true;
                    }

                    $maps = $this->set_panel( $maps, $addon_params['base_name'], array( 'panel_id' => $panel_id, 'panel_label' => $panel_label, 'panel_fields' => $panel_fields ), $use_label );

                }

            }

        }

        return $maps;

    }

    public function set_main_control( $maps )
    {

        if ( $this->addon_control && is_array( $this->addon_control ) ) {

            foreach ( $this->addon_control as $key => $control ) {

                if ( ! pbwp_addons()->is_addon_active( $key ) ) {
                    continue;
                }

                $addon_params = $control['instance']->addon_params;
                $controls     = $control['controls'];

                if ( $addon_params && isset( $addon_params['base_name'] ) ) {

                    $maps['addons'][$addon_params['base_name']] = array(
                        'tabs'     => array(
                            ( isset( $controls['label'] ) ? $controls['label'] : esc_html__( 'GENERAL', 'page-builder-wp' ) ),
                        ),
                        'template' => array(
                            'general-panel' => array(
                                'fields' => $controls['fields'],
                            ),
                        ),
                    );

                }

            }

        }

        return apply_filters( 'pbwp_addons_maps', $maps );

    }

    public function set_panel( $maps, $base_name, $panel, $add_label = false )
    {

        if ( $base_name ) {

            if ( $add_label ) {
                // Add panel tab
                $maps['addons'][$base_name]['tabs'][] = $panel['panel_label'];
            }

            if ( $this->validate_panel_name( $panel['panel_id'] ) ) {
                // Add panel fields
                $panel_id                                          = $panel['panel_id'].'-panel';
                $maps['addons'][$base_name]['template'][$panel_id] = $panel['panel_fields'];
            }

        }

        return $maps;

    }

    /**
     * Validation custom panel name format.
     *
     *
     * @since 1.0.0
     * @access public
     */
    public function validate_panel_name( $panel_name )
    {

        if ( preg_match( '/^[a-zA-Z0-9]{0,40}$/', $panel_name ) ) {
            return true;
        }

        return false;

    }

}

new PBWP_Addon_Control;