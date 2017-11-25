<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Interfaces;

interface Installable
{
    /**
     * Install module (add DB tables etc.).
     */
    public function install();

    /**
     * Uninstall module (drop DB tables etc.).
     */
    public function uninstall();
}
