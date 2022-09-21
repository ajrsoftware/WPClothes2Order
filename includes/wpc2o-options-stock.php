<?php

/**
 * Return the stock sync intro text
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
    $content .= '<p>Please note, Clothes2Order update their stock status & levels are 3:30am BST once a day, attempting to sync more than once a day will yield no results.</p>';

    return $content;
}

/**
 * Return the manual stock sync page
 * @return string 
 */
function wpc2o_manual_stock_sync_trigger_view(): string
{
    $content  = '<h4>Stock synchronization</h4>';
    $content .= '<div style="padding: 0 1px">';
    $content .= '<form id="wpc2o-manual-stock-sync-trigger">';
    $content .= '<input type="submit" name="wpc2o-manual-stock-sync-trigger-button" id="wpc2o-manual-stock-sync-trigger-button" style="display: block;margin-bottom: 16px;" class="button" value="Trigger a manual sync" />';
    $content .= '<label for="wpc2o-manual-stock-sync-trigger-button" style="display: block;">Please note, a manual stock sync may take some time, please do <strong>not</strong> close this page.</label>';
    $content .= '</form>';
    $content .= '</div>';

    return $content;
}
