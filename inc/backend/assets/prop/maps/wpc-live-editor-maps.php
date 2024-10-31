<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* Live Editor Properties */
function pbwp_live_editor_props()
{

    return array(
        'props' => array(
            'elementExceptions' => array(
                'custom_size', 'gradx_active', 'global_panel_width', 'gradient_type_sel', 'gradx_gradient_subtype', 'gradx_gradient_subtype2', 'global', 'template_radio_image', 'action', 'lightbox_style', 'prettyphoto_theme', 'hover_effect_style', 'img_desc', 'hover_effect', 'hover_title', 'lightbox', 'img_desc', 'the_link', 'show_hover_value', 'services', 'mad_mimi_list', 'mailchimp_list', 'mailchimp_double_optin', 'getresponse_list', 'mailchimp_api_key', 'getresponse_redirect_url', 'getresponse_cid', 'getresponse_skey', 'campaign_monitor_list', 'campaign_monitor_client_id', 'campaign_monitor_api_key', 'mad_mimi_username', 'mad_mimi_api_key', 'aweber_auth_code', 'aweber_data', 'email_receipt', 'subscribe_ok_msg', 'in_lightbox', 'recipient', 'subject', 'sent_redirect', 'sent_action', 'sent_message', 'cup_icon', 'anim_effect', 'anim_delay', 'anim_speed', 'title', 'featuredesc', 'misc', 'map_marker_title', 'map_marker_desc', 'map_url', '.wpc_maps_styles|map_styles', 'vid_url', 'desc', 'btn-text', 'btn_text', 'units', 'btn_txt', 'readmore_label', 'productdesc', 'price', 'currency', 'price_per', 'button_text', 'label_name', 'label_email', 'label_subject', 'label_message', 'testitext', 'text', 'code', 'custom_css', 'text-editor', 'shapedivider', 'fb_page_id', 'event_color', 'before_label', 'after_label', 'visibility_breakpoint', 'visibility_display', 'items', 'use_img_ig_filter', 'img_ig_filters', 'map_height', 'meta_id'
            ),
            'keyConnector'      => array(
                'featurebox'     => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.ftre_title h4',
                    ),
                    array(
                        'name'     => 'featuredesc',
                        'selector' => '.ftre_desc p',
                    ),
                    array(
                        'name'     => 'misc',
                        'selector' => '.ftre_misc h5',
                    ),
                    array(
                        'name'     => 'btn_text',
                        'selector' => '.ftre_button_text',
                    ),
                ),
                'singletitle'    => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.wpc_item_title',
                    ),
                ),
                'typemaps'       => array(
                    array(
                        'name'     => 'map_marker_title',
                        'selector' => '.wpc_maps_title',
                    ),
                    array(
                        'name'     => 'map_marker_desc',
                        'selector' => '.wpc_maps_desc',
                    ),
                ),
                'typecta'        => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.cta-title',
                    ),
                    array(
                        'name'     => 'desc',
                        'selector' => '.cta-desc',
                    ),
                    array(
                        'name'     => 'btn-text',
                        'selector' => '.cta-btn',
                    ),
                ),
                'typebutton'     => array(
                    array(
                        'name'     => 'btn_text',
                        'selector' => '.wpc_button_text',
                    ),
                ),
                'typeaccordion'  => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.acc_main_title h2',
                    ),
                ),
                'typepbar'       => array(
                    array(
                        'name'     => 'units',
                        'selector' => '.wpc_label_units',
                    ),
                ),
                'typeroundchart' => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.wpc_rc_title',
                    ),
                ),
                'typelinechart'  => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.wpc_lc_title',
                    ),
                ),
                'newsletterform' => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.wpc_nf_title',
                    ),
                    array(
                        'name'     => 'desc',
                        'selector' => '.wpc_nf_desc',
                    ),
                    array(
                        'name'     => 'btn_txt',
                        'selector' => '.wpc_nf_field_submit',
                    ),
                ),
                'postcarousel'   => array(
                    array(
                        'name'     => 'readmore_label',
                        'selector' => '.wpc_post_carousel_read_more a',
                    ),
                ),
                'productbox'     => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.prd_title',
                    ),
                    array(
                        'name'     => 'productdesc',
                        'selector' => '.prd_desc',
                    ),
                    array(
                        'name'     => 'misc',
                        'selector' => '.prd_misc',
                    ),
                    array(
                        'name'     => 'btn_text',
                        'selector' => '.prd_button_text',
                    ),
                ),
                'typepricing'    => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.pc_title',
                    ),
                    array(
                        'name'     => 'price',
                        'selector' => '.pc_price',
                    ),
                    array(
                        'name'     => 'currency',
                        'selector' => '.pc_price_curr',
                    ),
                    array(
                        'name'     => 'price_per',
                        'selector' => '.pc_price_per',
                    ),
                    array(
                        'name'     => 'button_text',
                        'selector' => '.pc_button_text',
                    ),
                    array(
                        'name'     => 'items',
                        'selector' => '.live_editor_lists',
                    ),
                ),
                'pricinglist'     => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.pcrlist_title h3',
                    ),
                    array(
                        'name'     => 'desc',
                        'selector' => '.pcrlist_desc p',
                    ),
                    array(
                        'name'     => 'price',
                        'selector' => '.pcrlist_price h3',
                    ),
                ),
                'contactform'    => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.wpc_form_title',
                    ),
                    array(
                        'name'     => 'label_name',
                        'selector' => '.wpc_form_label_name',
                    ),
                    array(
                        'name'     => 'label_email',
                        'selector' => '.wpc_form_label_email',
                    ),
                    array(
                        'name'     => 'label_subject',
                        'selector' => '.wpc_form_label_subject',
                    ),
                    array(
                        'name'     => 'label_message',
                        'selector' => '.wpc_form_label_msg',
                    ),
                    array(
                        'name'     => 'button_text',
                        'selector' => '.wpc_form_button',
                    ),
                ),
                'testimonial'    => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.testi_title',
                    ),
                    array(
                        'name'     => 'testitext',
                        'selector' => '.testi_desc',
                    ),
                    array(
                        'name'     => 'misc',
                        'selector' => '.testi_misc',
                    ),
                ),
                'alertbox'       => array(
                    array(
                        'name'     => 'text',
                        'selector' => '.alert_text',
                    ),
                ),
                'counterup'      => array(
                    array(
                        'name'     => 'count_to_suffix',
                        'selector' => '.cup_number_suffix',
                    ),
                    array(
                        'name'     => 'label',
                        'selector' => '.cup_label',
                    ),
                ),
                'typeseparator'  => array(
                    array(
                        'name'     => 'text',
                        'selector' => '.separator_text',
                    ),
                ),
                'links'     => array(
                    array(
                        'name'     => 'link_title',
                        'selector' => '.wpc_links_title h4',
                    ),
                ),
                'wpmeta'         => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wptcloud'       => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wprcpost'       => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wprccom'        => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wpcat'          => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wpvideo'        => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
                'wpaudio'        => array(
                    array(
                        'name'     => 'title',
                        'selector' => '.widgettitle',
                    ),
                ),
            ),
        ),
    );

}