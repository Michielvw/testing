<?php
/*
Plugin Name: Internal
Plugin URI:
Description: For custom internal needs.
Version: 1.0
Author: Made Indonesia
Author URI: http://madeindonesia.nl/
License: Public License
*/

// shortening URL`s
$baseUrl  = home_url();
$themeDir = get_stylesheet_directory();
$themeUrl = get_stylesheet_directory_uri();

define('BASE_URL', $baseUrl);
define('THEME_DIR', $themeDir);
define('THEME_URL', $themeUrl);



// libraries
require WPMU_PLUGIN_DIR . '/internal/libraries/typerocket/init.php';



// core classes & functions
$dir = WPMU_PLUGIN_DIR . '/internal/src/*.php';
foreach (glob($dir) as $file) {
    require_once $file;
}

require_once 'internal/Dev.php';
require_once 'internal/Vars.php';
require_once 'internal/Objects.php';
require_once 'internal/Version.php';
require_once 'internal/xpress.php';



// pluggable functions
require_once 'internal/change_password.php';
