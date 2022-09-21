<?php

/**
 * Register a new wp-cron schedule/interval
 * @param array $schedules 
 * @return array 
 */
function wpc2o_add_cron_interval(array $schedules): array
{
    $schedules['wpc2o_everday_at_four_thirty_am'] = array(
        'interval' => 86400,
        'display'  => esc_html__('Every day at 4:30am BST'),
    );
    return $schedules;
}

/**
 * Init a new stock sync for the cron job
 * @return string[] 
 * @throws Exception 
 */
function wpc2o_stock_sync_cron(): array
{
    $stock_sync = new WPC2O_Stock_Sync(get_option(constant('WPC2O_API_STOCK_ENDPOINT')), 3600);
    $response   = $stock_sync->sync();
    return $response;
}
