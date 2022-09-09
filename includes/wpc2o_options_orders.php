<?php

function wpc2o_order_history(): array
{
    return array();
}

function wpc2o_get_order_history_view(): string
{
    $content = '<h2>Full order history</h2>';
    $content .= '<div style="padding: 0 12px">';

    $orders = wpc2o_order_history();
    if (count($orders) <= 0) {
        $content .= '<p>No orders to show</p>';
    } else {
        // pass to template
        $content .= '<p>TODO</p>';
    }
    $content .= '</div>';

    $content .= '<div data-component="ProductList">failed to load</div>';
    return $content;
}
