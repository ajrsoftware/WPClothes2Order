<?php

namespace clothes2order\classes;

class VariableProductField
{
    /**
     * Check if the variation parent has any c2o terms
     * @param $variation
     * @return bool
     */
    public function checkIfHasTerm($variation): bool
    {
        $product_variation = wc_get_product($variation);
        $product = wc_get_product($product_variation->get_parent_id());

        if ($product) {
            $term = get_term_by('slug', sanitize_title_with_dashes(get_option('clothes-2-order_product_cat_term')), 'product_cat');

            if (has_term($term->term_id, 'product_cat', $product->ID)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
