<?php

/*
 * Copyright (c) 2017 Salah Alkhwlani <yemenifree@yandex.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Yemenifree\WpSecurity\Modules;

use Yemenifree\WpSecurity\Interfaces\Initializable;

class ResetSecurity implements Initializable
{
    /**
     * Initialize module (perform any tasks that should be done init hook).
     */
    public function init()
    {
        // Disable REST API methods to anonymous users
        add_filter('rest_authentication_errors', [$this, 'requireAuthForRestAccess']);
    }

    /**
     * Return an authentication error if a user who is not logged in tries to query the REST API.
     *
     * @param mixed $access
     *
     * @return WP_Error
     */
    public function requireAuthForRestAccess($access)
    {
        if (!is_user_logged_in()) {
            return new \WP_Error(
                'rest_cannot_access',
                __('Only authenticated users can access the REST API.', 'wp-security'),
                ['status' => rest_authorization_required_code()]
            );
        }

        return $access;
    }
}
