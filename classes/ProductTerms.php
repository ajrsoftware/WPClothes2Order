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

                $parent_term = get_term_by('slug', $slug, $taxonomy);
                $this->insertSubTerms($parent_term->term_id, $taxonomy);
            }
        }
    }

    /**
     * @param $parent_id
     * @param $taxonomy
     */
    private function insertSubTerms($parent_id, $taxonomy)
    {
        $terms = CLOTHING_SUB_TERMS;

        foreach ($terms as $term) {
            wp_insert_term($term['name'], $taxonomy, [
                'parent' => $parent_id,
                'description' => $term['description'],
                'slug' => $term['slug']
            ]);
        }
    }
}
