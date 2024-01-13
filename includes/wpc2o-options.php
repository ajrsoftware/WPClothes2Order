<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Boot Carbon Fields package
 * @return void 
 * @throws InvalidArgumentException
 * @throws Exception 
 */
function wpc2o_options(): void
{
    Carbon_Fields\Carbon_Fields::boot();
}

/**
 * Register our plugin theme options
 * @return void 
 */
function wpc2o_theme_options(): void
{
    Container::make('theme_options', __('WPClothes2Order'))
        ->set_page_menu_title('WPC2O')
        ->set_page_menu_position(58)
        ->set_icon(wpc2o_build_icon())

        ->add_tab(
            __('Getting started'),
            array(
                Field::make('html', 'wpc2o_getting_started')
                    ->set_html(wpc2o_getting_started_view()),
            )
        )

        // Logo tab
        ->add_tab(
            __('Logo'),
            array(
                Field::make('html', 'wpc2o_logo_title')
                    ->set_html(wpc2o_get_logo_view()),
                Field::make('html', 'wpc2o_logo_position_detail')
                    ->set_html(wpc2o_get_logo_position_detail_view()),
                Field::make('html', 'wpc2o_logo_artwork_detail')
                    ->set_html(wpc2o_logo_artwork_detail_view()),
            )
        )

        // Delivery tab
        ->add_tab(
            __('Delivery options'),
            array(
                Field::make('html', 'wpc2o_delivery_title')
                    ->set_html(wpc2o_get_delivery_view()),
                Field::make('radio', constant('WPC2O_DELIVERY_OPTION'), __('Select your prefered devliery option'))
                    ->add_options(
                        array(
                            'standard' => __('Standard'),
                            '4day'     => __('4day'),
                            'express'  => __('Express'),
                        )
                    ),
            )
        )

        // Order tab
        ->add_tab(
            __('Order history'),
            array(
                Field::make('html', 'wpc2o_order_history')
                    ->set_html(wpc2o_get_order_history_view()),
            )
        )

        // Stock tab
        ->add_tab(
            __('Stock sync'),
            array(
                Field::make('html', 'wpc2o_stock_sync')
                    ->set_html(wpc2o_get_stock_view()),
                Field::make('radio', constant('WPC2O_AUTO_STOCK_LEVELS'), __('Manage stock levels?'))
                    ->add_options(
                        array(
                            true  => __('Yes, automatically update my stores stock levels for Clothes2Order enabled products when syncing their status.'),
                            false => __('No, I will not be using stock management and/or I do not wish to use this feature.'),
                        )
                    ),
                Field::make('html', 'wpc2o_manual_stock_sync_trigger_view')
                    ->set_html(wpc2o_manual_stock_sync_trigger_view()),
            )
        )

        // API tab
        ->add_tab(
            __('API'),
            array(
                Field::make('html', 'wpc2o_api_credentials')
                    ->set_html(wpc2o_get_api_view()),
            )
        )

        // Help & support tab
        ->add_tab(
            __('Help & support'),
            array(
                Field::make('html', 'wpc2o_help_support')
                    ->set_html('<h1>Help & support</h1><p style="padding: 0 1px;">For any queries, please <a href="https://github.com/ajrsoftware/WPClothes2Order/issues" target="_blank" rel="noopener noreferrer">open a new GitHub issue</a> on the open repository.</p>'),
            )
        );
}

/**
 * Build the plugin admin menu icon
 * @return string 
 */
function wpc2o_build_icon(): string
{
    $base64 = 'CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iMTYuMDAwMDAwcHQiIGhlaWdodD0iMTYuMDAwMDAwcHQiIHZpZXdCb3g9IjAgMCAxNi4wMDAwMDAgMTYuMDAwMDAwIgogcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pZFlNaWQgbWVldCI+CiAgICA8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCwxNi4wMDAwMDApIHNjYWxlKDAuMDA2MTU0LC0wLjAwNjE1NCkiCiAgICBmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiPgogICAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIiBkPSJNMTIwOCAyNTU1IGMtMiAtMiAtMzUgLTYgLTc1IC05IC0xMzcgLTEzIC0zMjQgLTcxIC00NjMgLTE0NCAtMjI3CiAgICAgICAgLTEyMCAtNDI1IC0zMjIgLTUzOSAtNTUwIC0zNSAtNjkgLTg4IC0yMjQgLTk3IC0yODIgLTMgLTE5IC03IC0zNyAtOSAtNDEgLTcKICAgICAgICAtMTAgLTE4IC0xNTUgLTE4IC0yMjkgMCAtNzUgMTEgLTIxOCAxOCAtMjI5IDEgLTMgNiAtMjMgOSAtNDUgMyAtMjEgMTggLTczCiAgICAgICAgMzIgLTExNSAxMDkgLTMyOSAzNTIgLTU5OSA2NjcgLTc0MCA3MiAtMzIgMjA1IC03OCAyNTAgLTg1IDE1IC0zIDM1IC03IDQ1CiAgICAgICAgLTEwIDcwIC0yMCAzNjYgLTI4IDQ2NyAtMTIgMTYwIDI1IDI1NSA1NCA0MjEgMTMyIDQ4IDIzIDE3MyA5OSAxODQgMTEzIDMgMwogICAgICAgIDIyIDE4IDQyIDM0IDE2NSAxMjMgMzI3IDM1NSAzOTQgNTY3IDI2IDgxIDI4IDg5IDQ4IDIwMCAyMSAxMTMgMTQgMzUwIC0xMwogICAgICAgIDQ3NCAtMjUgMTExIC04NCAyNjEgLTEzNiAzNDkgLTIzMCAzODYgLTYzMCA2MTIgLTExMDIgNjIxIC02OCAyIC0xMjQgMiAtMTI1CiAgICAgICAgMXogbTI0NyAtNjIxIGM1NSAtMTQgMTA3IC0zNiAxNzUgLTc1IDE0IC03IDU5IC00OCAxMDEgLTkwIDg1IC04NiAxNDYgLTE5NgogICAgICAgIDE3MCAtMzA5IDE0IC02NiAxOCAtMjMxIDcgLTI4NSAtMjIgLTExMiAtNTggLTE5NiAtMTIxIC0yODEgLTI0MiAtMzI5IC03NDUKICAgICAgICAtMzE3IC05NzkgMjMgLTEzMCAxODkgLTE1MyA0NzAgLTU2IDY4MyAxMjMgMjcwIDQxMyA0MDggNzAzIDMzNHoiLz4KICAgICAgICA8cGF0aCBmaWxsPSJibGFjayIgZD0iTTExMDUgMTU5MiBjLTYxIC0xMyAtMTEwIC04NiAtMTAwIC0xNDkgMTIgLTc2IDYyIC0xMTkgMTM1IC0xMTcgMTA4CiAgICAgICAgMyAxNjYgMTA2IDExNSAyMDQgLTIzIDQ1IC05NSA3NCAtMTUwIDYyeiIvPgogICAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIiBkPSJNMTM5MiAxNTgwIGMtNzAgLTQzIC05MyAtMTI5IC01MiAtMTk1IDUxIC04MyAxODEgLTgwIDIyOSA1IDM3IDY2CiAgICAgICAgMTkgMTQ1IC00MiAxODQgLTM2IDI0IC0xMDEgMjcgLTEzNSA2eiIvPgogICAgICAgIDxwYXRoIGZpbGw9ImJsYWNrIiBkPSJNMTA5NiAxMjg1IGMtNDkgLTE3IC02OSAtMzYgLTg1IC04MCAtNDQgLTEyMiA5NSAtMjMwIDIwNCAtMTU5IDc5CiAgICAgICAgNTEgNzYgMTgwIC00IDIyNyAtNDAgMjMgLTcyIDI3IC0xMTUgMTJ6Ii8+CiAgICAgICAgPHBhdGggZmlsbD0iYmxhY2siIGQ9Ik0xNDE1IDEyODkgYy02NiAtMTggLTEwOSAtMTAwIC05MSAtMTc0IDcgLTI5IDYxIC04NCA4NSAtODcgNjIgLTYKICAgICAgICA4MCAtMyAxMTMgMTUgNjUgMzUgODcgMTIxIDQ4IDE4NCAtMzQgNTYgLTkyIDc5IC0xNTUgNjJ6Ii8+CiAgICA8L2c+Cjwvc3ZnPgo=';
    return 'data:image/svg+xml;base64,' . $base64;
}

/**
 * Register our pluging settings option
 * @param array $links 
 * @return array 
 */
function wpc2o_settings_link(array $links): array
{
    array_unshift(
        $links,
        '<a href="' . get_admin_url() . '/admin.php?page=crb_carbon_fields_container_wpclothes2order.php">' . __('Settings') . '</a>'
    );
    return $links;
}
