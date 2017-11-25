<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Interfaces;

interface Loadable
{
    /**
     * Load module (perform any tasks that should be done immediately on plugin load).
     */
    public function load();
}
