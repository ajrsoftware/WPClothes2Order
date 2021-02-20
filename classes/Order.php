<?php

namespace clothes2order\classes;

use WC_Order_Item_Product;

class Order
{
    public function checkBasket($order_id)
    {
        $order = wc_get_order($order_id);
        $items = $order->get_items();


        foreach ($items as $item) {

            $variation_id = $item->get_product_id();
            $variation_product == wc_get_product($variation_id);
            $product = wc_get_product($variation_product->get_parent_id());


            // check its term
            if (has_term(get_option('clothes-2-order_product_cat_term'), 'product_cat', $product->get_id())) {

                // we know htis is a 'clothing' item
                $api_product = [
                    [
                        'sku' => $variation_product->get_sku(),
                        'quantity' => 1,
                        'logos' => [
                            [
                                //                     'unique_id' => 'TEST_01', // unsure
                                //                     'file' => 'https://c2o-customisation-images.s3-eu-west-1.amazonaws.com/5/8/7/d/transparent/587dd8b7651c44c68a29f118decbf740_316993.png?rand=503402',
                                //                     'position' => '4', // center chest
                                //                     'width' => '26', //30cm
                                //                     'type' => 'print' // unsure
                            ]
                        ]
                    ]
                ];

                // 'product' => [
                //     [
                //         'sku' => '594-117-15',
                //         'quantity' => '1',
                //         'logos' => [
                //             'logo' => [
                //                 [
                //                     'unique_id' => 'TEST_01', // unsure
                //                     'file' => 'https://c2o-customisation-images.s3-eu-west-1.amazonaws.com/5/8/7/d/transparent/587dd8b7651c44c68a29f118decbf740_316993.png?rand=503402',
                //                     'position' => '4', // center chest
                //                     'width' => '26', //30cm
                //                     'type' => 'print' // unsure
                //                 ]
                //             ]
                //         ],
                //     ]
                // ],

                // Now check what sub term it has (tops, bottoms etc)
                if (has_term('tops', 'product_cat', $product->get_id())) {

                    $tops_rs = get_post_meta($variation_id, 'c2o_tops_logo_position_rs', true); // 1
                    $tops_br = get_post_meta($variation_id, 'c2o_tops_logo_position_br', true); // 2
                    $tops_rc = get_post_meta($variation_id, 'c2o_tops_logo_position_rc', true); // 3
                    $tops_cc = get_post_meta($variation_id, 'c2o_tops_logo_position_cc', true); // 4
                    $tops_lc = get_post_meta($variation_id, 'c2o_tops_logo_position_lc', true); // 5
                    $tops_bl = get_post_meta($variation_id, 'c2o_tops_logo_position_bl', true); // 6
                    $tops_ls = get_post_meta($variation_id, 'c2o_tops_logo_position_ls', true); // 7
                    $tops_cb = get_post_meta($variation_id, 'c2o_tops_logo_position_cb', true); // 8
                    $tops_tb = get_post_meta($variation_id, 'c2o_tops_logo_position_tb', true); // 9
                    $tops_tc = get_post_meta($variation_id, 'c2o_tops_logo_position_tc', true); // 17
                    $tops_ib = get_post_meta($variation_id, 'c2o_tops_logo_position_ib', true); // 18

                    $bottoms_lp = get_post_meta($variation_id, 'c2o_bottoms_logo_position_lb', true); // 15
                    $bottoms_rp = get_post_meta($variation_id, 'c2o_bottoms_logo_position_rb', true); // 16

                    $hats_front = get_post_meta($variation_id, 'c2o_hats_logo_position_front', true); // 11

                    $bags_front = get_post_meta($variation_id, 'c2o_bags_logo_position_front', true); // 13

                    $tea_towel_center = get_post_meta($variation_id, 'c2o_tt_logo_position_center', true); // 14

                    $tie_front = get_post_meta($variation_id, 'c2o_ties_logo_position_front', true); // 19

                    $logo = [
                        'file' => '' // paste in url to logo here
                    ];
                //                     'unique_id' => 'TEST_01', // unsure
                //                     'file' => 'https://c2o-customisation-images.s3-eu-west-1.amazonaws.com/5/8/7/d/transparent/587dd8b7651c44c68a29f118decbf740_316993.png?rand=503402',
                //                     'position' => '4', // center chest
                //                     'width' => '26', //30cm
                //                     'type' => 'print' // unsure
                //                 ]
                    if ($tops_rs) {
                        $value = 1;

                    }

                    if ($tops_br) {
                        $value = 2;
                    }
                }

                // now that we know what sub term, ew can get for exact meta fields


                // check its meta field status, ticked or not ticked for otps right sleve etc


                //                $response = wp_remote_post(self::API_POST_ORDER_ENDPOINT, [
                //                    'headers' => [
                //                        'Content-Type' => 'application/json',
                //                        'Accept' => 'application/json',
                //                        'Test-Mode' => 'true'
                //                    ],
                //                    'body' => wp_json_encode($this->buildPayload()),
                //                ]);


                return;
            }
        }
    }

    protected function buildPayload(): array
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
                // stuff goes here
            ]
        ];
    }
}
