<?php if (has_nav_menu('footer')) { ?>
    <?php
    wp_nav_menu(
        array(
            'theme_location'    => 'footer',
            'walker'            => new Iv_Walker_Nav_Menu(),
            'menu_class'        => 'navbar-nav',
            'fallback_cb'       => false,
            'container'         => false
        )
    );
    ?>
<?php }
