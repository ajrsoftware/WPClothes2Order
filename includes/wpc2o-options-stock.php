<?php

/**
 * TODO
 * @return string 
 */
function wpc2o_get_stock_view(): string
{
    $content  = '<h1>Stock synchronization</h1>';
    $content .= '<div style="padding: 0 1px">';
    $content .= '<article style="line-height: 1.75;">';
    $content .= '<p>Every day at 4:30am(BST / UCT + 1), this plugin will pull down the Clothes2Order products.csv <br>';
    $content .= 'and sync your local woocommerce store for products that are enabled as Clothes2Order products with their stock status.</p>';
    $content .= '<p>Additionally, this plugin also sets the stock level on the product, however if you do not wish / care about stock levels, you can disable it below.</p>';

    return $content;
}
