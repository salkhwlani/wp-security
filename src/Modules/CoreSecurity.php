<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Initializable;
use Yemenifree\WpSecurity\Interfaces\Loadable;

class CoreSecurity implements Loadable, Initializable
{
    /**
     * Load module (perform any tasks that should be done immediately on plugin load).
     */
    public function load()
    {
    }

    /**
     * Initialize module (perform any tasks that should be done init hook).
     */
    public function init()
    {
        // Remove the WordPress version from the <head> tag
        add_filter('the_generator', '__return_empty_string');
        // remove really simple discovery link
        remove_action('wp_head', 'rsd_link');

        // remove version from assets url.
        add_filter('style_loader_src', [$this, 'remove_wp_ver_css_js'], 9999);
        add_filter('script_loader_src', [$this, 'remove_wp_ver_css_js'], 9999);
    }

    /**
     * remove version from assets url.
     *
     * @param $src
     *
     * @return string
     */
    public function remove_wp_ver_css_js($src)
    {
        if (\strpos($src, 'ver=' . get_bloginfo('version'))) {
            $src = remove_query_arg('ver', $src);
        }

        return $src;
    }
}
