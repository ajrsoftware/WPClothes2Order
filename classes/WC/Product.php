<?php

add_action('plugins_loaded', 'WC_Product_WPC2O');

function WC_Product_WPC2O()
{
    class WC_Product_WPC2O extends WC_Product
    {
        public function __construct($product)
        {
            $this->product_type = 'wpc2o_product';
            parent::__construct($product);
        }
    }
}
