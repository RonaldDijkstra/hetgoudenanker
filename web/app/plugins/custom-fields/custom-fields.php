<?php
/**
 * Plugin Name:     Custom Fields
 * Description:     Custom fields
 * Author:          Ronald Dijkstra
 * Version:         0.0.1
 * Text Domain:     custom-fields
 * Domain Path:     /languages
 * License:         GPLv2
 *
 * @package         Custom_Fields
 */

// If this file is called directly, abort!
defined('ABSPATH') or die("You can't access this file directly.");

// Define constants.
if (!defined('CUSTOM_FIELDS_DIR_URL')) {
    define('CUSTOM_FIELDS_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('CUSTOM_FIELDS_DIR_PATH')) {
    define('CUSTOM_FIELDS_DIR_PATH', plugin_dir_path(__FILE__));
}

// Plugin activation and deactivation.
register_activation_hook(__FILE__, function() {
    Custom\Fields\Base\Activate::activate();
});
register_deactivation_hook(__FILE__, function() {
    Custom\Fields\Base\Deactivate::deactivate();
});

// Initialize all the core classes of the plugin.
add_action('acf/init', function() {
    if (class_exists('Custom\\Fields\\Init') && class_exists('ACF')) {
        Custom\Fields\Init::register_services();
    }
});