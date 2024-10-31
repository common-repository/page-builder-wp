<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div id="section_pages" class= "postbox">
   <div class="inside">
      <div id="design_pages_settings" class="format-pages">
         <div class="format-pages-wrap">
        <h2 class="wpc_panel_title"><?php esc_html_e( 'You can utilize the Pages Manager to oversee your existing pages, posts, or custom posts that are already utilizing WP Composer for their layout. You can effortlessly initiate a scan by clicking the green button below to retrieve the most up-to-date information regarding your pages, posts, or custom posts.', 'page-builder-wp' );?></h2>
         <?php echo wp_kses( pbwp_pages_list(), pbwp_wp_kses_allowed_html() ); ?>
         </div>
         <div class="data_editor_overlay"><div class="lb_loading"></div><div class="data_editor_cont"><span class="wpc-i-failed wpc_data_editor_close"></span><textarea id="wpc-data-editor"></textarea><div class="wpc_data_edit_footer"><span class="wpc_button wpc_button_normal wpc_blue_color wpc_data_update"><?php esc_html_e( 'Update Data', 'page-builder-wp' );?></span></div></div></div>
      </div>
   </div>
</div>

<?php

function pbwp_pages_list()
{

    $page_content  = '';
    $all_pages     = pbwp_render_pages();
    $default_title = apply_filters( 'default_page_template_title', esc_html__( 'Default layout', 'page-builder-wp' ), 'meta-box' );

    $page_content .= '<div class="wpc_scan_page_cont"><span class="wpc_button wpc_button_normal wpc_green_color wpc_scan_pages" data-action="scan_pages">'.esc_html__( 'Scan Pages', 'page-builder-wp' ).'</span></div>';
    $page_content .= '<table class="wpc-bordered"><thead><tr><th scope="col">'.esc_html__( 'Title', 'page-builder-wp' ).'</th><th scope="col">'.esc_html__( 'Layout', 'page-builder-wp' ).'</th><th scope="col">'.esc_html__( 'Actions', 'page-builder-wp' ).'</th></tr></thead><tbody class="wpc_pages_content">';

    if ( count( $all_pages ) == 0 ) {
        $page_content .= '<tr><td>'.esc_html__( 'There are currently no pages available.', 'page-builder-wp' ).'</td><td>'.esc_html__( 'none', 'page-builder-wp' ).'</td><td>'.esc_html__( 'none', 'page-builder-wp' ).'</td></tr>';
        $page_content .= '</tbody></table>';

        return $page_content;

    }

    foreach ( $all_pages as $k => $pg ) {

        $tpl        = get_post_meta( $pg[ 'post_id' ], '_wp_page_template', true );
        $tpl_markup = '<td><div class="each_page_tpl"><span>'.esc_html__( 'none', 'page-builder-wp' ).'</span></div></td>';

        if ( $tpl == '' ) {
            $tpl = 'default';
        }

        ob_start();
        ?>
			<select class="each_page_tpl_selector" data-tpl-id="<?php echo esc_attr( $pg[ 'post_id' ] ); ?>">
				<option value="default"><?php echo esc_html( $default_title ); ?></option>
				<?php page_template_dropdown( $tpl, $pg[ 'post_type' ] );?>
			</select>
			<?php

        $tpls = ob_get_clean();

        $tpl_markup = '<td><div class="each_page_tpl">'.$tpls.'</div></td>';

        $page_content .= '<tr><td id="eachpage'.esc_attr( $pg[ 'post_id' ] ).'" class="each_page_type"><p>'.esc_html( $pg[ 'post_title' ] ).'</p><span class="each_page_post_type">- '.esc_html( $pg[ 'post_type' ] ).'</span></td>'.wp_kses( $tpl_markup, pbwp_wp_kses_allowed_html() ).'<td><div data-page-id="'.esc_attr( $pg[ 'post_id' ] ).'" class="each_pages_actions"><i data-action="edit_wpc" class="wpc-i-wpc tooltip" data-ttl="'.esc_html__( 'Edit with WP Composer', 'page-builder-wp' ).'"></i><i data-action="edit_data" class="wpc-i-file_info tooltip" data-ttl="'.esc_html__( 'Edit Data', 'page-builder-wp' ).'"></i><i data-action="visit" class="wpc-i-link tooltip" data-ttl="'.esc_html__( 'Visit Page', 'page-builder-wp' ).'"></i><i data-action="backup" class="wpc-i-preset tooltip" data-ttl="'.esc_html__( 'Backup WP Composer data', 'page-builder-wp' ).'"></i><i data-action="restore" class="wpc-i-restore tooltip" data-ttl="'.esc_html__( 'Restore WP Composer data', 'page-builder-wp' ).'"></i><i data-action="reset" class="wpc-i-update tooltip" data-ttl="'.esc_html__( 'Reset WP Composer data', 'page-builder-wp' ).'"></i><i data-action="remove" class="wpc-i-remove tooltip" data-ttl="'.esc_html__( 'Delete all WP Composer data from this page', 'page-builder-wp' ).'"></i></div></td></tr>';

    }

    $page_content .= '</tbody></table>';

    return $page_content;

}
