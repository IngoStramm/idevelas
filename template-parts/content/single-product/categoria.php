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

                <div class="col-lg-6 d-flex flex-column gap-4 px-lg-5 mb-5 mb-lg-0">
                    <?php if ($term_logo) { ?>
                        <img class="img-fluid" src="<?php echo $term_logo; ?>" alt="<?php echo $cat->name; ?>">
                    <?php } ?>
                    <?php if ($term_description) { ?>
                        <?php echo wpautop($term_description); ?>
                    <?php } ?>
                </div>
                <?php if ($term_gallery) { ?>
                    <div class="col-lg-6 px-lg-5">
                        <div class="produto-categoria-carrossel">
                            <?php foreach ($term_gallery as $item) { ?>
                                <div class="produto-categoria-carrossel-item">
                                    <?php if ($item['url']) { ?><a href="<?php echo $item['url']; ?>"><?php } ?>
                                        <img class="img-fluid" src="<?php echo $item['image']; ?>" />
                                    <?php if ($item['url']) { ?></a><?php } ?>
                                </div>
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