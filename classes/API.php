<?php

namespace WPC2O;

class API
{
    public function getAPIKey(): ?string
    {
        return get_option(constant("WPC2O_API_KEY")) ?: null;
    }

    public function getOrderEndpoint(): ?string
    {
        return get_option(constant("WPC2O_API_ENDPOINT")) ?: null;
    }

    public function getStockEndpoint(): ?string
    {
        return get_option(constant("WPC2O_API_STOCK_ENDPOINT")) ?: null;
    }

    public function getStoreManagerEmail(): ?string
    {
        return get_option(constant("WPC2O_API_STORE_MANAGER_EMAIL")) ?: null;
    }

    public function APICredentialsCheck(): bool
    {
        if (
            $this->getAPIKey() &&
            $this->getOrderEndpoint() &&
            $this->getStockEndpoint() &&
            $this->getStoreManagerEmail()
        ) {
            return true;
        }
        return false;
    }

    public function getAPIView(): string
    {
        $content = '<h2>API Credentials</h2>';
        $content .= '<div style="padding: 0 12px">';
        $content .= '<p>Key: ' . $this->getAPIKey() . '';
        $content .= '<p>Order endpoint: ' . $this->getOrderEndpoint() . '';
        $content .= '<p>Stock endpoint: ' . $this->getStockEndpoint() . '';
        $content .= '<p>Store manager email: ' . $this->getStoreManagerEmail() . '';
        $content .= '<p style="padding: 10px 0 0 0;"><a href="' . get_admin_url() . 'admin.php?page=wc-settings&tab=products&section=wpc2o">Click here</a> to update your API credentials.</p>';
        $content .= '</div>';
        return $content;
    }

    public function getExamplePOSTRequestView(): string
    {
        $current_user = wp_get_current_user();
        $current_user_meta = get_user_meta($current_user->ID);
        $data = '<pre id="wpc2o-example-json"><code>';
        $json = '
        {
                "api_key": "' . $this->getAPIKey() . '",
                "order": {
                    "order_id": "_",
                    "order_notes": "_",
                    "delivery_method": "' . $this->getChosenDeliveryOption() . '"
                },
                "customer": {
                    "name": "' . $current_user->display_name . '",
                    "email": "' . $current_user->user_email . '",
                    "telephone": "' . $current_user_meta['shipping_phone'][0] . '"
                },
                "address": {
                    "delivery_name": "' . $current_user_meta['shipping_first_name'][0] . ' ' . $current_user_meta['shipping_last_name'][0] . '",
                    "company_name": "' . $current_user_meta['shipping_company'][0] . '",
                    "address_line_1": "' . $current_user_meta['shipping_address_1'][0] . '",
                    "address_line_2": "' . $current_user_meta['shipping_address_2'][0] . '",
                    "city": "' . $current_user_meta['shipping_city'][0] . '",
                    "postcode": "' . $current_user_meta['shipping_postcode'][0] . '",
                    "country": "' . $current_user_meta['shipping_country'][0] . '"
                },
                "products": {
                    "product": [
                        {
                            "sku": "_",
                            "quantity": "_",
                            "logos": {
                                "logo": [
                                    {
                                        "unique_id": "' . $this->getChosenLogo(false) . '_3_8",
                                        "file": "' . $this->getChosenLogo(true) . '",
                                        "position": "3",
                                        "width": "8",
                                        "type": "print"
                                    },
                                    {
                                        "unique_id": "' . $this->getChosenLogo(false) . '_5_12",
                                        "file": "' . $this->getChosenLogo(true) . '",
                                        "position": "5",
                                        "width": "12",
                                        "type": "print"
                                    }
                                ]
                            }
                        }
                    ]
                }
            }
        ';
        $data .= $json;
        $data .= '</code></pre>';
        return $data;
    }

    public function getChosenDeliveryOption(): ?string
    {
        return carbon_get_theme_option(constant("WPC2O_DELIVERY_OPTION")) ?: null;
    }

    public function getChosenLogo(bool $url)
    {
        if ($url) {
            return wp_get_attachment_image_src(
                carbon_get_theme_option(constant("WPC2O_LOGO"))
            )['0'];
        }

        return carbon_get_theme_option(constant("WPC2O_LOGO"));
    }
}
