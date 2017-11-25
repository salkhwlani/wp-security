<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Interfaces;

interface Activable
{
    /**
     * Activate module (add cron jobs etc.).
     */
    public function activate();

    /**
     * Deactivate module (remove cron jobs etc.).
     */
    public function deactivate();
}
