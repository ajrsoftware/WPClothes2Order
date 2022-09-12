<?php

/**
 * TODO 
 * @return array 
 */
function wpc2o_order_history(): array
{
    return array();
}

/**
 * TODO
 * @return string 
 */
function wpc2o_get_order_history_view(): string
{
    $content = '<h1>Full order history</h1>';
    $content .= '<div style="padding: 0 12px">';

    $orders = wpc2o_order_history();
    if (count($orders) <= 0) {
        $content .= '<p>No orders to show</p>';
    } else {
        // pass to template
        $content .= '<p>TODO</p>';
    }
    $content .= '</div>';
    return $content;
}
