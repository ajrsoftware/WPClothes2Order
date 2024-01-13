<?php

/**
 * WPC2O_C2O_Product File Doc Comment
 *
 * @category WPC2O_C2O_Product
 * @package  WPClothes2Order
 */
class WPC2O_C2O_Product
{

    /**
     * Build ann array of products formatted for C2O
     * Currently we only support one C2O product per order item
     * @param WC_Order_Item $order_item 
     * @param string $sku 
     * @param string $quantity 
     * @param string $unique_id 
     * @param string $logo_url 
     * @param string $position 
     * @param string $width 
     * @param string $print_type 
     * @return array 
     */
    public function build(\WC_Order_Item $order_item): array
    {
        $product_id  = $order_item->get_product_id();
        $meta        = get_post_meta($product_id);
        $quantity    = $order_item->get_quantity();
        $sku         = $meta['_' . constant('WPC2O_PRODUCT_SKU') . ''][0];
        $logo_url    = wp_get_attachment_image_src($meta['_' . constant('WPC2O_PRODUCT_LOGO') . ''][0])[0];
        $exteral_url = $meta['_' . constant('WPC2O_PRODUCT_LOGO_URL') . ''][0];
        $unique_id   = $order_item->get_order_id();
        $print_type  = $meta['_' . constant('WPC2O_PRODUCT_LOGO_PRINT_TYPE') . ''][0];
        $type        = $meta['_' . constant('WPC2O_PRODUCT_TYPE') . ''][0];
        $position    = $meta['_' . constant('WPC2O_PRODUCT_LOGO_POSITION') . '_' . $type . ''][0];
        $width       = $meta['_' . constant('WPC2O_PRODUCT_LOGO_WIDTH') . '_position_' . $position . ''][0] + 1;

        if (isset($exteral_url) && strlen($exteral_url) > 0) {
            $logo_url = $exteral_url;
        }

        $product = array(
            'sku'      => $sku,
            'quantity' => '' . $quantity . '',
            'logos'    => array(
                'logo' => array(
                    array(
                        'unique_id' => '' . $unique_id . '',
                        'file'      => $logo_url,
                        'position'  => $position,
                        'width'     => '' . $width . '',
                        'type'      => $print_type,
                    ),
                ),
            ),
        );

        return $product;
    }
}
