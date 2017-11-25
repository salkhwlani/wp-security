<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Illuminate\Support\Collection;
use Yemenifree\WpSecurity\Interfaces\Activable;
use Yemenifree\WpSecurity\Traits\HasFilesReader;
use Yemenifree\WpSecurity\Traits\HasHtaccessEditMode;

class HtaccessSecurity implements Activable
{
    use HasHtaccessEditMode, HasFilesReader;

    protected $paths;

    /**
     * HtaccessSecurity constructor.
     */
    public function __construct()
    {
        $this->paths = [
            ABSPATH => $this->getMainHtaccess(),
            wp_upload_dir()['basedir'] => $this->getUploadsHtaccess(),
        ];
    }

    /**
     * get main htaccess content file from plugin.
     *
     * @return string
     */
    private function getMainHtaccess()
    {
        return $this->getFileContent('.htaccess');
    }

    /**
     * get upload htaccess content from plugin.
     *
     * @return string
     */
    private function getUploadsHtaccess()
    {
        return $this->getFileContent('.uploads-htaccess');
    }

    /**
     * {@inheritdoc}
     */
    public function activate()
    {
        $this->getPaths()->each(function ($content, $path) {
            $this->setHtaccessPath($path)->setHtaccessRule($content)->addHtaccessContent();
        });
    }

    /**
     * get list paths & htaccess content.
     *
     * @return Collection
     */
    public function getPaths()
    {
        return collect($this->paths);
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate()
    {
        $this->getPaths()->each(function ($content, $path) {
            $this->setHtaccessPath($path)->setHtaccessRule($content)->removeHtaccessContent();
        });
    }
}
