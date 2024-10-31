<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Upgrade_Mapper
{

    public $finalData = null;

    public function __construct()
    {

    }

    public function row( $data )
    {

        $this->finalData = $data;

        foreach ( $data[ 'builder' ] as $idx => $row ) {

            if ( $this->isOldData( $row ) ) {

                if ( isset( $this->finalData[ 'builder' ][ $idx ][ 'config' ][ 'css' ] ) && is_array( $this->finalData[ 'builder' ][ $idx ][ 'config' ][ 'css' ] ) ) {
                    unset( $this->finalData[ 'builder' ][ $idx ][ 'config' ][ 'css' ] );

                    $this->finalData[ 'builder' ][ $idx ][ 'config' ][ 'css' ] = [ 'desktop' => $this->getCurrentCss( $row ), 'tablet' => [], 'smartphone' => [] ];
                }

            }

        }

        $this->col();

    }

    public function col()
    {

        foreach ( $this->finalData[ 'builder' ] as $r => $row ) {

            foreach ( $row[ 'row_cols' ] as $c => $col ) {

                if ( $this->isOldData( $col ) ) {

                    if ( isset( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'config' ][ 'css' ] ) && is_array( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'config' ][ 'css' ] ) ) {
                        unset( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'config' ][ 'css' ] );

                        $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'config' ][ 'css' ] = [ 'desktop' => $this->getCurrentCss( $col ), 'tablet' => [], 'smartphone' => [] ];
                    }

                }

            }

        }

        $this->item();

    }

    public function item()
    {

        foreach ( $this->finalData[ 'builder' ] as $r => $row ) {

            foreach ( $row[ 'row_cols' ] as $c => $col ) {

                foreach ( $col[ 'items' ] as $it => $item ) {

                    if ( $this->isOldData( $item ) ) {

                        if ( isset( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'items' ][ $it ][ 'config' ][ 'css' ] ) && is_array( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'items' ][ $it ][ 'config' ][ 'css' ] ) ) {
                            unset( $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'items' ][ $it ][ 'config' ][ 'css' ] );

                            $this->finalData[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'items' ][ $it ][ 'config' ][ 'css' ] = [ 'desktop' => $this->getCurrentCss( $item ), 'tablet' => [], 'smartphone' => [] ];
                        }

                    }

                }

            }

        }

        return;

    }

    public function isOldData( $data )
    {

        if ( ! isset( $data[ 'config' ][ 'css' ][ 'desktop' ] ) && ! isset( $data[ 'config' ][ 'css' ][ 'tablet' ] ) && ! isset( $data[ 'config' ][ 'css' ][ 'smartphone' ] ) ) {
            return true;
        }

        return false;

    }

    public function getCurrentCss( $data )
    {

        if ( isset( $data[ 'config' ][ 'css' ] ) && is_array( $data[ 'config' ][ 'css' ] ) ) {

            return $data[ 'config' ][ 'css' ];

        }

        return [];

    }

    public function upgradeOptionsFormat( $array )
    {

        foreach ( $array[ 'builder' ] as $r => $row ) {

            if ( isset( $row[ 'config' ][ 'css' ] ) ) {
                $array[ 'builder' ][ $r ][ 'config' ][ 'css' ] = $this->css_set_format( $row[ 'config' ][ 'css' ] );
            }

            foreach ( $row[ 'row_cols' ] as $c => $col ) {

                if ( isset( $col[ 'config' ][ 'css' ] ) ) {
                    $array[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'config' ][ 'css' ] = $this->css_set_format( $col[ 'config' ][ 'css' ] );
                }

                foreach ( $col[ 'items' ] as $i => $item ) {
                    $array[ 'builder' ][ $r ][ 'row_cols' ][ $c ][ 'items' ][ $i ][ 'config' ] = $this->item_set_format( $item );
                }

            }

        }

        return $array;

    }

    public function item_set_format( $item, $base = 'config', $iType = null )
    {

        require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-helpers.php' );

        $replace_params = apply_filters( 'pbwp_upgrade_item_params', [
            'youtubeGallery' => [
                'prefix'  => 'ytg-',
                'new_key' => [ 'id', 'url', 'thumb_ver' ],
            ],
            'socialLink'     => [
                'prefix'  => 'sclink-',
                'new_key' => [ 'id', 'sc_type', 'sc_link' ],
            ],
            'typeList'       => [
                'prefix'  => 'list-',
                'new_key' => [ 'id', 'list_content', 'icon' ],
            ],
            'typePBAR'       => [
                'prefix'  => 'pbar-',
                'new_key' => [ 'id', 'label', 'value' ],
            ],
            'typeRoundChart' => [
                'prefix'  => 'rchart-',
                'new_key' => [ 'id', 'label', 'value', 'color' ],
            ],
            'typeLineChart'  => [
                'prefix'  => 'linechart-',
                'new_key' => [ 'id', 'label', 'value', 'color' ],
            ],
            'table'          => [
                'prefix'  => 'tabel-',
                'new_key' => [ 'id', 'table_data' ],
            ],
        ] );

        $groupItems = array_keys( $replace_params );
        $temp_array = [  ];

        $itemType   = ( $iType ? $iType : $item[ 'type' ] );
        $baseToFind = $item[ $base ];

        // Make sure this is array
        if ( ! is_array( $baseToFind ) ) {
            $baseToFind = [];
        }

        // Set array named 'general'
        if ( ! array_key_exists( 'general', $baseToFind ) ) {
            $baseToFind[ 'general' ] = [];
        }

        // For update group format
        if ( in_array( $itemType, $groupItems ) ) {

            // Get information from each item
            $prefix = $replace_params[ $itemType ][ 'prefix' ];
            $keys   = $replace_params[ $itemType ][ 'new_key' ];

            // Set array named 'group'
            if ( ! array_key_exists( 'group', $baseToFind ) ) {
                $baseToFind[ 'group' ] = [];
            }

            // Get old items based on their prefix
            $all_items = pbwp_array_filter_key( $baseToFind, function ( $key ) use ( &$prefix ) {
                return strpos( $key, $prefix ) === 0;
            } );

            if ( $all_items ) {

                foreach ( array_keys( $all_items ) as $ky => $val ) {

                    foreach ( $baseToFind[ $val ] as $k => $v ) {
                        // Get index of new key
                        $index = array_search( $k, array_keys( $baseToFind[ $val ] ) );

                        // Get current value and set it into new array named 'group'
                        if ( isset( $keys[ $index ] ) ) {
                            $baseToFind[ 'group' ][ $ky ][ $keys[ $index ] ] = $v;
                        }

                    }

                    // Remove the old option
                    unset( $baseToFind[ $val ] );

                }

            }

        }

        // Now update all settings configuration to the new
        foreach ( $baseToFind as $k => $v ) {

            // Update css configuration only for preset
            if ( $k === 'css' ) {
                $baseToFind[ 'css' ] = $this->css_set_format( $baseToFind[ 'css' ] );
            }

            // Skip for below array name
            if ( $k != 'css' && $k != 'group' && $k != 'general' && $k != 'animate' && $k != 'advanced' ) {

                // If the array key is same with the item type name that's mean this is the old configuration
                if ( $k === strtolower( $itemType ) && is_array( $v ) ) {
                    // Merge old settings to new position
                    $baseToFind[ 'general' ] = array_merge( $baseToFind[ 'general' ], $v );
                } else {

                    // Rename radio image unsaved key to the real key before move to general
                    if ( strpos( $k, '_radio_image' ) !== false ) {
                        $kNew = str_replace( '_radio_image', '', $k );
                        unset( $baseToFind[ $k ] );
                        $k = $kNew;
                    }

                    // Clone to new setting array
                    $baseToFind[ 'general' ][ $k ] = $v;
                }

                // Remove the old option
                unset( $baseToFind[ $k ] );

                // Move css array to the last
                if ( isset( $baseToFind[ 'css' ] ) ) {
                    // Clone, remove and re-add
                    $temp_array = $baseToFind[ 'css' ];
                    unset( $baseToFind[ 'css' ] );
                    $baseToFind[ 'css' ] = $temp_array;
                }

            }

        }

        return $baseToFind;

    }

    public function css_set_format( $css )
    {

        $css_mode = [ 'desktop', 'tablet', 'smartphone' ];

        if ( isset( $css ) ) {

            $used_css_mode = array_intersect( $css_mode, array_keys( $css ) );

            if ( $used_css_mode ) {

                foreach ( $css_mode as $ic => $each_mode ) {

                    if ( ! array_key_exists( $each_mode, $css ) ) {
                        $css[ $each_mode ] = [];
                    }

                }

            } else {
                $cssCloner = $css;
                $css       = [ 'desktop' => $cssCloner, 'tablet' => [], 'smartphone' => [] ];
            }

        }

        return $css;

    }

    public function update_preset_data( $custom = [], $return = false )
    {

        require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );

        $all_presets   = pbwp_get_option( 'user_presets' );
        $all_item_type = array_keys( pbwp_generate_item_list() );

        if ( $custom ) {
            $all_presets = $custom;
        }

        if ( ! $all_presets ) {
            return false;
        }

        foreach ( $all_presets as $key => $itemPresets ) {

            foreach ( $itemPresets as $ep => $preset ) {

                if ( in_array( $key, $all_item_type ) ) {

                    $all_presets[ $key ][ $ep ][ 'preset' ] = $this->item_set_format( $preset, 'preset', $key );

                } else {

                    $all_presets[ $key ][ $ep ][ 'preset' ][ 'css' ] = $this->css_set_format( $preset[ 'preset' ][ 'css' ] );

                }

            }

        }

        if ( $return ) {
            return $all_presets;
        }

        pbwp_update_option( 'user_presets', $all_presets );

    }

    public function save( $data, $postID )
    {
        /* Sanitize data */
        $sanitized = pbwp_data_sanitation( $data, false );
        /* Update data */
        delete_post_meta( $postID, 'wp_composer' );
        add_post_meta( $postID, 'wp_composer', $sanitized, true );

        return true;

    }

}
