<?php

/**
 * Show current api credentials and an example request
 * @return string 
 */
function wpc2o_get_api_view(): string
{
    $content  = '<h1>API Credentials</h1>';
    $content .= '<div style="padding:6px 0;">';
    $content .= '<ol style="margin-left: 16px;">';
    $content .= '<li>Test mode: <strong>' . get_option(constant('WPC2O_API_TEST_MODE')) . '</strong></li>';
    $content .= '<li>Key: <strong>' . get_option(constant('WPC2O_API_KEY')) . '</strong></li>';
    $content .= '<li>Order endpoint: <strong>' . get_option(constant('WPC2O_API_ENDPOINT')) . '</strong></li>';
    $content .= '<li>Stock endpoint: <strong>' . get_option(constant('WPC2O_API_STOCK_ENDPOINT')) . '</strong></li>';
    $content .= '<li>Store manager email: <strong>' . get_option(constant('WPC2O_API_STORE_MANAGER_EMAIL')) . '</strong></li>';
    $content .= '</div>';
    $content .= '<a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o" style="margin: 10px 0;" class="button">Update your API credentials</a>';
    $content .= '<hr>';
    $content .= '<h2 style="padding-left:0;">Example request sent to Clothes2Order</h2>';
    $content .= '<p style="margin-top: 0;">The below example will be useful to provide to Clothes2Order if you encounter any issues</p>';
    $content .= '<button id="wpc2o-expand-api-request" class="button button-primary">Show example request</button>';
    $content .= '<button id="wpc2o-copy-api-request" style="margin-left:12px;" class="button">Copy to clipboard</button>';
    $content .= '<pre id="wpc2o-example-json"><code>';
    $json     = '
            {
                "api_key": "' . get_option(constant('WPC2O_API_KEY')) . '",
                "order": {
                    "order_id": "WOOCOMMERCE_ORDER_ID_HERE",
                    "order_notes": "WOOCOMMERCE_ORDER_NOTES_HERE",
                    "delivery_method": "WPC2O_DELIVERY_OPTION_HERE"
                },
                "customer": {
                    "name": "John Doe",
                    "email": "john@doe.com",
                    "telephone": ""
                },
                "address": {
                    "delivery_name": "John Doe",
                    "company_name": "Company 123",
                    "address_line_1": "123 Example street",
                    "address_line_2": "",
                    "city": "London",
                    "postcode": "NG12 345",
                    "country": "GB"
                },
                "products": {
                    "product": [
                        {
                            "sku": "WP_CLOTHES_2_ORDER_SKU_HERE",
                            "quantity": "WOOCOMMERCE_PRODUCT_QUANTITY_HERE",
                            "logos": {
                                "logo": [
                                    {
                                        "unique_id": "WOOCOMMERCE_ORDER_ITEM_ID_HERE",
                                        "file": "WP_CLOTHES_2_ORDER_IMAGE_URL_HERE",
                                        "position": "WP_CLOTHES_2_ORDER_POSITION_HERE",
                                        "width": "WP_CLOTHES_2_ORDER_WIDTH_HERE",
                                        "type": "WP_CLOTHES_2_ORDER_PRINT_TYPE_HERE"
                                    }
                                ]
                            }
                        }
                    ]
                }
            }
        ';
    $content .= wpc2o_code_block($json);
    $content .= '</code></pre>';

    return $content;
}
