<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\MagicklyTest\Gmagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Gmagick\Image;

/**
 * The Image test class.
 *
 * @package GravityMedia\MagicklyTest\Gmagick
 *
 * @covers  \GravityMedia\Magickly\Gmagick\Image
 */
class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function provideImages()
    {
        return [
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.jpg', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.png', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.tif', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_sRGB_IEC61966-2-1.jpg', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_sRGB_IEC61966-2-1.tif', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_no_profile.jpg', ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_no_profile.tif', ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_USWebUncoated.jpg', ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_USWebUncoated.tif', ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_Dot_Gain_15.jpg', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_Dot_Gain_15.tif', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.jpg', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.png', ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.tif', ColorSpace::COLOR_SPACE_RGB],
        ];
    }

    /**
     * @dataProvider provideImages
     *
     * @param string $path
     * @param int    $colorSpace
     */
    public function testGetColorSpace($path, $colorSpace)
    {
        $gmagick = new \Gmagick($path);
        $image = new Image($gmagick);

        $this->assertSame($colorSpace, $image->getColorSpace());
    }

    public function testWithColorSpace()
    {
        $gmagick = new \Gmagick(__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.jpg');
        $image = new Image($gmagick);

        $this->assertSame(
            ColorSpace::COLOR_SPACE_CMYK,
            $image->withColorSpace(ColorSpace::COLOR_SPACE_CMYK)->getColorSpace()
        );
        $this->assertSame(ColorSpace::COLOR_SPACE_RGB, $image->getColorSpace());
    }
}
