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
    if (is_admin()) {
        return $price;
    }
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
add_filter('woocommerce_product_add_to_cart_text', 'iv_add_to_cart_button_text_archives');
function iv_add_to_cart_button_text_archives()
{
    return __('Conhecer o produto 👉', 'iv');
}


add_filter('woocommerce_add_to_cart_fragments', 'iv_cart_count_fragments', 10, 1);

function iv_cart_count_fragments($fragments)
{
    $fragments['div.basket-item-count'] = '<div class="basket-item-count"><span class="cart-items-count">' . WC()->cart->get_cart_contents_count() . '</span></div>';
    return $fragments;
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash');
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash');

function iv_get_product_gallery()
{
    $product_id = get_the_ID();
    $product = wc_get_product($product_id);

    $attachment_ids = $product->get_gallery_image_ids();
    $thumbnail_id = get_post_thumbnail_id($product_id);
    $slides_id = [];
    $slides_id[] = $thumbnail_id;
    $slides_id = array_merge($slides_id, $attachment_ids);
    $output = '';
    $output .= '<div id="product-slider-' . $product_id . '" class="carousel product-slider slide">';
    foreach ($slides_id as $k => $slide_id) {
        $output .= '<div>
                <img src="' . wp_get_attachment_url($slide_id) . '" class="rounded d-block w-100">
            </div>';
    }
    $output .= '</div>';
    return $output;
}
function woocommerce_template_loop_product_thumbnail()
{
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    // echo woocommerce_get_product_thumbnail();
    echo iv_get_product_gallery();
}

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');

add_action('woocommerce_before_shop_loop_item', 'iv_add_rococo');

function iv_add_rococo()
{
    $icon = iv_get_icon('rococo-line-through');
    $output = '';
    if ($icon) {
        $output .= '<div class="d-flex justify-content-center align-items-center mb-4">' . $icon . '</div>';
    }
    echo $output;
}

function woocommerce_template_loop_product_title()
{
    $css_class = esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title'));
    $link = get_the_permalink();
    $title = get_the_title();
    printf('<h2 class="%s"><a href="%s">%s</a></h2>', $css_class, $link, $title);
}

add_filter('woocommerce_loop_add_to_cart_args', 'iv_loop_add_to_cart_args', 10, 2);

function iv_loop_add_to_cart_args($args, $product)
{
    $args['class'] .= ' iv-add-to-cart-btn';
    return $args;
}

add_filter('woocommerce_show_page_title', '__return_false', 999);

function woocommerce_result_count()
{
    return;
}

function woocommerce_catalog_ordering()
{
    return;
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

add_action('woocommerce_after_shop_loop_item', 'iv_add_to_cart_btn', 19);

function iv_add_to_cart_btn()
{
    $product_id = get_the_ID();
    if (!$product_id) {
        return;
    }
    $link = get_permalink($product_id);
    printf('<a href="%s" class="iv-add-to-cart-btn">%s</a>', $link, __('Conhecer produto 👉', 'iv'));
}
