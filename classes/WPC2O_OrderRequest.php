<?php

use Automattic\WooCommerce\Admin\Overrides\Order;

/**
 * WPC2O_Notice File Doc Comment
 *
 * @category WPC2O_Notice
 * @package  WPClothes2Order
 */
class WPC2O_OrderRequest
{

    /**
     * Attempt a WP remote post using our build payload
     * @param string $api_post_endpoint 
     * @param array $payload 
     * @param bool $test_mode 
     * @param string $api_key 
     * @param string $delivery_method 
     * @param Order $order 
     * @param array $products 
     * @return string 
     */
    public function send(
        string $api_post_endpoint,
        bool $test_mode,
        string $api_key,
        string $delivery_method,
        Automattic\WooCommerce\Admin\Overrides\Order $order,
        array $products
    ): string {
        $headers = array(
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        );

        if ($test_mode) {
            $headers += array('Test-Mode' => 'true');
        }

        $payload = $this->build_payload($api_key, $delivery_method, $order, $products);

        $response = wp_remote_post(
            $api_post_endpoint,
            array(
                'headers' => $headers,
                'body'    => wp_json_encode($payload),
            )
        );

        return $this->response_handler($response, $order->get_id());
    }

    /**
     * Build a request payload that is specified by C2O documentation
     * @param string $api_key 
     * @param string $delivery_method 
     * @param Automattic\WooCommerce\Admin\Overrides\Order $order 
     * @param WPC2O_C2O_Product[] $products 
     * @return array
     */
    private function build_payload(
        string $api_key,
        string $delivery_method,
        Automattic\WooCommerce\Admin\Overrides\Order $order,
        array $products
    ): array {
        $payload = array(
            'api_key'  => $api_key,
            'order'    => array(
                'order_id'        => strval($order->get_id()),
                'order_notes'     => $order->get_customer_order_notes() ?: '',
                'delivery_method' => $delivery_method,
            ),
            'customer' => array(
                'name'      => $order->get_billing_first_name() . '' . $order->get_billing_last_name(),
                'email'     => $order->get_billing_email(),
                'telephone' => $order->get_billing_phone(),
            ),
            'address'  => array(
                'delivery_name'  => $order->get_billing_first_name() . '' . $order->get_billing_last_name(),
                'company_name'   => $order->get_billing_company(),
                'address_line_1' => $order->get_billing_address_1(),
                'address_line_2' => $order->get_billing_address_2(),
                'city'           => $order->get_billing_city(),
                'postcode'       => $order->get_billing_postcode(),
                'country'        => $order->get_billing_country(),
            ),
            'products' => array(
                'product' => $products,
            ),
        );

        return $payload;
    }

    /**
     * Based on the response of the order reqest, handle the response and return a message
     * @param array|mixed $wp_response
     * @param int $order_id
     * @return string 
     */
    private function response_handler($wp_response, int $order_id): string
    {
        $success = true;
        $message = '';

        // WP_Error, i.e the request was not good, bad url etc
        if ($wp_response instanceof WP_Error) {
            $success = false;
            $message = $wp_response->get_error_message();
        }

        // C2O failure response
        if ($wp_response['response']['code'] !== 200) {
            $success               = false;
            $response_message      = $wp_response['response']['message'];
            $response_body_message = json_decode($wp_response['body'])->status->msg;
            $response_body_message = $response_body_message ? ' - ' . $response_body_message : '';
            $message               = $response_message . $response_body_message;
        }

        if (!$success) {
            $subject = 'WPC2O: Clothes2Order purchase failed for order ' . $order_id . ' - ' . $message . '';
            $body    = json_decode($wp_response['body'])->status->msg;
            $body   .= '<br /><strong">Contact Clothes2Order for support.</strong>';

            new WPC2O_Email(
                get_option(constant('WPC2O_API_STORE_MANAGER_EMAIL')) ?? get_option('admin_email'),
                $subject,
                $body
            );
        }

        return $message;
    }
}