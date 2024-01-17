<?php

/**
 * Get all processed WPC2O enabled orders 
 * @return \WC_Order[]
 */
function wpc2o_order_history()
{
    $args = array(
        'meta_key'     => '_wpc2o_order_processed',
        'meta_value'   => '1',
        'meta_compare' => '=',
        'return'       => 'ids',
    );

    $orders = wc_get_orders($args);
    $posts  = array();

    foreach ($orders as $id) {
        $posts[] = new WC_Order($id);
    }

    return $posts;
}

/**
 * Display a list of all procssed WPC2O orders
 * @return string 
 */
function wpc2o_get_order_history_view(): string
{
    $content  = '<h1>Order history</h1>';
    $content .= '<div style="padding: 12px 0;">';

    $orders = wpc2o_order_history();
    if (count($orders) <= 0) {
        $content .= '<p>No orders to show</p>';
    } else {
        $content .= '<table style="position:relative;" class="wp-list-table widefat fixed striped table-view-list posts"><thead>';
        $content .= '<tr>';
        $content .= '<th style="width:30px;" class="manage-column column-order_number column-primary">ID</th>';
        $content .= '<th style="width:90px;" class="manage-column column-order_number column-primary">Status</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Date</th>';
        $content .= '<th class="manage-column column-order_number column-primary">API response</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Billing email</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Payment method</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Order payload</th>';
        $content .= '</tr';
        $content .= '</thead>';
        $content .= '<tbody>';

        foreach ($orders as $order) {

            $time          = get_the_date('c') . '" itemprop="datePublished">' . get_the_date('dS M Y', $order->ID);
            $c2o_result    = $order->get_meta('_wpc2o_order_c2o_result');
            $c2o_status    = $c2o_result ? '<span style="padding: 4px; color: green;">Order successful</span>' : '<span style="padding: 4px; color: red;">Order failed</span>';
            $billing_email = $order->get_meta('_billing_email');
            $payment_type  = $order->get_meta('_payment_method_title');

            $content .= '<tr>';
            $content .= '<td><a href="' . get_admin_url() . 'post.php?post=' . $order->ID . '&action=edit" >' . $order->ID . '</a></td>';
            $content .= '<td>' . $order->get_status() . '</td>';
            $content .= '<td><time datetime="' . $time . '</time></td>';
            $content .= '<td>' . $c2o_status . '</td>';
            $content .= '<td><a href="mailto:' . $billing_email . '" target="_blank" rel="noopener noreferrer">' . $billing_email . '</a></td>';
            $content .= '<td>' . $payment_type . '</td>';
            $content .= '<td><input type="submit" name="wpc2o-view-order-payload-' . $order->ID . '" id="wpc2o-view-order-payload-' . $order->ID . '" class="button wpc2o-view-order-payload" value="View order payload" /><div id="wpc2o-view-payload-modal-' . $order->ID . '" class="wpc2o-view-payload-modal">' . wpc2o_view_order_payload($order) . '</div></td>';
            $content .= '</td>';
        }

        $content .= '</tbody></table>';
    }
    $content .= '</div>';
    return $content;
}

function wpc2o_code_block(string $code): string
{
    return '<pre class="wpc2o-code-block"><code>' . $code . '</code></pre>';
}

function wpc2o_order_head(string $head): string
{
    return '<strong>' . $head . ': </strong>';
}

/**
 * Content of this orders payload sent to C2O
 * @param \WC_Order $order 
 * @return string 
 */
function wpc2o_view_order_payload($order)
{
    $record   = $order->get_meta('_wpc2o_order_api_payload');
    $response = $order->get_meta('_wpc2o_order_api_response');

    $endpoint         = is_array($record) ? $record['endpoint'] : '';
    $headers          = is_array($record) ? $record['headers'] : '';
    $formated_headers = is_array($headers) ? implode($headers) : $headers;
    $record_body      = is_array($record) ? $record['body'] : '';

    $code    = is_array($response) ? $response['code'] : '';
    $message = is_array($response) ? $response['message'] : '';
    $body    = is_array($response) ? htmlspecialchars($response['body']) : '';

    $content  = '<section class="wpc2o-view-payload-modal-inner">';
    $content .= '<button class="wpc2o-view-payload-modal-copy button">Copy to clipboard</button>';
    $content .= '<button class="wpc2o-view-payload-modal-close button button-primary">Close</button>';
    $content .= '<div>' . wpc2o_order_head('Endpoint') . $endpoint . '</div>';
    $content .= '<div>' . wpc2o_order_head('Response code') . $code . '</div>';
    $content .= '<div>' . wpc2o_order_head('Response message') . $message . '</div>';
    $content .= '<div>' . wpc2o_order_head('Headers') . wpc2o_code_block($formated_headers) . '</div>';
    $content .= '<div>' . wpc2o_order_head('Response body') . wpc2o_code_block($body) . '</div>';
    $content .= '<div>' . wpc2o_order_head('Payload sent') . wpc2o_code_block($record_body) . '</div>';
    $content .= '</section>';

    return $content;
}
