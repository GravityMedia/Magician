<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\MagicklyTest\Gmagick;

use GravityMedia\Magickly\ImageInterface;
use GravityMedia\Magickly\Gmagick\Magickly;

/**
 * The Magickly test class.
 *
 * @package GravityMedia\MagicklyTest\Gmagick
 *
 * @covers GravityMedia\Magickly\Gmagick\Magickly
 * @uses   GravityMedia\Magickly\Gmagick\Image
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
