<?php
$topbar_text = iv_get_option('iv_topbar_text');
if ($topbar_text) {
?>
    <div id="site-header-topbar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 justify-content-center align-items-center d-flex gap-2">
                    <i class="bi bi-truck"></i>
                    <?php _e('Despachamos no mesmo dia', 'iv'); ?>
                </div>
            </div>
        </div>
    </div>
<?php }
