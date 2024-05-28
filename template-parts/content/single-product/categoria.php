<?php
if (isset($args['cat']) && $args['cat']) { ?>
    <?php
    $cat = $args['cat'];
    $term_id = $cat->term_id;
    $term_logo = get_term_meta($term_id, 'iv_term_logo', true);
    $term_gallery = get_term_meta($term_id, 'iv_term_gallery', true);
    $term_description = term_description($term_id);
    // iv_debug($term_gallery);
    ?>
    <div class="produto-categoria">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 d-flex flex-column gap-5 px-lg-5">
                    <?php if ($term_logo) { ?>
                        <img class="img-fluid" src="<?php echo $term_logo; ?>" alt="<?php echo $cat->name; ?>">
                    <?php } ?>
                    <?php if ($term_description) { ?>
                        <?php echo wpautop($term_description); ?>
                    <?php } ?>
                    <h4 class="mb-5 mb-lg-0"><?php _e('Quais destas histórias você já conhece?', 'iv'); ?></h4>
                </div>
                <?php if ($term_gallery) { ?>
                    <div class="col-lg-6 px-lg-5">
                        <div class="produto-categoria-carrossel">
                            <?php foreach ($term_gallery as $item) { ?>
                                <img class="img-fluid" src="<?php echo $item; ?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
<?php } ?>