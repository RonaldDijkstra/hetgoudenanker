<?php
/**
 * Plugin Name:     Tweaks
 * Description:     All the things
 * Author:          Ronald Dijkstra
 * Version:         0.0.1
 * Text Domain:     custom-plugin
 * Domain Path:     /languages
 * License:         GPLv2
 *
 * @package         Custom_Plugin
 */

use Custom\Plugin\Base\Activate;
use Custom\Plugin\Base\Deactivate;

// If this file is called directly, abort!
defined('ABSPATH') or die("You can't access this file directly.");

// Define constants.
if (!defined('CUSTOM_PLUGIN_DIR_URL')) {
    define('CUSTOM_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('CUSTOM_PLUGIN_DIR_PATH')) {
    define('CUSTOM_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

// Plugin activation and deactivation.
register_activation_hook(__FILE__, function() {
    Custom\Plugin\Base\Activate::activate();
});
register_deactivation_hook(__FILE__, function() {
    Custom\Plugin\Base\Deactivate::deactivate();
});

// Initialize all the core classes of the plugin.
add_action('acf/init', function() {
    if (class_exists('Custom\\Plugin\\Init') && class_exists('ACF')) {
        Custom\Plugin\Init::register_services();
    }
});