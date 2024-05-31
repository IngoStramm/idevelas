<?php

/** 
 * Template Name: Página inicial * * 
 * @package idevelas */
?>
<?php get_header(); ?>
<?php
$post_id = get_the_ID();
$iv_home_banner_desktop = get_post_meta($post_id, 'iv_home_banner_desktop', true);
$iv_home_banner_mobile = get_post_meta($post_id, 'iv_home_banner_mobile', true);
?>

<?php if ($iv_home_banner_desktop) { ?>
    <div class="home-banner d-none d-md-block">
        <?php foreach ($iv_home_banner_desktop as $item) { ?>
            <div class="shadow-image">
                <?php $url = isset($item['url']) && $item['url'] ? $item['url'] : null; ?>
                <?php if ($url) { ?>
                    <a class="d-flex justify-content-center align-items-center" href="<?php echo $url; ?>">
                    <?php } ?>
                    <figure class="image-wrapper d-flex justify-content-center align-items-center">
                        <img class="img-fluid mx-auto" src="<?php echo $item['image']; ?>">
                    </figure>
                    <?php if ($url) { ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<?php if ($iv_home_banner_mobile) { ?>
    <div class="home-banner visible-phone d-block d-md-none">
        <?php foreach ($iv_home_banner_mobile as $item) { ?>
            <?php $url = isset($item['url']) && $item['url'] ? $item['url'] : null; ?>
            <?php if ($url) { ?>
                <a class="d-flex justify-content-center align-items-center" href="<?php echo $url; ?>">
                <?php } ?>
                <figure class="image-wrapper d-flex justify-content-center align-items-center">
                    <img class="img-fluid mx-auto" src="<?php echo $item['image']; ?>">
                </figure>
                <?php if ($url) { ?>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>
<?php
$categoria_id = get_post_meta($post_id, 'iv_home_cat', true);
if ($categoria_id) {
    $categoria = get_term_by('term_id', $categoria_id, 'product_cat');
    get_template_part('template-parts/content/single-product/categoria', '', array('cat' => $categoria));
}
?>
<?php get_template_part('template-parts/content/single-product/giftbox'); ?>
<?php get_template_part('template-parts/content/single-product/ide'); ?>
<?php get_footer();
