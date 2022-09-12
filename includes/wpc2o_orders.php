<?php

/**
 * For every order that goes through, we need to check if any order items are enabled as WPC2O products
 * If so, then we need to get their current WPC2O config and send that to C2O
 * @param int $order_id 
 * @return void 
 */
function wpc2o_process_completed_order(int $order_id): void
{
    //
    $order = wc_get_order($order_id);
    $products = array();

    foreach ($order->get_items() as $product) {
        // If product is WPC2O enabled && product has flagged auto orders
        if ($product) {
            $products[] = new WPC2O_C2O_Product($product);
        }
    }

    $response_message = new WPC2O_OrderRequest('', '', '', '', $order, $products);
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
