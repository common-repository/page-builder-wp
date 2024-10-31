<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Preset_Parser
{
    private static $_instance;
    private $applyAttachments;
    private $type;
    private $data;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if ( ! ( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function parse( $data, $type, $applyAttachments = false )
    {

        $this->data             = $data;
        $this->type             = $type;
        $this->applyAttachments = $applyAttachments;

        $content = $this->adjust();

        if ( array_key_exists( 'attachments', $content ) ) {

            $content[ 'attachments' ] = [
                'meta' => $content[ 'attachments' ],
             ];

        }

        if ( empty( $content ) ) {
            return false;
        }

        $templateData[ 'preset' ] = [
            'data' => base64_encode( wp_json_encode( $content ) ),
         ];

        return $this->applyAttachments ? $content : $templateData;

    }

    private function adjust()
    {

        $parsed   = '';
        $builders = [  ];

        if ( $this->type === 'rowEDITOR' ) {
            $parsed = $this->parseRow();
        } else {
            $parsed = $this->parseItem();
        }

        $builders = [ 'mainData' => $parsed[ 'data' ] ];

        if ( $this->applyAttachments ) {
            return $parsed[ 'data' ];
        }

        if ( $parsed[ 'fonts' ] && ! empty( $parsed[ 'fonts' ] ) ) {
            $builders[ 'gFonts' ] = $parsed[ 'fonts' ];
        }

        if ( ! empty( $parsed[ 'attachments' ] ) ) {
            $builders[ 'attachments' ] = $parsed[ 'attachments' ];
        }

        return $builders;

    }

    private function parseRow()
    {

        $attachments = [ 'attachments' => [  ] ];

        foreach ( $this->data as $key => $val ) {

            if ( $key === 'advanced' || $key === 'animate' ) {
                continue;
            }

            if ( ! is_array( $key ) && $key === 'img_id' ) {

                if ( $val && $this->applyAttachments && isset( $this->applyAttachments[ $val ] ) ) {
                    $this->data[ 'img_id' ] = $this->applyAttachments[ $val ][ 'attachmentId' ];
                } else {
                    $i_url = wp_get_attachment_image_src( (int) $val, 'full' );

                    if ( isset( $i_url[ 0 ] ) ) {

                        $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                        $_rand                            = $this->generateUid();
                        $this->data[ 'img_id' ]           = $_rand;
                        $attachments[ 'attachments' ][  ] = [
                            'token'     => $this->generateUid(),
                            'replaceTo' => $_rand,
                            'url'       => $image_url,
                         ];
                    }
                }

            }

            if ( $key === 'css' && ! empty( $key ) && is_array( $val ) ) {
                $rowCSS              = $this->parseCss( $this->data[ 'css' ] );
                $this->data[ 'css' ] = $rowCSS[ 'css' ];

                if ( ! $this->applyAttachments && ! empty( $rowCSS[ 'attachments' ] ) ) {
                    $attachments[ 'attachments' ] = $this->mergeAttachments( $attachments[ 'attachments' ], $rowCSS[ 'attachments' ] );
                }

            }

        }

        return [
            'data'        => $this->data,
            'fonts'       => false,
            'attachments' => $this->applyAttachments ? false : $attachments[ 'attachments' ],
         ];

    }

    private function parseItem()
    {

        $g_fonts            = [  ];
        $attachments        = [ 'attachments' => [  ] ];
        $imageKey           = [ 'img_id', 'img_before', 'img_after' ];
        $itemMultipleImages = [ 'imageGallery', 'imageCarousel', 'imageSlider', 'imageFlipster' ];

        foreach ( $this->data as $key => $val ) {

            if ( $key === 'advanced' || $key === 'animate' || $key === 'css' ) {
                continue;
            }

            if ( is_array( $val ) ) {

                foreach ( $val as $k => $v ) {

                    if ( in_array( $k, $imageKey ) ) {

                        $_rand = $this->generateUid();

                        if ( ! $this->applyAttachments ) {

                            if ( in_array( $this->type, $itemMultipleImages ) ) {

                                $img_ids = explode( ',', $v );
                                $group   = [
                                    'replaceTo' => $_rand,
                                    'group'     => true,
                                    'urls'      => [  ],
                                 ];

                                foreach ( $img_ids as $img_ID ) {

                                    $i_url = wp_get_attachment_image_src( (int) $img_ID, 'full' );

                                    if ( isset( $i_url[ 0 ] ) ) {
                                        $group[ 'urls' ][  ] = $this->getAndEncodeImage( $i_url[ 0 ] );
                                    }

                                }

                                $attachments[ 'attachments' ][  ] = $group;

                            } else {

                                $i_url = wp_get_attachment_image_src( (int) $v, 'full' );

                                if ( isset( $i_url[ 0 ] ) ) {

                                    $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                                    $attachments[ 'attachments' ][  ] = [
                                        'token'     => $this->generateUid(),
                                        'replaceTo' => $_rand,
                                        'url'       => $image_url,
                                     ];
                                }

                            }

                        }

                        $this->data[ $key ][ $k ] = $this->applyAttachments && isset( $this->applyAttachments[ $v ] ) ? $this->applyAttachments[ $v ][ 'attachmentId' ] : $_rand;

                    }

                }

            }

        }

        if ( isset( $this->data[ 'css' ] ) && is_array( $this->data[ 'css' ] ) ) {
            $itemCSS = $this->parseCss( $this->data[ 'css' ] );

            if ( ! $this->applyAttachments ) {
                if ( ! empty( $itemCSS[ 'fonts' ] ) ) {
                    $g_fonts = $itemCSS[ 'fonts' ];
                }

                if ( ! empty( $itemCSS[ 'attachments' ] ) ) {
                    $attachments[ 'attachments' ] = $this->mergeAttachments( $attachments[ 'attachments' ], $itemCSS[ 'attachments' ] );
                }
            }
            $this->data[ 'css' ] = $itemCSS[ 'css' ];
        }

        return [
            'data'        => $this->data,
            'fonts'       => $this->applyAttachments ? false : $g_fonts,
            'attachments' => $this->applyAttachments ? false : $attachments[ 'attachments' ],
         ];

    }

    private function mergeAttachments( $attachments, $add )
    {

        foreach ( $add as $attachment ) {
            array_push( $attachments, $attachment );
        }

        return $attachments;

    }

    private function parseCss( $css )
    {

        $modified_css = [ 'css' => '', 'fonts' => [  ], 'attachments' => [  ] ];
        $attch        = $this->applyAttachments;

        array_walk_recursive( $css, function ( &$value, $key ) use ( &$modified_css, &$attch ) {

            if ( ! $attch && strpos( $key, '|font-family' ) !== false && $value ) {
                $modified_css[ 'fonts' ][  ] = rawurlencode( $value );
            }

            if ( strpos( $key, '|background-image' ) !== false && $value ) {
                $i_url = wp_get_attachment_image_src( (int) $value, 'full' );

                if ( $attch && isset( $attch[ $value ] ) ) {
                    $value = $attch[ $value ][ 'attachmentId' ];
                } else {
                    if ( isset( $i_url[ 0 ] ) ) {

                        $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                        $_rand                             = $this->generateUid();
                        $modified_css[ 'attachments' ][  ] = [
                            'token'     => $this->generateUid(),
                            'replaceTo' => $_rand,
                            'url'       => $image_url,
                         ];
                        $value = $_rand;
                    }
                }
            }

        } );

        if ( ! $attch && ! empty( $modified_css[ 'fonts' ] ) ) {

            $user_fonts = $this->getOptions( 'user_fonts' );
            $used_fonts = [  ];

            if ( is_array( $user_fonts ) && count( $user_fonts ) !== 0 ) {

                foreach ( $modified_css[ 'fonts' ] as $font ) {

                    if ( isset( $user_fonts[ $font ] ) ) {
                        $used_fonts[ $font ] = $user_fonts[ $font ];
                    }

                }

                $modified_css[ 'fonts' ] = $used_fonts;
            } else {
                unset( $modified_css[ 'fonts' ] );
            }

        }

        $modified_css[ 'css' ] = $css;

        return $modified_css;

    }

    // Get WP Composer Global options
    private function getOptions( $opt )
    {

        $t_opt = get_option( 'pbwp_globals' );

        if ( isset( $t_opt ) && is_array( $t_opt ) && array_key_exists( $opt, $t_opt ) ) {
            return $t_opt[ $opt ];
        }

        return false;

    }

    private function generateUid( $length = 7 )
    {

        $_charcode = '';

        $_chars = md5( uniqid( wp_rand(), true ) );

        for ( $l = 0; $l < $length; $l++ ) {

            $temp = str_shuffle( $_chars );
            $_charcode .= $temp[ 0 ];

        }

        // Check if the first character is a number
        if ( is_numeric( $_charcode[ 0 ] ) ) {
            $_charcode[ 0 ] = chr( wp_rand( 97, 122 ) ); // ASCII values for lowercase letters
        }

        return $_charcode;

    }

    private function getAndEncodeImage( $image_url )
    {

        $request_args = [
            'sslverify' => false, // Disables SSL verification
         ];

        $response = wp_remote_get( $image_url, $request_args );

        if ( ! is_wp_error( $response ) && $response[ 'response' ][ 'code' ] == 200 ) {
            $image_data   = wp_remote_retrieve_body( $response );
            $image_base64 = base64_encode( $image_data );

            return $image_base64;
        } else {
            return 'iVBORw0KGgoAAAANSUhEUgAAAZAAAADIBAMAAAA0O6rRAAAAG1BMVEXsPWL////1nrD6ztfuVXX3tsTzhZz85uvwbYkxzgFbAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEc0lEQVR4nO2XS2/bOBRGWb+XvXZseWkHKTrLKMgPkKcFsrXSQbqNF4Nuo+m0ydIaYJC/PfdBUrL8GKvZfgdIQitXvDwUSV07BwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC04h0t+Pfy1j4tr8P1wXMWWl9JyVxJnvf6j3xtAX26DmHJDd/VCWGkAfEu+fBnwY3vV06iLnwCGrv+1LfziY9Pfmx/QaRH1lGPZuH6irxTp6DDIiOa1ERC2PikyEffXDREypAtihBN2pmoyECGqUOahOtpcErDOPZF6LYSiWG3J0S6oTnJmiKTrClSTer5In2dI3kM5C+zWqJdc+7JpSJDurfmYidERHzYB/7jRtz4SH/x762J3IcO2PaGGznxHTsiG6K/KxGJ/8BPeNta5B3Rk3xYxpvvwnxuaJyF2HKnaxax7CISwjp+SrrW4e5dfMeVszzjPRGbFBXR+FEaA84XKf1zLPzouUP6RnO79BhjmyKJZReRGFZa+oMiw7BaeFVmDZHCJqUS4S7GrUWWlCY6tInPzxuZx6mNaRXbFJlbdhapwjqW/qBIGaaJEy4aIq82KTWRng6gnUgx3cjdQ3rwvQ/5b2q7p/Z8myIXd5qdRaqwnp0XB0VyO1KcnokNkc82KTURtq2nO0eET92hnDwlffYPn2eMk134AW38IcIpVtrcepGeZmeR2rj12TZEOrLXr/y//L8bIplNSl2krK3q80R4SAPZEemUn41c1KfakbntiuBREfeJkq2JxDdpTvsietfcpfFw79P7pkgvpZddkVVrkT5nZYMe5wrDkI2eckf/I8Ix86bIgSdyQGTvicgJvn2jyJB/lpTJ6WO9bHRXlrxuxNH9o2+IWVwkl1kUkey6R04uLS+SH1xaUk6IiE7K25aW3LqixYr/WOlVUPb6/FzwUdSxQ1iOr9n+ZneavS8714eFaufgZq9274rW8ZYoIpNSF6nOhnNFlqSrdpn4PdHnrq3k2MZz9ZgIFwX/7h6/s6Mi9eP3cRReE2KkIjzy+duOX1m7PRoXM1/KcQk3sHLnSTfKKRHOnrB8Wr0Qn46KdKsXYsIJ/YTfcaiJ8KQU9Rdiq2KLRazmzbVM0XZae7eWNM1OinB23VsWxiXK41ERfqH/oY2lZMnpp14seCpNRMZQL1FiF2eK2IhKq5IK2Rd+nfS0krCi0Tb7btF44UelJWAoGqfuqIiE+qJxrRXq5P7ySyHvDy/SMREtGlNqtUVExI6crlW+fLKsfCUqia8lOcXjt17GB5GOiFRh6xMiscAX21H4MHdBhHuplfEvbTxEZKjJ/ebjWiWPx55UefzoT4tw9rWLYT/dCRH3akGJJvjkpbJKRBZDyGJrtY2Iz5Rf2+ffqm9XWjiGr7pHRQbPcr991X1wJ0Xsq+4PP1G/fy3o+0PmKhH37SV81b2p3QUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAtOY/JE0EYEjpe80AAAAASUVORK5CYII=';
        }

    }

}
