<?php
/**
 * Plugin Name:     Custom Blocks
 * Description:     All block setup stuff
 * Author:          Custom
 * Version:         0.0.1
 * Text Domain:     custom-blocks
 * Domain Path:     /languages
 * License:         GPLv2
 *
 * @package         Custom_Blocks
 */

use Custom\Blocks\Base\Activate;
use Custom\Blocks\Base\Deactivate;

// If this file is called directly, abort!
defined('ABSPATH') or die("You can't access this file directly.");

// Define constants.
if (!defined('CUSTOM_BLOCKS_DIR_URL')) {
    define('CUSTOM_BLOCKS_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('CUSTOM_BLOCKS_DIR_PATH')) {
    define('CUSTOM_BLOCKS_DIR_PATH', plugin_dir_path(__FILE__));
}

// Plugin activation and deactivation.
register_activation_hook(__FILE__, function() {
    Activate::activate();
});
register_deactivation_hook(__FILE__, function() {
    Deactivate::deactivate();
});

// Initialize all the core classes of the plugin.
add_action('acf/init', function() {
    if (class_exists('Custom\\Blocks\\Init') && class_exists('ACF')) {
        Custom\Blocks\Init::register_services();
    }
});
