<?php

add_action('after_setup_theme', 'iv_setup');

if (!function_exists('iv_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Twenty Twenty-One 1.0
     *
     * @return void
     */
    function iv_setup()
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1568, 9999);

        register_nav_menus(
            array(
                'primary' => esc_html__('Primary menu', 'wt'),
                'footer'  => esc_html__('Secondary menu', 'wt'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        /*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
        $logo_width  = 300;
        $logo_height = 173;

        add_theme_support(
            'custom-logo',
            array(
                'height'               => $logo_height,
                'width'                => $logo_width,
                'flex-width'           => true,
                'flex-height'          => true,
                'unlink-homepage-logo' => true,
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // add_theme_support(
        //     'woocommerce',
        //     apply_filters(
        //         'storefront_woocommerce_args',
        //         array(
        //             'single_image_width'    => 416,
        //             'thumbnail_image_width' => 324,
        //             'product_grid'          => array(
        //                 'default_columns' => 3,
        //                 'default_rows'    => 4,
        //                 'min_columns'     => 1,
        //                 'max_columns'     => 6,
        //                 'min_rows'        => 1,
        //             ),
        //         )
        //     )
        // );

        // add_theme_support('wc-product-gallery-zoom');
        // add_theme_support('wc-product-gallery-lightbox');
        // add_theme_support(
        //     'wc-product-gallery-slider'
        // );
    }
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

add_filter('upload_mimes', 'iv_mime_types');

function iv_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_action('admin_head', 'iv_fix_svg');

function iv_fix_svg()
{
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'iv_fix_svg');
