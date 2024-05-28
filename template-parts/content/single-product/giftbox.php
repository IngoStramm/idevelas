<?php
$giftbox_titulo = iv_get_option_giftbox('iv_giftbox_titulo');
$giftbox_text = iv_get_option_giftbox('iv_giftbox_text');
$giftbox_destaque = iv_get_option_giftbox('iv_giftbox_destaque');
$giftbox_link_url = iv_get_option_giftbox('iv_giftbox_link_url');
$giftbox_link_text = iv_get_option_giftbox('iv_giftbox_link_text');
$giftbox_image = iv_get_option_giftbox('iv_giftbox_image');
?>
<?php if ($giftbox_titulo && $giftbox_text && $giftbox_destaque && $giftbox_link_url && $giftbox_link_text) { ?>
    <div class="giftbox">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column order-2 order-lg-1 gap-4">
                    <?php echo iv_get_icon('ribon'); ?>
                    <h3 class="giftbox-title"><?php echo $giftbox_titulo; ?></h3>
                    <img src="<?php echo $giftbox_image; ?>" alt="<?php echo $giftbox_titulo; ?>" class="giftbox-image img-fluid rounded d-block d-lg-none mb-2">
                    <p class="giftbox-text"><?php echo $giftbox_text; ?></p>
                    <p class="giftbox-destaque"><?php echo $giftbox_destaque; ?></p>
                    <a href="<?php echo $giftbox_link_url; ?>" class="giftbox-link"><?php echo $giftbox_link_text; ?></a>
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6 d-flex justify-content-center align-items-center order-1 order-lg-2">
                    <img src="<?php echo $giftbox_image; ?>" alt="<?php echo $giftbox_titulo; ?>" class="giftbox-image img-fluid rounded mb-5 mb-lg-0 d-none d-lg-block">
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.giftbox -->
<?php } ?>