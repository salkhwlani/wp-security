<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity;

use Illuminate\Support\Collection;
use Yemenifree\WpSecurity\Helpers\WPGitHubUpdater;
use Yemenifree\WpSecurity\Interfaces\Activable;
use Yemenifree\WpSecurity\Interfaces\Initializable;
use Yemenifree\WpSecurity\Interfaces\Installable;
use Yemenifree\WpSecurity\Interfaces\Loadable;
use Yemenifree\WpSecurity\Modules\ConfigSecurity;
use Yemenifree\WpSecurity\Modules\CoreSecurity;
use Yemenifree\WpSecurity\Modules\HtaccessSecurity;
use Yemenifree\WpSecurity\Modules\ResetSecurity;
use Yemenifree\WpSecurity\Modules\XmlrpcDisabled;

class Plugin
{
    /**
     * list of active modules.
     *
     * @var array|Collection
     */
    protected $modules = [
        HtaccessSecurity::class,
        ConfigSecurity::class,
        XmlrpcDisabled::class,
        CoreSecurity::class,
        ResetSecurity::class,
    ];

    /**
     * plugin dir.
     *
     * @var string
     */
    protected $plugin_dir;

    /**
     * base name of plugin.
     *
     * @var string
     */
    private $basename;

    public function __construct($basename)
    {
        $this->basename = $basename;
        $this->plugin_dir = \dirname($this->basename);
        $this->initModules();
    }

    /**
     * create object from each modules.
     *
     * @return Collection
     */
    protected function initModules()
    {
        return $this->modules = $this->getModules()->map(function ($module) {
            return new $module();
        });
    }

    /**
     * get list active modules.
     *
     * @return Collection
     */
    public function getModules()
    {
        return $this->modules instanceof Collection ? $this->modules : collect($this->modules);
    }

    /**
     * Load the plugin by hooking into WordPress actions and filters.
     * Method should be invoked immediately on plugin load.
     */
    public function load()
    {
        // Load all modules that require immediate loading.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Loadable;
        })->each(function ($module) {
            $module->load();
        });

        // Register initialization method.
        /** @scrutinizer ignore-call */
        add_action('init', [$this, 'init'], 10, 0);
    }

    /**
     * Perform initialization tasks.
     * Method should be run (early) in init hook.
     */
    public function init()
    {
        // Initialize all modules that require initialization.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Initializable;
        })->each(function ($module) {
            $module->init();
        });

        // Initialize updater
        $this->updater();
    }

    /**
     * update plugin from github.
     */
    public function updater()
    {
        // note the use of is_admin() to double check that this is happening in the admin
        /** @scrutinizer ignore-call */
        if (!is_admin()) {
            return;
        }

        $config = [
            'slug' => $this->basename,
            'proper_folder_name' => $this->plugin_dir,
            'api_url' => 'https://api.github.com/repos/yemenifree/wp-security',
            'raw_url' => 'https://raw.github.com/yemenifree/wp-security/master',
            'github_url' => 'https://github.com/yemenifree/wp-security',
            'zip_url' => 'https://github.com/yemenifree/wp-security/archive/{version}.zip',
            'sslverify' => false,
            'requires' => '4.7',
            'tested' => '4.7',
            'readme' => 'README.md',
        ];
        new WPGitHubUpdater($config);
    }

    /**
     * Perform activation and installation tasks.
     * Method should be run on plugin activation.
     *
     * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/
     */
    public function activate()
    {
        // Install every module that requires it.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Installable;
        })->each(function ($module) {
            $module->install();
        });

        // Activate every module that requires it.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Activable;
        })->each(function ($module) {
            $module->activate();
        });
    }

    /**
     * Perform deactivation tasks.
     * Method should be run on plugin deactivation.
     *
     * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/
     */
    public function deactivate()
    {
        // Activate every module that requires it.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Activable;
        })->each(function ($module) {
            $module->deactivate();
        });
    }

    /**
     * Perform uninstallation tasks.
     * Method should be run on plugin uninstall.
     *
     * @link https://developer.wordpress.org/plugins/the-basics/uninstall-methods/
     */
    public function uninstall()
    {
        // Uninstall every module that requires it.
        $this->getModules()->reject(function ($module) {
            return !$module instanceof Installable;
        })->each(function ($module) {
            $module->uninstall();
        });
    }
}
