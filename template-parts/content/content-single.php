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
            $term_banner_mobile = get_term_meta($term_id, 'iv_term_banner_mobile', true);
            if ($term_banner_mobile) { ?>
                <img src="<?php echo $term_banner_mobile ?>" class="img-fluid w-100 mb-4 d-block d-md-none">
            <?php
            }
            $term_banner_desktop = get_term_meta($term_id, 'iv_term_banner_desktop', true);
            if ($term_banner_desktop) { ?>
                <img src="<?php echo $term_banner_desktop ?>" class="img-fluid w-100 mb-4 d-none d-md-block">
        <?php
            }
            $term_description = term_description($term_id);
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