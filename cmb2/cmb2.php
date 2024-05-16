<?php
if (!iv_check_if_plugin_is_active('cmb2/init.php')) {
    return;
}

require_once(IV_DIR . '/cmb2/cmb-settings.php');
require_once(IV_DIR . '/cmb2/cmb-post-type.php');
