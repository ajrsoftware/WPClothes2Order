<?php

function dataToProps($data)
{
    return htmlentities(json_encode($data, JSON_HEX_QUOT), ENT_QUOTES);
}

function wpc2o_api_credentials_check(): bool
{
    if (
        get_option(constant("WPC2O_API_KEY")) &&
        get_option(constant("WPC2O_API_ENDPOINT")) &&
        get_option(constant("WPC2O_API_STOCK_ENDPOINT")) &&
        get_option(constant("WPC2O_API_STORE_MANAGER_EMAIL"))
    ) {
        return true;
    }
    return false;
}

function wpc2o_options_page($sections)
{
    $sections['wpc2o'] = __('WPClothes2Order', 'wpc2o');
    return $sections;
}

function wpc2o_options_page_settings($settings, $current_section)
{
    if ($current_section === 'wpc2o') {
        $wpc2o_settings = array();

        $wpc2o_settings[] = array(
            'name' => __('WPClothes2Order Settings', 'wpc2o'),
            'type' => 'title',
            'desc' => __('The following options are used to configure the Clothes2Order connection & WooCommerce settings.', 'wpc2o'),
            'id' => 'wpc2o'
        );

        $wpc2o_settings[] = array(
            'name' => __('API Key (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique API key provided by Clothes2Order', 'wpc2o'),
            'id' => constant("WPC2O_API_KEY"),
            'type' => 'password',
            'desc' => __('API key provided by Clothes2Order', 'wpc2o')
        );

        $wpc2o_settings[] = array(
            'name' => __('Order API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to communicate with Clothes2Order', 'wpc2o'),
            'id' => constant("WPC2O_API_ENDPOINT"),
            'type' => 'text',
            'desc' => __('Order endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Stock API Endpoint (required)', 'wpc2o'),
            'desc_tip' => __('This is the unique URI that is used to retrieve the Clothes2Order stock', 'wpc2o'),
            'id' => constant("WPC2O_API_STOCK_ENDPOINT"),
            'type' => 'text',
            'desc' => __('Stock endpoint URL provided by Clothes2Order', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Store manager email (required)', 'wpc2o'),
            'desc_tip' => __('Please enter an email address', 'wpc2o'),
            'id' => constant("WPC2O_API_STORE_MANAGER_EMAIL"),
            'type' => 'email',
            'desc' => __('This address will receive failed order email notifications', 'wpc2o'),
        );

        $wpc2o_settings[] = array(
            'name' => __('Test Mode', 'wpc2o'),
            'desc_tip' => __('In test mode, orders will not be sent to Clothes2Order', 'wpc2o'),
            'id' => 'wpc2o_test_mode',
            'type' => 'checkbox',
            'desc' => __('Check to enable test mode', 'wpc2o'),
        );

        $settings_c2o[] = array(
            'type' => 'sectionend', 'id' => 'wpc2o'
        );

        return $wpc2o_settings;
    }

    return $settings;
}

function wpc2o_admin_products_c2o_column($columns)
{
    return array_slice(
        $columns,
        0,
        3,
        true
    ) + array(
        'wpc2o' => 'WPC2O'
    ) + array_slice(
        $columns,
        3,
        count($columns) - 3,
        true
    );
}

function wpc2o_wc_c2o_product_column($column, $product_id)
{
    if ($column == 'wpc2o') {
        $meta = get_post_meta($product_id);
        if ($meta['_wpc2o'][0] === 'yes') {
            echo '<span style="color: #7ad03a;"><strong>Yes</strong></span>';
        } else {
            echo '<span style="color: red;"><strong>No</strong></span>';
        }
    }
}

function wpc2o_admin_products_c2o_column_sortable($columns)
{
    $columns['wpc2o'] = 'wpc2o';
    return $columns;
}

function wpc2o_add_product_type_options($product_type_options)
{
    $product_type_options["wpc2o"] = [
        "id"            => "_wpc2o",
        "wrapper_class" => "show_if_simple",
        "label"         => "WPC2O",
        "description"   => "Select if this product is a C2O product",
        "default"       => "no",
    ];

    return $product_type_options;
}

function wpc2o_filter_woocommerce_product_data_tabs($default_tabs)
{
    $default_tabs['wpc2o'] = array(
        'label'    => __('WPC2O', 'wpc2o'),
        'target'   => 'wpc2o',
        'class'    => array('show_if_wpc2o'),
        'priority' => 80
    );

    return $default_tabs;
}

// Add CSS - icon
function wpc2o_wc_product_data_tab_icon()
{
?>
    <style>
        #woocommerce-product-data ul.wc-tabs li.wpc2o_options a::before {
            content: "\f17e";
        }
    </style>
<?php
}

function wpc2o_wc_action_admin_footer()
{
?>
    <script>
        jQuery(document).ready(function($) {
            var wpc2o_checkbox = document.querySelector('input#_wpc2o');
            var wpc2o_tab = document.querySelectorAll('.show_if_wpc2o');

            function adjust() {
                if (wpc2o_checkbox.checked === true) {
                    wpc2o_tab.forEach(element => element.style.display = '');
                } else {
                    wpc2o_tab.forEach(element => element.style.display = 'none');
                }
            }

            adjust();
            wpc2o_checkbox.addEventListener('change', function() {
                adjust();
            });
        });
    </script>
<?php
}

function wpc2o_wc_product_data_tab_content(): void
{
    $product = wc_get_product();

    ray(get_post_meta($product->id));

    $current_order_method = get_post_meta($product->id, '_wpc2o_order_method')[0];
    $current_type = get_post_meta($product->id, '_wpc2o_chosen_type')[0];
    $current_position = get_post_meta($product->id, '_wpc2o_chosen_position')[0];
    $current_width = get_post_meta($product->id, '_wpc2o_chosen_width')[0];

    ray($current_order_method);
    ray($current_position);
    ray($current_type);
    ray($current_width);

?>
    <div id="wpc2o" class='panel woocommerce_options_panel'>
        <div class="options-group">
            <h3 style="margin: 12px 0 0 12px; color: #26aae2;">WPClothes2Order</h3>
            <p><strong>Ensure you enter values acording to what Clothes2Order accept</strong>
                <br>Please
                <a href="<?php echo get_admin_url() . 'admin.php?page=crb_carbon_fields_container_wpclothes2order.php'; ?>" target="_blank" rel="noreferrer noopener">
                    read the logo positions and widths explained
                </a>
                before continuing.
            </p>
        </div>
        <div class="options_group">
            <?php
            woocommerce_wp_select(array(
                'id' => '_wpc2o_order_method',
                'label' => __('Send orders to C2O?', 'wpc2o'),
                'options' => array(
                    true => 'Yes',
                    false => 'No'
                ),
                'class' => 'select',
                'desc_tip' => 'true',
                'description' => __('If selected, WPC2O will attempt to automatically send successful orders to C2O, however is disabled, you will have to manually put orders through to C2O on successful order.', 'wpc2o')
            ));
            ?>
        </div>
        <div class='options_group'>
            <div style="padding: 12px" data-component="ProductTypeSelector" data-prop-type="<?php echo $current_type ?: 'top'; ?>" data-prop-position="<?php echo $current_position ?: '1'; ?>" data-prop-width="<?php echo $current_width ?: '1'; ?>">
                failed to load</div>
        </div>
    </div>
<?php
}

function wpc2o_save_post_product($post_ID, $product, $update)
{
    $is_c2o = isset($_POST["_wpc2o"]);
    $order_method = $_POST['_wpc2o_order_method'];
    $chosen_type = $_POST['_wpc2o_chosen_type'];
    $chosen_position = $_POST['_wpc2o_chosen_position'];
    $chosen_width = $_POST['_wpc2o_chosen_width'];

    update_post_meta($post_ID, "_wpc2o", $is_c2o ? "yes" : "no");

    // We will use this post meta to determine if we process on order
    if ($is_c2o) {
        update_post_meta($post_ID, '_wpc2o_order_method', sanitize_text_field($order_method));
        update_post_meta($post_ID, '_wpc2o_chosen_type', sanitize_text_field($chosen_type));
        update_post_meta($post_ID, '_wpc2o_chosen_position', sanitize_text_field($chosen_position));
        update_post_meta($post_ID, '_wpc2o_chosen_width', sanitize_text_field($chosen_width));
    }
}
