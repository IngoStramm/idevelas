<?php

/**
 * The template for displaying all product single posts.
 *
 * @package idevelas
 */

get_header(); ?>

<?php

if (have_posts()) {
    // Load posts loop.
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content/content', 'single-product');
    }
}
get_footer();
