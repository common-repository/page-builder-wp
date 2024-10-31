<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pbwp_icon_fontawesome()
{

    $fontawesome = array(
        'css_prefix_text' => 'fa ',
        'glyphs'          => array(
            0   => array(
                'css' => 'fa-address-book',
            ),
            1   => array(
                'css' => 'fa-address-book-o',
            ),
            2   => array(
                'css' => 'fa-address-card',
            ),
            3   => array(
                'css' => 'fa-address-card-o',
            ),
            4   => array(
                'css' => 'fa-bandcamp',
            ),
            5   => array(
                'css' => 'fa-bath',
            ),
            6   => array(
                'css' => 'fa-bathtub',
            ),
            7   => array(
                'css' => 'fa-drivers-license',
            ),
            8   => array(
                'css' => 'fa-drivers-license-o',
            ),
            9   => array(
                'css' => 'fa-eercast',
            ),
            10  => array(
                'css' => 'fa-envelope-open',
            ),
            11  => array(
                'css' => 'fa-envelope-open-o',
            ),
            12  => array(
                'css' => 'fa-etsy',
            ),
            13  => array(
                'css' => 'fa-free-code-camp',
            ),
            14  => array(
                'css' => 'fa-grav',
            ),
            15  => array(
                'css' => 'fa-handshake-o',
            ),
            16  => array(
                'css' => 'fa-id-badge',
            ),
            17  => array(
                'css' => 'fa-id-card',
            ),
            18  => array(
                'css' => 'fa-id-card-o',
            ),
            19  => array(
                'css' => 'fa-imdb',
            ),
            20  => array(
                'css' => 'fa-linode',
            ),
            21  => array(
                'css' => 'fa-meetup',
            ),
            22  => array(
                'css' => 'fa-microchip',
            ),
            23  => array(
                'css' => 'fa-podcast',
            ),
            24  => array(
                'css' => 'fa-quora',
            ),
            25  => array(
                'css' => 'fa-ravelry',
            ),
            26  => array(
                'css' => 'fa-s15',
            ),
            27  => array(
                'css' => 'fa-shower',
            ),
            28  => array(
                'css' => 'fa-snowflake-o',
            ),
            29  => array(
                'css' => 'fa-superpowers',
            ),
            30  => array(
                'css' => 'fa-telegram',
            ),
            31  => array(
                'css' => 'fa-thermometer',
            ),
            32  => array(
                'css' => 'fa-thermometer-0',
            ),
            33  => array(
                'css' => 'fa-thermometer-1',
            ),
            34  => array(
                'css' => 'fa-thermometer-2',
            ),
            35  => array(
                'css' => 'fa-thermometer-3',
            ),
            36  => array(
                'css' => 'fa-thermometer-4',
            ),
            37  => array(
                'css' => 'fa-thermometer-empty',
            ),
            38  => array(
                'css' => 'fa-thermometer-full',
            ),
            39  => array(
                'css' => 'fa-thermometer-half',
            ),
            40  => array(
                'css' => 'fa-thermometer-quarter',
            ),
            41  => array(
                'css' => 'fa-thermometer-three-quarters',
            ),
            42  => array(
                'css' => 'fa-times-rectangle',
            ),
            43  => array(
                'css' => 'fa-times-rectangle-o',
            ),
            44  => array(
                'css' => 'fa-user-circle',
            ),
            45  => array(
                'css' => 'fa-user-circle-o',
            ),
            46  => array(
                'css' => 'fa-user-o',
            ),
            47  => array(
                'css' => 'fa-vcard',
            ),
            48  => array(
                'css' => 'fa-vcard-o',
            ),
            49  => array(
                'css' => 'fa-window-close',
            ),
            50  => array(
                'css' => 'fa-window-close-o',
            ),
            51  => array(
                'css' => 'fa-window-maximize',
            ),
            52  => array(
                'css' => 'fa-window-minimize',
            ),
            53  => array(
                'css' => 'fa-window-restore',
            ),
            54  => array(
                'css' => 'fa-wpexplorer',
            ),
            55  => array(
                'css' => 'fa-address-book',
            ),
            56  => array(
                'css' => 'fa-address-book-o',
            ),
            57  => array(
                'css' => 'fa-address-card',
            ),
            58  => array(
                'css' => 'fa-address-card-o',
            ),
            59  => array(
                'css' => 'fa-adjust',
            ),
            60  => array(
                'css' => 'fa-american-sign-language-interpreting',
            ),
            61  => array(
                'css' => 'fa-anchor',
            ),
            62  => array(
                'css' => 'fa-archive',
            ),
            63  => array(
                'css' => 'fa-area-chart',
            ),
            64  => array(
                'css' => 'fa-arrows',
            ),
            65  => array(
                'css' => 'fa-arrows-h',
            ),
            66  => array(
                'css' => 'fa-arrows-v',
            ),
            67  => array(
                'css' => 'fa-asl-interpreting',
            ),
            68  => array(
                'css' => 'fa-assistive-listening-systems',
            ),
            69  => array(
                'css' => 'fa-asterisk',
            ),
            70  => array(
                'css' => 'fa-at',
            ),
            71  => array(
                'css' => 'fa-audio-description',
            ),
            72  => array(
                'css' => 'fa-automobile',
            ),
            73  => array(
                'css' => 'fa-balance-scale',
            ),
            74  => array(
                'css' => 'fa-ban',
            ),
            75  => array(
                'css' => 'fa-bank',
            ),
            76  => array(
                'css' => 'fa-bar-chart',
            ),
            77  => array(
                'css' => 'fa-bar-chart-o',
            ),
            78  => array(
                'css' => 'fa-barcode',
            ),
            79  => array(
                'css' => 'fa-bars',
            ),
            80  => array(
                'css' => 'fa-bath',
            ),
            81  => array(
                'css' => 'fa-bathtub',
            ),
            82  => array(
                'css' => 'fa-battery',
            ),
            83  => array(
                'css' => 'fa-battery-0',
            ),
            84  => array(
                'css' => 'fa-battery-1',
            ),
            85  => array(
                'css' => 'fa-battery-2',
            ),
            86  => array(
                'css' => 'fa-battery-3',
            ),
            87  => array(
                'css' => 'fa-battery-4',
            ),
            88  => array(
                'css' => 'fa-battery-empty',
            ),
            89  => array(
                'css' => 'fa-battery-full',
            ),
            90  => array(
                'css' => 'fa-battery-half',
            ),
            91  => array(
                'css' => 'fa-battery-quarter',
            ),
            92  => array(
                'css' => 'fa-battery-three-quarters',
            ),
            93  => array(
                'css' => 'fa-bed',
            ),
            94  => array(
                'css' => 'fa-beer',
            ),
            95  => array(
                'css' => 'fa-bell',
            ),
            96  => array(
                'css' => 'fa-bell-o',
            ),
            97  => array(
                'css' => 'fa-bell-slash',
            ),
            98  => array(
                'css' => 'fa-bell-slash-o',
            ),
            99  => array(
                'css' => 'fa-bicycle',
            ),
            100 => array(
                'css' => 'fa-binoculars',
            ),
            101 => array(
                'css' => 'fa-birthday-cake',
            ),
            102 => array(
                'css' => 'fa-blind',
            ),
            103 => array(
                'css' => 'fa-bluetooth',
            ),
            104 => array(
                'css' => 'fa-bluetooth-b',
            ),
            105 => array(
                'css' => 'fa-bolt',
            ),
            106 => array(
                'css' => 'fa-bomb',
            ),
            107 => array(
                'css' => 'fa-book',
            ),
            108 => array(
                'css' => 'fa-bookmark',
            ),
            109 => array(
                'css' => 'fa-bookmark-o',
            ),
            110 => array(
                'css' => 'fa-braille',
            ),
            111 => array(
                'css' => 'fa-briefcase',
            ),
            112 => array(
                'css' => 'fa-bug',
            ),
            113 => array(
                'css' => 'fa-building',
            ),
            114 => array(
                'css' => 'fa-building-o',
            ),
            115 => array(
                'css' => 'fa-bullhorn',
            ),
            116 => array(
                'css' => 'fa-bullseye',
            ),
            117 => array(
                'css' => 'fa-bus',
            ),
            118 => array(
                'css' => 'fa-cab',
            ),
            119 => array(
                'css' => 'fa-calculator',
            ),
            120 => array(
                'css' => 'fa-calendar',
            ),
            121 => array(
                'css' => 'fa-calendar-check-o',
            ),
            122 => array(
                'css' => 'fa-calendar-minus-o',
            ),
            123 => array(
                'css' => 'fa-calendar-o',
            ),
            124 => array(
                'css' => 'fa-calendar-plus-o',
            ),
            125 => array(
                'css' => 'fa-calendar-times-o',
            ),
            126 => array(
                'css' => 'fa-camera',
            ),
            127 => array(
                'css' => 'fa-camera-retro',
            ),
            128 => array(
                'css' => 'fa-car',
            ),
            129 => array(
                'css' => 'fa-caret-square-o-down',
            ),
            130 => array(
                'css' => 'fa-caret-square-o-left',
            ),
            131 => array(
                'css' => 'fa-caret-square-o-right',
            ),
            132 => array(
                'css' => 'fa-caret-square-o-up',
            ),
            133 => array(
                'css' => 'fa-cart-arrow-down',
            ),
            134 => array(
                'css' => 'fa-cart-plus',
            ),
            135 => array(
                'css' => 'fa-cc',
            ),
            136 => array(
                'css' => 'fa-certificate',
            ),
            137 => array(
                'css' => 'fa-check',
            ),
            138 => array(
                'css' => 'fa-check-circle',
            ),
            139 => array(
                'css' => 'fa-check-circle-o',
            ),
            140 => array(
                'css' => 'fa-check-square',
            ),
            141 => array(
                'css' => 'fa-check-square-o',
            ),
            142 => array(
                'css' => 'fa-child',
            ),
            143 => array(
                'css' => 'fa-circle',
            ),
            144 => array(
                'css' => 'fa-circle-o',
            ),
            145 => array(
                'css' => 'fa-circle-o-notch',
            ),
            146 => array(
                'css' => 'fa-circle-thin',
            ),
            147 => array(
                'css' => 'fa-clock-o',
            ),
            148 => array(
                'css' => 'fa-clone',
            ),
            149 => array(
                'css' => 'fa-close',
            ),
            150 => array(
                'css' => 'fa-cloud',
            ),
            151 => array(
                'css' => 'fa-cloud-download',
            ),
            152 => array(
                'css' => 'fa-cloud-upload',
            ),
            153 => array(
                'css' => 'fa-code',
            ),
            154 => array(
                'css' => 'fa-code-fork',
            ),
            155 => array(
                'css' => 'fa-coffee',
            ),
            156 => array(
                'css' => 'fa-cog',
            ),
            157 => array(
                'css' => 'fa-cogs',
            ),
            158 => array(
                'css' => 'fa-comment',
            ),
            159 => array(
                'css' => 'fa-comment-o',
            ),
            160 => array(
                'css' => 'fa-commenting',
            ),
            161 => array(
                'css' => 'fa-commenting-o',
            ),
            162 => array(
                'css' => 'fa-comments',
            ),
            163 => array(
                'css' => 'fa-comments-o',
            ),
            164 => array(
                'css' => 'fa-compass',
            ),
            165 => array(
                'css' => 'fa-copyright',
            ),
            166 => array(
                'css' => 'fa-creative-commons',
            ),
            167 => array(
                'css' => 'fa-credit-card',
            ),
            168 => array(
                'css' => 'fa-credit-card-alt',
            ),
            169 => array(
                'css' => 'fa-crop',
            ),
            170 => array(
                'css' => 'fa-crosshairs',
            ),
            171 => array(
                'css' => 'fa-cube',
            ),
            172 => array(
                'css' => 'fa-cubes',
            ),
            173 => array(
                'css' => 'fa-cutlery',
            ),
            174 => array(
                'css' => 'fa-dashboard',
            ),
            175 => array(
                'css' => 'fa-database',
            ),
            176 => array(
                'css' => 'fa-deaf',
            ),
            177 => array(
                'css' => 'fa-deafness',
            ),
            178 => array(
                'css' => 'fa-desktop',
            ),
            179 => array(
                'css' => 'fa-diamond',
            ),
            180 => array(
                'css' => 'fa-dot-circle-o',
            ),
            181 => array(
                'css' => 'fa-download',
            ),
            182 => array(
                'css' => 'fa-drivers-license',
            ),
            183 => array(
                'css' => 'fa-drivers-license-o',
            ),
            184 => array(
                'css' => 'fa-edit',
            ),
            185 => array(
                'css' => 'fa-ellipsis-h',
            ),
            186 => array(
                'css' => 'fa-ellipsis-v',
            ),
            187 => array(
                'css' => 'fa-envelope',
            ),
            188 => array(
                'css' => 'fa-envelope-o',
            ),
            189 => array(
                'css' => 'fa-envelope-open',
            ),
            190 => array(
                'css' => 'fa-envelope-open-o',
            ),
            191 => array(
                'css' => 'fa-envelope-square',
            ),
            192 => array(
                'css' => 'fa-eraser',
            ),
            193 => array(
                'css' => 'fa-exchange',
            ),
            194 => array(
                'css' => 'fa-exclamation',
            ),
            195 => array(
                'css' => 'fa-exclamation-circle',
            ),
            196 => array(
                'css' => 'fa-exclamation-triangle',
            ),
            197 => array(
                'css' => 'fa-external-link',
            ),
            198 => array(
                'css' => 'fa-external-link-square',
            ),
            199 => array(
                'css' => 'fa-eye',
            ),
            200 => array(
                'css' => 'fa-eye-slash',
            ),
            201 => array(
                'css' => 'fa-eyedropper',
            ),
            202 => array(
                'css' => 'fa-fax',
            ),
            203 => array(
                'css' => 'fa-feed',
            ),
            204 => array(
                'css' => 'fa-female',
            ),
            205 => array(
                'css' => 'fa-fighter-jet',
            ),
            206 => array(
                'css' => 'fa-file-archive-o',
            ),
            207 => array(
                'css' => 'fa-file-audio-o',
            ),
            208 => array(
                'css' => 'fa-file-code-o',
            ),
            209 => array(
                'css' => 'fa-file-excel-o',
            ),
            210 => array(
                'css' => 'fa-file-image-o',
            ),
            211 => array(
                'css' => 'fa-file-movie-o',
            ),
            212 => array(
                'css' => 'fa-file-pdf-o',
            ),
            213 => array(
                'css' => 'fa-file-photo-o',
            ),
            214 => array(
                'css' => 'fa-file-picture-o',
            ),
            215 => array(
                'css' => 'fa-file-powerpoint-o',
            ),
            216 => array(
                'css' => 'fa-file-sound-o',
            ),
            217 => array(
                'css' => 'fa-file-video-o',
            ),
            218 => array(
                'css' => 'fa-file-word-o',
            ),
            219 => array(
                'css' => 'fa-file-zip-o',
            ),
            220 => array(
                'css' => 'fa-film',
            ),
            221 => array(
                'css' => 'fa-filter',
            ),
            222 => array(
                'css' => 'fa-fire',
            ),
            223 => array(
                'css' => 'fa-fire-extinguisher',
            ),
            224 => array(
                'css' => 'fa-flag',
            ),
            225 => array(
                'css' => 'fa-flag-checkered',
            ),
            226 => array(
                'css' => 'fa-flag-o',
            ),
            227 => array(
                'css' => 'fa-flash',
            ),
            228 => array(
                'css' => 'fa-flask',
            ),
            229 => array(
                'css' => 'fa-folder',
            ),
            230 => array(
                'css' => 'fa-folder-o',
            ),
            231 => array(
                'css' => 'fa-folder-open',
            ),
            232 => array(
                'css' => 'fa-folder-open-o',
            ),
            233 => array(
                'css' => 'fa-frown-o',
            ),
            234 => array(
                'css' => 'fa-futbol-o',
            ),
            235 => array(
                'css' => 'fa-gamepad',
            ),
            236 => array(
                'css' => 'fa-gavel',
            ),
            237 => array(
                'css' => 'fa-gear',
            ),
            238 => array(
                'css' => 'fa-gears',
            ),
            239 => array(
                'css' => 'fa-gift',
            ),
            240 => array(
                'css' => 'fa-glass',
            ),
            241 => array(
                'css' => 'fa-globe',
            ),
            242 => array(
                'css' => 'fa-graduation-cap',
            ),
            243 => array(
                'css' => 'fa-group',
            ),
            244 => array(
                'css' => 'fa-hand-grab-o',
            ),
            245 => array(
                'css' => 'fa-hand-lizard-o',
            ),
            246 => array(
                'css' => 'fa-hand-paper-o',
            ),
            247 => array(
                'css' => 'fa-hand-peace-o',
            ),
            248 => array(
                'css' => 'fa-hand-pointer-o',
            ),
            249 => array(
                'css' => 'fa-hand-rock-o',
            ),
            250 => array(
                'css' => 'fa-hand-scissors-o',
            ),
            251 => array(
                'css' => 'fa-hand-spock-o',
            ),
            252 => array(
                'css' => 'fa-hand-stop-o',
            ),
            253 => array(
                'css' => 'fa-handshake-o',
            ),
            254 => array(
                'css' => 'fa-hard-of-hearing',
            ),
            255 => array(
                'css' => 'fa-hashtag',
            ),
            256 => array(
                'css' => 'fa-hdd-o',
            ),
            257 => array(
                'css' => 'fa-headphones',
            ),
            258 => array(
                'css' => 'fa-heart',
            ),
            259 => array(
                'css' => 'fa-heart-o',
            ),
            260 => array(
                'css' => 'fa-heartbeat',
            ),
            261 => array(
                'css' => 'fa-history',
            ),
            262 => array(
                'css' => 'fa-home',
            ),
            263 => array(
                'css' => 'fa-hotel',
            ),
            264 => array(
                'css' => 'fa-hourglass',
            ),
            265 => array(
                'css' => 'fa-hourglass-1',
            ),
            266 => array(
                'css' => 'fa-hourglass-2',
            ),
            267 => array(
                'css' => 'fa-hourglass-3',
            ),
            268 => array(
                'css' => 'fa-hourglass-end',
            ),
            269 => array(
                'css' => 'fa-hourglass-half',
            ),
            270 => array(
                'css' => 'fa-hourglass-o',
            ),
            271 => array(
                'css' => 'fa-hourglass-start',
            ),
            272 => array(
                'css' => 'fa-i-cursor',
            ),
            273 => array(
                'css' => 'fa-id-badge',
            ),
            274 => array(
                'css' => 'fa-id-card',
            ),
            275 => array(
                'css' => 'fa-id-card-o',
            ),
            276 => array(
                'css' => 'fa-image',
            ),
            277 => array(
                'css' => 'fa-inbox',
            ),
            278 => array(
                'css' => 'fa-industry',
            ),
            279 => array(
                'css' => 'fa-info',
            ),
            280 => array(
                'css' => 'fa-info-circle',
            ),
            281 => array(
                'css' => 'fa-institution',
            ),
            282 => array(
                'css' => 'fa-key',
            ),
            283 => array(
                'css' => 'fa-keyboard-o',
            ),
            284 => array(
                'css' => 'fa-language',
            ),
            285 => array(
                'css' => 'fa-laptop',
            ),
            286 => array(
                'css' => 'fa-leaf',
            ),
            287 => array(
                'css' => 'fa-legal',
            ),
            288 => array(
                'css' => 'fa-lemon-o',
            ),
            289 => array(
                'css' => 'fa-level-down',
            ),
            290 => array(
                'css' => 'fa-level-up',
            ),
            291 => array(
                'css' => 'fa-life-bouy',
            ),
            292 => array(
                'css' => 'fa-life-buoy',
            ),
            293 => array(
                'css' => 'fa-life-ring',
            ),
            294 => array(
                'css' => 'fa-life-saver',
            ),
            295 => array(
                'css' => 'fa-lightbulb-o',
            ),
            296 => array(
                'css' => 'fa-line-chart',
            ),
            297 => array(
                'css' => 'fa-location-arrow',
            ),
            298 => array(
                'css' => 'fa-lock',
            ),
            299 => array(
                'css' => 'fa-low-vision',
            ),
            300 => array(
                'css' => 'fa-magic',
            ),
            301 => array(
                'css' => 'fa-magnet',
            ),
            302 => array(
                'css' => 'fa-mail-forward',
            ),
            303 => array(
                'css' => 'fa-mail-reply',
            ),
            304 => array(
                'css' => 'fa-mail-reply-all',
            ),
            305 => array(
                'css' => 'fa-male',
            ),
            306 => array(
                'css' => 'fa-map',
            ),
            307 => array(
                'css' => 'fa-map-marker',
            ),
            308 => array(
                'css' => 'fa-map-o',
            ),
            309 => array(
                'css' => 'fa-map-pin',
            ),
            310 => array(
                'css' => 'fa-map-signs',
            ),
            311 => array(
                'css' => 'fa-meh-o',
            ),
            312 => array(
                'css' => 'fa-microchip',
            ),
            313 => array(
                'css' => 'fa-microphone',
            ),
            314 => array(
                'css' => 'fa-microphone-slash',
            ),
            315 => array(
                'css' => 'fa-minus',
            ),
            316 => array(
                'css' => 'fa-minus-circle',
            ),
            317 => array(
                'css' => 'fa-minus-square',
            ),
            318 => array(
                'css' => 'fa-minus-square-o',
            ),
            319 => array(
                'css' => 'fa-mobile',
            ),
            320 => array(
                'css' => 'fa-mobile-phone',
            ),
            321 => array(
                'css' => 'fa-money',
            ),
            322 => array(
                'css' => 'fa-moon-o',
            ),
            323 => array(
                'css' => 'fa-mortar-board',
            ),
            324 => array(
                'css' => 'fa-motorcycle',
            ),
            325 => array(
                'css' => 'fa-mouse-pointer',
            ),
            326 => array(
                'css' => 'fa-music',
            ),
            327 => array(
                'css' => 'fa-navicon',
            ),
            328 => array(
                'css' => 'fa-newspaper-o',
            ),
            329 => array(
                'css' => 'fa-object-group',
            ),
            330 => array(
                'css' => 'fa-object-ungroup',
            ),
            331 => array(
                'css' => 'fa-paint-brush',
            ),
            332 => array(
                'css' => 'fa-paper-plane',
            ),
            333 => array(
                'css' => 'fa-paper-plane-o',
            ),
            334 => array(
                'css' => 'fa-paw',
            ),
            335 => array(
                'css' => 'fa-pencil',
            ),
            336 => array(
                'css' => 'fa-pencil-square',
            ),
            337 => array(
                'css' => 'fa-pencil-square-o',
            ),
            338 => array(
                'css' => 'fa-percent',
            ),
            339 => array(
                'css' => 'fa-phone',
            ),
            340 => array(
                'css' => 'fa-phone-square',
            ),
            341 => array(
                'css' => 'fa-photo',
            ),
            342 => array(
                'css' => 'fa-picture-o',
            ),
            343 => array(
                'css' => 'fa-pie-chart',
            ),
            344 => array(
                'css' => 'fa-plane',
            ),
            345 => array(
                'css' => 'fa-plug',
            ),
            346 => array(
                'css' => 'fa-plus',
            ),
            347 => array(
                'css' => 'fa-plus-circle',
            ),
            348 => array(
                'css' => 'fa-plus-square',
            ),
            349 => array(
                'css' => 'fa-plus-square-o',
            ),
            350 => array(
                'css' => 'fa-podcast',
            ),
            351 => array(
                'css' => 'fa-power-off',
            ),
            352 => array(
                'css' => 'fa-print',
            ),
            353 => array(
                'css' => 'fa-puzzle-piece',
            ),
            354 => array(
                'css' => 'fa-qrcode',
            ),
            355 => array(
                'css' => 'fa-question',
            ),
            356 => array(
                'css' => 'fa-question-circle',
            ),
            357 => array(
                'css' => 'fa-question-circle-o',
            ),
            358 => array(
                'css' => 'fa-quote-left',
            ),
            359 => array(
                'css' => 'fa-quote-right',
            ),
            360 => array(
                'css' => 'fa-random',
            ),
            361 => array(
                'css' => 'fa-recycle',
            ),
            362 => array(
                'css' => 'fa-refresh',
            ),
            363 => array(
                'css' => 'fa-registered',
            ),
            364 => array(
                'css' => 'fa-remove',
            ),
            365 => array(
                'css' => 'fa-reorder',
            ),
            366 => array(
                'css' => 'fa-reply',
            ),
            367 => array(
                'css' => 'fa-reply-all',
            ),
            368 => array(
                'css' => 'fa-retweet',
            ),
            369 => array(
                'css' => 'fa-road',
            ),
            370 => array(
                'css' => 'fa-rocket',
            ),
            371 => array(
                'css' => 'fa-rss',
            ),
            372 => array(
                'css' => 'fa-rss-square',
            ),
            373 => array(
                'css' => 'fa-s15',
            ),
            374 => array(
                'css' => 'fa-search',
            ),
            375 => array(
                'css' => 'fa-search-minus',
            ),
            376 => array(
                'css' => 'fa-search-plus',
            ),
            377 => array(
                'css' => 'fa-send',
            ),
            378 => array(
                'css' => 'fa-send-o',
            ),
            379 => array(
                'css' => 'fa-server',
            ),
            380 => array(
                'css' => 'fa-share',
            ),
            381 => array(
                'css' => 'fa-share-alt',
            ),
            382 => array(
                'css' => 'fa-share-alt-square',
            ),
            383 => array(
                'css' => 'fa-share-square',
            ),
            384 => array(
                'css' => 'fa-share-square-o',
            ),
            385 => array(
                'css' => 'fa-shield',
            ),
            386 => array(
                'css' => 'fa-ship',
            ),
            387 => array(
                'css' => 'fa-shopping-bag',
            ),
            388 => array(
                'css' => 'fa-shopping-basket',
            ),
            389 => array(
                'css' => 'fa-shopping-cart',
            ),
            390 => array(
                'css' => 'fa-shower',
            ),
            391 => array(
                'css' => 'fa-sign-in',
            ),
            392 => array(
                'css' => 'fa-sign-language',
            ),
            393 => array(
                'css' => 'fa-sign-out',
            ),
            394 => array(
                'css' => 'fa-signal',
            ),
            395 => array(
                'css' => 'fa-signing',
            ),
            396 => array(
                'css' => 'fa-sitemap',
            ),
            397 => array(
                'css' => 'fa-sliders',
            ),
            398 => array(
                'css' => 'fa-smile-o',
            ),
            399 => array(
                'css' => 'fa-snowflake-o',
            ),
            400 => array(
                'css' => 'fa-soccer-ball-o',
            ),
            401 => array(
                'css' => 'fa-sort',
            ),
            402 => array(
                'css' => 'fa-sort-alpha-asc',
            ),
            403 => array(
                'css' => 'fa-sort-alpha-desc',
            ),
            404 => array(
                'css' => 'fa-sort-amount-asc',
            ),
            405 => array(
                'css' => 'fa-sort-amount-desc',
            ),
            406 => array(
                'css' => 'fa-sort-asc',
            ),
            407 => array(
                'css' => 'fa-sort-desc',
            ),
            408 => array(
                'css' => 'fa-sort-down',
            ),
            409 => array(
                'css' => 'fa-sort-numeric-asc',
            ),
            410 => array(
                'css' => 'fa-sort-numeric-desc',
            ),
            411 => array(
                'css' => 'fa-sort-up',
            ),
            412 => array(
                'css' => 'fa-space-shuttle',
            ),
            413 => array(
                'css' => 'fa-spinner',
            ),
            414 => array(
                'css' => 'fa-spoon',
            ),
            415 => array(
                'css' => 'fa-square',
            ),
            416 => array(
                'css' => 'fa-square-o',
            ),
            417 => array(
                'css' => 'fa-star',
            ),
            418 => array(
                'css' => 'fa-star-half',
            ),
            419 => array(
                'css' => 'fa-star-half-empty',
            ),
            420 => array(
                'css' => 'fa-star-half-full',
            ),
            421 => array(
                'css' => 'fa-star-half-o',
            ),
            422 => array(
                'css' => 'fa-star-o',
            ),
            423 => array(
                'css' => 'fa-sticky-note',
            ),
            424 => array(
                'css' => 'fa-sticky-note-o',
            ),
            425 => array(
                'css' => 'fa-street-view',
            ),
            426 => array(
                'css' => 'fa-suitcase',
            ),
            427 => array(
                'css' => 'fa-sun-o',
            ),
            428 => array(
                'css' => 'fa-support',
            ),
            429 => array(
                'css' => 'fa-tablet',
            ),
            430 => array(
                'css' => 'fa-tachometer',
            ),
            431 => array(
                'css' => 'fa-tag',
            ),
            432 => array(
                'css' => 'fa-tags',
            ),
            433 => array(
                'css' => 'fa-tasks',
            ),
            434 => array(
                'css' => 'fa-taxi',
            ),
            435 => array(
                'css' => 'fa-television',
            ),
            436 => array(
                'css' => 'fa-terminal',
            ),
            437 => array(
                'css' => 'fa-thermometer',
            ),
            438 => array(
                'css' => 'fa-thermometer-0',
            ),
            439 => array(
                'css' => 'fa-thermometer-1',
            ),
            440 => array(
                'css' => 'fa-thermometer-2',
            ),
            441 => array(
                'css' => 'fa-thermometer-3',
            ),
            442 => array(
                'css' => 'fa-thermometer-4',
            ),
            443 => array(
                'css' => 'fa-thermometer-empty',
            ),
            444 => array(
                'css' => 'fa-thermometer-full',
            ),
            445 => array(
                'css' => 'fa-thermometer-half',
            ),
            446 => array(
                'css' => 'fa-thermometer-quarter',
            ),
            447 => array(
                'css' => 'fa-thermometer-three-quarters',
            ),
            448 => array(
                'css' => 'fa-thumb-tack',
            ),
            449 => array(
                'css' => 'fa-thumbs-down',
            ),
            450 => array(
                'css' => 'fa-thumbs-o-down',
            ),
            451 => array(
                'css' => 'fa-thumbs-o-up',
            ),
            452 => array(
                'css' => 'fa-thumbs-up',
            ),
            453 => array(
                'css' => 'fa-ticket',
            ),
            454 => array(
                'css' => 'fa-times',
            ),
            455 => array(
                'css' => 'fa-times-circle',
            ),
            456 => array(
                'css' => 'fa-times-circle-o',
            ),
            457 => array(
                'css' => 'fa-times-rectangle',
            ),
            458 => array(
                'css' => 'fa-times-rectangle-o',
            ),
            459 => array(
                'css' => 'fa-tint',
            ),
            460 => array(
                'css' => 'fa-toggle-down',
            ),
            461 => array(
                'css' => 'fa-toggle-left',
            ),
            462 => array(
                'css' => 'fa-toggle-off',
            ),
            463 => array(
                'css' => 'fa-toggle-on',
            ),
            464 => array(
                'css' => 'fa-toggle-right',
            ),
            465 => array(
                'css' => 'fa-toggle-up',
            ),
            466 => array(
                'css' => 'fa-trademark',
            ),
            467 => array(
                'css' => 'fa-trash',
            ),
            468 => array(
                'css' => 'fa-trash-o',
            ),
            469 => array(
                'css' => 'fa-tree',
            ),
            470 => array(
                'css' => 'fa-trophy',
            ),
            471 => array(
                'css' => 'fa-truck',
            ),
            472 => array(
                'css' => 'fa-tty',
            ),
            473 => array(
                'css' => 'fa-tv',
            ),
            474 => array(
                'css' => 'fa-umbrella',
            ),
            475 => array(
                'css' => 'fa-universal-access',
            ),
            476 => array(
                'css' => 'fa-university',
            ),
            477 => array(
                'css' => 'fa-unlock',
            ),
            478 => array(
                'css' => 'fa-unlock-alt',
            ),
            479 => array(
                'css' => 'fa-unsorted',
            ),
            480 => array(
                'css' => 'fa-upload',
            ),
            481 => array(
                'css' => 'fa-user',
            ),
            482 => array(
                'css' => 'fa-user-circle',
            ),
            483 => array(
                'css' => 'fa-user-circle-o',
            ),
            484 => array(
                'css' => 'fa-user-o',
            ),
            485 => array(
                'css' => 'fa-user-plus',
            ),
            486 => array(
                'css' => 'fa-user-secret',
            ),
            487 => array(
                'css' => 'fa-user-times',
            ),
            488 => array(
                'css' => 'fa-users',
            ),
            489 => array(
                'css' => 'fa-vcard',
            ),
            490 => array(
                'css' => 'fa-vcard-o',
            ),
            491 => array(
                'css' => 'fa-video-camera',
            ),
            492 => array(
                'css' => 'fa-volume-control-phone',
            ),
            493 => array(
                'css' => 'fa-volume-down',
            ),
            494 => array(
                'css' => 'fa-volume-off',
            ),
            495 => array(
                'css' => 'fa-volume-up',
            ),
            496 => array(
                'css' => 'fa-warning',
            ),
            497 => array(
                'css' => 'fa-wheelchair',
            ),
            498 => array(
                'css' => 'fa-wheelchair-alt',
            ),
            499 => array(
                'css' => 'fa-wifi',
            ),
            500 => array(
                'css' => 'fa-window-close',
            ),
            501 => array(
                'css' => 'fa-window-close-o',
            ),
            502 => array(
                'css' => 'fa-window-maximize',
            ),
            503 => array(
                'css' => 'fa-window-minimize',
            ),
            504 => array(
                'css' => 'fa-window-restore',
            ),
            505 => array(
                'css' => 'fa-wrench',
            ),
            506 => array(
                'css' => 'fa-american-sign-language-interpreting',
            ),
            507 => array(
                'css' => 'fa-asl-interpreting',
            ),
            508 => array(
                'css' => 'fa-assistive-listening-systems',
            ),
            509 => array(
                'css' => 'fa-audio-description',
            ),
            510 => array(
                'css' => 'fa-blind',
            ),
            511 => array(
                'css' => 'fa-braille',
            ),
            512 => array(
                'css' => 'fa-cc',
            ),
            513 => array(
                'css' => 'fa-deaf',
            ),
            514 => array(
                'css' => 'fa-deafness',
            ),
            515 => array(
                'css' => 'fa-hard-of-hearing',
            ),
            516 => array(
                'css' => 'fa-low-vision',
            ),
            517 => array(
                'css' => 'fa-question-circle-o',
            ),
            518 => array(
                'css' => 'fa-sign-language',
            ),
            519 => array(
                'css' => 'fa-signing',
            ),
            520 => array(
                'css' => 'fa-tty',
            ),
            521 => array(
                'css' => 'fa-universal-access',
            ),
            522 => array(
                'css' => 'fa-volume-control-phone',
            ),
            523 => array(
                'css' => 'fa-wheelchair',
            ),
            524 => array(
                'css' => 'fa-wheelchair-alt',
            ),
            525 => array(
                'css' => 'fa-hand-grab-o',
            ),
            526 => array(
                'css' => 'fa-hand-lizard-o',
            ),
            527 => array(
                'css' => 'fa-hand-o-down',
            ),
            528 => array(
                'css' => 'fa-hand-o-left',
            ),
            529 => array(
                'css' => 'fa-hand-o-right',
            ),
            530 => array(
                'css' => 'fa-hand-o-up',
            ),
            531 => array(
                'css' => 'fa-hand-paper-o',
            ),
            532 => array(
                'css' => 'fa-hand-peace-o',
            ),
            533 => array(
                'css' => 'fa-hand-pointer-o',
            ),
            534 => array(
                'css' => 'fa-hand-rock-o',
            ),
            535 => array(
                'css' => 'fa-hand-scissors-o',
            ),
            536 => array(
                'css' => 'fa-hand-spock-o',
            ),
            537 => array(
                'css' => 'fa-hand-stop-o',
            ),
            538 => array(
                'css' => 'fa-thumbs-down',
            ),
            539 => array(
                'css' => 'fa-thumbs-o-down',
            ),
            540 => array(
                'css' => 'fa-thumbs-o-up',
            ),
            541 => array(
                'css' => 'fa-thumbs-up',
            ),
            542 => array(
                'css' => 'fa-ambulance',
            ),
            543 => array(
                'css' => 'fa-automobile',
            ),
            544 => array(
                'css' => 'fa-bicycle',
            ),
            545 => array(
                'css' => 'fa-bus',
            ),
            546 => array(
                'css' => 'fa-cab',
            ),
            547 => array(
                'css' => 'fa-car',
            ),
            548 => array(
                'css' => 'fa-fighter-jet',
            ),
            549 => array(
                'css' => 'fa-motorcycle',
            ),
            550 => array(
                'css' => 'fa-plane',
            ),
            551 => array(
                'css' => 'fa-rocket',
            ),
            552 => array(
                'css' => 'fa-ship',
            ),
            553 => array(
                'css' => 'fa-space-shuttle',
            ),
            554 => array(
                'css' => 'fa-subway',
            ),
            555 => array(
                'css' => 'fa-taxi',
            ),
            556 => array(
                'css' => 'fa-train',
            ),
            557 => array(
                'css' => 'fa-truck',
            ),
            558 => array(
                'css' => 'fa-wheelchair',
            ),
            559 => array(
                'css' => 'fa-wheelchair-alt',
            ),
            560 => array(
                'css' => 'fa-genderless',
            ),
            561 => array(
                'css' => 'fa-intersex',
            ),
            562 => array(
                'css' => 'fa-mars',
            ),
            563 => array(
                'css' => 'fa-mars-double',
            ),
            564 => array(
                'css' => 'fa-mars-stroke',
            ),
            565 => array(
                'css' => 'fa-mars-stroke-h',
            ),
            566 => array(
                'css' => 'fa-mars-stroke-v',
            ),
            567 => array(
                'css' => 'fa-mercury',
            ),
            568 => array(
                'css' => 'fa-neuter',
            ),
            569 => array(
                'css' => 'fa-transgender',
            ),
            570 => array(
                'css' => 'fa-transgender-alt',
            ),
            571 => array(
                'css' => 'fa-venus',
            ),
            572 => array(
                'css' => 'fa-venus-double',
            ),
            573 => array(
                'css' => 'fa-venus-mars',
            ),
            574 => array(
                'css' => 'fa-file',
            ),
            575 => array(
                'css' => 'fa-file-archive-o',
            ),
            576 => array(
                'css' => 'fa-file-audio-o',
            ),
            577 => array(
                'css' => 'fa-file-code-o',
            ),
            578 => array(
                'css' => 'fa-file-excel-o',
            ),
            579 => array(
                'css' => 'fa-file-image-o',
            ),
            580 => array(
                'css' => 'fa-file-movie-o',
            ),
            581 => array(
                'css' => 'fa-file-o',
            ),
            582 => array(
                'css' => 'fa-file-pdf-o',
            ),
            583 => array(
                'css' => 'fa-file-photo-o',
            ),
            584 => array(
                'css' => 'fa-file-picture-o',
            ),
            585 => array(
                'css' => 'fa-file-powerpoint-o',
            ),
            586 => array(
                'css' => 'fa-file-sound-o',
            ),
            587 => array(
                'css' => 'fa-file-text',
            ),
            588 => array(
                'css' => 'fa-file-text-o',
            ),
            589 => array(
                'css' => 'fa-file-video-o',
            ),
            590 => array(
                'css' => 'fa-file-word-o',
            ),
            591 => array(
                'css' => 'fa-file-zip-o',
            ),
            592 => array(
                'css' => 'fa-circle-o-notch',
            ),
            593 => array(
                'css' => 'fa-cog',
            ),
            594 => array(
                'css' => 'fa-gear',
            ),
            595 => array(
                'css' => 'fa-refresh',
            ),
            596 => array(
                'css' => 'fa-spinner',
            ),
            597 => array(
                'css' => 'fa-check-square',
            ),
            598 => array(
                'css' => 'fa-check-square-o',
            ),
            599 => array(
                'css' => 'fa-circle',
            ),
            600 => array(
                'css' => 'fa-circle-o',
            ),
            601 => array(
                'css' => 'fa-dot-circle-o',
            ),
            602 => array(
                'css' => 'fa-minus-square',
            ),
            603 => array(
                'css' => 'fa-minus-square-o',
            ),
            604 => array(
                'css' => 'fa-plus-square',
            ),
            605 => array(
                'css' => 'fa-plus-square-o',
            ),
            606 => array(
                'css' => 'fa-square',
            ),
            607 => array(
                'css' => 'fa-square-o',
            ),
            608 => array(
                'css' => 'fa-cc-amex',
            ),
            609 => array(
                'css' => 'fa-cc-diners-club',
            ),
            610 => array(
                'css' => 'fa-cc-discover',
            ),
            611 => array(
                'css' => 'fa-cc-jcb',
            ),
            612 => array(
                'css' => 'fa-cc-mastercard',
            ),
            613 => array(
                'css' => 'fa-cc-paypal',
            ),
            614 => array(
                'css' => 'fa-cc-stripe',
            ),
            615 => array(
                'css' => 'fa-cc-visa',
            ),
            616 => array(
                'css' => 'fa-credit-card',
            ),
            617 => array(
                'css' => 'fa-credit-card-alt',
            ),
            618 => array(
                'css' => 'fa-google-wallet',
            ),
            619 => array(
                'css' => 'fa-paypal',
            ),
            620 => array(
                'css' => 'fa-area-chart',
            ),
            621 => array(
                'css' => 'fa-bar-chart',
            ),
            622 => array(
                'css' => 'fa-bar-chart-o',
            ),
            623 => array(
                'css' => 'fa-line-chart',
            ),
            624 => array(
                'css' => 'fa-pie-chart',
            ),
            625 => array(
                'css' => 'fa-bitcoin',
            ),
            626 => array(
                'css' => 'fa-btc',
            ),
            627 => array(
                'css' => 'fa-cny',
            ),
            628 => array(
                'css' => 'fa-dollar',
            ),
            629 => array(
                'css' => 'fa-eur',
            ),
            630 => array(
                'css' => 'fa-euro',
            ),
            631 => array(
                'css' => 'fa-gbp',
            ),
            632 => array(
                'css' => 'fa-gg',
            ),
            633 => array(
                'css' => 'fa-gg-circle',
            ),
            634 => array(
                'css' => 'fa-ils',
            ),
            635 => array(
                'css' => 'fa-inr',
            ),
            636 => array(
                'css' => 'fa-jpy',
            ),
            637 => array(
                'css' => 'fa-krw',
            ),
            638 => array(
                'css' => 'fa-money',
            ),
            639 => array(
                'css' => 'fa-rmb',
            ),
            640 => array(
                'css' => 'fa-rouble',
            ),
            641 => array(
                'css' => 'fa-rub',
            ),
            642 => array(
                'css' => 'fa-ruble',
            ),
            643 => array(
                'css' => 'fa-rupee',
            ),
            644 => array(
                'css' => 'fa-shekel',
            ),
            645 => array(
                'css' => 'fa-sheqel',
            ),
            646 => array(
                'css' => 'fa-try',
            ),
            647 => array(
                'css' => 'fa-turkish-lira',
            ),
            648 => array(
                'css' => 'fa-usd',
            ),
            649 => array(
                'css' => 'fa-won',
            ),
            650 => array(
                'css' => 'fa-yen',
            ),
            651 => array(
                'css' => 'fa-align-center',
            ),
            652 => array(
                'css' => 'fa-align-justify',
            ),
            653 => array(
                'css' => 'fa-align-left',
            ),
            654 => array(
                'css' => 'fa-align-right',
            ),
            655 => array(
                'css' => 'fa-bold',
            ),
            656 => array(
                'css' => 'fa-chain',
            ),
            657 => array(
                'css' => 'fa-chain-broken',
            ),
            658 => array(
                'css' => 'fa-clipboard',
            ),
            659 => array(
                'css' => 'fa-columns',
            ),
            660 => array(
                'css' => 'fa-copy',
            ),
            661 => array(
                'css' => 'fa-cut',
            ),
            662 => array(
                'css' => 'fa-dedent',
            ),
            663 => array(
                'css' => 'fa-eraser',
            ),
            664 => array(
                'css' => 'fa-file',
            ),
            665 => array(
                'css' => 'fa-file-o',
            ),
            666 => array(
                'css' => 'fa-file-text',
            ),
            667 => array(
                'css' => 'fa-file-text-o',
            ),
            668 => array(
                'css' => 'fa-files-o',
            ),
            669 => array(
                'css' => 'fa-floppy-o',
            ),
            670 => array(
                'css' => 'fa-font',
            ),
            671 => array(
                'css' => 'fa-header',
            ),
            672 => array(
                'css' => 'fa-indent',
            ),
            673 => array(
                'css' => 'fa-italic',
            ),
            674 => array(
                'css' => 'fa-link',
            ),
            675 => array(
                'css' => 'fa-list',
            ),
            676 => array(
                'css' => 'fa-list-alt',
            ),
            677 => array(
                'css' => 'fa-list-ol',
            ),
            678 => array(
                'css' => 'fa-list-ul',
            ),
            679 => array(
                'css' => 'fa-outdent',
            ),
            680 => array(
                'css' => 'fa-paperclip',
            ),
            681 => array(
                'css' => 'fa-paragraph',
            ),
            682 => array(
                'css' => 'fa-paste',
            ),
            683 => array(
                'css' => 'fa-repeat',
            ),
            684 => array(
                'css' => 'fa-rotate-left',
            ),
            685 => array(
                'css' => 'fa-rotate-right',
            ),
            686 => array(
                'css' => 'fa-save',
            ),
            687 => array(
                'css' => 'fa-scissors',
            ),
            688 => array(
                'css' => 'fa-strikethrough',
            ),
            689 => array(
                'css' => 'fa-subscript',
            ),
            690 => array(
                'css' => 'fa-superscript',
            ),
            691 => array(
                'css' => 'fa-table',
            ),
            692 => array(
                'css' => 'fa-text-height',
            ),
            693 => array(
                'css' => 'fa-text-width',
            ),
            694 => array(
                'css' => 'fa-th',
            ),
            695 => array(
                'css' => 'fa-th-large',
            ),
            696 => array(
                'css' => 'fa-th-list',
            ),
            697 => array(
                'css' => 'fa-underline',
            ),
            698 => array(
                'css' => 'fa-undo',
            ),
            699 => array(
                'css' => 'fa-unlink',
            ),
            700 => array(
                'css' => 'fa-angle-double-down',
            ),
            701 => array(
                'css' => 'fa-angle-double-left',
            ),
            702 => array(
                'css' => 'fa-angle-double-right',
            ),
            703 => array(
                'css' => 'fa-angle-double-up',
            ),
            704 => array(
                'css' => 'fa-angle-down',
            ),
            705 => array(
                'css' => 'fa-angle-left',
            ),
            706 => array(
                'css' => 'fa-angle-right',
            ),
            707 => array(
                'css' => 'fa-angle-up',
            ),
            708 => array(
                'css' => 'fa-arrow-circle-down',
            ),
            709 => array(
                'css' => 'fa-arrow-circle-left',
            ),
            710 => array(
                'css' => 'fa-arrow-circle-o-down',
            ),
            711 => array(
                'css' => 'fa-arrow-circle-o-left',
            ),
            712 => array(
                'css' => 'fa-arrow-circle-o-right',
            ),
            713 => array(
                'css' => 'fa-arrow-circle-o-up',
            ),
            714 => array(
                'css' => 'fa-arrow-circle-right',
            ),
            715 => array(
                'css' => 'fa-arrow-circle-up',
            ),
            716 => array(
                'css' => 'fa-arrow-down',
            ),
            717 => array(
                'css' => 'fa-arrow-left',
            ),
            718 => array(
                'css' => 'fa-arrow-right',
            ),
            719 => array(
                'css' => 'fa-arrow-up',
            ),
            720 => array(
                'css' => 'fa-arrows',
            ),
            721 => array(
                'css' => 'fa-arrows-alt',
            ),
            722 => array(
                'css' => 'fa-arrows-h',
            ),
            723 => array(
                'css' => 'fa-arrows-v',
            ),
            724 => array(
                'css' => 'fa-caret-down',
            ),
            725 => array(
                'css' => 'fa-caret-left',
            ),
            726 => array(
                'css' => 'fa-caret-right',
            ),
            727 => array(
                'css' => 'fa-caret-square-o-down',
            ),
            728 => array(
                'css' => 'fa-caret-square-o-left',
            ),
            729 => array(
                'css' => 'fa-caret-square-o-right',
            ),
            730 => array(
                'css' => 'fa-caret-square-o-up',
            ),
            731 => array(
                'css' => 'fa-caret-up',
            ),
            732 => array(
                'css' => 'fa-chevron-circle-down',
            ),
            733 => array(
                'css' => 'fa-chevron-circle-left',
            ),
            734 => array(
                'css' => 'fa-chevron-circle-right',
            ),
            735 => array(
                'css' => 'fa-chevron-circle-up',
            ),
            736 => array(
                'css' => 'fa-chevron-down',
            ),
            737 => array(
                'css' => 'fa-chevron-left',
            ),
            738 => array(
                'css' => 'fa-chevron-right',
            ),
            739 => array(
                'css' => 'fa-chevron-up',
            ),
            740 => array(
                'css' => 'fa-exchange',
            ),
            741 => array(
                'css' => 'fa-hand-o-down',
            ),
            742 => array(
                'css' => 'fa-hand-o-left',
            ),
            743 => array(
                'css' => 'fa-hand-o-right',
            ),
            744 => array(
                'css' => 'fa-hand-o-up',
            ),
            745 => array(
                'css' => 'fa-long-arrow-down',
            ),
            746 => array(
                'css' => 'fa-long-arrow-left',
            ),
            747 => array(
                'css' => 'fa-long-arrow-right',
            ),
            748 => array(
                'css' => 'fa-long-arrow-up',
            ),
            749 => array(
                'css' => 'fa-toggle-down',
            ),
            750 => array(
                'css' => 'fa-toggle-left',
            ),
            751 => array(
                'css' => 'fa-toggle-right',
            ),
            752 => array(
                'css' => 'fa-toggle-up',
            ),
            753 => array(
                'css' => 'fa-arrows-alt',
            ),
            754 => array(
                'css' => 'fa-backward',
            ),
            755 => array(
                'css' => 'fa-compress',
            ),
            756 => array(
                'css' => 'fa-eject',
            ),
            757 => array(
                'css' => 'fa-expand',
            ),
            758 => array(
                'css' => 'fa-fast-backward',
            ),
            759 => array(
                'css' => 'fa-fast-forward',
            ),
            760 => array(
                'css' => 'fa-forward',
            ),
            761 => array(
                'css' => 'fa-pause',
            ),
            762 => array(
                'css' => 'fa-pause-circle',
            ),
            763 => array(
                'css' => 'fa-pause-circle-o',
            ),
            764 => array(
                'css' => 'fa-play',
            ),
            765 => array(
                'css' => 'fa-play-circle',
            ),
            766 => array(
                'css' => 'fa-play-circle-o',
            ),
            767 => array(
                'css' => 'fa-random',
            ),
            768 => array(
                'css' => 'fa-step-backward',
            ),
            769 => array(
                'css' => 'fa-step-forward',
            ),
            770 => array(
                'css' => 'fa-stop',
            ),
            771 => array(
                'css' => 'fa-stop-circle',
            ),
            772 => array(
                'css' => 'fa-stop-circle-o',
            ),
            773 => array(
                'css' => 'fa-youtube-play',
            ),
            774 => array(
                'css' => 'fa-500px',
            ),
            775 => array(
                'css' => 'fa-adn',
            ),
            776 => array(
                'css' => 'fa-amazon',
            ),
            777 => array(
                'css' => 'fa-android',
            ),
            778 => array(
                'css' => 'fa-angellist',
            ),
            779 => array(
                'css' => 'fa-apple',
            ),
            780 => array(
                'css' => 'fa-bandcamp',
            ),
            781 => array(
                'css' => 'fa-behance',
            ),
            782 => array(
                'css' => 'fa-behance-square',
            ),
            783 => array(
                'css' => 'fa-bitbucket',
            ),
            784 => array(
                'css' => 'fa-bitbucket-square',
            ),
            785 => array(
                'css' => 'fa-bitcoin',
            ),
            786 => array(
                'css' => 'fa-black-tie',
            ),
            787 => array(
                'css' => 'fa-bluetooth',
            ),
            788 => array(
                'css' => 'fa-bluetooth-b',
            ),
            789 => array(
                'css' => 'fa-btc',
            ),
            790 => array(
                'css' => 'fa-buysellads',
            ),
            791 => array(
                'css' => 'fa-cc-amex',
            ),
            792 => array(
                'css' => 'fa-cc-diners-club',
            ),
            793 => array(
                'css' => 'fa-cc-discover',
            ),
            794 => array(
                'css' => 'fa-cc-jcb',
            ),
            795 => array(
                'css' => 'fa-cc-mastercard',
            ),
            796 => array(
                'css' => 'fa-cc-paypal',
            ),
            797 => array(
                'css' => 'fa-cc-stripe',
            ),
            798 => array(
                'css' => 'fa-cc-visa',
            ),
            799 => array(
                'css' => 'fa-chrome',
            ),
            800 => array(
                'css' => 'fa-codepen',
            ),
            801 => array(
                'css' => 'fa-codiepie',
            ),
            802 => array(
                'css' => 'fa-connectdevelop',
            ),
            803 => array(
                'css' => 'fa-contao',
            ),
            804 => array(
                'css' => 'fa-css3',
            ),
            805 => array(
                'css' => 'fa-dashcube',
            ),
            806 => array(
                'css' => 'fa-delicious',
            ),
            807 => array(
                'css' => 'fa-deviantart',
            ),
            808 => array(
                'css' => 'fa-digg',
            ),
            809 => array(
                'css' => 'fa-dribbble',
            ),
            810 => array(
                'css' => 'fa-dropbox',
            ),
            811 => array(
                'css' => 'fa-drupal',
            ),
            812 => array(
                'css' => 'fa-edge',
            ),
            813 => array(
                'css' => 'fa-eercast',
            ),
            814 => array(
                'css' => 'fa-empire',
            ),
            815 => array(
                'css' => 'fa-envira',
            ),
            816 => array(
                'css' => 'fa-etsy',
            ),
            817 => array(
                'css' => 'fa-expeditedssl',
            ),
            818 => array(
                'css' => 'fa-fa',
            ),
            819 => array(
                'css' => 'fa-facebook',
            ),
            820 => array(
                'css' => 'fa-facebook-f',
            ),
            821 => array(
                'css' => 'fa-facebook-official',
            ),
            822 => array(
                'css' => 'fa-facebook-square',
            ),
            823 => array(
                'css' => 'fa-firefox',
            ),
            824 => array(
                'css' => 'fa-first-order',
            ),
            825 => array(
                'css' => 'fa-flickr',
            ),
            826 => array(
                'css' => 'fa-font-awesome',
            ),
            827 => array(
                'css' => 'fa-fonticons',
            ),
            828 => array(
                'css' => 'fa-fort-awesome',
            ),
            829 => array(
                'css' => 'fa-forumbee',
            ),
            830 => array(
                'css' => 'fa-foursquare',
            ),
            831 => array(
                'css' => 'fa-free-code-camp',
            ),
            832 => array(
                'css' => 'fa-ge',
            ),
            833 => array(
                'css' => 'fa-get-pocket',
            ),
            834 => array(
                'css' => 'fa-gg',
            ),
            835 => array(
                'css' => 'fa-gg-circle',
            ),
            836 => array(
                'css' => 'fa-git',
            ),
            837 => array(
                'css' => 'fa-git-square',
            ),
            838 => array(
                'css' => 'fa-github',
            ),
            839 => array(
                'css' => 'fa-github-alt',
            ),
            840 => array(
                'css' => 'fa-github-square',
            ),
            841 => array(
                'css' => 'fa-gitlab',
            ),
            842 => array(
                'css' => 'fa-gittip',
            ),
            843 => array(
                'css' => 'fa-glide',
            ),
            844 => array(
                'css' => 'fa-glide-g',
            ),
            845 => array(
                'css' => 'fa-google',
            ),
            846 => array(
                'css' => 'fa-google-plus',
            ),
            847 => array(
                'css' => 'fa-google-plus-circle',
            ),
            848 => array(
                'css' => 'fa-google-plus-official',
            ),
            849 => array(
                'css' => 'fa-google-plus-square',
            ),
            850 => array(
                'css' => 'fa-google-wallet',
            ),
            851 => array(
                'css' => 'fa-gratipay',
            ),
            852 => array(
                'css' => 'fa-grav',
            ),
            853 => array(
                'css' => 'fa-hacker-news',
            ),
            854 => array(
                'css' => 'fa-houzz',
            ),
            855 => array(
                'css' => 'fa-html5',
            ),
            856 => array(
                'css' => 'fa-imdb',
            ),
            857 => array(
                'css' => 'fa-instagram',
            ),
            858 => array(
                'css' => 'fa-internet-explorer',
            ),
            859 => array(
                'css' => 'fa-ioxhost',
            ),
            860 => array(
                'css' => 'fa-joomla',
            ),
            861 => array(
                'css' => 'fa-jsfiddle',
            ),
            862 => array(
                'css' => 'fa-lastfm',
            ),
            863 => array(
                'css' => 'fa-lastfm-square',
            ),
            864 => array(
                'css' => 'fa-leanpub',
            ),
            865 => array(
                'css' => 'fa-linkedin',
            ),
            866 => array(
                'css' => 'fa-linkedin-square',
            ),
            867 => array(
                'css' => 'fa-linode',
            ),
            868 => array(
                'css' => 'fa-linux',
            ),
            869 => array(
                'css' => 'fa-maxcdn',
            ),
            870 => array(
                'css' => 'fa-meanpath',
            ),
            871 => array(
                'css' => 'fa-medium',
            ),
            872 => array(
                'css' => 'fa-meetup',
            ),
            873 => array(
                'css' => 'fa-mixcloud',
            ),
            874 => array(
                'css' => 'fa-modx',
            ),
            875 => array(
                'css' => 'fa-odnoklassniki',
            ),
            876 => array(
                'css' => 'fa-odnoklassniki-square',
            ),
            877 => array(
                'css' => 'fa-opencart',
            ),
            878 => array(
                'css' => 'fa-openid',
            ),
            879 => array(
                'css' => 'fa-opera',
            ),
            880 => array(
                'css' => 'fa-optin-monster',
            ),
            881 => array(
                'css' => 'fa-pagelines',
            ),
            882 => array(
                'css' => 'fa-paypal',
            ),
            883 => array(
                'css' => 'fa-pied-piper',
            ),
            884 => array(
                'css' => 'fa-pied-piper-alt',
            ),
            885 => array(
                'css' => 'fa-pied-piper-pp',
            ),
            886 => array(
                'css' => 'fa-pinterest',
            ),
            887 => array(
                'css' => 'fa-pinterest-p',
            ),
            888 => array(
                'css' => 'fa-pinterest-square',
            ),
            889 => array(
                'css' => 'fa-product-hunt',
            ),
            890 => array(
                'css' => 'fa-qq',
            ),
            891 => array(
                'css' => 'fa-quora',
            ),
            892 => array(
                'css' => 'fa-ra',
            ),
            893 => array(
                'css' => 'fa-ravelry',
            ),
            894 => array(
                'css' => 'fa-rebel',
            ),
            895 => array(
                'css' => 'fa-reddit',
            ),
            896 => array(
                'css' => 'fa-reddit-alien',
            ),
            897 => array(
                'css' => 'fa-reddit-square',
            ),
            898 => array(
                'css' => 'fa-renren',
            ),
            899 => array(
                'css' => 'fa-resistance',
            ),
            900 => array(
                'css' => 'fa-safari',
            ),
            901 => array(
                'css' => 'fa-scribd',
            ),
            902 => array(
                'css' => 'fa-sellsy',
            ),
            903 => array(
                'css' => 'fa-share-alt',
            ),
            904 => array(
                'css' => 'fa-share-alt-square',
            ),
            905 => array(
                'css' => 'fa-shirtsinbulk',
            ),
            906 => array(
                'css' => 'fa-simplybuilt',
            ),
            907 => array(
                'css' => 'fa-skyatlas',
            ),
            908 => array(
                'css' => 'fa-skype',
            ),
            909 => array(
                'css' => 'fa-slack',
            ),
            910 => array(
                'css' => 'fa-slideshare',
            ),
            911 => array(
                'css' => 'fa-snapchat',
            ),
            912 => array(
                'css' => 'fa-snapchat-ghost',
            ),
            913 => array(
                'css' => 'fa-snapchat-square',
            ),
            914 => array(
                'css' => 'fa-soundcloud',
            ),
            915 => array(
                'css' => 'fa-spotify',
            ),
            916 => array(
                'css' => 'fa-stack-exchange',
            ),
            917 => array(
                'css' => 'fa-stack-overflow',
            ),
            918 => array(
                'css' => 'fa-steam',
            ),
            919 => array(
                'css' => 'fa-steam-square',
            ),
            920 => array(
                'css' => 'fa-stumbleupon',
            ),
            921 => array(
                'css' => 'fa-stumbleupon-circle',
            ),
            922 => array(
                'css' => 'fa-superpowers',
            ),
            923 => array(
                'css' => 'fa-telegram',
            ),
            924 => array(
                'css' => 'fa-tencent-weibo',
            ),
            925 => array(
                'css' => 'fa-themeisle',
            ),
            926 => array(
                'css' => 'fa-trello',
            ),
            927 => array(
                'css' => 'fa-tripadvisor',
            ),
            928 => array(
                'css' => 'fa-tumblr',
            ),
            929 => array(
                'css' => 'fa-tumblr-square',
            ),
            930 => array(
                'css' => 'fa-twitch',
            ),
            931 => array(
                'css' => 'fa-twitter',
            ),
            932 => array(
                'css' => 'fa-twitter-square',
            ),
            933 => array(
                'css' => 'fa-usb',
            ),
            934 => array(
                'css' => 'fa-viacoin',
            ),
            935 => array(
                'css' => 'fa-viadeo',
            ),
            936 => array(
                'css' => 'fa-viadeo-square',
            ),
            937 => array(
                'css' => 'fa-vimeo',
            ),
            938 => array(
                'css' => 'fa-vimeo-square',
            ),
            939 => array(
                'css' => 'fa-vine',
            ),
            940 => array(
                'css' => 'fa-vk',
            ),
            941 => array(
                'css' => 'fa-wechat',
            ),
            942 => array(
                'css' => 'fa-weibo',
            ),
            943 => array(
                'css' => 'fa-weixin',
            ),
            944 => array(
                'css' => 'fa-whatsapp',
            ),
            945 => array(
                'css' => 'fa-wikipedia-w',
            ),
            946 => array(
                'css' => 'fa-windows',
            ),
            947 => array(
                'css' => 'fa-wordpress',
            ),
            948 => array(
                'css' => 'fa-wpbeginner',
            ),
            949 => array(
                'css' => 'fa-wpexplorer',
            ),
            950 => array(
                'css' => 'fa-wpforms',
            ),
            951 => array(
                'css' => 'fa-xing',
            ),
            952 => array(
                'css' => 'fa-xing-square',
            ),
            953 => array(
                'css' => 'fa-y-combinator',
            ),
            954 => array(
                'css' => 'fa-y-combinator-square',
            ),
            955 => array(
                'css' => 'fa-yahoo',
            ),
            956 => array(
                'css' => 'fa-yc',
            ),
            957 => array(
                'css' => 'fa-yc-square',
            ),
            958 => array(
                'css' => 'fa-yelp',
            ),
            959 => array(
                'css' => 'fa-yoast',
            ),
            960 => array(
                'css' => 'fa-youtube',
            ),
            961 => array(
                'css' => 'fa-youtube-play',
            ),
            962 => array(
                'css' => 'fa-youtube-square',
            ),
            963 => array(
                'css' => 'fa-ambulance',
            ),
            964 => array(
                'css' => 'fa-h-square',
            ),
            965 => array(
                'css' => 'fa-heart',
            ),
            966 => array(
                'css' => 'fa-heart-o',
            ),
            967 => array(
                'css' => 'fa-heartbeat',
            ),
            968 => array(
                'css' => 'fa-hospital-o',
            ),
            969 => array(
                'css' => 'fa-medkit',
            ),
            970 => array(
                'css' => 'fa-plus-square',
            ),
            971 => array(
                'css' => 'fa-stethoscope',
            ),
            972 => array(
                'css' => 'fa-user-md',
            ),
            973 => array(
                'css' => 'fa-wheelchair',
            ),
            974 => array(
                'css' => 'fa-wheelchair-alt',
            ),
        ),
    );

    return $fontawesome;

}