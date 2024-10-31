<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_REST_Api
{

    public function __construct()
    {

        $this->init();

    }

    /**
     * Initialize class features.
     */
    protected function init()
    {
        // Add custom REST API endpoint
        add_action( 'rest_api_init', [ $this, 'pbwp_rest_api_routes' ] );

    }

    // REST API route
    public function pbwp_rest_api_routes()
    {

        register_rest_route( 'wp_composer/v1', '/get/(?P<id>[\d]+)/(?P<cmd>[\w]+)',
            [ 'methods'           => 'GET',
                'callback'            => [ $this, 'pbwp_custom_rest_api_route_callback' ],
                'permission_callback' => '__return_true',
                'args'                => [
                    'id' => [
                        'validate_callback' => function ( $param, $request, $key ) {
                            // This always returns false
                            return absint( $param );
                        },
                     ],
                 ],
             ] );

    }

    public function pbwp_custom_rest_api_route_callback( WP_REST_Request $data )
    {

        $cmd = $data->get_param( 'cmd' );

        if ( isset( $cmd ) && $cmd == 'wpc_session_url' ) {

            $url = $args = $postTTL = $postID = get_admin_url();

            if ( isset( $data[ 'id' ] ) ) {

                $postID    = $data[ 'id' ];
                $permalink = get_permalink( $data[ 'id' ] );
                $postTTL   = get_the_title( $data[ 'id' ] );

                add_filter( 'pbwp_editor_builder_params', function ( $params ) use ( $permalink ) {
                    return $this->pbwp_generate_wpc_session_url_params_filter( $params, $permalink );
                } );

                $url = pbwp_generate_customizer_link( $data[ 'id' ], '', true );

                return wp_send_json( [ 'section' => 'wpc_sections_control', 'postID' => $postID, 'wpc_session' => esc_url( $url ), 'returnURL' => $permalink, 'permalink' => $permalink, 'postTTL' => $postTTL ] );

            }

        }

    }

    public function pbwp_generate_wpc_session_url_params_filter( $params, $url )
    {

        $add = [ 'nonce' => wp_create_nonce( 'wpc-safe-return' ), 'url' => $url ];

        $params = array_merge( $params, [ 'return_params' => $add ] );

        return $params;

    }

}
