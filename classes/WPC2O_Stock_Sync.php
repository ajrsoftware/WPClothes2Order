<?php

class WPC2O_Stock_Sync
{
    private string $stock_endpoint;
    private int $request_timeout;
    private bool $sslverify;

    public function __construct(string $stock_endpoint, int $request_timeout, bool $sslverify)
    {
        $this->stock_endpoint = $stock_endpoint;
        $this->request_timeout = $request_timeout;
        $this->sslverify = $sslverify;
    }

    public function sync()
    {
        $all_batches = $this->format_c2o_data_to_batchable_chunks($this->pull_c2o_stock_csv());

        ray($all_batches);

        // // handle each batch
        // foreach ($all_batches as $batch) {

        //     // handle each row in this batch
        //     foreach ($batch as $row) {

        //         $item = explode('","', $row);
        //         $ugly_sku = array_key_exists(5, $item) ? $item[5] : null; // [5] is the SKU header
        //         $sku = str_replace(['"'], '', $ugly_sku);
        //         $ugly_stock_level = array_key_exists(7, $item) ? $item[7] : null; // [7] is the in stock header
        //         $stock_level = str_replace(['"'], '', $ugly_stock_level);

        //         if (in_array($sku, $this->products_to_sync())) {

        //             $product = $this->get_product_by_wpc2o_sku($sku);

        //             $product_id = wc_get_product_id_by_sku($sku);

        //             // $product = wc_get_product($product_id);
        //             wc_delete_product_transients($product_id);
        //             if (intval($stock_level) == 1) {
        //                 update_post_meta($product_id, '_stock_status', 'instock');
        //             }
        //         }
        //     }
        // }
    }

    /**
     * Find products by WPC2O sku
     * @param string $sku 
     * @return \WC_Product[]
     */
    private function get_product_by_wpc2o_sku(string $sku): array
    {

        return [];
    }

    private function format_c2o_data_to_batchable_chunks(array $data): array
    {
        $rows = explode("\n", $data['body']);
        ray($rows);
        array_shift($rows);
        return array_chunk($rows, 1000);
    }

    private function pull_c2o_stock_csv(): array
    {
        $csv = fopen($this->stock_endpoint, "r");

        $line = 1;
        // Iterate over every line of the file
        while (($raw_string = fgets($csv) && $line < 10) !== false) {

            $rows = explode("\n", $raw_string);

            ray($rows);


            // ray($raw_string);

            // $row = str_getcsv($raw_string);


            // into an array: ['1', 'a', 'b', 'c']
            // And do what you need to do with every line
            // ray($row);
            $line++;
        }

        fclose($csv);

        return [];

        // $data = wp_remote_get($this->stock_endpoint, array(
        //     'timeout' => $this->request_timeout,
        //     'sslverify' => $this->sslverify
        // ));

        // if ($data instanceof WP_Error) {
        //     ray($data->errors);
        // }

        // return $data;
    }

    private function products_to_sync(): array
    {
        $products = [];

        // if (taxonomy_exists('product_cat')) {
        //     if (term_exists('clothing', 'product_cat')) {
        //         $products = wc_get_products([
        //             'post_status' => 'publish',
        //             'category' => 'clothing',
        //         ]);
        //         $skus_in_system = [];
        //         foreach ($products as $product) {
        //             if ($product->is_type('variable')) {
        //                 $variations = $product->get_available_variations();
        //                 foreach ($variations as $variation) {
        //                     $skus_in_system[] = $variation['sku'];
        //                 }
        //             }
        //         }
        //     }
        // }

        return $products;
    }
}
