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

            $variation_id = $item->get_product_id();
            $variation_product = wc_get_product($variation_id);
            $product = wc_get_product($variation_product->get_parent_id());
            $product_id = $product->get_id();
            $logos_for_item = [];


            if (has_term('clothing', 'product_cat', $product_id)) {

                $this->setLogoData('tops', 'product_cat', $product_id, 'top', [
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
                $this->setLogoData('bottoms', 'product_cat', $product_id, 'bottom', [
                    'lp' => 15, // Left pocket
                    'rp' => 16 // Right pocket
                ]);
                $this->setLogoData('hats', 'product_cat', $product_id, 'hat', ['front' => 11]); // Front
                $this->setLogoData('bags', 'product_cat', $product_id, 'bag', ['front' => 13]); // Front
                $this->setLogoData('tea-towels', 'product_cat', $product_id, 'tt', ['center' => 14]); // Center
                $this->setLogoData('tie', 'product_cat', $product_id, 'tie', ['front' => 19]); // Front

                $api_product = [
                    [
                        'sku' => $variation_product->get_sku(),
                        'quantity' => 1,
                        'logos' => [
                            'logo' => $logos_for_item,
                        ],
                    ]
                ];

                $products[] = $api_product;

                return;
            }
        }

        $this->sendRequest($order, $products);
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
            'unique_id' => 'TEST_01', // unsure
            'file' => $logo_url,
            'position' => $position_value,
            'width' => $logo_width,
            'type' => 'print'
        ];
    }

    /**
     * @param $term
     * @param $taxonomy
     * @param $product_id
     * @param $prefix
     * @param $positions
     *
     * @return array
     */
    protected function setLogoData($term, $taxonomy, $product_id, $prefix, $positions): array
    {
        $logos_for_item = [];
        if (has_term($term, $taxonomy, $product_id)) {
            foreach ($positions as $position => $position_value) {
                $included = get_field($prefix . '_' . $position . '_group_include', $product_id); // post_id
                $logo_url = get_field($prefix . '_' . $position . '_group_logo', $product_id);
                $logo_width = get_field($prefix . '_' . $position . '_group_logo_width', $product_id);
                if ($included && $logo_url && $logo_width) $logos_for_item[] = $this->createSingleLogoPayload($logo_url, $logo_width, $position_value);
            }
        }
        return $logos_for_item;
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
                'order_id' => $order->get_id(),
                'order_notes' => $order->get_customer_order_notes(),
                'delivery_method' => 'standard' // TODO what can we do here?
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

    /**
     * @param $order
     * @param $products
     */
    protected function sendRequest($order, $products)
    {
        $api_endpoint = get_option('clothes-2-order_endpoint');

        $response = wp_remote_post($api_endpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Test-Mode' => 'true'
            ],
            'body' => wp_json_encode($this->buildPayload($order, $products)),
        ]);

        $order->update_meta_data('_clothes_2_order_response_value', 'PUT RESPONSE HERE');
    }
}
