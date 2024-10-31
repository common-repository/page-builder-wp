<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'pbwp_supported_plugins_list', 'pbwp_add_woo_to_supported_plugins' );
add_filter( 'pbwp_item_category_list', 'pbwp_add_woo_item_cat' );
add_filter( 'pbwp_item_list', 'pbwp_add_woo_items' );
add_filter( 'pbwp_woo_products_maps', 'pbwp_woo_order_maps' );
add_filter( 'pbwp_woo_recent_products_maps', 'pbwp_woo_order_maps' );
add_filter( 'pbwp_woo_product_category_maps', 'pbwp_woo_order_maps' );
add_filter( 'pbwp_woo_product_categories_maps', 'pbwp_woo_order_maps', 10, 2 );
add_filter( 'pbwp_woo_order_orderby_list', 'pbwp_woo_order_orderby_list_cat' );
add_filter( 'pbwp_editor_maps', 'pbwp_add_woo_editor_maps' );
add_action( 'wp_ajax_pbwp_woocommerce_search_product', 'pbwp_woocommerce_search_product' );
add_action( 'wp_ajax_pbwp_woo_get_product_title_by_id', 'pbwp_woo_get_product_title_by_id' );
add_filter( 'pbwp_no_editor_item', 'pbwp_woo_no_editor_list' );

function pbwp_add_woo_to_supported_plugins( $plugins )
{

    $plugins = array_merge( [ 'wooProducts', 'wooRecentProducts', 'wooProductPage', 'wooProductCategory', 'wooProductCategories', 'wooMyAccount', 'wooCart', 'wooCheckout', 'wooOrderTrack' ], $plugins );

    return $plugins;

}

function pbwp_add_woo_item_cat( $cats )
{

    $cats[ 'woocommerce' ] = 'WooCommerce';

    return $cats;

}

function pbwp_add_woo_items( $items )
{

    $extra_items = [
        'wooProducts'          => [ 'name' => 'Product(s)', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooRecentProducts'    => [ 'name' => 'Recent products', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooProductPage'       => [ 'name' => 'Product Page', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooProductCategory'   => [ 'name' => 'Product Category', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooProductCategories' => [ 'name' => 'Product Categories', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooMyAccount'         => [ 'name' => 'My Account', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooCart'              => [ 'name' => 'Cart', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooCheckout'          => [ 'name' => 'Checkout', 'category' => 'woocommerce', 'wpc_item' => true ],
        'wooOrderTrack'        => [ 'name' => 'Order Tracking', 'category' => 'woocommerce', 'wpc_item' => true ],
     ];

    foreach ( $extra_items as $key => $val ) {

        $items[ $key ] = $val;

    }

    return $items;

}

function pbwp_add_woo_editor_maps( $maps )
{
    // Products Item
    $maps[ 'addons' ][ 'wooProducts' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'STYLING', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_products_maps', [
                    [
                        'type'        => 'woo-field-search',
                        'label'       => esc_html__( 'Select Product(s)', 'page-builder-wp' ),
                        'name'        => 'woo_ids',
                        'default'     => '',
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'data-posttype',
                                'posts',
                             ],
                            [
                                'data-dynamic-fields',
                                'enable',
                             ],
                         ],
                        'desc'        => esc_html__( 'Input product Title or product SKU or product ID to see suggestions', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Columns', 'page-builder-wp' ),
                        'name'        => 'columns',
                        'default'     => 4,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => null,
                     ],
                    'xtra-class',
                 ] ),
             ],
            'style-panel'    => [
                'group'  => pbwp_woo_generate_group_menu(),
                'fields' => pbwp_woo_style_fields(),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // Recent Products Item
    $maps[ 'addons' ][ 'wooRecentProducts' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'STYLING', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_recent_products_maps', [
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Per page', 'page-builder-wp' ),
                        'name'        => 'per_page',
                        'default'     => 12,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => esc_html__( 'The "per_page" argument determines how many products to show on the page', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Columns', 'page-builder-wp' ),
                        'name'        => 'columns',
                        'default'     => 4,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => null,
                     ],
                    'xtra-class',
                 ] ),
             ],
            'style-panel'    => [
                'group'  => pbwp_woo_generate_group_menu(),
                'fields' => pbwp_woo_style_fields(),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // Products Page Item
    $maps[ 'addons' ][ 'wooProductPage' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_product_page_maps', [
                    [
                        'type'        => 'woo-field-search',
                        'label'       => esc_html__( 'Select Product', 'page-builder-wp' ),
                        'name'        => 'woo_ids',
                        'default'     => '',
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'data-posttype',
                                'posts',
                             ],
                            [
                                'data-multiple',
                                'disable',
                             ],
                         ],
                        'desc'        => esc_html__( 'Input product Title or product SKU or product ID to see suggestions', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-switch',
                        'label'       => esc_html__( 'Show Related Products?', 'page-builder-wp' ),
                        'name'        => 'woo_related_products',
                        'default'     => 'no',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'desc'        => esc_html__( 'Enable this option will show the related products in bottom of your product detail', 'page-builder-wp' ),
                     ],
                    'xtra-class',
                 ] ),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // Product Category Item
    $maps[ 'addons' ][ 'wooProductCategory' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'STYLING', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_product_category_maps', [
                    [
                        'type'        => 'woo-field-search',
                        'label'       => esc_html__( 'Select Category', 'page-builder-wp' ),
                        'name'        => 'woo_ids',
                        'default'     => '',
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'data-posttype',
                                'category',
                             ],
                            [
                                'data-multiple',
                                'disable',
                             ],
                         ],
                        'desc'        => esc_html__( 'Product category list', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Per page', 'page-builder-wp' ),
                        'name'        => 'per_page',
                        'default'     => 12,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => esc_html__( 'The "per_page" argument determines how many products to show on the page', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Columns', 'page-builder-wp' ),
                        'name'        => 'columns',
                        'default'     => 4,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => null,
                     ],
                    'xtra-class',
                 ] ),
             ],
            'style-panel'    => [
                'group'  => pbwp_woo_generate_group_menu(),
                'fields' => pbwp_woo_style_fields(),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // Product Categories Item
    $maps[ 'addons' ][ 'wooProductCategories' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_product_categories_maps', [
                    [
                        'type'        => 'woo-field-search',
                        'label'       => esc_html__( 'Categories', 'page-builder-wp' ),
                        'name'        => 'woo_ids',
                        'default'     => '',
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'data-posttype',
                                'category',
                             ],
                         ],
                        'desc'        => esc_html__( 'List of product categories', 'page-builder-wp' ),
                     ],
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Columns', 'page-builder-wp' ),
                        'name'        => 'columns',
                        'default'     => 4,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => null,
                     ],
                    'xtra-class',
                 ], true ),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // My Account Item
    $maps[ 'addons' ][ 'wooMyAccount' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
            esc_html__( 'ADVANCED', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel'  => [
                'fields' => apply_filters( 'pbwp_woo_myaccount_maps', [
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Order Count', 'page-builder-wp' ),
                        'name'        => 'order_count',
                        'default'     => 15,
                        'custom_css'  => null,
                        'custom_data' => [
                            [
                                'style',
                                'width:50%;',
                             ],
                         ],
                        'desc'        => esc_html__( 'You can specify the number or order to show, it\'s set by default to 15 (use -1 to display all orders.)', 'page-builder-wp' ),
                     ],
                    'xtra-class',
                 ] ),
             ],
            'advanced-panel' => [  ],
         ],
     ];
    // Cart Item
    $maps[ 'addons' ][ 'wooCart' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel' => [
                'fields' => [
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Cart Page', 'page-builder-wp' ),
                        'name'        => 'cart_page',
                        'default'     => 'no_settings',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'desc'        => null,
                     ],
                 ],
             ],
         ],
     ];
    // Checkout Item
    $maps[ 'addons' ][ 'wooCheckout' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel' => [
                'fields' => [
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Checkout', 'page-builder-wp' ),
                        'name'        => 'checkout_page',
                        'default'     => 'no_settings',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'desc'        => null,
                     ],
                 ],
             ],
         ],
     ];
    // Order Tracking Item
    $maps[ 'addons' ][ 'wooOrderTrack' ] = [
        'tabs'     => [
            esc_html__( 'GENERAL', 'page-builder-wp' ),
         ],
        'template' => [
            'general-panel' => [
                'fields' => [
                    [
                        'type'        => 'field-text',
                        'label'       => esc_html__( 'Order Tracking', 'page-builder-wp' ),
                        'name'        => 'ordertrack_page',
                        'default'     => 'no_settings',
                        'custom_css'  => null,
                        'custom_data' => null,
                        'desc'        => null,
                     ],
                 ],
             ],
         ],
     ];

    return $maps;

}

function pbwp_woo_order_maps( $defArray, $customOrderBy = false, $default = '' )
{

    $addArray = [
        [
            'type'        => 'field-select',
            'label'       => esc_html__( 'Order by', 'page-builder-wp' ),
            'name'        => 'orderby',
            'default'     => 'post__in',
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
            'choices'     => ( $customOrderBy ? apply_filters( 'pbwp_woo_order_orderby_list', [  ] ) : [
                [
                    'post__in',
                    esc_html__( 'Default', 'page-builder-wp' ),
                 ],
                [
                    'ID',
                    esc_html__( 'Post ID', 'page-builder-wp' ),
                 ],
                [
                    'author',
                    esc_html__( 'Author', 'page-builder-wp' ),
                 ],
                [
                    'title',
                    esc_html__( 'Title', 'page-builder-wp' ),
                 ],
                [
                    'date',
                    esc_html__( 'Date', 'page-builder-wp' ),
                 ],
                [
                    'modified',
                    esc_html__( 'Last Modified Date', 'page-builder-wp' ),
                 ],
                [
                    'rand',
                    esc_html__( 'Random Order', 'page-builder-wp' ),
                 ],
                [
                    'comment_count',
                    esc_html__( 'Number of Comments', 'page-builder-wp' ),
                 ],
                [
                    'menu_order',
                    esc_html__( 'Menu Order', 'page-builder-wp' ),
                 ],
             ] ),
         ],
        [
            'type'        => 'field-select',
            'label'       => esc_html__( 'Sort Order', 'page-builder-wp' ),
            'name'        => 'order',
            'default'     => 'ASC',
            'custom_css'  => null,
            'custom_data' => null,
            'desc'        => null,
            'choices'     => [
                [
                    'DESC',
                    esc_html__( 'Descending (DESC)', 'page-builder-wp' ),
                 ],
                [
                    'ASC',
                    esc_html__( 'Ascending (ASC)', 'page-builder-wp' ),
                 ],
             ],
         ] ];

    $lastArray = end( $defArray );
    array_pop( $defArray );

    foreach ( $addArray as $key => $val ) {
        $defArray[  ] = $val;
    }

    $defArray[  ] = $lastArray;

    return $defArray;

}

function pbwp_woo_order_orderby_list_cat( $defShortBy )
{

    $catShortBy = [
        [
            'post__in',
            esc_html__( 'Default', 'page-builder-wp' ),
         ],
        [
            'ID',
            esc_html__( 'Post ID', 'page-builder-wp' ),
         ],
        [
            'name',
            esc_html__( 'Name', 'page-builder-wp' ),
         ],
        [
            'slug',
            esc_html__( 'Slug', 'page-builder-wp' ),
         ],
        [
            'term_group',
            esc_html__( 'Term Group', 'page-builder-wp' ),
         ],
        [
            'count',
            esc_html__( 'Count', 'page-builder-wp' ),
         ],
        [
            'description',
            esc_html__( 'Description', 'page-builder-wp' ),
         ],
     ];

    return $defShortBy[  ] = $catShortBy;

}

function pbwp_woocommerce_search_product()
{

    // Verify nonce
    $nonce = isset( $_GET[ 'security' ] ) ? sanitize_text_field( $_GET[ 'security' ] ) : '';

    if ( ! wp_verify_nonce( $nonce, 'wpc_ajax_nonce' ) ) {
        // Nonce verification failed
        die();
    }

    global $wpdb;

    $search_keyword  = isset( $_GET[ 'term' ] ) ? sanitize_text_field( wp_unslash( $_GET[ 'term' ] ) ) : '';
    $current_id      = explode( ',', isset( $_GET[ 'current' ] ) ? sanitize_text_field( wp_unslash( $_GET[ 'current' ] ) ) : -1 );
    $p_type          = isset( $_GET[ 'type' ] ) ? sanitize_text_field( wp_unslash( $_GET[ 'type' ] ) ) : 'posts';
    $results         = [  ];
    $product_id      = (int) $search_keyword;
    $post_meta_infos = [  ];

    if ( $p_type == 'posts' ) {

        $post_meta_infos = wp_cache_get( 'pbwp_wc_posts' );

        if ( false === $post_meta_infos ) {
            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $post_meta_infos = $wpdb->get_results( $wpdb->prepare(
                "SELECT a.ID AS id, a.post_title AS title, b.meta_value AS sku
            FROM {$wpdb->posts} AS a
            LEFT JOIN ( SELECT meta_value, post_id  FROM {$wpdb->postmeta} WHERE `meta_key` = '_sku' ) AS b ON b.post_id = a.ID
            WHERE a.post_type = 'product' AND ( a.ID = %d OR LOWER(b.meta_value) LIKE LOWER(%s) OR LOWER(a.post_title) LIKE LOWER(%s) )",
                $product_id > 0 ? $product_id : -1,
                '%'.$wpdb->esc_like( stripslashes( $search_keyword ) ).'%',
                '%'.$wpdb->esc_like( stripslashes( $search_keyword ) ).'%'
            ), ARRAY_A );
            wp_cache_set( 'pbwp_wc_posts', $post_meta_infos );

        }

    }

    if ( $p_type == 'category' ) {

        $post_meta_infos = wp_cache_get( 'pbwp_wc_category' );

        if ( false === $post_meta_infos ) {
            // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
            $post_meta_infos = $wpdb->get_results( $wpdb->prepare(
                "SELECT a.term_id AS id, b.name as title, b.slug AS slug
            FROM {$wpdb->term_taxonomy} AS a
            INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
            WHERE a.taxonomy = 'product_cat' AND (a.term_id = %d OR b.slug LIKE %s OR b.name LIKE %s )",
                $product_id > 0 ? $product_id : -1,
                '%'.$wpdb->esc_like( stripslashes( $search_keyword ) ).'%',
                '%'.$wpdb->esc_like( stripslashes( $search_keyword ) ).'%'
            ), ARRAY_A );
            wp_cache_set( 'pbwp_wc_category', $post_meta_infos );
        }

    }

    if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
        foreach ( $post_meta_infos as $value ) {
            $data            = [  ];
            $data[ 'id' ]    = $value[ 'id' ];
            $data[ 'value' ] = ( strlen( $value[ 'title' ] ) > 0 ) ? wp_strip_all_tags( $value[ 'title' ] ) : '';
            $results[  ]     = $data;
        }

        foreach ( $current_id as $key => $val ) {
            foreach ( $results as $k => $v ) {
                if ( $val == $v[ 'id' ] ) {
                    unset( $results[ $k ] );
                }
            }
        }

        if ( empty( $results ) ) {
            $results[  ] = [ 'id' => -1, 'value' => esc_html__( 'No results', 'page-builder-wp' ) ];
        }
    } else {
        $results[  ] = [ 'id' => -1, 'value' => esc_html__( 'No results', 'page-builder-wp' ) ];
    }

    echo wp_json_encode( $results );
    die();
}

function pbwp_woo_get_product_title_by_id()
{
    // Verify nonce
    $nonce = isset( $_POST[ 'security' ] ) ? sanitize_text_field( $_POST[ 'security' ] ) : '';

    if ( ! wp_verify_nonce( $nonce, 'wpc_ajax_nonce' ) ) {
        // Nonce verification failed
        die();
    }

    $ids      = explode( ',', ( isset( $_POST[ 'ids' ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'ids' ] ) ) : -1 ) );
    $cmdType  = ( isset( $_POST[ 'cmd' ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'cmd' ] ) ) : 'posts' );
    $markup   = '';
    $cat_name = '('.esc_html__( 'no title', 'wp-composer' ).')';

    $ids = array_map( function ( $value ) {
        return str_replace( '+', '', $value );
    }, $ids );

    if ( $cmdType == 'posts' ) {

        $args = [
            'post__in'       => $ids,
            'post_type'      => 'product',
            'order'          => 'ASC',
            'orderby'        => 'post__in',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
         ];

        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) {
            //Setup post data
            $loop->the_post();

            $markup .= '<li id="'.esc_attr( $loop->post->ID ).'" class="wpc_autocomplete-label wpc_data ui-sortable-handle woo_each_product" data-value="'.esc_attr( $loop->post->ID ).'" data-label="'.esc_attr( get_the_title() ).'"><span class="wpc_autocomplete-label"><a>'.esc_html( get_the_title() ).'</a></span><a class="wpc_autocomplete-remove">x</a></li>';

        }

    }

    if ( $cmdType == 'category' ) {

        foreach ( $ids as $key => $val ) {

            if ( $term = get_term_by( 'id', $val, 'product_cat' ) ) {
                $cat_name = $term->name;
            }

            $markup .= '<li id="'.esc_attr( $val ).'" class="wpc_autocomplete-label wpc_data ui-sortable-handle woo_each_product" data-value="'.esc_attr( $val ).'" data-label="'.esc_attr( $cat_name ).'"><span class="wpc_autocomplete-label"><a>'.esc_html( $cat_name ).'</a></span><a class="wpc_autocomplete-remove">x</a></li>';

        }

    }

    echo wp_json_encode( [ 'markup' => $markup ] );

    wp_die();

}

function pbwp_woo_no_editor_list( $thelist )
{

    $wooList = [ 'wooCart', 'wooCheckout', 'wooOrderTrack' ];

    return array_merge( $thelist, $wooList );

}

function pbwp_woo_style_fields()
{

    require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'maps/wpc-maps.php' );

    $fields = [  ];

    $selectorGroup = [
        [
            'selector' => '.wpc_item_typewoocommerce .woocommerce ul.products li.product .woocommerce-loop-product__title|',
            'group'    => 'woo-title',
         ],
        [
            'selector' => '.wpc_item_typewoocommerce .woocommerce ul.products li.product .price|',
            'group'    => 'woo-price',
         ],
        [
            'selector' => '.wpc_item_typewoocommerce .woocommerce span.onsale|',
            'group'    => 'woo-onsale',
         ],
        [
            'selector' => '.wpc_item_typewoocommerce .woocommerce .star-rating, .includethis. .wpc_item_typewoocommerce .woocommerce .star-rating span, .includethis. .wpc_item_typewoocommerce .woocommerce .star-rating:before|',
            'group'    => 'woo-rating',
         ],
        [
            'selector' => '.wpc_item_typewoocommerce .woocommerce .attachment-woocommerce_thumbnail|',
            'group'    => 'woo-thumb',
         ],
     ];

    foreach ( $selectorGroup as $each ) {

        if ( $each[ 'group' ] === 'woo-thumb' ) {
            $fields = array_merge( pbwp_border_spacing_template( $each[ 'selector' ], $each[ 'group' ] ), $fields );
        } else

        if ( $each[ 'group' ] === 'woo-onsale' ) {
            $fields = array_merge( pbwp_typography_template( $each[ 'selector' ], $each[ 'group' ] ), $fields );
            $fields = array_merge( [
                [
                    'type'        => 'field-color',
                    'label'       => esc_html__( 'Background Color', 'page-builder-wp' ),
                    'name'        => $each[ 'selector' ].'background-color',
                    'default'     => null,
                    'custom_css'  => null,
                    'custom_data' => [
                        [
                            'data-group',
                            $each[ 'group' ],
                         ],
                     ],
                    'desc'        => null,
                 ],
             ], $fields );
        } else

        if ( $each[ 'group' ] === 'woo-rating' ) {
            $fields = array_merge( [
                [
                    'type'        => 'field-number',
                    'label'       => esc_html__( 'Star Size', 'page-builder-wp' ),
                    'name'        => $each[ 'selector' ].'font-size',
                    'default'     => null,
                    'custom_css'  => null,
                    'custom_data' => [
                        [
                            'data-group',
                            $each[ 'group' ],
                         ],
                        [
                            'data-add-css-relation',
                            [
                                [
                                    'selector' => '.wpc_item_typewoocommerce .woocommerce .star-rating:before',
                                    'property' => 'font-size',
                                 ],
                             ],
                         ],
                     ],
                    'desc'        => null,
                 ],
                [
                    'type'        => 'field-color',
                    'label'       => esc_html__( 'Star Color', 'page-builder-wp' ),
                    'name'        => $each[ 'selector' ].'color',
                    'default'     => null,
                    'custom_css'  => null,
                    'custom_data' => [
                        [
                            'data-group',
                            $each[ 'group' ],
                         ],
                     ],
                    'desc'        => null,
                 ],
             ], $fields );
        } else {
            $fields = array_merge( pbwp_typography_template( $each[ 'selector' ], $each[ 'group' ] ), $fields );
        }

    }

    return $fields;

}

function pbwp_woo_generate_group_menu()
{

    return [
        [
            'woo-title',
            'Product Title',
         ],
        [
            'woo-price',
            'Product Price',
         ],
        [
            'woo-onsale',
            'On Sale Badge',
         ],
        [
            'woo-rating',
            'Product Rating',
         ],
        [
            'woo-thumb',
            'Product Image',
         ],
     ];

}
