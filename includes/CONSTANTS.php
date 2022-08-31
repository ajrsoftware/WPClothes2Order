<?php

// API option values
define("WPC2O_API_KEY", "wpc2o_api_key");
define("WPC2O_API_ENDPOINT", "wpc2o_endpoint");
define("WPC2O_API_STORE_MANAGER_EMAIL", "wpc2o_manager_email");

// Admin notices
define("NO_WOO_ACTIVE",  '<div class="notice notice-error"><p>' . _('Woocommerce is required to use WPClothes2Order!', 'wpc2o') . '</p></div>');
define("NO_API_CREDENTIALS", '<div class="notice notice-error"><p>' . _('Missing WPClothes2Order API credentials. Please add them <a href="/wp-admin/admin.php?page=wc-settings&tab=products&section=wpc2o">here</a>', 'wpc2o') . '</p></div>');
