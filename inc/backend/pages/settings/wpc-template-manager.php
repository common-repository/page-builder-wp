<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div id="section_template" class= "postbox">
   <div class="inside">
      <div id="design_templates_settings" class="format-templates">
         <div class="format-template-wrap">
        <h2 class="wpc_panel_title"><?php esc_html_e( 'Manage saved templates with this Template Manager for your sites.', 'page-builder-wp' );?></h2>
         <?php echo wp_kses( pbwp_templates_list(), pbwp_wp_kses_allowed_html() ); ?>
         </div>
      </div>
   </div>
</div>

<?php
function pbwp_templates_list()
{

    $templates_markup = '';
    $all_templates    = pbwp_render_templates();
    $bk_rest_cont     = '<div class="backup-restore-cont"><h2>'.esc_html__( 'When you click Backup button, system will generate a JSON file. You can save it into your computer so you can easily restore them at anytime.', 'page-builder-wp' ).'</h2><hr><span class="wpc_button wpc_button_normal wpc_blue_color wpc_backup_template templates_btn" data-action="backup">'.esc_html__( 'Backup All Templates', 'page-builder-wp' ).'</span><span class="wpc_button wpc_button_normal wpc_green_color wpc_restore_template templates_btn" data-action="restore">'.esc_html__( 'Restore Templates', 'page-builder-wp' ).'</span></div>';

    $templates_markup .= '<table class="wpc-bordered"><thead><tr><th scope="col">'.esc_html__( 'Title', 'page-builder-wp' ).'</th><th scope="col">'.esc_html__( 'Actions', 'page-builder-wp' ).'</th></tr></thead><tbody class="wpc_templates_content">';

    if ( count( $all_templates ) == 0 ) {
        $templates_markup .= '<tr><td>'.esc_html__( 'There are currently no template available.', 'page-builder-wp' ).'</td><td>'.esc_html__( 'none', 'page-builder-wp' ).'</td></tr>';
        $templates_markup .= '</tbody></table>';
        $templates_markup .= wp_kses_post( $bk_rest_cont );

        return $templates_markup;

    }

    foreach ( $all_templates as $k => $f ) {

        $templates_markup .= '<tr><td id="eachtpl'.esc_attr( $f[ 'id' ] ).'" class="each_template_type"><p>'.esc_html( rawurldecode( $f[ 'title' ] ) ).'</p></td><td><div data-template-id="'.esc_attr( $f[ 'id' ] ).'" class="each_templates_actions"><i data-action="remove" class="wpc-i-remove templates_btn"></i></div></td></tr>';

    }

    $templates_markup .= '</tbody></table>';
    $templates_markup .= wp_kses_post( $bk_rest_cont );

    return $templates_markup;

}
