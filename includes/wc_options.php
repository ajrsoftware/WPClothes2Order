<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function wpc2o_api_credentials_check(): bool
{
    if (
        get_option(constant("WPC2O_API_KEY")) &&
        get_option(constant("WPC2O_API_ENDPOINT")) &&
        get_option(constant("WPC2O_API_STOCK_ENDPOINT")) &&
        get_option(constant("WPC2O_API_STORE_MANAGER_EMAIL"))
    ) {
        return true;
    }
    return false;
}

function wpc2o_options_page($sections)
{
    $sections['wpc2o'] = __('WPClothes2Order', 'wpc2o');
    return $sections;
}

function wpc2o_options_page_settings($settings, $current_section)
{
    if ($current_section === 'wpc2o') {
        $wpc2o_settings = array();

        $wpc2o_settings[] = array(
            'name' => __('WPClothes2Order Settings', 'wpc2o'),
            'type' => 'title',
            'desc' => __('The following options are used to configure the Clothes2Order connection & WooCommerce settings.', 'wpc2o'),
            'id' => 'wpc2o'
        );

        $wpc2o_settings[] = array(
            'name' => __('API Key (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique API key provided by Clothes2Order', 'wpc2o'),
            'id' => constant("WPC2O_API_KEY"),
            'type' => 'password',
            'desc' => __('API key provided by Clothes2Order', 'wpc2o')
        );

        $wpc2o_settings[] = array(
            'name' => __('Order API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to communicate with Clothes2Order', 'wpc2o'),
            'id' => constant("WPC2O_API_ENDPOINT"),
            'type' => 'text',
            'desc' => __('Order endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Stock API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to retrieve the Clothes2Order stock', 'wpc2o'),
            'id' => constant("WPC2O_API_STOCK_ENDPOINT"),
            'type' => 'text',
            'desc' => __('Stock endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Store manager email (required)', 'wpc2o'),
            'desc_tip' => __('Please enter an email address', 'wpc2o'),
            'id' => constant("WPC2O_API_STORE_MANAGER_EMAIL"),
            'type' => 'email',
            'desc' => __('This address will receive failed order email notifications', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Test Mode', 'wpc2o'),
            'desc_tip' => __('In test mode, orders will not be sent to Clothes2Order', 'wpc2o'),
            'id' => 'wpc2o_test_mode',
            'type' => 'checkbox',
            'desc' => __('Check to enable test mode', 'wpc2o'),
        );

        $settings_c2o[] = array(
            'type' => 'sectionend', 'id' => 'wpc2o'
        );

        return $wpc2o_settings;
    }

    return $settings;
}

function wpc2o_admin_products_c2o_column($columns)
{
    return array_slice(
        $columns,
        0,
        3,
        true
    ) + array(
        'wpc2o' => 'WPC2O'
    ) + array_slice(
        $columns,
        3,
        count($columns) - 3,
        true
    );
}

function wpc2o_wc_c2o_product_column($column, $product_id)
{
    if ($column == 'wpc2o') {
        $meta = get_post_meta($product_id);
        ray($meta);

        if ($meta['__wpc2o_product_enabled'][0] === 'yes') {
            echo '<span style="color: #7ad03a;"><strong>Yes</strong></span>';
        } else {
            echo '<span style="color: red;"><strong>No</strong></span>';
        }
    }
}

function wpc2o_admin_products_c2o_column_sortable($columns)
{
    $columns['wpc2o'] = 'wpc2o';
    return $columns;
}

function wpc2o_wc_widths(string $max): array
{
    $all = [
        1 => '1cm',
        2 => '2cm',
        3 => '3cm',
        4 => '4cm',
        5 => '5cm',
        6 => '6cm',
        7 => '7cm',
        8 => '8cm',
        9 => '9cm',
        10 => '10cm',
        11 => '11cm',
        12 => '12cm',
        13 => '13cm',
        14 => '14cm',
        15 => '15cm',
        16 => '16cm',
        17 => '17cm',
        18 => '18cm',
        19 => '19cm',
        20 => '20cm',
        21 => '21cm',
        22 => '22cm',
        23 => '23cm',
        24 => '24cm',
        25 => '25cm',
        26 => '26cm',
        27 => '27cm',
        28 => '28cm',
        29 => '29cm',
        30 => '30cm'
    ];

    $x = array_reverse($all);
    $y = array_splice($x, count($x) - $max);
    $z = array_reverse($y);
    return $z;
}

function wpc2o_wc_theme_options()
{

    Container::make('post_meta', __('WPClothes2Order'))
        ->where('post_type', '=', 'product')->add_fields(
            array(

                // Use this when this product is ordered to check if we should process
                Field::make('checkbox', constant('WPC2O_PRODUCT_ENABLED'), __('Enable as C2O product?'))
                    ->set_option_value('yes'),

                Field::make('checkbox', constant('WPC2O_PRODUCT_API'), __('Automically send orders to Clothes2Order'))
                    ->set_option_value('yes')
                    ->set_help_text('On succesful purchase, automically send the order to Clothes2Order. If disabled, you will have to inform Clothes2Order of each purchase.')
                    ->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            )
                        )
                    ),

                // Logo selection
                Field::make('image', constant('WPC2O_PRODUCT_LOGO'), __('Select logo'))
                    ->set_required(true)
                    ->set_help_text('Supported formats include: "jpg", "png", "gif"')
                    ->set_width(50)
                    ->set_type(['image'])->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            )
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_PRINT_TYPE'), __('Print type'))
                    ->set_required(true)
                    ->set_width(50)
                    ->set_options(
                        array(
                            'print' => 'Print',
                            'embroidery' => 'Embroidery',
                            'print_1colour' => 'Print colour',

                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            )
                        )
                    ),

                // Product type select
                Field::make('select', constant('WPC2O_PRODUCT_TYPE'), __('Product type'))
                    ->set_required(true)
                    ->set_width(33)
                    ->set_options(
                        array(
                            'top' => 'Top',
                            'bottoms' => 'Bottoms',
                            'bag' => 'Bag',
                            'hat' => 'Hat',
                            'tea-towel' => 'Tea towel',
                            'tie' => 'Tie',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            )
                        )
                    ),

                // Position selection
                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            1 => 'Right sleeve',
                            2 => 'Right bottom',
                            3  => 'Right chest',
                            4 => 'Center chest',
                            8 => 'Center back',
                            7 => 'Left sleeve',
                            5 => 'Left chest',
                            6 => 'Left bottom',
                            9 => 'Top back',
                            12 => 'Bottom back',
                            17 => 'Top chest',
                            18 => 'Inside back (labels)'
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_bottoms', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            15 => 'Left pocket',
                            16 => 'Right pocket',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'bottoms',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_bag', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            13 => 'Front',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'bag',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_hat', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            11 => 'Front',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'hat',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_tea-towel', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            14 => 'Center',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'tea-towel',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_tie', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            19 => 'Front',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'tie',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_1', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(10)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value' => '1',
                                'compare' => '=',
                            ),
                        )
                    ),

            )
        );
}
