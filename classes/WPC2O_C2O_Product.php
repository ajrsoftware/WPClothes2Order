<?php

class WPC2O_C2O_Product
{
    /**
     * Format product from WC order to a shape we can send to C2O
     * @param WC_Order_Item $product 
     * @return void 
     */
    public function __construct(\WC_Order_Item $product)
    {
        $product_id = $product->get_product_id();
        $product = wc_get_product($product_id);
        $quantity = '';
        $sku = '';
        $logo_url = '';
        $unique_id = '';
        $position = '';
        $width = '';
        $type = '';

        $built_product = $this->build($sku, $quantity, $unique_id, $logo_url, $position, $width, $type);
        return $built_product;
    }

    private function build(string $sku, string $quantity, string $unique_id, string $file, string $position, string $width, string $type): array
    {
        $product = array(
            "sku" => $sku,
            "quantity" => $quantity,
            "logos" => array(
                "logo" => array(
                    array(
                        "unique_id" => $unique_id,
                        "file" => $file,
                        "position" => $position,
                        "width" => $width,
                        "type" => $type
                    )
                )
            )
        );

        return $product;
    }
}
