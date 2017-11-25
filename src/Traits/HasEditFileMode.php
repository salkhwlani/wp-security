<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Traits;

trait HasEditFileMode
{
    /** @var string path dir file */
    protected $path;
    /** @var string content file */
    protected $content_patch;
    /** @var string file name */
    protected $filename;

    /** @var string|bool */
    protected $startPointForPatch = false;

    /**
     *  remove content from file.
     */
    protected function removePatchContentFromFile()
    {
        if (!\file_exists($this->getFilePath())) {
            return;
        }
        $content = \file_get_contents($this->getFilePath());
        if (\strpos($content, $this->getContentPatch()) === false) {
            return;
        }
        \file_put_contents($this->getFilePath(), \str_replace($this->getContentPatch(), '', $content));
    }

    /**
     * get full path of file.
     *
     * @return string
     */
    public function getFilePath()
    {
        return \rtrim($this->getPath(), '/') . '/' . $this->getFilename();
    }

    /**
     * get path of file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * set path of file.
     *
     * @param string $path
     *
     * @return HasEditFileMode
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * get filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * set filename.
     *
     * @param string $filename
     *
     * @return HasEditFileMode
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * get content patch.
     *
     * @return string
     */
    public function getContentPatch()
    {
        return $this->content_patch;
    }

    /**
     * set content want to patch.
     *
     * @param string $content_patch
     *
     * @return HasEditFileMode
     */
    public function setContentPatch($content_patch)
    {
        $this->content_patch = $content_patch;

        return $this;
    }

    /**
     *  add content of htaccess rules from file.
     */
    protected function addPatchContentToFile()
    {
        if (!\file_exists($this->getFilePath())) {
            \touch($this->getFilePath());
        }

        $content = \file_get_contents($this->getFilePath());

        if (\strpos($content, $this->getContentPatch()) !== false) {
            return;
        }

        if ($this->getStartPointForPatch()) {
            $content = \str_replace($this->getStartPointForPatch(), $this->getStartPointForPatch() . $this->getContentPatch(), $content);
        } else {
            $content = $this->getContentPatch() . $content;
        }

        \file_put_contents($this->getFilePath(), $content);
    }

    /**
     * get start point for patch content.
     *
     * @return string|bool
     */
    public function getStartPointForPatch()
    {
        return $this->startPointForPatch;
    }

    /**
     * set start point for patch content.
     *
     * @param string|bool $startPointForPatch
     *
     * @return HasEditFileMode
     */
    public function setStartPointForPatch($startPointForPatch)
    {
        $this->startPointForPatch = $startPointForPatch;

        return $this;
    }
}
