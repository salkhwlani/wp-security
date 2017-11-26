<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// If file is not invoked by WordPress, exit.
if (!\defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Register autoloader for this plugin.
require_once __DIR__ . '/vendor/autoload.php';

// Construct plugin instance.
$security = new \Yemenifree\WpSecurity\Plugin(plugin_basename(__FILE__));
// Run uninstall actions.
$security->uninstall();
