<?php

/**
 * Plugin Name:          WPClothes2Order
 * Plugin URI:           https://wpclothes2order.com
 * Description:          Unofficial WooCommerce Plugin for <a href="https://www.clothes2order.com/">Clothes2Order</a>
 * Version:              1.1.5
 * Plugin URI:           https://www.wpclothes2order.com
 * Author:               AJR Software
 * Author URI:           https://www.ajrsoftware.com
 * License               GPL v3 or later
 * Text Domain:          wpc2o
 * Domain Path:          /languages
 * Requires at least:    6.0
 * Requires PHP:         8.0
 * Tested up to:         6.5
 * WC requires at least: 8.0
 * WC tested up to:      8.8
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

require_once 'vendor/autoload.php';
require_once 'includes/wpc2o-constant.php';

require_once 'classes/WPC2O_C2O_Product.php';
require_once 'classes/WPC2O_Email.php';
require_once 'classes/WPC2O_OrderRequest.php';
require_once 'classes/WPC2O_Notice.php';
require_once 'classes/WPC2O_Stock_Sync.php';

require_once 'includes/wpc2o-scripts.php';
require_once 'includes/wpc2o-wc-options.php';
require_once 'includes/wpc2o-options.php';
require_once 'includes/wpc2o-options-getting-started.php';
require_once 'includes/wpc2o-options-api.php';
require_once 'includes/wpc2o-options-delivery.php';
require_once 'includes/wpc2o-options-logo.php';
require_once 'includes/wpc2o-options-orders.php';
require_once 'includes/wpc2o-options-stock.php';
require_once 'includes/wpc2o-orders.php';
require_once 'includes/wpc2o-cron.php';
require_once 'includes/wpc2o-register-rest-fields.php';
require_once 'includes/wpc2o-deactivate.php';

add_action('plugins_loaded', 'wpc2o_start');

function wpc2o_start()
{
    if (class_exists('Woocommerce')) {
        add_action(
            'before_woocommerce_init',
            function () {
                if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
                    \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
                }
            }
        );

        add_filter('woocommerce_get_sections_products', 'wpc2o_options_page');
        add_filter('woocommerce_get_settings_products', 'wpc2o_options_page_settings', 10, 2);

        if (wpc2o_api_credentials_check()) {
            // styles & scripts
            add_action('admin_enqueue_scripts', 'wpc2o_assets');

            // plugin options
            add_action('after_setup_theme', 'wpc2o_options');
            add_filter('plugin_action_links_WPClothes2Order/wpclothes2order.php', 'wpc2o_settings_link');

            // Admin products columns
            add_filter('manage_edit-product_columns', 'wpc2o_admin_products_c2o_column', 9999);
            add_action('manage_product_posts_custom_column', 'wpc2o_wc_c2o_product_column', 10, 2);

            // Admin orders columns
            add_filter('manage_edit-shop_order_columns', 'wpc2o_admin_orders_c2o_column', 9999);
            add_action('manage_shop_order_posts_custom_column', 'wpc2o_wc_c2o_order_column', 10, 2);

            // Plugin theme options
            add_action('carbon_fields_register_fields', 'wpc2o_theme_options');
            // Product options
            add_action('carbon_fields_register_fields', 'wpc2o_wc_theme_options');

            // register on place order
            add_action('woocommerce_order_status_processing', 'wpc2o_process_completed_order', 10, 1);

            // register rest fields
            add_action('rest_api_init', 'wpc2o_register_rest_fields');

            // register cron
            add_filter('cron_schedules', 'wpc2o_add_cron_interval');

            // GMT + 1 hour = BST
            if (!wp_next_scheduled('wpc2o_cron_hook')) {
                wp_schedule_event(strtotime('17:30:00'), 'wpc2o_everday_at_four_thirty_am', 'wpc2o_cron_hook');
            }
            add_action('wpc2o_cron_hook', 'wpc2o_stock_sync_cron');

            register_deactivation_hook(__FILE__, 'wpc2o_deactivate');
        } else {
            new WPC2O_Notice('error', 'Missing WPClothes2Order API credentials. Please add them <a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o">here</a>', false);
        }
    } else {
        new WPC2O_Notice('error', 'Woocommerce is required to use WPClothes2Order!', false);
    }
}
