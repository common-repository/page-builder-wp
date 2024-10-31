<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_upgrade_check()
{

    /* General Settings */
    $state            = false;
    $wpc_stt          = get_option( 'pbwp_globals' );
    $tasks            = [ 'wpc_css_responsive_mode_check', 'wpc_new_options_format_check', 'wpc_new_preset_data_format_check' ];
    $default_settings = [
        'stt_general'         => [
            'wpc_post_type'            => 'post, page',
            'disable_plugin'           => 'notactive',
            'disable_plugin_update'    => 'notactive',
            'disable_gutenberg'        => 'notactive',
            'disable_visualtext'       => 'active',
            'disable_auto_open_editor' => 'active',
            'max_undo'                 => 10,
            'wpc_roles'                => 'administrator',
            'wpc_maintenance'          => 'notactive',
            'wpc_debug'                => 'notactive',
            'wpc_maintenance_end'      => '',
            'gmaps_key'                => '',
            'gfonts_key'               => '',
            'local_fonts'              => 'active',
            'local_fonts_format'       => 'ttf',
         ],
        'my'                  => [  ],
        'hub'                 => [
            'content' => [
                'version_data' => [
                    'items'       => [
                        'layout_packs' => [
                            'version' => '1.0.0',
                         ],
                        'templates'    => [
                            'version' => '1.0.0',
                         ],
                        'presets'      => [
                            'version' => '1.0.0',
                         ],
                     ],
                    'last_check'  => current_time( 'timestamp' ),
                    'need_update' => [
                        'hub_info' => [  ],
                     ],
                 ],
             ],
         ],
        'user_fonts'          => [  ],
        'user_presets'        => [  ],
        'user_templates'      => [  ],
        'user_interface'      => [
            'show_tour' => 'yes',
         ],
        'user_wpc_pages'      => [  ],
        'user_item_favorites' => [  ],
        'user_colors'         => [ 'rgba(0, 0, 0, 1)', 'rgba(255, 255, 255, 1)', 'rgba(224, 43, 32, 1)', 'rgba(134, 40, 203, 1)', 'rgba(224, 153, 0, 1)', 'rgba(237, 240, 0, 1)', 'rgba(124, 218, 36, 1)', 'rgba(12, 113, 195, 1)' ],
     ];

    if ( ! isset( $wpc_stt[ 'stt_general' ] ) || ! is_array( $wpc_stt[ 'stt_general' ] ) ) {
        update_option( 'pbwp_globals', $default_settings );
    }

    /* Adjustment if available new global options here */
    foreach ( $default_settings as $key => $value ) {

        if ( ! isset( $wpc_stt[ $key ] ) ) {
            $state           = true;
            $wpc_stt[ $key ] = $value;
        }

    }

    foreach ( $default_settings[ 'stt_general' ] as $key => $value ) {

        if ( isset( $wpc_stt[ 'stt_general' ] ) && ! isset( $wpc_stt[ 'stt_general' ][ $key ] ) ) {
            $state                            = true;
            $wpc_stt[ 'stt_general' ][ $key ] = $value;
        }

    }

    if ( $state ) {
        update_option( 'pbwp_globals', pbwp_array_sanitation( $wpc_stt ) );
    }

    /* Need to check if task already executed */
    foreach ( $tasks as $task ) {

        if ( get_option( $task ) !== 'upgraded' ) {

            pbwp_upgrade_executes( $task );

        }

    }

    if ( ! get_option( 'pbwp_default_multiple_images' ) ) {

        require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-helpers.php' );
        require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-sanitize.php' );

        $all                = [  ];
        $result             = null;
        $wpUploadDir        = wp_upload_dir();
        $wpc_dummy_base_dir = pbwp_manager()->path( 'FRONTEND' ).'/assets/img/wpc-dummy-images/';
        $dummy_base_dir     = $wpUploadDir[ 'basedir' ].'/wpc-dummy-images';
        $filesystem         = pbwp_filesystem();

        if ( ! $filesystem->is_dir( $dummy_base_dir ) ) {
            $filesystem->mkdir( $dummy_base_dir );
            copy_dir( $wpc_dummy_base_dir, $dummy_base_dir );

            foreach ( range( 1, 15 ) as $img ) {
                $all[  ] = $wpUploadDir[ 'baseurl' ].'/wpc-dummy-images/wpc_dummy_image_'.$img.'.jpg';
            }

        }

        if ( pbwp_is_on_localhost() ) {
            add_filter( 'https_ssl_verify', '__return_false' );
        }

        $result = pbwp_download_multiple_images( $all, null, true );

        if ( is_array( $result ) ) {
            $result = pbwp_array_sanitation( $result );
        }

        update_option( 'pbwp_default_multiple_images', pbwp_array_sanitation( $result ) );

    }

}

function pbwp_upgrade_executes( $task )
{

    require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-helpers.php' );

    $is_upgraded = false;
    $ids         = pbwp_get_active_wpcomposer_post_id();

    if ( $task === 'wpc_new_preset_data_format_check' ) {
        pbwp_upgrade_preset_data_format( $task );
    }

    if ( isset( $ids ) && count( $ids ) !== 0 ) {

        foreach ( $ids as $id ) {

            $wpc_data = pbwp_get_global_options( $id, 'all' );

            if ( isset( $wpc_data[ 'builder' ] ) && count( $wpc_data[ 'builder' ] ) > 0 ) {

                if ( $task === 'wpc_css_responsive_mode_check' ) {

                    // Check if the current setting has been upgraded to use responsive mode
                    if ( ! pbwp_css_route_check( $wpc_data ) ) {

                        pbwp_data_upgrade( $wpc_data, $id, 'css', true, false );
                        // Set clue
                        $is_upgraded = true;

                    }

                }

                if ( $task === 'wpc_new_options_format_check' ) {

                    pbwp_data_upgrade( $wpc_data, $id, 'formatNewData', true, false );
                    // Set clue
                    $is_upgraded = true;

                }

            } else {
                continue;
            }

        }

        if ( $is_upgraded ) {
            update_option( sanitize_text_field( $task ), 'upgraded' );
        }

    }

}

/*
This function is used to fix the css configuration after we implement responsive mode
Before: data -> config -> css
After: data -> config -> css -> array(desktop, tablet and smartphone)
 */
function pbwp_css_route_check( $data )
{

    $status = false;
    $find   = apply_filters( 'pbwp_array_find_keys', [ 'desktop', 'tablet', 'smartphone' ] );
    $it     = new RecursiveIteratorIterator( new RecursiveArrayIterator( $data[ 'builder' ] ), RecursiveIteratorIterator::SELF_FIRST );

    while ( $it->valid() ) {
        $v = $it->current();

        if ( $it->key() === 'css' && is_array( $v ) && count( array_intersect( array_keys( $v ), $find ) ) !== 0 ) {
            $status = true;
        }

        $it->next();
    }

    return $status;

}

function pbwp_data_upgrade( $data, $postID, $type = null, $autoSave = false, $sendBack = true )
{

    require_once pbwp_manager()->path( 'GLOBAL_DIR', 'class-wpc-upgrade-mapper.php' );

    $mapper = new PBWP_Upgrade_Mapper;

    if ( $type == 'css' ) {

        $mapper->row( $data );
        $data = $mapper->finalData;

    } elseif ( $type == 'formatNewData' ) {
        // Update item options
        $data = $mapper->upgradeOptionsFormat( $data );
        // Update preset
        $mapper->update_preset_data();

    } else {

        return $data;

    }

    if ( ! $autoSave ) {

        if ( ! $sendBack ) {
            return;
        }

        return $data;

    }

    /* Save it */
    if ( $mapper->save( $data, $postID ) ) {

        /* Already updated and send data back or just return */
        if ( ! $sendBack ) {
            return;
        }

        return $data;

    }

    return $data;

}

function pbwp_upgrade_preset_data_format( $task = false )
{

    $wpc_opt     = get_option( 'pbwp_globals' );
    $needUpgrade = false;

    if ( isset( $wpc_opt[ 'user_presets' ] ) && is_array( $wpc_opt[ 'user_presets' ] ) && count( $wpc_opt[ 'user_presets' ] ) > 0 ) {

        $user_presets = $wpc_opt[ 'user_presets' ];

        foreach ( $user_presets as $key => $presets ) {
            if ( is_array( $presets ) ) {
                foreach ( $presets as $k => $preset ) {
                    if ( ! isset( $preset[ 'id' ] ) ) {
                        $needUpgrade                = true;
                        $user_presets[ $key ][ $k ] = array_merge( [ 'id' => pbwp_uniqueMe() ], $user_presets[ $key ][ $k ] );
                    }
                }
            }
        }

        if ( $needUpgrade ) {
            $wpc_opt[ 'user_presets' ] = pbwp_array_sanitation( $user_presets );
            update_option( 'pbwp_globals', $wpc_opt );
        }

    }
    if ( $task ) {
        update_option( sanitize_text_field( $task ), 'upgraded' );
    }

}
