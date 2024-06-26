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
    if (is_admin() || is_cart()) {
        return $price;
    }
    $formatted_regular_price = is_numeric($regular_price) ? wc_price($regular_price) : $regular_price;
    $formatted_sale_price    = is_numeric($sale_price) ? wc_price($sale_price) : $sale_price;

    $precision = 1; // Max number of decimals
    $saving_percentage = round(100 - ($sale_price / $regular_price * 100), 1) . '%';
    $saving_numeric = $regular_price - $sale_price;

    // $texto_parcelamento = get_post_meta(get_the_ID(), 'iv_product_parcelamento', true);
    $valor_parcelamento = round($sale_price / 3, 2, PHP_ROUND_HALF_UP);

    $texto_parcelamento = sprintf(__('3x sem juros de %s', 'iv'), wc_price($valor_parcelamento));

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
                <a href="' . get_the_permalink($product_id) . '">
                    <img src="' . wp_get_attachment_url($slide_id) . '" class="rounded d-block w-100">
                </a>
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
    printf('<a href="%s" class="iv-add-to-cart-btn">%s</a>', $link, __('Conhecer experiência 👉', 'iv'));
}

// add_filter('woocommerce_add_to_cart_redirect', 'iv_redirect_add_to_cart');

function iv_redirect_add_to_cart()
{
    global $woocommerce;
    $cw_redirect_url_checkout = wc_get_checkout_url();
    return $cw_redirect_url_checkout;
}

remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart');

add_filter('woocommerce_quantity_input_classes', 'iv_add_css_class_qty_product', 10, 2);

function iv_add_css_class_qty_product($classes, $product)
{
    if (is_array($classes)) {
        $classes[] = 'form-control';
        $classes[] = 'product-' . $product->get_id();
    } else if (is_string($classes)) {
        $classes .= ' form-control';
        $classes .= ' product' . $product->get_id();
    }
    return $classes;
}

add_action('woocommerce_before_quantity_input_field', 'iv_minus_qty_product', 999);

function iv_minus_qty_product()
{
    echo '
    <div class="input-group qty-wrapper">
    <span class="input-group-text"><a href="#" class="minus-qty">&ndash;</a></span>
    ';
}

add_action('woocommerce_after_quantity_input_field', 'iv_plus_qty_product');

function iv_plus_qty_product()
{
    echo '
    <span class="input-group-text"><a href="#" class="plus-qty">+</a></span>
    </div>
    ';
}

add_filter('woocommerce_return_to_shop_redirect', 'iv_woocommerce_return_to_shop_redirect');
add_filter('woocommerce_continue_shopping_redirect', 'iv_woocommerce_return_to_shop_redirect');
function iv_woocommerce_return_to_shop_redirect()
{
    return home_url();
}

add_filter('woocommerce_get_stock_html', 'iv_wc_hide_in_stock_message', 10, 2);
function iv_wc_hide_in_stock_message($html, $product)
{
    $availability = $product->get_availability();
    if (isset($availability['class']) && 'in-stock' === $availability['class']) {
        return '';
    }
    return $html;
}

add_filter('woocommerce_order_button_text', 'iv_checkout_button_text');

function iv_checkout_button_text()
{
    return __('Finalizar compra', 'iv');
}

function woocommerce_widget_shopping_cart_proceed_to_checkout()
{
    $wp_button_class = wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '';
    echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="button checkout wc-forward' . esc_attr($wp_button_class) . '">' . __('Finalizar compra', 'iv') . '</a>';
}

add_action('woocommerce_cart_calculate_fees', 'iv_shipping_method_discount', 20, 1);
function iv_shipping_method_discount($cart_object)
{

    if (is_admin() && !defined('DOING_AJAX')) return;

    $percent = iv_get_option_discount('iv_pct_discount');
    $payment_method = iv_get_option_discount('iv_id_discount');
    $label_text = iv_get_option_discount('iv_text_discount');
    if (!$percent) {
        return;
    }

    if (!$payment_method) {
        return;
    }

    if (!$label_text) {
        return;
    }

    $cart_total = $cart_object->subtotal_ex_tax;
    $chosen_payment_method = WC()->session->get('chosen_payment_method');
    $installed_payment_methods = WC()->payment_gateways()->payment_gateways();

    if ($payment_method == $chosen_payment_method) {
        // Calculation
        $discount = number_format(($cart_total / 100) * $percent, 2);
        // Add the discount
        $cart_object->add_fee($label_text, -$discount, false);
    }
}

add_action('woocommerce_review_order_before_payment', 'iv_refresh_payment_methods');
function iv_refresh_payment_methods()
{
    // jQuery code
?>
    <script type="text/javascript">
        (function($) {
            $('form.checkout').on('change', 'input[name^="payment_method"]', function() {
                $('body').trigger('update_checkout');
            });
        })(jQuery);
    </script>
<?php
}
