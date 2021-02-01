<?php

namespace clothes2order\classes;

class ProductTerms {

    public function __construct()
    {
        $this->ensureTermsExist('product_cat', 'class', 'Class', 'Class Products');
        $this->ensureTermsExist('product_cat', 'clothing', 'Clothing', 'Clothing Products');
    }

    protected function ensureTermsExist(string $taxonomy, string $slug, string $name, string $description)
    {
        if (taxonomy_exists($taxonomy)) {
            if (!term_exists($slug, $taxonomy)) {
                wp_insert_term($name, $taxonomy, [
                    'description' => $description,
                    'slug' => $slug
                ]);
            }
        }
    }
}