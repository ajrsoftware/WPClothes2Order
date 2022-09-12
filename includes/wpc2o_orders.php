<?php

/**
 * For every order that goes through, we need to check if any order items are enabled as WPC2O products
 * If so, then we need to get their current WPC2O config and send that to C2O
 * @param int $order_id 
 * @return void 
 */
function wpc2o_process_completed_order(int $order_id): void
{
    $order = wc_get_order($order_id);
    $processed = $order->get_meta('_wpc2o_order_processed');

    if ($processed) {
        $products = array();

        foreach ($order->get_items() as $product) {
            $meta = get_post_meta($product->get_product_id());
            $is_wpc2o_product = $meta['_' . constant("WPC2O_PRODUCT_ENABLED") . ''][0] === 'yes';
            $is_auto_order_enabled = $meta['_' . constant("WPC2O_PRODUCT_API") . ''][0];

            if ($is_wpc2o_product && $is_auto_order_enabled) {
                $products[] = new WPC2O_C2O_Product($product);
            }
        }

        if (count($products) > 0) {
            $test_mode = get_option(constant("WPC2O_API_TEST_MODE"));
            $api_post_endpoint = get_option(constant("WPC2O_API_ENDPOINT"));
            $api_key = get_option(constant("WPC2O_API_KEY"));
            $delivery_method = carbon_get_theme_option(constant("WPC2O_DELIVERY_OPTION"));

            $response_message = new WPC2O_OrderRequest($test_mode, $api_post_endpoint, $api_key, $delivery_method, $order, $products);
            $order->add_order_note($response_message);
        }

        $order->update_meta_data('_wpc2o_order_processed', true);
        $order->save();
    }
}

/**
 * TODO
 * @param mixed $order 
 * @return void 
 */
function wpc2o_update_order_notes($order): void
{
    //
}
