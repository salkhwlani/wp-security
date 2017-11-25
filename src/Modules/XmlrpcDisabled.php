<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Initializable;

class XmlrpcDisabled implements Initializable
{
    /**
     * Initialize module (perform any tasks that should be done init hook).
     */
    public function init()
    {
        // Disable pingbacks
        add_filter('xmlrpc_methods', [$this, 'disablePingbacks']);
        // Disable all XML-RPC methods requiring authentication
        add_filter('xmlrpc_enabled', '__return_false');
    }

    /**
     * Remove pingback.ping from allowed/supported XML-RPC methods.
     *
     * @param array $methods
     *
     * @return array
     */
    public function disablePingbacks($methods)
    {
        unset($methods['pingback.ping']);

        return $methods;
    }
}
