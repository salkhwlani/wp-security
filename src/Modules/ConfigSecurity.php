<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Activable;
use Yemenifree\WpSecurity\Traits\HasEditFileMode;

class ConfigSecurity implements Activable
{
    use HasEditFileMode;

    protected $content = '
// ADD vai wp-security plugin
// Disallow editing of PHP files - plugins & theme files - from dashboard.
define(\'DISALLOW_FILE_EDIT\', true);
//define(\'DISALLOW_FILE_MODS\', true);
define( \'DISALLOW_UNFILTERED_HTML\', true );
// ADD vai wp-security plugin
';

    /**
     * ConfigSecurity constructor.
     */
    public function __construct()
    {
        $this->setPath(ABSPATH)->setFilename('wp-config.php')->setStartPointForPatch('<?php')->setContentPatch($this->content);
    }

    /**
     * {@inheritdoc}
     */
    public function activate()
    {
        $this->addPatchContentToFile();
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate()
    {
        $this->removePatchContentFromFile();
    }
}
