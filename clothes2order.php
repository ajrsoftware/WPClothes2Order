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


        // 3. On payment complete, 'run' the basket & post API calls for each basket item if meeting requirement
        add_action('woocommerce_payment_complete', 'processNewOrder');

    } else {
        add_action('admin_notices', 'setAdminNoticeError');
    }
});

/**
 *
 */
function createProductCatTerms(): void
{
    require_once plugin_dir_path(__FILE__) . '/classes/ProductTerms.php';
    $productTerms = new clothes2order\classes\ProductTerms();
    $productTerms->ensureTermsExist('product_cat', 'class', 'Class', 'Class Products');
    $productTerms->ensureTermsExist('product_cat', 'clothing', 'Clothing', 'Clothing Products');
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
 * Docs: https://developer.wordpress.org/reference/hooks/admin_notices/
 */
function setAdminNoticeError()
{
    echo '<div class="notice notice-error"><p>' . _('Woocommerce is required to use the Clothes2Order Plugin!') . '</p></div>';
}