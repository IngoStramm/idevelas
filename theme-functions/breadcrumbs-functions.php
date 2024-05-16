<?php

/**
 * Display the breadcrumb automaticaly
 * @param  Array $custom_post_types [OPTIONAL] Prevent custom post types with hierarchical structure
 */

function iv_breadcrumbs($custom_post_types = false)
{
    wp_reset_query();
    global $post;
    $output = '';
    $is_custom_post = $custom_post_types ? is_singular('anuncios') : false;

    $output .= '<ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">';
    $output .= '<li class="breadcrumb-item"><a class="link-body-emphasis" href="';
    $output .= get_option('home');
    $output .= '">';
    $output .= '<i class="bi bi-house-door-fill"></i>';
    $output .= '<span class="visually-hidden">' . get_bloginfo('name') . '</span>';
    $output .= "</a></li>";
    if (has_category()) {
        $output .= '<li class="breadcrumb-item active" aria-current="page"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_permalink(get_page(get_the_category($post->ID)))) . '">';
        $category = get_the_category();
        if (!is_array($category)) {
            $output .= get_the_category(', ');
        } else {
            $output .= $category[0]->name;
        }
        $output .= '</a></li>';
    }
    if (is_search()) {
        $output .= '<li class="breadcrumb-item active">' . __('Resultados para:', 'wt') . ' "' . get_search_query() . '"</li>';
    } elseif (is_archive() || is_category() || is_single() || $is_custom_post) {
        if (is_category()) {
            $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_permalink(get_page(get_the_category($post->ID)))) . '">' . get_the_category($post->ID)[0]->name . '</a></li>';
        }
        if (is_archive() && !is_author() && !is_search()) {
            $current_term = get_queried_object();
            if (isset($current_term->parent) && $current_term->parent) {
                $parent = get_term_by('term_id', $current_term->parent, 'categoria-de-anuncio');
                $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_term_link($parent, 'categoria-de-anuncio')) . '">' . $parent->name . '</a></li>';
            }
            // checa se é mesmo um termo
            if (isset($current_term->term_id)) {
                $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_term_link($current_term, 'categoria-de-anuncio')) . '">' . $current_term->name . '</a></li>';
            } elseif (isset($current_term->labels) && isset($current_term->labels->name)) {
                $output .= '<li class="breadcrumb-item active">' . $current_term->labels->name . '</li>';
            } else {
                $output .= '<li class="breadcrumb-item active">' . $current_term->name . '</li>';
            }
        }
        if (is_author()) {
            $author_data = get_queried_object();
            $display_name = $author_data->get('first_name') && $author_data->get('last_name') ? $author_data->get('first_name') . ' ' . $author_data->get('last_name') : $author_data->get('display_name');
            $output .= '<li class="breadcrumb-item active">' . $display_name . '</li>';
        }
        if ($is_custom_post) {
            $slug = get_post_type_object(get_post_type($post))->name;
            if ($slug !== 'anuncios') {
                $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . get_option('home') . '/' . $slug . '">' . get_post_type_object(get_post_type($post))->label . '</a></li>';
            }
            if (has_term('', 'categoria-de-anuncio', $post)) {
                $terms = get_the_terms($post, 'categoria-de-anuncio');
                $children = '';
                $parent = '';
                foreach ($terms as $term) {
                    if ($term->parent) {
                        $children = $term;
                    } else {
                        $parent = $term;
                    }
                }
                if ($children) {
                    $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_term_link($parent->slug, 'categoria-de-anuncio')) . '">' . $parent->name . '</a></li>';
                    $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_term_link($children->slug, 'categoria-de-anuncio')) . '">' . $children->name . '</a></li>';
                } else {
                    $output .= '<li class="breadcrumb-item active"><a class="link-body-emphasis fw-semibold text-decoration-none" href="' . esc_url(get_term_link($parent->slug, 'categoria-de-anuncio')) . '">' . $parent->name . '</a></li>';
                }
            }
            if ($post->post_parent) {
                $home = get_page(get_option('page_on_front'));
                for ($i = count($post->ancestors) - 1; $i >= 0; $i--) {
                    if (($home->ID) != ($post->ancestors[$i])) {
                        $output .= '<li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="';
                        $output .= get_permalink($post->ancestors[$i]);
                        $output .= '">';
                        $output .= get_the_title($post->ancestors[$i]);
                        $output .= "</a></li>";
                    }
                }
            }
        }
        if (is_single()) {
            $output .= '<li class="breadcrumb-item active">' . get_the_title($post->ID) . '</li>';
        }
    } elseif (is_page() && $post->post_parent) {
        $home = get_page(get_option('page_on_front'));
        for ($i = count($post->ancestors) - 1; $i >= 0; $i--) {
            if (($home->ID) != ($post->ancestors[$i])) {
                $output .= '<li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="';
                $output .= get_permalink($post->ancestors[$i]);
                $output .= '">';
                $output .= get_the_title($post->ancestors[$i]);
                $output .= "</a></li>";
            }
        }
        $output .= '<li class="breadcrumb-item active">' . get_the_title($post->ID) . '</li>';
    } elseif (is_page()) {
        $output .= '<li class="breadcrumb-item active">' . get_the_title($post->ID) . '</li>';
    } elseif (is_404()) {
        $output .= '<li class="breadcrumb-item active">404</li>';
    }

    if (!is_home() && !is_front_page()) {
        $output .= '<li class="ms-auto"><a class="go-back-btn link-body-emphasis fw-semibold text-decoration-none" href="#">' . __('Voltar', 'wt') . '</a></li>';
    }
    $output .= '</ol>';
    return $output;
}
