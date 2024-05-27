<?php

/**
 * Template used to display post content on single pages.
 *
 * @package idevelas
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_tax('product_cat')) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title default-max-width">', '</h1>'); ?>
                    </header><!-- .entry-header -->
                </div>
            </div>
        </div>
    <?php } else { ?>
        <?php
        $term_id = get_queried_object()->term_id;
        if ($term_id) {
            $term_banner = get_term_meta($term_id, 'iv_term_banner', true);
            $term_description = term_description($term_id);
            if ($term_banner) { ?>
                <img src="<?php echo $term_banner ?>" class="img-fluid w-100 mb-4">
        <?php }
        } ?>
    <?php } ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div><!-- .entry-content -->
            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->