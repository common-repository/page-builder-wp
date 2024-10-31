<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Customize_Control extends WP_Customize_Control
{

    /**
     * The type of customize control being rendered.
     *
     * @access public
     * @since  1.1
     * @var    string
     */
    public $type = 'wpc_builder';

    /**
     * Add our JavaScript and CSS to the Customizer.
     *
     * @access public
     * @since  1.1
     * @return void
     */
    public function enqueue()
    {

        global $wp_customize;

        $stt_general  = pbwp_get_option( 'stt_general' );
        $stt_ui       = pbwp_get_option( 'user_interface' );
        $tour_mode_on = ( isset( $stt_ui[ 'show_tour' ] ) && $stt_ui[ 'show_tour' ] == 'yes' && ! is_rtl() ? true : false );

        if ( get_user_option( 'rich_editing' ) != 'true' ) {
            /* Prevent TinyMCE error when current user disable the visual editor when writing */
            add_filter( 'user_can_richedit', '__return_true', 50 );
        }

        // WP Repo
        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-slider' );
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'jquery-ui-draggable' );
        wp_enqueue_script( 'jquery-ui-resizable' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'jquery-effects-transfer' );
        wp_enqueue_script( 'jquery-effects-highlight' );
        wp_enqueue_script( 'mediaelement-vimeo' );
        wp_enqueue_script( 'wp-mediaelement' );
        wp_enqueue_style( 'wp-mediaelement' );
        wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ).'wp-tinymce.php', [  ], PBWP_VERSION, true );

        wp_enqueue_script( 'wpc-core', pbwp_distribution_url( 'js/core.bundle.js' ), [ 'jquery', 'imagesloaded', 'customize-controls', 'customize-preview', 'jquery-ui-core', 'wp-editor' ], PBWP_VERSION, true );
        wp_enqueue_script( 'wpc-addons', pbwp_distribution_url( 'js/addons.bundle.js' ), [  ], PBWP_VERSION, true );

        wp_enqueue_script( 'wpc-editor-utils', pbwp_distribution_url( 'js/utils.bundle.js' ), [  ], PBWP_VERSION, true );
        wp_enqueue_script( 'wpc-editor', pbwp_distribution_url( 'js/editor.bundle.js' ), [  ], PBWP_VERSION, true );

        wp_enqueue_script( 'wpc-editor-vendors', pbwp_distribution_url( 'js/vendors.bundle.js' ), [  ], PBWP_VERSION, true );
        wp_enqueue_script( 'wpc-editor-apps', pbwp_distribution_url( 'js/apps.bundle.js' ), [  ], PBWP_VERSION, true );

        if ( $tour_mode_on ) {
            wp_enqueue_script( 'enjoyhint-bundle', pbwp_distribution_url( 'js/enjoyHint.bundle.js' ), [  ], PBWP_VERSION, true );
        }

        // Load Live Editor Properties
        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'maps/wpc-live-editor-maps.php' );
        wp_localize_script( 'wpc-core', 'wpc_live_editor', apply_filters( 'pbwp_live_editor_props', pbwp_live_editor_props() ) );

        $opt = [
            'is_rtl'                    => ( is_rtl() ? true : false ),
            'is_customize_preview'      => is_customize_preview() ? true : false,
            'distribution_dir'          => esc_url( PBWP_DIR.'/inc/dist/' ),
            'backend_asset_dir'         => esc_url( PBWP_DIR.'/inc/backend/assets/' ),
            'front_asset_dir'           => esc_url( PBWP_DIR.'/inc/frontend/assets/' ),
            'wpc_ajax_nonce'            => wp_create_nonce( 'wpc_ajax_nonce' ),
            'rest_url'                  => rest_url( PBWP_REST_NAMESPACE.'/' ),
            'token'                     => true,
            'wpc_hub_url'               => PBWP_HUB_URL,
            'wpc_fonts_api_url'         => PBWP_GOOGLE_FONTS_API,
            'wpc_fonts_family_url'      => PBWP_GOOGLE_FONTS_URL,
            'wpc_fonts_api_key'         => ( isset( $stt_general[ 'gfonts_key' ] ) && $stt_general[ 'gfonts_key' ] != '' ? $stt_general[ 'gfonts_key' ] : 'AIzaSyAxr9m-FC-GvuvExHcbimHlVzwu9OyCrG0' ),
            'tour_mode_on'              => $tour_mode_on,
            'supported_post_type'       => pbwp_get_post_types(),
            'supported_themes'          => apply_filters( 'pbwp_supported_themes_list', pbwp_is_compatible_theme() ),
            'supported_plugins'         => apply_filters( 'pbwp_supported_plugins_list', pbwp_supported_plugins_list() ),
            'supported_addons'          => apply_filters( 'pbwp_supported_addons_list', [  ] ),
            'item_refresh_after_insert' => pbwp_get_item_refresh_after_insert(),
            'undo_limit'                => ( isset( $stt_general[ 'max_undo' ] ) ? $stt_general[ 'max_undo' ] : 10 ),
            'wpc_maps_version'          => PBWP_FIELD_MAPS_VERSION,
            'is_gmaps_ready'            => pbwp_get_google_maps_api_key() ? true : false,
            'icons_lib_version'         => PBWP_ICON_LIB_VERSION,
            'shape_divider_version'     => PBWP_SHAPE_DIVIDER_VERSION,
            'icons_dashicons_url'       => includes_url( '/css/dashicons.min.css' ),
            'wpc_id_length'             => pbwp_id_length(),
            'builder_default_width'     => pbwp_get_builder_default_settings( 'width' ),
            'builder_default_theme'     => pbwp_get_builder_default_settings( 'theme' ),
            'builder_default_position'  => pbwp_get_builder_default_settings( 'position' ),
            'js_strings'                => pbwp_i18n( 'backend' ),
            'baseUrl'                   => plugin_dir_url( __DIR__ ),
            'user_locale'               => 'locale-'.sanitize_html_class( strtolower( str_replace( '_', '-', get_user_locale() ) ) ),
            'wp_editor_height'          => apply_filters( 'pbwp_wp_editor_default_height', 250 ),
            'wp_editor_toolbar1'        => apply_filters( 'pbwp_wp_editor_toolbar1', pbwp_wp_editor_toolbar1() ),
            'wp_editor_toolbar2'        => apply_filters( 'pbwp_wp_editor_toolbar2', pbwp_wp_editor_toolbar2() ),
            'wp_editor_plugins'         => apply_filters( 'pbwp_wp_editor_plugins', pbwp_wp_editor_plugins() ),
            'wp_editor_quicktags'       => ( isset( $stt_general[ 'disable_visualtext' ] ) && $stt_general[ 'disable_visualtext' ] == 'active' ? false : true ),
            'wp_editor_ext_plugins'     => [ 'wpc_import_content' => pbwp_distribution_url( 'js/tinyMceAddon.bundle.js' ) ],
            'auto_open_editor'          => ( isset( $stt_general[ 'disable_auto_open_editor' ] ) && $stt_general[ 'disable_auto_open_editor' ] == 'active' ? false : true ),
            'editor_field_to_encode'    => apply_filters( 'pbwp_editor_field_to_encode', [ 'field-textarea', 'field-texteditor' ] ),
            'addon_icons'               => pbwp_generate_addons_icon_url(),
            'hotkeys'                   => pbwp_generate_hotkeys(),
            'previewable_devices'       => $wp_customize->get_previewable_devices(),
            'favorites_items'           => pbwp_get_favorites_items(),
            'global_colors'             => pbwp_get_option( 'user_colors' ),
            'use_row_meta_data'         => PBWP_ITEM_META_DATA,
            'my_info'                   => pbwp_get_my_account_info(),
            'my_url'                    => PBWP_MY_URL,
            'my_endpoint'               => PBWP_MY_URL.'/api/v1',
            'my_web_data'               => base64_encode( serialize( [
                'site_url'   => get_site_url(),
                'site_title' => get_bloginfo( 'name' ),
             ] ) ),
         ];

        wp_localize_script( 'wpc-core', 'wpc_localize', $opt );

        wp_localize_script( 'wpc-editor-apps', 'wpc_hub_localize',
            [
                'nonce'             => wp_create_nonce( 'wpc_ajax_nonce' ),
                'is_rtl'            => is_rtl() ? true : false,
                'downloadDelay'     => apply_filters( 'pbwp_hub_download_delay', 150 ),
                'my_templates'      => pbwp_render_templates( true ),
                'backend_asset_dir' => esc_url( PBWP_DIR.'/inc/backend/assets/' ),
                'hub_url'           => PBWP_HUB_URL,
                'lang'              => pbwp_i18n( 'hub' ),
             ]
        );

        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'maps/ai/wpc-ai-maps.php' );
        wp_localize_script( 'wpc-editor-apps', 'wpc_ai_localize',
            [
                'lang'                 => pbwp_i18n( 'ai' ),
                'maps'                 => pbwp_ai_maps(),
                'siteData'             => [
                    'title'       => get_bloginfo( 'name' ),
                    'description' => get_option( 'blogdescription' ),
                 ],
                'promptSuggestions'    => [
                    'code'        => [ esc_html__( 'Please create code for', 'page-builder-wp' ), esc_html__( 'Implement a CSS for', 'page-builder-wp' ), esc_html__( 'Generate a code snippet for', 'page-builder-wp' ), esc_html__( 'Act as a web developer. Generate a', 'page-builder-wp' ) ],
                    'title'       => [ esc_html__( 'Craft a catchy slogan for', 'page-builder-wp' ), esc_html__( 'Create a blog title for', 'page-builder-wp' ), esc_html__( 'Suggest 5 word headline for', 'page-builder-wp' ), esc_html__( 'Create a SEO Friendly title about', 'page-builder-wp' ) ],
                    'description' => [ esc_html__( 'Create a blog post about', 'page-builder-wp' ), esc_html__( 'Write a SEO Friendly', 'page-builder-wp' ), esc_html__( 'Write a product description for', 'page-builder-wp' ), esc_html__( 'Offer a detailed review of a', 'page-builder-wp' ), esc_html__( 'Write a case study detailing', 'page-builder-wp' ), esc_html__( 'Write an informative article about', 'page-builder-wp' ) ],
                 ],
                'max_prompt_histories' => apply_filters( 'pbwp_max_ai_prompt_histories', 10 ),
             ]
        );

        // Load User Presets
        wp_localize_script( 'wpc-core', 'wpc_presets', apply_filters( 'pbwp_presets', pbwp_render_presets() ) );
        // Load User Templates
        wp_localize_script( 'wpc-core', 'wpc_templates', apply_filters( 'pbwp_templates', pbwp_render_templates() ) );
        // Load 3rd party item maps
        wp_localize_script( 'wpc-core', 'wpcAddonsFields', apply_filters( 'pbwp_editor_maps', [  ] ) );

        if ( ! function_exists( 'pbwp_sanitize_options' ) ) {
            require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-sanitize.php' );
        }

        $user_fonts = pbwp_get_option( 'user_fonts' );
        wp_localize_script( 'wpc-core', 'wpcFontsData', [
            'wpc_fonts'    => $user_fonts,
            'wpc_my_fonts' => $user_fonts,
         ] );

        // Main css
        wp_enqueue_style( 'wpc-vendor', pbwp_distribution_url( 'css/vendorCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION );
        wp_enqueue_style( 'wpc-editor', pbwp_distribution_url( 'css/editorCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION );

        // 3rdParty Scripts
        wp_enqueue_style( 'animate', pbwp_frontend_asset_url( 'css/vendors/animate/animate.min.css' ), [  ], PBWP_VERSION );

        do_action( 'pbwp_editor_enqueue_styles' );
        do_action( 'pbwp_editor_enqueue_scripts', [ 'jquery', 'customize-controls' ] );

    }

    /**
     * An Underscore (JS) template for this control's content.
     *
     * Class variables for this control class are available in the `data` JS object;
     * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
     *
     * @see    WP_Customize_Control::print_template()
     *
     * @access protected
     * @since  1.1
     * @return void
     */
    protected function render_content()
    {

        if ( ! class_exists( 'PBWP_Markup_Creator' ) ) {
            require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
        }

        $create = new PBWP_Markup_Creator();

        if ( $this->label ) {
            echo '<span class="customize-control-title">'.esc_html( $this->label ).'</span>';
        }

        if ( $this->label ) {
            echo '<span class="description customize-control-description">'.esc_html( $this->description ).'</span>';
        }

        echo '<label for="control-section-option-id-'.esc_attr( $this->id ).'"><span class="screen-reader-text">'.esc_html( $this->label ).'</span></label>';
        ?>
<!-- wpc-main START -->
<div class="wpc-main">
    <div class="wpc-create-builder">
        <?php $create->postList();?>
    </div>
    <!-- This is default settings panel for each items -->
    <div class="def-editor-controls-cont">
        <?php $create->default_Editor_Panel();?>
        <?php $create->default_Fields();?>
        <?php do_action( 'pbwp_editor_custom_panel' );?>
    </div> <!-- Editor END -->
    <?php do_action( 'pbwp_editor_main_container' );?>
</div> <!-- wpc-main END -->
<div class="customize-control-notifications"></div>
<input class="wpc-customize-setting-link" value="" data-customize-setting-link="wpc_sections" type="text">
<?php

    }

}