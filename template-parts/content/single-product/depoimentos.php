<?php
$product_id = get_the_ID();
$depoimentos = get_post_meta($product_id, 'iv_produto_depoimentos_gallery', true);
if ($depoimentos) {
?>
    <div class="produto-depoimentos">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div id="depoimentos-carousel" class="produto-depoimentos-carrossel">
                        <?php foreach ($depoimentos as $k => $depoimento) { ?>
                            <?php
                            $active = $k === 0 ? 'active' : '';
                            ?>
                            <div class="slick-item <?php echo $active; ?>">
                                <video class="w-100" playsinline="playsinline" autoplay="autoplay" controls="controls" loop="loop" muted="muted" preload="metadata">
                                    <source src="<?php echo $depoimento['video']; ?>" type="video/mp4">
                                </video>
                                <blockquote><?php echo $depoimento['texto']; ?></blockquote>
                                <h5><?php echo $depoimento['autor']; ?></h5>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>