<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Template_Parser
{
    private static $_instance;
    private $applyAttachments;
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

    public function parse( $id, $data = null, $applyAttachments = false )
    {

        $this->data             = $data;
        $this->applyAttachments = $applyAttachments;

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $all_templates = pbwp_get_option( 'user_templates' );

        $mainData[ 'builder' ] = [  ];

        if ( $this->data ) {
            $mainData[ 'builder' ] = $this->data;
        } else {
            $key = array_search( $id, array_column( $all_templates, 'id' ) );

            if ( isset( $all_templates[ $key ] ) && $all_templates[ $key ][ 'id' ] === $id ) {
                $templateData          = $all_templates[ $key ];
                $builders              = base64_decode( $templateData[ 'template' ] );
                $builders              = json_decode( $builders, true );
                $mainData[ 'builder' ] = $builders;
            } else {
                return false;
            }
        }

        $pid  = $id;
        $type = 'template';

        $content = $this->adjust( $mainData, $pid, $type, false );

        if ( array_key_exists( 'innerRow', $content ) ) {

            foreach ( $content[ 'innerRow' ] as $key => $eachInner ) {

                $tempInnerRow = $this->adjust( $mainData, $eachInner, 'deepScan', true );

                $content[ 'mainData' ] = array_merge( $content[ 'mainData' ], $tempInnerRow[ 'mainData' ] );

                if ( array_key_exists( 'gFonts', $tempInnerRow ) ) {
                    $content[ 'gFonts' ] = array_unique( array_merge( $content[ 'gFonts' ], $tempInnerRow[ 'gFonts' ] ) );
                }

                if ( array_key_exists( 'attachments', $tempInnerRow ) ) {
                    $content[ 'attachments' ] = array_unique( array_merge( $content[ 'attachments' ], $tempInnerRow[ 'attachments' ] ) );
                }

            }

            unset( $content[ 'innerRow' ] );

        }

        if ( array_key_exists( 'attachments', $content ) ) {

            $content[ 'attachments' ] = [
                'meta' => $content[ 'attachments' ],
             ];

        }

        /* Change all elements id */
        if ( empty( $content ) ) {
            return false;
        } else {
            $content = $this->applyAttachments ? $content : $this->changeId( $content );
        }

        $templateData[ 'template' ] = [
            'data' => base64_encode( wp_json_encode( $content ) ),
         ];

        return $this->applyAttachments ? $content : $templateData;

    }

    private function adjust( $builders, $pid, $type, $rowInnerGet = false )
    {

        $is_innerRow        = $is_presets        = [  ];
        $g_fonts            = [ 'fonts' => [  ] ];
        $attachments        = [ 'attachments' => [  ] ];
        $imageKey           = [ 'img_id', 'img_before', 'img_after' ];
        $itemMultipleImages = [ 'imageGallery', 'imageCarousel', 'imageSlider', 'imageFlipster' ];

        if ( ! isset( $builders[ 'builder' ] ) || ! is_array( $builders[ 'builder' ] ) ) {
            return [  ];
        }

        foreach ( $builders[ 'builder' ] as $key => $val ) {

            if ( $type == 'deepScan' ) {

                if ( $val[ 'id' ] != $pid && ! $rowInnerGet ) {
                    continue;
                }

                if ( $val[ 'inner_of' ] != $pid && $rowInnerGet ) {
                    continue;
                }

            }

            if ( isset( $val[ 'config' ] ) ) {

                $rowConfig = $val[ 'config' ];

                if ( isset( $rowConfig[ 'img_id' ] ) && $rowConfig[ 'img_id' ] ) {

                    if ( $this->applyAttachments && isset( $this->applyAttachments[ $rowConfig[ 'img_id' ] ] ) ) {
                        $builders[ 'builder' ][ $key ][ 'config' ][ 'img_id' ] = $this->applyAttachments[ $rowConfig[ 'img_id' ] ][ 'attachmentId' ];
                    } else {
                        $i_url = wp_get_attachment_image_src( (int) $rowConfig[ 'img_id' ], 'full' );

                        if ( isset( $i_url[ 0 ] ) ) {

                            $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                            $_rand                                                 = $this->generateUid();
                            $builders[ 'builder' ][ $key ][ 'config' ][ 'img_id' ] = $_rand;
                            $attachments[ 'attachments' ][  ]                      = [
                                'replaceTo' => $_rand,
                                'url'       => $image_url,
                             ];
                        }
                    }

                }

                if ( isset( $rowConfig[ 'css' ] ) && ! empty( $rowConfig[ 'css' ] ) ) {
                    $rowCSS                                             = $this->parseCss( $rowConfig[ 'css' ] );
                    $builders[ 'builder' ][ $key ][ 'config' ][ 'css' ] = $rowCSS[ 'css' ];

                    if ( ! $this->applyAttachments && ! empty( $rowCSS[ 'attachments' ] ) ) {
                        $attachments[ 'attachments' ] = $this->mergeAttachments( $attachments[ 'attachments' ], $rowCSS[ 'attachments' ] );
                    }

                }

            }

            foreach ( $val[ 'row_cols' ] as $ky => $vl ) {

                $colConfig = ! isset( $vl[ 'config' ] ) ? [  ] : $vl[ 'config' ];

                if ( isset( $colConfig[ 'img_id' ] ) && $colConfig[ 'img_id' ] ) {

                    if ( $this->applyAttachments && isset( $this->applyAttachments[ $colConfig[ 'img_id' ] ] ) ) {
                        $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'config' ][ 'img_id' ] = $this->applyAttachments[ $colConfig[ 'img_id' ] ][ 'attachmentId' ];
                    } else {
                        $i_url = wp_get_attachment_image_src( (int) $colConfig[ 'img_id' ], 'full' );

                        if ( isset( $i_url[ 0 ] ) ) {

                            $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                            $_rand                                                                      = $this->generateUid();
                            $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'config' ][ 'img_id' ] = $_rand;
                            $attachments[ 'attachments' ][  ]                                           = [
                                'replaceTo' => $_rand,
                                'url'       => $image_url,
                             ];
                        }
                    }

                }

                if ( ! isset( $vl[ 'items' ] ) ) {
                    $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'items' ][  ] = [  ];
                    continue;
                }

                foreach ( $vl[ 'items' ] as $k => $v ) {

                    if ( $v[ 'type' ] == 'rowInner' ) {
                        $is_innerRow[  ] = $v[ 'id' ];
                        continue;
                    }

                    if ( ! isset( $v[ 'config' ][ 'general' ] ) || $v[ 'config' ] == 'default' ) {
                        continue;
                    }

                    $configKey  = strtolower( 'general' );
                    $itemConfig = $v[ 'config' ][ $configKey ];

                    foreach ( $itemConfig as $ic => $iv ) {

                        if ( isset( $ic ) && $ic != '' && in_array( $ic, $imageKey ) ) {

                            $_rand = $this->generateUid();

                            if ( ! $this->applyAttachments ) {

                                if ( in_array( $v[ 'type' ], $itemMultipleImages ) ) {

                                    $img_ids = explode( ',', $iv );
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

                                    $i_url = wp_get_attachment_image_src( (int) $iv, 'full' );

                                    if ( isset( $i_url[ 0 ] ) ) {

                                        $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                                        $attachments[ 'attachments' ][  ] = [
                                            'replaceTo' => $_rand,
                                            'url'       => $image_url,
                                         ];
                                    }

                                }

                            }

                            $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'items' ][ $k ][ 'config' ][ $configKey ][ $ic ] = $this->applyAttachments && isset( $this->applyAttachments[ $iv ] ) ? $this->applyAttachments[ $iv ][ 'attachmentId' ] : $_rand;

                        }

                    }

                    if ( isset( $v[ 'config' ][ 'css' ] ) && ! empty( $v[ 'config' ][ 'css' ] ) ) {
                        $itemCSS = $this->parseCss( $v[ 'config' ][ 'css' ] );

                        if ( ! $this->applyAttachments ) {
                            if ( ! empty( $itemCSS[ 'fonts' ] ) ) {
                                $g_fonts[ 'fonts' ] = array_merge( $g_fonts[ 'fonts' ], $itemCSS[ 'fonts' ] );
                            }

                            if ( ! empty( $itemCSS[ 'attachments' ] ) ) {
                                $attachments[ 'attachments' ] = $this->mergeAttachments( $attachments[ 'attachments' ], $itemCSS[ 'attachments' ] );
                            }
                        }

                        $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'items' ][ $k ][ 'config' ][ 'css' ] = $itemCSS[ 'css' ];
                    }

                }

                if ( isset( $colConfig[ 'css' ] ) && ! empty( $colConfig[ 'css' ] ) ) {
                    $colCSS = $this->parseCss( $colConfig[ 'css' ] );

                    if ( ! $this->applyAttachments && ! empty( $colCSS[ 'attachments' ] ) ) {
                        $attachments[ 'attachments' ] = $this->mergeAttachments( $attachments[ 'attachments' ], $colCSS[ 'attachments' ] );
                    }

                    $builders[ 'builder' ][ $key ][ 'row_cols' ][ $ky ][ 'config' ][ 'css' ] = $colCSS[ 'css' ];
                }

            }

            if ( $type == 'deepScan' ) {

                if ( ! $rowInnerGet && $val[ 'id' ] == $pid ) {
                    $is_presets[  ] = $builders[ 'builder' ][ $key ];
                }

                if ( $rowInnerGet && $val[ 'inner_of' ] == $pid ) {
                    $is_presets[  ] = $builders[ 'builder' ][ $key ];
                }

            }

        }

        if ( $type == 'template' ) {
            $builders = [ 'mainData' => $builders[ 'builder' ] ];
        }

        if ( $type == 'deepScan' ) {
            $builders = [ 'mainData' => $is_presets ];
        }

        if ( ! $this->applyAttachments ) {
            if ( ! empty( $g_fonts[ 'fonts' ] ) ) {
                $builders[ 'gFonts' ] = $g_fonts[ 'fonts' ];
            }

            if ( ! empty( $attachments[ 'attachments' ] ) ) {
                $builders[ 'attachments' ] = $attachments[ 'attachments' ];
            }
        }

        if ( ! empty( $is_innerRow ) && $type == 'deepScan' ) {
            $builders[ 'innerRow' ] = $is_innerRow;
        }

        return $builders;

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

                if ( $attch && isset( $attch[ $value ] ) ) {
                    $value = $attch[ $value ][ 'attachmentId' ];
                } else {
                    $i_url = wp_get_attachment_image_src( (int) $value, 'full' );

                    if ( isset( $i_url[ 0 ] ) ) {

                        $image_url = $this->getAndEncodeImage( $i_url[ 0 ] );

                        $_rand                             = $this->generateUid();
                        $modified_css[ 'attachments' ][  ] = [
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

    private function changeId( $builders )
    {

        foreach ( $builders[ 'mainData' ] as $rowK => $row ) {
            // Change Row ID
            $builders[ 'mainData' ][ $rowK ][ 'id' ] = $this->generateUid();

            foreach ( $row[ 'row_cols' ] as $ky => $vl ) {
                // Change column ID
                $builders[ 'mainData' ][ $rowK ][ 'row_cols' ][ $ky ][ 'id' ] = $this->generateUid();

                foreach ( $vl[ 'items' ] as $k => $v ) {

                    $newItemID = $this->generateUid();

                    if ( $v[ 'type' ] == 'rowInner' ) {
                        // Change Item ID
                        $theID = $v[ 'id' ];

                        array_walk_recursive( $builders, function ( &$value, $key ) use ( &$theID, &$newItemID ) {

                            if ( $key == 'inner_of' && $value == $theID ) {
                                $value = $newItemID;
                            }

                        } );

                    }

                    if ( $v[ 'type' ] == 'typeTAB' || $v[ 'type' ] == 'typeAccordion' ) {

                        $KeyConfig = ( $v[ 'type' ] == 'typeTAB' ? 'tabs' : 'accordions' );

                        foreach ( $v[ $KeyConfig ] as $tKey => $tVal ) {

                            $eachTabs = $tVal[ 'id' ];
                            $newTabID = $this->generateUid();

                            $builders[ 'mainData' ][ $rowK ][ 'row_cols' ][ $ky ][ 'items' ][ $k ][ $KeyConfig ][ $tKey ][ 'id' ] = $newTabID;

                            array_walk_recursive( $builders, function ( &$value, $key ) use ( &$eachTabs, &$newTabID ) {

                                if ( $key == 'childOf' && $value == $eachTabs ) {
                                    $value = $newTabID;
                                }

                            } );

                        }

                    }

                    if ( isset( $v[ 'config' ] ) && isset( $v[ 'config' ][ 'group' ] ) ) {

                        foreach ( $v[ 'config' ][ 'group' ] as $gKey => $gVal ) {
                            $builders[ 'mainData' ][ $rowK ][ 'row_cols' ][ $ky ][ 'items' ][ $k ][ 'config' ][ 'group' ][ $gKey ][ 'id' ] = $this->generateUid();
                        }

                    }

                    $builders[ 'mainData' ][ $rowK ][ 'row_cols' ][ $ky ][ 'items' ][ $k ][ 'id' ] = $newItemID;

                }

            }

        }

        return $builders;

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
