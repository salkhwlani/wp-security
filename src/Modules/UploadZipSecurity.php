<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Loadable;

class UploadZipSecurity implements Loadable
{
    /**
     * Load module (perform any tasks that should be done immediately on plugin load).
     */
    public function load()
    {
        add_action('check_admin_referer', [$this, 'disabled_upload_zip_files'], 99, 2);
    }

    /**
     * Disabled upload zip files ( plugins & themes ) via admin account.
     *
     * @param $action
     * @param $result
     */
    public function disabled_upload_zip_files($action, $result)
    {
        if (!\in_array($action, ['theme-upload', 'plugin-upload'])) {
            return;
        }

        wp_die($action === 'theme-upload' ? __('Sorry, you are not allowed to install plugins on this site.') : __('Sorry, you are not allowed to install themes on this site.'));
    }
}
