<?php
/**
 * Plugin Name: Fonterra
 * Plugin URI:  http://madeindonesia.nl
 * Description: Fonterra
 * Version:     1.0.0
 * Author:      Born Digital
 * Author URI:  http://fonterragame.wpengine.com/
 * License:     MIT
 * License URI: http://fonterragame.wpengine.com/wp-content/plugins/fonterra/MIT.txt
*/

defined('ABSPATH') or die('Can\'t access directly');

// helper constants
define('INTERNAL_PLUGIN_URL', rtrim(plugin_dir_url(__FILE__), '/' ));
define('INTERNAL_PLUGIN_DIR', rtrim(plugin_dir_path(__FILE__), '/' ));

// components
$autoloads = glob(INTERNAL_PLUGIN_DIR . "/*/autoload.php");

foreach ($autoloads as $file) {
    require_once $file;
}
