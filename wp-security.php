<?php
/**
 * Plugin Name: WordPress Security
 * Plugin URI: https://github.com/yemenifree/wp-security
 * Description: Basic security helper for WordPress.
 * Version: 1.0.0
 * Author: Salah Alkhwlani <yemenifree@yandex.com>
 * Author URI: https://www.twitter.com/salahAlkhwlani
 * Requires at least: 4.7
 * Tested up to: 4.8
 */

// Register autoloader for this plugin.
require_once __DIR__ . '/vendor/autoload.php';

define('WC_SECURITY_PATH', __DIR__);

// Construct plugin instance.
$security = new \Yemenifree\WpSecurity\Plugin(plugin_basename(__FILE__));

// Register activation hook.
register_activation_hook(__FILE__, [$security, 'activate']);
// Register deactivation hook.
register_deactivation_hook(__FILE__, [$security, 'deactivate']);
// Ideally, uninstall hook would be registered here, but WordPress allows only static method in uninstall hook...

// Load the plugin.
$security->load();
