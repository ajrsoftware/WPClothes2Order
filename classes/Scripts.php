<?php

namespace WPC2O;

class Scripts
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'SettingsAssets']);
    }

    public function SettingsAssets()
    {
        $plugin_dir = plugins_url('../', __FILE__);

        wp_register_style('wpc2o_admin_styles', $plugin_dir . '/dist/css/styles.css', false, constant("WP_C2O_VERSION"));
        wp_enqueue_style('wpc2o_admin_styles');
        wp_register_script('wpc2o_admin_scripts', $plugin_dir . '/dist/js/app.js', false, constant("WP_C2O_VERSION"), true);
        wp_enqueue_script('wpc2o_admin_scripts');
    }
}
