<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div id="section_fonts" class= "postbox">
   <div class="inside">
      <div id="design_fonts_settings" class="format-fonts">
         <div class="format-fonts-wrap">
        <h2 class="wpc_panel_title"><?php esc_html_e( 'Use this Fonts Manager to manage installed fonts in your sites.', 'page-builder-wp' );?></h2>
         <?php echo wp_kses( pbwp_fonts_list(), pbwp_wp_kses_allowed_html() ); ?>
         </div>
      </div>
   </div>
</div>

<?php
function pbwp_fonts_list()
{

    $all_fonts_content = '';
    $all_fonts         = pbwp_render_fonts();
    $btn_fonts         = '<div class="wpc_fonts_cont"><h2>'.esc_html__( 'When you click Backup button, system will generate a JSON file. You can save it into your computer so you can easily restore them at anytime.', 'page-builder-wp' ).'</h2><hr><span class="wpc_button wpc_button_normal wpc_blue_color wpc_backup_fonts fonts_btn" data-action="backup">'.esc_html__( 'Backup Fonts', 'page-builder-wp' ).'</span><span class="wpc_button wpc_button_normal wpc_green_color wpc_restore_fonts fonts_btn" data-action="restore">'.esc_html__( 'Restore Fonts', 'page-builder-wp' ).'</span><span class="wpc_button wpc_button_normal wpc_purple_color wpc_update_fonts fonts_btn" data-action="update_version">'.esc_html__( 'Update Fonts', 'page-builder-wp' ).'</span></div>';

    $all_fonts_content .= '<table class="wpc-bordered"><thead><tr><th scope="col">'.esc_html__( 'Title', 'page-builder-wp' ).'</th><th scope="col">'.esc_html__( 'Actions', 'page-builder-wp' ).'</th></tr></thead><tbody class="wpc_fonts_content">';

    if ( count( $all_fonts ) == 0 ) {
        $all_fonts_content .= '<tr><td>'.esc_html__( 'There are currently no fonts available.', 'page-builder-wp' ).'</td><td>'.esc_html__( 'none', 'page-builder-wp' ).'</td></tr>';
        $all_fonts_content .= '</tbody></table>';
        $all_fonts_content .= wp_kses( $btn_fonts, pbwp_wp_kses_allowed_html() );

        return $all_fonts_content;

    }

    foreach ( array_keys( $all_fonts ) as $k => $f ) {

        $all_fonts_content .= '<tr><td id="eachfont'.esc_attr( $k ).'" class="each_font_type"><p>'.esc_html( rawurldecode( $f ) ).'</p></td><td><div data-font-id="'.esc_attr( $k ).'" class="each_fonts_actions"><i data-action="delete" class="wpc-i-remove fonts_btn"></i></div></td></tr>';

    }

    $all_fonts_content .= '</tbody></table>';
    $all_fonts_content .= wp_kses( $btn_fonts, pbwp_wp_kses_allowed_html() );

    return $all_fonts_content;

}
