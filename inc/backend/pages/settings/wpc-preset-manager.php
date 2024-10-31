<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div id="section_preset" class= "postbox">
   <div class="inside">
      <div id="design_preset_settings" class="format-preset">
         <div class="format-preset-wrap">
        <h2 class="wpc_panel_title"><?php esc_html_e( 'Use this Preset Manager to manage your current presets, you can delete presets which are not in use or to make a backup for all presets.', 'page-builder-wp' );?></h2>
         <?php echo wp_kses( pbwp_presets_list(), pbwp_wp_kses_allowed_html() ); ?>
         </div>
      </div>
   </div>
</div>

<?php
function pbwp_presets_list()
{

    add_filter( 'pbwp_item_list', 'pbwp_add_preset_category' );

    $presets_content = '';
    $cats            = pbwp_generate_item_list();
    $cats            = array_map( 'pbwp_get_value_helper', $cats );
    $all_presets     = pbwp_render_presets();
    $bk_rest_cont    = '<div class="backup-restore-cont"><h2>'.esc_html__( 'When you click Backup button, system will generate a JSON file. You can save it into your computer so you can easily restore them at anytime.', 'page-builder-wp' ).'</h2><hr><span class="wpc_button wpc_button_normal wpc_blue_color wpc_backup_preset" data-action="backup">'.esc_html__( 'Backup All Presets', 'page-builder-wp' ).'</span><span class="wpc_button wpc_button_normal wpc_green_color wpc_restore_preset" data-action="restore">'.esc_html__( 'Restore Presets', 'page-builder-wp' ).'</span><span data-action="reset" class="wpc_button wpc_button_small wpc_red_color wpc_reset_preset">'.esc_html__( 'Delete All Presets', 'page-builder-wp' ).'</span></div>';

    $presets_content .= '<table class="wpc-bordered"><thead><tr><th scope="col">'.esc_html__( 'Type', 'page-builder-wp' ).'</th><th scope="col">'.esc_html__( 'Presets', 'page-builder-wp' ).'</th></tr></thead><tbody class="wpc_presets_content">';

    if ( array_key_exists( 'noPreset', $all_presets ) ) {
        $presets_content .= '<tr><td>'.esc_html__( 'There are currently no presets available.', 'page-builder-wp' ).'</td><td>'.esc_html__( 'none', 'page-builder-wp' ).'</td></tr>';
        $presets_content .= '</tbody></table>';
        $presets_content .= wp_kses_post( $bk_rest_cont );

        return $presets_content;

    }

    foreach ( $all_presets as $key => $val ) {

        $presets_content .= '<tr>';

        if ( array_key_exists( $key, $cats ) ) {
            $presets_content .= '<td class="each_preset_preset_type">'.$cats[ $key ][ 'name' ].'</td><td>';
        }

        foreach ( $val as $k => $v ) {

            if ( array_key_exists( $key, $cats ) ) {
                $presets_content .= '<span data-preset_id="'.esc_attr( $v[ 'id' ] ).'" data-type_preset="'.esc_attr( $key ).'" class="each_preset"><i class="wpc-i-preset"></i>'.esc_html( $v[ 'title' ] ).'<i class="wpc-i-remove wpc_rem_preset"></i></span>';
            }

        }

        $presets_content .= '</td></tr>';

    }

    $presets_content .= '</tbody></table>';
    $presets_content .= wp_kses_post( $bk_rest_cont );

    return $presets_content;

}

function pbwp_get_value_helper( $v )
{

    return $v;

}
