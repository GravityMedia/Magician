<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\MagicklyTest\Imagick;

use GravityMedia\Magickly\Image\ImageInterface;
use GravityMedia\Magickly\Imagick\Magickly;

/**
 * The Magickly test class.
 *
 * @package GravityMedia\MagicklyTest\Imagick
 *
 * @covers GravityMedia\Magickly\Imagick\Magickly
 * @uses   GravityMedia\Magickly\Imagick\Image
 */
class MagicklyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetVersion()
    {
        $magickly = new Magickly();
        $version = $magickly->getVersion();

        $this->assertRegExp('/^\d+\.\d+\.\d+/', $version);
    }

    public function testOpenImage()
    {
        $magickly = new Magickly();
        $image = $magickly->open(__DIR__ . '/../../resources/php-logo_no-profile.jpg');

        $this->assertInstanceOf(ImageInterface::class, $image);
    }
}
