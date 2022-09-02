<?php

namespace WPC2O;

class Register_WC_Product
{
    public function __construct()
    {
        add_filter('product_type_selector', [$this, 'SetWPC2OWCType']);
        add_filter('woocommerce_product_data_tabs', [$this, 'WPC2OProductWCTab']);
        add_filter('woocommerce_product_data_tabs', [$this, 'RemoveTabs']);
        add_filter('woocommerce_allow_marketplace_suggestions', '__return_false');
        add_action('woocommerce_product_data_panels', [$this, 'TabContent']);
        add_action('woocommerce_process_product_meta', [$this, 'SaveEntry']);
    }

    public function SetWPC2OWCType($type)
    {
        $type['wpc2o_product'] = __('WPC2O Product');
        return $type;
    }

    public function WPC2OProductWCTab($tabs)
    {
        $tabs['wpc2o_product'] = [
            'label'     => __('WPC2O', 'wpc2o'),
            'target' => 'wpc2o_product_options',
            'class'  => ('show_if_wpc2o_product')
        ];

        return $tabs;
    }

    public function RemoveTabs($tabs)
    {
        unset($tabs['linked_product']); // TODO - figure out which tabs we can support
        return $tabs;
    }

    public function TabContent()
    {
?>
        <div id="wpc2o_product_options" class='panel woocommerce_options_panel'>
            <div class='options_group'>
                <?php
                woocommerce_wp_checkbox([
                    'id'     => '_enable_wpc2o_product',
                    'label' => __('Enable as C2O Product?', 'wpc2o'),
                ]);
                ?>
            </div>
        </div>
<?php
    }

    public function SaveEntry($post_id)
    {
        $enable = isset($_POST['_enable_wpc2o_product']) ? 'yes' : 'no';
        update_post_meta($post_id, '_enable_wpc2o_product', $enable);
    }
}
