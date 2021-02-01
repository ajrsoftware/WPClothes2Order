<?php

namespace clothes2order\classes;

class Order {

    CONST API_KEY = 'not saved in repo';
    CONST API_POST_ORDER_ENDPOINT = 'https://www.clothes2order.com/api/post-order/';

    private $order;

    public function __construct($order_id)
    {
        $this->order = wc_get_order($order_id);
        $this->checkBasket();
    }

    protected function checkBasket()
    {
        // TODO check the basket for clothing items
        // foreach clothing basket item, build a payload
    }

    protected function buildPayload() : array
    {
        // TODO build the post structure

        return [
            'api_key' => self::API_KEY,
            'order' => [
                'order_id' => "1234",
                'order_notes' => "Order notes here",
                'delivery_method' => 'standard'
            ],
            'customer' => [
                'name' => 'john doe',
                'email' => 'john@example.com',
                'telephone' => '0 123 456 789',
            ],
            'address' => [
                'delivery_name' => 'Name',
                'company_name' => 'Quayside Clothing Ltd',
                'address_line_1' => 'Unit 9 Wheel Forge Way',
                'address_line_2' => 'Trafford Park',
                'city' => 'Manchester',
                'postcode' => 'M17 1EH',
                'country' => 'United Kingdom'
            ],
            'products' => [
                'product' => [
                    [
                        'sku' => '594-117-15',
                        'quantity' => '1',
                        'logos' => [
                            'logo' => [
                                [
                                    'unique_id' => 'TEST_01', // unsure
                                    'file' => 'https://c2o-customisation-images.s3-eu-west-1.amazonaws.com/5/8/7/d/transparent/587dd8b7651c44c68a29f118decbf740_316993.png?rand=503402',
                                    'position' => '4', // center chest
                                    'width' => '26', //30cm
                                    'type' => 'print' // unsure
                                ]
                            ]
                        ],
                    ]
                ],
            ]
        ];
    }

    protected function postOrder()
    {
        $response = wp_remote_post(self::API_POST_ORDER_ENDPOINT, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Test-Mode' => 'true'
            ],
            'body' => wp_json_encode($this->buildPayload()),
        ]);
    }
}