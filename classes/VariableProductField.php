<?php

namespace clothes2order\classes;

class VariableProductField
{
    /**
     * @param $variation
     *
     * @return bool
     */
    public function checkIfHasTerm($variation) : bool
    {
        $product_variation = wc_get_product($variation);
        $product = wc_get_product($product_variation->get_parent_id());

        if ($product) {
            $term = get_term_by('slug', sanitize_title_with_dashes(get_option('clothes-2-order_product_cat_term')), 'product_cat');

            // check if variation parent product has the term, not the variation.
            if (has_term($term->term_id, 'product_cat', $product->ID)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * TODO Set the custom fields we need for this variation of a product
     *
     * @param $loop
     * @param $variation_data
     * @param $variation
     */
    public function variation_settings_fields($loop, $variation_data, $variation)
    {
//        var_dump('SET settings');
//        die();
//        woocommerce_wp_checkbox(
//            array(
//                'id' => "has_class_dates{$loop}",
//                'name' => "has_class_dates[{$loop}]",
//                'value' => get_post_meta($variation->ID, 'has_class_dates', true),
//                'label' => __('&nbsp; Has Class Dates?', 'woocommerce'),
//                'desc_tip' => true,
//                'description' => __('Select if this variation is for a class/course.', 'woocommerce'),
//                'wrapper_class' => 'form-row form-row-full',
//                'required' => true
//            )
//        );
//
//        woocommerce_wp_text_input(
//            array(
//                'id' => "class_start_date{$loop}",
//                'name' => "class_start_date[{$loop}]",
//                'value' => get_post_meta($variation->ID, 'class_start_date', true),
//                'label' => __('Class Start Date', 'woocommerce'),
//                'desc_tip' => true,
//                'description' => __('The start date of this variation.', 'woocommerce'),
//                'wrapper_class' => 'form-row form-row-first',
//            )
//        );
    }

    /**
     * Save variation inputs on post update
     *
     * @param $variation_id
     * @param $loop
     */
    public function save_variation_settings_fields($variation_id, $loop)
    {
//        var_dump('SAVE settings');
//        die();

//        $has_dates = $_POST['has_class_dates'][$loop]; // yes(weird) or null
//
//        if (!is_null($has_dates)) {
//            $start_date = $_POST['class_start_date'][$loop]; // string or empty string
//            $end_date = $_POST['class_end_date'][$loop]; // string or empty string
//
//            if (!empty($start_date) && !empty($end_date)) {
//                update_post_meta($variation_id, 'has_class_dates', esc_attr($has_dates));
//                update_post_meta($variation_id, 'class_start_date', esc_attr($start_date));
//                update_post_meta($variation_id, 'class_end_date', esc_attr($end_date));
//            }
//        }
    }

    /**
     * Load variation custom fields on post open
     *
     * @param $variation
     *
     * @return mixed
     */
    public function load_variation_settings_fields($variation)
    {
//        var_dump('LOAD settings');
//        die();

//        $variation['has_class_dates'] = get_post_meta($variation['variation_id'], 'has_class_dates', true);
//        $variation['class_start_date'] = get_post_meta($variation['variation_id'], 'class_start_date', true);
//        $variation['class_end_date'] = get_post_meta($variation['variation_id'], 'class_end_date', true);
//
        return $variation;
    }

}