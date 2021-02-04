<?php

namespace clothes2order\classes;

class ProductTerms
{

    /**
     * @param string $taxonomy
     * @param string $slug
     * @param string $name
     * @param string $description
     */
    public function ensureTermsExist(string $taxonomy, string $slug, string $name, string $description): void
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