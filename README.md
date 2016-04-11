# Magician

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gravitymedia/magician.svg)](https://packagist.org/packages/gravitymedia/magician)
[![Software License](https://img.shields.io/packagist/l/gravitymedia/magician.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/GravityMedia/Magician.svg)](https://travis-ci.org/GravityMedia/Magician)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GravityMedia/Magician.svg)](https://scrutinizer-ci.com/g/GravityMedia/Magician/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GravityMedia/Magician.svg)](https://scrutinizer-ci.com/g/GravityMedia/Magician)
[![Total Downloads](https://img.shields.io/packagist/dt/gravitymedia/magician.svg)](https://packagist.org/packages/gravitymedia/magician)
[![Dependency Status](https://img.shields.io/versioneye/d/php/gravitymedia:magician.svg)](https://www.versioneye.com/user/projects/570b4dd7fcd19a00518552e5)

Magician is an image processing library for PHP.

## Requirements

This library has the following requirements:

- PHP 5.6+

## Installation

Install Composer in your project:

```bash
$ curl -s https://getcomposer.org/installer | php
```

Add the package to your `composer.json` and install it via Composer:

```bash
$ php composer.phar require gravitymedia/magician
```

## Usage

This is a simple example using the Imagick implementation. 

```php
// Initialize autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Import classes
use GravityMedia\Magician\Imagick\Magician;

// Create Magician object
$magician = new Magician();

// Print version string
print $magician->getVersion();
```

This is a simple example using the Gmagick implementation. 

```php
// Initialize autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Import classes
use GravityMedia\Magician\Gmagick\Magician;

// Create Magician object
$magician = new Magician();

// Print version string
print $magician->getVersion();
```

## Testing

Clone this repository, install Composer and all dependencies:

``` bash
$ php composer.phar install
```

Run the test suite:

``` bash
$ php composer.phar test
```

## Generating documentation

Clone this repository, install Composer and all dependencies:

``` bash
$ php composer.phar install
```

Generate the documentation to the `build/docs` directory:

``` bash
$ php composer.phar doc
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daniel Schröder](https://github.com/pCoLaSD)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
