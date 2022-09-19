<?php

/**
 * WPC2O_Stock_Sync File Doc Comment
 * 
 * @category WPC2O_C2O_Stock_Sync
 * @package WPClothes2Order
 */
class WPC2O_Stock_Sync
{
    private string $stock_endpoint;
    private int $request_timeout;
    private string $file_name;

    /**
     * Setup a new stock sync properties
     * @param string $stock_endpoint 
     * @param int $request_timeout 
     * @return void 
     */
    public function __construct(string $stock_endpoint, int $request_timeout)
    {
        $this->stock_endpoint  = $stock_endpoint;
        $this->request_timeout = $request_timeout;
    }

    /**
     * Perform a C2O to WPC2O stock sync
     */
    public function sync()
    {
        // Get all WPC2O enabled products
        $wp_product_posts = $this->products_to_sync();

        // If no enabled products, early return
        if (count($wp_product_posts) <= 0) {
            return 'No products to sync';
        }

        $skus_to_sync = array();

        // Build up an array of skus in the WC store that need to be updated
        foreach ($wp_product_posts as $post) {
            $meta           = get_post_meta($post->ID);
            $sku            = $meta['_' . constant('WPC2O_PRODUCT_SKU') . ''][0];
            $skus_to_sync[] = $sku;
        }

        // create a new filename for the csv at this current time
        $this->create_file_name();

        // Download the csv
        $download_status = $this->download_url_to_file($this->stock_endpoint, $this->download_path() . $this->file_name);

        // handle when the download fails
        if (!$download_status) {
            return 'There was a problem downloading the Clothes2Order CSV. If this problem persist, please see the help and support page of this plugin.';
        }

        // Collect the csv in batches of arrays, easier to process
        $batches = $this->read_products_csv_to_batches($this->download_path() . $this->file_name);

        $c2o_skus = array();
        foreach ($batches as $batch) {
            foreach ($batch as $row) {
                if (in_array($row[5], $skus_to_sync, true)) {
                    $c2o_skus[] = $row;
                }
            }
        }

        if (count($c2o_skus) <= 0) {
            return 'No Clothes2Order SKUs you have assigned to your products, nothing to sync.';
        }

        foreach ($c2o_skus as $c2o_sku) {

            $enabled_field = '_' . constant('WPC2O_PRODUCT_ENABLED') . '';
            $enabled_value = 'yes';
            $sku_field     = '_' . constant('WPC2O_PRODUCT_SKU') . '';

            $args = array(
                'post_type'   => 'product',
                'numberposts' => -1,
                'post_status' => 'publish',
                'meta_query'  => array(
                    array(
                        'key'     => $enabled_field,
                        'value'   => $enabled_value,
                        'compare' => '=',
                    ),
                    array(
                        'key'     => $sku_field,
                        'value'   => $c2o_sku[5],
                        'compare' => '=',
                    ),
                ),
            );

            $query = new WP_Query($args);

            foreach ($query->posts as $post) {

                $enabled_to_manage_stock_level_field = '_' . constant('WPC2O_AUTO_STOCK_LEVELS') . '';
                $enabled_to_manage_stock_level_value = 'yes';

                if ($enabled_to_manage_stock_level_field === $enabled_to_manage_stock_level_value) {
                    if ($c2o_sku[7] === '') {
                        update_post_meta($post->ID, '_stock_status', 'outofstock');
                        wc_update_product_stock($post->ID, 0, 'set', true);
                    }

                    if ($c2o_sku[7] === '1') {
                        update_post_meta($post->ID, '_stock_status', 'instock');
                        wc_update_product_stock($post->ID, intval($c2o_sku[8]), 'set', true);
                    }
                } else {
                    if ($c2o_sku[7] === '') {
                        update_post_meta($post->ID, '_stock_status', 'outofstock');
                    }

                    if ($c2o_sku[7] === '1') {
                        update_post_meta($post->ID, '_stock_status', 'instock');
                    }
                }
            }
        }

        return 'Stocks levels have been updated to sync with Clothes2Order.';
    }

    /**
     * Return the absolute url of the wp file dir where the products csv should live
     * @return string 
     */
    private function download_path(): string
    {
        return 'wp-content/plugins/WPClothes2Order/downloads/';
    }

    /**
     * Attempt to download the C2O products csv
     * @param string $url 
     * @param string $out_file_name 
     * @return bool 
     */
    private function download_url_to_file(string $url, string $out_file_name): bool
    {
        $options = array(
            CURLOPT_FILE    => fopen($out_file_name, 'w'),
            CURLOPT_TIMEOUT => $this->request_timeout,
            CURLOPT_URL     => $url,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            return false;
        }

        return true;
    }

    /**
     * Generate a new filename for the products csv
     * @return void 
     */
    private function create_file_name(): void
    {
        $this->file_name = 'products' . time() . '.csv';
    }

    private function read_products_csv_to_batches($fileparam): array
    {
        $file_array = array();

        $file = fopen($fileparam, 'r');
        while (( $line = fgetcsv($file) ) !== false) {
            $file_array[] = $line;
        }

        array_shift($file_array);

        $batches = array_chunk($file_array, 800);

        return $batches;
    }

    private function products_to_sync(): array
    {
        $enabled_field = '_' . constant('WPC2O_PRODUCT_ENABLED') . '';
        $enabled_value = 'yes';

        $args = array(
            'post_type'   => 'product',
            'numberposts' => -1,
            'post_status' => 'publish',
            'meta_query'  => array(
                array(
                    'key'     => $enabled_field,
                    'value'   => $enabled_value,
                    'compare' => '=',
                ),
            ),
        );

        $query = new WP_Query($args);

        return $query->posts;
    }
}
