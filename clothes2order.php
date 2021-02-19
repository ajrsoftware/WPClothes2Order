<?php

/**
 * Clothes 2 Order plugin for WordPress
 *
 * @package   clothes2order
 * @link      
 * @author    Reuben Porter <porterdmu@gmail.com> & Ashley Redman <ash.redman@outlook.com>
 * @copyright 2021 AR Development
 * @license   GPL v2 or later
 *
 * Plugin Name:  Clothes 2 Order
 * Description:  Clothes 2 Order custom plugin for WordPress
 * Version:      1.2
 * Plugin URI:
 * Author:       Reuben Porter & Ashley Redman
 * Author URI:   
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

require_once 'inc/constants.php';

add_action('plugins_loaded', function () {

    if (class_exists('Woocommerce')) {

        // 1. Create a WC Settings admin area
        add_filter('woocommerce_get_sections_products', 'wcUICreate');
        add_filter('woocommerce_get_settings_products', 'wcUISettings', 10, 2);

        if (get_option('clothes-2-order_api_key') && get_option('clothes-2-order_endpoint') && get_option('clothes-2-order_product_cat_term')) {
            // 2. Check & create specific taxonomy terms to determine which products to check in a basket
            add_action('init', 'createProductCatTerms');

            //3. Update the UI of the product_cat c2o terms to be radio buttons & not check boxes

            // 4. Add any additional product fields
            add_action('woocommerce_product_after_variable_attributes', 'productVariationFieldsSettings', 10, 3);
            add_action('woocommerce_save_product_variation', 'productVariationFieldsSave', 10, 2);

            // 5. On payment complete, 'run' the basket & post API calls for each basket item if meeting requirement
            add_action('woocommerce_payment_complete', 'processNewOrder');
            add_action('woocommerce_checkout_create_order', 'updateOrderMeta', 10, 2);
            add_action('woocommerce_admin_order_data_after_order_details', 'updateOrderUI', 10, 1);
        } else {
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>' . _('Please ensure you complete the Clothes2Order required settings <a href="/wp-admin/admin.php?page=wc-settings&tab=products&section=clothes-2-order">here</a>') . '</p></div>';
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

    $fields->updatePostMetaForTops($variation_id, $loop);

    $product_variation = wc_get_product($variation_id);
    $parent_product = wc_get_product($product_variation->get_parent_id());

    if (has_term('tops', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForTops($variation_id, $loop);
    }

    if (has_term('bottoms', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForBottoms($variation_id, $loop);
    }

    if (has_term('hats', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForHats($variation_id, $loop);
    }

    if (has_term('bags', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForBags($variation_id, $loop);
    }

    if (has_term('tea-towels', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForTeaTowels($variation_id, $loop);
    }

    if (has_term('tie', 'product_cat', get_post($parent_product->ID))) {
        return $fields->updatePostMetaForTies($variation_id, $loop);
    }
}

/**
 * @param $order_id
 */
function processNewOrder($order_id)
{
    require_once plugin_dir_path(__FILE__) . '/classes/Order.php';
    $order = new clothes2order\classes\Order();
    $order->checkBasket($order_id);
}

/**
 * @param $order
 * @param $data
 */
function updateOrderMeta($order, $data)
{
    $order->update_meta_data('_clothes_2_order_response_value', 'C2O TEST');
}

/**
 * @param $order
 */
function updateOrderUI($order)
{
    if ($key = $order->get_meta('_clothes_2_order_response_value')) {
        if ($value = $order->get_meta('_clothes_2_order_response_value')) {
            echo '<br style="clear:both"><p><strong>' . __("Clothes 2 Order Response", "clothes-2-order") . ':</strong> ' . $value . '</p>';
        }
    }
}
