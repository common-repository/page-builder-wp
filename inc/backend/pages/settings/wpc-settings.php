<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_global_settings_screen()
{

    ob_start();

    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_style( 'wpc-pages' );
	wp_enqueue_style( 'wpc-vendors' );
    wp_enqueue_script( 'wpc-vendors' );
    wp_enqueue_script( 'wpc-pages' );

    $cm_settings = array();

    if ( 'wp-composer_page_wpc-global-settings' === get_current_screen()->id ) {
        $cm_settings['codeEditor'] = wp_enqueue_code_editor( array( 'type' => 'application/json' ) );
        wp_enqueue_script( 'wp-theme-plugin-editor' );
        wp_enqueue_style( 'wp-codemirror' );
    }

    $opt = array(
        'rest_url'        => rest_url( PBWP_REST_NAMESPACE.'/' ),
        'cm_settings'     => $cm_settings,
        'tour_reset_ok'   => esc_html__( 'Product tour has been reset', 'page-builder-wp' ),
        'tour_disable_ok' => esc_html__( 'Product tour has been disabled', 'page-builder-wp' ),
        'undos_limit'     => esc_html__( 'You can\'t set the value greater than 100. It will consume too much browser memory.', 'page-builder-wp' ),
    );

    wp_localize_script( 'wpc-pages', 'wpc_stt_localize', $opt );

    ?>
	<div class="wrap">
	<div class="panelloader ploader"></div>
	<div class="settings-wrap wpc-general-settings-wrap" id="page-settings">
		<div id="option-tree-header-wrap">
			<ul id="option-tree-header">
				<li id="option-tree-version"><i class="wpc-i-settings"></i><span class="wpc_stt_page_title"><?php echo esc_html( PBWP_NAME );?></span></li>
				<li id="option-tree-version"><span>v <?php echo esc_html( PBWP_VERSION );?></span></li>
			</ul>
		</div>
		<div id="option-tree-settings-api">
			<div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
				<ul >
					<li class="wpc_tab_items"><a href="#section_general"><i class="wpc-i-settings"></i><?php esc_html_e( 'General Settings', 'page-builder-wp' );?></a></li>
					<li class="wpc_tab_items"><a href="#section_template"><i class="wpc-i-grid-thin"></i><?php esc_html_e( 'Template Manager', 'page-builder-wp' );?></a></li>
                    <li class="wpc_tab_items"><a href="#section_preset"><i class="wpc-i-preset"></i><?php esc_html_e( 'Preset Manager', 'page-builder-wp' );?></a></li>
					<li class="wpc_tab_items"><a href="#section_fonts"><i class="wpc-i-fonts"></i><?php esc_html_e( 'Font Manager', 'page-builder-wp' );?></a></li>
					<li class="wpc_tab_items"><a href="#section_pages"><i class="wpc-i-file_info"></i><?php esc_html_e( 'Page Manager', 'page-builder-wp' );?></a></li>
					<li class="wpc_tab_items"><a href="#section_info"><i class="wpc-i-dashboard"></i><?php esc_html_e( 'Site Info', 'page-builder-wp' );?></a></li>
				</ul>
		<div id="poststuff" class="metabox-holder">
			<div id="post-body">
				<div id="post-body-content">

	<?php require_once 'wpc-general-settings.php';?>
	<?php require_once 'wpc-template-manager.php';?>
    <?php require_once 'wpc-preset-manager.php';?>
	<?php require_once 'wpc-fonts-manager.php';?>
	<?php require_once 'wpc-pages-manager.php';?>
    <?php require_once 'wpc-site-info-settings.php';?>
	<input id="wpc-json-restore" type="file" accept=".json"/>
					</div>
				</div>
			</div>
		<div class="clear"></div>
		</div>
	   </div>
	</div>
	</div>

	<?php

    $content = ob_get_clean();
	echo wp_kses( $content, pbwp_wp_kses_allowed_html() );
	
}