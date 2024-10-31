<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_icon_material()
{

    $materialicons = array(
        'css_prefix_text' => 'material-icons ',
        'glyphs'          => array(
            0   => array(
                'css' => '3d_rotation',
            ),
            1   => array(
                'css' => 'ac_unit',
            ),
            2   => array(
                'css' => 'access_alarm',
            ),
            3   => array(
                'css' => 'access_alarms',
            ),
            4   => array(
                'css' => 'access_time',
            ),
            5   => array(
                'css' => 'accessibility',
            ),
            6   => array(
                'css' => 'accessible',
            ),
            7   => array(
                'css' => 'account_balance',
            ),
            8   => array(
                'css' => 'account_balance_wallet',
            ),
            9   => array(
                'css' => 'account_box',
            ),
            10  => array(
                'css' => 'account_circle',
            ),
            11  => array(
                'css' => 'adb',
            ),
            12  => array(
                'css' => 'add',
            ),
            13  => array(
                'css' => 'add_a_photo',
            ),
            14  => array(
                'css' => 'add_alarm',
            ),
            15  => array(
                'css' => 'add_alert',
            ),
            16  => array(
                'css' => 'add_box',
            ),
            17  => array(
                'css' => 'add_circle',
            ),
            18  => array(
                'css' => 'add_circle_outline',
            ),
            19  => array(
                'css' => 'add_location',
            ),
            20  => array(
                'css' => 'add_shopping_cart',
            ),
            21  => array(
                'css' => 'add_to_photos',
            ),
            22  => array(
                'css' => 'add_to_queue',
            ),
            23  => array(
                'css' => 'adjust',
            ),
            24  => array(
                'css' => 'airline_seat_flat',
            ),
            25  => array(
                'css' => 'airline_seat_flat_angled',
            ),
            26  => array(
                'css' => 'airline_seat_individual_suite',
            ),
            27  => array(
                'css' => 'airline_seat_legroom_extra',
            ),
            28  => array(
                'css' => 'airline_seat_legroom_normal',
            ),
            29  => array(
                'css' => 'airline_seat_legroom_reduced',
            ),
            30  => array(
                'css' => 'airline_seat_recline_extra',
            ),
            31  => array(
                'css' => 'airline_seat_recline_normal',
            ),
            32  => array(
                'css' => 'airplanemode_active',
            ),
            33  => array(
                'css' => 'airplanemode_inactive',
            ),
            34  => array(
                'css' => 'airplay',
            ),
            35  => array(
                'css' => 'airport_shuttle',
            ),
            36  => array(
                'css' => 'alarm',
            ),
            37  => array(
                'css' => 'alarm_add',
            ),
            38  => array(
                'css' => 'alarm_off',
            ),
            39  => array(
                'css' => 'alarm_on',
            ),
            40  => array(
                'css' => 'album',
            ),
            41  => array(
                'css' => 'all_inclusive',
            ),
            42  => array(
                'css' => 'all_out',
            ),
            43  => array(
                'css' => 'android',
            ),
            44  => array(
                'css' => 'announcement',
            ),
            45  => array(
                'css' => 'apps',
            ),
            46  => array(
                'css' => 'archive',
            ),
            47  => array(
                'css' => 'arrow_back',
            ),
            48  => array(
                'css' => 'arrow_downward',
            ),
            49  => array(
                'css' => 'arrow_drop_down',
            ),
            50  => array(
                'css' => 'arrow_drop_down_circle',
            ),
            51  => array(
                'css' => 'arrow_drop_up',
            ),
            52  => array(
                'css' => 'arrow_forward',
            ),
            53  => array(
                'css' => 'arrow_upward',
            ),
            54  => array(
                'css' => 'art_track',
            ),
            55  => array(
                'css' => 'aspect_ratio',
            ),
            56  => array(
                'css' => 'assessment',
            ),
            57  => array(
                'css' => 'assignment',
            ),
            58  => array(
                'css' => 'assignment_ind',
            ),
            59  => array(
                'css' => 'assignment_late',
            ),
            60  => array(
                'css' => 'assignment_return',
            ),
            61  => array(
                'css' => 'assignment_returned',
            ),
            62  => array(
                'css' => 'assignment_turned_in',
            ),
            63  => array(
                'css' => 'assistant',
            ),
            64  => array(
                'css' => 'assistant_photo',
            ),
            65  => array(
                'css' => 'attach_file',
            ),
            66  => array(
                'css' => 'attach_money',
            ),
            67  => array(
                'css' => 'attachment',
            ),
            68  => array(
                'css' => 'audiotrack',
            ),
            69  => array(
                'css' => 'autorenew',
            ),
            70  => array(
                'css' => 'av_timer',
            ),
            71  => array(
                'css' => 'backspace',
            ),
            72  => array(
                'css' => 'backup',
            ),
            73  => array(
                'css' => 'battery_alert',
            ),
            74  => array(
                'css' => 'battery_charging_full',
            ),
            75  => array(
                'css' => 'battery_full',
            ),
            76  => array(
                'css' => 'battery_std',
            ),
            77  => array(
                'css' => 'battery_unknown',
            ),
            78  => array(
                'css' => 'beach_access',
            ),
            79  => array(
                'css' => 'beenhere',
            ),
            80  => array(
                'css' => 'block',
            ),
            81  => array(
                'css' => 'bluetooth',
            ),
            82  => array(
                'css' => 'bluetooth_audio',
            ),
            83  => array(
                'css' => 'bluetooth_connected',
            ),
            84  => array(
                'css' => 'bluetooth_disabled',
            ),
            85  => array(
                'css' => 'bluetooth_searching',
            ),
            86  => array(
                'css' => 'blur_circular',
            ),
            87  => array(
                'css' => 'blur_linear',
            ),
            88  => array(
                'css' => 'blur_off',
            ),
            89  => array(
                'css' => 'blur_on',
            ),
            90  => array(
                'css' => 'book',
            ),
            91  => array(
                'css' => 'bookmark',
            ),
            92  => array(
                'css' => 'bookmark_border',
            ),
            93  => array(
                'css' => 'border_all',
            ),
            94  => array(
                'css' => 'border_bottom',
            ),
            95  => array(
                'css' => 'border_clear',
            ),
            96  => array(
                'css' => 'border_color',
            ),
            97  => array(
                'css' => 'border_horizontal',
            ),
            98  => array(
                'css' => 'border_inner',
            ),
            99  => array(
                'css' => 'border_left',
            ),
            100 => array(
                'css' => 'border_outer',
            ),
            101 => array(
                'css' => 'border_right',
            ),
            102 => array(
                'css' => 'border_style',
            ),
            103 => array(
                'css' => 'border_top',
            ),
            104 => array(
                'css' => 'border_vertical',
            ),
            105 => array(
                'css' => 'branding_watermark',
            ),
            106 => array(
                'css' => 'brightness_1',
            ),
            107 => array(
                'css' => 'brightness_2',
            ),
            108 => array(
                'css' => 'brightness_3',
            ),
            109 => array(
                'css' => 'brightness_4',
            ),
            110 => array(
                'css' => 'brightness_5',
            ),
            111 => array(
                'css' => 'brightness_6',
            ),
            112 => array(
                'css' => 'brightness_7',
            ),
            113 => array(
                'css' => 'brightness_auto',
            ),
            114 => array(
                'css' => 'brightness_high',
            ),
            115 => array(
                'css' => 'brightness_low',
            ),
            116 => array(
                'css' => 'brightness_medium',
            ),
            117 => array(
                'css' => 'broken_image',
            ),
            118 => array(
                'css' => 'brush',
            ),
            119 => array(
                'css' => 'bubble_chart',
            ),
            120 => array(
                'css' => 'bug_report',
            ),
            121 => array(
                'css' => 'build',
            ),
            122 => array(
                'css' => 'burst_mode',
            ),
            123 => array(
                'css' => 'business',
            ),
            124 => array(
                'css' => 'business_center',
            ),
            125 => array(
                'css' => 'cached',
            ),
            126 => array(
                'css' => 'cake',
            ),
            127 => array(
                'css' => 'call',
            ),
            128 => array(
                'css' => 'call_end',
            ),
            129 => array(
                'css' => 'call_made',
            ),
            130 => array(
                'css' => 'call_merge',
            ),
            131 => array(
                'css' => 'call_missed',
            ),
            132 => array(
                'css' => 'call_missed_outgoing',
            ),
            133 => array(
                'css' => 'call_received',
            ),
            134 => array(
                'css' => 'call_split',
            ),
            135 => array(
                'css' => 'call_to_action',
            ),
            136 => array(
                'css' => 'camera',
            ),
            137 => array(
                'css' => 'camera_alt',
            ),
            138 => array(
                'css' => 'camera_enhance',
            ),
            139 => array(
                'css' => 'camera_front',
            ),
            140 => array(
                'css' => 'camera_rear',
            ),
            141 => array(
                'css' => 'camera_roll',
            ),
            142 => array(
                'css' => 'cancel',
            ),
            143 => array(
                'css' => 'card_giftcard',
            ),
            144 => array(
                'css' => 'card_membership',
            ),
            145 => array(
                'css' => 'card_travel',
            ),
            146 => array(
                'css' => 'casino',
            ),
            147 => array(
                'css' => 'cast',
            ),
            148 => array(
                'css' => 'cast_connected',
            ),
            149 => array(
                'css' => 'center_focus_strong',
            ),
            150 => array(
                'css' => 'center_focus_weak',
            ),
            151 => array(
                'css' => 'change_history',
            ),
            152 => array(
                'css' => 'chat',
            ),
            153 => array(
                'css' => 'chat_bubble',
            ),
            154 => array(
                'css' => 'chat_bubble_outline',
            ),
            155 => array(
                'css' => 'check',
            ),
            156 => array(
                'css' => 'check_box',
            ),
            157 => array(
                'css' => 'check_box_outline_blank',
            ),
            158 => array(
                'css' => 'check_circle',
            ),
            159 => array(
                'css' => 'chevron_left',
            ),
            160 => array(
                'css' => 'chevron_right',
            ),
            161 => array(
                'css' => 'child_care',
            ),
            162 => array(
                'css' => 'child_friendly',
            ),
            163 => array(
                'css' => 'chrome_reader_mode',
            ),
            164 => array(
                'css' => 'class',
            ),
            165 => array(
                'css' => 'clear',
            ),
            166 => array(
                'css' => 'clear_all',
            ),
            167 => array(
                'css' => 'close',
            ),
            168 => array(
                'css' => 'closed_caption',
            ),
            169 => array(
                'css' => 'cloud',
            ),
            170 => array(
                'css' => 'cloud_circle',
            ),
            171 => array(
                'css' => 'cloud_done',
            ),
            172 => array(
                'css' => 'cloud_download',
            ),
            173 => array(
                'css' => 'cloud_off',
            ),
            174 => array(
                'css' => 'cloud_queue',
            ),
            175 => array(
                'css' => 'cloud_upload',
            ),
            176 => array(
                'css' => 'code',
            ),
            177 => array(
                'css' => 'collections',
            ),
            178 => array(
                'css' => 'collections_bookmark',
            ),
            179 => array(
                'css' => 'color_lens',
            ),
            180 => array(
                'css' => 'colorize',
            ),
            181 => array(
                'css' => 'comment',
            ),
            182 => array(
                'css' => 'compare',
            ),
            183 => array(
                'css' => 'compare_arrows',
            ),
            184 => array(
                'css' => 'computer',
            ),
            185 => array(
                'css' => 'confirmation_number',
            ),
            186 => array(
                'css' => 'contact_mail',
            ),
            187 => array(
                'css' => 'contact_phone',
            ),
            188 => array(
                'css' => 'contacts',
            ),
            189 => array(
                'css' => 'content_copy',
            ),
            190 => array(
                'css' => 'content_cut',
            ),
            191 => array(
                'css' => 'content_paste',
            ),
            192 => array(
                'css' => 'control_point',
            ),
            193 => array(
                'css' => 'control_point_duplicate',
            ),
            194 => array(
                'css' => 'copyright',
            ),
            195 => array(
                'css' => 'create',
            ),
            196 => array(
                'css' => 'create_new_folder',
            ),
            197 => array(
                'css' => 'credit_card',
            ),
            198 => array(
                'css' => 'crop',
            ),
            199 => array(
                'css' => 'crop_16_9',
            ),
            200 => array(
                'css' => 'crop_3_2',
            ),
            201 => array(
                'css' => 'crop_5_4',
            ),
            202 => array(
                'css' => 'crop_7_5',
            ),
            203 => array(
                'css' => 'crop_din',
            ),
            204 => array(
                'css' => 'crop_free',
            ),
            205 => array(
                'css' => 'crop_landscape',
            ),
            206 => array(
                'css' => 'crop_original',
            ),
            207 => array(
                'css' => 'crop_portrait',
            ),
            208 => array(
                'css' => 'crop_rotate',
            ),
            209 => array(
                'css' => 'crop_square',
            ),
            210 => array(
                'css' => 'dashboard',
            ),
            211 => array(
                'css' => 'data_usage',
            ),
            212 => array(
                'css' => 'date_range',
            ),
            213 => array(
                'css' => 'dehaze',
            ),
            214 => array(
                'css' => 'delete',
            ),
            215 => array(
                'css' => 'delete_forever',
            ),
            216 => array(
                'css' => 'delete_sweep',
            ),
            217 => array(
                'css' => 'description',
            ),
            218 => array(
                'css' => 'desktop_mac',
            ),
            219 => array(
                'css' => 'desktop_windows',
            ),
            220 => array(
                'css' => 'details',
            ),
            221 => array(
                'css' => 'developer_board',
            ),
            222 => array(
                'css' => 'developer_mode',
            ),
            223 => array(
                'css' => 'device_hub',
            ),
            224 => array(
                'css' => 'devices',
            ),
            225 => array(
                'css' => 'devices_other',
            ),
            226 => array(
                'css' => 'dialer_sip',
            ),
            227 => array(
                'css' => 'dialpad',
            ),
            228 => array(
                'css' => 'directions',
            ),
            229 => array(
                'css' => 'directions_bike',
            ),
            230 => array(
                'css' => 'directions_boat',
            ),
            231 => array(
                'css' => 'directions_bus',
            ),
            232 => array(
                'css' => 'directions_car',
            ),
            233 => array(
                'css' => 'directions_railway',
            ),
            234 => array(
                'css' => 'directions_run',
            ),
            235 => array(
                'css' => 'directions_subway',
            ),
            236 => array(
                'css' => 'directions_transit',
            ),
            237 => array(
                'css' => 'directions_walk',
            ),
            238 => array(
                'css' => 'disc_full',
            ),
            239 => array(
                'css' => 'dns',
            ),
            240 => array(
                'css' => 'do_not_disturb',
            ),
            241 => array(
                'css' => 'do_not_disturb_alt',
            ),
            242 => array(
                'css' => 'do_not_disturb_off',
            ),
            243 => array(
                'css' => 'do_not_disturb_on',
            ),
            244 => array(
                'css' => 'dock',
            ),
            245 => array(
                'css' => 'domain',
            ),
            246 => array(
                'css' => 'done',
            ),
            247 => array(
                'css' => 'done_all',
            ),
            248 => array(
                'css' => 'donut_large',
            ),
            249 => array(
                'css' => 'donut_small',
            ),
            250 => array(
                'css' => 'drafts',
            ),
            251 => array(
                'css' => 'drag_handle',
            ),
            252 => array(
                'css' => 'drive_eta',
            ),
            253 => array(
                'css' => 'dvr',
            ),
            254 => array(
                'css' => 'edit',
            ),
            255 => array(
                'css' => 'edit_location',
            ),
            256 => array(
                'css' => 'eject',
            ),
            257 => array(
                'css' => 'email',
            ),
            258 => array(
                'css' => 'enhanced_encryption',
            ),
            259 => array(
                'css' => 'equalizer',
            ),
            260 => array(
                'css' => 'error',
            ),
            261 => array(
                'css' => 'error_outline',
            ),
            262 => array(
                'css' => 'euro_symbol',
            ),
            263 => array(
                'css' => 'ev_station',
            ),
            264 => array(
                'css' => 'event',
            ),
            265 => array(
                'css' => 'event_available',
            ),
            266 => array(
                'css' => 'event_busy',
            ),
            267 => array(
                'css' => 'event_note',
            ),
            268 => array(
                'css' => 'event_seat',
            ),
            269 => array(
                'css' => 'exit_to_app',
            ),
            270 => array(
                'css' => 'expand_less',
            ),
            271 => array(
                'css' => 'expand_more',
            ),
            272 => array(
                'css' => 'explicit',
            ),
            273 => array(
                'css' => 'explore',
            ),
            274 => array(
                'css' => 'exposure',
            ),
            275 => array(
                'css' => 'exposure_neg_1',
            ),
            276 => array(
                'css' => 'exposure_neg_2',
            ),
            277 => array(
                'css' => 'exposure_plus_1',
            ),
            278 => array(
                'css' => 'exposure_plus_2',
            ),
            279 => array(
                'css' => 'exposure_zero',
            ),
            280 => array(
                'css' => 'extension',
            ),
            281 => array(
                'css' => 'face',
            ),
            282 => array(
                'css' => 'fast_forward',
            ),
            283 => array(
                'css' => 'fast_rewind',
            ),
            284 => array(
                'css' => 'favorite',
            ),
            285 => array(
                'css' => 'favorite_border',
            ),
            286 => array(
                'css' => 'featured_play_list',
            ),
            287 => array(
                'css' => 'featured_video',
            ),
            288 => array(
                'css' => 'feedback',
            ),
            289 => array(
                'css' => 'fiber_dvr',
            ),
            290 => array(
                'css' => 'fiber_manual_record',
            ),
            291 => array(
                'css' => 'fiber_new',
            ),
            292 => array(
                'css' => 'fiber_pin',
            ),
            293 => array(
                'css' => 'fiber_smart_record',
            ),
            294 => array(
                'css' => 'file_download',
            ),
            295 => array(
                'css' => 'file_upload',
            ),
            296 => array(
                'css' => 'filter',
            ),
            297 => array(
                'css' => 'filter_1',
            ),
            298 => array(
                'css' => 'filter_2',
            ),
            299 => array(
                'css' => 'filter_3',
            ),
            300 => array(
                'css' => 'filter_4',
            ),
            301 => array(
                'css' => 'filter_5',
            ),
            302 => array(
                'css' => 'filter_6',
            ),
            303 => array(
                'css' => 'filter_7',
            ),
            304 => array(
                'css' => 'filter_8',
            ),
            305 => array(
                'css' => 'filter_9',
            ),
            306 => array(
                'css' => 'filter_9_plus',
            ),
            307 => array(
                'css' => 'filter_b_and_w',
            ),
            308 => array(
                'css' => 'filter_center_focus',
            ),
            309 => array(
                'css' => 'filter_drama',
            ),
            310 => array(
                'css' => 'filter_frames',
            ),
            311 => array(
                'css' => 'filter_hdr',
            ),
            312 => array(
                'css' => 'filter_list',

            ),
            313 => array(
                'css' => 'filter_none',
            ),
            314 => array(
                'css' => 'filter_tilt_shift',
            ),
            315 => array(
                'css' => 'filter_vintage',
            ),
            316 => array(
                'css' => 'find_in_page',
            ),
            317 => array(
                'css' => 'find_replace',
            ),
            318 => array(
                'css' => 'fingerprint',
            ),
            319 => array(
                'css' => 'first_page',
            ),
            320 => array(
                'css' => 'fitness_center',
            ),
            321 => array(
                'css' => 'flag',
            ),
            322 => array(
                'css' => 'flare',
            ),
            323 => array(
                'css' => 'flash_auto',
            ),
            324 => array(
                'css' => 'flash_off',
            ),
            325 => array(
                'css' => 'flash_on',
            ),
            326 => array(
                'css' => 'flight',
            ),
            327 => array(
                'css' => 'flight_land',
            ),
            328 => array(
                'css' => 'flight_takeoff',
            ),
            329 => array(
                'css' => 'flip',
            ),
            330 => array(
                'css' => 'flip_to_back',
            ),
            331 => array(
                'css' => 'flip_to_front',
            ),
            332 => array(
                'css' => 'folder',
            ),
            333 => array(
                'css' => 'folder_open',
            ),
            334 => array(
                'css' => 'folder_shared',
            ),
            335 => array(
                'css' => 'folder_special',
            ),
            336 => array(
                'css' => 'font_download',
            ),
            337 => array(
                'css' => 'format_align_center',
            ),
            338 => array(
                'css' => 'format_align_justify',
            ),
            339 => array(
                'css' => 'format_align_left',
            ),
            340 => array(
                'css' => 'format_align_right',
            ),
            341 => array(
                'css' => 'format_bold',
            ),
            342 => array(
                'css' => 'format_clear',
            ),
            343 => array(
                'css' => 'format_color_fill',
            ),
            344 => array(
                'css' => 'format_color_reset',
            ),
            345 => array(
                'css' => 'format_color_text',
            ),
            346 => array(
                'css' => 'format_indent_decrease',
            ),
            347 => array(
                'css' => 'format_indent_increase',
            ),
            348 => array(
                'css' => 'format_italic',
            ),
            349 => array(
                'css' => 'format_line_spacing',
            ),
            350 => array(
                'css' => 'format_list_bulleted',
            ),
            351 => array(
                'css' => 'format_list_numbered',
            ),
            352 => array(
                'css' => 'format_paint',
            ),
            353 => array(
                'css' => 'format_quote',
            ),
            354 => array(
                'css' => 'format_shapes',
            ),
            355 => array(
                'css' => 'format_size',
            ),
            356 => array(
                'css' => 'format_strikethrough',
            ),
            357 => array(
                'css' => 'format_textdirection_l_to_r',
            ),
            358 => array(
                'css' => 'format_textdirection_r_to_l',
            ),
            359 => array(
                'css' => 'format_underlined',
            ),
            360 => array(
                'css' => 'forum',
            ),
            361 => array(
                'css' => 'forward',
            ),
            362 => array(
                'css' => 'forward_10',
            ),
            363 => array(
                'css' => 'forward_30',
            ),
            364 => array(
                'css' => 'forward_5',
            ),
            365 => array(
                'css' => 'free_breakfast',
            ),
            366 => array(
                'css' => 'fullscreen',
            ),
            367 => array(
                'css' => 'fullscreen_exit',
            ),
            368 => array(
                'css' => 'functions',
            ),
            369 => array(
                'css' => 'g_translate',
            ),
            370 => array(
                'css' => 'gamepad',
            ),
            371 => array(
                'css' => 'games',
            ),
            372 => array(
                'css' => 'gavel',
            ),
            373 => array(
                'css' => 'gesture',
            ),
            374 => array(
                'css' => 'get_app',
            ),
            375 => array(
                'css' => 'gif',
            ),
            376 => array(
                'css' => 'goat',
            ),
            377 => array(
                'css' => 'golf_course',
            ),
            378 => array(
                'css' => 'gps_fixed',
            ),
            379 => array(
                'css' => 'gps_not_fixed',
            ),
            380 => array(
                'css' => 'gps_off',
            ),
            381 => array(
                'css' => 'grade',
            ),
            382 => array(
                'css' => 'gradient',
            ),
            383 => array(
                'css' => 'grain',
            ),
            384 => array(
                'css' => 'graphic_eq',
            ),
            385 => array(
                'css' => 'grid_off',
            ),
            386 => array(
                'css' => 'grid_on',
            ),
            387 => array(
                'css' => 'group',
            ),
            388 => array(
                'css' => 'group_add',
            ),
            389 => array(
                'css' => 'group_work',
            ),
            390 => array(
                'css' => 'hd',
            ),
            391 => array(
                'css' => 'hdr_off',
            ),
            392 => array(
                'css' => 'hdr_on',
            ),
            393 => array(
                'css' => 'hdr_strong',
            ),
            394 => array(
                'css' => 'hdr_weak',
            ),
            395 => array(
                'css' => 'headset',
            ),
            396 => array(
                'css' => 'headset_mic',
            ),
            397 => array(
                'css' => 'healing',
            ),
            398 => array(
                'css' => 'hearing',
            ),
            399 => array(
                'css' => 'help',
            ),
            400 => array(
                'css' => 'help_outline',
            ),
            401 => array(
                'css' => 'high_quality',
            ),
            402 => array(
                'css' => 'highlight',
            ),
            403 => array(
                'css' => 'highlight_off',
            ),
            404 => array(
                'css' => 'history',
            ),
            405 => array(
                'css' => 'home',
            ),
            406 => array(
                'css' => 'hot_tub',
            ),
            407 => array(
                'css' => 'hotel',
            ),
            408 => array(
                'css' => 'hourglass_empty',
            ),
            409 => array(
                'css' => 'hourglass_full',
            ),
            410 => array(
                'css' => 'http',
            ),
            411 => array(
                'css' => 'https',
            ),
            412 => array(
                'css' => 'image',
            ),
            413 => array(
                'css' => 'image_aspect_ratio',
            ),
            414 => array(
                'css' => 'import_contacts',
            ),
            415 => array(
                'css' => 'import_export',
            ),
            416 => array(
                'css' => 'important_devices',
            ),
            417 => array(
                'css' => 'inbox',
            ),
            418 => array(
                'css' => 'indeterminate_check_box',
            ),
            419 => array(
                'css' => 'info',
            ),
            420 => array(
                'css' => 'info_outline',
            ),
            421 => array(
                'css' => 'input',
            ),
            422 => array(
                'css' => 'insert_chart',
            ),
            423 => array(
                'css' => 'insert_comment',
            ),
            424 => array(
                'css' => 'insert_drive_file',
            ),
            425 => array(
                'css' => 'insert_emoticon',
            ),
            426 => array(
                'css' => 'insert_invitation',
            ),
            427 => array(
                'css' => 'insert_link',
            ),
            428 => array(
                'css' => 'insert_photo',
            ),
            429 => array(
                'css' => 'invert_colors',
            ),
            430 => array(
                'css' => 'invert_colors_off',
            ),
            431 => array(
                'css' => 'iso',
            ),
            432 => array(
                'css' => 'keyboard',
            ),
            433 => array(
                'css' => 'keyboard_arrow_down',
            ),
            434 => array(
                'css' => 'keyboard_arrow_left',
            ),
            435 => array(
                'css' => 'keyboard_arrow_right',
            ),
            436 => array(
                'css' => 'keyboard_arrow_up',
            ),
            437 => array(
                'css' => 'keyboard_backspace',
            ),
            438 => array(
                'css' => 'keyboard_capslock',
            ),
            439 => array(
                'css' => 'keyboard_hide',
            ),
            440 => array(
                'css' => 'keyboard_return',
            ),
            441 => array(
                'css' => 'keyboard_tab',
            ),
            442 => array(
                'css' => 'keyboard_voice',
            ),
            443 => array(
                'css' => 'kitchen',
            ),
            444 => array(
                'css' => 'label',
            ),
            445 => array(
                'css' => 'label_outline',
            ),
            446 => array(
                'css' => 'landscape',
            ),
            447 => array(
                'css' => 'language',
            ),
            448 => array(
                'css' => 'laptop',
            ),
            449 => array(
                'css' => 'laptop_chromebook',
            ),
            450 => array(
                'css' => 'laptop_mac',
            ),
            451 => array(
                'css' => 'laptop_windows',
            ),
            452 => array(
                'css' => 'last_page',
            ),
            453 => array(
                'css' => 'launch',
            ),
            454 => array(
                'css' => 'layers',
            ),
            455 => array(
                'css' => 'layers_clear',
            ),
            456 => array(
                'css' => 'leak_add',
            ),
            457 => array(
                'css' => 'leak_remove',
            ),
            458 => array(
                'css' => 'lens',
            ),
            459 => array(
                'css' => 'library_add',
            ),
            460 => array(
                'css' => 'library_books',
            ),
            461 => array(
                'css' => 'library_music',
            ),
            462 => array(
                'css' => 'lightbulb_outline',
            ),
            463 => array(
                'css' => 'line_style',
            ),
            464 => array(
                'css' => 'line_weight',
            ),
            465 => array(
                'css' => 'linear_scale',
            ),
            466 => array(
                'css' => 'link',
            ),
            467 => array(
                'css' => 'linked_camera',
            ),
            468 => array(
                'css' => 'list',
            ),
            469 => array(
                'css' => 'live_help',
            ),
            470 => array(
                'css' => 'live_tv',
            ),
            471 => array(
                'css' => 'local_activity',
            ),
            472 => array(
                'css' => 'local_airport',
            ),
            473 => array(
                'css' => 'local_atm',
            ),
            474 => array(
                'css' => 'local_bar',
            ),
            475 => array(
                'css' => 'local_cafe',
            ),
            476 => array(
                'css' => 'local_car_wash',
            ),
            477 => array(
                'css' => 'local_convenience_store',
            ),
            478 => array(
                'css' => 'local_dining',
            ),
            479 => array(
                'css' => 'local_drink',
            ),
            480 => array(
                'css' => 'local_florist',
            ),
            481 => array(
                'css' => 'local_gas_station',
            ),
            482 => array(
                'css' => 'local_grocery_store',
            ),
            483 => array(
                'css' => 'local_hospital',
            ),
            484 => array(
                'css' => 'local_hotel',
            ),
            485 => array(
                'css' => 'local_laundry_service',
            ),
            486 => array(
                'css' => 'local_library',
            ),
            487 => array(
                'css' => 'local_mall',
            ),
            488 => array(
                'css' => 'local_movies',
            ),
            489 => array(
                'css' => 'local_offer',
            ),
            490 => array(
                'css' => 'local_parking',
            ),
            491 => array(
                'css' => 'local_pharmacy',
            ),
            492 => array(
                'css' => 'local_phone',
            ),
            493 => array(
                'css' => 'local_pizza',
            ),
            494 => array(
                'css' => 'local_play',
            ),
            495 => array(
                'css' => 'local_post_office',
            ),
            496 => array(
                'css' => 'local_printshop',
            ),
            497 => array(
                'css' => 'local_see',
            ),
            498 => array(
                'css' => 'local_shipping',
            ),
            499 => array(
                'css' => 'local_taxi',
            ),
            500 => array(
                'css' => 'location_city',
            ),
            501 => array(
                'css' => 'location_disabled',
            ),
            502 => array(
                'css' => 'location_off',
            ),
            503 => array(
                'css' => 'location_on',
            ),
            504 => array(
                'css' => 'location_searching',
            ),
            505 => array(
                'css' => 'lock',
            ),
            506 => array(
                'css' => 'lock_open',
            ),
            507 => array(
                'css' => 'lock_outline',
            ),
            508 => array(
                'css' => 'looks',
            ),
            509 => array(
                'css' => 'looks_3',
            ),
            510 => array(
                'css' => 'looks_4',
            ),
            511 => array(
                'css' => 'looks_5',
            ),
            512 => array(
                'css' => 'looks_6',
            ),
            513 => array(
                'css' => 'looks_one',
            ),
            514 => array(
                'css' => 'looks_two',
            ),
            515 => array(
                'css' => 'loop',
            ),
            516 => array(
                'css' => 'loupe',
            ),
            517 => array(
                'css' => 'low_priority',
            ),
            518 => array(
                'css' => 'loyalty',
            ),
            519 => array(
                'css' => 'mail',
            ),
            520 => array(
                'css' => 'mail_outline',
            ),
            521 => array(
                'css' => 'map',
            ),
            522 => array(
                'css' => 'markunread',
            ),
            523 => array(
                'css' => 'markunread_mailbox',
            ),
            524 => array(
                'css' => 'memory',
            ),
            525 => array(
                'css' => 'menu',
            ),
            526 => array(
                'css' => 'merge_type',
            ),
            527 => array(
                'css' => 'message',
            ),
            528 => array(
                'css' => 'mic',
            ),
            529 => array(
                'css' => 'mic_none',
            ),
            530 => array(
                'css' => 'mic_off',
            ),
            531 => array(
                'css' => 'mms',
            ),
            532 => array(
                'css' => 'mode_comment',
            ),
            533 => array(
                'css' => 'mode_edit',
            ),
            534 => array(
                'css' => 'monetization_on',
            ),
            535 => array(
                'css' => 'money_off',
            ),
            536 => array(
                'css' => 'monochrome_photos',
            ),
            537 => array(
                'css' => 'mood',
            ),
            538 => array(
                'css' => 'mood_bad',
            ),
            539 => array(
                'css' => 'more',
            ),
            540 => array(
                'css' => 'more_horiz',
            ),
            541 => array(
                'css' => 'more_vert',
            ),
            542 => array(
                'css' => 'motorcycle',
            ),
            543 => array(
                'css' => 'mouse',
            ),
            544 => array(
                'css' => 'move_to_inbox',
            ),
            545 => array(
                'css' => 'movie',
            ),
            546 => array(
                'css' => 'movie_creation',
            ),
            547 => array(
                'css' => 'movie_filter',
            ),
            548 => array(
                'css' => 'multiline_chart',
            ),
            549 => array(
                'css' => 'music_note',
            ),
            550 => array(
                'css' => 'music_video',
            ),
            551 => array(
                'css' => 'my_location',
            ),
            552 => array(
                'css' => 'nature',
            ),
            553 => array(
                'css' => 'nature_people',
            ),
            554 => array(
                'css' => 'navigate_before',
            ),
            555 => array(
                'css' => 'navigate_next',
            ),
            556 => array(
                'css' => 'navigation',
            ),
            557 => array(
                'css' => 'near_me',
            ),
            558 => array(
                'css' => 'network_cell',
            ),
            559 => array(
                'css' => 'network_check',
            ),
            560 => array(
                'css' => 'network_locked',
            ),
            561 => array(
                'css' => 'network_wifi',
            ),
            562 => array(
                'css' => 'new_releases',
            ),
            563 => array(
                'css' => 'next_week',
            ),
            564 => array(
                'css' => 'nfc',
            ),
            565 => array(
                'css' => 'no_encryption',
            ),
            566 => array(
                'css' => 'no_sim',
            ),
            567 => array(
                'css' => 'not_interested',
            ),
            568 => array(
                'css' => 'note',
            ),
            569 => array(
                'css' => 'note_add',
            ),
            570 => array(
                'css' => 'notifications',
            ),
            571 => array(
                'css' => 'notifications_active',
            ),
            572 => array(
                'css' => 'notifications_none',
            ),
            573 => array(
                'css' => 'notifications_off',
            ),
            574 => array(
                'css' => 'notifications_paused',
            ),
            575 => array(
                'css' => 'offline_pin',
            ),
            576 => array(
                'css' => 'ondemand_video',
            ),
            577 => array(
                'css' => 'opacity',
            ),
            578 => array(
                'css' => 'open_in_browser',
            ),
            579 => array(
                'css' => 'open_in_new',
            ),
            580 => array(
                'css' => 'open_with',
            ),
            581 => array(
                'css' => 'pages',
            ),
            582 => array(
                'css' => 'pageview',
            ),
            583 => array(
                'css' => 'palette',
            ),
            584 => array(
                'css' => 'pan_tool',
            ),
            585 => array(
                'css' => 'panorama',
            ),
            586 => array(
                'css' => 'panorama_fish_eye',
            ),
            587 => array(
                'css' => 'panorama_horizontal',
            ),
            588 => array(
                'css' => 'panorama_vertical',
            ),
            589 => array(
                'css' => 'panorama_wide_angle',
            ),
            590 => array(
                'css' => 'party_mode',
            ),
            591 => array(
                'css' => 'pause',
            ),
            592 => array(
                'css' => 'pause_circle_filled',
            ),
            593 => array(
                'css' => 'pause_circle_outline',
            ),
            594 => array(
                'css' => 'payment',
            ),
            595 => array(
                'css' => 'people',
            ),
            596 => array(
                'css' => 'people_outline',
            ),
            597 => array(
                'css' => 'perm_camera_mic',
            ),
            598 => array(
                'css' => 'perm_contact_calendar',
            ),
            599 => array(
                'css' => 'perm_data_setting',
            ),
            600 => array(
                'css' => 'perm_device_information',
            ),
            601 => array(
                'css' => 'perm_identity',
            ),
            602 => array(
                'css' => 'perm_media',
            ),
            603 => array(
                'css' => 'perm_phone_msg',
            ),
            604 => array(
                'css' => 'perm_scan_wifi',
            ),
            605 => array(
                'css' => 'person',
            ),
            606 => array(
                'css' => 'person_add',
            ),
            607 => array(
                'css' => 'person_outline',
            ),
            608 => array(
                'css' => 'person_pin',
            ),
            609 => array(
                'css' => 'person_pin_circle',
            ),
            610 => array(
                'css' => 'personal_video',
            ),
            611 => array(
                'css' => 'pets',
            ),
            612 => array(
                'css' => 'phone',
            ),
            613 => array(
                'css' => 'phone_android',
            ),
            614 => array(
                'css' => 'phone_bluetooth_speaker',
            ),
            615 => array(
                'css' => 'phone_forwarded',
            ),
            616 => array(
                'css' => 'phone_in_talk',
            ),
            617 => array(
                'css' => 'phone_iphone',
            ),
            618 => array(
                'css' => 'phone_locked',
            ),
            619 => array(
                'css' => 'phone_missed',
            ),
            620 => array(
                'css' => 'phone_paused',
            ),
            621 => array(
                'css' => 'phonelink',
            ),
            622 => array(
                'css' => 'phonelink_erase',
            ),
            623 => array(
                'css' => 'phonelink_lock',
            ),
            624 => array(
                'css' => 'phonelink_off',
            ),
            625 => array(
                'css' => 'phonelink_ring',
            ),
            626 => array(
                'css' => 'phonelink_setup',
            ),
            627 => array(
                'css' => 'photo',
            ),
            628 => array(
                'css' => 'photo_album',
            ),
            629 => array(
                'css' => 'photo_camera',
            ),
            630 => array(
                'css' => 'photo_filter',
            ),
            631 => array(
                'css' => 'photo_library',
            ),
            632 => array(
                'css' => 'photo_size_select_actual',
            ),
            633 => array(
                'css' => 'photo_size_select_large',
            ),
            634 => array(
                'css' => 'photo_size_select_small',
            ),
            635 => array(
                'css' => 'picture_as_pdf',
            ),
            636 => array(
                'css' => 'picture_in_picture',
            ),
            637 => array(
                'css' => 'picture_in_picture_alt',
            ),
            638 => array(
                'css' => 'pie_chart',
            ),
            639 => array(
                'css' => 'pie_chart_outlined',
            ),
            640 => array(
                'css' => 'pin_drop',
            ),
            641 => array(
                'css' => 'place',
            ),
            642 => array(
                'css' => 'play_arrow',
            ),
            643 => array(
                'css' => 'play_circle_filled',
            ),
            644 => array(
                'css' => 'play_circle_outline',
            ),
            645 => array(
                'css' => 'play_for_work',
            ),
            646 => array(
                'css' => 'playlist_add',
            ),
            647 => array(
                'css' => 'playlist_add_check',
            ),
            648 => array(
                'css' => 'playlist_play',
            ),
            649 => array(
                'css' => 'plus_one',
            ),
            650 => array(
                'css' => 'poll',
            ),
            651 => array(
                'css' => 'polymer',
            ),
            652 => array(
                'css' => 'pool',
            ),
            653 => array(
                'css' => 'portable_wifi_off',
            ),
            654 => array(
                'css' => 'portrait',
            ),
            655 => array(
                'css' => 'power',
            ),
            656 => array(
                'css' => 'power_input',
            ),
            657 => array(
                'css' => 'power_settings_new',
            ),
            658 => array(
                'css' => 'pregnant_woman',
            ),
            659 => array(
                'css' => 'present_to_all',
            ),
            660 => array(
                'css' => 'print',
            ),
            661 => array(
                'css' => 'priority_high',
            ),
            662 => array(
                'css' => 'public',
            ),
            663 => array(
                'css' => 'publish',
            ),
            664 => array(
                'css' => 'query_builder',
            ),
            665 => array(
                'css' => 'question_answer',
            ),
            666 => array(
                'css' => 'queue',
            ),
            667 => array(
                'css' => 'queue_music',
            ),
            668 => array(
                'css' => 'queue_play_next',
            ),
            669 => array(
                'css' => 'radio',
            ),
            670 => array(
                'css' => 'radio_button_checked',
            ),
            671 => array(
                'css' => 'radio_button_unchecked',
            ),
            672 => array(
                'css' => 'rate_review',
            ),
            673 => array(
                'css' => 'receipt',
            ),
            674 => array(
                'css' => 'recent_actors',
            ),
            675 => array(
                'css' => 'record_voice_over',
            ),
            676 => array(
                'css' => 'redeem',
            ),
            677 => array(
                'css' => 'redo',
            ),
            678 => array(
                'css' => 'refresh',
            ),
            679 => array(
                'css' => 'remove',
            ),
            680 => array(
                'css' => 'remove_circle',
            ),
            681 => array(
                'css' => 'remove_circle_outline',
            ),
            682 => array(
                'css' => 'remove_from_queue',
            ),
            683 => array(
                'css' => 'remove_red_eye',
            ),
            684 => array(
                'css' => 'remove_shopping_cart',
            ),
            685 => array(
                'css' => 'reorder',
            ),
            686 => array(
                'css' => 'repeat',
            ),
            687 => array(
                'css' => 'repeat_one',
            ),
            688 => array(
                'css' => 'replay',
            ),
            689 => array(
                'css' => 'replay_10',
            ),
            690 => array(
                'css' => 'replay_30',
            ),
            691 => array(
                'css' => 'replay_5',
            ),
            692 => array(
                'css' => 'reply',
            ),
            693 => array(
                'css' => 'reply_all',
            ),
            694 => array(
                'css' => 'report',
            ),
            695 => array(
                'css' => 'report_problem',
            ),
            696 => array(
                'css' => 'restaurant',
            ),
            697 => array(
                'css' => 'restaurant_menu',
            ),
            698 => array(
                'css' => 'restore',
            ),
            699 => array(
                'css' => 'restore_page',
            ),
            700 => array(
                'css' => 'ring_volume',
            ),
            701 => array(
                'css' => 'room',
            ),
            702 => array(
                'css' => 'room_service',
            ),
            703 => array(
                'css' => 'rotate_90_degrees_ccw',
            ),
            704 => array(
                'css' => 'rotate_left',
            ),
            705 => array(
                'css' => 'rotate_right',
            ),
            706 => array(
                'css' => 'rounded_corner',
            ),
            707 => array(
                'css' => 'router',
            ),
            708 => array(
                'css' => 'rowing',
            ),
            709 => array(
                'css' => 'rss_feed',
            ),
            710 => array(
                'css' => 'rv_hookup',
            ),
            711 => array(
                'css' => 'satellite',
            ),
            712 => array(
                'css' => 'save',
            ),
            713 => array(
                'css' => 'scanner',
            ),
            714 => array(
                'css' => 'schedule',
            ),
            715 => array(
                'css' => 'school',
            ),
            716 => array(
                'css' => 'screen_lock_landscape',
            ),
            717 => array(
                'css' => 'screen_lock_portrait',
            ),
            718 => array(
                'css' => 'screen_lock_rotation',
            ),
            719 => array(
                'css' => 'screen_rotation',
            ),
            720 => array(
                'css' => 'screen_share',
            ),
            721 => array(
                'css' => 'sd_card',
            ),
            722 => array(
                'css' => 'sd_storage',
            ),
            723 => array(
                'css' => 'search',
            ),
            724 => array(
                'css' => 'security',
            ),
            725 => array(
                'css' => 'select_all',
            ),
            726 => array(
                'css' => 'send',
            ),
            727 => array(
                'css' => 'sentiment_dissatisfied',
            ),
            728 => array(
                'css' => 'sentiment_neutral',
            ),
            729 => array(
                'css' => 'sentiment_satisfied',
            ),
            730 => array(
                'css' => 'sentiment_very_dissatisfied',
            ),
            731 => array(
                'css' => 'sentiment_very_satisfied',
            ),
            732 => array(
                'css' => 'settings',
            ),
            733 => array(
                'css' => 'settings_applications',
            ),
            734 => array(
                'css' => 'settings_backup_restore',
            ),
            735 => array(
                'css' => 'settings_bluetooth',
            ),
            736 => array(
                'css' => 'settings_brightness',
            ),
            737 => array(
                'css' => 'settings_cell',
            ),
            738 => array(
                'css' => 'settings_ethernet',
            ),
            739 => array(
                'css' => 'settings_input_antenna',
            ),
            740 => array(
                'css' => 'settings_input_component',
            ),
            741 => array(
                'css' => 'settings_input_composite',
            ),
            742 => array(
                'css' => 'settings_input_hdmi',
            ),
            743 => array(
                'css' => 'settings_input_svideo',
            ),
            744 => array(
                'css' => 'settings_overscan',
            ),
            745 => array(
                'css' => 'settings_phone',
            ),
            746 => array(
                'css' => 'settings_power',
            ),
            747 => array(
                'css' => 'settings_remote',
            ),
            748 => array(
                'css' => 'settings_system_daydream',
            ),
            749 => array(
                'css' => 'settings_voice',
            ),
            750 => array(
                'css' => 'share',
            ),
            751 => array(
                'css' => 'shop',
            ),
            752 => array(
                'css' => 'shop_two',
            ),
            753 => array(
                'css' => 'shopping_basket',
            ),
            754 => array(
                'css' => 'shopping_cart',
            ),
            755 => array(
                'css' => 'short_text',
            ),
            756 => array(
                'css' => 'show_chart',
            ),
            757 => array(
                'css' => 'shuffle',
            ),
            758 => array(
                'css' => 'signal_cellular_4_bar',
            ),
            759 => array(
                'css' => 'signal_cellular_connected_no_internet_4_bar',
            ),
            760 => array(
                'css' => 'signal_cellular_no_sim',
            ),
            761 => array(
                'css' => 'signal_cellular_null',
            ),
            762 => array(
                'css' => 'signal_cellular_off',
            ),
            763 => array(
                'css' => 'signal_wifi_4_bar',
            ),
            764 => array(
                'css' => 'signal_wifi_4_bar_lock',
            ),
            765 => array(
                'css' => 'signal_wifi_off',
            ),
            766 => array(
                'css' => 'sim_card',
            ),
            767 => array(
                'css' => 'sim_card_alert',
            ),
            768 => array(
                'css' => 'skip_next',
            ),
            769 => array(
                'css' => 'skip_previous',
            ),
            770 => array(
                'css' => 'slideshow',
            ),
            771 => array(
                'css' => 'slow_motion_video',
            ),
            772 => array(
                'css' => 'smartphone',
            ),
            773 => array(
                'css' => 'smoke_free',
            ),
            774 => array(
                'css' => 'smoking_rooms',
            ),
            775 => array(
                'css' => 'sms',
            ),
            776 => array(
                'css' => 'sms_failed',
            ),
            777 => array(
                'css' => 'snooze',
            ),
            778 => array(
                'css' => 'sort',
            ),
            779 => array(
                'css' => 'sort_by_alpha',
            ),
            780 => array(
                'css' => 'spa',
            ),
            781 => array(
                'css' => 'space_bar',
            ),
            782 => array(
                'css' => 'speaker',
            ),
            783 => array(
                'css' => 'speaker_group',
            ),
            784 => array(
                'css' => 'speaker_notes',
            ),
            785 => array(
                'css' => 'speaker_notes_off',
            ),
            786 => array(
                'css' => 'speaker_phone',
            ),
            787 => array(
                'css' => 'spellcheck',
            ),
            788 => array(
                'css' => 'star',
            ),
            789 => array(
                'css' => 'star_border',
            ),
            790 => array(
                'css' => 'star_half',
            ),
            791 => array(
                'css' => 'stars',
            ),
            792 => array(
                'css' => 'stay_current_landscape',
            ),
            793 => array(
                'css' => 'stay_current_portrait',
            ),
            794 => array(
                'css' => 'stay_primary_landscape',
            ),
            795 => array(
                'css' => 'stay_primary_portrait',
            ),
            796 => array(
                'css' => 'stop',
            ),
            797 => array(
                'css' => 'stop_screen_share',
            ),
            798 => array(
                'css' => 'storage',
            ),
            799 => array(
                'css' => 'store',
            ),
            800 => array(
                'css' => 'store_mall_directory',
            ),
            801 => array(
                'css' => 'straighten',
            ),
            802 => array(
                'css' => 'streetview',
            ),
            803 => array(
                'css' => 'strikethrough_s',
            ),
            804 => array(
                'css' => 'style',
            ),
            805 => array(
                'css' => 'subdirectory_arrow_left',
            ),
            806 => array(
                'css' => 'subdirectory_arrow_right',
            ),
            807 => array(
                'css' => 'subject',
            ),
            808 => array(
                'css' => 'subscriptions',
            ),
            809 => array(
                'css' => 'subtitles',
            ),
            810 => array(
                'css' => 'subway',
            ),
            811 => array(
                'css' => 'supervisor_account',
            ),
            812 => array(
                'css' => 'surround_sound',
            ),
            813 => array(
                'css' => 'swap_calls',
            ),
            814 => array(
                'css' => 'swap_horiz',
            ),
            815 => array(
                'css' => 'swap_vert',
            ),
            816 => array(
                'css' => 'swap_vertical_circle',
            ),
            817 => array(
                'css' => 'switch_camera',
            ),
            818 => array(
                'css' => 'switch_video',
            ),
            819 => array(
                'css' => 'sync',
            ),
            820 => array(
                'css' => 'sync_disabled',
            ),
            821 => array(
                'css' => 'sync_problem',
            ),
            822 => array(
                'css' => 'system_update',
            ),
            823 => array(
                'css' => 'system_update_alt',
            ),
            824 => array(
                'css' => 'tab',
            ),
            825 => array(
                'css' => 'tab_unselected',
            ),
            826 => array(
                'css' => 'tablet',
            ),
            827 => array(
                'css' => 'tablet_android',
            ),
            828 => array(
                'css' => 'tablet_mac',
            ),
            829 => array(
                'css' => 'tag_faces',
            ),
            830 => array(
                'css' => 'tap_and_play',
            ),
            831 => array(
                'css' => 'terrain',
            ),
            832 => array(
                'css' => 'text_fields',
            ),
            833 => array(
                'css' => 'text_format',
            ),
            834 => array(
                'css' => 'textsms',
            ),
            835 => array(
                'css' => 'texture',
            ),
            836 => array(
                'css' => 'theaters',
            ),
            837 => array(
                'css' => 'thumb_down',
            ),
            838 => array(
                'css' => 'thumb_up',
            ),
            839 => array(
                'css' => 'thumbs_up_down',
            ),
            840 => array(
                'css' => 'time_to_leave',
            ),
            841 => array(
                'css' => 'timelapse',
            ),
            842 => array(
                'css' => 'timeline',
            ),
            843 => array(
                'css' => 'timer',
            ),
            844 => array(
                'css' => 'timer_10',
            ),
            845 => array(
                'css' => 'timer_3',
            ),
            846 => array(
                'css' => 'timer_off',
            ),
            847 => array(
                'css' => 'title',
            ),
            848 => array(
                'css' => 'toc',
            ),
            849 => array(
                'css' => 'today',
            ),
            850 => array(
                'css' => 'toll',
            ),
            851 => array(
                'css' => 'tonality',
            ),
            852 => array(
                'css' => 'touch_app',
            ),
            853 => array(
                'css' => 'toys',
            ),
            854 => array(
                'css' => 'track_changes',
            ),
            855 => array(
                'css' => 'traffic',
            ),
            856 => array(
                'css' => 'train',
            ),
            857 => array(
                'css' => 'tram',
            ),
            858 => array(
                'css' => 'transfer_within_a_station',
            ),
            859 => array(
                'css' => 'transform',
            ),
            860 => array(
                'css' => 'translate',
            ),
            861 => array(
                'css' => 'trending_down',
            ),
            862 => array(
                'css' => 'trending_flat',
            ),
            863 => array(
                'css' => 'trending_up',
            ),
            864 => array(
                'css' => 'tune',
            ),
            865 => array(
                'css' => 'turned_in',
            ),
            866 => array(
                'css' => 'turned_in_not',
            ),
            867 => array(
                'css' => 'tv',
            ),
            868 => array(
                'css' => 'unarchive',
            ),
            869 => array(
                'css' => 'undo',
            ),
            870 => array(
                'css' => 'unfold_less',
            ),
            871 => array(
                'css' => 'unfold_more',
            ),
            872 => array(
                'css' => 'update',
            ),
            873 => array(
                'css' => 'usb',
            ),
            874 => array(
                'css' => 'verified_user',
            ),
            875 => array(
                'css' => 'vertical_align_bottom',
            ),
            876 => array(
                'css' => 'vertical_align_center',
            ),
            877 => array(
                'css' => 'vertical_align_top',
            ),
            878 => array(
                'css' => 'vibration',
            ),
            879 => array(
                'css' => 'video_call',
            ),
            880 => array(
                'css' => 'video_label',
            ),
            881 => array(
                'css' => 'video_library',
            ),
            882 => array(
                'css' => 'videocam',
            ),
            883 => array(
                'css' => 'videocam_off',
            ),
            884 => array(
                'css' => 'videogame_asset',
            ),
            885 => array(
                'css' => 'view_agenda',
            ),
            886 => array(
                'css' => 'view_array',
            ),
            887 => array(
                'css' => 'view_carousel',
            ),
            888 => array(
                'css' => 'view_column',
            ),
            889 => array(
                'css' => 'view_comfy',
            ),
            890 => array(
                'css' => 'view_compact',
            ),
            891 => array(
                'css' => 'view_day',
            ),
            892 => array(
                'css' => 'view_headline',
            ),
            893 => array(
                'css' => 'view_list',
            ),
            894 => array(
                'css' => 'view_module',
            ),
            895 => array(
                'css' => 'view_quilt',
            ),
            896 => array(
                'css' => 'view_stream',
            ),
            897 => array(
                'css' => 'view_week',
            ),
            898 => array(
                'css' => 'vignette',
            ),
            899 => array(
                'css' => 'visibility',
            ),
            900 => array(
                'css' => 'visibility_off',
            ),
            901 => array(
                'css' => 'voice_chat',
            ),
            902 => array(
                'css' => 'voicemail',
            ),
            903 => array(
                'css' => 'volume_down',
            ),
            904 => array(
                'css' => 'volume_mute',
            ),
            905 => array(
                'css' => 'volume_off',
            ),
            906 => array(
                'css' => 'volume_up',
            ),
            907 => array(
                'css' => 'vpn_key',
            ),
            908 => array(
                'css' => 'vpn_lock',
            ),
            909 => array(
                'css' => 'wallpaper',
            ),
            910 => array(
                'css' => 'warning',
            ),
            911 => array(
                'css' => 'watch',
            ),
            912 => array(
                'css' => 'watch_later',
            ),
            913 => array(
                'css' => 'wb_auto',
            ),
            914 => array(
                'css' => 'wb_cloudy',
            ),
            915 => array(
                'css' => 'wb_incandescent',
            ),
            916 => array(
                'css' => 'wb_iridescent',
            ),
            917 => array(
                'css' => 'wb_sunny',
            ),
            918 => array(
                'css' => 'wc',
            ),
            919 => array(
                'css' => 'web',
            ),
            920 => array(
                'css' => 'web_asset',
            ),
            921 => array(
                'css' => 'weekend',
            ),
            922 => array(
                'css' => 'whatshot',
            ),
            923 => array(
                'css' => 'widgets',
            ),
            924 => array(
                'css' => 'wifi',
            ),
            925 => array(
                'css' => 'wifi_lock',
            ),
            926 => array(
                'css' => 'wifi_tethering',
            ),
            927 => array(
                'css' => 'work',
            ),
            928 => array(
                'css' => 'wrap_text',
            ),
            929 => array(
                'css' => 'youtube_searched_for',
            ),
            930 => array(
                'css' => 'wpc_in',
            ),
            931 => array(
                'css' => 'wpc_out',
            ),
            932 => array(
                'css' => 'wpc_out_map',
            ),
        ),
    );

    return $materialicons;

}