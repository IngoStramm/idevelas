<?php
$wrapper_classes  = 'site-header mb-5 sticky-top';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';
$account_page_id = iv_get_page_id('account');
$login_page_id = iv_get_page_id('login');
?>
<?php get_template_part('template-parts/header/site-header', 'topbar'); ?>
<header class="<?php echo esc_attr($wrapper_classes); ?>">
    <nav class="navbar navbar-expand-md" id="first-header-navbar">
        <div class="container">


            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarMenuPrincipal" aria-controls="navbarMenuPrincipal" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="hamburger"> <?php echo iv_get_icon('hamburger'); ?></span>
                <span class="close"><?php echo iv_get_icon('close'); ?></span>
            </button>

            <?php get_template_part('template-parts/header/site-header', 'branding'); ?>

            <div class="d-none d-sm-block">
                <?php get_search_form(); ?>
            </div>

            <?php get_template_part('template-parts/header/site-header-order', 'track'); ?>

            <?php get_template_part('template-parts/header/site-header', 'whatsapp'); ?>

            <ul class="nav my-2 justify-content-between justify-content-md-center my-md-0 text-small align-items-center gap-1">

                <li class="d-block d-md-none">
                    <button class="nav-link d-block text-center px-2" data-bs-toggle="modal" data-bs-target="#searchformModal">
                        <?php echo iv_get_icon('search'); ?>
                    </button>
                </li>

                <?php if (get_option('woocommerce_myaccount_page_id')) { ?>
                    <li class="d-none d-md-block">
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="nav-link d-block text-center px-2">
                            <i class="bi bi-person fs-3"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php /* ?>
                    <li>
                        <a class="nav-link d-block text-center px-2" href="<?php echo wp_logout_url(); ?>">
                            <i class="bi bi-box-arrow-left d-block fs-3"></i>
                        </a>
                    </li>
                    <?php */ ?>


                <li>
                    <a class="nav-link d-block text-center px-2 position-relative" data-bs-toggle="offcanvas" href="#offcanvasMinicart" role="button" aria-controls="offcanvasMinicart">
                        <span class="header-cart position-absolute top-0 start-100 translate-middle badge rounded-pill">
                            <?php echo WC()->cart->get_cart_contents_count(); ?>
                        </span>
                        <?php echo iv_get_icon('cart'); ?>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
    <nav class="navbar navbar-expand-md" id="second-header-navbar">
        <div class="container">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarMenuPrincipal" aria-labelledby="navbarMenuPrincipalLabel">
                <div class="offcanvas-header">
                    <?php get_template_part('template-parts/header/site-header', 'branding'); ?>
                </div>
                <div class="offcanvas-body">
                    <?php get_template_part('template-parts/header/site-header', 'nav'); ?>
                    <?php if (get_option('woocommerce_myaccount_page_id')) { ?>
                        <ul class="navbar-nav me-auto d-block d-md-none">
                            <li class="nav-item">
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="nav-link main-menu-link">
                                    <i class="bi bi-person fs-3"></i>
                                    <?php echo get_the_title(get_option('woocommerce_myaccount_page_id')); ?>
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>

        </div>
    </nav>
</header>