<?php

// add_filter('woocommerce_get_price_html', 'iv_change_displayed_sale_price_html', 10, 2);
function iv_change_displayed_sale_price_html($price, $product)
{
    // Only on sale products on frontend and excluding min/max price on variable products
    if ($product->is_on_sale() && !is_admin() && !$product->is_type('variable')) {
        // Get product prices
        $regular_price = (float) $product->get_regular_price(); // Regular price
        $sale_price = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

        // "Saving Percentage" calculation and formatting
        $precision = 1; // Max number of decimals
        $saving_percentage = round(100 - ($sale_price / $regular_price * 100), 1) . '%';

        // Append to the formated html price
        $price .= sprintf(__('<span class="saved-sale">%s</span>', 'woocommerce'), $saving_percentage);
    }
    return $price;
}

add_filter('woocommerce_product_price_class', 'iv_product_price_class', 10, 1);

function iv_product_price_class($string)
{
    $string .= ' single-product-price';
    return $string;
}

add_filter('woocommerce_format_sale_price', 'iv_format_sale_price', 10, 3);

function iv_format_sale_price($price, $regular_price, $sale_price)
{
    $formatted_regular_price = is_numeric($regular_price) ? wc_price($regular_price) : $regular_price;
    $formatted_sale_price    = is_numeric($sale_price) ? wc_price($sale_price) : $sale_price;

    $precision = 1; // Max number of decimals
    $saving_percentage = round(100 - ($sale_price / $regular_price * 100), 1) . '%';
    $saving_numeric = $regular_price - $sale_price;

    $texto_parcelamento = get_post_meta(get_the_ID(), 'iv_product_parcelamento', true);

    // Strikethrough pricing.
    $price = '<li class="regular-price">' . __('DE', 'iv') . ': <del>' . $formatted_regular_price . '</del></li>';

    $price .= '<li class="dicount-percentage"><img src="' . IV_URL . '/assets/icons/arrow-down.png" /> ' . $saving_percentage . '</li>';

    // Add the sale price.
    $price .= '<li class="sale-price">' . $formatted_sale_price . '</li>';

    if ($texto_parcelamento) {
        $price .= '<li class="texto-parcelamento">' . $texto_parcelamento . '</li>';
    }

    $price .= '<li class="discount-number">' . wc_price($saving_numeric) . ' ' . __('de desconto', 'iv') . '</li>';

    return $price;
}

// Change add to cart text on single product page
add_filter('woocommerce_product_single_add_to_cart_text', 'iv_add_to_cart_button_text_single');
function iv_add_to_cart_button_text_single()
{
    return __('Adicionar ao carrinho 👉', 'iv');
}

// Change add to cart text on product archives page
// add_filter('woocommerce_product_add_to_cart_text', 'iv_add_to_cart_button_text_archives');
function iv_add_to_cart_button_text_archives()
{
    return __('Add to Cart Button Text', 'iv');
}
