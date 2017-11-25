<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Traits;

trait HasHtaccessEditMode
{
    use HasEditFileMode;

    /**
     * @param $htaccess_path
     *
     * @return HasEditFileMode
     */
    public function setHtaccessPath($htaccess_path)
    {
        return $this->setPath($htaccess_path)->setFilename('.htaccess');
    }

    /**
     * @param $htaccessRule
     *
     * @return HasEditFileMode
     */
    public function setHtaccessRule($htaccessRule)
    {
        return $this->setContentPatch($htaccessRule);
    }

    /**
     *  remove content of htaccess rules from file.
     */
    protected function removeHtaccessContent()
    {
        $this->removePatchContentFromFile();
    }

    /**
     *  add content of htaccess rules from file.
     */
    protected function addHtaccessContent()
    {
        $this->addPatchContentToFile();
    }
}
