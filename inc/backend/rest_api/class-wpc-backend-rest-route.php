<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_BACKEND_REST_Route
{

    protected $current_user;

    public function __construct()
    {

        $this->init();

    }

    /**
     * Initialize class features.
     */
    protected function init()
    {
        /* Add custom REST API endpoint */
        add_action( 'rest_api_init', [ $this, 'pbwp_backend_rest_api_routes' ] );

    }

    /* REST API route */
    public function pbwp_backend_rest_api_routes()
    {

        $this->current_user = wp_get_current_user();

        if ( ! class_exists( 'PBWP_Rest_Api_Callback' ) ) {
            require_once pbwp_manager()->path( 'BACK_REST_API', 'callback/class-wpc-rest-api-callback.php' );
        }

        $cb = new PBWP_Rest_Api_Callback();

        /* All Builder Data Management */
        register_rest_route( PBWP_REST_NAMESPACE, '/data',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'data' ],
                'permission_callback' => function ( $request ) {
                    return is_customize_preview() || user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* All Builder Actions and Functions */
        register_rest_route( PBWP_REST_NAMESPACE, '/builder',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'builder' ],
                'permission_callback' => function ( $request ) {
                    return is_customize_preview() || user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* All Elements / items Management */
        register_rest_route( PBWP_REST_NAMESPACE, '/element',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'element' ],
                'permission_callback' => function ( $request ) {
                    return is_customize_preview();
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* All Media Management */
        register_rest_route( PBWP_REST_NAMESPACE, '/media',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'media' ],
                'permission_callback' => function ( $request ) {
                    return is_customize_preview() || user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* All Enduser Interactions */
        register_rest_route( PBWP_REST_NAMESPACE, '/actions',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'actions' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* Fonts Management */
        register_rest_route( PBWP_REST_NAMESPACE, '/fonts',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'fonts' ],
                'permission_callback' => function ( $request ) {
                    return is_customize_preview() || user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ] );

        /* Templates Management POST method */
        register_rest_route( PBWP_REST_NAMESPACE, '/templates',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'templates' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

        /* Presets Management POST method */
        register_rest_route( PBWP_REST_NAMESPACE, '/presets',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'presets' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

        /* Hub Management POST method */
        register_rest_route( PBWP_REST_NAMESPACE, '/hub',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'hub' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

        /* My Management POST method */
        register_rest_route( PBWP_REST_NAMESPACE, '/my',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'my' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

        /* Cloud Management POST method */
        register_rest_route( PBWP_REST_NAMESPACE, '/cloud',
            [ 'methods'           => 'POST',
                'callback'            => [ $cb, 'cloud' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'data' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

        /* Backup Management GET method with parameters */
        register_rest_route( PBWP_REST_NAMESPACE, '/backup/(?P<nonce>[a-zA-Z0-9]+)/(?P<name>[a-zA-Z0-9-_]+)/(?P<signature>[a-zA-Z0-9-_=]+)',
            [ 'methods'           => 'GET',
                'callback'            => [ $cb, 'backup' ],
                'permission_callback' => function ( $request ) {
                    return user_can( $this->current_user, 'edit_theme_options' );
                },
                'args'                => [
                    'nonce'     => [
                        'required'          => true,
                        'validate_callback' => function ( $param, $request, $key ) {
                            return wp_verify_nonce( sanitize_text_field( wp_unslash( $param ) ), 'wpc_ajax_nonce' );
                        },
                     ],
                    'name'      => [
                        'required' => true,
                     ],
                    'signature' => [
                        'required' => true,
                     ],
                 ],
             ]
        );

    }

}
