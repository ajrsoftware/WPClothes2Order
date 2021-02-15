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
        $terms = $this::getTermsArray();

        foreach ($terms as $term) {
            wp_insert_term($term['name'], $taxonomy, [
                'parent' => $parent_id,
                'description' => $term['description'],
                'slug' => $term['slug']
            ]);
        }
    }

    /**
     * @return array
     */
    public static function getTermsArray() : array
    {
        return [
            0 => [
                'name' => 'Tops',
                'description' => 'Clothing garments worn on the top half of the body.',
                'slug' => 'tops'
            ],
            1 => [
                'name' => 'Bottoms',
                'description' => 'Clothing garments worn on the bottom half of the body.',
                'slug' => 'bottoms'
            ],
            2 => [
                'name' => 'Hats',
                'description' => 'Clothing garments worn on the head.',
                'slug' => 'hats'
            ],
            3 => [
                'name' => 'Bags',
                'description' => 'Bags.',
                'slug' => 'bags'
            ],
            4 => [
                'name' => 'Tea towels',
                'description' => 'Tea towel.',
                'slug' => 'tea-towels'
            ],
            5 => [
                'name' => 'Tie',
                'description' => 'Ties.',
                'slug' => 'tie'
            ],
        ];
    }
}