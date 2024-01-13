<?php

use Carbon_Fields\Exception\Incorrect_Syntax_Exception;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Determine if the WC API options have been provided
 * @return bool 
 */
function wpc2o_api_credentials_check(): bool
{
    if (
        get_option(constant('WPC2O_API_KEY')) &&
        get_option(constant('WPC2O_API_ENDPOINT')) &&
        get_option(constant('WPC2O_API_STOCK_ENDPOINT')) &&
        get_option(constant('WPC2O_API_STORE_MANAGER_EMAIL'))
    ) {
        return true;
    }
    return false;
}

/**
 * Register a new WC settings section
 * @param array $sections 
 * @return array 
 */
function wpc2o_options_page(array $sections): array
{
    $sections['wpc2o'] = __('WPClothes2Order', 'wpc2o');
    return $sections;
}

/**
 * Setup the WC plugin api options
 * @param array $settings 
 * @param string $current_section 
 * @return array 
 */
function wpc2o_options_page_settings(array $settings, string $current_section): array
{
    if ($current_section === 'wpc2o') {
        $wpc2o_settings = array();

        $wpc2o_settings[] = array(
            'name' => __('WPClothes2Order Settings', 'wpc2o'),
            'type' => 'title',
            'desc' => __('The following options are used to configure the Clothes2Order connection & WooCommerce settings.', 'wpc2o'),
            'id'   => 'wpc2o',
        );

        $wpc2o_settings[] = array(
            'name'     => __('API Key (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique API key provided by Clothes2Order', 'wpc2o'),
            'id'       => constant('WPC2O_API_KEY'),
            'type'     => 'password',
            'desc'     => __('API key provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name'     => __('Order API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to communicate with Clothes2Order', 'wpc2o'),
            'id'       => constant('WPC2O_API_ENDPOINT'),
            'type'     => 'text',
            'desc'     => __('Order endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name'     => __('Stock API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to retrieve the Clothes2Order stock', 'wpc2o'),
            'id'       => constant('WPC2O_API_STOCK_ENDPOINT'),
            'type'     => 'text',
            'desc'     => __('Stock endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name'     => __('Store manager email (required)', 'wpc2o'),
            'desc_tip' => __('Please enter an email address', 'wpc2o'),
            'id'       => constant('WPC2O_API_STORE_MANAGER_EMAIL'),
            'type'     => 'email',
            'desc'     => __('This address will receive failed order email notifications', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name'     => __('Test Mode', 'wpc2o'),
            'desc_tip' => __('In test mode, orders will not be sent to Clothes2Order', 'wpc2o'),
            'id'       => constant('WPC2O_API_TEST_MODE'),
            'type'     => 'checkbox',
            'desc'     => __('Check to enable test mode', 'wpc2o'),
        );

        $settings_c2o[] = array(
            'type' => 'sectionend',
            'id'   => 'wpc2o',
        );

        return $wpc2o_settings;
    }

    return $settings;
}

/**
 * Relocate our admin column
 * @param array $columns 
 * @return array 
 */
function wpc2o_admin_products_c2o_column(array $columns): array
{
    return array_slice(
        $columns,
        0,
        3,
        true
    ) + array(
        'wpc2o' => 'WPC2O',
    ) + array_slice(
        $columns,
        3,
        count($columns) - 3,
        true
    );
}

/**
 * Setup the admin column
 * @param array $column 
 * @param int $product_id 
 * @return void 
 */
function wpc2o_wc_c2o_product_column(string $column, int $product_id): void
{
    if ($column === 'wpc2o') {
        $meta = get_post_meta($product_id);

        if ($meta['_' . constant('WPC2O_PRODUCT_ENABLED') . ''][0] === 'yes') {

            $print_type  = $meta['_' . constant('WPC2O_PRODUCT_LOGO_PRINT_TYPE') . ''][0];
            $auto_orders = $meta['_' . constant('WPC2O_PRODUCT_API') . ''][0];
            $sku         = $meta['_' . constant('WPC2O_PRODUCT_SKU') . ''][0];
            $type        = $meta['_' . constant('WPC2O_PRODUCT_TYPE') . ''][0];
            $position    = $meta['_' . constant('WPC2O_PRODUCT_LOGO_POSITION') . '_' . $type . ''][0];
            $width       = $meta['_' . constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_' . $position . ''][0] + 1;

            echo '<button class="button-link wpc2o-expand-details" style="display: block; margin: 0 0 3px 0;">Show details</button>';
            echo '<ul class="wpc2o-expand-details-content">';
            echo '<li><span>Product SKU: ' . esc_html($sku) . '</span></li>';
            echo '<li><span>Product type: ' . esc_html(ucfirst($type)) . '</span></li>';
            echo '<li><span>Logo position: ' . esc_html(wpc2o_code_to_postion_text($position)) . '</span></li>';
            echo '<li><span>Logo width: ' . esc_html($width) . 'cm</span></li>';
            echo '<li><span>Print type: ' . esc_html(ucfirst($print_type)) . '</span></li>';
            echo '<li><span>Auto order: ' . esc_html(ucfirst($auto_orders)) . '</span></li>';
            echo '</ul>';
        }
    }
}

/**
 * Allow our admin column to be sortable
 * @param array $columns 
 * @return array 
 */
function wpc2o_admin_products_c2o_column_sortable(array $columns): array
{
    $columns['wpc2o'] = 'wpc2o';
    return $columns;
}

/**
 * Relocate our admin column
 * @param array $columns 
 * @return array 
 */
function wpc2o_admin_orders_c2o_column(array $columns): array
{
    return array_slice(
        $columns,
        0,
        3,
        true
    ) + array(
        'wpc2o' => 'WPC2O',
    ) + array_slice(
        $columns,
        3,
        count($columns) - 3,
        true
    );
}

/**
 * Setup the admin column
 * @param array $column 
 * @param int $product_id 
 * @return void 
 */
function wpc2o_wc_c2o_order_column(string $column, int $order_id): void
{
    if ($column === 'wpc2o') {
        $order = wc_get_order($order_id);
        if ($order->get_meta('_wpc2o_order_processed')) {
            if ($order->get_meta('_wpc2o_order_c2o_result')) {
                echo '<mark class="order-status status-completed"><span>Order successful</span></mark>';
            } else {
                echo '<mark class="order-status status-failed"><span>Order failed</span></mark>';
            }
        }
    }
}

/**
 * Get widths array
 * @param string $max 
 * @return array 
 */
function wpc2o_wc_widths(string $max): array
{
    $all = array(
        1  => '1cm',
        2  => '2cm',
        3  => '3cm',
        4  => '4cm',
        5  => '5cm',
        6  => '6cm',
        7  => '7cm',
        8  => '8cm',
        9  => '9cm',
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
        30 => '30cm',
    );

    $x = array_reverse($all);
    $y = array_splice($x, count($x) - $max);
    $z = array_reverse($y);
    return $z;
}

/**
 * Set up WC Product post type fields
 * @return void 
 * @throws Incorrect_Syntax_Exception 
 */
function wpc2o_wc_theme_options(): void
{
    Container::make('post_meta', __('WPClothes2Order'))
        ->where('post_type', '=', 'product')->add_fields(
            array(

                // Use this when this product is ordered to check if we should process
                Field::make('checkbox', constant('WPC2O_PRODUCT_ENABLED'), __('Enable as C2O product?'))
                    ->set_option_value('yes')
                    ->set_help_text('Please note, this information is not verified by Clothes2Order. Positions & sizes listed here may not be accurate, please contact Clothes2Order if you are unsure.'),

                // Use this when this product is ordered to see if we post info to c2o
                Field::make('checkbox', constant('WPC2O_PRODUCT_API'), __('Automically send orders to Clothes2Order'))
                    ->set_option_value('yes')
                    ->set_help_text('On succesful purchase, automically send the order to Clothes2Order. If disabled, you will have to inform Clothes2Order of each purchase.')
                    ->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                // Logo selection
                Field::make('image', constant('WPC2O_PRODUCT_LOGO'), __('Select artwork'))
                    ->set_required(false)
                    ->set_help_text('Supported formats include: "jpg", "png", "gif"')
                    ->set_width(15)
                    ->set_type(array('image'))->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                Field::make('text', constant('WPC2O_PRODUCT_LOGO_URL'), __('External artwork URL'))
                    ->set_required(false)
                    ->set_help_text('External image URL to use instead of selected image<p>Supported formats include: "jpg", "png", "gif"</p>')
                    ->set_attribute('type', 'url')
                    ->set_width(20)
                    ->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                // Print type
                Field::make('select', constant('WPC2O_PRODUCT_LOGO_PRINT_TYPE'), __('Print type'))
                    ->set_required(true)
                    ->set_help_text('Only certain product types support certain print types, however all support "Print", if in doubt leave as "Print" option. Contact Clothes2Order for more infomation.')
                    ->set_width(20)
                    ->set_options(
                        array(
                            'print'         => 'Print',
                            'embroidery'    => 'Embroidery',
                            'print_1colour' => 'Print colour',

                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                Field::make('text', constant('WPC2O_PRODUCT_SKU'), __('Product SKU'))
                    ->set_required(true)
                    ->set_help_text('Please enter the SKU of the product. This SKU determines the colour (black etc), product type (top etc) & product size (S,M,L etc). If you do not know the SKU to enter, please either get in touch with Clothes2Order or download this <a href="http://c2ostock.s3.amazonaws.com/products.csv" target="_blank" rel="noopener noreferrer">SKU Stock information csv</a> which contains all C2O product information including SKUs.')
                    ->set_width(20)
                    ->set_attribute('placeholder', 'eg: 3017-3-14')
                    ->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                // Product type select
                Field::make('select', constant('WPC2O_PRODUCT_TYPE'), __('Product type'))
                    ->set_required(true)
                    ->set_help_text('Ensure this product type matches the SKU you have provided.')
                    ->set_width(33)
                    ->set_options(
                        array(
                            'top'       => 'Top',
                            'bottoms'   => 'Bottoms',
                            'bag'       => 'Bag',
                            'hat'       => 'Hat',
                            'tea-towel' => 'Tea towel',
                            'tie'       => 'Tie',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                        )
                    ),

                // Top osition selection
                Field::make('select', constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top', __('Logo position'))
                    ->set_width(33)
                    ->set_options(
                        array(
                            1  => 'Right sleeve',
                            2  => 'Right bottom',
                            3  => 'Right chest',
                            4  => 'Center chest',
                            8  => 'Center back',
                            7  => 'Left sleeve',
                            5  => 'Left chest',
                            6  => 'Left bottom',
                            9  => 'Top back',
                            12 => 'Bottom back',
                            17 => 'Top chest',
                            18 => 'Inside back (labels)',
                        )
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'top',
                                'compare' => '=',
                            ),
                        )
                    ),

                // Bottoms position selection
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
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'bottoms',
                                'compare' => '=',
                            ),
                        )
                    ),

                // Bag position selection
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
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'bag',
                                'compare' => '=',
                            ),
                        )
                    ),

                // Hat position selection
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
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'hat',
                                'compare' => '=',
                            ),
                        )
                    ),

                // Tea towel position selection
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
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'tea-towel',
                                'compare' => '=',
                            ),
                        )
                    ),

                // Tie position selection
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
                                'field'   => constant('WPC2O_PRODUCT_TYPE'),
                                'value'   => 'tie',
                                'compare' => '=',
                            ),
                        )
                    ),

                /**
                 * All of the below select options are conditional based on the logo position
                 * We calculate the value selected based on the previous options
                 * The default select option is given if the user does not select
                 */

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
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '1',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_2', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '2',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_3', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '3',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_4', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '4',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_5', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '5',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_6', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '6',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_7', __('Logo width'))
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
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '7',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_8', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '8',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_9', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '9',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_11', __('Logo width'))
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
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'hat',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_hat',
                                'value'   => '11',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_12', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '12',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_13', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'bag',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_bag',
                                'value'   => '13',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_14', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'tea-towel',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_tea-towel',
                                'value'   => '14',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_15', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'bottoms',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_bottoms',
                                'value'   => '15',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_16', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'bottoms',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_bottoms',
                                'value'   => '16',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_17', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(30)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '17',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_18', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(12)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'top',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_top',
                                'value'   => '18',
                                'compare' => '=',
                            ),
                        )
                    ),

                Field::make('select', constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_19', __('Logo width'))
                    ->set_width(33)
                    ->set_options(
                        wpc2o_wc_widths(5)
                    )->set_conditional_logic(
                        array(
                            array(
                                'field' => constant('WPC2O_PRODUCT_ENABLED'),
                                'value' => true,
                            ),
                            array(
                                'field' => constant('WPC2O_PRODUCT_TYPE'),
                                'value' => 'tie',
                            ),
                            array(
                                'field'   => constant('WPC2O_PRODUCT_LOGO_POSITION') . '_tie',
                                'value'   => '19',
                                'compare' => '=',
                            ),
                        )
                    ),

            )
        );
}

/**
 * Provide the readable logo position based on the position code
 * @param int $code 
 * @return string 
 */
function wpc2o_code_to_postion_text(int $code): string
{
    $value = '';
    switch ($code) {
        case 1:
            $value = 'Right Sleeve';
            break;
        case 2:
            $value = 'Bottom Right';
            break;
        case 3:
            $value = 'Right Chest';
            break;
        case 4:
            $value = 'Centre Chest';
            break;
        case 5:
            $value = 'Left Chest';
            break;
        case 6:
            $value = 'Bottom Left';
            break;
        case 7:
            $value = 'Left Sleeve';
            break;
        case 8:
            $value = 'Centre Back';
            break;
        case 9:
            $value = 'Top Back';
            break;
        case 11:
            $value = 'Front of Hat';
            break;
        case 12:
            $value = 'Bottom Back';
            break;
        case 13:
            $value = 'Front of Bag';
            break;
        case 14:
            $value = 'Centre Tea Towel';
            break;
        case 15:
            $value = 'Left Pocket';
            break;
        case 16:
            $value = 'Right Pocket';
            break;
        case 17:
            $value = 'Top Chest';
            break;
        case 18:
            $value = 'Inside Back (for Printed Labels)';
            break;
        case 19:
            $value = 'Front of Tie';
            break;
    }
    return $value;
}
