<?php

namespace WPClothes2Order;

class Options
{
    public function __construct()
    {
        add_filter('woocommerce_get_sections_products', [$this, 'wpc2o_options_page']);
        add_filter('woocommerce_get_settings_products', [$this, 'wpc2o_options_page_settings'], 10, 2);
    }

    public function wpc2o_options_page($sections)
    {
        $sections['wpc2o'] = __('WPClothes2Order', 'wpc2o');
        return $sections;
    }

    public function wpc2o_options_page_settings($settings, $current_section)
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
                'name' => __('API Endpoint (required)', 'wpc2o'),
                'desc_tip' => __('This is the unique URI that is used to communicate with Clothes2Order', 'wpc2o'),
                'id' => constant("WPC2O_API_ENDPOINT"),
                'type' => 'text',
                'desc' => __('Endpoint URL provided by Clothes2Order', 'wpc2o'),
            ];

            $wpc2o_settings[] = [
                'name' => __('Manager email (required)', 'wpc2o'),
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
