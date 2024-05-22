<?php

/**
 * Template used to display post content on single pages.
 *
 * @package idevelas
 */

?>

<?php
$product_id = get_the_ID();
$product = wc_get_product($product_id);

$attachment_ids = $product->get_gallery_image_ids();
$thumbnail_id = get_post_thumbnail_id($product_id);
$slides_id = [];
$slides_id[] = $thumbnail_id;
$slides_id = array_merge($slides_id, $attachment_ids);
$rating  = $product->get_average_rating();

$terms = get_the_terms($product_id, 'product_cat');
$categoria = null;
foreach ($terms as $term) {
    if ($term->parent) {
        $categoria = $term;
        continue;
    }
}
$categoria_pai = $categoria ? get_term($categoria->parent, 'product_cat') : null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">

            <div class="col-md-12 gx-lg-5">
                <?php
                wc_get_template('single-product/rating.php');
                echo iv_product_rating_stars($rating);
                ?>
            </div><!-- /.col-md-12 -->

            <div class="col-lg-6 gx-lg-5 mb-sm-4">
                <div id="product-slider" class="carousel product-slider slide">
                    <?php foreach ($slides_id as $k => $slide_id) { ?>
                        <?php
                        $active = $k === 0 ? 'active' : '';
                        ?>
                        <div>
                            <img src="<?php echo wp_get_attachment_url($slide_id); ?>" class="rounded d-block w-100">
                        </div>
                    <?php } ?>
                </div>
            </div><!-- /.col-lg-6 -->

            <div class="col-lg-6 gx-lg-5">

                <?php wc_get_template('single-product/title.php'); ?>

                <?php if ($categoria && $categoria_pai) { ?>
                    <?php $cor = get_term_meta($categoria->term_id, 'iv_term_color', true); ?>
                    <div class="categoria-produto" <?php echo $cor ? 'style="background-color: ' . $cor . '"' : ''; ?>>
                        <h4><?php echo $categoria_pai->name; ?> | <?php echo $categoria->name; ?></h4>
                    </div>
                <?php } ?>

                <?php wc_get_template('single-product/price.php'); ?>

                <?php wc_get_template('single-product/add-to-cart/simple.php'); ?>

                <div class="d-flex justify-content-center align-items-center mb-2">
                    <?php echo iv_get_icon('comprar-bandeiras'); ?>
                </div>

                <small class="d-flex justify-content-center align-items-center site-verificado mb-3"><?php _e('SITE OFICIAL VERIFICADO 🥇', 'iv'); ?></small>

                <div class="row g-5 vantagens-produto">
                    <div class="col-6 d-flex justify-content-center gap-2 align-items-center text-center">
                        <?php echo iv_get_icon('truck'); ?>
                        <small><?php _e('Entregue no conforto<br/>de sua casa', 'iv'); ?></small>
                    </div>
                    <div class="col-6 d-flex justify-content-center gap-2 align-items-center text-center">
                        <?php echo iv_get_icon('heart'); ?>
                        <small><?php _e('Você vai amar cada<br/>detalhe da IDE', 'iv'); ?></small>
                    </div>
                </div>

            </div><!-- /.col-lg-6 -->

        </div><!-- /.row -->
    </div><!-- /.container -->

    <?php get_template_part('template-parts/content/single-product/depoimentos'); ?>
    <?php get_template_part('template-parts/content/single-product/historia'); ?>

</article><!-- #post-<?php the_ID(); ?> -->