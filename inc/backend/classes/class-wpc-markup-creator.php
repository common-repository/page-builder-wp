<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Markup_Creator
{

    /**
     * Generate Post/Page List
     * @return html markup
     * @access public
     */
    public function postList()
    {

        ob_start();?>

<div class="wpc-builder-selector">
    <span
        class="description customize-control-description"><?php esc_html_e( 'Select Post types', 'page-builder-wp' );?></span>
    <select data-placeholder="<?php esc_attr_e( 'Choose Post Type', 'page-builder-wp' );?>..."
        class="wpc-field-select-ajax wpc-post-type">
        <option selected="selected" value="none"><?php esc_html_e( '&mdash; Select &mdash;', 'page-builder-wp' );?>
        </option>
        <?php

        $postTypes = pbwp_get_supported_post_types();

        foreach ( $postTypes as $post_type ) {

            if ( ! isset( wp_count_posts( $post_type )->publish ) ) {
                continue;
            }

            $total_posts = wp_count_posts( $post_type )->publish;
            echo '<option class="posttype_'.esc_attr( $post_type ).'" data-total_post="'.esc_attr( $total_posts ).'" value="'.esc_attr( $post_type ).'" '.selected( $post_type, 'none' ).'>'.esc_html( $post_type ).'</option>';
        }

        ?>
    </select>

    <?php

        foreach ( $postTypes as $each ) {

            echo '<div class="wpc-builder-all-post-list hidden-post wpc-post-type-'.esc_attr( $each ).'">';
            echo '<span class="description customize-control-description">'.esc_html__( 'Create Builder For:', 'page-builder-wp' ).'</span>';
            echo '<select data-placeholder="'.esc_html__( 'Select', 'page-builder-wp' ).'" class="wpc-field-select-ajax wpc_post_ajax_loader wpc_loader_posttype'.esc_attr( $each ).'">';
            echo '<option selected="selected" value="none">'.esc_html__( '&mdash; Select &mdash;', 'page-builder-wp' ).'</option>';
            echo '</select>';
            echo '</div>';

        }

        echo '<div class="edit-builder">'.esc_html__( 'Edit with WP Composer', 'page-builder-wp' ).'</div>';
        echo '</div>';

        $post_list = ob_get_clean();

        echo wp_kses( $post_list, pbwp_wp_kses_allowed_html() );

    }

    /**
     * Generate Content Editor Block
     * @return html markup
     * arg ( unique ID )
     * @access public
     */
    public function editorBlock( $data )
    {

        $decodedData = base64_decode( $data );
        $decodedData = json_decode( $decodedData, true );
        $builderData = ( isset( $decodedData[ 'builder' ] ) ? $decodedData[ 'builder' ] : [  ] );
        $globalData  = ( isset( $decodedData[ 'global' ] ) ? $decodedData[ 'global' ] : [  ] );
        $isBlankRow  = ( isset( $builderData ) && is_array( $builderData ) && empty( $builderData ) ? true : false );

        if ( ! is_array( $builderData ) ) {
            return;
        }

        ob_start();

        echo '<div class="wpc-section">';

        foreach ( $builderData as $k => $rows ) {

            $cols       = count( $rows[ 'row_cols' ] );
            $colMode    = ( isset( $rows[ 'col_mode' ] ) ? $rows[ 'col_mode' ] : '1-1' );
            $isRowInner = ( isset( $rows[ 'inner_of' ] ) && $rows[ 'inner_of' ] != '' ? $rows[ 'inner_of' ] : '' );
            $colFormat  = explode( '_', $colMode );

            if ( isset( $globalData[ 'config' ][ 'global_save_expcoll' ] ) && $globalData[ 'config' ][ 'global_save_expcoll' ] == 'yes' ) {
                $isCollExp = 'save';

                if ( isset( $rows[ 'config' ][ 'expcoll' ] ) && $rows[ 'config' ][ 'expcoll' ] == 'collapsed' ) {
                    $collapsed    = 'collapsed';
                    $collapsedCSS = 'display: none;';
                } else {
                    $collapsed    = 'nocollapsed';
                    $collapsedCSS = 'display: inline-block;';
                }

            } else {
                $isCollExp    = 'no';
                $collapsed    = 'nocollapsed';
                $collapsedCSS = 'display: inline-block;';
            }

            if ( ! is_array( $rows[ 'row_cols' ] ) || ! is_numeric( $cols ) || $cols <= 0 ) {
                return $this->addMarkup( 'emptycol' );
            }

            $txt     = '';
            $t_class = '';

            echo '<div id="'.esc_attr( $rows[ 'id' ] ).'" data-save_coll_exp="'.esc_attr( $isCollExp ).'" class="wpc-row'.( $isRowInner != '' ? ' wpc-inner-row' : '' ).' '.esc_attr( $collapsed ).' wpc_node_row"'.( $isRowInner != '' ? ' data-inner_of="'.esc_attr( $isRowInner ).'"' : '' ).'>';

            foreach ( array_values( $rows[ 'row_cols' ] ) as $key => $val ) {
                // Set the column size
                $colSize = explode( '-', ( isset( $colFormat[ $key ] ) ? $colFormat[ $key ] : '1-1' ) );
                $colSize = ( isset( $colSize[ 0 ] ) ? (int) $colSize[ 0 ] : 1 ) / ( isset( $colSize[ 1 ] ) ? (int) $colSize[ 1 ] : 1 );
                $colSize = $colSize > 0 ? $colSize * 100 : 100;
                $col_css = 'max-width: '.esc_attr( $colSize ).'%;';

                if ( isset( $val[ 'config' ][ 'col_is_block' ] ) && $val[ 'config' ][ 'col_is_block' ] == 'yes' ) {
                    $col_css = 'max-width: 100%; display: block;';
                }

                echo '<div data-col-num="'.esc_attr( $colSize ).'" data-col-cell="'.esc_attr( isset( $colFormat[ $key ] ) ? $colFormat[ $key ] : '1-1' ).'" id="'.esc_attr( $val[ 'id' ] ).'" class="wpc-column wpc_node_column" style="'.esc_attr( $col_css ).'">';
                echo '<div class="col-prop"><span data-action="add" class="add-item mtips"><span class="mt-mes">'.esc_html__( 'Add Item', 'page-builder-wp' ).'</span></span><span data-action="edit" class="edit-col mtips"><span class="mt-mes">'.esc_html__( 'Edit this column', 'page-builder-wp' ).'</span></span><span data-action="remove" class="delete-col mtips"><span class="mt-mes">'.esc_html__( 'Remove this column', 'page-builder-wp' ).'</span></span></div>';
                echo '<span class="col-width-info">'.esc_html( round( $colSize ) ).'%</span>';
                echo '<div style="'.esc_attr( $collapsedCSS ).'" class="col-inner">';

                if ( isset( $val[ 'items' ] ) && ! empty( $val[ 'items' ] ) ) {

                    $txt     = esc_html__( 'Add More Item', 'page-builder-wp' );
                    $t_class = 'has_items';

                    foreach ( $val[ 'items' ] as $vl ) {

                        if ( ! isset( $vl[ 'type' ] ) ) {
                            continue;
                        }

                        $theTabs        = null;
                        $theTabsContent = null;

                        if ( isset( $vl[ 'tabs' ] ) || isset( $vl[ 'accordions' ] ) ) {

                            if ( isset( $vl[ 'tabs' ] ) ) {
                                $theTabsContent = $vl[ 'tabs' ];
                            }

                            if ( isset( $vl[ 'accordions' ] ) ) {
                                $theTabsContent = $vl[ 'accordions' ];
                            }

                            $theTabs = [ 'type' => 'tabs', 'tab_prop' => $theTabsContent ];

                            if ( isset( $vl[ 'childOf' ] ) ) {
                                $theTabs = [ 'type' => 'tabs', 'tabID' => $vl[ 'childOf' ], 'tab_prop' => $theTabsContent ];
                            }

                        } else {

                            if ( isset( $vl[ 'childOf' ] ) ) {
                                $theTabs = [ 'type' => 'tabitems', 'tabID' => $vl[ 'childOf' ] ];
                            }

                        }

                        $this->theItems( $vl[ 'type' ], $vl[ 'id' ], $vl[ 'label' ], $theTabs );

                    }

                    $this->addMarkup( 'moreitems', $txt, $t_class );

                } else {

                    $txt     = esc_html__( 'Add Item', 'page-builder-wp' );
                    $t_class = 'no_items';
                    $this->addMarkup( 'moreitems', $txt, $t_class );

                }

                echo '</div>';
                echo '</div>';

            }

            echo '<div class="row-control-cont"><i class="move-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Drag to reorder', 'page-builder-wp' ).'</span></i><i data-action="expcoll" class="expcoll-row row-handle mtips '.esc_attr( $collapsed ).'"><span class="mt-mes">'.esc_html__( 'Expand / Collapse this Row', 'page-builder-wp' ).'</span></i><i data-col-type="'.esc_attr( $colMode ).'" class="cols-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Click to set the number of Columns', 'page-builder-wp' ).'</span></i><i data-action="setlabel" class="setlabel-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Click to set Label for this Row', 'page-builder-wp' ).'</span></i><span class="wpc_row_label">'.( isset( $rows[ 'label' ] ) ? esc_html( $rows[ 'label' ] ) : '' ).'</span><div class="wpc_row_label_cont"><input type="text" class="row_label_editor" /><div class="row_label_editor_btn_cont"><span class="wpc-button-flat wpc-button-color-blue wpc-button-size-small wpc_update_row_label">'.esc_html__( 'Set Label', 'page-builder-wp' ).'</span><span class="wpc-button-flat wpc-button-color-red wpc-button-size-small wpc_row_label_cancel">'.esc_html__( 'Cancel', 'page-builder-wp' ).'</span></div></div><span class="row-right-handle"><i data-action="remove" class="delete-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Delete this Row', 'page-builder-wp' ).'</span></i><i data-action="edit" class="edit-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Row Settings', 'page-builder-wp' ).'</span></i><i data-action="clone" class="copy-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Clone this Row', 'page-builder-wp' ).'</span></i></span></div>';

            echo '</div>';

        }

        if ( $isBlankRow ) {
            echo '<div class="wpc-blank-row"><div class="wpc-blank-logo"><img src="'.esc_url( PBWP_DIR.'/inc/dist/images/wpc_120.png' ).'"></div><div class="wpc-blank-content">'.esc_html__( 'You have blank page. Start adding row and item', 'page-builder-wp' ).'</div><div class="wpc-blank-options"><span class="wpc-blank-create-new-row wpc-button-flat wpc-button-color-blue wpc-button-size-normal">'.esc_html__( 'Create New Row', 'page-builder-wp' ).'</span></div></div>';
        }

        echo '<div '.( $isBlankRow ? 'style="display:none;"' : '' ).' class="add-new-row-cont"><div class="add-new-row mtips"><span class="mt-mes">'.esc_html__( 'Add new Row', 'page-builder-wp' ).'</span></div></div>';
        echo '<div class="item-cp-container"></div>';
        echo '</div>';

        $editor = ob_get_clean();

        return $editor;

    }

    /**
     * Generate wp_editor
     * @return html markup
     * arg ( Unique ID )
     * @access public
     */
    public function theItems( $itemType, $itemID, $itemLabel, $tabs = null )
    {

        // Editor exceptions
        $noEditor = apply_filters( 'pbwp_no_editor_item', [  ] );

        if ( in_array( $itemType, $noEditor ) ) {
            $no_editor = true;
        } else {
            $no_editor = false;
        }

        if ( $itemType == 'rowInner' ) {

            echo '<div id="'.esc_attr( $itemID ).'" data-item-type="'.esc_attr( $itemType ).'" class="wpc-item has_row_inner item-type-'.esc_attr( $itemType ).' ui-sortable-handle">';
            echo '<div class="row-item">';
            echo '</div></div>';

            return;

        }

        // Only for Tab Item Type
        $tabParent = '';
        $keyBase   = '';

        if ( isset( $tabs[ 'tabID' ] ) ) {
            $tabParent = ' data-parent_id="'.esc_attr( $tabs[ 'tabID' ] ).'"';
        }

        if ( $itemType == 'typeTAB' ) {
            $keyBase = ' data-key-base="tabs"';
        }

        if ( $itemType == 'typeAccordion' ) {
            $keyBase = ' data-key-base="accordions"';
        }

        echo '<div id="'.esc_attr( $itemID ).'" data-item-type="'.esc_attr( $itemType ).'" class="wpc-item item-type-'.esc_attr( $itemType ).' ui-sortable-handle '.( $itemType == 'typeTAB' || $itemType == 'typeAccordion' ? 'item-type-tab' : '' ).'"'.esc_attr( $tabParent ).esc_attr( $keyBase ).'>';
        echo '<div class="row-item">';

        if ( $itemType == 'typeTAB' || $itemType == 'typeAccordion' ) {
            ?>
    <?php

            if ( $itemType == 'typeAccordion' ) {$tabClass = 'accordion-class';} else { $tabClass = 'tabs-class';}

            ?>
    <div class="wpc-views-tabs-wrap <?php echo esc_attr( $tabClass ); ?>">
        <div class="wpc-views-label">
            <?php

            if ( isset( $tabs ) && $tabs[ 'type' ] == 'newitem' ) {
                echo '<div data-tab_id="'.esc_attr( $tabs[ 'id' ] ).'" class="tabs-label tab-active">'.esc_html( $tabs[ 'title' ] ).'</div>';
            }

            if ( isset( $tabs ) && $tabs[ 'type' ] == 'tabs' ) {

                foreach ( $tabs[ 'tab_prop' ] as $key => $val ) {

                    $tabContent = $val[ 'title' ];

                    if ( isset( $val[ 'use_icon' ] ) && $val[ 'use_icon' ] == 'yes' && $val[ 'icon' ] != '' ) {

                        $isGM = '';

                        if ( strpos( $val[ 'icon' ], 'material-icons' ) !== false ) {
                            $split = explode( ' ', $val[ 'icon' ] );
                            $isGM  = $split[ 1 ];
                        }

                        $tabContent = ( $val[ 'icon_pos' ] == 'after' ? esc_html( $val[ 'title' ] ) : '' ).'<span class="'.esc_attr( $val[ 'icon' ] ).' position-'.esc_attr( $val[ 'icon_pos' ] ).'">'.esc_html( $isGM ).'</span>'.( $val[ 'icon_pos' ] == 'before' ? esc_html( $val[ 'title' ] ) : '' );

                    }

                    echo '<div id="'.esc_attr( $val[ 'id' ] ).'" data-tab_id="'.esc_attr( $val[ 'id' ] ).'" class="tabs-label'.( $key == 0 ? ' tab-active' : '' ).'">'.wp_kses( $tabContent, pbwp_wp_kses_allowed_html() ).'</div>';

                }

            }

            ?>
            <div class="add-tabs"><i class="wpc-i-add-circle"></i></div>
        </div>
        <div title="<?php echo esc_attr( $itemLabel ); ?>" class="edit-tabs-only"><i class="wpc-i-settings"></i>
            <div class="wpc-element-control tabs-only">
                <ul class="wpc-controls pos-bottom">
                    <li class="edit mtips"><span class="wpc-i-edit"></span><span
                            class="mt-mes"><?php echo esc_html( $itemType == 'typeTAB' ? __( 'Edit this tab', 'page-builder-wp' ) : __( 'Edit this Accordion', 'page-builder-wp' ) ); ?></span>
                    </li>
                    <li class="clone mtips"><span class="wpc-i-clone"></span><span
                            class="mt-mes"><?php echo esc_html( $itemType == 'typeTAB' ? __( 'Clone this tab', 'page-builder-wp' ) : __( 'Clone this Accordion', 'page-builder-wp' ) ); ?></span>
                    </li>
                    <li class="delete"><span class="wpc-i-remove"></span></li>
                </ul>
            </div>
        </div>
        <?php

            if ( isset( $tabs ) && $tabs[ 'type' ] == 'newitem' ) {
                ?>
        <?php

                if ( $itemType == 'typeAccordion' ) {echo '<div class="accordion-body-cont">';}

                ?><div data-tab_cont_id="<?php echo esc_attr( $tabs[ 'id' ] ); ?>"
            class="wpc-views-section wpc-section-active wpc_node_tabs">
            <div class="wpc-views-section-wrap no-item-in wpc-column-wrap">
                <div class="wpc-element tab-item-prop">
                    <span class="add-new-item mtips"><span
                            class="mt-mes"><?php esc_html_e( 'Add new item to this tab', 'page-builder-wp' );?></span></span><span
                        class="edit-tab mtips"><span
                            class="mt-mes"><?php esc_html_e( 'Edit this tab', 'page-builder-wp' );?></span></span><span
                        class="delete-tab mtips"><span
                            class="mt-mes"><?php esc_html_e( 'Remove this tab', 'page-builder-wp' );?></span></span>
                </div>
            </div>
        </div>
        <?php

                if ( $itemType == 'typeAccordion' ) {echo '</div>';}

                ?>
        <?php }

            if ( isset( $tabs ) && $tabs[ 'type' ] == 'tabs' ) {

                foreach ( $tabs[ 'tab_prop' ] as $key => $val ) {

                    echo ''.( $itemType == 'typeAccordion' ? '<div class="accordion-body-cont">' : '' ).'<div data-tab_cont_id="'.esc_attr( $val[ 'id' ] ).'" class="wpc-views-section'.( $key == 0 ? ' wpc-section-active' : '' ).' wpc_node_tabs"><div class="wpc-views-section-wrap wpc-column-wrap"><div class="wpc-element tab-item-prop"><span class="add-new-item mtips"><span class="mt-mes">'.esc_html__( 'Add new item to this tab', 'page-builder-wp' ).'</span></span><span class="edit-tab mtips"><span class="mt-mes">'.esc_html__( 'Edit this tab', 'page-builder-wp' ).'</span></span><span class="delete-tab mtips"><span class="mt-mes">'.esc_html__( 'Remove this tab', 'page-builder-wp' ).'</span></span></div></div></div>'.( $itemType == 'typeAccordion' ? '</div>' : '' ).'';

                }

            }

            ?>
    </div>
    <?php
} else {

            if ( ! function_exists( 'pbwp_generate_icon_item_list' ) ) {
                require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
            }

            $icon_markup = pbwp_generate_icon_item_list( $itemType, 'span' );

            echo '<div class="wpc-element-icon">'.wp_kses( $icon_markup, pbwp_wp_kses_allowed_html() ).'</div><span class="wpc-element-label">'.esc_html( $itemLabel ).'</span><div class="wpc-element-control"><ul class="wpc-controls pos-bottom">'.( $no_editor ? '' : '<li class="edit mtips"><span class="wpc-i-edit"></span><span class="mt-mes">'.esc_html__( 'Edit this item', 'page-builder-wp' ).'</span></li>' ).'<li class="clone mtips"><span class="wpc-i-clone"></span><span class="mt-mes">'.esc_html__( 'Clone this item', 'page-builder-wp' ).'</span></li><li class="delete"><span class="wpc-i-remove"></span></li></ul></div>';
        }

        echo '</div></div>';

    }

    /**
     * Generate Lists Item
     * @return html markup
     * arg ( array() )
     * @access public
     */
    public function itemLists()
    {

        $theCats = apply_filters( 'pbwp_item_category_list', [
            'all'       => 'All',
            'pro'       => 'Pro Feature',
            'content'   => 'Content',
            'media'     => 'Media',
            'social'    => 'Social',
            'chart'     => 'Chart',
            'marketing' => 'Marketing',
            'creative'  => 'Creative',
            'images'    => 'Gallery & Slider',
            'wpwidgets' => 'WordPress Widgets',
         ] );

        $theLists = pbwp_generate_item_list();

        if ( pbwp_wp_version_compare( '4.8' ) === false ) {

            unset( $theLists[ 'wpVideo' ], $theLists[ 'wpAudio' ] );

        }

        echo '<div class="wpc-popup-header"><div class="wpc-popup-header-title">'.esc_html__( 'Add Item', 'page-builder-wp' ).'</div><div class="wpc-popup-close items-box-close"></div></div><div '.'data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="'.( is_rtl() ? 'rtl' : 'ltr' ).'"'.' class="wpc-popup-content-cont"><div class="wpc-popup-content"><div class="wpc-popup-options less-margin-bottom"><ul class="items-categories">';

        foreach ( $theCats as $key => $val ) {
            echo '<li data-cat="cat-'.esc_attr( $key ).'">'.esc_html( $val ).'</li>';
        }

        echo '</ul><div class="wpc-popup-search"><input type="search" placeholder="'.esc_html__( 'Search Item', 'page-builder-wp' ).'" class="wpc-popup-search-field"></div><div class="wpc-popup-opt"><ul class="wpc-components-list">';

        foreach ( $theLists as $key => $val ) {

            $icon_markup = pbwp_generate_icon_item_list( $key, 'i' );
            $is_pro      = isset( $val[ 'pro' ] ) ? true : false;

            echo '<li '.( $is_pro ? 'data-pro-version="yes" ' : '' ).'data-cat="'.esc_attr( $val[ 'category' ] ).'" data-item-type="'.esc_attr( $key ).'" class="wpc-element-item'.( $val[ 'category' ] == 'deprecated' ? ' deprecated' : '' ).' list-item-'.esc_attr( strtolower( $key ) ).'"><div class="item-desc-cont">'.wp_kses( $icon_markup, pbwp_wp_kses_allowed_html() ).'<span class="cpdes"><strong>'.esc_html( $val[ 'name' ] ).'</strong></span></div>'.( $is_pro ? '<span class="wpc_pro_badge">'.esc_html__( 'PRO', 'page-builder-wp' ).'</span>' : '' ).'</li>';

        }

        echo '</ul><div class="wpc_clear_both"></div></div></div></div></div><div class="wpc_clear_both"></div><div class="wpc-selector-footer"></div>';

    }

    /**
     * Generate Additional Markup
     * @return html markup
     * arg ( Unique ID )
     * @access public
     */
    public function addMarkup( $type, $txt = null, $t_class = null )
    {

        ob_start();

        switch ( $type ) {

            case 'emptycol':

                echo '<div>';
                echo '<p>'.esc_html__( 'None', 'page-builder-wp' ).'</p>';
                echo '</div>';

                break;

            case 'moreitems':

                echo '<div class="wpc-item moreitems '.esc_attr( $t_class ).'">';
                echo '<div class="row-item">';
                echo '<span class="item-type-title add-new-item mtips">'.esc_html( $txt ).'<span class="mt-mes">'.esc_html__( 'Add new item to this Column', 'page-builder-wp' ).'</span></span></div>';
                echo '</div>';

                break;

            default:
                break;

        }

        $infome = ob_get_clean();

        echo wp_kses_post( $infome );

    }

    /**
     * Default Items Panel
     * @return tinymce editor
     * @access public
     */
    public function default_Editor_Panel()
    {

        ob_start();

        // Advanced Panel
        echo '<div class="item-editor-cp" id="advanced-panel">';
        echo '<div class="wpc-menu-group-rows">';

        echo '<div data-active-slug="visibility" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Visibility', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';
        echo '<div class="wpc-menu-group-body">';

        echo '<div class="advanced-body wpc-field-content full-width wpc-param-row">';
        echo '<div class="wpc-field-label"><label><span class="preset-for"></span>'.esc_html__( 'Visibility', 'page-builder-wp' ).'</label></div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'Use this option to set the visibility of your row, column or items. Very helpful to determines which elements to display on certain devices and can be seen by logged in visitors or not.', 'page-builder-wp' ).'</div>';
        echo '<div class="wpc-advanced-field">
        <strong>'.esc_html__( 'Breakpoint:', 'page-builder-wp' ).'</strong>
        <select data-type="advanced" name="visibility_breakpoint" class="small-sel">
            <option value="all_devices" selected="selected">'.esc_html__( 'All', 'page-builder-wp' ).'</option>
            <option value="desktop">'.esc_html__( 'Large Devices Only', 'page-builder-wp' ).'</option>
            <option value="desktop_medium">'.esc_html__( 'Large & Medium Devices Only', 'page-builder-wp' ).'</option>
            <option value="medium">'.esc_html__( 'Medium Devices Only', 'page-builder-wp' ).'</option>
            <option value="medium_mobile">'.esc_html__( 'Medium & Small Devices Only', 'page-builder-wp' ).'</option>
            <option value="mobile">'.esc_html__( 'Small Devices Only', 'page-builder-wp' ).'</option>
        </select>
    </div>';
        echo '<div class="wpc-advanced-field">
        <strong>'.esc_html__( 'Display:', 'page-builder-wp' ).'</strong>
        <select data-type="advanced" name="visibility_display" class="small-sel">
            <option value="always" selected="selected">'.esc_html__( 'Always', 'page-builder-wp' ).'</option>
            <option value="logged_out">'.esc_html__( 'Logged Out User', 'page-builder-wp' ).'</option>
            <option value="logged_in">'.esc_html__( 'Logged In User', 'page-builder-wp' ).'</option>
            <option value="never">'.esc_html__( 'Never', 'page-builder-wp' ).'</option>
        </select>
    </div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'NOTE: Effects can only be seen in live mode (not in edit mode).', 'page-builder-wp' ).'</div>';
        echo '</div>'; // End Visibility body

        if ( PBWP_ITEM_META_DATA ) {
            echo '<div class="advanced-body wpc-field-content full-width wpc-param-row">';
            echo '<div class="wpc-field-label"><label>'.esc_html__( 'Meta Data', 'page-builder-wp' ).'</label></div>';
            echo '<div class="wpc-field-des">'.esc_html__( 'Use this option to add additional data for this row. The data that can be used is the json format.', 'page-builder-wp' ).'</div>';
            echo '<div class="wpc-advanced-field">
            <strong>'.esc_html__( 'Meta ID:', 'page-builder-wp' ).'</strong>
            <input type="text" data-type="meta" name="meta_id" value="">
            </div>';
            echo '<div class="wpc-advanced-field">
            <strong>'.esc_html__( 'Data:', 'page-builder-wp' ).'</strong>
            <div class="editor-themes-cnt"><select class="editor-themes"><option value="neat">'.esc_html__( 'Light', 'page-builder-wp' ).'</option><option value="dracula" selected>'.esc_html__( 'Dark', 'page-builder-wp' ).'</option></select><span>'.esc_html__( 'Editor Theme', 'page-builder-wp' ).'</span></div>
            <div class="meta_editor_cont">
            <textarea data-mode="application/ld+json" data-type="meta" data-encode="base64" spellcheck="false" class="field-codeeditor field-textarea-editor" name="meta_data" />{
  "title":""
}</textarea>
            </div>
            </div>';
            echo '</div>'; // End metadata body
        }

        echo '</div>';
        echo '</div>';
        /* Scroll Effects */
        echo '<div data-active-slug="scroll-effect" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Scroll Effects', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';
        echo '<div class="wpc-menu-group-body">';
        echo '<div class="scroll_effects_parent wpc-param-row">';
        echo '<ul class="wpc_menu_tabs">';
        echo '<li data-app-mode="verticalMotion" class="active"><i class="wpc-i-vertical"></i><span class="tooltip">'.esc_html__( 'Vertical Motion', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="horizontalMotion"><i class="wpc-i-horizontal"></i><span class="tooltip">'.esc_html__( 'Horizontal Motion', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="fadeInOut"><i class="wpc-i-fading"></i><span class="tooltip">'.esc_html__( 'Fading In and Out', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="scalingUpDown"><i class="wpc-i-transform-scale"></i><span class="tooltip">'.esc_html__( 'Scaling Up and Down', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="rotating"><i class="wpc-i-transform_rotate"></i><span class="tooltip">'.esc_html__( 'Rotating', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="blur"><i class="wpc-i-blur"></i><span class="tooltip">'.esc_html__( 'Blur', 'page-builder-wp' ).'</span></li>';
        echo '</ul>';
        echo '<div class="wpc-group-content scroll_effects_app_cont"><div class="wpc_scrolleffects_app_markup wpc_apps" data-app-slug="scrollEffects"></div></div>';
        echo '<textarea data-type="advanced" class="iam-hidden field-textarea-editor no-checkbox" data-self-previewer="true" name="app_scrolleffects_data" /></textarea>';
        echo '<div class="wpc-advanced-field scroll_effects_trigger_cont"><strong>'.esc_html__( 'Effect Trigger', 'page-builder-wp' ).'</strong><select data-self-previewer="true" data-type="advanced" name="scroll_effects_trigger"><option value="top">'.esc_html__( 'Top of Element', 'page-builder-wp' ).'</option><option selected="selected" value="middle">'.esc_html__( 'Middle of Element', 'page-builder-wp' ).'</option><option value="bottom">'.esc_html__( 'Bottom of Element', 'page-builder-wp' ).'</option></select><div class="wpc-field-des">'.esc_html__( 'Here you can choose when scroll effects are triggered: When the top, middle or bottom of the element enters into view', 'page-builder-wp' ).'</div></div>';
        echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() );
        echo '</div>';
        echo '</div>';
        echo '</div>';
        /* Transform */
        echo '<div data-active-slug="transform-maker" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Transform', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';

        echo '<div class="wpc-menu-group-body">';
        echo '<div class="transform_parent wpc-param-row">';
        echo '<ul class="wpc_menu_tabs">';
        echo '<li data-app-mode="scale" class="active"><i class="wpc-i-transform-scale"></i><span class="tooltip">'.esc_html__( 'Transform Scale', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="translate"><i class="wpc-i-transform-translate"></i><span class="tooltip">'.esc_html__( 'Transform Translate', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="rotate"><i class="wpc-i-transform_rotate"></i><span class="tooltip">'.esc_html__( 'Transform Rotate', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="skew"><i class="wpc-i-transform-skew"></i><span class="tooltip">'.esc_html__( 'Transform Skew', 'page-builder-wp' ).'</span></li>';
        echo '<li data-app-mode="origin"><i class="wpc-i-transform-origin"></i><span class="tooltip">'.esc_html__( 'Transform Origin', 'page-builder-wp' ).'</span></li>';
        echo '</ul>';
        echo '<div class="wpc-group-content wpc_transform_app_cont"><div class="wpc_transform_app_markup wpc_apps" data-app-slug="transformMaker"></div></div>';
        echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() );
        echo '<textarea data-type="advanced" class="iam-hidden field-textarea-editor no-checkbox" data-self-previewer="true" name="app_transform_data" /></textarea>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        /* Position */
        echo '<div data-active-slug="position" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Position', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';

        echo '<div class="wpc-menu-group-body">';
        echo '<div class="position_parent wpc-param-row">';
        echo '<div class="wpc-group-content wpc_position_app_cont"><div class="wpc_position_app_markup wpc_apps" data-app-slug="position"></div></div>';
        echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() );
        echo '<textarea data-type="advanced" class="iam-hidden field-textarea-editor no-checkbox" data-self-previewer="true" name="app_position_data" /></textarea>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        /* Filters */
        echo '<div data-active-slug="filters" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Filters', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';

        echo '<div class="wpc-menu-group-body">';
        echo '<div class="filters_parent wpc-param-row">';
        echo '<div class="wpc-group-content wpc_app_cont"><div class="wpc_filters_app_markup wpc_apps" data-app-slug="filters"></div></div>';
        echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() );
        echo '<textarea data-type="advanced" class="iam-hidden field-textarea-editor no-checkbox" data-self-previewer="true" name="app_filters_data" /></textarea>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        /* Box Shadow */
        echo '<div data-active-slug="boxshadow" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Box Shadow', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';

        echo '<div class="wpc-menu-group-body">';
        echo '<div class="boxshadow_parent wpc-param-row">';
        echo '<div class="wpc-group-content wpc_app_cont"><div class="wpc_boxshadow_app_markup wpc_apps" data-app-slug="boxshadow"></div></div>';
        echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() );
        echo '<textarea data-type="advanced" class="iam-hidden field-textarea-editor no-checkbox" data-self-previewer="true" name="app_boxshadow_data" /></textarea>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        /* Animations */
        echo '<div data-active-slug="animation" class="wpc-menu-each-row">';
        echo '<div class="wpc-menu-group-controls">';
        echo '<ul><li class="collapse" title="expand / collapse"><i class="wpc-i-arrow-down"></i></li><li class="group-label">'.esc_html__( 'Animation', 'page-builder-wp' ).'</li></ul>';
        echo '</div>';

        echo '<div class="wpc-menu-group-body">';

        ?>
    <div class="wpc-animation-app">
        <div class="wpc-param-row field-animate field-base-animate">
            <div class="wpc-field-content full-width">
                <div id="wpc-animate-preview" class="wpc-animate-preview">
                    <?php esc_html_e( 'Animate preview', 'page-builder-wp' );?><small><?php esc_html_e( 'It happens when scroll over', 'page-builder-wp' );?></small>
                </div>
                <div class="wpc-animate-field">
                    <strong><?php esc_html_e( 'Effect:', 'page-builder-wp' );?></strong>
                    <!-- Avoiding translation for CSS property and animation names -->
                    <select data-type="animate" name="anim_effect" class="input input-dropdown wpc-animate-effect">
                        <option value="" selected="selected">
                            --<?php esc_html_e( 'Select an animate', 'page-builder-wp' );?>--</option>
                        <optgroup label="Most Popular">
                            <option value="fadeIn">fadeIn</option>
                            <option value="fadeInUp">fadeInUp</option>
                            <option value="fadeInDown">fadeInDown</option>
                            <option value="fadeInLeft">fadeInLeft</option>
                            <option value="fadeInRight">fadeInRight</option>
                            <option value="bounceIn">bounceIn</option>
                            <option value="bounceInLeft">bounceInLeft</option>
                            <option value="bounceInRight">bounceInRight</option>
                        </optgroup>
                        <optgroup label="Attention Seekers">
                            <option value="bounce">bounce</option>
                            <option value="flash">flash</option>
                            <option value="pulse">pulse</option>
                            <option value="rubberBand">rubberBand</option>
                            <option value="shake">shake</option>
                            <option value="swing">swing</option>
                            <option value="tada">tada</option>
                            <option value="wobble">wobble</option>
                            <option value="jello">jello</option>
                        </optgroup>
                        <optgroup label="Bouncing Entrances">
                            <option value="bounceIn">bounceIn</option>
                            <option value="bounceInDown">bounceInDown</option>
                            <option value="bounceInLeft">bounceInLeft</option>
                            <option value="bounceInRight">bounceInRight</option>
                            <option value="bounceInUp">bounceInUp</option>
                        </optgroup>
                        <optgroup label="Fading Entrances">
                            <option value="fadeIn">fadeIn</option>
                            <option value="fadeInDown">fadeInDown</option>
                            <option value="fadeInDownBig">fadeInDownBig</option>
                            <option value="fadeInLeft">fadeInLeft</option>
                            <option value="fadeInLeftBig">fadeInLeftBig</option>
                            <option value="fadeInRight">fadeInRight</option>
                            <option value="fadeInRightBig">fadeInRightBig</option>
                            <option value="fadeInUp">fadeInUp</option>
                            <option value="fadeInUpBig">fadeInUpBig</option>
                        </optgroup>
                        <optgroup label="Flippers">
                            <option value="flip">flip</option>
                            <option value="flipInX">flipInX</option>
                            <option value="flipInY">flipInY</option>
                        </optgroup>
                        <optgroup label="Lightspeed">
                            <option value="lightSpeedIn">lightSpeedIn</option>
                        </optgroup>
                        <optgroup label="Rotating Entrances">
                            <option value="rotateIn">rotateIn</option>
                            <option value="rotateInDownLeft">rotateInDownLeft</option>
                            <option value="rotateInDownRight">rotateInDownRight</option>
                            <option value="rotateInUpLeft">rotateInUpLeft</option>
                            <option value="rotateInUpRight">rotateInUpRight</option>
                        </optgroup>
                        <optgroup label="Sliding Entrances">
                            <option value="slideInUp">slideInUp</option>
                            <option value="slideInDown">slideInDown</option>
                            <option value="slideInLeft">slideInLeft</option>
                            <option value="slideInRight">slideInRight</option>
                        </optgroup>
                        <optgroup label="Zoom Entrances">
                            <option value="zoomIn">zoomIn</option>
                            <option value="zoomInDown">zoomInDown</option>
                            <option value="zoomInLeft">zoomInLeft</option>
                            <option value="zoomInRight">zoomInRight</option>
                            <option value="zoomInUp">zoomInUp</option>
                        </optgroup>
                        <optgroup label="Specials">
                            <option value="rollIn">rollIn</option>
                        </optgroup>
                    </select>
                </div>
                <div class="wpc-animate-field">
                    <strong><?php esc_html_e( 'Delay:', 'page-builder-wp' );?></strong>
                    <input value="100" data-type="animate" name="anim_delay" class="wpc-animate-delay"
                        placeholder="Example: 200" type="text">
                </div>
                <div class="wpc-animate-field">
                    <strong><?php esc_html_e( 'Speed:', 'page-builder-wp' );?></strong>
                    <select data-type="animate" name="anim_speed" class="small-sel wpc-animate-speed">
                        <option selected="selected" value="2s"><?php esc_html_e( 'Normal', 'page-builder-wp' );?>
                        </option>
                        <option value="1s"><?php esc_html_e( 'Fast', 'page-builder-wp' );?></option>
                        <option value="3s"><?php esc_html_e( 'Slow', 'page-builder-wp' );?></option>
                        <option value=".5s"><?php esc_html_e( 'Fastest', 'page-builder-wp' );?></option>
                        <option value="3.5s"><?php esc_html_e( 'Slowest', 'page-builder-wp' );?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <?php

        echo '</div>';
        echo '</div>';

        /* -------------------------------------------------------------------------------------------------------------------------------------- */
        echo '</div>';
        echo "</div>\n";

        // Style ( CSS ) Panel
        echo '<div class="item-editor-cp style-panel-tpl" id="style-panel">';
        echo '<div class="wpc-style-group-cont"><span class="wpc_donuts_fixed_menu"></span><ul class="wpc-style-group-nav"></ul></div>';
        echo "</div>\n";

        // HTML raw
        echo '<div class="item-editor-cp" id="html-panel">';
        echo '<div class="editor-themes-cnt"><select class="editor-themes"><option value="neat">'.esc_html__( 'Light', 'page-builder-wp' ).'</option><option value="dracula" selected>'.esc_html__( 'Dark', 'page-builder-wp' ).'</option></select><span>'.esc_html__( 'Editor Theme', 'page-builder-wp' ).'</span></div>';
        echo "</div>\n";

        // Group Panel
        echo '<div class="item-editor-cp group-item-panel" id="group-panel">';
        echo '<div class=wpc-param-row><div class=wpc-field-label><label>'.esc_html__( 'Items', 'page-builder-wp' ).'</label></div><div class=wpc-group-rows><div class="wpc-add-group wpc-group-controls"><i class="wpc-i-add-normal"></i>'.esc_html__( 'Add New Item', 'page-builder-wp' ).'</div></div></div>';
        echo "</div>\n";

        // Global Editor ( Frontend )
        echo '<div class="item-editor-cp" id="global-frontend-editor"><div class="wpc-field-des wpc-notify">'.esc_html__( 'All settings bellow will applied to frontend and it will be outputted only on: ', 'page-builder-wp' ).'<span class="global-page-name"></span></div>';
        echo "</div>\n";

        // Global Editor ( Backend )
        echo '<div class="item-editor-cp" id="global-backend-editor">';
        echo '<div class="wpc-editor-control wpc-param-row"><div class="wpc-field-label"><label>'.esc_html__( 'Backup &amp; Restore', 'page-builder-wp' ).'</label></div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'When you click Backup button, system will generate a JSON file. You can save it into your computer. This backup file contains all of your rows, columns, items and all them configurations. This backup file also will allows you to easily import the configuration of this page to another page.', 'page-builder-wp' ).'</div>';
        echo '<div class="backup-button-cont"><span class="wpc-button-flat wpc-button-color-blue wpc-button-size-normal global-backup">'.esc_html__( 'Backup Now', 'page-builder-wp' ).'</span><span class="wpc-button-flat wpc-button-color-orange wpc-button-size-normal global-restore">'.esc_html__( 'Restore Now', 'page-builder-wp' ).'</span></div>';
        echo '<div class="reset-stt wpc-field-label"><label>'.esc_html__( 'Reset All Settings', 'page-builder-wp' ).'</label></div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'This action will remove all of your rows, columns, items and all them configurations.', 'page-builder-wp' ).'</div>';
        echo '<div class="reset-button-cont"><span class="wpc-button-flat wpc-button-color-red wpc-button-size-small global-reset">'.esc_html__( 'Reset All', 'page-builder-wp' ).'</span></div>';
        echo '<input id="wpc-json-restore" type="file" accept=".json"/></div>'; // End wpc-param-row
        echo "</div>\n";

        // Preset Manager Markup
        echo '<div class="item-editor-cp" id="preset-template">';
        echo '<div class="wpc-field-label item-preset-label"><label><span class="preset-for"></span>'.esc_html__( 'Presets', 'page-builder-wp' ).'</label></div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'You can save and load the presets in order to applied to another same items, it will automatically set all settings inside saved preset into your selected items. This feature very helpful and will save your time works.', 'page-builder-wp' ).'</div>';
        echo '<div class="preset-body">';
        echo '<div class="preset-create"><input placeholder="'.esc_attr__( 'Preset Name', 'page-builder-wp' ).'" class="preset-title" type="text"/><span class="wpc-button-flat wpc-button-color-blue wpc-button-size-normal preset-create-now">'.esc_html__( 'Create', 'page-builder-wp' ).'</span></div>';
        echo '<div class="wpc-field-label"><label>'.esc_html__( 'Available Presets', 'page-builder-wp' ).':</label></div>';
        echo '<div class="preset-list"></div>';
        echo '</div>'; // End preset body
        echo "</div>\n";

        // Template Manager Markup
        echo '<div class="item-editor-cp" id="template-template">';
        echo '<div class="wpc-field-label item-preset-label"><label><span class="preset-for"></span>'.esc_html__( 'Templates', 'page-builder-wp' ).'</label></div>';
        echo '<div class="wpc-field-des">'.esc_html__( 'You can save and load the templates in order to applied to another pages, it will automatically set all settings inside saved template into your selected pages. This feature very helpful and will save your time works.', 'page-builder-wp' ).'</div>';
        echo '<div class="preset-body">';
        echo '<div class="preset-create"><input placeholder="'.esc_attr__( 'Template Name', 'page-builder-wp' ).'" class="preset-title" type="text"/><span class="wpc-button-flat wpc-button-color-blue wpc-button-size-normal preset-create-now template-create-now">'.esc_html__( 'Create', 'page-builder-wp' ).'</span></div>';
        echo '<div class="wpc-field-label"><label>'.esc_html__( 'Available Templates', 'page-builder-wp' ).':</label></div>';
        echo '<div class="preset-list"></div>';
        echo '</div>'; // End preset body
        echo "</div>\n";

        $thePanel = ob_get_clean();
        echo wp_kses( $thePanel, pbwp_wp_kses_allowed_html() );

    }

    /**
     * Default Items Panel
     * @return tinymce editor
     * @access public
     */
    public function default_Fields()
    {

        $stt_general = pbwp_get_option( 'stt_general' );

        ob_start();

        echo '<div class="item-editor-cp-fields" id="cp-fields">';

        $quicktags = ( isset( $stt_general[ 'disable_visualtext' ] ) && $stt_general[ 'disable_visualtext' ] == 'active' ? ' editor_no_quicktags' : '' );

        ?>

    <!-- Field TextEditor -->
    <div class="wpc-editor-control wpc-param-row field-texteditor<?php echo esc_attr( $quicktags ); ?>">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <textarea spellcheck="false" class="primary-value field-textarea-editor field-texteditor-content"
                data-encode="base64" name="" /></textarea>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Extra Class -->
    <div class="wpc-editor-control wpc-param-row xtra-class">
        <div class="wpc-field-label">
            <label><?php esc_html_e( 'Extra Class', 'page-builder-wp' );?></label>
        </div>
        <div class="wpc-field-content">
            <input class="wpc-extra-class-param" value="" name="itm_xtra_class" type="text"><span
                class="optional"><?php esc_html_e( 'Optional', 'page-builder-wp' );?></span>
            <div class="wpc-field-des"><?php esc_html_e( 'Add class name for this item', 'page-builder-wp' );?></div>
        </div>
    </div>

    <!-- Field Wrap Extra Class -->
    <div class="wpc-editor-control wpc-param-row wrap-xtra-class">
        <div class="wpc-field-label">
            <label><?php esc_html_e( 'Wrap Extra Class', 'page-builder-wp' );?></label>
        </div>
        <div class="wpc-field-content">
            <input class="wpc-wrap-extra-class-param" value="" name="wrap_xtra_class" type="text"><span
                class="optional"><?php esc_html_e( 'Optional', 'page-builder-wp' );?></span>
            <div class="wpc-field-des">
                <?php esc_html_e( 'If you wish to style a particular content element differently, please add a class name to this field and refer to it in your custom CSS file', 'page-builder-wp' );?>
            </div>
        </div>
    </div>

    <!-- Field CSS Align -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-alignment">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="" class="active"><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="left"><span class="optdash wpc-i-align-left"></span><span
                            class="tooltip">left</span></li>
                    <li data-value="center"><span class="optdash wpc-i-align-center"></span><span
                            class="tooltip">center</span></li>
                    <li data-value="right"><span class="optdash wpc-i-align-right"></span><span
                            class="tooltip">right</span></li>
                    <li data-value="justify"><span class="optdash wpc-i-justify"></span><span
                            class="tooltip">justify</span></li>
                </ul>
                <input class="wpc-alignment-param iam-hidden primary-value" value="" name="" type="text">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field CSS Display -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-display">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li class="active" data-value=""><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="inline-block">Inline Block<span class="tooltip">inline block</span></li>
                    <li data-value="inline">Inline<span class="tooltip">inline</span></li>
                    <li data-value="block">Block<span class="tooltip">block</span></li>
                    <li data-value="flex">Flex<span class="tooltip">flex</span></li>
                    <li data-value="none">None<span class="tooltip">none</span></li>
                </ul>
                <input class="wpc-display-param iam-hidden primary-value" value="" name="" type="text">
            </div>
        </div>
    </div>
    <!-- Field CSS Overflow -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-overflow">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li class="active" data-value=""><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="visible">visible<span class="tooltip">visible</span></li>
                    <li data-value="hidden">hidden<span class="tooltip">hidden</span></li>
                </ul>
                <input class="wpc-display-param iam-hidden primary-value" value="" name="" type="text">
            </div>
        </div>
    </div>
    <!-- Field CSS Text Transform -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-text-transform">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li class="active" data-value="none"><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="uppercase">TT<span class="tooltip">Uppercase</span></li>
                    <li data-value="capitalize">Tt<span class="tooltip">Capitalize</span></li>
                    <li data-value="lowercase">tt<span class="tooltip">Lowercase</span></li>
                </ul>
                <input class="wpc-display-param iam-hidden primary-value" value="" name="" type="text">
            </div>
        </div>
    </div>
    <!-- Field Float -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-float">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li class="active" data-value=""><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="left">Left<span class="tooltip">left</span></li>
                    <li data-value="right">Right<span class="tooltip">right</span></li>
                    <li data-value="inherit">Inherit<span class="tooltip">inherit</span></li>
                    <li data-value="initial">Initial<span class="tooltip">initial</span></li>
                    <li data-value="none">None<span class="tooltip">none</span></li>
                </ul>
                <input class="wpc-display-param iam-hidden primary-value" value="" name="" type="text">
            </div>
        </div>
    </div>

    <!-- Field CSS Font Weight -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-font-weight">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <ul class="buttons">
                    <li class="active" data-value=""><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="300">300<span class="tooltip">300</span></li>
                    <li data-value="400">400<span class="tooltip">400</span></li>
                    <li data-value="500">500<span class="tooltip">500</span></li>
                    <li data-value="600">600<span class="tooltip">600</span></li>
                    <li data-value="700">700<span class="tooltip">700</span></li>
                    <li data-value="800">800<span class="tooltip">800</span></li>
                    <li class="custom_value_cont"><input placeholder="Custom"
                            class="wpc-font-weight-param custom-value primary-value" value="" name="" type="text"></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Field CSS Font Style -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-font-style">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <ul class="buttons">
                    <li data-value="normal"><i class="wpc-i-ban_circle optdash"></i><span class="tooltip">Normal</span>
                    </li>
                    <li data-value="italic"><i class="wpc-i-italic"></i><span class="tooltip">Italic</span></li>
                    <li class="custom_value_cont"><input placeholder="Custom"
                            class="wpc-font-style-param custom-value primary-value iam-hidden" value="" name=""
                            type="text"></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Field CSS Vertical Align -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-vertical-align">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="" class="active"><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="initial">initial<span class="tooltip">initial</span></li>
                    <li data-value="baseline">baseline<span class="tooltip">baseline</span></li>
                    <li data-value="top">top<span class="tooltip">top</span></li>
                    <li data-value="bottom">bottom<span class="tooltip">bottom</span></li>
                    <li data-value="middle">middle<span class="tooltip">middle</span></li>
                    <li data-value="sub">sub<span class="tooltip">sub</span></li>
                    <li data-value="super">super<span class="tooltip">super</span></li>
                    <li data-value="text-top">text-top<span class="tooltip">text top</span></li>
                    <li data-value="text-bottom">text-bottom<span class="tooltip">text bottom</span></li>
                </ul>
                <input class="wpc-css-vertical-align-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field CSS Flex Vertical Align -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-flex-vertical-align">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="" class="active"><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="start">Top<span class="tooltip">Top</span></li>
                    <li data-value="center">Middle<span class="tooltip">Middle</span></li>
                    <li data-value="end">Bottom<span class="tooltip">Bottom</span></li>
                </ul>
                <input class="wpc-css-vertical-align-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field CSS Flex Horizontal Align -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-flex-horizontal-align">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="" class="active"><i class="wpc-i-ban_circle optdash"></i></li>
                    <li data-value="start">Left<span class="tooltip">Left</span></li>
                    <li data-value="center">Center<span class="tooltip">Center</span></li>
                    <li data-value="end">Right<span class="tooltip">Right</span></li>
                </ul>
                <input class="wpc-css-vertical-align-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field CSS Vertical Align (Simple) -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-three-vertical-align">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="top">top<span class="tooltip">top</span></li>
                    <li data-value="middle">middle<span class="tooltip">middle</span></li>
                    <li data-value="bottom">bottom<span class="tooltip">bottom</span></li>
                </ul>
                <input class="wpc-css-vertical-align-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Border radius, Padding & Margin -->
    <div class="wpc-editor-control wpc-param-row field-corners">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input name="" class="primary-value" data-css-corners-value="" value="" type="hidden">
            <div class="wpc-corners-wrp">
                <hr class="wpc-corners-hr">
                <hr class="wpc-corners-vr">
                <div class="wpc-corners-top wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Top'" onfocus="this.placeholder=''" placeholder="Top"
                            data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-right wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Right'" onfocus="this.placeholder=''" placeholder="Right"
                            data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-bottom wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Bottom'" onfocus="this.placeholder=''" placeholder="Bottom"
                            data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-left wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Left'" onfocus="this.placeholder=''" placeholder="Left"
                            data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="m-f-u-li-link">
                    <span class="wpc-i-move"></span>
                </div>
            </div>
            <div class="wpc-field-des">
                <?php
/* translators: %1$s is a placeholder for the logo element */
        printf( esc_html__( 'TIPS: You can click the logo %1$s above to set values in the same time', 'page-builder-wp' ), '<span class="wpc-move-tips wpc-i-move"></span>' );
        ?>
            </div>
        </div>
    </div>

    <!-- Border -->
    <div class="wpc-editor-control wpc-param-row field-border">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input name="" class="primary-value" data-css-corners-value="" value="" type="hidden">
            <div class="wpc-corners-wrp">
                <hr class="wpc-corners-hr">
                <hr class="wpc-corners-vr">
                <div class="wpc-corners-top wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Top'" onfocus="this.placeholder=''" placeholder="Top"
                            class="wpc-css-border" data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-right wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Right'" onfocus="this.placeholder=''" placeholder="Right"
                            class="wpc-css-border" data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-bottom wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Bottom'" onfocus="this.placeholder=''" placeholder="Bottom"
                            class="wpc-css-border" data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>

                <div class="wpc-corners-left wpc-corners-pos">
                    <div class="wpc-input-qtt-cont">
                        <input onblur="this.placeholder='Left'" onfocus="this.placeholder=''" placeholder="Left"
                            class="wpc-css-border" data-css-corners="" value="" type="text">
                        <div class="quantity-nav">
                            <div class="quantity-button quantity-up">+</div>
                            <div class="quantity-button quantity-down">-</div>
                        </div>
                    </div>
                </div>
                <div class="m-f-u-li-link">
                    <span class="wpc-i-move"></span>
                </div>
            </div>
            <div class="border-prop">
                <!-- Avoiding translation for CSS property name -->
                <select class="wpc-border-style">
                    <option value="">- <?php esc_html_e( 'Border Style', 'page-builder-wp' );?> -</option>
                    <option value="hidden">hidden</option>
                    <option value="dotted">dotted</option>
                    <option value="dashed">dashed</option>
                    <option value="solid">solid</option>
                    <option value="double">double</option>
                    <option value="groove">groove</option>
                    <option value="ridge">ridge</option>
                    <option value="inset">inset</option>
                    <option value="outset">outset</option>
                    <option value="initial">initial</option>
                    <option value="inherit">inherit</option>
                    <option value="none">none</option>
                </select>
                <div class="wpc-border-style-color-cont">
                    <input value="" placeholder="Border Color" class="wpc-css-color-param" autocomplete="off"
                        type="search">
                </div>
            </div>
        </div>
    </div>

    <!-- Fonts Picker -->
    <div class="wpc-editor-control wpc-param-row field-fonts-picker">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-fonts-picker">
                <input placeholder="Select font" name="" class="wpc-css-font-family-param primary-value" value=""
                    type="text">
                <button class="f-m-launcher"><?php esc_html_e( 'Fonts Manager', 'page-builder-wp' );?><i
                        class="wpc-i-font-picker"></i></button>
                <ul class="wpc-fonts-list"></ul>
            </div>
        </div>
    </div>

    <!-- Date Time Picker -->
    <div class="wpc-editor-control wpc-param-row field-date">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input class="field-date-picker" type="text" />
            <input class="primary-value iam-hidden" name="" value="" type="text" />
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Number -->
    <div class="wpc-param-row field-number">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-input-qtt-cont">
                <input value="" max="9999" min="-9999" type="number">
                <div class="quantity-nav">
                    <div class="quantity-button quantity-up">+</div>
                    <div class="quantity-button quantity-down">-</div>
                </div>
            </div>
            <input name="" class="wpc-number-param primary-value" value="" type="hidden">
            <ul class="the-units">
                <li class="active">px</li>
                <li>em</li>
                <li>%</li>
                <li>vw</li>
                <li>rem</li>
            </ul>
        </div>
        <div class="wpc-field-des"></div>
    </div>

    <!-- Field Switch -->
    <div class="wpc-editor-control wpc-param-row field-switch">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input class="ios field-switch-cbox" type="checkbox" />
            <div class="wpc-ios-ui-select field-switch-handle">
                <div class="inner"></div>
            </div>
            <input class="primary-value iam-hidden" name="" value="" type="text" />
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Slider -->
    <div class="wpc-editor-control wpc-param-row field-slider">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="slider-control-cont">
                <div class="flat-slider"></div>
            </div>
            <input class="wpc-slider-param input-indictr primary-value" value="" name="" type="text"><span
                class="slider-unit"></span>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Text -->
    <div class="wpc-editor-control wpc-param-row field-text">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input class="primary-value" value="" name="" type="text">
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Textarea -->
    <div class="wpc-editor-control wpc-param-row field-textarea">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <textarea spellcheck="false" class="primary-value field-textarea-editor" data-encode="base64"
                name="" /></textarea>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Code Editor -->
    <div class="wpc-editor-control wpc-param-row field-code-editor">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="editor-themes-cnt"><select class="editor-themes">
                    <option value="neat"><?php esc_html_e( 'Light', 'page-builder-wp' );?></option>
                    <option value="dracula" selected><?php esc_html_e( 'Dark', 'page-builder-wp' );?></option>
                </select><span><?php esc_html_e( 'Editor Theme', 'page-builder-wp' );?></span></div>
            <textarea spellcheck="false" class="primary-value field-textarea-editor field-codeeditor"
                data-encode="base64" name="" /></textarea>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Icon -->
    <div class="wpc-editor-control wpc-param-row field-icon">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input type="text" class="field-icon-selector" />
            <input class="primary-value" type="hidden" value="" name="" />
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Select -->
    <div class="wpc-editor-control wpc-param-row field-select">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <select class="field-select-param primary-value" name=""></select>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Color -->
    <div class="wpc-param-row field-color_picker field-color">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="field-color-input-cont">
                <input readonly name="" value="" placeholder="Select color" class="wpc-css-color-param primary-value"
                    autocomplete="off" type="search">
            </div>
        </div>
    </div>

    <!-- Field Color Gradient -->
    <div class="wpc-param-row field-color-gradient">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input class="ios field-switch-cbox" type="checkbox" />
            <div class="wpc-ios-ui-select field-switch-handle gradient-box-handle">
                <div class="inner"></div>
            </div>
            <div class="wpc_color_gradient">
                <?php echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() ); ?>
                <textarea class="iam-hidden primary-value field-textarea-editor no-checkbox" data-encode="base64"
                    name="" /></textarea>
            </div>
        </div>
    </div>

    <!-- Field Shape Wave -->
    <div class="wpc-param-row field-shapedivider">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc_shapedivider">
                <?php echo wp_kses( pbwp_generate_pro_box(), pbwp_wp_kses_allowed_html() ); ?>
                <div id="wpc_shapedivider">
                </div>
                <textarea class="iam-hidden primary-value field-textarea-editor no-checkbox" data-encode="base64"
                    name="" /></textarea>
            </div>
        </div>
    </div>

    <!-- Field Link -->
    <div class="wpc-editor-control wpc-param-row field-link">
        <div class="wpc-field-label">
            <label><?php esc_html_e( 'Link', 'page-builder-wp' );?></label>
        </div>
        <div class="wpc-field-content">
            <input name="" class="wpc-param link-field primary-value" value="" type="hidden">
            <a class="button link button-primary"><span
                    class="wpc-i-link"></span><?php esc_html_e( 'Add your link', 'page-builder-wp' );?></a><br>
            <div class="wpc-field-des link-details"><?php esc_html_e( 'Link details:', 'page-builder-wp' );?></div>
            <span class="link-preview"></span>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Field Template -->
    <div class="wpc-editor-control wpc-param-row field-template">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <select class="wpc-layout-selector">
                <option value="default"><?php esc_html_e( 'Default', 'page-builder-wp' );?></option>
            </select>
            <input class="primary-value iam-hidden" name="" value="" type="text" />
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Media Picker -->
    <div class="wpc-editor-control wpc-param-row field-media-picker">
        <div class="wpc-field-label">
            <label><?php esc_html_e( 'Media', 'page-builder-wp' );?></label>
            <div class="wpc_media_editor_note wpc-notify">
                <?php esc_html_e( 'Click on image to edit the title, alt text or description', 'page-builder-wp' );?>
            </div>
        </div>
        <div class="wpc-field-content">
            <input value="" class="iam-hidden primary-value" type="text" name="" />
            <div class="single-media-preview"><span class="media-holder"><span class="media_loader"></span></span><span
                    class="si-close" title="<?php esc_attr_e( 'Delete this media', 'page-builder-wp' );?>"></span></div>
            <div class="wpc-media-picker"><button class="button wpc-opt-media media-picker"
                    type="button"><?php esc_html_e( 'Select Media', 'page-builder-wp' );?></button></div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Post Type List -->
    <div class="wpc-editor-control wpc-param-row field-post-type">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input value="" class="iam-hidden primary-value" type="text" name="" />
            <div class="wpc_checkbox_post_type">
                <?php

        foreach ( pbwp_get_post_types() as $post_type ) {
            echo '<input id="cb_'.esc_attr( $post_type ).'" class="wpc_post_type" value="'.esc_attr( $post_type ).'" type="checkbox"><label for="cb_'.esc_attr( $post_type ).'">'.esc_html( $post_type ).'</label>';
        }

        ?>
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Row Box Style -->
    <div class="wpc-editor-control wpc-param-row field-row-box-style">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="bg-style-selector">
                <div class="bg-style-selector-type-settings">
                    <select class="field-select-param primary-value bg-style-select" name=""></select>
                </div>
                <span><?php esc_html_e( 'Preview', 'page-builder-wp' );?>:</span>
                <div class="bg-style-preview"></div>
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Radio Image -->
    <div class="wpc-editor-control wpc-param-row field-radio-images">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <input value="" class="iam-hidden primary-value" type="text" name="" />
            <div class="field-radio-images-cnt"></div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Background - Repeat -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-background-props field-background-repeat">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="no-repeat">No Repeat<span class="tooltip">No Repeat</span></li>
                    <li data-value="repeat">Repeat<span class="tooltip">Repeat</span></li>
                    <li data-value="repeat-x">Repeat-x<span class="tooltip">Horizontally</span></li>
                    <li data-value="repeat-y">Repeat-y<span class="tooltip">Vertically</span></li>
                </ul>
                <input class="wpc-css-background-repeat-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Background - Position -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-background-props field-background-position">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="center center">Center<span class="tooltip">Center</span></li>
                    <li data-value="top left">Default<span class="tooltip">Top Left</span></li>
                    <li data-value="50% 50%">50%<span class="tooltip">50% 50%</span></li>
                </ul>
                <input class="wpc-css-background-position-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Background - attachment -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-background-props field-background-attachment">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="fixed">Fixed<span class="tooltip">Fixed</span></li>
                    <li data-value="scroll">Scroll<span class="tooltip">Scroll</span></li>
                    <li data-value="local">Local<span class="tooltip">Local</span></li>
                    <li data-value="inherit">Inherit<span class="tooltip">Inherit</span></li>
                </ul>
                <input class="wpc-css-background-attachment-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Background - size -->
    <div class="wpc-editor-control wpc-param-row field-select_group field-background-props field-background-size">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-select_group-field-wrp">
                <!-- Avoiding translation for CSS property name -->
                <ul class="buttons">
                    <li data-value="auto">Auto<span class="tooltip">Auto</span></li>
                    <li data-value="cover">Cover<span class="tooltip">Cover</span></li>
                    <li data-value="contain">Contain<span class="tooltip">Contain</span></li>
                    <li data-value="inherit">Inherit<span class="tooltip">Inherit</span></li>
                </ul>
                <input class="wpc-css-background-size-param primary-value" value="" name="" type="hidden">
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Background - Blend Mode -->
    <div class="wpc-editor-control wpc-param-row field-background-props field-background-blend-mode">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <select class="field-select-param primary-value" name=""></select>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Grab List -->
    <div class="wpc-editor-control wpc-param-row field-grab-list">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="grab-list-cont">
                <select class="field-select-param primary-value wpc_grab_list_select" name=""></select>
                <span
                    class="wpc_grab_list_button wpc-button-flat wpc-button-color-blue wpc-button-size-small"><?php esc_html_e( 'Grab Lists', 'page-builder-wp' );?></span>
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Grab Page -->
    <div class="wpc-editor-control wpc-param-row field-grab-page">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="grab-page-cont">
                <select class="field-select-param primary-value wpc_pages_select" name=""></select>
                <span
                    class="wpc_get_page_button wpc-button-flat wpc-button-color-blue wpc-button-size-small"><?php esc_html_e( 'Get Pages', 'page-builder-wp' );?></span>
            </div>
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- Getresponse API Gateway -->
    <div class="wpc-editor-control wpc-param-row field-getresponse-notes">
        <div class="wpc-field-content">
            <div class="grab-getresponse-cont">
                <input class="primary-value" value="" name="" type="hidden">
                <div class="emm_gr_connect_cont">
                    <p><?php esc_html_e( 'You need to generate the Access Token first to use this service. Please follow the steps below to get your token:', 'page-builder-wp' );?>
                    </p>
                    <ul class="gr_token_steps">
                        <li>
                            <p>
                                <?php
                                /* translators: %1$s is a placeholder for the URL to create a new app */
                                printf( esc_html__( 'Firstly, you need to create App from your account. Please go here: <a target="_blank" href="%1$s">Create New App</a>', 'page-builder-wp' ), 'https://app.getresponse.com/login?p=authorizations/add' );
                                ?>
                            </p>
                        </li>
                        <li>
                            <p><?php esc_html_e( 'Enter a name, description, and logo of your application. Next, enter a Redirect URL. MAKE SURE to copy the Redirect URL below and paste into your App Redirect URL field.', 'page-builder-wp' );?>
                            </p>
                        </li>
                        <li>
                            <p><?php esc_html_e( 'Click ADD, your registered app will appear under Connected applications. Click on the app name to display Client ID and Secret Key.', 'page-builder-wp' );?>
                            </p>
                        </li>
                        <li>
                            <p><?php esc_html_e( 'Now just copy that both credentials ( Client ID and Secret Key ) and paste in fields below and safe/update the form first.', 'page-builder-wp' );?>
                            </p>
                        </li>
                        <li>
                            <p><?php esc_html_e( 'Last steps, just hit the Green Button to generate your Access Token.', 'page-builder-wp' );?>
                            </p>
                        </li>
                        <li>
                            <p><?php esc_html_e( 'DONE :)', 'page-builder-wp' );?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Image Filters -->
    <div class="wpc-editor-control wpc-param-row field-image-filters">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content">
            <div class="wpc-image-filter-cont">
                <span
                    class="ig-filter-no_selected_image"><?php esc_html_e( 'You need to add an image first', 'page-builder-wp' );?></span>
            </div>
            <input class="wpc-css-image-filters-param primary-value" value="" name="" type="hidden">
            <div class="wpc-field-des"></div>
        </div>
    </div>

    <!-- AI Dialog -->
    <div class="app_ai_markup">
        <!-- Edit prompt panel -->
        <div class="wpc-ai-prompt-panels">
            <div class="wpc-ai-prompt-panel wpc-ai-prompt-edit">
                <span
                    class="wpc-ai-prompt-label"><?php esc_html_e( 'Your current Content', 'page-builder-wp' );?>:</span>
                <div class="wpc-ai-input-prompt-cont">
                    <div class="wpc-ai-prompt-textarea">
                        <textarea spellcheck="false"
                            class="wpc-ai-input-prompt wpc-ai-input-textarea wpc-ai-input-prompter"></textarea>
                    </div>
                </div>
                <div class="wpc-ai-option-prompt-cont">
                    <div class="wpc-ai-option-quick-actions">
                        <div class="wpc-ai-qa-options">
                            <span data-ai-quick-prompt="rewrite" class="wpc-ai-prompt-opt-oval-button wpc_click_fx"><i
                                    class="wpc-ai-menu-icon wpc-app-ai-rewrite"></i><?php esc_html_e( 'Rewrite text', 'page-builder-wp' );?></span>
                            <span data-ai-quick-prompt="shorter" class="wpc-ai-prompt-opt-oval-button wpc_click_fx"><i
                                    class="wpc-ai-menu-icon wpc-app-ai-shorter"></i><?php esc_html_e( 'Make it shorter', 'page-builder-wp' );?></span>
                            <span data-ai-quick-prompt="longer" class="wpc-ai-prompt-opt-oval-button wpc_click_fx"><i
                                    class="wpc-ai-menu-icon wpc-app-ai-longer"></i><?php esc_html_e( 'Make it longer', 'page-builder-wp' );?></span>
                            <span data-ai-quick-prompt="fix" class="wpc-ai-prompt-opt-oval-button wpc_click_fx"><i
                                    class="wpc-ai-menu-icon wpc-app-ai-keyboard"></i><?php esc_html_e( 'Fix spelling & grammar', 'page-builder-wp' );?></span>
                        </div>
                        <div class="wpc-ai-qa-options wpc-ai-qa-options-selectbox">
                            <select data-ai-quick-prompt="tone" class="wpc-ai-input-prompt wpc-ai-input-select">
                                <option selected="selected" value="none">
                                    <?php esc_html_e( 'Change tone', 'page-builder-wp' );?></option>
                                <option value="casual"><?php esc_html_e( 'Casual', 'page-builder-wp' );?></option>
                                <option value="confidence"><?php esc_html_e( 'Confidence', 'page-builder-wp' );?>
                                </option>
                                <option value="formal"><?php esc_html_e( 'Formal', 'page-builder-wp' );?></option>
                                <option value="friendly"><?php esc_html_e( 'Friendly', 'page-builder-wp' );?></option>
                                <option value="inspirational"><?php esc_html_e( 'Inspirational', 'page-builder-wp' );?>
                                </option>
                                <option value="motivational"><?php esc_html_e( 'Motivational', 'page-builder-wp' );?>
                                </option>
                                <option value="nostalgic"><?php esc_html_e( 'Nostalgic', 'page-builder-wp' );?></option>
                                <option value="playful"><?php esc_html_e( 'Playful', 'page-builder-wp' );?></option>
                                <option value="professional"><?php esc_html_e( 'Professional', 'page-builder-wp' );?>
                                </option>
                                <option value="scientific"><?php esc_html_e( 'Scientific', 'page-builder-wp' );?>
                                </option>
                                <option value="straightforward">
                                    <?php esc_html_e( 'Straightforward', 'page-builder-wp' );?>
                                </option>
                                <option value="witty">Witty</option>
                            </select>
                            <select data-ai-quick-prompt="language" class="wpc-ai-input-prompt wpc-ai-input-select">
                                <option selected="selected" value="none">
                                    <?php esc_html_e( 'Change Language', 'page-builder-wp' );?></option>
                                <option value="ar-SA">Arabic</option>
                                <option value="zh-CN">Chinese</option>
                                <option value="cs-CZ">Czech</option>
                                <option value="da-DK">Danish</option>
                                <option value="nl-NL">Dutch</option>
                                <option value="en-US">English</option>
                                <option value="fi-FI">Finnish</option>
                                <option value="fr-FR">French</option>
                                <option value="de-DE">German</option>
                                <option value="el-GR">Greek</option>
                                <option value="he-IL">Hebrew</option>
                                <option value="hu-HU">Hungarian</option>
                                <option value="id-ID">Indonesian</option>
                                <option value="it-IT">Italian</option>
                                <option value="ja-JP">Japanese</option>
                                <option value="ko-KR">Korean</option>
                                <option value="fa-IR">Persian</option>
                                <option value="pl-PL">Polish</option>
                                <option value="pt-PT">Portuguese</option>
                                <option value="ru-RU">Russian</option>
                                <option value="es-ES">Spanish</option>
                                <option value="sv-SE">Swedish</option>
                                <option value="th-TH">Thai</option>
                                <option value="tr-TR">Turkish</option>
                                <option value="vi-VN">Vietnamese</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="wpc-ai-prompt-action-cont">
                    <span
                        class="wpc-ai-prompt-button wpc-ai-action-new-prompt --ai-new-prompt wpc_click_fx"><?php esc_html_e( 'New prompt', 'page-builder-wp' );?></span>
                    <span
                        class="wpc-ai-prompt-button wpc-ai-action-usetext wpc_click_fx"><?php esc_html_e( 'Use text', 'page-builder-wp' );?></span>
                </div>
            </div>
            <!-- New prompt panel -->
            <div class="wpc-ai-prompt-panel wpc-ai-prompt-new">
                <span
                    class="wpc-ai-prompt-label"><?php esc_html_e( 'Give AI your instructions', 'page-builder-wp' );?>:</span>
                <div class="wpc-ai-input-prompt-cont">
                    <div class="wpc-ai-prompt-text">
                        <input type="text" class="wpc-ai-input-prompt wpc-ai-input-text wpc-ai-input-prompter">
                    </div>
                </div>
                <div class="wpc-ai-option-prompt-cont">
                    <div class="wpc-ai-option-suggest">
                        <span
                            class="wpc-ai-prompt-label"><?php esc_html_e( 'Suggested Prompts', 'page-builder-wp' );?>:</span>
                        <div class="wpc-ai-suggest-options">
                        </div>
                    </div>
                </div>
                <div class="wpc-ai-prompt-action-cont">
                    <span
                        class="wpc-ai-prompt-button wpc-ai-action-generate wpc_click_fx"><?php esc_html_e( 'Generate text', 'page-builder-wp' );?></span>
                </div>
            </div>
            <!-- New prompt panel -->
            <div class="wpc-ai-prompt-panel wpc-ai-prompt-code">
                <span
                    class="wpc-ai-prompt-label"><?php esc_html_e( 'Give AI your instructions', 'page-builder-wp' );?>:</span>
                <div class="wpc-ai-input-prompt-cont">
                    <div class="wpc-ai-prompt-textarea">
                        <textarea spellcheck="false"
                            class="wpc-ai-input-prompt wpc-ai-input-textarea wpc-ai-input-prompter"></textarea>
                    </div>
                </div>
                <div class="wpc-ai-option-prompt-cont">
                    <div class="wpc-ai-option-suggest">
                        <span
                            class="wpc-ai-prompt-label"><?php esc_html_e( 'Suggested Prompts', 'page-builder-wp' );?>:</span>
                        <div class="wpc-ai-suggest-options">
                        </div>
                    </div>
                </div>
                <div class="wpc-ai-prompt-action-cont">
                    <span
                        class="wpc-ai-prompt-button wpc-ai-action-generate wpc_click_fx"><?php esc_html_e( 'Generate Code', 'page-builder-wp' );?></span>
                </div>
            </div>
            <!-- AI connect panel -->
            <div class="wpc-ai-prompt-panel wpc-ai-prompt-connect">
                <div class="wpc-ai-prompt-action-connect">
                    <svg clip-rule="evenodd" fill-rule="evenodd" height="85" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 64 64" width="85" xmlns="http://www.w3.org/2000/svg">
                        <g id="share">
                            <path d="m19.106 30.683 27.577-13.789-1.789-3.577-27.577 13.789z" fill="#edebf1" />
                            <path d="m46.683 47.106-27.577-13.789-1.789 3.577 27.577 13.789z" fill="#edebf1" />
                            <g fill="#425b72">
                                <circle cx="12" cy="32" r="8" />
                                <circle cx="52" cy="12" r="8" />
                                <circle cx="52" cy="52" r="8" />
                            </g>
                        </g>
                    </svg>
                    <h3><?php esc_html_e( 'Unlock the Power of WP Composer AI', 'page-builder-wp' );?></h3>
                    <p><?php esc_html_e( 'Connect for free and unlock the power of Artificial Intelligence to enhance your site\'s performance and user experience.', 'page-builder-wp' );?>
                    </p>
                    <span data-connect-product="ai"
                        class="wpc-ai-prompt-button wpc-action-connect wpc_click_fx"><?php esc_html_e( 'Connect', 'page-builder-wp' );?></span>
                </div>
            </div>
            <!-- AI text2Image panel -->
            <div class="wpc-ai-prompt-panel wpc-ai-prompt-text2image">
                <div class="wpc-ai-input-prompt-cont wpc-ai-image-result">
                    <span
                        class="wpc-ai-prompt-label"><?php esc_html_e( 'Click on image to use', 'page-builder-wp' );?>:</span>
                    <div class="wpc-ai-image-result-cont">
                    </div>
                </div>
                <span
                    class="wpc-ai-prompt-label"><?php esc_html_e( 'Write any text that will inspire the AI to create your image', 'page-builder-wp' );?>:</span>
                <div class="wpc-ai-input-prompt-cont">
                    <div class="wpc-ai-prompt-textarea">
                        <textarea spellcheck="false"
                            class="wpc-ai-input-prompt wpc-ai-input-textarea wpc-ai-input-prompter wpc-ai-input-image-prompt"
                            maxlength="200"></textarea>
                    </div>
                </div>
                <div class="wpc-ai-option-prompt-cont">
                    <div class="wpc-ai-option-quick-actions">
                        <div class="wpc-ai-qa-options wpc-ai-qa-options-selectbox">
                            <div class="wpc-ai-model-selector-holder">
                                <select data-ai-image-props="style" class="wpc-ai-input-prompt wpc-ai-input-select">
                                    <option value="none" selected>
                                        <?php esc_html_e( 'Select image style', 'page-builder-wp' );?></option>
                                </select>
                            </div>
                            <select data-ai-image-props="size" class="wpc-ai-input-prompt wpc-ai-input-select">
                                <option selected="selected" value="none">
                                    <?php esc_html_e( 'Select image size', 'page-builder-wp' );?></option>
                                <option value="512"><?php esc_html_e( '512 x 512', 'page-builder-wp' );?></option>
                                <option value="1024"><?php esc_html_e( '1024 x 1024', 'page-builder-wp' );?></option>
                            </select>
                        </div>
                    </div>
                    <div class="wpc-ai-image-models">
                        <div class="wpc-ai-image-models-list">
                            <?php
$img_list = [ '3d_model', 'neon_punk', 'cinematic', 'digital_art', 'enhance', 'comic_book', 'anime', 'isometric', 'fantasy_art', 'origami', 'low_poly', 'line_art', 'modeling_compound', 'photographic', 'analog_film' ];

        foreach ( $img_list as $each ) {
            $model_name  = str_replace( '_', '-', $each );
            $model_title = str_replace( '-', ' ', $model_name );
            echo '<div data-model-name="'.esc_attr( $model_name ).'" class="wpc-ai-each-models"><img src="'.esc_url( pbwp_distribution_url( 'images/ai-img-models/'.esc_html( $each ).'.png' ) ).'" /><span class="model_label">'.esc_html( ucwords( $model_title ) ).'</span></div>';
        }
        ?>
                        </div>
                    </div>
                </div>
                <div class="wpc-ai-prompt-action-cont">
                    <span
                        class="wpc-ai-prompt-button wpc-ai-action-generate wpc_click_fx"><?php esc_html_e( 'Generate Image', 'page-builder-wp' );?></span>
                </div>
            </div>
            <!-- Close button, abort button and loader -->
            <i class="wpc-ai-prompt-close wpc-app-ai-close wpc_click_fx"></i>
            <div class="wpc_ai_loader_cont"><i class="wpc_ai_loader wpc_ai_action_loader"></i><span
                    class="wpc-button-flat wpc-button-color-red wpc-button-size-small wpc_click_fx wpc_ai_abort"><?php esc_html_e( 'Abort', 'page-builder-wp' );?></span>
            </div>
        </div>
    </div>

    <!-- Transform Maker main markup -->
    <div class="app_transform_markup">
        <!-- Default markup -->
        <div data-markup-mode="default">
            <div class="wpc-app-transform-wrapper">
                <div class="wpc-app-transform-container">
                    <div class="wpc-app-transform-hr"></div>
                    <div class="wpc-app-transform-vr"></div>
                    <div class="wpc-app-transform-square-dotted"></div>
                </div>
                <div class="wpc-app-transform-vertical-range">
                    <div class="wpc-app-option-inner wpc-app-option-inner-range">
                        <div class="wpc-app-option-inputs-wrap"><input id="range-vertical" type="range" min="0"
                                max="100" step="1" class="wpc-app-range">
                            <div class="wpc-app-option-inputs-cont">
                                <div class="option__input_markup app-field-number"><input max="9999" min="-9999"
                                        value="" data-self-previewer="true" class="option-input" type="text"
                                        placeholder="0">
                                    <div class="quantity-nav">
                                        <div class="quantity-button quantity-up">+</div>
                                        <div class="quantity-button quantity-down">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wpc-app-transform-horizontal-range">
                    <div class="wpc-app-option-inner wpc-app-option-inner-range">
                        <div class="wpc-app-option-inputs-wrap"><input id="range-horizontal" type="range" min="0"
                                max="100" step="1" class="wpc-app-range">
                            <div class="wpc-app-option-inputs-cont">
                                <div class="option__input_markup app-field-number"><input max="9999" min="-9999"
                                        value="" data-self-previewer="true" class="option-input" type="text"
                                        placeholder="0">
                                    <div class="quantity-nav">
                                        <div class="quantity-button quantity-up">+</div>
                                        <div class="quantity-button quantity-down">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty Mode -->
        <div data-markup-mode="empty">
            <div class="wpc-app-transform-wrapper">
                <div class="wpc-app-transform-container"></div>
            </div>
        </div>

        <div class="transform_props">
            <!-- Center square -->
            <div class="center_square">
                <div class="wpc-app-transform-square">
                </div>
            </div>

            <!-- Drag handle square -->
            <div class="drag_handle_square">
                <div class="wpc-app-transform-square-translate wpc-app-transform-previewer"
                    data-transform-type="translate"></div>
            </div>

            <!-- Drag arrow -->
            <div class="square_half">
                <div class="wpc-app-transform-square-half">
                    <div class="wpc-app-transform-controller handle_scale_xy ui-resizable-handle ui-resizable-ne"
                        data-transform-type="scale_xy"><svg viewBox="0 0 14 14" preserveAspectRatio="xMidYMid meet"
                            shape-rendering="geometricPrecision">
                            <path fill="#FFFFFF"
                                d="M10 3H6.51a.51.51 0 0 0-.36.86l1.27 1.3-2.28 2.29-1.28-1.28a.51.51 0 0 0-.86.36V10a1 1 0 0 0 1 1h3.49a.51.51 0 0 0 .36-.86l-1.3-1.3 2.29-2.26 1.3 1.3a.51.51 0 0 0 .86-.36V4a1 1 0 0 0-1-1z"
                                fill-rule="evenodd"></path>
                        </svg></div>
                    <div class="wpc-app-transform-controller handle_scale_y ui-resizable-handle ui-resizable-n"
                        data-transform-type="scale_y"><svg viewBox="0 0 14 14" preserveAspectRatio="xMidYMid meet"
                            shape-rendering="geometricPrecision">
                            <path fill="#FFFFFF"
                                d="M9.79 9H8V5h1.79a.5.5 0 0 0 .35-.85L7.71 1.73a1 1 0 0 0-1.41 0L3.85 4.17a.5.5 0 0 0 .36.83H6v4H4.21a.5.5 0 0 0-.35.85l2.44 2.44a1 1 0 0 0 1.41 0l2.44-2.44A.5.5 0 0 0 9.79 9z"
                                fill-rule="evenodd"></path>
                        </svg></div>
                    <div></div>
                </div>
                <div class="wpc-app-transform-square-half">
                    <div class="wpc-app-transform-controller handle_scale_x ui-resizable-handle ui-resizable-e"
                        data-transform-type="scale_x"><svg viewBox="0 0 14 14" preserveAspectRatio="xMidYMid meet"
                            shape-rendering="geometricPrecision">
                            <path fill="#FFFFFF"
                                d="M12.29 6.29L9.85 3.85a.5.5 0 0 0-.85.36V6H5V4.21a.5.5 0 0 0-.85-.35L1.71 6.29a1 1 0 0 0 0 1.41l2.44 2.44A.5.5 0 0 0 5 9.79V8h4v1.79a.5.5 0 0 0 .85.35l2.44-2.44a1 1 0 0 0 0-1.41z"
                                fill-rule="evenodd"></path>
                        </svg></div>
                </div>
            </div>

            <!-- Rotate -->
            <div class="rotate_handle">
                <div class="transform_rotate_group">
                    <div class="transform_rotate_knob"><input type="text" class="rotate_knob" data-min="0"
                            data-max="360" data-rotate-key="rotateZ" data-width="85%"><label
                            class="transform_rotate_label"><?php esc_html_e( 'Rotate Z', 'page-builder-wp' );?></label>
                    </div>
                    <div class="transform_rotate_knob"><input type="text" class="rotate_knob" data-min="0"
                            data-max="360" data-rotate-key="rotateX" data-width="85%"><label
                            class="transform_rotate_label"><?php esc_html_e( 'Rotate X', 'page-builder-wp' );?></label>
                    </div>
                    <div class="transform_rotate_knob"><input type="text" class="rotate_knob" data-min="0"
                            data-max="360" data-rotate-key="rotateY" data-width="85%"><label
                            class="transform_rotate_label"><?php esc_html_e( 'Rotate Y', 'page-builder-wp' );?></label>
                    </div>
                </div>
            </div>

            <!-- Origin handle -->
            <div class="origin_handle">
                <div class="wpc-app-transform-square-origin"></div>
                <div class="wpc-app-transform-square-transparent-origin">
                    <div class="wpc-app-transform-square-half half-start">
                        <div class="wpc-app-transform-origin-controller" data-origin-type="1"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="2"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="3"></div>
                    </div>
                    <div class="wpc-app-transform-square-half half-center">
                        <div class="wpc-app-transform-origin-controller" data-origin-type="4"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="5"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="6"></div>
                    </div>
                    <div class="wpc-app-transform-square-half half-end">
                        <div class="wpc-app-transform-origin-controller" data-origin-type="7"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="8"></div>
                        <div class="wpc-app-transform-origin-controller" data-origin-type="9"></div>
                    </div>
                </div>
            </div>

            <!-- Origin dot handle -->
            <div class="origin_dot_handle">
                <div class="wpc-app-transform-origin-dot wpc-app-transform-previewer" data-transform-type="origin">
                </div>
            </div>

            <!-- Linked button -->
            <div class="linked_button">
                <button class="wpc-app-transform-linked">
                    <div data-switch="linked" class="wpc-app-icon state-linked-unlinked wpc-app-icon--linked"><svg
                            viewBox="0 0 28 28" preserveAspectRatio="xMidYMid meet"
                            shape-rendering="geometricPrecision">
                            <g>
                                <path
                                    d="M8 14a1 1 0 0 1 0 2h-.5A2.5 2.5 0 0 1 5 13.5v-2A2.5 2.5 0 0 1 7.5 9h8a2.5 2.5 0 0 1 2.5 2.5v2a2.5 2.5 0 0 1-2.5 2.5H15a1 1 0 0 1 0-2h.5a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5z"
                                    fill-rule="evenodd"></path>
                                <path
                                    d="M20 14a1 1 0 0 1 0-2h.5a2.5 2.5 0 0 1 2.5 2.5v2a2.5 2.5 0 0 1-2.5 2.5h-8a2.5 2.5 0 0 1-2.5-2.5v-2a2.5 2.5 0 0 1 2.5-2.5h.5a1 1 0 0 1 0 2h-.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5z"
                                    fill-rule="evenodd"></path>
                            </g>
                        </svg></div>
                    <div data-switch="unlinked" class="wpc-app-icon state-linked-unlinked wpc-app-icon--unlinked"><svg
                            viewBox="0 0 28 28" preserveAspectRatio="xMidYMid meet"
                            shape-rendering="geometricPrecision">
                            <g>
                                <path
                                    d="M16.75 9.14a1 1 0 0 1 .37 1.39l-4.5 8a1 1 0 0 1-1.37.37 1 1 0 0 1-.37-1.39l4.5-8a1 1 0 0 1 1.37-.37zM19.71 10H20a3 3 0 0 1 3 3v2a3 3 0 0 1-3 3h-4.81l1.13-2H20a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-1.42zM12.81 10l-1.13 2H8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h1.42l-1.13 2H8a3 3 0 0 1-3-3v-2a3 3 0 0 1 3-3z"
                                    fill-rule="evenodd"></path>
                            </g>
                        </svg></div>
                </button>
            </div>

            <!-- Input rotate -->
            <div class="input_rotate">
                <div class="wpc-app-transform-rotate-range-cont wpc-app-rotate-input">
                    <div class="wpc-app-transform-rotate-range">
                        <div class="wpc-app-option-inner wpc-app-option-inner-range">
                            <div class="wpc-app-option-inputs-wrap"><input id="range-rotate-z" type="range" min="0"
                                    max="100" step="1" class="wpc-app-range">
                                <div class="wpc-app-option-inputs-cont">
                                    <div class="option__input_markup app-field-number"><input max="9999" min="-9999"
                                            value="" data-self-previewer="true" class="option-input" type="text"
                                            placeholder="0">
                                        <div class="quantity-nav">
                                            <div class="quantity-button quantity-up">+</div>
                                            <div class="quantity-button quantity-down">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wpc-app-transform-rotate-range">
                        <div class="wpc-app-option-inner wpc-app-option-inner-range">
                            <div class="wpc-app-option-inputs-wrap"><input id="range-rotate-x" type="range" min="0"
                                    max="100" step="1" class="wpc-app-range">
                                <div class="wpc-app-option-inputs-cont">
                                    <div class="option__input_markup app-field-number"><input max="9999" min="-9999"
                                            value="" data-self-previewer="true" class="option-input" type="text"
                                            placeholder="0">
                                        <div class="quantity-nav">
                                            <div class="quantity-button quantity-up">+</div>
                                            <div class="quantity-button quantity-down">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wpc-app-transform-rotate-range">
                        <div class="wpc-app-option-inner wpc-app-option-inner-range">
                            <div class="wpc-app-option-inputs-wrap"><input id="range-rotate-y" type="range" min="0"
                                    max="100" step="1" class="wpc-app-range">
                                <div class="wpc-app-option-inputs-cont">
                                    <div class="option__input_markup app-field-number"><input max="9999" min="-9999"
                                            value="" data-self-previewer="true" class="option-input" type="text"
                                            placeholder="0">
                                        <div class="quantity-nav">
                                            <div class="quantity-button quantity-up">+</div>
                                            <div class="quantity-button quantity-down">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Position main markup -->
    <div class="app_position_markup">
        <!-- Panel Position Relative -->
        <div class="tpl-position-relative">
            <div class="app-position-controls">
                <div class="app-position-controls-top">
                    <div class="app-position-control" data-origin-type="top_left"></div>
                    <div class="app-position-control" data-origin-type="top_right">
                    </div>
                </div>
                <div class="app-position-controls-bottom">
                    <div class="app-position-control" data-origin-type="bottom_left">
                    </div>
                    <div class="app-position-control" data-origin-type="bottom_right"></div>
                </div>
            </div>
        </div>
        <!-- Panel Position Absolute -->
        <div class="tpl-position-absolute tpl-position-fixed">
            <div class="app-position-controls">
                <div class="app-position-controls-top">
                    <div class="app-position-control" data-origin-type="top_left">
                    </div>
                    <div class="app-position-control" data-origin-type="top_center">
                    </div>
                    <div class="app-position-control" data-origin-type="top_right">
                    </div>
                </div>
                <div class="app-position-controls-mid">
                    <div class="app-position-control" data-origin-type="center_left">
                    </div>
                    <div class="app-position-control" data-origin-type="center_center"></div>
                    <div class="app-position-control" data-origin-type="center_right"></div>
                </div>
                <div class="app-position-controls-bottom">
                    <div class="app-position-control" data-origin-type="bottom_left">
                    </div>
                    <div class="app-position-control" data-origin-type="bottom_center"></div>
                    <div class="app-position-control" data-origin-type="bottom_right"></div>
                </div>
            </div>
        </div>
        <!-- Another additional element -->
        <div class="line_guide_element">
            <div class="app-position-line-guide">
                <div class="app-position-hr"></div>
                <div class="app-position-vr"></div>
            </div>
        </div>
        <div class="pos_position_select">
            <div class="app-position-option_wrap __select_opt"><label class="app-position-label"
                    for="Position"><?php esc_html_e( 'Position', 'page-builder-wp' );?></label>
                <div class="app-position-each-option-wrap">
                    <!-- Avoiding translation for CSS property names -->
                    <select class="pos_select_opt">
                        <option value="default">Default</option>
                        <option value="relative">Relative</option>
                        <option value="absolute">Absolute</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="pos_slider_panel">
            <div data-offset-type="vertical" class="app-position-option_wrap"><label class="app-position-option_label"
                    for="Vertical Offset"><?php esc_html_e( 'Vertical Offset', 'page-builder-wp' );?></label>
                <div class="app-position-each-option-wrap app-position-option_slider_wrap">
                    <div class="app-position-option_slider"><input
                            class="position_slider_opt __v_offset_opt wpc_rangeslider_opt" type="range" min="-1000"
                            max="1000" step="1" value="" data-option-key="y">
                    </div>
                </div>
            </div>
            <div data-offset-type="horizontal" class="app-position-option_wrap"><label class="app-position-option_label"
                    for="Horizontal Offset"><?php esc_html_e( 'Horizontal Offset', 'page-builder-wp' );?></label>
                <div class="app-position-each-option-wrap app-position-option_slider_wrap">
                    <div class="app-position-option_slider"><input
                            class="position_slider_opt __h_offset_opt wpc_rangeslider_opt" type="range" min="-1000"
                            max="1000" step="1" value="" data-option-key="x">
                    </div>
                </div>
            </div>
            <div class="app-position-option_wrap"><label class="app-position-option_label" for="Z Index">Z
                    Index</label>
                <div class="app-position-each-option-wrap app-position-option_slider_wrap">
                    <div class="app-position-option_slider"><input
                            class="position_slider_opt __zIndex_opt wpc_rangeslider_opt" type="range" min="-500"
                            max="500" step="1" value="" data-option-key="zIndex">
                    </div>
                </div>
            </div>
        </div>
        <div class="pos_slider_tooltip">
            <div class="vue-slider-dot-tooltip vue-slider-dot-tooltip-top">
                <div class="vue-slider-dot-tooltip-inner vue-slider-dot-tooltip-inner-top"><span
                        class="vue-slider-dot-tooltip-text slider-dot-text"></span></div>
            </div>
        </div>
    </div>

    <!-- WP Composer Apps Setting Fields -->
    <div class="wpc-app-fields-props">

        <div class="wpc-app-fields-slider" data-field-type="slider">
            <div class="wpc-app-option_wrap wpc-app-input-type-slider"><label class="wpc-app-option_label"></label>
                <div class="wpc-app-each-option_wrap">
                    <div class="wpc-app-each-option">
                        <input class="wpc_rangeslider_opt wpc-app-input-value" type="range" min="0" max="100" step="1"
                            value="" data-option-key="">
                    </div>
                </div>
            </div>
        </div>

        <div class="wpc-app-fields-slider-tooltip">
            <div class="vue-slider-dot-tooltip vue-slider-dot-tooltip-top">
                <div class="vue-slider-dot-tooltip-inner vue-slider-dot-tooltip-inner-top"><span
                        class="vue-slider-dot-tooltip-text slider-dot-text"></span></div>
            </div>
        </div>

        <div class="wpc-app-fields-colorpicker" data-field-type="colorpicker">
            <div class="wpc-app-option_wrap wpc-app-input-type-colorpicker"><label class="wpc-app-option_label"></label>
                <div class="wpc-app-each-option_wrap">
                    <div class="wpc-app-each-option">
                        <input readonly name="" value="" placeholder="Select color"
                            class="wpc-css-color-param wpc-app-input-value" autocomplete="off" type="search">
                    </div>
                </div>
            </div>
        </div>

        <div class="wpc-app-fields-select" data-field-type="select">
            <div class="wpc-app-option_wrap wpc-app-input-type-select"><label class="wpc-app-option_label"></label>
                <div class="wpc-app-each-option_wrap">
                    <div class="wpc-app-each-option">
                        <select class="wpc-app-field-select wpc-app-input-value"></select>
                    </div>
                </div>
            </div>
        </div>

        <div class="wpc-app-fields-switch" data-field-type="switch">
            <div class="wpc-app-option_wrap wpc-app-input-type-switch"><label class="wpc-app-option_label"></label>
                <div class="wpc-app-each-option_wrap">
                    <div class="wpc-app-each-option">
                        <input class="ios field-switch-cbox wpc-app-input-value" type="checkbox" />
                        <div class="wpc-ios-ui-select field-switch-handle wpc-app-switch-handle">
                            <div class="inner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Pro Pricing -->
    <div class="wpc_pricing_table_cont">
        <div class="wpc-pricing-table">
            <div class="wpc-pricing-column">
                <div class="wpc-pricing-header">
                    <span><?php esc_html_e( 'PRO', 'page-builder-wp' );?></span>
                </div>
                <div class="wpc-pricing-price">$35</div>
                <ul class="wpc-pricing-features">
                    <li><?php esc_html_e( '1 Site', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Regular Update', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Support 24/7', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Premium Items', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Layout Packs', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Online Templates', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'All Advanced Features', 'page-builder-wp' );?></li>
                </ul>
                <span data-href="https://wpcomposer.com/order.php?product=pro"
                    class="wpc-pricing-button wpc-button-flat wpc-button-size-sm"><?php esc_html_e( 'Upgrade Now', 'page-builder-wp' );?></span>
            </div>
            <div class="wpc-pricing-column">
                <div class="wpc-pricing-header">
                    <span><?php esc_html_e( 'PRO', 'page-builder-wp' );?> +</span>
                </div>
                <div class="wpc-pricing-price">$95</div>
                <ul class="wpc-pricing-features">
                    <li><?php esc_html_e( '3 Sites', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Regular Update', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Support 24/7', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Premium Items', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Layout Packs', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'Online Templates', 'page-builder-wp' );?></li>
                    <li><?php esc_html_e( 'All Advanced Features', 'page-builder-wp' );?></li>
                </ul>
                <span data-href="https://wpcomposer.com/order.php?product=proplus"
                    class="wpc-pricing-button wpc-button-flat wpc-button-size-sm"><?php esc_html_e( 'Upgrade Now', 'page-builder-wp' );?></span>
            </div>
        </div>
    </div>

    <?php

        // WooCommerce Support

        if ( function_exists( 'pbwp_woocommerce_fields' ) ) {

            echo wp_kses( pbwp_woocommerce_fields(), pbwp_wp_kses_allowed_html() );

        }

        echo "</div>\n";

        $thePanel = ob_get_clean();
        echo wp_kses( $thePanel, pbwp_wp_kses_allowed_html() );

    }

    /**
     * Default Column Lists
     * @return markup
     * @access public
     */
    public function columnLists( $return = false )
    {

        ob_start();
        ?>

    <div class="wpc_bottom_column_options_cont wpc_bottom_columns_markup">
        <span class="wpc_bottom_column_options_note"><?php esc_html_e( 'Add another row', 'page-builder-wp' );?></span>
        <div class="wpc_bottom_column_options"><i data-col-number="1" data-cells="1-1" class="wpc-if-1-1"
                title="1/1"></i><i data-col-number="2" data-cells="1-2_1-2" class="wpc-if-1-2_1-2"
                title="1/2 + 1/2"></i><i data-col-number="3" data-cells="1-3_1-3_1-3" class="wpc-if-1-3_1-3_1-3"
                title="1/3 + 1/3 + 1/3"></i><i data-col-number="3" data-cells="1-4_1-2_1-4" class="wpc-if-1-4_1-2_1-4"
                title="1/4 + 1/2 + 1/4"></i><i data-col-number="4" data-cells="1-4_1-4_1-4_1-4"
                class="wpc-if-1-4_1-4_1-4_1-4" title="1/4 + 1/4 + 1/4 + 1/4"></i><i data-col-number="2"
                data-cells="1-4_3-4" class="wpc-if-1-4_3-4" title="1/4 + 3/4"></i><i data-col-number="4"
                data-cells="1-6_1-6_1-6_1-2" class="wpc-if-1-6_1-6_1-6_1-2" title="1/6 + 1/6 + 1/6 + 1/2"></i><i
                data-col-number="6" data-cells="1-6_1-6_1-6_1-6_1-6_1-6" class="wpc-if-1-6_1-6_1-6_1-6_1-6_1-6"
                title="1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6"></i><i data-col-number="3" data-cells="1-6_2-3_1-6"
                class="wpc-if-1-6_2-3_1-6" title="1/6 + 2/3 + 1/6"></i><i data-col-number="2" data-cells="2-3_1-3"
                class="wpc-if-2-3_1-3" title="2/3 + 1/3"></i><i data-col-number="2" data-cells="5-6_1-6"
                class="wpc-if-5-6_1-6" title="5/6 + 1/6"></i></div>
    </div>

    <?php
$cols = ob_get_clean();

        if ( $return ) {
            return $cols;
        }

        echo wp_kses_post( $cols );

    }

}