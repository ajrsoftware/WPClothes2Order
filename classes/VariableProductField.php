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

    /**
     * @param $loop
     * @param $variation_data
     * @param $variation
     */
    public function variation_settings_fields($loop, $variation_data, $variation)
    {
        $product_variation = wc_get_product($variation);
        $parent_product = wc_get_product($product_variation->get_parent_id());

        if (has_term('tops', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_rs{$loop}",
                'name' => "c2o_tops_logo_position_rs[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_rs', true),
                'label' => __('&nbsp;Right sleeve', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_br{$loop}",
                'name' => "c2o_tops_logo_position_br[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_br', true),
                'label' => __('&nbsp;Bottom right', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_rc{$loop}",
                'name' => "c2o_tops_logo_position_rc[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_rc', true),
                'label' => __('&nbsp;Right chest', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_cc{$loop}",
                'name' => "c2o_tops_logo_position_cc[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_cc', true),
                'label' => __('&nbsp;Center chest', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_lc{$loop}",
                'name' => "c2o_tops_logo_position_lc[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_lc', true),
                'label' => __('&nbsp;Left chest', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_bl{$loop}",
                'name' => "c2o_tops_logo_position_bl[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_bl', true),
                'label' => __('&nbsp;Bottom left', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_ls{$loop}",
                'name' => "c2o_tops_logo_position_ls[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_ls', true),
                'label' => __('&nbsp;Left sleeve', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_cb{$loop}",
                'name' => "c2o_tops_logo_position_cb[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_cb', true),
                'label' => __('&nbsp;Center back', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_tb{$loop}",
                'name' => "c2o_tops_logo_position_tb[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_tb', true),
                'label' => __('&nbsp;Top back', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_tc{$loop}",
                'name' => "c2o_tops_logo_position_tc[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_tc', true),
                'label' => __('&nbsp;Top chest', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_tops_logo_position_ib{$loop}",
                'name' => "c2o_tops_logo_position_ib[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tops_logo_position_ib', true),
                'label' => __('&nbsp;Inside back (For printed labels)', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }

        if (has_term('bottoms', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_bottoms_logo_position_lp{$loop}",
                'name' => "c2o_bottoms_logo_position_lp[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_bottoms_logo_position_lp', true),
                'label' => __('&nbsp;Left pocket', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);

            woocommerce_wp_checkbox([
                'id' => "c2o_bottoms_logo_position_rp{$loop}",
                'name' => "c2o_bottoms_logo_position_rp[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_bottoms_logo_position_rp', true),
                'label' => __('&nbsp;Right pocket', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }

        if (has_term('hats', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_hats_logo_position_front{$loop}",
                'name' => "c2o_hats_logo_position_front[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_hats_logo_position_front', true),
                'label' => __('&nbsp;Front', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }

        if (has_term('bags', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_bags_logo_position_front{$loop}",
                'name' => "c2o_bags_logo_position_front[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_bags_logo_position_front', true),
                'label' => __('&nbsp;Front', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }

        if (has_term('tea-towels', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_tt_logo_position_center{$loop}",
                'name' => "c2o_tt_logo_position_center[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_tt_logo_position_center', true),
                'label' => __('&nbsp;Center', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }

        if (has_term('ties', 'product_cat', get_post($parent_product->ID))) {
            echo '<p>Select logo positions:</p>';
            woocommerce_wp_checkbox([
                'id' => "c2o_ties_logo_position_front{$loop}",
                'name' => "c2o_ties_logo_position_front[{$loop}]",
                'value' => get_post_meta($variation->ID, 'c2o_ties_logo_position_front', true),
                'label' => __('&nbsp;Front', 'woocommerce'),
                'desc_tip' => true,
                'wrapper_class' => 'form-row form-row-full',
                'required' => false
            ]);
        }
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForTops($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_tops_logo_position_rs', esc_attr($_POST['c2o_tops_logo_position_rs'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_br', esc_attr($_POST['c2o_tops_logo_position_br'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_rc', esc_attr($_POST['c2o_tops_logo_position_rc'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_cc', esc_attr($_POST['c2o_tops_logo_position_cc'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_lc', esc_attr($_POST['c2o_tops_logo_position_lc'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_bl', esc_attr($_POST['c2o_tops_logo_position_bl'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_ls', esc_attr($_POST['c2o_tops_logo_position_ls'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_cb', esc_attr($_POST['c2o_tops_logo_position_cb'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_tb', esc_attr($_POST['c2o_tops_logo_position_tb'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_tc', esc_attr($_POST['c2o_tops_logo_position_tc'][$loop]));
        update_post_meta($variation_id, 'c2o_tops_logo_position_ib', esc_attr($_POST['c2o_tops_logo_position_ib'][$loop]));
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForBottoms($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_bottoms_logo_position_lp', esc_attr($_POST['c2o_bottoms_logo_position_lp'][$loop]));
        update_post_meta($variation_id, 'c2o_bottoms_logo_position_rp', esc_attr($_POST['c2o_bottoms_logo_position_rp'][$loop]));
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForHats($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_hats_logo_position_front', esc_attr($_POST['c2o_hats_logo_position_front'][$loop]));
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForBags($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_bags_logo_position_front', esc_attr($_POST['c2o_bags_logo_position_front'][$loop]));
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForTeaTowels($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_tt_logo_position_center', esc_attr($_POST['c2o_tt_logo_position_center'][$loop]));
    }

    /**
     * @param $variation_id
     * @param $loop
     * @return void
     */
    public function updatePostMetaForTies($variation_id, $loop)
    {
        update_post_meta($variation_id, 'c2o_ties_logo_position_front', esc_attr($_POST['c2o_ties_logo_position_front'][$loop]));
    }
}
