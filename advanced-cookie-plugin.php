<?php
/**
 * Plugin Name: Advanced Cookie Plugin
 * Plugin URI: #
 * Description: A secure cookie management plugin with frontend popup for WordPress
 * Version: 1.0.0
 * Author: Dev-D
 * Author URI: #
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: advanced-cookie-plugin
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('ACP_VERSION', '1.0.0');
define('ACP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ACP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once ACP_PLUGIN_DIR . 'includes/class-acp-loader.php';
require_once ACP_PLUGIN_DIR . 'includes/class-acp-admin.php';
require_once ACP_PLUGIN_DIR . 'includes/class-acp-public.php';

new ACP_Loader();
new ACP_Admin('advanced-cookie-plugin', '1.0.0');
new ACP_Public('advanced-cookie-plugin', '1.0.0');
// Initialize the plugin
function run_advanced_cookie_plugin() {
    $plugin = new ACP_Loader();
    $plugin->run();
}
run_advanced_cookie_plugin();
