<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Traits;

trait HasFilesReader
{
    /**
     * get content file from Files template.
     *
     * @param $filename
     *
     * @return string
     */
    protected function getFileContent($filename)
    {
        $filePath = \rtrim(WC_SECURITY_PATH, '/') . '/src/Files/' . $filename;

        if (!\file_exists($filePath)) {
            return '';
        }

        return \file_get_contents($filePath);
    }
}
