<?php

namespace WPC2O;

class APIOptions
{
    public function __construct()
    {
        add_filter('woocommerce_get_sections_products', [$this, 'WC_OptionsPage']);
        add_filter('woocommerce_get_settings_products', [$this, 'WC_OptionsPageSettings'], 10, 2);
    }

    public function WC_OptionsPage($sections)
    {
        $sections['wpc2o'] = __('WPClothes2Order', 'wpc2o');
        return $sections;
    }

    public function WC_OptionsPageSettings($settings, $current_section)
    {
        if ($current_section === 'wpc2o') {
            $wpc2o_settings = [];

            $wpc2o_settings[] = [
                'name' => __('WPClothes2Order Settings', 'wpc2o'),
                'type' => 'title',
                'desc' => __('The following options are used to configure the Clothes2Order connection & WooCommerce settings.', 'wpc2o'),
                'id' => 'wpc2o'
            ];

            $wpc2o_settings[] = [
                'name' => __('API Key (required)', 'wpc2o'),
                'desc_tip' => __('This is the unique API key provided by Clothes2Order', 'wpc2o'),
                'id' => constant("WPC2O_API_KEY"),
                'type' => 'password',
                'desc' => __('API key provided by Clothes2Order', 'wpc2o'),
            ];

            $wpc2o_settings[] = [
                'name' => __('Order API Endpoint (required)', 'wpc2o'),
                'desc_tip' => __('This is the unique URI that is used to communicate with Clothes2Order', 'wpc2o'),
                'id' => constant("WPC2O_API_ENDPOINT"),
                'type' => 'text',
                'desc' => __('Order endpoint URL provided by Clothes2Order', 'wpc2o'),
            ];

            $wpc2o_settings[] = [
                'name' => __('Stock API Endpoint (required)', 'wpc2o'),
                'desc_tip' => __('This is the unique URI that is used to retrieve the Clothes2Order stock', 'wpc2o'),
                'id' => constant("WPC2O_API_STOCK_ENDPOINT"),
                'type' => 'text',
                'desc' => __('Stock endpoint URL provided by Clothes2Order', 'wpc2o'),
            ];

            $wpc2o_settings[] = [
                'name' => __('Store manager email (required)', 'wpc2o'),
                'desc_tip' => __('Please enter an email address', 'wpc2o'),
                'id' => constant("WPC2O_API_STORE_MANAGER_EMAIL"),
                'type' => 'email',
                'desc' => __('This address will receive failed order email notifications', 'wpc2o'),
            ];

            $wpc2o_settings[] = [
                'name' => __('Test Mode', 'wpc2o'),
                'desc_tip' => __('In test mode, orders will not be sent to Clothes2Order', 'wpc2o'),
                'id' => 'wpc2o_test_mode',
                'type' => 'checkbox',
                'desc' => __('Check to enable test mode', 'wpc2o'),
            ];

            $settings_c2o[] = [
                'type' => 'sectionend', 'id' => 'wpc2o'
            ];

            return $wpc2o_settings;
        }

        return $settings;
    }
}
