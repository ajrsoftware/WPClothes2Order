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
            'callback'            => 'wpc2o_stock_sync_cron',
            'permission_callback' => '__return_true',
        )
    );
}
