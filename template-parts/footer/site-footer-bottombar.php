<div id="footer-bottombar">
    <div class="container">
        <div class="row gy-4">
            <?php /* ?>
            <?php $cnpj = iv_get_option('iv_cnpj'); ?>
            <?php if ($cnpj) { ?>
                <div class="col-lg-4 text-center">
                    <h6 class="text-lg-start"><?php printf(__('IDE ™ %s', 'iv'), $cnpj); ?></h6>
                </div>
            <?php } ?>
            <?php $col_class = $cnpj ? 'col-lg-4' : 'col-lg-6'; ?>
            <?php */ ?>
            <?php $col_class = 'col-lg-6'; ?>
            <div class="<?php echo $col_class; ?>">
                <div class="d-flex justify-content-center align-items-center">
                    <?php echo iv_get_icon('bandeiras'); ?>
                </div>
            </div>
            <div class="<?php echo $col_class; ?> reclame-aqui-banner"><?php echo iv_get_icon('reclame-aqui'); ?></div>
        </div>
    </div>
</div>