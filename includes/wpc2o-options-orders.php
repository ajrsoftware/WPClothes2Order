<?php

/**
 * Get all processed WPC2O enabled orders 
 * @return \WP_Post[]|int[] 
 */
function wpc2o_order_history()
{
    $args = array(
        'post_status'    => 'all',
        'post_type'      => 'shop_order',
        'posts_per_page' => '-1',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'meta_query'     => array(
            array(
                'key'     => '_wpc2o_order_processed',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);
    return $query->posts;
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
        $content .= '<table style="position: relative;" class="wp-list-table widefat fixed striped table-view-list posts"><thead>';
        $content .= '<tr>';
        $content .= '<th style="width: 80px;" class="manage-column column-order_number column-primary">ID</th>';
        $content .= '<th style="width: 160px;" class="manage-column column-order_number column-primary">Status</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Order name</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Date</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Clothes2Order response</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Billing email</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Payment method</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Order payload</th>';
        $content .= '</tr';
        $content .= '</thead>';
        $content .= '<tbody>';

        foreach ($orders as $order) {
            $meta          = get_post_meta($order->ID);
            $time          = get_the_date('c') . '" itemprop="datePublished">' . get_the_date('dS M Y', $order);
            $c2o_result    = $meta['_wpc2o_order_c2o_result'][0];
            $c2o_status    = $c2o_result ? '<span style="padding: 4px; color: green;">Order successful</span>' : '<span style="padding: 4px; color: red;">Order failed</span>';
            $billing_email = $meta['_billing_email'][0];
            $payment_type  = $meta['_payment_method_title'][0];

            $content .= '<tr>';
            $content .= '<td><a href="' . get_admin_url() . 'post.php?post=' . $order->ID . '&action=edit" >' . $order->ID . '</a></td>';
            $content .= '<td>' . $order->post_status . '</td>';
            $content .= '<td>' . $order->post_title . '</td>';
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

/**
 * Content of this orders payload sent to C2O
 * @param \WP_Post $order 
 * @return string 
 */
function wpc2o_view_order_payload($order)
{
    $record   = get_post_meta($order->ID, '_wpc2o_order_api_payload', true);
    $response = get_post_meta($order->ID, '_wpc2o_order_api_response', true);

    $content  = '<div class="wpc2o-view-payload-modal-inner">';
    $content .= '<button class="wpc2o-view-payload-modal-copy button">Copy to clipboard</button>';
    $content .= '<button class="wpc2o-view-payload-modal-close button button-primary">Close</button>';
    $content .= '<div>Endpoint: ' . $record['endpoint'] . '</div>';
    $content .= '<div>Headers: ' . $record['headers'] . '<div>';
    $content .= '<div>Response code: ' . $response['code'] . '<div>';
    $content .= '<div>Response message: ' . $response['message'] . '<div>';
    $content .= '<div>Response body: ' . htmlspecialchars($response['body']) . '<div>';
    $content .= '<div>Payload sent:<div>';
    $content .= '<pre class="wpc2o-view-payload-modal-content"><code>';
    $content .= $record['body'];
    $content .= '</code></pre>';
    $content .= '</div>';

    return $content;
}
