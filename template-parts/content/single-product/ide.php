<?php
$ide_image = iv_get_option_ide('iv_ide_image');
$ide_main_text = iv_get_option_ide('iv_ide_main_text');
$ide_sec_text = iv_get_option_ide('iv_ide_sec_text');
?>
<?php if ($ide_image && $ide_main_text && $ide_sec_text) { ?>
    <div class="ide">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
                    <img src="<?php echo $ide_image; ?>" class="ide-image img-fluid mx-auto mb-5 mb-lg-0">
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column gap-5">
                    <h4 class="ide-main-text"><?php echo $ide_main_text; ?></h4>
                    <blockquote><?php echo $ide_sec_text; ?></blockquote>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.ide -->
<?php } ?>