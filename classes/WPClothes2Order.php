<?php

namespace WPC2O;

use Carbon_Fields\Carbon_Fields;

class WPClothes2Order
{
    public function boot()
    {
        if (class_exists('Woocommerce')) {
            new APIOptions;
            if ((new API())->APICredentialsCheck()) {
                add_action('after_setup_theme', [$this, 'LoadAdminMenu']);
                add_filter('plugin_action_links_WPClothes2Order/wpclothes2order.php', [$this, 'PluginPageSettingLink']);
                new Scripts();
                require_once('WC/Product.php');
                new Register_WC_Product();
            } else {
                new Notices('error', 'Missing WPClothes2Order API credentials. Please add them <a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o">here</a>', false);
            }
        } else {
            new Notices('error', 'Woocommerce is required to use WPClothes2Order!', false);
        }
    }

    public function LoadAdminMenu()
    {
        Carbon_Fields::boot();
        new PluginOptions;
    }

    public function PluginPageSettingLink($links)
    {
        array_unshift(
            $links,
            '<a href="' . get_admin_url() . '/admin.php?page=crb_carbon_fields_container_wpclothes2order.php">' . __('Settings') . '</a>'
        );
        return $links;
    }
}
