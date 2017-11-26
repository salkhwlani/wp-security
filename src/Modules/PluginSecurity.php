<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Activable;
use Yemenifree\WpSecurity\Interfaces\Loadable;

class PluginSecurity implements Loadable, Activable
{
    /**
     * Basename of plugin.
     *
     * @var string
     */
    private $basename;

    /**
     * lock filename.
     *
     * @var string
     */
    private $lock_filename = '.wp-security-lock';

    public function __construct($basename)
    {
        $this->basename = $basename;
    }

    /**
     * Load module (perform any tasks that should be done immediately on plugin load).
     */
    public function load()
    {
        add_action('deactivate_plugin', [$this, 'disable_deactivate_plugin'], 99, 2);
    }

    /**
     * Disabled upload zip files ( plugins & themes ) via admin account.
     *
     * @param $plugin
     * @param $network_deactivating
     */
    public function disable_deactivate_plugin($plugin, $network_deactivating)
    {
        if ($this->basename !== $plugin) {
            return;
        }

        // if deactivate is lock.
        if (\file_exists($this->getLockFilename())) {
            wp_die(__('Sorry, you should remove file ' . $this->getLockFilename() . ' to allow to deactivate this plugin.'));
        }
    }

    /**
     * get full path of lock file.
     *
     * @return string
     */
    public function getLockFilename()
    {
        return \rtrim(WC_SECURITY_PATH, '/') . '/' . $this->lock_filename;
    }

    /**
     * {@inheritdoc}
     */
    public function activate()
    {
        \touch($this->getLockFilename());
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate()
    {
    }
}
