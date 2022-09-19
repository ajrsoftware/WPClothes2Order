<?php

/**
 * Register any wp api endpoints for wpc2o
 * @return void 
 */
function wpc2o_register_rest_fields(): void
{
    register_rest_route(
        'wpc2o/v1',
        '/stock-sync',
        array(
            'methods'             => 'GET',
            'callback'            => function () {
                $stock_sync = new WPC2O_Stock_Sync(get_option(constant('WPC2O_API_STOCK_ENDPOINT')), 3600);
                $message = $stock_sync->sync();
                return array(
                    'response' => $message,
                );
            },
            'permission_callback' => '__return_true',
        )
    );
}
