<div id="footer-bottombar">
    <div class="container">
        <div class="row gy-4">
            <?php $inscricao_estadual = iv_get_option('iv_inscricao_estadual'); ?>
            <?php if ($inscricao_estadual) { ?>
                <div class="col-lg-4 text-center">
                    <h6 class="text-lg-start"><?php printf(__('IDE ™ %s', 'iv'), $inscricao_estadual); ?></h6>
                </div>
            <?php } ?>
            <?php $col_class = $inscricao_estadual ? 'col-lg-4' : 'col-lg-6'; ?>
            <div class="<?php echo $col_class; ?>">
                <h6 class="text-center"><?php _e('Formas de pagamento', 'iv'); ?></h6>
                <div class="d-flex justify-content-center align-items-center">
                    <?php echo iv_get_icon('bandeiras'); ?>
                </div>
            </div>
            <div class="<?php echo $col_class; ?> reclame-aqui-banner"><?php echo iv_get_icon('reclame-aqui'); ?></div>
        </div>
    </div>
</div>