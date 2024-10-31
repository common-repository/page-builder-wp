<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PBWP_Rest_Api_Callback
{

    public function __construct()
    {
    }

    /**
     * Data Management
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function data( WP_REST_Request $req )
    {

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'backup':

                $dataToBk = get_post_meta( $data->id, 'wp_composer', true );

                if ( $dataToBk && trim( $dataToBk ) == 'eyJnbG9iYWwiOnsiY29uZmlnIjp7Imdsb2JhbF9zYXZlX2V4cGNvbGwiOiJ5ZXMiLCJnbG9iYWxfZGlzYWJsZV93cGMiOiJubyJ9LCJiYWNrdXBzIjpbXX0sImJ1aWxkZXIiOltdfQ==' ) {
                    wp_send_json( [ 'status' => 'no_data' ] );
                    wp_die();
                }

                $backupname = ( isset( $data->postTitle ) ? $data->postTitle : esc_html( PBWP_NAME ) );
                $backupname = preg_replace( '/[^a-zA-Z0-9]+/', '_', $backupname );
                $json_name  = strtoupper( $backupname ).'_'.gmdate( 'd_m_Y_His' ); // Namming the filename will be generated.

                set_transient( $json_name, $dataToBk, 1 * MINUTE_IN_SECONDS );

                $backup_uri = $data->ajaxurl.'/'.wp_create_nonce( 'wpc_ajax_nonce' ).'/'.$json_name.'/'.base64_encode( 'WPComposer' );

                wp_send_json( [ 'status' => $backup_uri ] );

                break;

            case 'restore':
                /* Decode data */
                $dataTo = $this->pbwp_decode_encode_data( $data->data, 'decode' );

                if ( isset( $dataTo[ 'signature' ] ) && $dataTo[ 'signature' ] == 'WPComposer' ) {

                    if ( ! pbwp_css_route_check( $dataTo[ 'data' ] ) ) {

                        $dataTo[ 'data' ] = pbwp_data_upgrade( $dataTo[ 'data' ], $data->id, 'css' );

                    }

                    // Need to check and update the item options that use group mode format
                    if ( ! class_exists( 'PBWP_Upgrade_Mapper' ) ) {
                        require_once pbwp_manager()->path( 'GLOBAL_DIR', 'class-wpc-upgrade-mapper.php' );
                    }

                    $mapper           = new PBWP_Upgrade_Mapper;
                    $dataTo[ 'data' ] = $mapper->upgradeOptionsFormat( $dataTo[ 'data' ] );
                    /* Update data */
                    $newData = $this->pbwp_decode_encode_data( $dataTo[ 'data' ] );
                    $this->pbwp_update_data( $newData, $data->id );

                } else {
                    /* The file signature is wrong */
                    wp_send_json( [ 'status' => 'backup_err' ] );
                    wp_die();

                }

                break;

            case 'reset':

                $default = [
                    'global'  => [ 'config' => [ 'global_save_expcoll' => 'yes', 'global_disable_wpc' => 'no', 'global_fullwidth' => 'no', 'global_layout' => get_post_meta( $data->id, '_wp_page_template', true ), 'global_css' => null ], 'backups' => [  ] ],
                    'builder' => [  ],
                 ];

                /* Update data */
                $default = $this->pbwp_decode_encode_data( $default );
                $this->pbwp_update_data( $default, $data->id );

                break;

            case 'update_opt':
                /* Get data */
                $mainData = $this->pbwp_get_data( $data->id, true );
                /* Update each data */
                $toUpdate = $data->data;

                $mainData[ 'global' ][ 'config' ][ $toUpdate[ 'key' ] ] = esc_html( $toUpdate[ 'value' ] );

                /* Update data */
                $newData = $this->pbwp_decode_encode_data( $mainData );
                $this->pbwp_update_data( $newData, $data->id );

                break;

            case 'wpc_get_post_data':

                $post_meta = get_post_meta( $data->postID, 'wp_composer', true );

                wp_send_json( $post_meta );

                break;

            case 'saveData':

                /* Main data */
                $base = $data->base;
                /* Update data */
                $this->pbwp_update_data( $data->base, $data->postID );
                /* Decode main data */
                $base = $this->pbwp_decode_encode_data( $data->base, 'decode' );

                if ( isset( $data->isGlobal ) && $data->isGlobal ) {

                    if ( isset( $base[ 'global' ][ 'config' ][ 'global_layout' ] ) && $base[ 'global' ][ 'config' ][ 'global_layout' ] !== '' ) {
                        update_post_meta( $data->postID, '_wp_page_template', $base[ 'global' ][ 'config' ][ 'global_layout' ] );
                    }

                }

                if ( isset( $data->markupOnly ) && $data->markupOnly && isset( $data->itemMainData ) && is_array( $data->itemMainData ) ) {

                    $markup             = '';
                    $additionalItems    = [  ];
                    $data->itemMainData = (object) $data->itemMainData;
                    $custom_data        = [ 'global' => $base[ 'global' ],
                        'builder'                        => [ $base[ 'builder' ][ $data->itemMainData->rowIndex ] ],
                     ];

                    // If this type is row, we need to check is there any rowInner inside, if exist then add to builder to get their own config
                    if ( $data->itemMainData->type == 'row' ) {

                        // Need to set true to generate all item styles inside this row (if item type is row)
                        $data->itemMainData->generateAll = true;

                        $markup = pbwp_generate_rows( $custom_data[ 'builder' ], false, false, $data->postID );

                        if ( ! function_exists( 'pbwp_get_option' ) ) {
                            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                        }

                        $row_inner = pbwp_get_inner_row( $data->itemMainData->id, $data->postID );

                        if ( ! empty( $row_inner ) ) {

                            foreach ( $row_inner as $inner ) {
                                $inner_index                  = array_search( $inner, array_column( $base[ 'builder' ], 'id' ) );
                                $custom_data[ 'builder' ][  ] = $base[ 'builder' ][ $inner_index ];
                            }

                        }

                    } else {

                        $markup = pbwp_generate_items( $data->itemMainData, true );

                        if ( isset( $data->addItems ) ) {

                            foreach ( $data->addItems as $eachItem ) {

                                $itemData = (object) $eachItem;

                                $additionalItems[  ] = [
                                    'markup'        => wp_json_encode( pbwp_generate_items( $itemData, true ) ),
                                    'inlineData'    => wp_json_encode( pbwp_frontend_render_css( $itemData, false, $custom_data ) ),
                                    'id'            => $itemData->id,
                                    'original_type' => $itemData->type,
                                    'type'          => ( $itemData->type == 'tab' ? 'item' : $itemData->type ),
                                    'columnID'      => $itemData->columnID,
                                 ];
                            }

                        }

                    }

                    if ( isset( $data->itemMainData->isRowInner ) ) {
                        $data->itemMainData->generateAll = true;
                        $inner_index                     = array_search( $data->itemMainData->isRowInner, array_column( $base[ 'builder' ], 'id' ) );
                        $custom_data[ 'builder' ][  ]    = $base[ 'builder' ][ $inner_index ];
                    }

                    $cssData = [
                        'markup'        => wp_json_encode( $markup ),
                        'inlineData'    => wp_json_encode( pbwp_frontend_render_css( $data->itemMainData, false, $custom_data ) ),
                        'id'            => $data->itemMainData->id,
                        'original_type' => $data->itemMainData->type,
                        'type'          => ( $data->itemMainData->type == 'tab' ? 'item' : $data->itemMainData->type ),
                     ];

                    if ( $additionalItems ) {
                        $cssData[ 'addItems' ] = $additionalItems;
                    }

                    wp_send_json( $cssData );

                } else

                if ( ! isset( $data->markupOnly ) && isset( $data->itemMainData ) && is_array( $data->itemMainData ) ) {

                    if ( $data->itemMainData[ 'type' ] == 'row' ) {
                        $data->itemMainData[ 'includeColums' ] = true;
                    }

                    wp_send_json( pbwp_frontend_generate_content( $data->itemMainData ) );
                } else {
                    wp_send_json( [ 'cmd' => $data->action ] );
                }

                break;

            case 'cancelEdit':

                if ( isset( $data->itemProp ) && $data->itemProp ) {
                    // Decode restorableData
                    $newData = $this->pbwp_decode_encode_data( $data->base, 'decode' );

                    if ( $data->itemProp[ 'type' ] === 'row' || $data->itemProp[ 'type' ] === 'column' || $data->itemProp[ 'type' ] === 'item' ) {
                        $mainData = $this->pbwp_update_item_data( $data->itemProp[ 'type' ], $data->postID, $data->itemProp, $newData, true );
                    } else {
                        wp_send_json( [ 'status' => $data->action.'_done' ] );
                        wp_die();
                    }

                    /* Update data */
                    $this->pbwp_update_data( $mainData, $data->postID );

                    wp_send_json( pbwp_frontend_generate_content( $data->itemProp ) );

                } else {

                    wp_send_json( [ 'cmd' => $data->action ] );

                }

                break;

            default:
                break;

        }

        wp_send_json( [ 'status' => $data->action.'_done' ] );

        wp_die();

    }

    /**
     * Builder Management
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function builder( $req )
    {

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'render':

                $default = [
                    'global'  => [ 'config' => [ 'global_save_expcoll' => 'yes', 'global_disable_wpc' => 'no', 'global_fullwidth' => 'no', 'global_layout' => get_post_meta( $data->postID, '_wp_page_template', true ), 'global_css' => null ], 'backups' => [  ] ],
                    'builder' => [  ],
                 ];

                $default = $this->pbwp_decode_encode_data( $default );

                $post_meta = get_post_meta( $data->postID, 'wp_composer', true );

                if ( $post_meta ) {
                    $post_meta = $post_meta;
                } else {
                    /* Need to save the first row */
                    $post_meta = $default;
                    $this->pbwp_update_data( $post_meta, $data->postID );

                }

                if ( ! class_exists( 'PBWP_Markup_Creator' ) ) {
                    require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
                }

                $create = new PBWP_Markup_Creator();

                $markup = $create->editorBlock( $post_meta );

                $response = [
                    'base'   => $post_meta,
                    'markup' => $markup,
                 ];

                wp_send_json( $response );

                break;

            case 'install_template':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $data     = $this->pbwp_decode_encode_data( $data->templateData, 'decode' );
                $template = (object) $data;

                $wpc_params = [
                    'action' => 'get',
                    'data'   => $data,
                 ];

                $result = (object) pbwp_apply_templates( $wpc_params );

                if ( isset( $template->saveOnly ) && $template->saveOnly ) {
                    wp_send_json( [ 'success' => true, 'saveOnly' => true, 'my_templates' => pbwp_render_templates( true ) ] );
                } else {
                    /* Update data */
                    $newData = $this->pbwp_decode_encode_data( $result->data );
                    $this->pbwp_update_data( $newData, $template->post_id );
                    /* Send result */
                    wp_send_json( [ 'success' => true, 'fonts' => ( $result->render_fonts ? base64_encode( wp_json_encode( pbwp_get_option( 'user_fonts' ) ) ) : false ), 'type' => $result->type, 'base' => $newData ] );
                }

                break;

            case 'scan_pages':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                include_once ABSPATH.'wp-admin/includes/theme.php';
                include_once ABSPATH.'wp-admin/includes/template.php';

                $default_title = apply_filters( 'default_page_template_title', esc_html__( 'Default Layout', 'page-builder-wp' ), 'meta-box' );
                $status        = 'none';

                global $wpdb;
                $meta_key = 'wp_composer';

                $all_pages = wp_cache_get( 'pbwp_all_pages' );

                if ( false === $all_pages ) {
                    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
                    $all_pages = $wpdb->get_results( $wpdb->prepare( "SELECT post_id, post_title, post_type FROM $wpdb->postmeta INNER JOIN $wpdb->posts ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE meta_key = %s",
                        $meta_key ), ARRAY_A );
                    wp_cache_set( 'pbwp_all_pages', $all_pages );
                }

                $wpc_pages = [  ];

                foreach ( $all_pages as $k => $pg ) {

                    if ( isset( $pg[ 'post_id' ] ) ) {

                        if ( ! pbwp_is_has_row( $pg[ 'post_id' ] ) ) {
                            unset( $all_pages[ $k ] );
                            continue;
                        }

                        $tpl = get_post_meta( $pg[ 'post_id' ], '_wp_page_template', true );

                        if ( $tpl == '' ) {
                            $tpl = 'default';
                        }

                        ob_start();
                        ?>
                                            <select class="each_page_tpl_selector" data-tpl-id="<?php echo esc_attr( $pg[ 'post_id' ] ); ?>">
                                                <option value="default"><?php echo esc_html( $default_title ); ?></option>
                                                <?php page_template_dropdown( $tpl, $pg[ 'post_type' ] );?>
                                            </select>
                                            <?php

                        $tpls = ob_get_clean();

                        $all_pages[ $k ][ 'tpl_selector' ] = $tpls;

                        $wpc_pages[  ] = [ 'post_id' => $pg[ 'post_id' ], 'post_type' => $pg[ 'post_type' ], 'post_title' => $pg[ 'post_title' ], 'template' => $tpl ];

                    } else {
                        unset( $all_pages[ $k ] );
                    }

                }

                if ( count( $all_pages ) > 0 ) {
                    $all_pages = array_values( $all_pages );
                }

                /* Update data */
                pbwp_update_option( 'user_wpc_pages', $wpc_pages );

                if ( ! empty( $wpc_pages ) ) {
                    $status = 'pages_available';
                }

                wp_send_json( [ 'status' => $status, 'pagesData' => $all_pages ] );

                break;

            case 'remove':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $pages = pbwp_get_option( 'user_wpc_pages' );
                /* Remove meta from page */
                delete_post_meta( $data->id, 'wp_composer' );

                foreach ( $pages as $k => $pg ) {

                    if ( isset( $pg[ 'post_id' ] ) && $pg[ 'post_id' ] == $data->id ) {
                        /* Remove page from pages data if ID match */
                        unset( $pages[ $k ] );
                        /* Re-index */
                        $pages = array_values( $pages );
                        /* Update pages data */
                        pbwp_update_option( 'user_wpc_pages', $pages );
                        /* Send info */
                        wp_send_json( [ 'status' => 'removed' ] );
                        break;
                    }

                }

                wp_send_json( [ 'status' => 'failed' ] );

                break;

            case 'update_template':

                if ( isset( $data->id ) && isset( $data->template ) ) {

                    update_post_meta( $data->id, '_wp_page_template', $data->template );

                    wp_send_json( [ 'status' => 'changed' ] );

                }

                break;

            case 'get_template_list':

                include_once ABSPATH.'wp-admin/includes/theme.php';
                include_once ABSPATH.'wp-admin/includes/template.php';

                if ( isset( $data->id ) && isset( $data->template ) ) {

                    $currentTPL = ( $data->template == 'none' || $data->template == '' ? get_post_meta( $data->id, '_wp_page_template', true ) : $data->template );

                    ob_start();

                    page_template_dropdown( $currentTPL, get_post_type( $data->id ) );

                    $tpl_list = ob_get_clean();

                    wp_send_json( [ 'templates' => $tpl_list ] );

                }

                break;

            default:
                break;

        }

        wp_die();

    }

    /**
     * Elements Management
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function element( WP_REST_Request $req )
    {

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'add_row':

                $newRow = $this->add_row( $data );
                wp_send_json( $newRow );
                wp_die();

                break;

            case 'add_item':

                $newItem = $this->add_item( $data );
                wp_send_json( $newItem );
                wp_die();

                break;

            default:
                break;

        }

        wp_die();

    }

    /**
     * Row Management
     *
     * @since 1.0.0
     * @access public
     *
     * @param $int, $int
     *
     * @return array
     */

    public function add_row( $data, $innerOf = '' )
    {

        $postID   = $data->postID;
        $rowProps = isset( $data->props ) ? (object) $data->props : false;

        $rowID       = ( isset( $rowProps->custom_id ) && $rowProps->custom_id ? $rowProps->custom_id : pbwp_uniqueMe() );
        $colID       = pbwp_uniqueMe();
        $colMode     = ( isset( $rowProps->custom_col ) && $rowProps->custom_col ? $rowProps->custom_col : '1-1' );
        $colTemplate = [
            [
                'id'     => $colID,
                'config' => [
                    'css' => [
                        'desktop'    => [  ],
                        'tablet'     => [  ],
                        'smartphone' => [  ],
                     ],
                 ],
                'items'  => [  ],
             ],
         ];

        if ( $colMode !== '1-1' ) {

            $cols       = explode( '_', $colMode );
            $allColumns = [  ];

            foreach ( $cols as $col ) {

                $allColumns[  ] = [
                    'id'     => pbwp_uniqueMe(),
                    'config' => [
                        'css' => [
                            'desktop'    => [  ],
                            'tablet'     => [  ],
                            'smartphone' => [  ],
                         ],
                     ],
                    'items'  => [  ],
                 ];

            }

            $colTemplate = $allColumns;

        }

        $default = [
            'id'       => esc_html( $rowID ),
            'label'    => '',
            'col_mode' => esc_html( $colMode ),
            'inner_of' => esc_html( $innerOf ),
            'config'   => [
                'expcoll' => 'nocollapsed',
                'css'     => [
                    'desktop'    => [
                        '.self. > .wpc_row_container|padding' => '10px 10px 10px 10px',
                     ],
                    'tablet'     => [  ],
                    'smartphone' => [  ],
                 ],
             ],
            'row_cols' => $colTemplate,
         ];

        /* Update post meta */
        $post_meta                      = get_post_meta( $postID, 'wp_composer', true );
        $post_meta                      = base64_decode( $post_meta );
        $post_meta                      = json_decode( $post_meta, true );
        $front_single_data              = [  ];
        $front_single_data[ 'builder' ] = [  ];
        $row_Index                      = null;

        if ( is_array( $post_meta ) && isset( $post_meta[ 'builder' ] ) ) {
            array_push( $post_meta[ 'builder' ], $default );
            $row_Index                      = count( $post_meta[ 'builder' ] );
            $current_row_index              = array_search( $rowID, array_column( $post_meta[ 'builder' ], 'id' ) );
            $front_single_data[ 'builder' ] = $post_meta[ 'builder' ][ $current_row_index ];
        } else {
            $post_meta = $default;
        }

        if ( isset( $post_meta[ 'global' ][ 'config' ][ 'global_save_expcoll' ] ) && $post_meta[ 'global' ][ 'config' ][ 'global_save_expcoll' ] == 'yes' ) {
            $isCollExp = 'save';
        } else {
            $isCollExp = 'no';
        }

        /* Update data */
        $newData = $this->pbwp_decode_encode_data( $post_meta );
        $this->pbwp_update_data( $newData, $postID );

        $rowData = [
            'row_id' => $rowID,
            'col_id' => $colID,
            'markup' => '<div id="'.esc_attr( $rowID ).'" data-save_coll_exp="'.esc_attr( $isCollExp ).'" class="wpc-row '.( $innerOf == '' ? 'animated bounceIn' : 'wpc-inner-row' ).' wpc_node_row ui-sortable"'.( $innerOf != '' ? ' data-inner_of="'.esc_attr( $innerOf ).'"' : '' ).'><div data-col-num="100" data-col-cell="1-1" id="'.esc_attr( $colID ).'" class="wpc-column wpc_node_column"><div class="col-prop"><span data-action="add" class="add-item mtips"><span class="mt-mes">'.esc_html__( 'Add Item', 'page-builder-wp' ).'</span></span><span data-action="edit" class="edit-col mtips"><span class="mt-mes">'.esc_html__( 'Edit this column', 'page-builder-wp' ).'</span></span><span data-action="remove" class="delete-col mtips"><span class="mt-mes">'.esc_html__( 'Remove this column', 'page-builder-wp' ).'</span></span><span class="col-width-info">100%</span></div><div class="col-inner ui-sortable"><div class="wpc-item moreitems no_items"><div class="row-item"><span class="item-type-title add-new-item mtips">'.esc_html__( 'Add Item', 'page-builder-wp' ).'<span class="mt-mes">'.esc_html__( 'Add new item to this Column', 'page-builder-wp' ).'</span></span></div></div></div></div><div class="row-control-cont"><i class="move-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Drag to reorder', 'page-builder-wp' ).'</span></i><i data-action="expcoll" class="expcoll-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Expand / Collapse this Row', 'page-builder-wp' ).'</span></i><i data-col-type="1-1" class="cols-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Click to set the number of Columns', 'page-builder-wp' ).'</span></i><i data-action="setlabel" class="setlabel-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Click to set Label for this Row', 'page-builder-wp' ).'</span></i><span class="wpc_row_label"></span><div class="wpc_row_label_cont"><input type="text" class="row_label_editor" /><div class="row_label_editor_btn_cont"><span class="wpc-button-flat wpc-button-color-blue wpc-button-size-small wpc_update_row_label">'.esc_html__( 'Set Label', 'page-builder-wp' ).'</span><span class="wpc-button-flat wpc-button-color-red wpc-button-size-small wpc_row_label_cancel">'.esc_html__( 'Cancel', 'page-builder-wp' ).'</span></div></div><span class="row-right-handle"><i data-action="remove" class="delete-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Delete this Row', 'page-builder-wp' ).'</span></i><i data-action="edit" class="edit-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Row Settings', 'page-builder-wp' ).'</span></i><i data-action="clone" class="copy-row row-handle mtips"><span class="mt-mes">'.esc_html__( 'Clone this Row', 'page-builder-wp' ).'</span></i></span></div></div>',
         ];

        if ( $innerOf != '' ) {
            /* if rowInner itemtype */
            $rowData = $rowData[ 'markup' ];
        } else {

            if ( $row_Index === 1 && ! isset( $data->is_tour ) && $colMode === '1-1' ) {
                // Create new item (textEditor) if this is the first row
                $new_item = [
                    'command'    => 'add_item',
                    'type'       => 'textEditor',
                    'label'      => 'Text Block',
                    'tabID'      => 'notab',
                    'isImport'   => 'yes',
                    'orderType'  => 'dragDrop',
                    'clientData' => [
                        'postID'      => $postID,
                        'rowIndex'    => 0,
                        'columnIndex' => 0,
                        'itemIndex'   => 0,
                     ],
                 ];

                $this->add_item( (object) $new_item, false );
                /* Get main data */
                $saved_data = $this->pbwp_get_data( $postID, true );

                $front_single_data[ 'builder' ] = $saved_data[ 'builder' ][ 0 ];

                /* Encode data */
                $saved_data = $this->pbwp_decode_encode_data( $saved_data );
                /* Sanitize data */
                $newData = sanitize_text_field( $saved_data );

                $create              = new PBWP_Markup_Creator();
                $rowData[ 'markup' ] = $create->editorBlock( $newData );

            }

            $rowData[ 'frontend_markup' ] = [ 'markup' => wp_json_encode( pbwp_generate_rows( [ $front_single_data[ 'builder' ] ] ) ), 'inlineData' => wp_json_encode( [  ] ), 'id' => $rowID, 'original_type' => 'row', 'type' => 'row', 'col_cells' => $colMode, 'new_row' => true, 'is_first_row' => ( $row_Index === 1 ? true : false ) ];
            $rowData[ 'base' ]            = $newData;

        }

        return $rowData;

    }

    /**
     * Item / Element Management
     *
     * @since 1.0.0
     * @access public
     *
     * @param array
     *
     * @return array
     */

    public function add_item( $dt, $returnData = true )
    {

        $ajaxData = $dt;

        if ( ! class_exists( 'PBWP_Markup_Creator' ) ) {
            require_once pbwp_manager()->path( 'CLASSES_DIR', 'class-wpc-markup-creator.php' );
        }

        $creator   = new PBWP_Markup_Creator();
        $dataFrom  = (object) $ajaxData->clientData;
        $itemType  = $ajaxData->type;
        $itemID    = pbwp_uniqueMe();
        $itemLabel = $ajaxData->label;
        $theTabs   = ( $ajaxData->tabID == 'notab' ? [ 'type' => 'newitem' ] : [ 'type' => 'newitem', 'tabID' => $ajaxData->tabID ] );
        $newTabID  = pbwp_uniqueMe();

        if ( $ajaxData->type == 'textEditor' && $ajaxData->isImport == 'yes' ) {

            /* Import current content to builder */
            $content_post = get_post( $dataFrom->postID );
            $def_content  = $content_post->post_content;

            if ( trim( $def_content ) == '' ) {
                return;
            }

        }

        ob_start();

        if ( $ajaxData->type == 'rowInner' ) {

            echo '<div id="'.esc_attr( $itemID ).'" data-item-type="'.esc_attr( $itemType ).'" class="wpc-item has_row_inner item-type-'.esc_attr( $itemType ).' ui-sortable-handle">';
            echo '<div class="row-item">';
            echo wp_kses_post( $this->add_row( $dataFrom, $itemID ) );
            echo '</div></div>';
        } else {

            if ( $itemType == 'typeTAB' || $itemType == 'typeAccordion' ) {
                $theTabs = array_merge( $theTabs, [ 'id' => $newTabID, 'title' => ( $itemType == 'typeTAB' ? 'New Tab' : 'New Accordion Tab' ) ] );
            }

            $creator->theItems( $itemType, $itemID, $itemLabel, $theTabs );

        }

        $items = ob_get_clean();

        if ( $itemType == 'textEditor' ) {

            $def_text = apply_filters( 'pbwp_default_texeditor_content', esc_html__( 'I am text block, change me with any text you want. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'page-builder-wp' ) );

            if ( $ajaxData->isImport == 'yes' ) {
                /* Import current content to builder */
                $content_post = get_post( $dataFrom->postID );
                $def_text     = pbwp_remove_html_comment_tags( $content_post->post_content );

            }

            $def_content = [ 'general' => [ 'text-editor' => base64_encode( wpautop( $def_text ) ) ], 'css' => [ 'desktop' => [  ], 'tablet' => [  ], 'smartphone' => [  ] ] ];

        } else {
            $def_content = [ 'css' => [ 'desktop' => [  ], 'tablet' => [  ], 'smartphone' => [  ] ] ];
        }

        $response = [
            'items'      => $items,
            'uniqueID'   => $itemID,
            'itemType'   => $itemType,
            'itemObject' => [
                'id'         => $itemID,
                'type'       => $itemType,
                'disable'    => false,
                'isRowInner' => ( $ajaxData->type == 'rowInner' ? true : false ),
                'label'      => $itemLabel,
                'config'     => $def_content,
             ],
         ];

        if ( function_exists( 'pbwp_addons' ) ) {

            $addons = pbwp_addons()->get_addons_basename();

            if ( $addons && in_array( $itemType, $addons ) ) {
                $response[ 'itemObject' ][ 'is_addon' ] = true;
            }

        }

        if ( $itemType == 'typeTAB' || $itemType == 'typeAccordion' ) {

            if ( $itemType == 'typeTAB' ) {
                /* Only for Tabs and Accordion item type */
                $theBase  = 'tabs';
                $tabTitle = 'New Tab';
            }

            if ( $itemType == 'typeAccordion' ) {
                $theBase  = 'accordions';
                $tabTitle = 'New Accordion Tab';
            }

            $response[ 'itemObject' ][ $theBase ] = [ [ 'id' => $newTabID, 'title' => $tabTitle, 'use_icon' => 'no', 'icon' => '', 'icon_pos' => 'before' ] ];

        }

        if ( $ajaxData->tabID != 'notab' ) {
            /* This is if the new item picked up from tab item type */
            $response[ 'itemObject' ][ 'childOf' ] = $theTabs[ 'tabID' ];
        }

        /* Get current data */
        $post_meta = $this->pbwp_get_data( $dataFrom->postID, true );

        if ( ! isset( $post_meta[ 'builder' ][ $dataFrom->rowIndex ][ 'row_cols' ][ $dataFrom->columnIndex ][ 'items' ] ) ) {
            $post_meta[ 'builder' ][ $dataFrom->rowIndex ][ 'row_cols' ][ $dataFrom->columnIndex ][ 'items' ] = [  ];
        }

        if ( $ajaxData->orderType == 'prepend' ) {
            /* Push new Data */
            array_unshift( $post_meta[ 'builder' ][ $dataFrom->rowIndex ][ 'row_cols' ][ $dataFrom->columnIndex ][ 'items' ], $response[ 'itemObject' ] );
        } else

        if ( $ajaxData->orderType == 'append' ) {
            array_push( $post_meta[ 'builder' ][ $dataFrom->rowIndex ][ 'row_cols' ][ $dataFrom->columnIndex ][ 'items' ], $response[ 'itemObject' ] );
        } else

        if ( $ajaxData->orderType == 'dragDrop' ) {
            array_splice( $post_meta[ 'builder' ][ $dataFrom->rowIndex ][ 'row_cols' ][ $dataFrom->columnIndex ][ 'items' ], $dataFrom->itemIndex, 0, [ $response[ 'itemObject' ] ] );
        } else {
            return [  ];
        }

        /* Save the data */
        $newData = $this->pbwp_decode_encode_data( $post_meta );
        $this->pbwp_update_data( $newData, $dataFrom->postID );

        if ( ! $returnData ) {
            return;
        }

        /* Send back the latest data to client side */
        $dataFrom->id              = $itemID;
        $dataFrom->type            = 'item';
        $response[ 'base' ]        = $newData;
        $response[ 'itemIndex' ]   = $dataFrom->itemIndex;
        $response[ 'is_frontend' ] = ( isset( $dataFrom->is_frontend ) ? $dataFrom->is_frontend : false );
        $response[ 'main_markup' ] = pbwp_frontend_generate_content( $dataFrom, true );

        return $response;

    }

    /**
     * Page Builders Properties
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function actions( WP_REST_Request $req )
    {

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'wpc_ajax_get_posts':

                $args      = apply_filters( 'pbwp_get_posts_arg', [ 'post_type' => $data->type, 'post_status' => 'publish', 'offset' => $data->offset, 'posts_per_page' => 15, 'order' => 'ASC' ] );
                $allPost   = [  ];
                $postslist = get_posts( $args );

                foreach ( $postslist as $post ):

                    setup_postdata( $post );

                    if ( $postslist ) {

                        $allPost[  ] = [ 'pID' => $post->ID,
                            'pTitle'               => ( get_the_title( $post->ID ) != '' ? get_the_title( $post->ID ) : 'No Title' ),
                            'permalink'            => base64_encode( get_permalink( $post->ID ) ),
                         ];
                    }

                endforeach;
                wp_reset_postdata();

                wp_send_json( [ 'data' => $allPost ] );

                break;

            case 'wpc_media_meta':

                $mediaData = $data->data;

                if ( $mediaData[ 'action' ] == 'get' ) {

                    $attachment = get_post( $mediaData[ 'id' ] );

                    wp_send_json( [ 'title' => ( isset( $attachment->post_title ) ? $attachment->post_title : '' ), 'desc' => ( isset( $attachment->post_content ) ? $attachment->post_content : '' ), 'alt' => get_post_meta( $mediaData[ 'id' ], '_wp_attachment_image_alt', true ), 'all' => $attachment ] );

                }

                if ( $mediaData[ 'action' ] == 'set' ) {

                    wp_update_post( [ 'ID' => $mediaData[ 'id' ], 'post_title' => esc_html( $mediaData[ 'title' ] ) ] );
                    wp_update_post( [ 'ID' => $mediaData[ 'id' ], 'post_content' => wp_kses_post( force_balance_tags( $mediaData[ 'description' ] ) ) ] );
                    update_post_meta( $mediaData[ 'id' ], '_wp_attachment_image_alt', esc_html( $mediaData[ 'alt' ] ) );

                    wp_send_json( [ 'msg' => 'done' ] );

                }

                break;

            case 'wpc_global_settings':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                pbwp_update_option( $data->key, $data->val );

                $response = 'saved';

                if ( isset( $data->valueSendBack ) && $data->valueSendBack ) {
                    $response = $data->val[ $data->valueSendBack ];
                }

                foreach ( $data->val as $eachStt => $eachVal ) {

                    if ( $eachStt == 'wpc_roles' ) {

                        $usr_role = pbwp_get_user_role();
                        $allowed  = explode( ',', $eachVal );

                        foreach ( $usr_role as $each_role ) {

                            if ( $each_role != 'administrator' ) {

                                $role = get_role( $each_role );

                                if ( in_array( $each_role, $allowed ) ) {

                                    $role->add_cap( 'edit_theme_options' );

                                } else {

                                    $role->remove_cap( 'edit_theme_options' );

                                }

                            }

                        }

                    }

                }

                wp_send_json( [ 'status' => $response ] );

                break;

            case 'generate_editor_vars':

                if ( $data->type == 'option_fields' ) {

                    if ( ! function_exists( 'pbwp_maps' ) ) {
                        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'maps/wpc-maps.php' );
                    }

                    wp_send_json( pbwp_maps() );

                }

                if ( $data->type == 'divider_shapes' ) {

                    if ( ! function_exists( 'pbwp_shape_divider_shapes' ) ) {
                        require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'shapes/wpc-divider-shapes.php' );
                    }

                    wp_send_json( pbwp_shape_divider_shapes() );

                }

                break;

            case 'get_icon_list':

                $lib = 'fontawesome';

                if ( ! empty( $data->lib ) || isset( $data->lib ) ) {
                    $lib = $data->lib;
                }

                require_once pbwp_manager()->path( 'ASSETS_PROP_BACK_DIR', 'icons/icon-'.esc_html( $lib ).'.php' );

                $func  = 'pbwp_icon_'.$lib;
                $icons = $func();

                wp_send_json( $icons );

                break;

            case 'wpc_row_set_config':

                $txt     = '';
                $dataRow = (object) $data->rowData;
                /* Get current data */
                $post_meta = $this->pbwp_get_data( $dataRow->postID, true );

                if ( $dataRow->job == 'set_label' ) {
                    $post_meta[ 'builder' ][ $dataRow->rowIndex ][ 'label' ] = esc_html( $dataRow->label );
                    $txt                                                     = ( $dataRow->label ? esc_html( $dataRow->label ) : 'none' );
                }

                if ( $dataRow->job == 'collexp' ) {
                    $post_meta[ 'builder' ][ $dataRow->rowIndex ][ 'config' ][ 'expcoll' ] = esc_html( $dataRow->expcoll );
                    $txt                                                                   = 'saved';
                }

                /* Save the data */
                $newData = $this->pbwp_decode_encode_data( $post_meta );
                $this->pbwp_update_data( $newData, $dataRow->postID );

                wp_send_json( [ 'status' => true, 'txt' => $txt, 'base' => $newData ] );

                wp_die();

                break;

            case 'get_image_url_by_id':

                $ids     = $data->ids;
                $imgData = [  ];

                foreach ( $ids as $key => $val ) {

                    $isbroken      = false;
                    $thumbnail_url = '';

                    $thumbnail_url = wp_get_attachment_image_src( $val, 'thumbnail' );

                    if ( empty( $thumbnail_url[ 0 ] ) ) {
                        $thumbnail_url = wp_get_attachment_image_src( $val, 'medium' );
                    }

                    if ( empty( $thumbnail_url[ 0 ] ) ) {
                        $thumbnail_url = wp_get_attachment_image_src( $val, 'full' );
                    }

                    if ( empty( $thumbnail_url[ 0 ] ) ) {
                        $isbroken      = true;
                        $thumbnail_url = [ esc_url( pbwp_distribution_url( 'images/image-not-found.png' ) ) ];
                    }

                    $imgData[ $key ] = [ 'id' => $val, 'url' => $thumbnail_url[ 0 ], 'status' => ( $isbroken ? 'broken' : 'ok' ) ];

                }

                wp_send_json( [ 'imgData' => $imgData ] );

                break;

            case 'wpc_search_posts':

                $pData = $data->postData;

                $the_query = new WP_Query( [ 'posts_per_page' => 1, 's' => esc_attr( $pData[ 'keyword' ] ), 'post_type' => $pData[ 'post_type' ] ] );
                $result    = [  ];

                $result[ 'status' ]  = false;
                $result[ 'title' ]   = 'none';
                $result[ 'content' ] = 'none';

                if ( $the_query->have_posts() ) {

                    while ( $the_query->have_posts() ): $the_query->the_post();

                        $result[ 'status' ]  = true;
                        $result[ 'title' ]   = the_title( '', '', false );
                        $result[ 'content' ] = wpautop( get_the_content() );

                    endwhile;
                    wp_reset_postdata();
                }

                wp_send_json( [ 'postData' => $result ] );

                break;

            case 'wpc_upload_image':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $imgData = [  ];
                $isError = false;

                if ( isset( $data->pexelsID ) ) {

                    $pexels_data = pbwp_check_pexels_photo_exist( (int) $data->pexelsID, true );

                    if ( $pexels_data ) {
                        wp_send_json( [ 'id' => $pexels_data[ 'img_id' ] ] );
                        wp_die();
                    }

                    add_filter( 'pbwp_upload_image_desc', function ( $desc ) {return 'Pexels Assets';} );

                }

                $theId = pbwp_uploadRemoteImageAndAttach( $data->imgUrl, $data->postID );

                if ( is_wp_error( $theId ) ) {
                    $isError = true;
                    $theId   = abs( crc32( uniqid() ) );
                }

                $imgData = [ 'id' => $theId ];

                if ( $isError ) {
                    $imgData = [ 'error' => [ 'error_type' => 'download_error', 'url' => $data->imgUrl ] ];
                } else {

                    if ( isset( $data->pexelsID ) ) {
                        update_post_meta( $theId, 'pexels_data', [ 'pexels_id' => (int) $data->pexelsID, 'img_id' => $theId ] );
                    }

                }

                wp_send_json( $imgData );

                break;

            case 'edit_data':

                $mainData = $this->pbwp_get_data( $data->id, true );

                wp_send_json( [ 'code' => $mainData ] );

                break;

            case 'save_data':

                $mainData = json_decode( $data->new_data, true );
                /* Update data */
                $newData = $this->pbwp_decode_encode_data( $mainData );
                $this->pbwp_update_data( $newData, $data->id );

                wp_send_json( [ 'status' => esc_html__( 'Data has been successfully updated', 'page-builder-wp' ) ] );

                break;

            case 'favorites_item':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $fav = pbwp_get_option( 'user_item_favorites' );

                if ( ! $fav ) {
                    $fav = [  ];
                }

                if ( $data->action === 'add' ) {

                    if ( ! in_array( $data->item, $fav ) ) {
                        array_push( $fav, sanitize_text_field( $data->item ) );
                    }

                }

                if ( $data->action === 'remove' ) {

                    if ( in_array( $data->item, $fav ) ) {
                        $fav = array_diff( $fav, [ $data->item ] );
                        $fav = array_values( $fav );
                    }

                }

                pbwp_update_option( 'user_item_favorites', $fav );
                wp_send_json( $fav );

                break;

            case 'color':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $colors = pbwp_get_option( 'user_colors' );

                if ( $data->action === 'add' ) {

                    if ( ! in_array( $data->color, $colors ) ) {
                        array_push( $colors, esc_html( $data->color ) );
                    }

                }

                if ( $data->action === 'remove' ) {

                    if ( in_array( $data->color, $colors ) ) {
                        $colors = array_diff( $colors, [ $data->color ] );
                        $colors = array_values( $colors );
                    }

                }

                pbwp_update_option( 'user_colors', $colors );

                wp_send_json( [ 'success' => true ] );

                break;

            default:
                break;

        }

        wp_die();

    }

    /**
     * Media Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function media( WP_REST_Request $req )
    {

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'download':

                if ( ! function_exists( 'pbwp_get_option' ) ) {
                    require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
                }

                $error  = false;
                $img_id = null;

                if ( filter_var( $data->props[ 'url' ], FILTER_VALIDATE_URL ) ) {

                    $img_id = pbwp_uploadRemoteImageAndAttach( $data->props[ 'url' ], $data->props[ 'data' ][ 'post_id' ] );

                    if ( is_wp_error( $img_id ) && ! isset( $data->props[ 'returnError' ] ) ) {
                        $img_id = pbwp_pick_wpc_dummy_random_image_id( 1, true );
                        $error  = true;
                    }

                }

                wp_send_json( [ 'token' => isset( $data->props[ 'token' ] ) ? $data->props[ 'token' ] : false, 'img_id' => $img_id, 'success' => $error ? false : true, 'msg' => $error && isset( $data->props[ 'returnError' ] ) ? $img_id->get_error_message() : false ] );

                break;

            case 'upload':

                wp_send_json( [ 'success' => false ] );

                break;

            default:
                break;

        }

        wp_die();

    }

    /**
     * Fonts Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function fonts( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;
        $fontData = ( isset( $data->fontData ) ? $data->fontData : '' );

        switch ( $data->command ) {

            case 'add':

                $wpc_fonts = pbwp_get_option( 'user_fonts' );

                if ( ! is_array( $wpc_fonts ) ) {
                    $wpc_fonts = [  ];
                    pbwp_update_option( 'user_fonts', $wpc_fonts );
                }

                if ( isset( $fontData[ 'bulk' ] ) ) {

                    foreach ( $fontData[ 'bulk' ] as $font => $fontProps ) {
                        // Skip if font exist
                        if ( isset( $wpc_fonts[ $font ] ) ) {
                            continue;
                        }

                        $eachFontData = [
                            'family'   => esc_attr( $font ),
                            'subsets'  => esc_attr( $fontProps[ 0 ] ),
                            'variants' => esc_attr( $fontProps[ 1 ] ),
                         ];

                        $wpc_fonts[ $eachFontData[ 'family' ] ] = [ $eachFontData[ 'subsets' ], $eachFontData[ 'variants' ] ];

                        if ( pbwp_update_option( 'user_fonts', $wpc_fonts ) ) {
                            PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => $data->command, 'font_data' => $eachFontData ] );
                        }

                    }

                    wp_send_json( [
                        'message' => '',
                        'stt'     => 1,
                        'type'    => true,
                        'data'    => $wpc_fonts,
                     ] );

                } else {

                    $family   = esc_attr( $fontData[ 'family' ] );
                    $subsets  = esc_attr( $fontData[ 'subsets' ] );
                    $variants = esc_attr( $fontData[ 'variants' ] );

                    $font_data = [
                        'message' => '',
                        'stt'     => 0,
                        'type'    => false,
                        'data'    => $wpc_fonts,
                     ];

                    if ( empty( $family ) ) {

                        $font_data[ 'message' ] = esc_html__( 'Error, missing font family', 'page-builder-wp' );

                    } else

                    if ( isset( $wpc_fonts[ $family ] ) ) {

                        $font_data[ 'message' ] = esc_html__( 'Error, font family already exists', 'page-builder-wp' );

                    } else

                    if ( count( $wpc_fonts ) >= apply_filters( 'pbwp_composer_max_total_fonts', 35 ) ) {

                        $font_data[ 'message' ] = esc_html__( 'Error, You have added too much fonts. Your page will load very slowly.', 'page-builder-wp' );

                    } else {

                        $wpc_fonts[ $family ] = [ $subsets, $variants ];

                        if ( pbwp_update_option( 'user_fonts', $wpc_fonts ) ) {
                            PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => $data->command, 'font_data' => $fontData ] );

                            $font_data[ 'message' ] = esc_html__( 'Your font has been added successful', 'page-builder-wp' );
                            $font_data[ 'stt' ]     = 1;
                            $font_data[ 'type' ]    = true;
                            $font_data[ 'data' ]    = $wpc_fonts;
                        }

                    }

                    wp_send_json( $font_data );

                }

                break;

            case 'update':

                if ( pbwp_get_option( 'user_fonts' ) === false ) {
                    pbwp_update_option( 'user_fonts', $fontData[ 'fonts' ] );
                } else {
                    pbwp_update_option( 'user_fonts', $fontData[ 'fonts' ] );
                }

                $font_data = [
                    'message'  => esc_html__( 'Your settings have been updated', 'page-builder-wp' ),
                    'stt'      => 1,
                    'type'     => false,
                    'appendTo' => '#wpc-ggf-my-fonts',
                    'data'     => $fontData[ 'fonts' ],
                 ];

                PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => $data->command, 'font_data' => $fontData ] );

                wp_send_json( $font_data );

                break;

            case 'update_version':

                $font_data = [
                    'stt'      => 1,
                    'appendTo' => '#wpc-ggf-my-fonts',
                    'message'  => esc_html__( 'Update failed!', 'page-builder-wp' ),
                 ];

                $result = PBWP_Fonts_Manager::fonts_update();

                if ( $result ) {

                    $font_data[ 'message' ] = $result;

                }

                wp_send_json( $font_data );

                break;

            case 'delete':

                $wpc_fonts = pbwp_get_option( 'user_fonts' );

                if ( ! is_array( $wpc_fonts ) ) {
                    $wpc_fonts = [  ];
                    pbwp_update_option( 'user_fonts', $wpc_fonts );
                }

                $family = esc_attr( $fontData[ 'family' ] );

                $font_data = [
                    'message'  => '',
                    'stt'      => 0,
                    'type'     => false,
                    'appendTo' => '#wpc-ggf-my-fonts',
                    'data'     => $wpc_fonts,
                 ];

                if ( empty( $family ) ) {

                    $font_data[ 'message' ] = esc_html__( 'Error, missing font family', 'page-builder-wp' );

                } else

                if ( ! isset( $wpc_fonts[ $family ] ) ) {

                    $font_data[ 'message' ] = esc_html__( 'Error, font family does not exists', 'page-builder-wp' );

                } else {

                    unset( $wpc_fonts[ $family ] );
                    pbwp_update_option( 'user_fonts', $wpc_fonts );

                    $font_data[ 'message' ] = esc_html__( 'Your font has been deleted successful', 'page-builder-wp' );
                    $font_data[ 'stt' ]     = 1;
                    $font_data[ 'type' ]    = false;
                    $font_data[ 'data' ]    = $wpc_fonts;

                    PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => $data->command, 'font_data' => $fontData ] );

                }

                wp_send_json( $font_data );

                break;

            case 'backup':

                $fonts = pbwp_render_fonts();

                if ( count( $fonts ) == 0 ) {
                    wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'No fonts to backup', 'page-builder-wp' ) ] ) ] );
                    wp_die();
                }

                $backupname = 'backup_fonts_'.gmdate( 'd_m_Y_His' );
                set_transient( $backupname, $fonts, 1 * MINUTE_IN_SECONDS );

                $backup_uri = $data->ajaxurl.'/'.wp_create_nonce( 'wpc_ajax_nonce' ).'/'.$backupname.'/'.base64_encode( 'WPComposer_Fonts' );

                wp_send_json( [ 'status' => $backup_uri ] );

                wp_die();

                break;

            case 'restore':

                $font_data = base64_decode( $fontData );
                $font_data = json_decode( $font_data, true );
                $fonts     = $font_data[ 'data' ];

                if ( isset( $font_data[ 'signature' ] ) && $font_data[ 'signature' ] == 'WPComposer_Fonts' ) {

                    pbwp_update_option( 'user_fonts', $fonts );

                    ob_start();

                    foreach ( array_keys( $fonts ) as $k => $f ) {

                        echo '<tr><td id="eachfont'.esc_attr( $k ).'" class="each_font_type"><p>'.esc_html( rawurldecode( $f ) ).'</p></td><td><div data-font-id="'.esc_attr( $k ).'" class="each_fonts_actions"><i data-action="delete" class="wpc-i-remove fonts_btn"></i></div></td></tr>';

                    }

                    $fonts_markup = ob_get_clean();

                    wp_send_json( [ 'status' => wp_json_encode( [ 'new_fonts' => $fonts_markup ] ) ] );

                } else {

                    wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'Wrong JSON Signature! Please try again or select another file.', 'page-builder-wp' ) ] ) ] );

                }

                wp_die();

                break;

            case 'upload':

                $response = [ 'status' => 'error', 'msg' => 'cloud_upload_failed' ];

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'cloud_data',
                    'command'    => wp_json_encode( [
                        'task'       => 'saveCloud',
                        'data'       => [
                            'type'   => 'fonts',
                            'family' => $fontData[ 'family' ],
                         ],
                        'saved_item' => $fontData[ 'data' ],
                     ] ),
                 ] );

                wp_send_json( $response );

                break;

            case 'getCloudFonts':

                $response = [ 'status' => 'error', 'msg' => 'cloud_get_failed' ];

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'cloud_data',
                    'command'    => wp_json_encode( [
                        'task' => 'getData',
                        'type' => 'fonts' ]
                    ),
                 ] );

                wp_send_json( $response );

                break;

            default:
                break;

        }

        wp_die();

    }

    /**
     * Preset Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function presets( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData    = $req->get_param( 'data' );
        $data        = (object) $postData;
        $presetData  = ( isset( $data->presetData ) ? $data->presetData : [  ] );
        $response    = [  ];
        $all_presets = pbwp_get_option( 'user_presets' );

        switch ( $data->command ) {

            case 'add':

                if ( isset( $presetData ) && isset( $presetData[ 'preset' ] ) && is_array( $presetData[ 'preset' ] ) ) {

                    $presetType = $presetData[ 'type' ];
                    $new_preset = [
                        'id'             => sanitize_text_field( $presetData[ 'id' ] ),
                        'title'          => sanitize_text_field( $presetData[ 'title' ] ),
                        'created'        => current_time( 'timestamp' ),
                        'plugin_version' => PBWP_VERSION,
                        'preset'         => $presetData[ 'preset' ],
                     ];

                    if ( isset( $all_presets ) && is_array( $all_presets ) && count( $all_presets ) > 0 ) {

                        foreach ( array_keys( $all_presets ) as $key => $val ) {

                            if ( $val == $presetType ) {

                                array_push( $all_presets[ $val ], $new_preset );
                                pbwp_update_option( 'user_presets', $all_presets );
                                wp_send_json( [ 'status' => 'added', 'preset_data' => $new_preset ] );
                                wp_die();

                            } else {

                                $all_presets[ $presetType ][  ] = $new_preset;
                                pbwp_update_option( 'user_presets', $all_presets );
                                wp_send_json( [ 'status' => 'added', 'preset_data' => $new_preset ] );
                                wp_die();

                            }

                        }

                    } else {

                        $all_presets[ $presetType ][  ] = $new_preset;

                    }

                    pbwp_update_option( 'user_presets', $all_presets );

                    $response = [ 'status' => 'added', 'preset_data' => $new_preset ];

                } else {

                    wp_send_json( [ 'status' => 'preset_err' ] );
                    wp_die();

                }

                break;

            case 'remove':

                $key = array_search( $presetData[ 'id' ], array_column( $all_presets[ $presetData[ 'type' ] ], 'id' ) );

                unset( $all_presets[ $presetData[ 'type' ] ][ $key ] );
                $all_presets[ $presetData[ 'type' ] ] = array_values( $all_presets[ $presetData[ 'type' ] ] );

                if ( isset( $all_presets[ $presetData[ 'type' ] ] ) && count( $all_presets[ $presetData[ 'type' ] ] ) == 0 ) {
                    unset( $all_presets[ $presetData[ 'type' ] ] );
                }

                pbwp_update_option( 'user_presets', $all_presets );
                $response = [ 'status' => 'removed' ];

                break;

            case 'upload':

                $response = [ 'status' => 'error', 'msg' => 'cloud_upload_failed' ];

                break;

            case 'load':

                $response = [ 'status' => 'error', 'msg' => 'cloud_get_failed' ];

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'cloud_data',
                    'command'    => wp_json_encode( [
                        'task'     => 'getData',
                        'type'     => 'presets',
                        'itemType' => $presetData[ 'type' ],
                        'loadJson' => true,
                     ] ),
                 ] );

                wp_send_json( $response );

                break;

            case 'getJsonData':

                $response = [ 'status' => 'error', 'msg' => 'cloud_get_failed' ];

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'cloud_data',
                    'command'    => wp_json_encode( [
                        'task' => 'getJsonData',
                        'id'   => $presetData[ 'id' ],
                        'type' => $presetData[ 'type' ] ]
                    ) ] );

                wp_send_json( $response );

                break;

            case 'backup':

                $data = pbwp_render_presets();

                if ( array_key_exists( 'noPreset', $data ) ) {

                    wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'No preset to backup', 'page-builder-wp' ) ] ) ] );

                    wp_die();

                }

                $backupname = 'backup_preset_'.gmdate( 'd_m_Y_His' );
                set_transient( $backupname, $data, 1 * MINUTE_IN_SECONDS );

                $backup_uri = $presetData[ 'ajaxurl' ].'/'.wp_create_nonce( 'wpc_ajax_nonce' ).'/'.$backupname.'/'.base64_encode( 'WPComposer_Presets' );

                wp_send_json( [ 'status' => $backup_uri ] );

                wp_die();

                break;

            case 'restore':

                wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'We apologize, but this feature is not accessible with your current plan. To access all these fantastic features, consider upgrading your plan.', 'page-builder-wp' ) ] ) ] );

                wp_die();

                break;

            case 'reset':

                pbwp_update_option( 'user_presets', [  ] );

                $response = [ 'status' => 'reset' ];

                break;

            default:
                break;

        }

        wp_send_json( $response );
        wp_die();

    }

    /**
     * Templates Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function templates( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData      = $req->get_param( 'data' );
        $data          = (object) $postData;
        $templateData  = ( isset( $data->templateData ) ? $data->templateData : [  ] );
        $response      = [  ];
        $all_templates = pbwp_get_option( 'user_templates' );

        switch ( $data->command ) {

            case 'add':

                if ( isset( $templateData ) && isset( $templateData[ 'template' ] ) ) {

                    $new_template = [
                        'id'             => sanitize_text_field( $templateData[ 'id' ] ),
                        'title'          => sanitize_text_field( $templateData[ 'title' ] ),
                        'created'        => current_time( 'timestamp' ),
                        'plugin_version' => PBWP_VERSION,
                        'template'       => $templateData[ 'template' ],
                     ];

                    if ( isset( $all_templates ) && is_array( $all_templates ) && count( $all_templates ) > 0 ) {

                        $all_templates[  ] = $new_template;
                        pbwp_update_option( 'user_templates', $all_templates );
                        wp_send_json( [ 'status' => 'added', 'template_data' => $new_template ] );
                        wp_die();

                    } else {

                        $all_templates[  ] = $new_template;

                    }

                    pbwp_update_option( 'user_templates', $all_templates );

                    $response = [ 'status' => 'added', 'template_data' => $new_template ];

                } else {

                    wp_send_json( [ 'status' => 'error', 'msg' => 'template_err' ] );
                    wp_die();

                }

                break;

            case 'remove':

                $key = array_search( $templateData[ 'id' ], array_column( $all_templates, 'id' ) );

                unset( $all_templates[ $key ] );
                $all_templates = array_values( $all_templates );

                pbwp_update_option( 'user_templates', $all_templates );
                $response = [ 'status' => 'removed' ];

                break;

            case 'apply':

                $props                 = (object) $templateData;
                $mainData              = $this->pbwp_get_data( $props->post_id, true );
                $mainData[ 'builder' ] = [  ];

                $key = array_search( $props->id, array_column( $all_templates, 'id' ) );

                if ( isset( $all_templates[ $key ] ) && $all_templates[ $key ][ 'id' ] === $props->id ) {
                    $templateData          = $all_templates[ $key ][ 'template' ];
                    $mainData[ 'builder' ] = $this->pbwp_decode_encode_data( $templateData, 'decode' );
                    $dataReady             = $this->pbwp_decode_encode_data( $mainData );

                    $this->pbwp_update_data( $dataReady, $props->post_id );

                    $response = [ 'status' => 'applied', 'msg' => 'template_applied', 'base' => $dataReady ];
                } else {
                    $response = [ 'status' => 'error', 'msg' => 'template_not_found' ];
                }

                break;

            case 'getJsonData':

                $response = [ 'status' => 'error', 'msg' => 'cloud_get_failed' ];

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'cloud_data',
                    'command'    => wp_json_encode( [
                        'task' => 'getJsonData',
                        'id'   => $templateData[ 'id' ],
                        'type' => $templateData[ 'type' ] ]
                    ),
                 ] );

                wp_send_json( $response );

                break;

            case 'upload':

                $response = [ 'status' => 'error', 'msg' => 'cloud_upload_failed' ];

                break;

            case 'backup':

                $templates = pbwp_render_templates();

                if ( count( $templates ) == 0 ) {
                    wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'No templates to backup', 'page-builder-wp' ) ] ) ] );
                    wp_die();
                }

                $backupname = 'backup_templates_'.gmdate( 'd_m_Y_His' );
                set_transient( $backupname, $templates, 1 * MINUTE_IN_SECONDS );

                $backup_uri = $templateData[ 'ajaxurl' ].'/'.wp_create_nonce( 'wpc_ajax_nonce' ).'/'.$backupname.'/'.base64_encode( 'WPComposer_Templates' );

                wp_send_json( [ 'status' => $backup_uri ] );

                wp_die();

                break;

            case 'restore':

                wp_send_json( [ 'status' => wp_json_encode( [ 'error_msg' => esc_html__( 'We apologize, but this feature is not accessible with your current plan. To access all these fantastic features, consider upgrading your plan.', 'page-builder-wp' ) ] ) ] );

                wp_die();

                break;

            default:
                break;

        }

        wp_send_json( $response );
        wp_die();

    }

    /**
     * Cloud Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function cloud( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'install':

                $wpc_fonts           = '';
                $attachmentsReplacer = [  ];
                $cloudData           = (object) $data->data;
                $decodedData         = $this->pbwp_decode_encode_data( $cloudData->json, 'decode' );
                $hasAttachments      = isset( $decodedData[ 'attachments' ] ) && isset( $decodedData[ 'attachments' ][ 'meta' ] ) && ! empty( $decodedData[ 'attachments' ][ 'meta' ] ) ? true : false;
                $withAttachment      = $cloudData->withAttachment === 'yes' && $hasAttachments ? true : false;
                $attachments         = $hasAttachments ? $decodedData[ 'attachments' ][ 'meta' ] : false;
                $fonts               = isset( $decodedData[ 'gFonts' ] ) && ! empty( $decodedData[ 'gFonts' ] ) ? $decodedData[ 'gFonts' ] : false;

                if ( $hasAttachments ) {
                    if ( ! function_exists( 'wp_crop_image' ) ) {
                        include ABSPATH.'wp-admin/includes/image.php';
                    }

                    foreach ( $attachments as $key => $attachment ) {
                        if ( isset( $attachment[ 'group' ] ) ) {
                            $groups = [  ];
                            foreach ( $attachment[ 'urls' ] as $k => $url ) {
                                $groups[  ] = $withAttachment ? pbwp_uploadBase64Image( $url ) : pbwp_pick_wpmedia_random_image_id();
                            }
                            $attachmentId = implode( ',', $groups );
                        } else {
                            $attachmentId = $withAttachment ? pbwp_uploadBase64Image( $attachment[ 'url' ] ) : pbwp_pick_wpmedia_random_image_id();
                        }

                        $attachmentsReplacer[ $attachment[ 'replaceTo' ] ] = [
                            'attachmentId' => $attachmentId,
                         ];
                    }
                }

                if ( empty( $attachmentsReplacer ) ) {
                    $attachmentsReplacer = true;
                }

                // Apply attachments
                if ( $cloudData->type === 'preset' ) {
                    $final_data = pbwp_preset_parser()->parse( $decodedData[ 'mainData' ], $cloudData->itemType, $attachmentsReplacer );
                } else {
                    $final_data            = pbwp_template_parser()->parse( false, $decodedData[ 'mainData' ], $attachmentsReplacer );
                    $mainData              = $this->pbwp_get_data( $cloudData->postID, true );
                    $mainData[ 'builder' ] = isset( $final_data[ 'mainData' ] ) ? $final_data[ 'mainData' ] : $mainData[ 'builder' ];
                    $dataReady             = $this->pbwp_decode_encode_data( $mainData );
                    $this->pbwp_update_data( $dataReady, $cloudData->postID );

                    $final_data = $mainData;
                }

                if ( $fonts ) {
                    //Check for Google Fonts
                    $wpc_fonts = pbwp_get_option( 'user_fonts' );

                    if ( ! is_array( $wpc_fonts ) ) {
                        $wpc_fonts = [  ];
                        pbwp_update_option( 'user_fonts', $wpc_fonts );
                    }

                    foreach ( $fonts as $fontName => $fontParams ) {
                        // Skip if font exist
                        if ( isset( $wpc_fonts[ $fontName ] ) ) {
                            unset( $fonts[ $fontName ] );
                            continue;
                        }

                        // Add to font list
                        $wpc_fonts[ $fontName ] = $fontParams;
                        // Set to local
                        PBWP_Fonts_Manager::fonts_manage( [ 'cmd' => 'add', 'font_data' => [ 'family' => $fontName ] ] );

                    }

                    pbwp_update_option( 'user_fonts', $wpc_fonts );

                }

                $response = [
                    'data'  => $final_data,
                    'fonts' => $fonts && ! empty( $fonts ) ? $fonts : false,
                 ];

                break;

            default:
                break;

        }

        wp_send_json( $response );
        wp_die();

    }

    /**
     * My Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function my( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData = $req->get_param( 'data' );
        $data     = (object) $postData;

        switch ( $data->command ) {

            case 'getProducts':

                $response = $this->pbwp_connect( [
                    'token_auth' => true,
                    'endpoint'   => 'my',
                    'command'    => wp_json_encode( [
                        'task' => 'getProducts',
                     ] ),
                 ] );

                wp_send_json( $response );

                break;

            default:
                break;

        }

    }

    /**
     * Hub Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function hub( WP_REST_Request $req )
    {

        if ( ! function_exists( 'pbwp_get_option' ) ) {
            require_once pbwp_manager()->path( 'BACKEND', 'wpc-functions.php' );
        }

        $postData     = $req->get_param( 'data' );
        $data         = (object) $postData;
        $hub_data     = pbwp_get_option( 'hub' );
        $version_data = $hub_data[ 'content' ][ 'version_data' ];

        switch ( $data->command ) {

            case 'check_update':

                $source   = 'local';
                $response = $version_data[ 'need_update' ];

                // Get the current timestamp
                $installed_date_timestamp = $version_data[ 'last_check' ];
                // Convert the timestamp to a DateTime object
                $installed_date = new DateTime();
                $installed_date->setTimestamp( $installed_date_timestamp );
                // Get the current time as a DateTime object
                $current_time = new DateTime();
                // Calculate the difference between the installed date and the current time
                $difference = $current_time->diff( $installed_date );
                $eachDays   = apply_filters( 'pbwp_composer_days_hub_check_interval', 2 );

                // Check if the difference is more than x days
                if ( $difference->days > $eachDays ) {
                    $data->items = $version_data[ 'items' ];
                    $response    = $this->pbwp_connect( [
                        'endpoint' => 'hub',
                        'command'  => json_decode( wp_json_encode( $data ), true ),
                     ] );

                    if ( isset( $response[ 'hub_info' ] ) ) {
                        $version_data[ 'need_update' ] = $response;
                    }

                    $version_data[ 'last_check' ]            = current_time( 'timestamp' );
                    $hub_data[ 'content' ][ 'version_data' ] = $version_data;
                    pbwp_update_option( 'hub', $hub_data );

                    $source = 'hub';

                }

                return rest_ensure_response( [
                    'success' => $response && isset( $response[ 'hub_info' ] ) ? true : false,
                    'data'    => $response,
                    'source'  => $source,
                 ] );

                break;

            case 'get_data':

                $response = $this->pbwp_connect( [
                    'custom_endpoint' => PBWP_HUB_URL.'/wp-json/hub/v1/template/'.$data->type.'/',
                    'command'         => json_decode( wp_json_encode( $data ), true ),
                    'method'          => 'GET',
                 ] );

                // Update version
                if ( $response && isset( $response[ 'data' ] ) ) {
                    $version_data[ 'items' ][ $data->type ][ 'version' ] = $response[ 'version' ];

                    if ( is_array( $version_data[ 'need_update' ] ) && isset( $version_data[ 'need_update' ][ 'hub_info' ] ) && ! empty( $version_data[ 'need_update' ][ 'hub_info' ] ) ) {
                        foreach ( $version_data[ 'need_update' ][ 'hub_info' ] as $key => $msg ) {
                            if ( isset( $msg[ 'item' ] ) && $msg[ 'item' ] === $data->type ) {
                                unset( $version_data[ 'need_update' ][ 'hub_info' ][ $key ] );
                            }
                        }
                    }

                    $hub_data[ 'content' ][ 'version_data' ] = $version_data;
                    pbwp_update_option( 'hub', $hub_data );

                    $response[ 'hub_info' ] = $version_data[ 'need_update' ][ 'hub_info' ];

                }

                return rest_ensure_response( [
                    'success' => $response && isset( $response[ 'data' ] ) ? true : false,
                    'data'    => $response,
                 ] );

                break;

            case 'get_video_tutorials':

                $response = $this->pbwp_connect( [
                    'endpoint' => 'hub',
                    'command'  => json_decode( wp_json_encode( $data ), true ),
                 ] );

                $result = false;

                if ( $response && isset( $response[ 'video' ] ) ) {
                    $result = $response[ 'video' ];
                }

                return rest_ensure_response( [
                    'success' => $result ? true : false,
                    'data'    => $result,
                 ] );

                break;

            default:
                break;
        }

    }

    /**
     * Backup Manager
     *
     * @since 1.0.0
     * @access public
     *
     * @param $data (array)
     *
     * @return json
     */

    public function backup( WP_REST_Request $req )
    {

        $name      = $req->get_param( 'name' );
        $signature = $req->get_param( 'signature' );

        if ( isset( $name ) && isset( $signature ) ) {

            $data = get_transient( $name );

            if ( base64_decode( $signature ) == 'WPComposer' ) {

                $data = base64_decode( $data );
                $data = json_decode( $data, true );

            }

            ob_clean();
            header( 'Content-Type: text/json; charset='.get_option( 'blog_charset' ) );
            header( 'Content-Disposition: attachment; filename='.$name.'.json' );
            wp_send_json( [ 'signature' => base64_decode( $signature ), 'created' => gmdate( 'm/d/Y h:m:s', current_time( 'timestamp' ) ), 'plugin_version' => PBWP_VERSION, 'data' => $data ] );
            wp_die();

        }

    }

    private function pbwp_get_value_helper_ajax( $v )
    {

        return $v;

    }

    private function pbwp_decode_encode_data( $data, $mode = 'encode' )
    {

        if ( $mode == 'encode' ) {

            $mainData = base64_encode( wp_json_encode( $data ) );
            /* Sanitize data */
            $newData = sanitize_text_field( $mainData );

            return $newData;

        }

        $mainData = base64_decode( $data );
        $newData  = json_decode( $mainData, true );

        return $newData;

    }

    private function pbwp_update_data( $data, $postID, $sanitize = true, $deepSanitize = true )
    {

        if ( $sanitize ) {
            $data = sanitize_text_field( $data );
        }

        if ( $deepSanitize ) {
            if ( ! function_exists( 'pbwp_data_sanitation' ) ) {
                require_once pbwp_manager()->path( 'GLOBAL_DIR', 'wpc-sanitize.php' );
            }

            $data = pbwp_data_sanitation( $data );
        }

        delete_post_meta( $postID, 'wp_composer' );
        add_post_meta( $postID, 'wp_composer', $data, true );

    }

    private function pbwp_update_item_data( $type, $postID, $itemProp, $newData, $encode = false )
    {

        // Get current main data
        $mainData = get_post_meta( $postID, 'wp_composer', true );
        // Decode main data
        $mainData = $this->pbwp_decode_encode_data( $mainData, 'decode' );

        if ( $type === 'row' ) {
            $mainData[ 'builder' ][ $itemProp[ 'rowIndex' ] ] = $newData;
        } else

        if ( $type === 'column' ) {
            $mainData[ 'builder' ][ $itemProp[ 'rowIndex' ] ][ 'row_cols' ][ $itemProp[ 'columnIndex' ] ] = $newData;
        } else

        if ( $type === 'item' ) {
            $mainData[ 'builder' ][ $itemProp[ 'rowIndex' ] ][ 'row_cols' ][ $itemProp[ 'columnIndex' ] ][ 'items' ][ $itemProp[ 'itemIndex' ] ] = $newData;
        }

        return $encode ? $this->pbwp_decode_encode_data( $mainData ) : $mainData;

    }

    private function pbwp_get_data( $postID, $decode = false )
    {

        $mainData = get_post_meta( $postID, 'wp_composer', true );

        return $decode ? $this->pbwp_decode_encode_data( $mainData, 'decode' ) : $mainData;

    }

    private function pbwp_connect( $params )
    {

        $response      = [ 'status' => 'error', 'msg' => 'cloud_error' ];
        $requestParams = [
            'method'   => isset( $params[ 'method' ] ) ? $params[ 'method' ] : 'POST',
            'blocking' => true,
            'body'     => $params[ 'command' ],
         ];
        $endpoints = [
            'cloud_data' => PBWP_MY_URL.'/api/v1/public/cloud/data/',
            'my'         => PBWP_MY_URL.'/api/v1/public/my/',
            'hub'        => PBWP_HUB_URL.'/wp-json/hub/v1/hub/',
         ];

        if ( isset( $params[ 'custom_endpoint' ] ) ) {
            $endpoint = $params[ 'custom_endpoint' ];
        } else {
            $endpoint = $endpoints[ $params[ 'endpoint' ] ];
        }

        if ( isset( $params[ 'token_auth' ] ) && $params[ 'token_auth' ] ) {
            $requestParams[ 'headers' ] = [
                'Authorization' => 'Bearer '.pbwp_get_my_token(),
                'Content-Type'  => 'application/json',
             ];
        }

        $resp = wp_remote_request( $endpoint, $requestParams );

        if ( ! is_wp_error( $resp ) ) {
            $body = wp_remote_retrieve_body( $resp );
            $body = json_decode( $body, true );
            if ( isset( $body[ 'success' ] ) && isset( $body[ 'message' ] ) && ! $body[ 'success' ] ) {
                $response = [ 'status' => 'error', 'msg' => $body[ 'message' ], 'custom_msg' => true ];
            } else {
                $response = $body;
            }

            return $response;
        }

        return [ 'status' => 'error', 'msg' => $resp->get_error_message(), 'custom_msg' => true ];

    }

}