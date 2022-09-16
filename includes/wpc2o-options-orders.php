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
        $content .= '<table class="wp-list-table widefat fixed striped table-view-list posts"><thead>';
        $content .= '<tr>';
        $content .= '<th style="width: 80px;" class="manage-column column-order_number column-primary">ID</th>';
        $content .= '<th style="width: 160px;" class="manage-column column-order_number column-primary">Status</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Order name</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Date</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Clothes2Order response</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Billing email</th>';
        $content .= '<th class="manage-column column-order_number column-primary">Payment method</th>';
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
            $content .= '</td>';
        }

        $content .= '</tbody></table>';
    }
    $content .= '</div>';
    return $content;
}
