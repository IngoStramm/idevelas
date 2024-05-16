<?php
#region Constants
define('IV_DIR', get_template_directory());
define('IV_URL', get_template_directory_uri());

#endregion Constants

#region Classes

require_once(IV_DIR . '/classes/classes.php');

#endregion Classes

#region Requires

// Theme Functions
require_once(IV_DIR . '/theme-functions/theme-functions.php');

// CMB2
require_once(IV_DIR . '/cmb2/cmb2.php');

// Style/Scripts include
require_once(IV_DIR . '/scripts.php');

#endregion Requires