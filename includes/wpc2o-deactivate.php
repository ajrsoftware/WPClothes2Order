<?php

/**
 * Cleanup if plugin is deactivated
 */
function wpc2o_deactivate()
{
    $timestamp = wp_next_scheduled('wpc2o_cron_hook');
    wp_unschedule_event($timestamp, 'wpc2o_cron_hook');
}
