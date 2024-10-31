<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$general_sst = pbwp_get_option( 'stt_general' );
$my_sst      = pbwp_get_option( 'my' );
$font_format = apply_filters( 'pbwp_general_settings_font_format', [ 'ttf', 'woff', 'woff2' ] );

?>
<div id="section_general" class= "postbox">
   <div class="inside">
      <div id="design_general_settings" class="format-general">
         <div class="format-general-wrap">
            <form id="stt_general" method="post" action="#">
               <table class="tbl_custom">
                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Disable Plugin', 'page-builder-wp' );?></th>
                     <td>
                        <input name="disable_plugin" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_plugin_active" <?php checked( 'active', ( isset( $general_sst[ 'disable_plugin' ] ) ? esc_attr( $general_sst[ 'disable_plugin' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'Use this option to Enable or Disable WP Composer from all pages / posts', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt wpc_not_supported_opt">
                     <th><?php esc_html_e( 'Disable Auto Check Update', 'page-builder-wp' );?></th>
                     <td>
                        <input name="disable_plugin_update" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_plugin_update" <?php checked( 'active', ( isset( $general_sst[ 'disable_plugin_update' ] ) ? esc_attr( $general_sst[ 'disable_plugin_update' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'Use this option to Enable or Disable WP Composer for checking the update. In several servers, by enabling this option will solve the admin page slow loading issue', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Disable Visual &amp; Text Editor', 'page-builder-wp' );?></th>
                     <td>
                        <input name="disable_visualtext" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_visualtext" <?php checked( 'active', ( isset( $general_sst[ 'disable_visualtext' ] ) ? esc_attr( $general_sst[ 'disable_visualtext' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'Disable or enable the Visual & Text option from Text Editor item', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Disable Gutenberg Editor', 'page-builder-wp' );?></th>
                     <td>
                        <input name="disable_gutenberg" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_gutenberg" <?php checked( 'active', ( isset( $general_sst[ 'disable_gutenberg' ] ) ? esc_attr( $general_sst[ 'disable_gutenberg' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'Disable Gutenberg Editor from the selected post type below', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Disable Auto Open Editor', 'page-builder-wp' );?></th>
                     <td>
                        <input name="disable_auto_open_editor" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="disable_auto_open_editor" <?php checked( 'active', ( isset( $general_sst[ 'disable_auto_open_editor' ] ) ? esc_attr( $general_sst[ 'disable_auto_open_editor' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'This will preventing Editor from opening automatically every time you add new item', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Maintenance Mode', 'page-builder-wp' );?></th>
                     <td>
                        <input name="wpc_maintenance" class="ios-checkbox wpc_maintenance_mode" type="checkbox" data-unchecked-value="notactive" id="wpc_maintenance_mode" <?php checked( 'active', ( isset( $general_sst[ 'wpc_maintenance' ] ) ? esc_attr( $general_sst[ 'wpc_maintenance' ] ) : 'notactive' ) );?> value='active' />
                        <div class="maintenance_time_end_cont<?php echo ( isset( $general_sst[ 'wpc_maintenance' ] ) && $general_sst[ 'wpc_maintenance' ] == 'active' ? '' : ' maintenance_off ' ); ?>"><label><?php esc_html_e( 'Maintenance end time', 'page-builder-wp' );?>:</label><input name="wpc_maintenance_end" type="text" id="wpc_maintenance_end" value='<?php echo ( isset( $general_sst[ 'wpc_maintenance_end' ] ) ? esc_attr( $general_sst[ 'wpc_maintenance_end' ] ) : '' ); ?>' /></div>
                        <p class="description"><?php esc_html_e( 'Use this option to Enable or Disable Maintenance Mode for your website. Only administrator can able to access your site frontend and backend', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Debug Mode', 'page-builder-wp' );?></th>
                     <td>
                        <input name="wpc_debug" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_debug" <?php checked( 'active', ( isset( $general_sst[ 'wpc_debug' ] ) ? esc_attr( $general_sst[ 'wpc_debug' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'Enable this option if you experience issues displaying content', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Supported Content Types', 'page-builder-wp' );?></th>
                     <td>

                    <div class="wpc_stt_checkbox">
                    <input value="<?php echo esc_attr(  ( isset( $general_sst[ 'wpc_post_type' ] ) ? $general_sst[ 'wpc_post_type' ] : 'post, page' ) );?>" class="display_none wpc_stt_cb_input" name="wpc_post_type" type="text">
                    <?php
foreach ( pbwp_get_post_types() as $post_type ) {
    echo '<input id="cb_'.esc_attr( $post_type ).'" class="wpc_stt_cb'.( $post_type == 'post' || $post_type == 'page' ? ' this_primary' : '' ).'" value="'.esc_attr( $post_type ).'" type="checkbox"'.( $post_type == 'post' || $post_type == 'page' ? ' checked="checked"' : '' ).'><label for="cb_'.esc_attr( $post_type ).'">'.esc_html( $post_type ).'</label>';
}
?>
                    </div>

                        <p class="description"><?php esc_html_e( 'Besides page and post above, you can set any content type to be available with WP Composer', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Role Manager', 'page-builder-wp' );?></th>
                     <td>

                    <div class="wpc_stt_checkbox">
                    <input value="<?php echo esc_attr(  ( isset( $general_sst[ 'wpc_roles' ] ) ? $general_sst[ 'wpc_roles' ] : 'administrator' ) );?>" class="display_none wpc_stt_cb_input" name="wpc_roles" type="text">
                    <?php
$usr_roles = pbwp_get_user_role();
foreach ( $usr_roles as $role ) {
    echo '<input id="cb_'.esc_attr( $role ).'" class="wpc_stt_cb'.( $role == 'administrator' ? ' this_primary' : '' ).'" value="'.esc_attr( $role ).'" type="checkbox"'.( $role == 'administrator' ? ' checked="checked"' : '' ).'><label for="cb_'.esc_attr( $role ).'">'.esc_html( $role ).'</label>';
}
?>
                    </div>

                        <p class="description"><?php esc_html_e( 'Manage user role access to WP Composer and it\'s features', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Google Maps API Key', 'page-builder-wp' );?></th>
                     <td>
                        <input name="gmaps_key" type="text" id="wpc_gmaps_key" value="<?php echo esc_attr(  ( isset( $general_sst[ 'gmaps_key' ] ) ? $general_sst[ 'gmaps_key' ] : '' ) );?>" />
                        <p class="description"><?php esc_html_e( 'The Maps item uses the Google Maps API and requires a valid Google API Key to function. Use this link to create your API Key', 'page-builder-wp' );?><a href="https://developers.google.com/maps/documentation/embed/get-api-key#create-api-keys" target="_blank"> Create Google Maps API Key</a></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Google Fonts API Key', 'page-builder-wp' );?></th>
                     <td>
                        <input name="gfonts_key" type="text" id="wpc_gfonts_key" value="<?php echo esc_attr(  ( isset( $general_sst[ 'gfonts_key' ] ) ? $general_sst[ 'gfonts_key' ] : '' ) );?>" />
                        <p class="description"><?php esc_html_e( 'The Fonts Manager feature uses the Google Fonts API and requires a valid Google API Key to function. Use this link to create your API Key', 'page-builder-wp' );?><a href="https://developers.google.com/fonts/docs/developer_api#APIKey" target="_blank"> Create Google Fonts API Key</a></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Local Google Fonts', 'page-builder-wp' );?></th>
                     <td>
                        <input name="local_fonts" class="ios-checkbox" type="checkbox" data-unchecked-value="notactive" id="wpc_local_fonts" <?php checked( 'active', ( isset( $general_sst[ 'local_fonts' ] ) ? esc_attr( $general_sst[ 'local_fonts' ] ) : 'notactive' ) );?> value='active' />
                        <p class="description"><?php esc_html_e( 'This will automatically download all used Google Fonts locally to comply with the GDPR policies', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Local Google Fonts Format', 'page-builder-wp' );?></th>
                     <td>
                        <select name="local_fonts_format" id="wpc_local_fonts">
                           <?php

foreach ( $font_format as $opt ) {
    echo '<option '.( isset( $general_sst[ 'local_fonts_format' ] ) && $general_sst[ 'local_fonts_format' ] === $opt ? 'selected="selected" ' : '' ).'value="'.esc_attr( $opt ).'">'.esc_html( $opt ).'</option>';
}
?>
                        </select>
                        <p class="description"><?php esc_html_e( 'Select a specific font format type to hold font data', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Maximum Number of Undos', 'page-builder-wp' );?></th>
                     <td>
                        <input name="max_undo" class="wpc-stt-field-text" type="text" id="wpc_max_undo" value='<?php echo ( isset( $general_sst[ 'max_undo' ] ) ? esc_attr( $general_sst[ 'max_undo' ] ) : 10 ); ?>' />
                        <p class="description"><?php esc_html_e( 'The default number of undos is set to 10, once you reach x changes, you\'re no longer going to be able to move backwards and undo your changes', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Product Tour', 'page-builder-wp' );?></th>
                     <td>
                        <div class="wpc_tour_button_cont">
                     	<span data-tour="yes" data-nonce="<?php echo esc_attr( wp_create_nonce( 'wpc_ajax_nonce' ) ); ?>" class="button button-secondary wpc-reset-tour"><?php esc_html_e( 'Reset', 'page-builder-wp' );?></span>
                        <span data-tour="no" data-nonce="<?php echo esc_attr( wp_create_nonce( 'wpc_ajax_nonce' ) ); ?>" class="button button-secondary wpc-disable-tour"><?php esc_html_e( 'Disable', 'page-builder-wp' );?></span>
                        </div>
                        <p class="description"><?php esc_html_e( 'Use the RESET button to initiate the Product Tour for new posts/pages with WP Composer. Alternatively, use the DISABLE button to turn off the Product Tour completely', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

                  <tr valign="top" class="the_opt">
                     <th><?php esc_html_e( 'Connect to My WP Composer', 'page-builder-wp' );?></th>
                     <td>
                        <?php
                           $is_connected    = isset( $my_sst[ 'my' ] ) && isset( $my_sst[ 'my' ][ 'token' ] ) ? true : false;
                           $my_is_connected = $is_connected ? ' my_is_connected' : '';
                           $avatar          = $is_connected ? $my_sst[ 'user_info' ][ 'avatar' ] : '';
                           $my_name         = $is_connected ? $my_sst[ 'user_info' ][ 'fullname' ] : '';
                           $connect_text    = $is_connected ? esc_html__( 'Disconnect', 'page-builder-wp' ) : esc_html__( 'Connect', 'page-builder-wp' );
                           $connect_data    = $is_connected ? 'disconnect' : 'connect';
                           ?>
                        <div class="wpc_my_info_cont<?php echo esc_attr( $my_is_connected ); ?>">
                        <img class="u_info_my_avatar" src="<?php echo esc_attr( $avatar ); ?>">
                        <span class="u_info_my_name"><?php echo esc_html( $my_name ); ?></span>
                        </div>
                     	<span data-my="<?php echo esc_attr( $connect_data ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'wpc_ajax_nonce' ) ); ?>" class="button button-secondary my-connect"><?php echo esc_html( $connect_text ); ?></span>
                        <i class="wpc-i-correct my_connected <?php echo esc_attr( $is_connected ) ? 'wpc_visibility_visible' : 'wpc_visibility_hidden'; ?>"></i><p class="description"><?php esc_html_e( 'After successful integration, you\'ll unlock access to your website cloud-based data and additional services', 'page-builder-wp' );?></p>
                     </td>
                  </tr>

               </table>
               <table class="tbl_custom">
                  <tr valign="top">
                     <td><input id="stt_general_save" data-formname="stt_general" data-nonce="<?php echo esc_attr( wp_create_nonce( 'wpc_ajax_nonce' ) ); ?>" type="submit" value="<?php esc_html_e( 'Save Changes', 'page-builder-wp' );?>" class="button button-primary wpc_form_submit" /><span id="loader_stt_general"></span><span class="set_stt_general wpc_save_status"><?php esc_html_e( 'Settings Saved', 'page-builder-wp' );?></span></td>
               </table>
            </form>
         </div>
      </div>
   </div>
</div>