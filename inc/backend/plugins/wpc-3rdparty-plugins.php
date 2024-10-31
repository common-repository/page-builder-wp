<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_load_3rdparty_plugins_support()
{

    include_once ABSPATH.'wp-admin/includes/plugin.php';

	// WooCommerce Support
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) || class_exists( 'WooCommerce' ) ) {

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'woocommerce/wpc-woocommerce.php' );
        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'woocommerce/wpc-woocommerce-fields.php' );

    }

	// Contact Form 7 Support
    if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) || defined( 'WPCF7_PLUGIN' ) ) {

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'cf7/wpc-cf7.php' );

    }

	// GhozyLab - Contact Form Lite / Pro
    if ( is_plugin_active( 'contact-form-lite/easy-contact-form.php' ) || is_plugin_active( 'easy-contact-form-pro/easy-contact-form-pro.php' ) ) {

        if ( ! defined( 'PBWP_GHOZYLAB_FORM' ) ) {
            define( 'PBWP_GHOZYLAB_FORM', true );
        }

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'ghozylab/wpc-ghozylab.php' );

    }

	// GhozyLab - Slider Lite / Pro
    if ( is_plugin_active( 'image-slider-widget/easy-slider-widget-lite.php' ) || is_plugin_active( 'easy-image-slider-pro/easy-image-slider-pro.php' ) ) {

        if ( ! defined( 'PBWP_GHOZYLAB_SLIDER' ) ) {
            define( 'PBWP_GHOZYLAB_SLIDER', true );
        }

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'ghozylab/wpc-ghozylab.php' );

    }

	// GhozyLab - Instagram Feed Lite / Pro
    if ( is_plugin_active( 'feed-instagram-lite/feed-instagram-lite.php' ) || is_plugin_active( 'instagram-feed-pro/instagram-feed-pro.php' ) ) {

        if ( ! defined( 'PBWP_GHOZYLAB_INSTAGRAM' ) ) {
            define( 'PBWP_GHOZYLAB_INSTAGRAM', true );
        }

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'ghozylab/wpc-ghozylab.php' );

    }

	// GhozyLab - Gallery Lite / Pro / Developer
    if ( is_plugin_active( 'easy-media-gallery/easy-media-gallery.php' ) || is_plugin_active( 'easy-media-gallery-pro/easy-media-gallery-pro.php' ) || is_plugin_active( 'easy-media-gallery-dev/easy-media-gallery-dev.php' ) ) {

        if ( ! defined( 'PBWP_GHOZYLAB_GALLERY' ) ) {
            define( 'PBWP_GHOZYLAB_GALLERY', true );
        }

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'ghozylab/wpc-ghozylab.php' );

    }

	// GhozyLab - Easy Notify Lite / Pro
    if ( is_plugin_active( 'easy-notify-lite/easy-notify-lite.php' ) || is_plugin_active( 'easy-notify-pro/easy-notify-pro.php' ) ) {

        if ( ! defined( 'PBWP_GHOZYLAB_NOTIFY' ) ) {
            define( 'PBWP_GHOZYLAB_NOTIFY', true );
        }

        require_once pbwp_manager()->path( 'BACK_PLUGINS', 'ghozylab/wpc-ghozylab.php' );

    }

}
// Go!
pbwp_load_3rdparty_plugins_support();