<?php
$product_id = get_the_ID();
$produto_descricao_carousel = get_post_meta($product_id, 'iv_produto_descricao_carousel', true);
$produto_descricao_title = get_post_meta($product_id, 'iv_produto_descricao_title', true);
$produto_descricao_image = get_post_meta($product_id, 'iv_produto_descricao_image', true);
// iv_debug($produto_descricao_carousel);
?>
<?php if ($produto_descricao_carousel) { ?>
    <div class="produto-descricao">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-5 mb-md-0">
                    <?php if ($produto_descricao_image) { ?>
                        <img class="img-fluid mx-auto mb-5" src="<?php echo $produto_descricao_image; ?>">
                    <?php } ?>
                    <?php if ($produto_descricao_title) { ?>
                        <h3><?php echo $produto_descricao_title; ?></h3>
                    <?php } ?>
                </div>
                <!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div class="text-start mb-5"><?php echo wpautop(get_the_content()); ?></div>
                    <div class="product-descricao-carrossel">
                        <?php foreach ($produto_descricao_carousel as $item) { ?>
                            <div><?php echo wpautop($item['texto']); ?></div>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
    </div>
    <!-- /.produto-descricao -->
<?php } ?>