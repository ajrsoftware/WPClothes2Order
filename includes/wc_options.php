<?php

function wpc2o_c2o_product()
{
    class WC_Product_Wp_Clothes_Two_Order extends WC_Product
    {
        public function __construct($product)
        {
            $this->product_type = 'wp_clothes_two_order';
            parent::__construct($product);
        }
    }
}


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

function wpc2o_product_type_selector(array $type): array
{
    $type['wp_clothes_two_order'] = __('WPC2O Product');

    return $type;
}

function wpc2o_load_custom_product_type_class($classname, $product_type)
{
    if ($product_type == 'wp_clothes_two_order') {
        $classname = 'show_if_wp_clothes_two_order';
    }

    return $classname;
}

function wpc2o_wc_product_data_tab(array $tabs): array
{
    $tabs['wp_clothes_two_order'] = array(
        'label' => __('WPC2O', 'wpc2o'),
        'target' => 'wp_clothes_two_order_options',
        'class' => ('show_if_wp_clothes_two_order')
    );

    return $tabs;
}

function wpc2o_wc_product_data_remove_tabs(array $tabs): array
{
    unset($tabs['linked_product']); // TODO - figure out which tabs we can support
    return $tabs;
}

function wpc2o_wc_product_data_tab_content(): void
{
?>
    <div id="wp_clothes_two_order_options" class='panel woocommerce_options_panel'>
        <div class='options_group'>
            <p>Ensure you enter values acording to what Clothes2Order accept
                <br>Please
                <a href="<?php echo get_admin_url() . 'admin.php?page=crb_carbon_fields_container_wpclothes2order.php'; ?>" target="_blank" rel="noreferrer noopener">
                    read the logo positions and widths explained
                </a>
                here before continuing.
            </p>

            <?php
            woocommerce_wp_checkbox([
                'id'     => '_enable_wp_clothes_two_order',
                'label' => __('Enable as C2O Product?', 'wpc2o'),
                'desc_tip' => 'true',
                'description' => __('Select if this product is a C2O product', 'wpc2o')
            ]);

            woocommerce_wp_select([
                'id' => '_type_wp_clothes_two_order',
                'label' => __('Select product type', 'wpc2o'),
                'options' => array(
                    'top' => 'Top',
                    'bottoms' => 'Bottoms',
                    'bag' => 'Bag',
                    'hat' => 'Hat',
                    'tea-towel' => 'Tea towel',
                    'tie' => 'Tie'
                ),
                'desc_tip' => 'true',
                'custom_attributes' => array('required' => 'required'),
                'description' => __('Select the type of C2O product', 'wpc2o')
            ]);

            woocommerce_wp_select([
                'id' => '_position_wp_clothes_two_order',
                'label' => __('Select logo position', 'wpc2o'),
                'options' => array(
                    'front' => 'Front',
                    'center' => 'Center',
                    'right-pocket' => 'Right pocket',
                    'left-pocket' => 'Left pocket',
                    'right-sleeve' => 'Right sleeve',
                    'right-bottom' => 'Right bottom',
                    'right-chest' => 'Right chest',
                    'center-chest' => 'Center chest',
                    'left-sleeve' => 'Left sleeve',
                    'left-chest' => 'Left chest',
                    'left-bottom' => 'Left bottom',
                    'top-back' => 'Top back',
                    'bottom-back' => 'Bottom back',
                    'top-chest' => 'Top chest',
                    'inside-back' => 'Inside back (labels)',
                ),
                'desc_tip' => 'true',
                'custom_attributes' => array('required' => 'required'),
                'description' => __('Select the position of the logo', 'wpc2o')
            ]);

            woocommerce_wp_select([
                'id' => '_width_wp_clothes_two_order',
                'label' => __('Select logo width', 'wpc2o'),
                'options' => array(
                    '1' => '1cm',
                    '2' => '2cm',
                    '3' => '3cm',
                    '4' => '4cm',
                    '5' => '5cm',
                    '6' => '6cm',
                    '7' => '7cm',
                    '8' => '8cm',
                    '9' => '9cm',
                    '10' => '10cm',
                    '11' => '11cm',
                    '12' => '12cm',
                    '13' => '13cm',
                    '14' => '14cm',
                    '15' => '15cm',
                    '16' => '16cm',
                    '17' => '17cm',
                    '18' => '18cm',
                    '19' => '19cm',
                    '20' => '20cm',
                    '21' => '21cm',
                    '22' => '22cm',
                    '23' => '23cm',
                    '24' => '24cm',
                    '25' => '25cm',
                    '26' => '26cm',
                    '27' => '27cm',
                    '28' => '28cm',
                    '29' => '29cm',
                    '30' => '30cm',
                ),
                'desc_tip' => 'true',
                'custom_attributes' => array('required' => 'required'),
                'description' => __('Select the position of the logo', 'wpc2o')
            ]);

            ?>
        </div>
    </div>
<?php
}

function wpc2o_wc_save_product_meta(int $post_id): void
{
    $enable = isset($_POST['_enable_wp_clothes_two_order']);
    $type = $_POST['_type_wp_clothes_two_order'];
    $position = $_POST['_position_wp_clothes_two_order'];
    $width = $_POST['_width_wp_clothes_two_order'];

    update_post_meta($post_id, '_enable_wp_clothes_two_order', $_POST['_enable_wp_clothes_two_order']);

    if ($enable) {
        update_post_meta($post_id, '_type_wp_clothes_two_order', sanitize_text_field($type));
        update_post_meta($post_id, '_position_wp_clothes_two_order', sanitize_text_field($position));
        update_post_meta($post_id, '_width_wp_clothes_two_order', sanitize_text_field($width));
    }
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
