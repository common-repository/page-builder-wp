<?php

// File Security Check

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Woocommerce extends PBWP_Item_Loader
{

    protected $identity = [ 'wooproducts', 'woorecentproducts', 'wooproductpage', 'wooproductcategory', 'wooproductcategories', 'woomyaccount', 'woocart', 'woocheckout', 'wooordertrack' ];

    public function render()
    {

        $data = $this->data;

        $item_markup = '';
        $wooType     = strtolower( $data[ 'type' ] );
        $wooIds      = pbwp_get_item_options( $data, 'woo_ids', '' );
        $per_page    = pbwp_get_item_options( $data, 'per_page', 12 );
        $columns     = pbwp_get_item_options( $data, 'columns', 4 );
        $order       = pbwp_get_item_options( $data, 'order', 'ASC' );
        $noEditor    = [ 'woocart', 'woocheckout', 'wooordertrack' ];

        if ( in_array( $wooType, $noEditor ) ) {
            $this->custom_class = 'no_ditor';
        }

        $item_markup .= '<div class="wpc_item_typewoocommerce">';

        if ( $wooType == 'wooproducts' || $wooType == 'wooproductpage' || $wooType == 'wooproductcategory' || $wooType == 'wooproductcategories' ) {
            // or any item that use IDs

            $orderby     = pbwp_get_item_options( $data, 'orderby', 'post__in' );
            $current_ids = array_filter( explode( ',', $wooIds ) );

            if ( empty( $current_ids ) ) {

                $item_markup .= '<span class="wpc-error-msg"><i class="wpc-i-warning"></i>WooCommerce Error: '.esc_html__( 'No IDs found!', 'page-builder-wp' ).'</span>';

            } else {

                // Woo Product(s) Type
                if ( $wooType == 'wooproducts' ) {
                    // Multiple Products
                    if ( count( $current_ids ) > 1 ) {
                        $item_markup .= do_shortcode( '[products columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'" ids="'.implode( ',', $current_ids ).'"]' );
                    } else {
                        // Single Product
                        $item_markup .= do_shortcode( '[product id="'.implode( ',', $current_ids ).'"]' );
                    }

                }

                // Woo Product Page Type
                if ( $wooType == 'wooproductpage' ) {

                    if ( pbwp_get_item_options( $data, 'woo_related_products', 'no' ) != 'yes' ) {
                        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
                    }

                    if ( class_exists( 'WC_Frontend_Scripts' ) ) {

                        if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
                            wp_enqueue_script( 'zoom' );
                        }

                        if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
                            wp_enqueue_script( 'flexslider' );
                        }

                        if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
                            wp_enqueue_script( 'photoswipe-ui-default' );
                            wp_enqueue_style( 'photoswipe-default-skin' );
                            add_action( 'wp_footer', 'woocommerce_photoswipe' );
                        }

                        wp_enqueue_script( 'wc-single-product' );

                    }

                    $item_markup .= do_shortcode( '[product_page id="'.implode( ',', $current_ids ).'"]' );

                }

                // Woo Product Category Type
                if ( $wooType == 'wooproductcategory' ) {

                    $catID = $current_ids[ 0 ];
                    $term  = get_term_by( 'id', $catID, 'product_cat', 'ARRAY_A' );

                    $item_markup .= do_shortcode( '[product_category per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'" category="'.( isset( $term[ 'slug' ] ) ? $term[ 'slug' ] : 0 ).'"]' );

                }

                // Woo Product Categories Type
                if ( $wooType == 'wooproductcategories' ) {
                    $item_markup .= do_shortcode( '[product_categories orderby="'.( $orderby == 'post__in' ? 'include' : $orderby ).'" order="'.$order.'" columns="'.$columns.'" ids="'.implode( ',', $current_ids ).'"]' );

                }

            }

        }

        // Woo Recent Products Type
        if ( $wooType == 'woorecentproducts' ) {

            $orderby = pbwp_get_item_options( $data, 'orderby', 'ID' );
            $item_markup .= do_shortcode( '[recent_products per_page="'.$per_page.'" columns="'.$columns.'" orderby="'.$orderby.'" order="'.$order.'"]' );

        }

        // Woo My Account Type
        if ( $wooType == 'woomyaccount' ) {
            $order_count = pbwp_get_item_options( $data, 'order_count', 12 );
            $item_markup .= do_shortcode( '[woocommerce_my_account order_count="'.$order_count.'"]' );
        }

        // Woo Cart Type
        if ( $wooType == 'woocart' ) {
            $item_markup .= do_shortcode( '[woocommerce_cart]' );
        }

        // Woo Checkout Type
        if ( $wooType == 'woocheckout' ) {
            $item_markup .= do_shortcode( '[woocommerce_checkout]' );
        }

        // Woo Order Track Type
        if ( $wooType == 'wooordertrack' ) {
            $item_markup .= do_shortcode( '[woocommerce_order_tracking]' );
        }

        $item_markup .= '</div>'; // End WooCommerce Markup

        return $item_markup;

    }

}
