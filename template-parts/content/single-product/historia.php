<?php
$product_id = get_the_ID();
$historia_image_blocks = get_post_meta($product_id, 'iv_produto_historia_image_blocks', true);
$historia_gallery = get_post_meta($product_id, 'iv_produto_historia_gallery', true);
$historia_gallery_text = get_post_meta($product_id, 'iv_produto_historia_gallery_text', true);
// iv_debug($historia_gallery);
?>
<?php if ($historia_image_blocks && $historia_gallery) { ?>
    <div class="produto-historia">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3><?php _e('História', 'iv'); ?></h3>
                </div>
            </div>
            <?php foreach ($historia_image_blocks as $k => $block) { ?>
                <div class="row align-items-center <?php echo $k < count($historia_image_blocks) - 1 ? 'mb-3' : ''; ?>">

                    <div class="col-md-6 order-md-<?php echo $k % 2 ? 2 : 1; ?> p-4">
                        <img class="img-fluid w-100" src="<?php echo $block['imagem']; ?>" alt="">
                    </div>

                    <div class="col-md-6 order-md-<?php echo $k % 2 ? 1 : 2; ?> p-4">
                        <div class="mb-3"><?php echo wpautop($block['texto']); ?></div>
                        <?php echo iv_get_icon(('rococo')); ?>
                    </div>
                </div>
            <?php } ?>

            <div class="clearfix mb-5"></div>

            <div class="row  align-items-center">
                <div class="col-md-6 order-md-2">
                    <div class="produto-historia-carrossel">
                        <?php foreach ($historia_gallery as $item) { ?>
                            <img class="img-fluid center" src="<?php echo $item['imagem']; ?>" alt="">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 order-md-1 text-center text-md-start">
                    <div class="mb-3">
                        <?php echo wpautop($historia_gallery_text); ?>
                    </div>
                    <?php echo iv_get_icon(('rococo')); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.produto-historia -->
<?php } ?>