<?php

/**
 * Calculates classes for the main <html> element.
 *
 * @return void
 */
function iv_the_html_classes()
{
    /**
     * Filters the classes for the main <html> element.
     *
     * @param string The list of classes. Default empty string.
     */
    $classes = apply_filters('iv_html_classes', '');
    if (!$classes) {
        return;
    }
    echo 'class="' . esc_attr($classes) . '"';
}

/**
 * iv_get_icon
 *
 * @param  string $name
 * @return string
 */
function iv_get_icon($name)
{
    $icon = empty($name) || is_null($name) ? null : file_get_contents(IV_DIR . '/assets/icons/' . $name . '.svg');
    return !$icon ? null : $icon;
}

add_action('iv_modal', 'iv_searchform_modal');

function iv_searchform_modal()
{
?>
    <div class="modal fade" id="searchformModal" tabindex="-1" aria-labelledby="searchformModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="searchformModalLabel"><?php _e('Pesquisar', 'iv') ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php _e('Fechar', 'iv'); ?>"></button>
                </div>
                <div class="modal-body">
                    <?php get_search_form(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php _e('Fechar', 'iv'); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php
}

function iv_product_rating_stars($rating)
{
    $max_stars = 5;
    $filled_stars = intval($rating);
    $blank_stars = 5 - $filled_stars;
    $output = '';
    $output .= '<ul class="rating-list">';
    for ($i = 0; $i < $filled_stars; $i++) {
        $output .= '<li class="active"><i class="bi bi-star-fill"></i></li>';
    }
    for ($i = 0; $i < $blank_stars; $i++) {
        $output .= '<li><i class="bi bi-star-fill"></i></li>';
    }
    $output .= '</ul>';
    return $output;
}

add_action('wp_head', 'iv_dynamic_tax_css_class');
function iv_dynamic_tax_css_class()
{
    $output = '<style>';
    $terms = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    ));
    // iv_debug($terms);
    foreach ($terms as $term) {
        $term_color = get_term_meta($term->term_id, 'iv_term_color', true);
        if($term_color && !$term->parent) {
            $output .= "\n.$term->slug > a {
                border-left: 5px solid $term_color;
            }";
        }
    }
    $output .= '</style>';
    echo $output;
}
