# SeAT-HR - Human Resources plugin for SeAT

> [!IMPORTANT]
> With the SeAT v5 stable release, master has moved to v2.x; SeAT v4 has been moved to the [v1-archive branch](https://github.com/cryocaustik/seat-hr/tree/v1-archive) and will no longer be supported.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cryocaustik/seat-hr.svg?style=flat-square)](https://packagist.org/packages/cryocaustik/seat-hr)
[![Travis (.com)](https://img.shields.io/travis/com/cryocaustik/seat-hr)](https://img.shields.io/travis/com/cryocaustik/seat-hr)
[![Quality Score](https://img.shields.io/scrutinizer/g/cryocaustik/seat-hr.svg?style=flat-square)](https://scrutinizer-ci.com/g/cryocaustik/seat-hr)
[![Total Downloads](https://img.shields.io/packagist/dt/cryocaustik/seat-hr.svg?style=flat-square)](https://packagist.org/packages/cryocaustik/seat-hr)

Human Resources plugin for [SeAT](https://github.com/eveseat/seat) with Applications (with customized questions per corporation), Blacklist, Intel (coming soon), Kick History, Notes, and Sheet.

![example.png](./example.png)

## SeAT v5

this branch is compatible with SeAT version 5.x - use the v1-archive branch for SeAT version 4.x

## Installation

You can install the package via composer:

```bash
composer require cryocaustik/seat-hr
```

## Getting Started

[Documentation on getting started and configuration of the application are available here](./docs/getting_started.md)


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Entity Relation Diagram

[source](https://dbdocs.io/alexbda969e1ca/seat-hr?view=relationships)

![seat-hr](https://github.com/cryocaustik/seat-hr/assets/15346996/56274166-0585-47af-897e-1802c874f44a)





## Development

**composer**

register the package in `seat/composer.json` by adding the target version to the `require` section:

```json
{
    ...
    "require": {
        "psr-4": {
            ...
            "cryocaustik/seat-hr": "^2.0.0"
        }
    }
}
```

add your package path to the repositories section (create this section at the end, if it does not exist):
```json
{
    ...
    "repositories": [
        {
            "type": "path",
            "url": "/home/cryocaustik/dev/seat-hr/seat-hr"
        }
    ]
}
```

refresh package list through composer 
```sh
composer dumpautoload
```


### Security

If you discover any security related issues, please email seat-hr@alazy.dev instead of using the issue tracker.

## Credits

- [cryocaustik](https://github.com/cryocaustik)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
