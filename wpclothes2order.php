<?php

/**
 * Plugin Name:  WPClothes2Order
 * Description:  Unofficial WooCommerce Plugin for <a href="https://www.clothes2order.com/">Clothes2Order</a>
 * Version:      1.0.0
 * Plugin URI:   https://www.wpclothes2order.com
 * Author:       Ashley Redman
 * Author URI:   https://github.com/AshleyRedman
 * Text Domain:  wpc2o
 * Domain Path:
 * Requires at least: 6.0.0
 * Requires PHP: 7.4
 *
 * @package   wpclothes2order
 * @link      https://www.wpclothes2order.com
 * @author    Ashley Redman <ash.redman@outlook.com>
 * @copyright 2022 Ashley Redman
 * @license   GPL v2 or later
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

defined('ABSPATH') || exit;

require_once('vendor/autoload.php');
require_once('includes/constants.php');
require_once('classes/Notices.php');
require_once('includes/scripts.php');
require_once('includes/wc_options.php');
require_once('includes/wpc2o_options.php');
require_once('includes/wpc2o_options_api.php');
require_once('includes/wpc2o_options_delivery.php');
require_once('includes/wpc2o_options_logo.php');
require_once('includes/wpc2o_options_orders.php');
require_once('includes/wpc2o_options_stock.php');

add_action('plugins_loaded', 'wpc2o_start');

function wpc2o_start()
{
    if (class_exists('Woocommerce')) {
        add_filter('woocommerce_get_sections_products', 'wpc2o_options_page');
        add_filter('woocommerce_get_settings_products', 'wpc2o_options_page_settings', 10, 2);

        if (wpc2o_api_credentials_check()) {
            // styles & scripts
            add_action('admin_enqueue_scripts', 'wpc2o_assets');

            // plugin options
            add_action('after_setup_theme', 'wpc2o_options');
            add_filter('plugin_action_links_WPClothes2Order/wpclothes2order.php', 'wpc2o_settings_link');

            // Admin columns
            add_filter('manage_edit-product_columns', 'wpc2o_admin_products_c2o_column', 9999);
            add_action('manage_product_posts_custom_column', 'wpc2o_wc_c2o_product_column', 10, 2);
            add_filter('manage_edit-product_sortable_columns', 'wpc2o_admin_products_c2o_column_sortable');

            // Product options
            add_filter("product_type_options", 'wpc2o_add_product_type_options');
            add_filter('woocommerce_product_data_tabs', 'wpc2o_filter_woocommerce_product_data_tabs', 10, 1);
            add_action("save_post_product", 'wpc2o_save_post_product', 10, 3);
            add_action('admin_footer', 'wpc2o_wc_action_admin_footer');
            add_action('woocommerce_product_data_panels', 'wpc2o_wc_product_data_tab_content');
            add_filter('woocommerce_allow_marketplace_suggestions', '__return_false', 10);

            // wpc2o plugin option fields
            add_action('carbon_fields_register_fields', 'wpc2o_theme_options');

            // register cron

            // register on place order
        } else {
            new Notices('error', 'Missing WPClothes2Order API credentials. Please add them <a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o">here</a>', false);
        }
    } else {
        new Notices('error', 'Woocommerce is required to use WPClothes2Order!', false);
    }
}
