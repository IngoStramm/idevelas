<?php if (has_nav_menu('primary')) : ?>
    <?php
    wp_nav_menu(
        array(
            'theme_location'    => 'primary',
            'walker'            => new Iv_Walker_Nav_Menu(),
            'menu_class'        => 'navbar-nav me-auto',
            'fallback_cb'       => false,
            'container'         => false
        )
    );
    ?>
<?php endif; ?>