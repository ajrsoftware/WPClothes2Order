<?php

namespace clothes2order\classes;

class Order
{
    /**
     * @param $order_id
     */
    public function checkBasket($order_id)
    {

        $order = wc_get_order($order_id);
        $products = [];

        foreach ($order->get_items() as $item_id => $item) {

            $logos_for_item = [];
            $variation_product = $item->get_product();
            if (!is_a($variation_product, 'WC_Product_Variation')) return;
            $parent_product = wc_get_product($variation_product->get_parent_id());
            $parent_product_id = $parent_product->get_id();

            if (has_term('clothing', 'product_cat', $parent_product_id)) {

                $logos_tops = $this->setLogoData('tops', 'product_cat', $parent_product_id, 'top', [
                    'rs' => 1, // Right sleeve
                    'br' => 2, // Bottom right
                    'rc' => 3, // Right center
                    'cc' => 4, // Center center
                    'lc' => 5, // Left center
                    'bl' => 6, // Bottom left
                    'ls' => 7, // Left sleeve
                    'cb' => 8, // Center back
                    'tb' => 9, // Top back
                    'tc' => 17, // Top chest
                    'ib' => 18 // Inside back (For printed labels)
                ]);
                if ($logos_tops) $logos_for_item[] = $logos_tops;

                $logos_bottoms = $this->setLogoData('bottoms', 'product_cat', $parent_product_id, 'bottom', [
                    'lp' => 15, // Left pocket
                    'rp' => 16 // Right pocket
                ]);
                if ($logos_bottoms) $logos_for_item[] = $logos_bottoms;

                $logos_hats = $this->setLogoData('hats', 'product_cat', $parent_product_id, 'hat', ['front' => 11]); // Front
                if ($logos_hats) $logos_for_item[] = $logos_hats;

                $logos_bags = $this->setLogoData('bags', 'product_cat', $parent_product_id, 'bag', ['front' => 13]); // Front
                if ($logos_bags) $logos_for_item[] = $logos_bags;

                $logos_tt = $this->setLogoData('tea-towels', 'product_cat', $parent_product_id, 'tt', ['center' => 14]); // Center
                if ($logos_tt) $logos_for_item[] = $logos_tt;

                $logos_tie = $this->setLogoData('tie', 'product_cat', $parent_product_id, 'tie', ['front' => 19]); // Front
                if ($logos_tie) $logos_for_item[] = $logos_tie;

                $api_product = [
                        'sku' => $variation_product->get_sku(),
                        'quantity' => strval($item->get_quantity()),
                        'logos' => [
                            'logo' => $logos_for_item,
                        ],
                    ];

                $products[] = $api_product;
            }
        }

        // Ensure we only send the request if the logos array contains valid data
        if (count($products) > 0) $this->sendRequest($order, $products);
    }

    /**
     * @param $term
     * @param $taxonomy
     * @param $product_id
     * @param $prefix
     * @param $positions
     *
     * @return mixed
     */
    protected function setLogoData($term, $taxonomy, $product_id, $prefix, $positions)
    {
        if (has_term($term, $taxonomy, $product_id)) {
            foreach ($positions as $position => $position_value) {
                $included = get_field($prefix . '_' . $position . '_group_include', $product_id); // post_id
                $logo_url = get_field($prefix . '_' . $position . '_group_logo', $product_id);
                $logo_width = get_field($prefix . '_' . $position . '_group_logo_width', $product_id);
                if ($included && $logo_url && $logo_width) return $this->createSingleLogoPayload($logo_url, $logo_width, $position_value);
            }
        }

        return false;
    }

    /**
     * @param $logo_url
     * @param $logo_width
     * @param $position_value
     *
     * @return array
     */
    protected function createSingleLogoPayload($logo_url, $logo_width, $position_value): array
    {
        return [
            'file' => $logo_url,
            'position' => strval($position_value),
            'width' => $logo_width,
            'type' => 'print'
        ];
    }

    /**
     * @param $order
     * @param $products
     */
    protected function sendRequest($order, $products)
    {
        $api_endpoint = get_option('clothes-2-order_endpoint');

        $test_mode = 'false';
        if (get_option('clothes-2-order_test_mode') === 'yes') $test_mode = 'true';

        $response = wp_remote_post($api_endpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Test-Mode' => $test_mode,
            ],
            'body' => wp_json_encode($this->buildPayload($order, $products)),
        ]);

        if ($response['response']['code'] === 400) {
            $decoded = json_decode($response['body']);

            if (is_array($decoded->status->msg)) {
                $error_msg = '';
                foreach ($decoded->status->msg as $msg_item) {
                    $error_msg .= ' ' . $msg_item;
                }
            } else {
                $error_msg = $decoded->status->msg;
            }

            $order->add_order_note('Clothes 2 Order API request failed - manual action to be taken');
            $order->update_meta_data('_clothes_2_order_error_msg', $error_msg);

            $to = get_option('clothes-2-order_email');
            $subject = 'Clothes 2 Order: failed order ' . $order->get_ID();
            $message = '<div>
                        <p>There has been an error with order ID: '. $order->get_ID() .'</p>
                        <a href="'. get_site_url() . '/wp-admin/post.php?post='. $order->get_ID() .'&action=edit' . '">Click here to view this order</a>
                        </div>';
            $headers = ['Content-Type: text/html; charset=UTF-8'];
            
            wp_mail($to, $subject, $message, $headers);
        }

        if ($response['response']['code'] === 200) {
            $decoded = json_decode($response['body']);

            $order->add_order_note('Clothes 2 Order API request successful');
            $order->update_meta_data('_clothes_2_order_order_ID', $decoded->order_details->order_id);
            $order->update_meta_data('_clothes_2_order_net_value', $decoded->order_details->net_order_value);
            $order->update_meta_data('_clothes_2_order_gross_value', $decoded->order_details->gross_order_value);
            $order->update_meta_data('_clothes_2_order_est_dispatch_date', $decoded->order_details->est_dispatch_date);
        }

        $order->save();
    }

    /**
     * @param $order
     * @param $products
     *
     * @return array
     */
    protected function buildPayload($order, $products): array
    {
        $api_key = get_option('clothes-2-order_api_key');

        return [
            'api_key' => $api_key,
            'order' => [
                'order_id' => strval($order->get_id()),
                'order_notes' => $order->get_customer_order_notes(),
                'delivery_method' => 'standard'
            ],
            'customer' => [
                'name' => $order->get_billing_first_name() . '' . $order->get_billing_last_name(),
                'email' => $order->get_billing_email(),
                'telephone' => $order->get_billing_phone(),
            ],
            'address' => [
                'delivery_name' => $order->get_billing_first_name() . '' . $order->get_billing_last_name(),
                'company_name' => $order->get_billing_company(),
                'address_line_1' => $order->get_billing_address_1(),
                'address_line_2' => $order->get_billing_address_2(),
                'city' => $order->get_billing_city(),
                'postcode' => $order->get_billing_postcode(),
                'country' => $order->get_billing_country()
            ],
            'products' => ['product' => $products],
        ];
    }
}
