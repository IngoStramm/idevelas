<?php

/**
 * Template used to display post content on single pages.
 *
 * @package idevelas
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title default-max-width">', '</h1>'); ?>
                </header><!-- .entry-header -->
            </div>
            <div class="col-md-12">
                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div><!-- .entry-content -->
            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->