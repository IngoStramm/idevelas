<?php
$whatsapp = iv_get_option('iv_whatsapp');
if ($whatsapp) { ?>
    <div class="header-whatsapp header-widget">
        <?php echo iv_get_icon('whatsapp'); ?>
        <h5>Dúvidas?</h5>
        <h4><?php printf(__('<a href="https://wa.me/%s" target="blank">%s</a>', 'iv'), preg_replace('~\D~', '', $whatsapp), $whatsapp); ?></h4>
    </div>
<?php } ?>