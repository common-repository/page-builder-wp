<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get WP Composer Global options
function pbwp_get_option( $opt )
{

    $wpc_opt = get_option( 'pbwp_globals' );

    if ( isset( $wpc_opt ) && is_array( $wpc_opt ) && array_key_exists( $opt, $wpc_opt ) ) {
        return $wpc_opt[ $opt ];
    }

    return false;

}

// Update WP Composer Global options
function pbwp_update_option( $key, $val )
{

    if ( ! function_exists( 'pbwp_sanitize_options' ) ) {
        require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-sanitize.php' );
    }

    if ( ! $key && ! $val ) {
        return;
    }

    // Sanitize it first before save
    $val = pbwp_sanitize_options( $val );

    $wpc_opt         = get_option( 'pbwp_globals' );
    $wpc_opt[ $key ] = $val;

    if ( update_option( 'pbwp_globals', $wpc_opt ) ) {
        return true;
    } else {
        return false;
    }

}

// Generate Post Type
function pbwp_get_post_types()
{

    $post_types = [  ];

    $excludes = apply_filters( 'pbwp_exclude_post_type',
        [
            'attachment',
            'revision',
            'nav_menu_item',
            'mediapage',
         ] );

    foreach ( get_post_types( [ 'public' => true ] ) as $post_type ) {

        if ( ! in_array( $post_type, $excludes ) ) {
            $post_types[  ] = $post_type;
        }

    }

    return $post_types;

}

function pbwp_template_parser()
{

    if ( ! class_exists( 'PBWP_Template_Parser' ) ) {
        require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-template-parser.php' );
    }

    return PBWP_Template_Parser::getInstance();

}

function pbwp_preset_parser()
{

    if ( ! class_exists( 'PBWP_Preset_Parser' ) ) {
        require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-preset-parser.php' );
    }

    return PBWP_Preset_Parser::getInstance();

}

function pbwp_enqueue_admin_script( $hook )
{

    if ( ! function_exists( 'pbwp_i18n' ) ) {
        require_once pbwp_manager()->path( 'BACKEND', 'wpc-i18n.php' );
    }

    $is_rtl = ( is_rtl() ? 'Rtl' : '' );

    wp_register_style( 'wpc-pages', pbwp_distribution_url( 'css/pageCss'.$is_rtl.'.bundle.css' ), [  ], PBWP_VERSION, 'all' );
    wp_register_script( 'wpc-pages', pbwp_distribution_url( 'js/page.bundle.js' ), [ 'jquery' ], PBWP_VERSION, false );
    wp_register_style( 'wpc-vendors', pbwp_distribution_url( 'css/vendorCss'.$is_rtl.'.bundle.css' ), [  ], PBWP_VERSION, 'all' );
    wp_register_script( 'wpc-vendors', pbwp_distribution_url( 'js/vendors.bundle.js' ), [ 'jquery', 'wp-editor' ], PBWP_VERSION, false );
    wp_register_script( 'wpc-gutenberg', pbwp_distribution_url( 'js/gutenberg.bundle.js' ), [ 'jquery' ], PBWP_VERSION, false );
    wp_enqueue_style( 'wpc-admin', pbwp_distribution_url( 'css/adminCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION, 'all' );

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

        wp_enqueue_style( 'wpc-post', pbwp_distribution_url( 'css/postCss'.$is_rtl.'.bundle.css' ), [  ], PBWP_VERSION );

        global $current_screen;

        $current_screen = get_current_screen();

        if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {

            global $post;

            add_filter( 'pbwp_editor_builder_params', 'pbwp_editor_builder_params_filter', 99, 2 );

            wp_enqueue_script( 'wpc-gutenberg' );
            wp_localize_script( 'wpc-gutenberg', 'wpc_gutenberg_localize', [ 'editLink' => esc_url( pbwp_generate_customizer_link( $post->ID, $post, true ) ), 'edit_wpc' => esc_html__( 'Edit with WP Composer', 'page-builder-wp' ) ] );

        }

        $wpc_meta_ID = pbwp_get_metaid_by_key( get_the_ID(), 'wp_composer' );
        if ( $wpc_meta_ID ) {
            wp_enqueue_script( 'wpc-posts', pbwp_distribution_url( 'js/post.bundle.js' ), [  ], PBWP_VERSION, true );
            wp_localize_script( 'wpc-posts', 'wpc_posts_localize', [ 'metaId' => esc_html( $wpc_meta_ID ) ] );
        }

    }

    $opt = [
        'is_rtl'      => ( is_rtl() ? true : false ),
        'rest_url'    => rest_url( PBWP_REST_NAMESPACE.'/' ),
        'my_url'      => PBWP_MY_URL,
        'site_url'    => get_site_url(),
        'my_web_data' => base64_encode( serialize( [
            'site_url'   => get_site_url(),
            'site_title' => get_bloginfo( 'name' ),
         ] ) ),
        'lang'        => pbwp_i18n( 'pages' ),
        'default_may' => [
            'my' => 'no',
         ],
        'nonce'       => wp_create_nonce( 'wpc_ajax_nonce' ),
     ];

    wp_localize_script( 'wpc-pages', 'wpc_page_localize', $opt );

}

function pbwp_set_metabox()
{

    global $post;

    if ( isset( $post->ID ) ) {

        if ( get_post_status( $post->ID ) == 'auto-draft' ) {
            return;
        }

        add_meta_box( 'wpc_edit_cont', 'WP Composer', 'pbwp_metabox_markup', null, 'side', 'default' );

    }

}

function pbwp_metabox_markup( $post )
{

    if ( isset( $post->ID ) ) {

        if ( get_post_status( $post->ID ) == 'auto-draft' ) {
            return;
        }

        add_filter( 'pbwp_editor_builder_params', 'pbwp_editor_builder_params_filter', 99, 2 );

        $wpcEdit = '<div class="wpc_metabox_edit_cont">';
        $wpcEdit .= '<a id="wpc_metabox_edit_link" href="'.esc_url( pbwp_generate_customizer_link( $post->ID, $post, true ) ).'">'.esc_html__( 'Edit with WP Composer', 'page-builder-wp' ).'</a>';
        $wpcEdit .= '</div>';

        echo wp_kses_post( $wpcEdit );

    }

}

function pbwp_download_multiple_images( $data, $postID = null, $retArray = false )
{

    $all = [  ];

    foreach ( $data as $each ) {

        if ( filter_var( $each, FILTER_VALIDATE_URL ) ) {

            $img_id = pbwp_uploadRemoteImageAndAttach( $each, $postID );

            if ( is_wp_error( $img_id ) ) {
                continue;
            }

            $all[  ] = (string) $img_id;

        }

    }

    return $retArray ? $all : implode( ',', $all );

}

/**
 * Downloads an image from the specified URL and attaches it to a post.
 *
 * @since 2.6.0
 * @since 4.2.0 Introduced the `$return` parameter.
 * @since 4.8.0 Introduced the 'id' option within the `$return` parameter.
 *
 * @param string $file    The URL of the image to download.
 * @param int    $post_id The post ID the media is to be associated with.
 * @param string $desc    Optional. Description of the image.
 * @param string $return  Optional. Accepts 'html' (image tag html) or 'src' (URL), or 'id' (attachment ID). Default 'html'.
 * @return string|WP_Error Populated HTML img tag on success, WP_Error object otherwise.
 */
function pbwp_media_sideload_image( $file, $post_id, $desc = null, $return = 'html' )
{

    if ( ! empty( $file ) ) {

        // Set variables for storage, fix file filename for query strings.
        preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );

        if ( ! $matches ) {
            return new WP_Error( 'image_sideload_failed', esc_html__( 'Invalid image URL', 'page-builder-wp' ) );
        }

        $file_array           = [  ];
        $file_array[ 'name' ] = basename( $matches[ 0 ] );

        // Download file to temp location.
        $file_array[ 'tmp_name' ] = download_url( $file );

        if ( is_wp_error( $file_array[ 'tmp_name' ] ) ) {
            // If error storing temporarily, return the error.
            return $file_array[ 'tmp_name' ];
        }

        // Do the validation and storage stuff.
        $id = media_handle_sideload( $file_array, $post_id, $desc );

        if ( is_wp_error( $id ) ) {
            // If error storing permanently, unlink.
            wp_delete_file( $file_array[ 'tmp_name' ] );

            return $id;
            // If attachment id was requested, return it early.
        } elseif ( $return === 'id' ) {
            return $id;
        }

        $src = wp_get_attachment_url( $id );
    }

    if ( ! empty( $src ) ) {

        // Finally, check to make sure the file has been saved, then return the HTML.
        if ( $return === 'src' ) {
            return $src;
        }

        $alt  = isset( $desc ) ? esc_attr( $desc ) : '';
        $html = "<img src='$src' alt='$alt' />";

        return $html;
    } else {
        return new WP_Error( 'image_sideload_failed' );
    }

}

// Download an image from remote URL and Upload to WP Media
function pbwp_uploadRemoteImageAndAttach( $url, $post_id = null )
{

    // increase timeout to 90 seconds
    add_filter( 'http_request_args', function ( $args ) {
        $args[ 'timeout' ] = 90;

        return $args;
    } );

    $desc = apply_filters( 'pbwp_upload_image_desc', esc_html__( 'WP Composer Assets', 'page-builder-wp' ) );

    if ( pbwp_wp_version_compare( '4.8' ) === false ) {
        $attach_id = pbwp_media_sideload_image( $url, $post_id, $desc, 'id' );
    } else {

        require_once ABSPATH.'wp-admin/includes/file.php';
        require_once ABSPATH.'wp-admin/includes/media.php';
        require_once ABSPATH.'wp-admin/includes/image.php';

        $attach_id = media_sideload_image( $url, $post_id, $desc, 'id' );
    }

    return $attach_id;

}

function pbwp_uploadBase64Image( $image_data )
{

    $imgId = '';
    // Decode the base64 data
    $image_data = base64_decode( $image_data );
    // Determine the file extension from the MIME type
    $finfo     = finfo_open( FILEINFO_MIME_TYPE );
    $mime_type = finfo_buffer( $finfo, $image_data );
    finfo_close( $finfo );

    $allowed_extensions = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/gif'  => 'gif',
        // Add more mime types and corresponding extensions if needed
     ];

    // Get the file extension based on the MIME type
    $extension = isset( $allowed_extensions[ $mime_type ] ) ? $allowed_extensions[ $mime_type ] : '';
    // Generate a unique filename for the uploaded image with the original extension
    $filename = 'wpc_cloud_attachment_'.strtolower( wp_generate_password( 10, false, false ) ).'.'.$extension;
    // Upload the file using wp_upload_bits
    $upload = wp_upload_bits( $filename, null, $image_data );
    // Check if the file was successfully uploaded
    if ( ! $upload[ 'error' ] ) {
        // Prepare the attachment data
        $attachment = [
            'post_mime_type' => $upload[ 'type' ],
            'post_title'     => 'Cloud image assets',
            'post_content'   => '',
            'post_status'    => 'inherit',
         ];

        // Insert the attachment into the media library
        $attachment_id = wp_insert_attachment( $attachment, $upload[ 'file' ] );
        // Generate attachment metadata
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload[ 'file' ] );
        // Update the attachment metadata
        wp_update_attachment_metadata( $attachment_id, $attachment_data );
        // Now $attachment_id contains the ID of the newly uploaded media file
        $imgId = $attachment_id;
    } else {
        $imgId = pbwp_pick_wpmedia_random_image_id();
    }

    return $imgId;

}

function pbwp_pick_wpmedia_random_image_id( $parentId = false )
{

    $args = [
        'orderby'        => 'rand', // this is random param
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => '1',
        'post_parent'    => $parentId ? parentId : get_the_ID(),
     ];

    $get_children_array = get_children( $args, ARRAY_A );

    $rekeyed_array = array_values( $get_children_array );
    $child_image   = $rekeyed_array[ 0 ];

    return $child_image[ 'ID' ];

}

function pbwp_check_pexels_photo_exist( $id, $returnIDs )
{

    global $wpdb;

    $meta_key  = 'pexels_data';
    $cache_key = 'pbwp_pexels_data_'.esc_html( $id );

    $pexelsImages = wp_cache_get( $cache_key );

    if ( false === $pexelsImages ) {
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $pexelsImages = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $wpdb->postmeta WHERE $wpdb->postmeta.meta_key = %s",
                $meta_key
            )
            , ARRAY_A );
        wp_cache_set( $cache_key, $pexelsImages );
    }

    if ( empty( $pexelsImages ) ) {
        return false;
    }

    foreach ( $pexelsImages as $key ) {

        $data = maybe_unserialize( $key[ 'meta_value' ] );

        if ( isset( $data[ 'pexels_id' ] ) && $data[ 'pexels_id' ] === $id ) {

            if ( $returnIDs ) {
                return $data;
            }

            return true;

        }

    }

    return false;

}

/*-------------------------------------------------------------------------------*/

/*   GET Site Info
/*-------------------------------------------------------------------------------*/

/**
 * Detect is GD Library is enabled
 *
 * @return bool
 */
function pbwp_gd_enabled()
{
    if ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) {
        return true;
    } else {
        return false;
    }

}

/**
 * Detect is Imagick is enabled
 *
 * @return bool
 */
function pbwp_imagick_enabled()
{
    if ( extension_loaded( 'imagick' ) && class_exists( 'Imagick' ) && class_exists( 'ImagickPixel' ) ) {
        return true;
    } else {
        return false;
    }

}

/**
 * Detect if OpenSSL is enabled
 *
 * @return bool
 */
function pbwp_open_ssl_enabled()
{
    if ( defined( 'OPENSSL_VERSION_TEXT' ) ) {
        return true;
    } else {
        return false;
    }

}

/**
 * Get all the table prefixes for the blogs in the site. MS compatible
 *
 * @param array $exclude_blog_ids blog ids to exclude
 *
 * @return array associative array with blog ID as key, prefix as value
 */
function pbwp_get_all_blog_table_prefixes( $exclude_blog_ids = [  ] )
{

    global $wpdb;
    $prefix = $wpdb->prefix;

    $table_prefixes = [  ];

    if ( ! in_array( 1, $exclude_blog_ids ) ) {
        $table_prefixes[ 1 ] = $prefix;
    }

    if ( is_multisite() ) {
        $blog_ids = pbwp_get_blog_ids();
        foreach ( $blog_ids as $blog_id ) {
            if ( in_array( $blog_id, $exclude_blog_ids ) ) {
                continue;
            }

            $table_prefixes[ $blog_id ] = $wpdb->get_blog_prefix( $blog_id );
        }

    }

    return $table_prefixes;
}

function pbwp_get_blog_ids()
{
    if ( ! is_multisite() ) {
        return false;
    }

    $args = [
        'limit'    => false, // Deprecated
        'number' => false,   // WordPress 4.6+
        'spam' => 0,
        'deleted'  => 0,
        'archived' => 0,
     ];

    $blogs = get_sites( $args );

    $blog_ids = [  ];

    foreach ( $blogs as $blog ) {
        $blog         = (array) $blog;
        $blog_ids[  ] = $blog[ 'blog_id' ];
    }

    return $blog_ids;
}

function pbwp_diagnostic_media_counts()
{

    if ( false === ( $attachment_counts = get_site_transient( 'pbwp_attachment_counts' ) ) ) {
        $table_prefixes = pbwp_get_all_blog_table_prefixes();
        $all_media      = 0;

        foreach ( $table_prefixes as $blog_id => $table_prefix ) {
            $count = pbwp_count_attachments();
            $all_media += $count;
        }

        $attachment_counts = [
            'all' => $all_media,
         ];

        set_site_transient( 'pbwp_attachment_counts', $attachment_counts, 2 * MINUTE_IN_SECONDS );
    }

    return $attachment_counts;
}

function pbwp_count_attachments()
{
    $cache_key = 'pbwp_count_attachments';
    $count     = wp_cache_get( $cache_key );

    if ( false === $count ) {
        global $wpdb;
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $count = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(DISTINCT p.ID)
            FROM {$wpdb->posts} p
            WHERE p.post_type = %s",
            'attachment'
        ) );

        // Cache the result for future use
        wp_cache_set( $cache_key, $count );
    }

    return $count;
}

function pbwp_get_mysql_version()
{
    $cache_key = 'mysql_version';
    $version   = wp_cache_get( $cache_key );

    if ( false === $version ) {
        global $wpdb;
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $version = esc_html( $wpdb->get_var( 'SELECT VERSION()' ) );

        // Cache the result for future use
        wp_cache_set( $cache_key, $version );
    }

    return $version;
}

/**
 * Output image size names and dimensions to a string
 *
 * @return string
 */
function pbwp_get_image_sizes_details()
{
    global $_wp_additional_image_sizes;

    $size_details                 = '';
    $get_intermediate_image_sizes = get_intermediate_image_sizes();

    foreach ( $get_intermediate_image_sizes as $size ) {

        if ( in_array( $size, [ 'thumb', 'thumbnail', 'medium', 'large', 'post-thumbnail' ] ) ) {

            if (  ( $width = get_option( $size.'_size_w' ) ) && ( $height = get_option( $size.'_size_h' ) ) ) {
                $size_details .= $size.' ('.$width.'x'.$height.')'."\r\n";
            } else {
                $size_details .= $size.' (none)'."\r\n";
            }

        } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
            $size_details .= $size.' ('.$_wp_additional_image_sizes[ $size ][ 'width' ].'x'.$_wp_additional_image_sizes[ $size ][ 'height' ].')'."\r\n";
        }

    }

    return $size_details;
}

/**
 * Helper to remove the plugin directory from the plugin path
 *
 * @param string $path
 *
 * @return string
 */
function pbwp_remove_wp_plugin_dir( $path )
{
    $plugin = str_replace( WP_PLUGIN_DIR, '', $path );

    return substr( $plugin, 1 );
}

/**
 * Helper to display plugin details
 *
 * @param string $plugin_path
 * @param string $suffix
 *
 * @return string
 */
function pbwp_get_plugin_details( $plugin_path, $suffix = '' )
{
    $plugin_data = get_plugin_data( $plugin_path );

    if ( empty( $plugin_data[ 'Name' ] ) ) {
        return basename( $plugin_path );
    }

    return sprintf( "%s%s (v%s) by %s\r\n", $plugin_data[ 'Name' ], $suffix, $plugin_data[ 'Version' ], wp_strip_all_tags( $plugin_data[ 'AuthorName' ] ) );
}

/**
 * Get the absolute path to the WordPress uploads directory,
 * with a trailing slash.
 *
 * @return string The uploads directory path.
 */
function pbwp_get_wordpress_uploads_directory_path()
{

    $upload_dir = wp_upload_dir();

    return $upload_dir[ 'basedir' ];
}

/**
 * Diagnostic information for the support tab
 *
 * @param bool $escape
 *
 * @return string
 */
function pbwp_output_diagnostic_info( $escape = true )
{

    global $table_prefix;
    global $wpdb;

    $server_software = isset( $_SERVER[ 'SERVER_SOFTWARE' ] ) ? sanitize_text_field( wp_unslash( $_SERVER[ 'SERVER_SOFTWARE' ] ) ) : '';

    $output = 'site_url(): ';
    $output .= esc_html( site_url() );
    $output .= "\r\n";

    $output .= 'home_url(): ';
    $output .= esc_html( home_url() );
    $output .= "\r\n";

    $output .= 'Database Name: ';
    $output .= esc_html( $wpdb->dbname );
    $output .= "\r\n";

    $output .= 'Table Prefix: ';
    $output .= esc_html( $table_prefix );
    $output .= "\r\n";

    $output .= 'WordPress: ';
    $output .= get_bloginfo( 'version', 'display' );

    if ( is_multisite() ) {
        $output .= ' Multisite ';
        $output .= '('.( is_subdomain_install() ? 'subdomain' : 'subdirectory' ).')';
        $output .= "\r\n";
        $output .= 'Multisite Site Count: ';
        $output .= esc_html( get_blog_count() );
    }

    $output .= "\r\n";

    $output .= 'Web Server: ';
    $output .= wp_kses( $server_software, [  ] );
    $output .= "\r\n";

    $output .= 'PHP: ';

    if ( function_exists( 'phpversion' ) ) {
        $output .= esc_html( phpversion() );
    }

    $output .= "\r\n";

    $output .= 'Database Server Version: ';
    $output .= esc_html( pbwp_get_mysql_version() );
    $output .= "\r\n";

    $output .= 'ext/mysqli: ';
    $output .= empty( $wpdb->use_mysqli ) ? 'no' : 'yes';
    $output .= "\r\n";

    $output .= 'PHP Memory Limit: ';

    if ( function_exists( 'ini_get' ) ) {
        $output .= esc_html( ini_get( 'memory_limit' ) );
    }

    $output .= "\r\n";

    $output .= 'WP Memory Limit: ';
    $output .= esc_html( WP_MEMORY_LIMIT );
    $output .= "\r\n";

    $output .= 'POST max size: ';

    if ( function_exists( 'ini_get' ) ) {
        $output .= esc_html( ini_get( 'post_max_size' ) );
    }

    $output .= "\r\n";

    $output .= 'Max Input Size: ';

    if ( function_exists( 'ini_get' ) ) {
        $output .= esc_html( ini_get( 'max_input_vars' ) );
    }

    $output .= "\r\n";

    $output .= 'Memory Usage: ';
    $output .= size_format( memory_get_usage( true ) );
    $output .= "\r\n";

    $output .= 'Blocked External HTTP Requests: ';

    if ( ! defined( 'WP_HTTP_BLOCK_EXTERNAL' ) || ! WP_HTTP_BLOCK_EXTERNAL ) {
        $output .= 'None';
    } else {
        $accessible_hosts = ( defined( 'WP_ACCESSIBLE_HOSTS' ) ) ? WP_ACCESSIBLE_HOSTS : '';

        if ( empty( $accessible_hosts ) ) {
            $output .= 'ALL';
        } else {
            $output .= 'Partially (Accessible Hosts: '.esc_html( $accessible_hosts ).')';
        }

    }

    $output .= "\r\n";

    $output .= 'WP Locale: ';
    $output .= esc_html( get_locale() );
    $output .= "\r\n";

    $output .= 'Organize uploads by month/year: ';
    $output .= esc_html( get_option( 'uploads_use_yearmonth_folders' ) ? 'Enabled' : 'Disabled' );
    $output .= "\r\n";

    $output .= 'WP_DEBUG: ';
    $output .= esc_html(  ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 'Yes' : 'No' );
    $output .= "\r\n";

    $output .= 'WP_DEBUG_LOG: ';
    $output .= esc_html(  ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) ? 'Yes' : 'No' );
    $output .= "\r\n";

    $output .= 'WP_DEBUG_DISPLAY: ';
    $output .= esc_html(  ( defined( 'WP_DEBUG_DISPLAY' ) && WP_DEBUG_DISPLAY ) ? 'Yes' : 'No' );
    $output .= "\r\n";

    $output .= 'SCRIPT_DEBUG: ';
    $output .= esc_html(  ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? 'Yes' : 'No' );
    $output .= "\r\n";

    $output .= 'WP Max Upload Size: ';
    $output .= esc_html( size_format( wp_max_upload_size() ) );
    $output .= "\r\n";

    $output .= 'PHP Time Limit: ';

    if ( function_exists( 'ini_get' ) ) {
        $output .= esc_html( ini_get( 'max_execution_time' ) );
    }

    $output .= "\r\n";

    $output .= 'PHP Error Log: ';

    if ( function_exists( 'ini_get' ) ) {
        $output .= esc_html( ini_get( 'error_log' ) );
    }

    $output .= "\r\n";

    $output .= 'WP Cron: ';
    $output .= esc_html(  ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) ? 'Disabled' : 'Enabled' );
    $output .= "\r\n";

    $output .= 'fsockopen: ';

    if ( function_exists( 'fsockopen' ) ) {
        $output .= 'Enabled';
    } else {

        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'allow_url_fopen: ';
    $allow_url_fopen = ini_get( 'allow_url_fopen' );

    if ( empty( $allow_url_fopen ) ) {
        $output .= 'Disabled';
    } else {
        $output .= 'Enabled';
    }

    $output .= "\r\n";

    $output .= 'OpenSSL: ';

    if ( pbwp_open_ssl_enabled() ) {
        $output .= esc_html( OPENSSL_VERSION_TEXT );
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'SSL: ';
    $output .= ( is_ssl() ? 'Yes' : 'No' );
    $output .= "\r\n";

    $output .= 'cURL: ';

    if ( function_exists( 'curl_init' ) ) {
        $output .= 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'Zlib Compression: ';

    if ( function_exists( 'gzcompress' ) ) {
        $output .= 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'PHP GD: ';

    if ( pbwp_gd_enabled() ) {
        $gd_info = gd_info();
        $output .= isset( $gd_info[ 'GD Version' ] ) ? esc_html( $gd_info[ 'GD Version' ] ) : 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'Imagick: ';

    if ( pbwp_imagick_enabled() ) {
        $output .= 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'Basic Auth: ';

    if ( isset( $_SERVER[ 'REMOTE_USER' ] ) || isset( $_SERVER[ 'PHP_AUTH_USER' ] ) || isset( $_SERVER[ 'REDIRECT_REMOTE_USER' ] ) ) {
        $output .= 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n";

    $output .= 'Proxy: ';

    if ( defined( 'WP_PROXY_HOST' ) || defined( 'WP_PROXY_PORT' ) ) {
        $output .= 'Enabled';
    } else {
        $output .= 'Disabled';
    }

    $output .= "\r\n\r\n";

    $media_counts = pbwp_diagnostic_media_counts();

    $output .= 'Media Files: ';
    $output .= number_format_i18n( $media_counts[ 'all' ] );
    $output .= "\r\n";

    $output .= 'Number of Image Sizes: ';
    $sizes = count( get_intermediate_image_sizes() );
    $output .= number_format_i18n( $sizes );
    $output .= "\r\n\r\n";

    $output .= 'Names and Dimensions of Image Sizes: ';
    $output .= "\r\n";
    $size_details = pbwp_get_image_sizes_details();
    $output .= $size_details;
    $output .= "\r\n";

    $output .= 'WP_CONTENT_DIR: ';
    $output .= esc_html(  ( defined( 'WP_CONTENT_DIR' ) ) ? WP_CONTENT_DIR : 'Not defined' );
    $output .= "\r\n";

    $output .= 'WP_CONTENT_URL: ';
    $output .= esc_html(  ( defined( 'WP_CONTENT_URL' ) ) ? WP_CONTENT_URL : 'Not defined' );
    $output .= "\r\n";

    $output .= 'WP_UPLOAD_DIR: ';
    $output .= esc_html( pbwp_get_wordpress_uploads_directory_path() );
    $output .= "\r\n";

    $output .= 'WP_FONT_DIR: ';
    $output .= esc_html( PBWP_Fonts_Manager::get_folder() );
    $output .= "\r\n";

    $output .= 'WP_PLUGIN_DIR: ';
    $output .= esc_html(  ( defined( 'WP_PLUGIN_DIR' ) ) ? WP_PLUGIN_DIR : 'Not defined' );
    $output .= "\r\n";

    $output .= 'WP_PLUGIN_URL: ';
    $output .= esc_html(  ( defined( 'WP_PLUGIN_URL' ) ) ? WP_PLUGIN_URL : 'Not defined' );
    $output .= "\r\n\r\n";

    $theme_info = wp_get_theme();
    $output .= 'Active Theme Name: '.esc_html( $theme_info->get( 'Name' ) )."\r\n";
    $output .= 'Active Theme Folder: '.esc_html( basename( $theme_info->get_stylesheet_directory() ) )."\r\n";

    if ( $theme_info->get( 'Template' ) ) {
        $output .= 'Parent Theme Folder: '.esc_html( $theme_info->get( 'Template' ) )."\r\n";
    }

    if ( ! file_exists( $theme_info->get_stylesheet_directory() ) ) {
        $output .= "WARNING: Active Theme Folder Not Found\r\n";
    }

    $output .= "\r\n";

    $output .= "Active Plugins:\r\n";
    $active_plugins = (array) get_option( 'active_plugins', [  ] );
    $plugin_details = [  ];

    if ( is_multisite() ) {
        $network_active_plugins = wp_get_active_network_plugins();
        $active_plugins         = array_map( 'pbwp_remove_wp_plugin_dir', $network_active_plugins );
    }

    foreach ( $active_plugins as $plugin ) {
        $plugin_details[  ] = pbwp_get_plugin_details( WP_PLUGIN_DIR.'/'.$plugin );
    }

    asort( $plugin_details );
    $output .= implode( '', $plugin_details );

    $mu_plugins = wp_get_mu_plugins();

    if ( $mu_plugins ) {
        $mu_plugin_details = [  ];
        $output .= "\r\n";
        $output .= "Must-use Plugins:\r\n";

        foreach ( $mu_plugins as $mu_plugin ) {
            $mu_plugin_details[  ] = pbwp_get_plugin_details( $mu_plugin );
        }

        asort( $mu_plugin_details );
        $output .= implode( '', $mu_plugin_details );
    }

    $dropins = get_dropins();

    if ( $dropins ) {
        $output .= "\r\n\r\n";
        $output .= "Drop-ins:\r\n";

        foreach ( $dropins as $file => $dropin ) {
            $output .= $file.( isset( $dropin[ 'Name' ] ) ? ' - '.$dropin[ 'Name' ] : '' );
            $output .= "\r\n";
        }

    }

    return $output;
}

function pbwp_custom_action_row( $actions, $post )
{

    $general_sst      = pbwp_get_option( 'stt_general' );
    $general_postType = ( isset( $general_sst[ 'wpc_post_type' ] ) ? sanitize_text_field( $general_sst[ 'wpc_post_type' ] ) : 'post, page' );
    $general_postType = array_map( 'trim', explode( ',', $general_postType ) );

    if ( pbwp_is_disabled() ) {
        return $actions;
    }

    if ( in_array( $post->post_type, $general_postType ) ) {
        //check capabilites
        $post_type_object = get_post_type_object( $post->post_type );

        if ( ! $post_type_object ) {
            return $actions;
        }

        if ( ! current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
            return $actions;
        }

        add_filter( 'pbwp_editor_builder_params', 'pbwp_editor_builder_params_filter', 99, 2 );

        $actions = array_merge( $actions, [
            'wpc_action' => sprintf( '<a href="%1$s">%2$s</a>',
                esc_url( pbwp_generate_customizer_link( $post->ID, $post, true ) ),
                esc_html__( 'Edit with WP Composer', 'page-builder-wp' )
            ),
         ]
        );

        return $actions;

    } else {
        return $actions;
    }

}

function pbwp_add_post_state( $post_states, $post )
{

    $post_types = pbwp_get_supported_post_types();

    if ( in_array( $post->post_type, $post_types ) && pbwp_is_has_row( $post->ID ) ) {
        $post_states[ 'wpcomposer' ] = 'WP Composer Page';

        return $post_states;
    }

    return $post_states;

}

function pbwp_get_metaid_by_key( $post_id, $meta_key )
{

    $cache_key = 'pbwp_all_pages'.esc_html( $post_id );
    $mid       = wp_cache_get( $cache_key );

    if ( false === $mid ) {

        global $wpdb;
        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
        $mid = $wpdb->get_var( $wpdb->prepare( "SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key ) );

        if ( $mid !== null ) {
            wp_cache_set( $cache_key, (int) $mid );
        }

    }

    return (int) $mid;

}

function pbwp_generate_item_list()
{

    $theLists = apply_filters( 'pbwp_item_list', [
        'textEditor'        => [ 'name' => 'Text Block', 'category' => 'content', 'wpc_item' => true ],
        'typeImage'         => [ 'name' => 'Single Image', 'category' => 'media', 'wpc_item' => true ],
        'imageGallery'      => [ 'name' => 'Image Gallery', 'category' => 'images', 'wpc_item' => true ],
        'imageSlider'       => [ 'name' => 'Image Slider', 'category' => 'images', 'wpc_item' => true ],
        'singleTitle'       => [ 'name' => 'Custom Heading', 'category' => 'content', 'wpc_item' => true ],
        'rowInner'          => [ 'name' => 'Row Inner', 'category' => 'content', 'wpc_item' => true ],
        'typeMaps'          => [ 'name' => 'Google Maps', 'category' => 'media', 'wpc_item' => true ],
        'typeVideoPlayer'   => [ 'name' => 'Video Player', 'category' => 'media', 'wpc_item' => true ],
        'youtubeGallery'    => [ 'name' => 'YouTube Gallery', 'category' => 'media', 'wpc_item' => true ],
        'typeCTA'           => [ 'name' => 'Call to Action', 'category' => 'content', 'wpc_item' => true ],
        'typeButton'        => [ 'name' => 'Button', 'category' => 'content', 'wpc_item' => true ],
        'typeTAB'           => [ 'name' => 'Tabs', 'category' => 'content', 'wpc_item' => true ],
        'typeAccordion'     => [ 'name' => 'Accordion', 'category' => 'content', 'wpc_item' => true ],
        'typeList'          => [ 'name' => 'List', 'category' => 'content', 'wpc_item' => true ],
        'typePBAR'          => [ 'name' => 'Progress Bar', 'category' => 'chart', 'wpc_item' => true ],
        'typeRoundChart'    => [ 'name' => 'Round Chart', 'category' => 'chart', 'wpc_item' => true ],
        'typeLineChart'     => [ 'name' => 'Line Chart', 'category' => 'chart', 'wpc_item' => true ],
        'table'             => [ 'name' => 'Table', 'category' => 'chart', 'wpc_item' => true ],
        'typePricing'       => [ 'name' => 'Pricing Table', 'category' => 'marketing', 'wpc_item' => true ],
        'featureBox'        => [ 'name' => 'Feature Box', 'category' => 'content', 'wpc_item' => true ],
        'productBox'        => [ 'name' => 'Product Box', 'category' => 'marketing', 'wpc_item' => true ],
        'counterUp'         => [ 'name' => 'Counter Box', 'category' => 'content', 'wpc_item' => true ],
        'typeIcon'          => [ 'name' => 'Icon', 'category' => 'content', 'wpc_item' => true ],
        'typeSeparator'     => [ 'name' => 'Separator', 'category' => 'content', 'wpc_item' => true ],
        'spacing'           => [ 'name' => 'Spacing', 'category' => 'content', 'wpc_item' => true ],
        'imageComparison'   => [ 'name' => 'Image Comparison', 'category' => 'creative', 'wpc_item' => true ],
        'links'             => [ 'name' => 'Links', 'category' => 'content', 'wpc_item' => true ],
        'socialLink'        => [ 'name' => 'Social Link', 'category' => 'social', 'wpc_item' => true ],
        'blog'              => [ 'name' => 'Blog', 'category' => 'content', 'wpc_item' => true ],
        'postCarousel'      => [ 'name' => 'Post Carousel', 'category' => 'content', 'wpc_item' => true ],
        'alertBox'          => [ 'name' => 'Message Box', 'category' => 'content', 'wpc_item' => true ],
        'htmlRAW'           => [ 'name' => 'Raw HTML', 'category' => 'creative', 'wpc_item' => true ],
        'wpMETA'            => [ 'name' => 'WP Meta', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpTCloud'          => [ 'name' => 'WP Tag Cloud', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpRCPost'          => [ 'name' => 'WP Recent Posts', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpRCCom'           => [ 'name' => 'WP Recent Comments', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpCAT'             => [ 'name' => 'WP Categories', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpVideo'           => [ 'name' => 'WP Video', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'wpAudio'           => [ 'name' => 'WP Audio', 'category' => 'wpwidgets', 'wpc_item' => true ],
        'imageCarousel'     => [ 'name' => 'Image Carousel', 'category' => 'pro, images', 'wpc_item' => true, 'pro' => true ],
        'imageFlipster'     => [ 'name' => 'Image Flipster', 'category' => 'pro, images', 'wpc_item' => true, 'pro' => true ],
        'typeTimeline'      => [ 'name' => 'Content Timeline', 'category' => 'pro, creative', 'wpc_item' => true, 'pro' => true ],
        'newsletterForm'    => [ 'name' => 'Newsletter Form', 'category' => 'pro, marketing', 'wpc_item' => true, 'pro' => true ],
        'typeFBPageFeed'    => [ 'name' => 'FaceBook Page Feed', 'category' => 'pro, social', 'wpc_item' => true, 'pro' => true ],
        'typeTwitter'       => [ 'name' => 'Twitter Feed', 'category' => 'pro, social', 'wpc_item' => true, 'pro' => true ],
        'typeInstagram'     => [ 'name' => 'Instagram Feed', 'category' => 'pro, social', 'wpc_item' => true, 'pro' => true ],
        'typeEventCalendar' => [ 'name' => 'Event Calendar', 'category' => 'pro, content', 'wpc_item' => true, 'pro' => true ],
        'pricingList'       => [ 'name' => 'Pricing List', 'category' => 'pro, marketing', 'wpc_item' => true, 'pro' => true ],
        'contactForm'       => [ 'name' => 'Contact Form', 'category' => 'pro, marketing', 'wpc_item' => true, 'pro' => true ],
        'testimonial'       => [ 'name' => 'Testimonial', 'category' => 'pro, marketing', 'wpc_item' => true, 'pro' => true ],
        'testimonialSlider' => [ 'name' => 'Testimonial Slider', 'category' => 'pro, marketing', 'wpc_item' => true, 'pro' => true ],
     ] );

    return $theLists;

}

function pbwp_generate_responsive_devices()
{

    global $wp_customize;

    $previewable_devices = array_keys( $wp_customize->get_previewable_devices() );

    $devices = apply_filters( 'pbwp_responsive_devices', [
        'desktop'               => [ 'title' => 'Desktop', 'class' => 'wpc-i-layout-default' ],
        'tablet'                => [ 'title' => 'Tablet Portrait', 'class' => 'wpc-i-portrait-tablets' ],
        'landscape-tablets'     => [ 'title' => 'Tablet Landscape', 'class' => 'wpc-i-landscape-tablets' ],
        'mobile'                => [ 'title' => 'Smartphone Portrait', 'class' => 'wpc-i-portrait-smartphones' ],
        'landscape-smartphones' => [ 'title' => 'Smartphone Landscape', 'class' => 'wpc-i-landscape-smartphones' ],
     ] );

    $devices = array_intersect_key( $devices, array_flip( $previewable_devices ) );

    return $devices;

}

function pbwp_theme_not_supported_responsive_devices()
{

    $themes = [ 'neve' ];

    return apply_filters( 'pbwp_theme_not_supported_responsive_devices', $themes );

}

function pbwp_generate_icon_item_list( $key, $tag )
{

    $inline_css = '';
    $icon_class = 'wpc-default-item';

    if ( ! pbwp_is_wpc_item( $key ) && function_exists( 'pbwp_addons' ) ) {

        $addon_cfg  = pbwp_addons()->get_addon_config( $key );
        $icon_class = 'wpc-addons-item-icon';

        if ( isset( $addon_cfg[ 'icon' ] ) ) {

            if ( filter_var( $addon_cfg[ 'icon' ], FILTER_VALIDATE_URL ) === false ) {
                $icon_class = $icon_class.' '.$addon_cfg[ 'icon' ];
            } else {
                $inline_css = ' style="background-image: url('.esc_url( $addon_cfg[ 'icon' ] ).')"';
            }

        } else {

            $icon_class = $icon_class.' wpc-i-rocket wpc-item-no-icon';

        }

    }

    return '<'.esc_html( $tag ).' class="cp-icon '.esc_attr( $icon_class ).' item-type-'.esc_attr( strtolower( $key ) ).'" aria-hidden="true"'.$inline_css.'></'.$tag.'>';

}

function pbwp_generate_addons_icon_url()
{

    $list_icon = [  ];

    if ( function_exists( 'pbwp_addons' ) ) {

        $addons = pbwp_addons()->get_addons();

        if ( $addons ) {

            foreach ( $addons as $addon ) {

                if ( isset( $addon->addon_params[ 'base_name' ] ) ) {

                    if ( ! isset( $addon->addon_params[ 'icon' ] ) || filter_var( $addon->addon_params[ 'icon' ], FILTER_VALIDATE_URL ) === false ) {
                        $list_icon[ $addon->addon_params[ 'base_name' ] ] = esc_url( pbwp_frontend_asset_url( 'img/addon.png' ) );
                    } else {
                        $list_icon[ $addon->addon_params[ 'base_name' ] ] = esc_url( $addon->addon_params[ 'icon' ] );
                    }

                }

            }

        }

    }

    return $list_icon;

}

function pbwp_is_wpc_item( $type )
{

    $list = pbwp_generate_item_list();

    if ( $type != '' && isset( $list[ $type ] ) && isset( $list[ $type ][ 'wpc_item' ] ) && $list[ $type ][ 'wpc_item' ] ) {
        return true;
    }

    return false;

}

function pbwp_render_fonts()
{

    $fonts = pbwp_get_option( 'user_fonts' );

    if ( isset( $fonts ) && is_array( $fonts ) && count( $fonts ) > 0 ) {
        return $fonts;
    } else {
        return [  ];
    }

}

function pbwp_render_pages()
{

    $pages = pbwp_get_option( 'user_wpc_pages' );

    if ( isset( $pages ) && is_array( $pages ) && count( $pages ) > 0 ) {
        return $pages;
    } else {
        return [  ];
    }

}

function pbwp_render_templates( $noData = false )
{

    $templates = pbwp_get_option( 'user_templates' );

    if ( isset( $templates ) && is_array( $templates ) && count( $templates ) > 0 ) {

        if ( $noData ) {

            foreach ( $templates as $key => $val ) {
                unset( $templates[ $key ][ 'template' ] );
            }

        }

        return $templates;
    } else {
        return [  ];
    }

}

function pbwp_render_presets()
{

    $presets = pbwp_get_option( 'user_presets' );

    if ( isset( $presets ) && is_array( $presets ) && count( $presets ) > 0 ) {
        return $presets;
    } else {
        return [ 'noPreset' => '' ];
    }

}

function pbwp_add_preset_category( $cats )
{

    $extra_cat = [
        'columnEDITOR' => [ 'name' => 'Column', 'category' => 'none' ],
        'rowEDITOR'    => [ 'name' => 'Row', 'category' => 'none' ],
     ];

    $cats = array_merge( $cats, $extra_cat );

    return $cats;

}

function pbwp_supported_plugins_list()
{

    $plugins = [  ];

    if ( defined( 'PBWP_GHOZYLAB_FORM' ) ) {
        // Contact Form
        $plugins = array_merge( [ 'ghozylabForm' ], $plugins );
    }

    if ( defined( 'PBWP_GHOZYLAB_SLIDER' ) ) {
        // Image Slider
        $plugins = array_merge( [ 'ghozylabSlider' ], $plugins );
    }

    if ( defined( 'PBWP_GHOZYLAB_INSTAGRAM' ) ) {
        // Instagram Feed
        $plugins = array_merge( [ 'ghozylabInstagram' ], $plugins );
    }

    if ( defined( 'PBWP_GHOZYLAB_GALLERY' ) ) {
        // Image Gallery
        $plugins = array_merge( [ 'ghozylabGallery' ], $plugins );
    }

    if ( defined( 'PBWP_GHOZYLAB_NOTIFY' ) ) {
        // Easy notify
        $plugins = array_merge( [ 'ghozylabEasyNotify' ], $plugins );
    }

    return $plugins;

}

function pbwp_use_gutenberg( $result, $postType )
{

    $general_sst = pbwp_get_option( 'stt_general' );
    $post_type   = pbwp_get_post_types();

    if ( isset( $general_sst[ 'disable_gutenberg' ] ) && $general_sst[ 'disable_gutenberg' ] == 'active' && in_array( $postType, $post_type ) ) {
        return false;
    }

    return $result;

}

function pbwp_get_deprecated_items()
{

    $item_list  = pbwp_generate_item_list();
    $deprecated = 'deprecated';
    $found      = false;

    array_walk_recursive( $item_list, function ( &$value, $key ) use ( &$deprecated, &$found ) {

        if ( $key == 'category' && $value == $deprecated ) {
            $found = true;
        }

    } );

    return $found;

}

function pbwp_insert_deprecated_cat( $cats )
{

    $cats[ 'deprecated' ] = 'Deprecated';

    return $cats;

}

function pbwp_generate_event_calendar_themes()
{

    $themes     = [ 'default', 'cerulean', 'cosmo', 'cyborg', 'darkly', 'flatly', 'journal', 'litera', 'lumen', 'lux', 'materia', 'minty', 'pulse', 'sandstone', 'simplex', 'sketchy', 'slate', 'solar', 'spacelab', 'superhero', 'united', 'yeti' ];
    $all_themes = [  ];

    foreach ( $themes as $val ) {

        $all_themes[  ] = [ $val, ucfirst( $val ) ];

    }

    return $all_themes;

}

function pbwp_deep_search( $array, $key, $value, $retKey )
{
    $results = [  ];

    if ( is_array( $array ) ) {

        if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {

            if ( isset( $array[ $retKey ] ) ) {
                $results[  ] = $array[ $retKey ];
            }

        }

        foreach ( $array as $subarray ) {
            $results = array_merge( $results, pbwp_deep_search( $subarray, $key, $value, $retKey ) );
        }

    }

    return $results;

}

function pbwp_get_inner_row( $id, $postID )
{

    $builder_data = pbwp_get_global_options( $postID, 'all' );
    $row_index    = array_search( $id, array_column( $builder_data[ 'builder' ], 'id' ) );

    $all_parents   = pbwp_deep_search( $builder_data[ 'builder' ][ $row_index ], 'type', 'rowInner', 'id' );
    $all_row_inner = [  ];

    if ( ! empty( $all_parents ) ) {

        foreach ( $all_parents as $parent ) {
            $all_row_inner = array_merge( $all_row_inner, pbwp_deep_search( $builder_data[ 'builder' ], 'inner_of', $parent, 'id' ) );
        }

        if ( ! empty( $all_row_inner ) ) {
            return $all_row_inner;
        }

    }

    return [  ];

}

function pbwp_wp_editor_toolbar1()
{

    $items = 'formatselect,bold,italic,underline,bullist,numlist,blockquote,alignleft,aligncenter,alignright,alignjustify,link,unlink,wp_more,spellchecker,wp_adv,button_import';

    return $items;

}

function pbwp_wp_editor_toolbar2()
{

    $items = 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help';

    return $items;

}

function pbwp_wp_editor_plugins()
{

    $plugins = 'charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview';

    return $plugins;

}

function pbwp_get_builder_default_settings( $type )
{

    if ( $type === 'width' ) {
        return apply_filters( 'pbwp_builder_default_width', 400 );
    }

    if ( $type === 'theme' ) {
        return apply_filters( 'pbwp_builder_default_theme', 'dark' );
    }

    if ( $type === 'position' ) {
        return apply_filters( 'pbwp_builder_default_position', 'left' );
    }

}

function pbwp_generate_pro_box()
{

    ob_start();
    ?>
<div class="wpc_pro_unlock">
    <img src="<?php echo esc_url( PBWP_DIR.'/inc/dist/images/wpc_50.png' ); ?>">
    <div>
        <?php esc_html_e( 'Note: This feature is only available in Preview mode for free version. Unlock it with our Pro plan for full access', 'page-builder-wp' );?>
    </div>
</div>
<?php

    return ob_get_clean();
}

function pbwp_apply_templates( $data )
{

    $render_fonts = false;

    $newData  = $data[ 'data' ];
    $template = (object) $data[ 'data' ];
    /* Get Main Data */
    $mainData = pbwp_get_data( $template->post_id, true );

    if ( $template->source === 'hub' && array_key_exists( 'gFonts', $template->templateData ) ) {
        /* Check for Google Fonts */
        $wpc_fonts = pbwp_get_option( 'user_fonts' );

        if ( ! is_array( $wpc_fonts ) ) {
            $wpc_fonts = [  ];
            pbwp_update_option( 'user_fonts', $wpc_fonts );
        }

        foreach ( $template->templateData[ 'gFonts' ] as $fontName => $fontParams ) {

            if ( isset( $wpc_fonts[ $fontName ] ) ) {
                continue;
            }

            // Add to font list
            $wpc_fonts[ $fontName ] = $fontParams;
            // Set to local
            PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => 'add', 'font_data' => [ 'family' => $fontName ] ] );

        }

        pbwp_update_option( 'user_fonts', $wpc_fonts );

        $render_fonts = true;

    }

    if ( $template->source === 'no_template' || $template->source === 'my_template' ) {

        if ( $template->source === 'no_template' ) {
            $newData = [  ];
        }

        if ( $template->source === 'my_template' && ( $template->id !== 'default' || $template->id !== null ) ) {
            $my_templates = pbwp_render_templates();
            $key          = array_search( $template->id, array_column( $my_templates, 'id' ) );
            $newData      = pbwp_decode_encode_data( $my_templates[ $key ][ 'template' ], 'decode' );
        }

    } else {
        $newData = $template->templateData[ 'mainData' ];
    }

    $tempData = [ 'builder' => $newData ];

    if ( ! pbwp_css_route_check( $tempData ) ) {

        $tempData = pbwp_data_upgrade( $tempData, $template->post_id, 'css' );

        $newData = $tempData[ 'builder' ];

        // Need to check and update the item options that use group mode format
        if ( ! class_exists( 'PBWP_Upgrade_Mapper' ) ) {
            require_once pbwp_manager()->path( 'GLOBAL_DIR', 'class-wpc-upgrade-mapper.php' );
        }

        $mapper  = new PBWP_Upgrade_Mapper;
        $newData = $mapper->upgradeOptionsFormat( $tempData );
        $newData = $newData[ 'builder' ];

    }

    if ( isset( $template->type ) ) {

        if ( $template->type !== 'presets' ) {
            $mainData[ 'builder' ] = [  ];
        }

        /* Need to replace all data if user choose my_template (no append) */
        if ( $template->source === 'my_templates' ) {
            $mainData[ 'builder' ] = $newData;
        } else {
            foreach ( $newData as $eachRow ) {
                $mainData[ 'builder' ][  ] = $eachRow;
            }
        }

        if ( isset( $template->saveOnly ) && $template->saveOnly ) {

            $all_templates = pbwp_get_option( 'user_templates' );
            $new_template  = [ 'id' => esc_html( $template->saveOnly[ 'id' ] ), 'title' => esc_html( $template->saveOnly[ 'title' ] ), 'created' => current_time( 'timestamp' ), 'plugin_version' => PBWP_VERSION, 'template' => pbwp_decode_encode_data( $mainData[ 'builder' ] ) ];

            if ( ! isset( $all_templates ) || ! is_array( $all_templates ) ) {
                $all_templates = [  ];
            }

            $all_templates[  ] = $new_template;

            pbwp_update_option( 'user_templates', $all_templates );

        }

    }

    return [ 'data' => $mainData, 'render_fonts' => $render_fonts, 'type' => $template->type ];

}

function pbwp_decode_encode_data( $data, $mode = 'encode' )
{

    if ( $mode == 'encode' ) {

        $mainData = base64_encode( wp_json_encode( $data ) );
        /* Sanitize data */
        $newData = sanitize_text_field( $mainData );

        return $newData;

    }

    $mainData = base64_decode( $data );
    $newData  = json_decode( $mainData, true );

    return $newData;

}

function pbwp_get_data( $postID, $decode = false )
{

    $mainData = get_post_meta( $postID, 'wp_composer', true );

    return $decode ? pbwp_decode_encode_data( $mainData, 'decode' ) : $mainData;

}

function pbwp_get_my_account_info()
{

    $my_sst = pbwp_get_option( 'my' );

    if ( isset( $my_sst[ 'my' ] ) && isset( $my_sst[ 'my' ][ 'token' ] ) && trim( $my_sst[ 'my' ][ 'token' ] !== '' ) ) {
        return $my_sst;
    }

    return false;

}

function pbwp_get_my_token()
{

    $my_sst = pbwp_get_option( 'my' );

    if ( isset( $my_sst[ 'my' ] ) && isset( $my_sst[ 'my' ][ 'token' ] ) && $my_sst[ 'my' ][ 'token' ] != '' ) {
        return $my_sst[ 'my' ][ 'token' ];
    }

    return 'no_token';

}
