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
 * Text Domain:  clothes-2-order
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

        // 1. Create a WC Settings admin area
        add_filter('woocommerce_get_sections_products', 'wcUICreate');
        add_filter('woocommerce_get_settings_products', 'wcUISettings', 10, 2);

        if (get_option('clothes-2-order_api_key') && get_option('clothes-2-order_endpoint') && get_option('clothes-2-order_product_cat_term')) {
            // 2. Check & create specific taxonomy terms to determine which products to check in a basket
            add_action('init', 'createProductCatTerms');

            // 3. Add any additional product fields
            add_action('woocommerce_product_after_variable_attributes', 'productVariationFieldsSettings', 10, 3);
            add_action('woocommerce_save_product_variation', 'productVariationFieldsSave', 10, 2);
            add_filter('woocommerce_available_variation', 'productVariationFieldsLoad');

            // 4. On payment complete, 'run' the basket & post API calls for each basket item if meeting requirement
            add_action('woocommerce_payment_complete', 'processNewOrder');
        } else {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>' . _('Please ensure you add the Clothes2Order required settings <a href="/wp-admin/admin.php?page=wc-settings&tab=products&section=clothes-2-order">here</a>') . '</p></div>';
            }, 10, 2);
        }

    } else {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>' . _('Woocommerce is required to use the Clothes2Order Plugin!') . '</p></div>';
        }, 10, 2);
    }
});

/**
 * @param $sections
 *
 * @return mixed
 */
function wcUICreate($sections)
{
    $sections['clothes-2-order'] = __('Clothes 2 Order', 'clothes-2-order');
    return $sections;
}

/**
 * @param $settings
 * @param $current_section
 *
 * @return array
 */
function wcUISettings($settings, $current_section): array
{
    if ($current_section == 'clothes-2-order') {
        $settings_c2o = [];

        $settings_c2o[] = [
            'name' => __('Clothes 2 Order Settings', 'clothes-2-order'),
            'type' => 'title',
            'desc' => __('The following options are used to configure the Clothes 2 Order connection & WordPress settings.', 'clothes-2-order'),
            'id' => 'clothes-2-order'
        ];

        $settings_c2o[] = [
            'name' => __('API Key', 'clothes-2-order'),
            'desc_tip' => __('This is the unique API key provided by Clothes2Order', 'clothes-2-order'),
            'id' => 'clothes-2-order_api_key',
            'type' => 'password',
            'desc' => __('API key provided by Clothes2Order', 'clothes-2-order'),
        ];

        $settings_c2o[] = [
            'name' => __('API Endpoint', 'clothes-2-order'),
            'desc_tip' => __('This is the unique URL that is used to communicate with Clothes2Order', 'clothes-2-order'),
            'id' => 'clothes-2-order_endpoint',
            'type' => 'text',
            'desc' => __('URL that is used to communicate with Clothes2Order', 'clothes-2-order'),
        ];

        $settings_c2o[] = [
            'name' => __('Product Category Name', 'clothes-2-order'),
            'desc_tip' => __('The product category you will put products in that will be sent to Clothes2Order', 'clothes-2-order'),
            'id' => 'clothes-2-order_product_cat_term',
            'type' => 'text',
            'desc' => __('The product category you will put products in that will be sent to Clothes2Order', 'clothes-2-order'),
        ];

        $settings_c2o[] = [
            'type' => 'sectionend', 'id' => 'clothes-2-order'
        ];

        return $settings_c2o;
    } else {
        return $settings;
    }
}

/**
 *
 */
function createProductCatTerms(): void
{
    require_once plugin_dir_path(__FILE__) . '/classes/ProductTerms.php';
    $productTerms = new clothes2order\classes\ProductTerms();

    $name = get_option('clothes-2-order_product_cat_term');
    $slug = sanitize_title_with_dashes($name);
    $description = 'Clothes 2 Order Product Category';

    $productTerms->ensureTermsExist('product_cat', $slug, $name, $description);
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
    require_once plugin_dir_path(__FILE__) . '/classes/VariableProductField.php';
    $fields = new clothes2order\classes\VariableProductField();

    if ($fields->checkIfHasTerm($variation)) {
        $fields->load_variation_settings_fields($variation);
    }
}

/**
 * @param $order_id
 */
function processNewOrder($order_id)
{
    require_once plugin_dir_path(__FILE__) . '/classes/Order.php';
    $order = new clothes2order\classes\Order($order_id);
}