<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

function pbwp_woocommerce_fields() {
	
	ob_start(); ?>
	
    <!-- Field Search Products -->
    <div class="wpc-editor-control wpc-param-row woo-field-search">
        <div class="wpc-field-label">
            <label></label>
        </div>
        <div class="wpc-field-content wpc-ajaxsearchform-container">
            <ul class="wpc_autocomplete">
                <li class="wpc_autocomplete-input"><input class="wpc_woo_search_field" placeholder="<?php esc_attr_e( 'Search your product here', 'page-builder-wp' ); ?>..." value="" autocomplete="off" type="text"><input value="" class="iam-hidden primary-value woo-product-list" type="text" name=""/></li>
                <li class="wpc_autocomplete-clear"></li>
                <li class="clear"></li>
            </ul>
            <div class="wpc-field-des"></div>
        </div>
        <div class="wpc-ajaxsearchform-suggestion"></div>
    </div>
    <?php
	$thePanel = ob_get_clean();
	return $thePanel;
	
}