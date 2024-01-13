<?php

/**
 * Return the getting started guide.
 * @return string 
 */
function wpc2o_getting_started_view(): string
{
    $content  = '<h1>Getting started</h1>';
    $content .= '<div style="padding: 0 1px">';
    $content .= '<article style="line-height: 1.75;">';
    $content .= '<p>WPClothes2Order is a WordPress plugin that provides intergration between WooCommerce and Clothes2Order.<br>';
    $content .= 'This plugin provides various different features and options to be as flexible as possible when working with Clothes2Order, however<br>';
    $content .= 'please note, this is not an offical plugin provided by Clothes2Order, so any changes from Clothes2Order may result in failed orders.</p>';
    $content .= '<p>Please ensure you have an understanding on WooCommerce before attempting to use this plugin.</p>';
    $content .= '<p>Thank you for using the <a href="https://www.wpclothes2order.com/" target="_blank" rel="noopener noreferrer">WPClothes2Order</a> WooCommerce integration for Clothes2Order.</p>';
    $content .= '<hr>';
    $content .= '<div style="margin: 24px 0;">';
    $content .= '<h3>Quick setup &#38; usage instructions</h3>';
    $content .= '<ol style="margin-left:12px;padding-left:12px;">';
    $content .= '<li>Please review all documentation on this page as well as the other tabs to ensure understanding of the purpose of this plugin so you know if it is right for your use case.</li>';
    $content .= '<li>Ensure the <a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o">API credentials</a> you have entered are correct. Incorrect details will mean any attempt to use the <u>auto ordering</u> feature will fail.</li>';
    $content .= '<li>Add a new / Edit a WooCommerce Product.</li>';
    $content .= '<li>There will be a new meta section titled with <u>WPClothes2order</u>.</li>';
    $content .= '<li>Select the option to enable this product as a Clothes2Order product.</li>';
    $content .= '<li>Once selected, you will then see a range of other available options which you need to complete.</li>';
    $content .= '<li>Once all fields are completed appropriately, the product is now setup for ready to be sent to Clothes2Order when it is purchased.</li>';
    $content .= '<li>When this product is purchased & the <u>auto order</u> option is enabled, an attempt to send the purchase request to Clothes2Order will happen.</li>';
    $content .= '<li>The result of that request will be added to the order notes, so please review the order notes of orders which contain marked Clothes2Order products.</li>';
    $content .= '<li>If the purchase went through, the order note will let you know that, however if the request failed, the order note should show the reason provided by Clothes2Order.</li>';
    $content .= '<li>If a purchase failed to go through to Clothes2Order, please get in touch with <a href="https://www.clothes2order.com/help-support.php" target="_blank" rel="noopener noreferrer">Clothes2Order</a> as the failure possibly occured on their side and not this plugin.</li>';
    $content .= '</ol>';
    $content .= '</div>';
    $content .= '<hr>';
    $content .= '<h3>Feedback</h3>';
    $content .= '<p>More details on how to get setup can be found on our <a href="https://www.wpclothes2order.com/getting-started" target="_blank" rel="noopener noreferrer">getting started guide</a>.</p>';
    $content .= '<p>For any queries, please <a href="https://github.com/ajrsoftware/WPClothes2Order/issues" target="_blank" rel="noopener noreferrer">open a new GitHub issue</a> on our public repository.</p>';
    $content .= '<p>If you have any feedback or ideas on how we could improve this integration, please open a new <a href="https://github.com/ajrsoftware/WPClothes2Order/discussions/new?category=ideas" target="_blank" rel="noopener noreferrer">idea discussion</a> on our forum.</p>';
    $content .= '</article>';
    $content .= '</div>';

    return $content;
}
