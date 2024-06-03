<footer id="footer" class="mt-5">
    <div class="container">
        <div class="row gy-4 mb-5">

            <div class="col-md-12 d-block d-lg-none">
                <div class="footer-brand-slogan text-center">
                    <h5><?php _e('IDE', 'iv'); ?></h5>
                    <p><?php _e('“Traga a memória aquilo que te dá esperança.”', 'iv'); ?></p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <h6 class="collapse-control" data-bs-toggle="collapse" data-bs-target="#collapseLojaInfo" aria-expanded="false" aria-controls="collapseLojaInfo">
                    <?php _e('Atendimento ao cliente', 'iv'); ?>
                    <i class="bi bi-plus"></i>
                </h6>
                <div class="collapse collapse-container" id="collapseLojaInfo">
                    <ul>

                        <?php $email = iv_get_option('iv_email'); ?>
                        <?php if ($email) { ?>
                            <li><?php printf(__('E-mail: <a href="mailto:%s">%s</a>', 'iv'), $email, $email); ?></li>
                        <?php } ?>

                        <?php $whatsapp = iv_get_option('iv_whatsapp'); ?>
                        <?php if ($whatsapp) { ?>
                            <li><?php printf(__('WhatsApp: <a href="https://wa.me/%s" target="blank">%s</a>', 'iv'), preg_replace('~\D~', '', $whatsapp), $whatsapp); ?> </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <h6 class="collapse-control" data-bs-toggle="collapse" data-bs-target="#collapseLojaRazaoSocial" aria-expanded="false" aria-controls="collapseLojaRazaoSocial">
                    <?php _e('Informações legais', 'iv'); ?>
                    <i class="bi bi-plus"></i>
                </h6>
                <div class="collapse collapse-container" id="collapseLojaRazaoSocial">
                    <ul>
                        <?php $razao_social = iv_get_option('iv_razao_social'); ?>
                        <?php if ($razao_social) { ?>
                            <li><?php printf(__('Razão Social: %s', 'iv'), $razao_social); ?></li>
                        <?php } ?>
                        <?php $cnpj = iv_get_option('iv_cnpj'); ?>
                        <?php if ($cnpj) { ?>
                            <li><?php printf(__('CNPJ: %s', 'iv'), $cnpj); ?></li>
                        <?php } ?>
                        <?php
                        $woocommerce_store_address = get_option('woocommerce_store_address');
                        $woocommerce_store_address_2 = get_option('woocommerce_store_address_2');
                        $woocommerce_store_city = get_option('woocommerce_store_city');

                        $store_raw_country = get_option('woocommerce_default_country');
                        // Split the country/state
                        $split_country = explode(":", $store_raw_country);
                        // Country and state separated:
                        $woocommerce_store_country = $split_country[0];
                        $woocommerce_store_state   = $split_country[1];
                        $woocommerce_store_postcode = get_option('woocommerce_store_postcode');

                        $address_line_1 = $woocommerce_store_address ? $woocommerce_store_address : null;
                        $address_line_2 = $woocommerce_store_address_2 ? $woocommerce_store_address_2 : null;
                        $address_line_3 = $woocommerce_store_city && $woocommerce_store_state ? $woocommerce_store_city . ' - ' . $woocommerce_store_state : null;
                        $address_line_4 = $woocommerce_store_postcode ? $woocommerce_store_postcode : null;
                        ?>
                        <?php if ($address_line_1) { ?><li><?php echo $address_line_1; ?></li><?php } ?>
                        <?php if ($address_line_2) { ?><li><?php echo $address_line_2; ?></li><?php } ?>
                        <?php if ($address_line_3) { ?><li><?php echo $address_line_3; ?></li><?php } ?>
                        <?php if ($address_line_4) { ?><li><?php echo $address_line_4; ?></li><?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <h6 class="collapse-control" data-bs-toggle="collapse" data-bs-target="#collapseFooterMenu" aria-expanded="false" aria-controls="collapseFooterMenu">
                    <?php _e('Menu de rodapé', 'iv'); ?>
                    <i class="bi bi-plus"></i>
                </h6>
                <div class="collapse collapse-container" id="collapseFooterMenu">
                    <?php get_template_part('template-parts/footer/site-footer', 'nav'); ?>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <h6><?php _e('Novidades', 'iv'); ?></h6>
                <p><?php _e('Digite seu melhor email e saiba tudo sobre nossos lançamentos e projetos!', 'iv'); ?></p>

                <?php get_template_part('newsletter', 'form'); ?>
            </div>

        </div>
    </div>
    <?php get_template_part('template-parts/footer/site-footer', 'bottombar'); ?>
</footer>