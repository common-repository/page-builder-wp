<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Various CSS Data for PBWPCss
 *
 * This file is part of PBWPCss.
 *
 * PBWPCss is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * PBWPCss is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PBWPCss; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package pbwpcss
 * @author Florian Schmitz (floele at gmail dot com) 2005
 * @author Nikolay Matsievsky (speed at webo dot name) 2010
 */

/**
 * All whitespace allowed in CSS
 *
 * @global array $data['pbwpcss']['whitespace']
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'whitespace' ] = [ ' ', "\n", "\t", "\r", "\x0B" ];

/**
 * All CSS tokens used by pbwpcss
 *
 * @global string $data['pbwpcss']['tokens']
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'tokens' ] = '/@}{;:=\'"(,\\!$%&)*+.<>?[]^`|~';

/**
 * All CSS units (CSS 3 units included)
 *
 * @see compress_numbers()
 * @global array $data['pbwpcss']['units']
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'units' ] = [ 'in', 'cm', 'mm', 'pt', 'pc', 'px', 'rem', 'em', '%', 'ex', 'gd', 'vw', 'vh', 'vm', 'deg', 'grad', 'rad', 'turn', 'ms', 's', 'khz', 'hz', 'ch', 'vmin', 'vmax', 'dpi', 'dpcm', 'dppx' ];

/**
 * Available at-rules
 *
 * @global array $data['pbwpcss']['at_rules']
 * @version 1.1
 */
$data[ 'pbwpcss' ][ 'at_rules' ] = [ 'page' => 'is', 'font-face' => 'atis', 'charset' => 'iv', 'import' => 'iv', 'namespace' => 'iv', 'media' => 'at', 'supports' => 'at', 'keyframes' => 'at', '-moz-keyframes' => 'at', '-o-keyframes' => 'at', '-webkit-keyframes' => 'at', '-ms-keyframes' => 'at' ];

/**
 * Properties that need a value with unit
 *
 * @todo CSS3 properties
 * @see compress_numbers();
 * @global array $data['pbwpcss']['unit_values']
 * @version 1.2
 */
$data[ 'pbwpcss' ][ 'unit_values' ] = [ 'background', 'background-position', 'background-size', 'border', 'border-top', 'border-right', 'border-bottom', 'border-left', 'border-width',
    'border-top-width', 'border-right-width', 'border-left-width', 'border-bottom-width', 'bottom', 'border-spacing', 'column-gap', 'column-width',
    'font-size', 'height', 'left', 'margin', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left', 'max-height',
    'max-width', 'min-height', 'min-width', 'outline', 'outline-width', 'padding', 'padding-top', 'padding-right',
    'padding-bottom', 'padding-left', 'perspective', 'right', 'top', 'text-indent', 'letter-spacing', 'word-spacing', 'width' ];

/**
 * Properties that allow <color> as value
 *
 * @todo CSS3 properties
 * @see compress_numbers();
 * @global array $data['pbwpcss']['color_values']
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'color_values' ]     = [];
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'background-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'border-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'border-top-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'border-right-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'border-bottom-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'border-left-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'outline-color';
$data[ 'pbwpcss' ][ 'color_values' ][  ] = 'column-rule-color';

/**
 * Default values for the background properties
 *
 * @todo Possibly property names will change during CSS3 development
 * @global array $data['pbwpcss']['background_prop_default']
 * @see dissolve_short_bg()
 * @see merge_bg()
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'background_prop_default' ]                            = [];
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-image' ]      = 'none';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-size' ]       = 'auto';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-repeat' ]     = 'repeat';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-position' ]   = '0 0';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-attachment' ] = 'scroll';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-clip' ]       = 'border';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-origin' ]     = 'padding';
$data[ 'pbwpcss' ][ 'background_prop_default' ][ 'background-color' ]      = 'transparent';

/**
 * Default values for the font properties
 *
 * @global array $data['pbwpcss']['font_prop_default']
 * @see merge_fonts()
 * @version 1.3
 */
$data[ 'pbwpcss' ][ 'font_prop_default' ]                   = [];
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'font-style' ]   = 'normal';
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'font-variant' ] = 'normal';
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'font-weight' ]  = 'normal';
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'font-size' ]    = '';
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'line-height' ]  = '';
$data[ 'pbwpcss' ][ 'font_prop_default' ][ 'font-family' ]  = '';

/**
 * A list of non-W3C color names which get replaced by their hex-codes
 *
 * @global array $data['pbwpcss']['replace_colors']
 * @see cut_color()
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'replace_colors' ]                           = [];
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'aliceblue' ]            = '#f0f8ff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'antiquewhite' ]         = '#faebd7';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'aquamarine' ]           = '#7fffd4';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'azure' ]                = '#f0ffff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'beige' ]                = '#f5f5dc';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'bisque' ]               = '#ffe4c4';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'blanchedalmond' ]       = '#ffebcd';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'blueviolet' ]           = '#8a2be2';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'brown' ]                = '#a52a2a';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'burlywood' ]            = '#deb887';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'cadetblue' ]            = '#5f9ea0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'chartreuse' ]           = '#7fff00';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'chocolate' ]            = '#d2691e';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'coral' ]                = '#ff7f50';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'cornflowerblue' ]       = '#6495ed';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'cornsilk' ]             = '#fff8dc';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'crimson' ]              = '#dc143c';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'cyan' ]                 = '#00ffff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkblue' ]             = '#00008b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkcyan' ]             = '#008b8b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkgoldenrod' ]        = '#b8860b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkgray' ]             = '#a9a9a9';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkgreen' ]            = '#006400';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkkhaki' ]            = '#bdb76b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkmagenta' ]          = '#8b008b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkolivegreen' ]       = '#556b2f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkorange' ]           = '#ff8c00';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkorchid' ]           = '#9932cc';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkred' ]              = '#8b0000';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darksalmon' ]           = '#e9967a';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkseagreen' ]         = '#8fbc8f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkslateblue' ]        = '#483d8b';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkslategray' ]        = '#2f4f4f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkturquoise' ]        = '#00ced1';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'darkviolet' ]           = '#9400d3';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'deeppink' ]             = '#ff1493';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'deepskyblue' ]          = '#00bfff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'dimgray' ]              = '#696969';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'dodgerblue' ]           = '#1e90ff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'feldspar' ]             = '#d19275';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'firebrick' ]            = '#b22222';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'floralwhite' ]          = '#fffaf0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'forestgreen' ]          = '#228b22';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'gainsboro' ]            = '#dcdcdc';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'ghostwhite' ]           = '#f8f8ff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'gold' ]                 = '#ffd700';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'goldenrod' ]            = '#daa520';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'greenyellow' ]          = '#adff2f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'honeydew' ]             = '#f0fff0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'hotpink' ]              = '#ff69b4';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'indianred' ]            = '#cd5c5c';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'indigo' ]               = '#4b0082';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'ivory' ]                = '#fffff0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'khaki' ]                = '#f0e68c';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lavender' ]             = '#e6e6fa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lavenderblush' ]        = '#fff0f5';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lawngreen' ]            = '#7cfc00';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lemonchiffon' ]         = '#fffacd';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightblue' ]            = '#add8e6';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightcoral' ]           = '#f08080';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightcyan' ]            = '#e0ffff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightgoldenrodyellow' ] = '#fafad2';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightgrey' ]            = '#d3d3d3';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightgreen' ]           = '#90ee90';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightpink' ]            = '#ffb6c1';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightsalmon' ]          = '#ffa07a';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightseagreen' ]        = '#20b2aa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightskyblue' ]         = '#87cefa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightslateblue' ]       = '#8470ff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightslategray' ]       = '#778899';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightsteelblue' ]       = '#b0c4de';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'lightyellow' ]          = '#ffffe0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'limegreen' ]            = '#32cd32';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'linen' ]                = '#faf0e6';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'magenta' ]              = '#ff00ff';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumaquamarine' ]     = '#66cdaa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumblue' ]           = '#0000cd';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumorchid' ]         = '#ba55d3';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumpurple' ]         = '#9370d8';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumseagreen' ]       = '#3cb371';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumslateblue' ]      = '#7b68ee';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumspringgreen' ]    = '#00fa9a';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumturquoise' ]      = '#48d1cc';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mediumvioletred' ]      = '#c71585';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'midnightblue' ]         = '#191970';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mintcream' ]            = '#f5fffa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'mistyrose' ]            = '#ffe4e1';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'moccasin' ]             = '#ffe4b5';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'navajowhite' ]          = '#ffdead';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'oldlace' ]              = '#fdf5e6';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'olivedrab' ]            = '#6b8e23';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'orangered' ]            = '#ff4500';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'orchid' ]               = '#da70d6';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'palegoldenrod' ]        = '#eee8aa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'palegreen' ]            = '#98fb98';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'paleturquoise' ]        = '#afeeee';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'palevioletred' ]        = '#d87093';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'papayawhip' ]           = '#ffefd5';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'peachpuff' ]            = '#ffdab9';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'peru' ]                 = '#cd853f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'pink' ]                 = '#ffc0cb';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'plum' ]                 = '#dda0dd';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'powderblue' ]           = '#b0e0e6';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'rosybrown' ]            = '#bc8f8f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'royalblue' ]            = '#4169e1';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'saddlebrown' ]          = '#8b4513';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'salmon' ]               = '#fa8072';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'sandybrown' ]           = '#f4a460';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'seagreen' ]             = '#2e8b57';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'seashell' ]             = '#fff5ee';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'sienna' ]               = '#a0522d';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'skyblue' ]              = '#87ceeb';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'slateblue' ]            = '#6a5acd';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'slategray' ]            = '#708090';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'snow' ]                 = '#fffafa';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'springgreen' ]          = '#00ff7f';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'steelblue' ]            = '#4682b4';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'tan' ]                  = '#d2b48c';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'thistle' ]              = '#d8bfd8';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'tomato' ]               = '#ff6347';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'turquoise' ]            = '#40e0d0';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'violet' ]               = '#ee82ee';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'violetred' ]            = '#d02090';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'wheat' ]                = '#f5deb3';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'whitesmoke' ]           = '#f5f5f5';
$data[ 'pbwpcss' ][ 'replace_colors' ][ 'yellowgreen' ]          = '#9acd32';

/**
 * A list of all shorthand properties that are devided into four properties and/or have four subvalues
 *
 * @global array $data['pbwpcss']['shorthands']
 * @todo Are there new ones in CSS3?
 * @see dissolve_4value_shorthands()
 * @see merge_4value_shorthands()
 * @version 1.0
 */
$data[ 'pbwpcss' ][ 'shorthands' ]                   = [];
$data[ 'pbwpcss' ][ 'shorthands' ][ 'border-color' ] = [ 'border-top-color', 'border-right-color', 'border-bottom-color', 'border-left-color' ];
$data[ 'pbwpcss' ][ 'shorthands' ][ 'border-style' ] = [ 'border-top-style', 'border-right-style', 'border-bottom-style', 'border-left-style' ];
$data[ 'pbwpcss' ][ 'shorthands' ][ 'border-width' ] = [ 'border-top-width', 'border-right-width', 'border-bottom-width', 'border-left-width' ];
$data[ 'pbwpcss' ][ 'shorthands' ][ 'margin' ]       = [ 'margin-top', 'margin-right', 'margin-bottom', 'margin-left' ];
$data[ 'pbwpcss' ][ 'shorthands' ][ 'padding' ]      = [ 'padding-top', 'padding-right', 'padding-bottom', 'padding-left' ];

$data[ 'pbwpcss' ][ 'radius_shorthands' ][ 'border-radius' ]         = [ 'border-top-left-radius', 'border-top-right-radius', 'border-bottom-right-radius', 'border-bottom-left-radius' ];
$data[ 'pbwpcss' ][ 'radius_shorthands' ][ '-webkit-border-radius' ] = [ '-webkit-border-top-left-radius', '-webkit-border-top-right-radius', '-webkit-border-bottom-right-radius', '-webkit-border-bottom-left-radius' ];
$data[ 'pbwpcss' ][ 'radius_shorthands' ][ '-moz-border-radius' ]    = [ '-moz-border-radius-topleft', '-moz-border-radius-topright', '-moz-border-radius-bottomright', '-moz-border-radius-bottomleft' ];

/**
 * All CSS Properties. Needed for pbwpcss::property_is_next()
 *
 * @global array $data['pbwpcss']['all_properties']
 * @version 1.1
 * @see pbwpcss::property_is_next()
 */
$data[ 'pbwpcss' ][ 'all_properties' ][ 'alignment-adjust' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'alignment-baseline' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-delay' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-direction' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-duration' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-iteration-count' ]  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-name' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-play-state' ]       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'animation-timing-function' ]  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'appearance' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'azimuth' ]                    = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'backface-visibility' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-attachment' ]      = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-clip' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-color' ]           = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-image' ]           = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-origin' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-position' ]        = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-repeat' ]          = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'background-size' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'baseline-shift' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'binding' ]                    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bleed' ]                      = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bookmark-label' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bookmark-level' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bookmark-state' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bookmark-target' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border' ]                     = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom' ]              = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom-color' ]        = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom-left-radius' ]  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom-right-radius' ] = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom-style' ]        = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-bottom-width' ]        = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-collapse' ]            = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-color' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image-outset' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image-repeat' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image-slice' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image-source' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-image-width' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-left' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-left-color' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-left-style' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-left-width' ]          = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-radius' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-right' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-right-color' ]         = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-right-style' ]         = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-right-width' ]         = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-spacing' ]             = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-style' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top-color' ]           = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top-left-radius' ]     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top-right-radius' ]    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top-style' ]           = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-top-width' ]           = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'border-width' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'bottom' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'box-decoration-break' ]       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'box-shadow' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'box-sizing' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'break-after' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'break-before' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'break-inside' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'caption-side' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'clear' ]                      = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'clip' ]                       = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'color' ]                      = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'color-profile' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-count' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-fill' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-gap' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-rule' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-rule-color' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-rule-style' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-rule-width' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-span' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'column-width' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'columns' ]                    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'content' ]                    = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'counter-increment' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'counter-reset' ]              = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'crop' ]                       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'cue' ]                        = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'cue-after' ]                  = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'cue-before' ]                 = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'cursor' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'direction' ]                  = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'display' ]                    = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'dominant-baseline' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-after-adjust' ]  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-after-align' ]   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-before-adjust' ] = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-before-align' ]  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-size' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'drop-initial-value' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'elevation' ]                  = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'empty-cells' ]                = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'fit' ]                        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'fit-position' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'flex-align' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'flex-flow' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'flex-line-pack' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'flex-order' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'flex-pack' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'float' ]                      = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'float-offset' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font' ]                       = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-family' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-size' ]                  = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-size-adjust' ]           = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-stretch' ]               = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-style' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-variant' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'font-weight' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'grid-columns' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'grid-rows' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hanging-punctuation' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'height' ]                     = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphenate-after' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphenate-before' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphenate-character' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphenate-lines' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphenate-resource' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'hyphens' ]                    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'icon' ]                       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'image-orientation' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'image-rendering' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'image-resolution' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'inline-box-align' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'left' ]                       = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'letter-spacing' ]             = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-break' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-height' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-stacking' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-stacking-ruby' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-stacking-shift' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'line-stacking-strategy' ]     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'list-style' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'list-style-image' ]           = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'list-style-position' ]        = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'list-style-type' ]            = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'margin' ]                     = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'margin-bottom' ]              = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'margin-left' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'margin-right' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'margin-top' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marker-offset' ]              = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marks' ]                      = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marquee-direction' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marquee-loop' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marquee-play-count' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marquee-speed' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'marquee-style' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'max-height' ]                 = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'max-width' ]                  = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'min-height' ]                 = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'min-width' ]                  = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'move-to' ]                    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'nav-down' ]                   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'nav-index' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'nav-left' ]                   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'nav-right' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'nav-up' ]                     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'opacity' ]                    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'orphans' ]                    = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'outline' ]                    = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'outline-color' ]              = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'outline-offset' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'outline-style' ]              = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'outline-width' ]              = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'overflow' ]                   = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'overflow-style' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'overflow-wrap' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'overflow-x' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'overflow-y' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'padding' ]                    = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'padding-bottom' ]             = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'padding-left' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'padding-right' ]              = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'padding-top' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'page' ]                       = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'page-break-after' ]           = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'page-break-before' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'page-break-inside' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'page-policy' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'pause' ]                      = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'pause-after' ]                = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'pause-before' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'perspective' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'perspective-origin' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'phonemes' ]                   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'pitch' ]                      = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'pitch-range' ]                = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'play-during' ]                = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'position' ]                   = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'presentation-level' ]         = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'punctuation-trim' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'quotes' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rendering-intent' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'resize' ]                     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rest' ]                       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rest-after' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rest-before' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'richness' ]                   = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'right' ]                      = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rotation' ]                   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'rotation-point' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'ruby-align' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'ruby-overhang' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'ruby-position' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'ruby-span' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'size' ]                       = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'speak' ]                      = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'speak-header' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'speak-numeral' ]              = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'speak-punctuation' ]          = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'speech-rate' ]                = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'src' ]                        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'stress' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'string-set' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'tab-size' ]                   = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'table-layout' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'target' ]                     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'target-name' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'target-new' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'target-position' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-align' ]                 = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-align-last' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-decoration' ]            = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-decoration-color' ]      = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-decoration-line' ]       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-decoration-skip' ]       = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-decoration-style' ]      = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-emphasis' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-emphasis-color' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-emphasis-position' ]     = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-emphasis-style' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-height' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-indent' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-justify' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-outline' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-shadow' ]                = 'CSS2.0,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-space-collapse' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-transform' ]             = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-underline-position' ]    = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'text-wrap' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'top' ]                        = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transform' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transform-origin' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transform-style' ]            = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transition' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transition-delay' ]           = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transition-duration' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transition-property' ]        = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'transition-timing-function' ] = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'unicode-bidi' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'vertical-align' ]             = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'visibility' ]                 = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-balance' ]              = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-duration' ]             = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-family' ]               = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-pitch' ]                = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-pitch-range' ]          = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-rate' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-stress' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'voice-volume' ]               = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'volume' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'white-space' ]                = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'widows' ]                     = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'width' ]                      = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'word-break' ]                 = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'word-spacing' ]               = 'CSS1.0,CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'word-wrap' ]                  = 'CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ 'z-index' ]                    = 'CSS2.0,CSS2.1,CSS3.0';
$data[ 'pbwpcss' ][ 'all_properties' ][ '--custom' ]                   = 'CSS3.0';

/**
 * An array containing all properties that can accept a quoted string as a value.
 *
 * @global array $data['pbwpcss']['quoted_string_properties']
 */
$data[ 'pbwpcss' ][ 'quoted_string_properties' ] = [ 'content', 'font-family', 'quotes' ];

/**
 * An array containing all properties that can be defined multiple times without being overwritten.
 *
 * @global array $data['pbwpcss']['quoted_string_properties']
 */
$data[ 'pbwpcss' ][ 'multiple_properties' ] = [ 'background', 'background-image' ];

/**
 * An array containing all predefined templates.
 *
 * @global array $data['pbwpcss']['predefined_templates']
 * @version 1.0
 * @see pbwpcss::load_template()
 */
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 0 ]  = '<span class="at">';                             //string before @rule
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 1 ]  = '</span> <span class="format">{</span>'."\n";  //bracket after @-rule
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 2 ]  = '<span class="selector">';                       //string before selector
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 3 ]  = '</span> <span class="format">{</span>'."\n";  //bracket after selector
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 4 ]  = '<span class="property">';                       //string before property
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 5 ]  = '</span><span class="value">';                   //string after property+before value
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 6 ]  = '</span><span class="format">;</span>'."\n";   //string after value
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 7 ]  = '<span class="format">}</span>';                 //closing bracket - selector
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 8 ]  = "\n\n";                                          //space between blocks {...}
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 9 ]  = "\n".'<span class="format">}</span>'."\n\n"; //closing bracket @-rule
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 10 ] = '';                                              //indent in @-rule
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 11 ] = '<span class="comment">';                        // before comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 12 ] = '</span>'."\n";                                // after comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'default' ][ 13 ] = "\n";                                            // after each line @-rule

$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '<span class="at">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '</span> <span class="format">{</span>'."\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '<span class="selector">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '</span><span class="format">{</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '<span class="property">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '</span><span class="value">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '</span><span class="format">;</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '<span class="format">}</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = "\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = "\n".'<span class="format">}'."\n".'</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '<span class="comment">'; // before comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = '</span>'."\n";         // after comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'high_compression' ][  ] = "\n";

$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="at">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '</span><span class="format">{</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="selector">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '</span><span class="format">{</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="property">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '</span><span class="value">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '</span><span class="format">;</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="format">}</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="format">}</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '<span class="comment">'; // before comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '</span>';                // after comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'highest_compression' ][  ] = '';

$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '<span class="at">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '</span> <span class="format">{</span>'."\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '<span class="selector">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '</span>'."\n".'<span class="format">{</span>'."\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '	<span class="property">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '</span><span class="value">';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '</span><span class="format">;</span>'."\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '<span class="format">}</span>';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = "\n\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = "\n".'<span class="format">}</span>'."\n\n";
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '	';
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '<span class="comment">'; // before comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = '</span>'."\n";         // after comment
$data[ 'pbwpcss' ][ 'predefined_templates' ][ 'low_compression' ][  ] = "\n";
