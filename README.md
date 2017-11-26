# Basic WordPress Security

[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-build]][link-build]
[![Quality Score][ico-code-quality]][link-code-quality]


> Basic security helper for WordPress.

## Features
- PHP Files Editation Disabled.
- Directory Listing Disabled.
- PHP Files Forbidden for `uploads` and `wp-includes`.
- Disallow file editor for (plugins & themes).
- Remove WordPress version from assets url.
- Disable REST API methods to anonymous users.
- Disable XmlRpc service.
- Disallow upload plugin/theme zip file manually via dashboard.
- Prevent deactivate security without FTP or file manager access.

## Getting Started

### via composer

1. from `wp-content/plugins` folder run `composer create-project yemenifree/wp-security`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. All done.

### Manually

1. Download [last version][link-last-version]
1. unzip & rename folder to `wp-security`
1. Upload the folder `wp-security` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. All done.

## Uninstall

1. Remove lock file `/wp-content/plugins/wp-security/.wp-security-lock` via FTP or file manager (CPanel).
2. Deactivate plugin through the "Plugins page" in WordPress.
3. Uninstall plugin.

## Why lock file

The goal of this plugin prevents use some built-in functions to a hacking website by users they have access to the dashboard, so to confirmed deactivate this plugin you need access to FTP or CPanel to remove the lock file.

## TODO
- Secure/Scan all upload files.
- ~~Disable upload plugin manually (zip plugin) form admin panel.~~

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email yemenifree@yandex.com instead of using the issue tracker.

## Credits

- [Salah Alkhwlani][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-code-quality]: https://scrutinizer-ci.com/g/yemenifree/wp-security/badges/quality-score.png?b=master
[ico-build]: https://scrutinizer-ci.com/g/yemenifree/wp-security/badges/build.png?b=master

[link-author]: https://github.com/yemenifree
[link-contributors]: ../../contributors
[link-code-quality]: https://scrutinizer-ci.com/g/yemenifree/wp-security/code-structure
[link-build]: https://scrutinizer-ci.com/g/yemenifree/wp-security/build-status/maste
[link-last-version]: https://api.github.com/repos/yemenifree/wp-security/zipball

