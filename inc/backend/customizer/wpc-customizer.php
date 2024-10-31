<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_customize_register( $manager )
{

    $manager->add_section(
        'wpc_builder_section',
        [
            'title'      => esc_html__( 'WP Composer', 'page-builder-wp' ),
            'capability' => 'edit_theme_options',
            'priority'   => 27,
         ]
    );

    // Frontpage Sections Builders
    $manager->add_setting(
        'wpc_sections',
        [
            'default'           => esc_html__( 'WP Composer', 'page-builder-wp' ),
            'transport'         => 'postMessage',
            'sanitize_callback' => 'esc_attr',
         ]
    );

    $manager->add_control( new PBWP_Customize_Control( $manager, 'wpc_sections_control', [
        'type'        => 'wpc_builder',
        'label'       => esc_html__( 'WP Composer', 'page-builder-wp' ),
        'description' => esc_html__( 'Just select the post type and hit Edit with WP Composer button', 'page-builder-wp' ),
        'section'     => 'wpc_builder_section',
        'settings'    => 'wpc_sections',
        'priority'    => 2,
     ] ) );

}

add_action( 'customize_register', 'pbwp_customize_register' );

function pbwp_customize_controls_enqueue_scripts()
{

    wp_enqueue_script( 'wpc-customizer-control', pbwp_distribution_url( 'js/frontendEditorGateway.bundle.js' ), [ 'jquery', 'customize-controls' ], PBWP_VERSION, false );

}

add_action( 'customize_controls_enqueue_scripts', 'pbwp_customize_controls_enqueue_scripts' );

function pbwp_customizer_live_preview()
{

    $ui_options   = pbwp_front_get_option( 'user_interface' );
    $stt_general  = pbwp_front_get_option( 'stt_general' );
    $tour_mode_on = ( isset( $ui_options[ 'show_tour' ] ) && $ui_options[ 'show_tour' ] == 'yes' && ! is_rtl() ? true : false );

    // Load WP Media
    wp_enqueue_media();
    // Global only in frontend
    wp_enqueue_script( 'waypoints' );
    wp_enqueue_script( 'jquery-masonry' );
    wp_enqueue_script( 'lazyloadjquery' );
    wp_enqueue_style( 'owl-carousel' );
    wp_enqueue_style( 'owl-carousel-theme' );
    wp_enqueue_script( 'owl-carousel' );
    wp_enqueue_style( 'lightcase' );
    wp_enqueue_script( 'lightcase' );
    // Tinymce
    wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ).'wp-tinymce.php', [  ], PBWP_VERSION, true );

    wp_enqueue_script( 'wpc-customizer-frontendeditor', pbwp_distribution_url( 'js/frontendEditor.bundle.js' ), [ 'jquery', 'customize-preview', 'customize-preview-widgets', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-resizable', 'jquery-ui-draggable' ], PBWP_VERSION, true );

    if ( $tour_mode_on ) {
        wp_enqueue_script( 'enjoyhint-bundle', pbwp_distribution_url( 'js/enjoyHint.bundle.js' ), [  ], PBWP_VERSION, true );
    }

    wp_localize_script( 'wpc-customizer-frontendeditor', 'wpc_front_localize',
        [
            'tour_mode_on'       => $tour_mode_on,
            'token'              => true,
            'asset_url'          => esc_url( PBWP_DIR.'/inc/frontend/assets/' ),
            'distribution_dir'   => esc_url( PBWP_DIR.'/inc/dist/' ),
            'backend_asset_url'  => esc_url( PBWP_DIR.'/inc/backend/assets/' ),
            'create_row_url'     => esc_url( pbwp_generate_customizer_link( get_the_ID() ) ),
            'exceptionsScripts'  => apply_filters( 'pbwp_inline_scripts_reload_exceptions', [ 'prettyphoto-js' ] ),
            'lang'               => pbwp_i18n( 'frontend' ),
            'classReplacement'   => apply_filters( 'pbwp_live_editor_selector_replacer', [  ] ),
            'useImportant'       => apply_filters( 'pbwp_live_editor_css_mark_important', [  ] ),
            'bgToBgColor'        => apply_filters( 'pbwp_live_editor_css_bg_to_bgcolor', [  ] ),
            'appsCustomSelector' => pbwp_app_custom_selector(),
            'is_rtl'             => ( is_rtl() ? true : false ),
            'hotkeys'            => pbwp_generate_hotkeys(),
            'favorites_items'    => pbwp_get_favorites_items(),
            'auto_open_editor'   => ( isset( $stt_general[ 'disable_auto_open_editor' ] ) && $stt_general[ 'disable_auto_open_editor' ] == 'active' ? false : true ),
         ]
    );

    wp_enqueue_style( 'wpc-customizer-tinymce', pbwp_distribution_url( 'css/tinyMceCss.bundle.css' ), [  ], PBWP_VERSION );
    wp_enqueue_style( 'wpc-customizer-custom-properties', pbwp_global_asset_url( 'css/wpc-custom-properties.css', false, 'ASSETS_GLOBAL_DIR' ), [  ], PBWP_VERSION, 'all' );

    wp_enqueue_style( 'wpc-frontendeditor', pbwp_distribution_url( 'css/frontendEditorCss'.( is_rtl() ? 'Rtl' : '' ).'.bundle.css' ), [  ], PBWP_VERSION );

    // 3rdParty Scripts
    do_action( 'pbwp_previewer_enqueue_styles' );
    do_action( 'pbwp_previewer_enqueue_scripts', [ 'jquery', 'customize-preview' ] );

}

add_action( 'customize_preview_init', 'pbwp_customizer_live_preview' );
// Font Manager
add_action( 'customize_controls_print_footer_scripts', 'pbwp_create_markup_in_footer' );

function pbwp_create_markup_in_footer()
{

    $wpc_fonts = pbwp_get_option( 'user_fonts' );

    if ( ! is_array( $wpc_fonts ) ) {
        $wpc_fonts = [  ];
    }

    $count           = count( $wpc_fonts );
    $create          = new PBWP_Markup_Creator();
    $simpleBarMarkup = 'data-simplebar data-simplebar-auto-hide=false data-simplebar-direction='.( is_rtl() ? 'rtl' : 'ltr' );

    ob_start();
    ?>
<!-- popup-contents-box START -->
<div id="wpc-fixed-menu-header" class="wpc-menu-header wpc_all_noselect animated slideInDown">
    <div class="wpc-builder-left-menus">
        <div class="wpc-popup-header-title wp-composer-title"><span
                class="wpc_name"><?php echo esc_html( PBWP_NAME ); ?></span>
        </div>
    </div>
    <div class="wpc-builder-right-menus">
        <div data-action="undo" class="right-menu-item wpc-popup-undo wpc-popup-undo-redo is_empty mtips"><span
                class="mt-mes"><?php esc_html_e( 'Undo', 'page-builder-wp' );?></span><i
                class="wpc-popup-tpl wpc-i-undo"></i>
        </div>
        <div data-action="redo" class="right-menu-item wpc-popup-redo wpc-popup-undo-redo is_empty mtips"><span
                class="mt-mes"><?php esc_html_e( 'Redo', 'page-builder-wp' );?></span><i
                class="wpc-popup-tpl wpc-i-redo"></i>
        </div>
        <div class="right-menu-item wpc-popup-preview-opt"><span id="screen-size-current"
                class="wpc-i-layout-default"></span>
            <ul class="wpc_dropdown-list">
                <?php

    foreach ( pbwp_generate_responsive_devices() as $dKey => $eachDvce ) {
        echo '<li><span title="'.esc_attr( $eachDvce[ 'title' ] ).'" class="wpc_screen-width '.esc_attr( $eachDvce[ 'class' ] ).'" data-device="'.esc_attr( $dKey ).'"></span></li>';
    }

    ?>
            </ul>
        </div>
        <div class="right-menu-item wpc-popup-template mtips"><span
                class="mt-mes"><?php esc_html_e( 'Access Online Templates &amp; Presets', 'page-builder-wp' );?></span><i
                class="wpc-popup-tpl wpc-i-cloud-download"></i><span class="hub_info_sign"></span></div>
        <div class="right-menu-item wpc-popup-switch-theme mtips"><span
                class="mt-mes"><?php esc_html_e( 'Switch theme to Dark or Light', 'page-builder-wp' );?></span><i
                data-switch="light" class="wpc-i-dark"></i>
        </div>
        <div class="right-menu-item wpc-popup-navigator mtips"><span
                class="mt-mes"><?php esc_html_e( 'Element Navigator', 'page-builder-wp' );?></span><i
                class="wpc-i-navigator"></i>
        </div>
        <div class="right-menu-item wpc-popup-add-item mtips"><span
                class="mt-mes"><?php esc_html_e( 'Add Item', 'page-builder-wp' );?></span><i
                class="wpc-i-add-normal"></i>
        </div>
        <div class="right-menu-item wpc-popup-global-stt mtips"><span
                class="mt-mes"><?php esc_html_e( 'Global Settings', 'page-builder-wp' );?></span><i
                class="wpc-i-settings"></i>
        </div>
        <div class="right-menu-item wpc-my-user">
            <img class="wpc-my-user-avatar" src="">
        </div>
        <div class="wpc_user_info_box">
            <div class="wpc_user_info_h"><?php esc_html_e( 'My WP Composer', 'page-builder-wp' );?><i
                    class="wpc_my_settings wpc-i-settings"></i></div>
            <div class="wpc_my_user_info_cont">
                <p></p>
            </div>
        </div>
        <div class="right-menu-item wpc-exit-builder mtips">
            <span class="mt-mes"><?php esc_html_e( 'Exit Builder', 'page-builder-wp' );?></span><i
                class="wpc-i-popup-close"></i>
        </div>
    </div>
</div>
<div id="popup-contents-box">
    <div id="wpc-editor" class="wpc_all_noselect wpc-popup-box normal_position builder_is_blank">
        <div class="wpc-popup-header">
            <div class="wpc-builder-left-menus">
                <div class="wpc-popup-header-title wp-composer-title">
                    <span data-wpc-title="<?php echo esc_attr( PBWP_NAME ); ?>" class="wpc_name">
                        <?php echo esc_html( PBWP_NAME ); ?>
                    </span>
                </div>
            </div>
            <div class="wpc-builder-right-menus">
                <div class="right-menu-item wpc-popup-dock mtips"><span
                        class="mt-mes"><?php esc_html_e( 'Dock Mode', 'page-builder-wp' );?></span><i
                        class="wpc-popup-dockmode wpc-i-columns"></i></div>
                <div class="right-menu-item wpc-popup-expand mtips"><span
                        class="mt-mes"><?php esc_html_e( 'Fullscreen', 'page-builder-wp' );?></span><i
                        class="wpc-popup-fullscreen wpc-i-fullscreen"></i></div>
                <div class="right-menu-item wpc-editor-close wpc-popup-close"></div>
            </div>
        </div>
        <div <?php echo esc_attr( $simpleBarMarkup ); ?> id="editor-simplebar" class="wpc-popup-content-cont">
            <div class="wpc-popup-content">
                <div class="wpc-popup-options less-margin-bottom">
                    <!-- Content Editor -->
                    <p class="control-opt-label"><span class="wpc-i-content title-icon"></span><span
                            data-default-title="<?php esc_attr_e( 'Content Editor', 'page-builder-wp' );?>"
                            class="on-edit-title"><?php esc_html_e( 'Content Editor', 'page-builder-wp' );?></span></p>
                    <div id="wpc-editor-holder" class="wpc-popup-opt"><span class="tabloader"></span></div>
                </div><!-- Content Editor End -->
            </div>
        </div>
        <div class="wpc-popup-footer">
            <span class="popup-button popup-save wpc_click_fx"><i class="wpc-i-correct"></i></span><span
                class="popup-button popup-close wpc_click_fx"><i class="wpc-i-failed"></i></span><span
                class="wpc-version-footer"><?php echo esc_html( 'Version', 'page-builder-wp' ).' '.esc_html( PBWP_VERSION ); ?></span>
        </div>
        <div class="wpc-resizable-handle ui-resizable-handle ui-resizable-we"></div>
        <div class="wpc-resizable-handle ui-resizable-handle ui-resizable-ew"></div>
    </div>
</div> <!-- popup-contents-box END -->

<!-- Item Picker START -->
<div class="items-selector-box wpc-popup-box items-picker wpc_all_noselect animated fadeInDownBig">
    <?php $create->itemLists();?>
    <!-- This is list for all available items inside item picker box -->
</div> <!-- Item Picker END -->

<!-- Online Template Manager START -->
<div class="wpc-template-manager-lightbox">
    <div class="wpc-template-manager-lightbox-content">
        <div class="wpc-template-header">
            <div class="wpc-template-header-title">
                <?php esc_html_e( 'Online Templates &amp; Presets', 'page-builder-wp' );?></div>
            <div class="wpc-template-header-close"></div>
        </div>
        <div id="wpc-template-manager">
            <div id="wpc-template-render">
                <div class="wpc_template_sidemenu">
                    <div class="hub-cloud-app-sidebar">
                        <div class="hub-cloud-app-sidebar__content">
                            <h2><?php esc_html_e( 'Find A layout', 'page-builder-wp' );?></h2>
                            <div class="hub-cloud-app-search hub-fb-modules-filters hub-fb-module-single-filter"><label
                                    for="filter"><?php esc_html_e( 'Search', 'page-builder-wp' );?></label>
                                <div class="hub-cloud-app-search-container hub-cloud-app-search-container-has-filter">
                                    <input type="text"
                                        class="hub-common-input-text hub-fb-settings-option-input hub-fb-settings-option-input--block hub-search-tpl"
                                        name="filter" autocomplete="off" value="">
                                </div>
                            </div>
                            <div class="hub-cloud-filter"><label
                                    class="hub-cloud-filter-title"><?php esc_html_e( 'Categories', 'page-builder-wp' );?></label>
                                <div class="hub-common-categories">
                                    <div class="hub-common-checkboxes-category-wrap">
                                        <div class="hub-inner-scroll" data-simplebar data-simplebar-auto-hide="false"
                                            data-simplebar-direction="<?php
if ( is_rtl() ) {echo 'rtl';} else {echo 'ltr';}?>">
                                            <div class="hub-category-lists">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wpc_template_section">
                    <div class="wpc-topmenu-section">
                        <div class="hub-nav-cont">
                            <div class="hub-nav-left">
                                <div class="hub_cloud_nav">
                                    <span
                                        class="hub_nav_button_option wpc-h-arrow_back hub_nav_back_to_list hub_nav_back"
                                        data-get="layout_packs"></span>
                                </div>
                                <div class="hub_nav">
                                    <span
                                        class="hub_nav_button_option wpc-h-arrow_back hub_nav_back_to_list hub_nav_back"
                                        data-get="layout_packs"></span>
                                    <span
                                        class="hub_nav_button_option wpc-button-flat wpc-button-color-blue wpc-button-size-normal"
                                        data-get="layout_packs"><?php esc_html_e( 'Layout Packs', 'page-builder-wp' );?></span>
                                    <span
                                        class="hub_nav_button_option wpc-button-flat wpc-button-color-blue wpc-button-size-normal"
                                        data-get="templates"><?php esc_html_e( 'Templates', 'page-builder-wp' );?></span>
                                    <span
                                        class="hub_nav_button_option wpc-button-flat wpc-button-color-blue wpc-button-size-normal"
                                        data-get="presets"><?php esc_html_e( 'Presets', 'page-builder-wp' );?></span>
                                </div>
                            </div>
                            <div class="hub-nav-right">
                                <i data-action="refresh_list" class="wpc-h-update hub_right_opt mtips"><span
                                        class="mt-mes"><?php esc_html_e( 'Refresh List', 'page-builder-wp' );?></span></i>
                                <i data-action="my_cloud" class="wpc-h-cloud hub_right_opt mtips"><span
                                        class="mt-mes"><?php esc_html_e( 'Cloud Templates', 'page-builder-wp' );?></span></i>
                                <i data-action="open_saved_templates" class="wpc-h-save hub_right_opt mtips"><span
                                        class="mt-mes"><?php esc_html_e( 'Local Templates', 'page-builder-wp' );?></span></i>
                                <i data-action="switch_column" class="wpc-h-grid-thin hub_right_opt mtips"><span
                                        class="mt-mes"><?php esc_html_e( 'List Mode', 'page-builder-wp' );?></span></i>
                                <i class="wpc-h-bell-o hub_right_opt wpc_hub_notify">
                                    <div class="hub_notify_box"><span class="hub_info_sign"></span><span
                                            class="hub_info_box">
                                            <p class="notify_no_info">
                                                <?php esc_html_e( 'No information', 'page-builder-wp' );?></p>
                                        </span></div>
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="wpc-topmenu-info">
                        <div class="wpc-topmenu-info-categories">
                        </div>
                        <div class="wpc-topmenu-info-description">
                        </div>
                    </div>
                    <div id="hub-content-markup" class="hub-items-simplebar hub_content_markup"></div>
                </div>
            </div>
        </div>
        <div class="wpc-template-footer"></div>
    </div>
</div> <!-- Online Template Manager END -->

<!-- fonts-manager-box START -->
<div class="wpc-font-manager-lightbox">
    <div class="wpc-font-manager-lightbox-content">
        <div class="wpc-fm-header">
            <div class="wpc-fm-header-title"><?php esc_html_e( 'Fonts Manager', 'page-builder-wp' );?></div>
            <div class="wpc-fm-header-close"></div>
        </div>
        <div class="wpc-font-fm-header-menu">
            <ul>
                <li>
                    <select id="wpc-ggf-filter">
                        <option value="popularity"><?php esc_html_e( 'Sorting', 'page-builder-wp' );?></option>
                        <option value="popularity"><?php esc_html_e( 'Popular', 'page-builder-wp' );?></option>
                        <option value="trending"><?php esc_html_e( 'Trending', 'page-builder-wp' );?></option>
                        <option value="style"><?php esc_html_e( 'Style', 'page-builder-wp' );?></option>
                        <option value="alpha"><?php esc_html_e( 'Alpha', 'page-builder-wp' );?></option>
                    </select>
                </li>
                <li>
                    <!-- Avoiding translation for font subsets name -->
                    <select id="wpc-ggf-language">
                        <option value=""><?php esc_html_e( 'All subsets', 'page-builder-wp' );?></option>
                        <option value="arabic">Arabic</option>
                        <option value="bengali">Bengali</option>
                        <option value="cyrillic">Cyrillic</option>
                        <option value="cyrillic-ext">Cyrillic Extended</option>
                        <option value="devanagari">Devanagari</option>
                        <option value="greek">Greek</option>
                        <option value="greek-ext">Greek Extended</option>
                        <option value="gujarati">Gujarati</option>
                        <option value="hebrew">Hebrew</option>
                        <option value="khmer">Khmer</option>
                        <option value="latin">Latin</option>
                        <option value="latin-ext">Latin Extended</option>
                        <option value="tamil">Tamil</option>
                        <option value="telugu">Telugu</option>
                        <option value="thai">Thai</option>
                        <option value="vietnamese">Vietnamese</option>
                    </select>
                </li>
                <li>
                    <!-- Avoiding translation for font category name -->
                    <select id="wpc-ggf-category">
                        <option value=""><?php esc_html_e( 'All Categories', 'page-builder-wp' );?></option>
                        <option value="serif">Serif</option>
                        <option value="sans-serif">Sans Serif</option>
                        <option value="display">Display</option>
                        <option value="handwriting">Handwriting</option>
                        <option value="monospace">Monospace</option>
                    </select>
                </li>
                <li class="wpc-ggf-added" data-action="my-fonts">
                    <span class="wpc-i-folder_close" data-action="my-fonts"></span>
                    <?php esc_html_e( 'My Fonts', 'page-builder-wp' );?>
                    (<span class="wpc-font-fonts-count" data-action="my-fonts"><?php echo esc_html( $count ); ?></span>)
                </li>
            </ul>
            <div class="wpc-font-right-font-search"><input type="search" id="wpc-ggf-search"
                    placeholder="<?php esc_html_e( 'Search by name', 'page-builder-wp' );?>" /></div>
        </div>
        <div id="wpc-ggf-my-fonts">
            <div id="wpc-ggf-mf-header">
                <span><?php esc_html_e( 'My Fonts', 'page-builder-wp' );?></span>
                <span class="wpc-i-close sl-close" data-action="close-my-fonts"></span>
            </div>
            <div <?php echo esc_attr( $simpleBarMarkup ); ?> id="wpc-my-font-container" class="wpc-my-font-container">
                <i
                    class="wpc-font-pleasenote"><?php esc_html_e( 'NOTE: Using too many fonts in one page can slowing down your site load', 'page-builder-wp' );?></i>
                <div class="wpc-fonts-cloud"><span data-action="load-cloud"
                        class="wpc-button-flat wpc-button-color-blue wpc-button-size-small wpc_cloud_fonts_load"><?php esc_html_e( 'Load Fonts from Cloud', 'page-builder-wp' );?></span><i
                        class="wpc-i-spinner wpc-i-spin"></i></div>
                <div id="wpc-ggf-mf-body"></div>
            </div>
        </div>
        <div <?php echo esc_attr( $simpleBarMarkup ); ?> id="wpc-fonts-manager">
            <div id="wpc-ggf-pagination-top" class="wpc-ggf-pagination"></div>
            <div id="wpc-ggf-render"><span class="tabloader"></span></div>
            <div id="wpc-ggf-pagination-bottom" class="wpc-ggf-pagination"></div>
        </div>
        <div id="wpc-fonts-manager-resource"></div>
        <div id="wpc-fonts-manager-api"></div>
        <div class="wpc-fm-footer"></div>
    </div>
</div><!-- fonts-manager-box END -->

<!-- keyshortcuts-box START -->
<div class="wpc-keyshortcuts-lightbox">
    <div class="wpc-keyshortcuts-box">
        <div class="wpc-keyshortcuts-header">
            <span class="wpc-ks-title"><?php esc_html_e( 'Keyboard Shortcuts', 'page-builder-wp' );?></span>
            <span class="wpc-ks-close wpc-i-no"></span>
        </div>
        <div <?php echo esc_attr( $simpleBarMarkup ); ?> class="wpc-keyshortcuts-content-cont">
            <div class="wpc-keyshortcuts-content">
                <ul class="wpc-shortcut-list">
                    <?php

    foreach ( pbwp_generate_hotkeys() as $key ) {
        echo '<li><span>'.esc_html( $key[ 'desc' ] ).'</span><span class="wpc-item-keycode">'.esc_html( $key[ 'key' ] ).'</span></li>';
    }

    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Navigator START -->
<div class="wpc-navigator wpc_all_noselect">
    <div class="wpc_workspace_menu">
        <i class="wpc-i-menu wpc_workspace_menu_icon"></i>
    </div>
    <div id="navigator-simplebar" class="wpc_workspace_parent"></div>
</div>
<!-- Navigator END -->
<?php

    $markups = ob_get_clean();

    echo wp_kses( $markups, pbwp_wp_kses_allowed_html() );

}

function pbwp_add_previewable_devices( $devices )
{

    if ( ! pbwp_is_compatible_theme() ) {
        return $devices;
    }

    $devices[ 'landscape-tablets' ] = [
        'label' => esc_html__( 'Enter tablet landscape preview mode', 'page-builder-wp' ),
     ];
    $devices[ 'landscape-smartphones' ] = [
        'label' => esc_html__( 'Enter mobile landscape preview mode', 'page-builder-wp' ),
     ];

    return $devices;

}

add_filter( 'customize_previewable_devices', 'pbwp_add_previewable_devices' );

function pbwp_texteditor_styles( $mceInit )
{

    $styles = 'body.mce-content-body { max-width: 100% !important;}';

    if ( isset( $mceInit[ 'content_style' ] ) ) {
        $mceInit[ 'content_style' ] .= ' '.$styles.' ';
    } else {
        $mceInit[ 'content_style' ] = $styles.' ';
    }

    return $mceInit;

}

add_filter( 'tiny_mce_before_init', 'pbwp_texteditor_styles' );

function pbwp_register_tinymce_button( $buttons )
{

    array_push( $buttons, 'button_import' );

    return $buttons;

}

add_filter( 'mce_buttons', 'pbwp_register_tinymce_button' );

add_filter( 'wp_prepare_attachment_for_js', 'pbwp_add_pexels_id_to_attachment_for_js', 10, 3 );
function pbwp_add_pexels_id_to_attachment_for_js( $response, $attachment, $meta )
{

    $pexels_id = get_post_meta( $response[ 'id' ], 'pexels_data', true );

    if ( isset( $pexels_id ) && $pexels_id !== '' && is_array( $pexels_id ) ) {
        $response[ 'pexelsData' ] = $pexels_id;
    }

    return $response;

}

function pbwp_create_markup_in_frontend()
{

    if ( ! class_exists( 'PBWP_Markup_Creator' ) ) {
        require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
    }

    if ( ! function_exists( 'pbwp_get_deprecated_items' ) ) {
        require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
    }

    $creator = new PBWP_Markup_Creator();

    if ( pbwp_get_deprecated_items() ) {
        add_filter( 'pbwp_item_category_list', 'pbwp_insert_deprecated_cat' );
    }

    ?>
<div class="items-selector-box wpc_all_noselect animated fadeInDownBig">
    <?php $creator->itemLists();?>
    <!-- This is list for all available items inside item picker box -->
</div> <!-- Item Picker END -->
<?php $creator->columnLists();?>
<!-- Column Lists END -->
<!-- Pricing Table -->
<div class="wpc_pricing_table_cont">
    <div class="wpc-pricing-table">
        <div class="wpc-pricing-column">
            <div class="wpc-pricing-header">
                <span><?php esc_html_e( 'PRO', 'page-builder-wp' );?></span>
            </div>
            <div class="wpc-pricing-price">$35</div>
            <ul class="wpc-pricing-features">
                <li><?php esc_html_e( '1 Site', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Regular Update', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Support 24/7', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Premium Items', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Layout Packs', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Online Templates', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'All Advanced Features', 'page-builder-wp' );?></li>
            </ul>
            <span data-href="https://wpcomposer.com/order.php?product=pro"
                class="wpc-pricing-button wpc-button-flat wpc-button-size-sm"><?php esc_html_e( 'Upgrade Now', 'page-builder-wp' );?></span>
        </div>
        <div class="wpc-pricing-column">
            <div class="wpc-pricing-header">
                <span><?php esc_html_e( 'PRO', 'page-builder-wp' );?> +</span>
            </div>
            <div class="wpc-pricing-price">$95</div>
            <ul class="wpc-pricing-features">
                <li><?php esc_html_e( '3 Sites', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Regular Update', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Support 24/7', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Premium Items', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Layout Packs', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'Online Templates', 'page-builder-wp' );?></li>
                <li><?php esc_html_e( 'All Advanced Features', 'page-builder-wp' );?></li>
            </ul>
            <span data-href="https://wpcomposer.com/order.php?product=proplus"
                class="wpc-pricing-button wpc-button-flat wpc-button-size-sm"><?php esc_html_e( 'Upgrade Now', 'page-builder-wp' );?></span>
        </div>
    </div>
</div>
<?php

}

add_action( 'wp_footer', 'pbwp_create_markup_in_frontend' );