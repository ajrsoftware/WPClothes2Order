<?php
/**
 * Clothes 2 Order plugin for WordPress
 *
 * @package   clothes2order
 * @link      https://ashredman.com
 * @author    Reuben Porter <porterdmu@gmail.com> & Ashley Redman <ash.redman@outlook.com>
 * @copyright 2021 AR Development
 * @license   GPL v2 or later
 *
 * Plugin Name:  Clothes 2 Order
 * Description:  Clothes 2 Order custom plugin for WordPress
 * Version:      1.2
 * Plugin URI:
 * Author:       Reuben Porter & Ashley Redman
 * Author URI:   https://ashredman.com
 * Text Domain:  clothes2order
 * Domain Path:
 * Requires PHP: 7.4
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined('ABSPATH') || die();

add_action('plugins_loaded', function () {

    if (class_exists('Woocommerce')) {

        // 1. Check & create specific taxonomy terms to determine which products to check in a basket
        add_action('init', 'createProductCatTerms');

        // 2. Add any additional product fields
        add_action('woocommerce_product_after_variable_attributes', 'productVariationFieldsSettings', 10, 3);
        add_action('woocommerce_save_product_variation', 'productVariationFieldsSave', 10, 2);
        add_filter('woocommerce_available_variation', 'productVariationFieldsLoad');

        // 3. On payment complete, 'run' the basket & post API calls for each basket item if meeting requirement
        add_action('woocommerce_payment_complete', 'processNewOrder');

    } else {
        add_action('admin_notices', 'setAdminNoticeError');
    }
});

/**
 * Docs: https://developer.wordpress.org/reference/hooks/admin_notices/
 */
function setAdminNoticeError()
{
    echo '<div class="notice notice-error"><p>' . _('Woocommerce is required to use the Clothes2Order Plugin!') . '</p></div>';
}

/**
 *
 */
function createProductCatTerms(): void
{
    require_once plugin_dir_path(__FILE__) . '/classes/ProductTerms.php';
    $productTerms = new clothes2order\classes\ProductTerms();
    $productTerms->ensureTermsExist('product_cat', 'clothes2order-clothing', 'Clothing', 'Clothing Products');
}

/**
 * @param $order_id
 */
function processNewOrder($order_id)
{
    require_once plugin_dir_path(__FILE__) . '/classes/Order.php';
    $order = new clothes2order\classes\Order($order_id);
}

/**
 * @param $loop
 * @param $variation_data
 * @param $variation
 */
function productVariationFieldsSettings($loop, $variation_data, $variation)
{
    require_once plugin_dir_path(__FILE__) . '/classes/VariableProductField.php';
    $fields = new clothes2order\classes\VariableProductField();

    if ($fields->checkIfHasTerm($variation)) {
        $fields->variation_settings_fields($loop, $variation_data, $variation);
    }
}

/**
 * @param $variation_id
 * @param $loop
 */
function productVariationFieldsSave($variation_id, $loop)
{
    var_dump('SAVE');
    die();
    require_once plugin_dir_path(__FILE__) . '/classes/VariableProductField.php';
    $fields = new clothes2order\classes\VariableProductField();

    $variation = wc_get_product($variation_id);

    if ($fields->checkIfHasTerm($variation)) {
        $fields->save_variation_settings_fields($variation_id, $loop);
    }
}

/**
 * @param $variation
 */
function productVariationFieldsLoad($variation)
{
    var_dump('LOAD');
    die();
    require_once plugin_dir_path(__FILE__) . '/classes/VariableProductField.php';
    $fields = new clothes2order\classes\VariableProductField();

    if ($fields->checkIfHasTerm($variation)) {
        $fields->load_variation_settings_fields($variation);
    }
}