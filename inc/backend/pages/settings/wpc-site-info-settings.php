<?php

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div id="section_info" class= "postbox">
   <div class="inside">
      <div id="design_info_settings" class="format-info">
         <div class="format-info-wrap">		
        <h2 class="wpc_panel_title"><?php esc_html_e( 'Diagnostic Info','page-builder-wp' );?></h2>
               <table class="tbl_custom">
                  <tr valign="top">
                     <td><textarea class="wpc-debug-log-textarea" autocomplete="off" readonly=""><?php echo wp_kses( pbwp_output_diagnostic_info(), pbwp_wp_kses_allowed_html() ); ?></textarea>
                    <?php if ( ! is_multisite() ) { ?> <a href="<?php echo esc_url( add_query_arg( array( 'action' => 'pbwp_http_prepare_download_log', 'nonce' => wp_create_nonce( 'wpc-download-log' ), 'wpc-download-log' => '1' ), admin_url( 'admin-ajax.php' ) ) ); ?>" class="button"><?php esc_html_e( 'Download Data', 'page-builder-wp' ); ?></a> <?php } ?>
                     </td>
                   </tr>
               </table>
         </div>
      </div>
   </div>
</div>