# Magickly

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gravitymedia/magickly.svg)](https://packagist.org/packages/gravitymedia/magickly)
[![Software License](https://img.shields.io/packagist/l/gravitymedia/magickly.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/GravityMedia/Magickly.svg)](https://travis-ci.org/GravityMedia/Magickly)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/GravityMedia/Magickly.svg)](https://scrutinizer-ci.com/g/GravityMedia/Magickly/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/GravityMedia/Magickly.svg)](https://scrutinizer-ci.com/g/GravityMedia/Magickly)
[![Total Downloads](https://img.shields.io/packagist/dt/gravitymedia/magickly.svg)](https://packagist.org/packages/gravitymedia/magickly)
[![Dependency Status](https://img.shields.io/versioneye/d/php/gravitymedia:magickly.svg)](https://www.versioneye.com/user/projects/570bea0dfcd19a0039f16acd)

Magickly is an image processing library for PHP.

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
$ php composer.phar require gravitymedia/magickly
```

## Usage

This simple example is showing how to convert an image to RGB color space.

```php
// Initialize autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Import classes
//use GravityMedia\Magickly\Gmagick\Magickly;
use GravityMedia\Magickly\Imagick\Magickly;
use GravityMedia\Magickly\Image\Palette;

// Create Magickly object
$magickly = new Magickly();

// Open image
$image = $magickly->open('/path/to/image/file.png');

// Create RGB palette
$palette = new Palette\RGB();

// Apply RGB palette to image
$image = $image->withPalette($palette);

// Get image data as stream
$stream = $image->getStream();

// Save image as a copy
file_put_contents('/path/to/image/copy.png', $stream->getContents());
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
