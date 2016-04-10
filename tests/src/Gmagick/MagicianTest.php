<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\MagicianTest\Gmagick;

use GravityMedia\Magician\ImageInterface;
use GravityMedia\Magician\Gmagick\Magician;

/**
 * The Magician test class.
 *
 * @package GravityMedia\MagicianTest\Gmagick
 *
 * @covers GravityMedia\Magician\Gmagick\Magician
 * @uses   GravityMedia\Magician\Gmagick\Image
 */
class MagicianTest extends \PHPUnit_Framework_TestCase
{
    public function testGetVersion()
    {
        $magician = new Magician();
        $version = $magician->getVersion();

        $this->assertRegExp('/^\d+\.\d+\.\d+/', $version);
    }

    public function testOpenImage()
    {
        $magician = new Magician();
        $image = $magician->open(__DIR__ . '/../../resources/php-logo_no-profile.jpg');

        $this->assertInstanceOf(ImageInterface::class, $image);
    }
}
