<?php

/**
 * Register our plugin scripts & styles
 * @return void 
 */
function wpc2o_assets(): void
{
    $plugin_dir = plugins_url('../', __FILE__);

    wp_register_style('wpc2o_admin_styles', $plugin_dir . '/dist/styles.css', false, constant('WP_C2O_VERSION'));
    wp_enqueue_style('wpc2o_admin_styles');
    wp_register_script('wpc2o_admin_scripts_app', $plugin_dir . '/dist/app.js', false, constant('WP_C2O_VERSION'), true);
    wp_enqueue_script('wpc2o_admin_scripts_app');
}
