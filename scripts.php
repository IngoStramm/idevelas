<?php

add_action('wp_enqueue_scripts', 'iv_frontend_scripts');

function iv_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';
    $version = iv_version();

    if (empty($min)) :
        wp_enqueue_script('idevelas-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    // wp_register_script('list-js', IV_URL . '/assets/js/list' . $min . '.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('imask-script', IV_URL . '/assets/js/imask.min.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('bootstrap-script', IV_URL . '/assets/js/bootstrap.bundle.min.js', array('jquery'), $version, true);

    wp_register_script('list-js', IV_URL . '/assets/js/list' . $min . '.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('slick-script', IV_URL . '/assets/js/slick/slick.min.js', array('jquery'), $version, true);

    wp_register_script('idevelas-script', IV_URL . '/assets/js/idevelas' . $min . '.js', array('jquery', 'bootstrap-script', 'imask-script', 'list-js', 'slick-script'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_enqueue_script('idevelas-script');

    wp_localize_script('idevelas-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'plugin_url' => IV_URL
    ));
    wp_enqueue_style('bootstrap-style', IV_URL . '/assets/css/bootstrap.min.css', array(), $version, 'all');
    wp_enqueue_style('bootstrap-icon-style', IV_URL . '/assets/fonts/bootstrap-icons/bootstrap-icons.min.css', array(), $version, 'all');
    wp_enqueue_style('slick-style', IV_URL . '/assets/js/slick/slick.css', array(), $version, 'all');
    wp_enqueue_style('slick-theme-style', IV_URL . '/assets/js/slick/slick-theme.css', array(), $version, 'all');
    // wp_enqueue_style('googleapis', 'https://fonts.googleapis.com', array(), null, 'all');
    // wp_enqueue_style('gstatic', 'https://fonts.gstatic.com', array(), null, 'all');
    wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&display=swap', array(), null, 'all');
    wp_enqueue_style('adventpro-font', 'https://fonts.googleapis.com/css2?family=Advent+Pro:ital,wght@0,100..900;1,100..900&display=swap', array(), null, 'all');
    wp_enqueue_style('idevelas-style', IV_URL . '/assets/css/idevelas.css', array('bootstrap-style', 'inter-font'), $version, 'all');
}

add_action('admin_enqueue_scripts', 'iv_admin_scripts');

function iv_admin_scripts()
{
    if (!is_user_logged_in())
        return;

    $version = iv_version();

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    wp_register_script('imask-script', IV_URL . '/assets/js/imask.min.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('idevelas-admin-script', IV_URL . '/assets/js/idevelas-admin' . $min . '.js', array('jquery', 'imask-script'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_enqueue_script('idevelas-admin-script');

    wp_localize_script('idevelas-admin-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
