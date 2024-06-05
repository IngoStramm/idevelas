<?php
$wrapper_classes  = 'site-header sticky-top';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';
$account_page_id = iv_get_page_id('account');
$login_page_id = iv_get_page_id('login');
?>
<?php get_template_part('template-parts/header/site-header', 'topbar'); ?>
<header id="site-header" class="<?php echo esc_attr($wrapper_classes); ?>">
    <nav class="navbar navbar-expand-md" id="first-header-navbar">
        <div class="container">


            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarMenuPrincipal" aria-controls="navbarMenuPrincipal" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="hamburger"> <?php echo iv_get_icon('hamburger'); ?></span>
                <span class="close"><?php echo iv_get_icon('close'); ?></span>
            </button>

            <?php get_template_part('template-parts/header/site-header', 'branding'); ?>

            <div class="d-none d-md-block">
                <?php get_search_form(); ?>
            </div>

            <?php // get_template_part('template-parts/header/site-header-order', 'track'); 
            ?>

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
                            <?php echo iv_get_icon('user-account'); ?>
                            <?php echo iv_text_login_btn(); ?>
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
                        <div class="header-cart position-absolute top-0 start-100 translate-middle badge rounded-pill">
                            <div class="basket-item-count">
                                <span class="cart-items-count">
                                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                                </span>
                            </div>
                        </div>
                        <?php echo iv_get_icon('cart'); ?>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
    <nav class="navbar navbar-expand-md" id="second-header-navbar">
        <div class="container">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarMenuPrincipal" aria-labelledby="navbarMenuPrincipalLabel">
                <div class="offcanvas-header align-items-center justify-content-center">
                    <div class="">
                        <?php get_template_part('template-parts/header/site-header', 'branding'); ?>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php get_template_part('template-parts/header/site-header', 'nav'); ?>
                </div>
                <div class="offcanvas-footer d-md-none">
                    <?php if (get_option('woocommerce_myaccount_page_id')) { ?>
                        <ul class="navbar-nav me-auto d-block mb-2">
                            <li class="nav-item">
                                <a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="nav-link main-menu-link">
                                    <span class="user-icon"><?php echo iv_get_icon('user-account'); ?></span>
                                    <?php echo iv_text_login_btn(); ?>
                                </a>
                            </li>
                        </ul>
                        <ul class="redes-sociais d-flex flex-column align-center justify-content-start gap-2">
                            <?php
                            $whatsapp = iv_get_option('iv_whatsapp');
                            if ($whatsapp) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="https://wa.me/<?php echo preg_replace('~\D~', '', $whatsapp); ?>" target="_blank"><span class="whatsapp-icon"><?php echo iv_get_icon('whatsapp'); ?></span><span><?php _e('WhatsApp', 'iv'); ?></span></a></li>
                            <?php } ?>
                            <?php
                            $facebook = iv_get_option_social_media('iv_facebook');
                            if ($facebook) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo $facebook; ?>" target="_blank"><?php echo iv_get_icon('facebook'); ?><span><?php _e('Facebook', 'iv'); ?></span></a></li>
                            <?php } ?>
                            <?php
                            $instagram = iv_get_option_social_media('iv_instagram');
                            if ($instagram) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo $instagram; ?>" target="_blank"><?php echo iv_get_icon('instagram'); ?><span><?php _e('Instagram', 'iv'); ?></span></a></li>
                            <?php } ?>
                            <?php
                            $youtube = iv_get_option_social_media('iv_youtube');
                            if ($youtube) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo $youtube; ?>" target="_blank"><?php echo iv_get_icon('youtube'); ?><span><?php _e('Youtube', 'iv'); ?></span></a></li>
                            <?php } ?>
                            <?php
                            $tiktok = iv_get_option_social_media('iv_tiktok');
                            if ($tiktok) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo $tiktok; ?>" target="_blank"><?php echo iv_get_icon('tiktok'); ?><span><?php _e('Tik Tok', 'iv'); ?></span></a></li>
                            <?php } ?>
                            <?php
                            $twitter = iv_get_option_social_media('iv_twitter');
                            if ($twitter) { ?>
                                <li class="d-flex align-items-center justify-content-start"><a class="d-flex align-items-center justify-content-start gap-3" href="<?php echo $twitter; ?>" target="_blank"><?php echo iv_get_icon('twitter'); ?><span><?php _e('Twitter', 'iv'); ?></span></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>

        </div>
    </nav>
</header>