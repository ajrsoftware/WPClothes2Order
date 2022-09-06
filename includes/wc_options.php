<?php

function wpc2o_c2o_product()
{
    class WC_Product_WPC2O extends WC_Product
    {
        public function __construct($product)
        {
            $this->product_type = 'wpc2o_product';
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
    $type['wpc2o_product'] = __('WPC2O Product');
    return $type;
}

function wpc2o_wc_product_data_tab(array $tabs): array
{
    $tabs['wpc2o_product'] = [
        'label'     => __('WPC2O', 'wpc2o'),
        'target' => 'wpc2o_product_options',
        'class'  => ('show_if_wpc2o_product')
    ];

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
    <div id="wpc2o_product_options" class='panel woocommerce_options_panel'>
        <div class='options_group'>
            <?php
            woocommerce_wp_checkbox([
                'id'     => '_enable_wpc2o_product',
                'label' => __('Enable as C2O Product?', 'wpc2o'),
            ]);
            ?>
        </div>
    </div>
<?php
}

function wpc2o_wc_save_product_meta(int $post_id): void
{
    $enable = isset($_POST['_enable_wpc2o_product']) ? 'yes' : 'no';
    update_post_meta($post_id, '_enable_wpc2o_product', $enable);
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
