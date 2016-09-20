<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\MagicklyTest\Imagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Enum\Type;
use GravityMedia\Magickly\Imagick\Image;

/**
 * The Image test class.
 *
 * @package GravityMedia\MagicklyTest\Imagick
 *
 * @covers  \GravityMedia\Magickly\Imagick\Image
 */
class ImageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function provideImages()
    {
        return [
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.jpg', Type::TYPE_TRUECOLOR, ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.png', Type::TYPE_TRUECOLOR, ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.tif', Type::TYPE_TRUECOLOR, ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_sRGB_IEC61966-2-1.jpg', Type::TYPE_TRUECOLOR, ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_RGB_sRGB_IEC61966-2-1.tif', Type::TYPE_TRUECOLOR, ColorSpace::COLOR_SPACE_RGB],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_no_profile.jpg', Type::TYPE_COLORSEPARATION, ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_no_profile.tif', Type::TYPE_COLORSEPARATION, ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_USWebUncoated.jpg', Type::TYPE_COLORSEPARATION, ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_CMYK_USWebUncoated.tif', Type::TYPE_COLORSEPARATION, ColorSpace::COLOR_SPACE_CMYK],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_Dot_Gain_15.jpg', Type::TYPE_PALETTE, ColorSpace::COLOR_SPACE_GRAYSCALE],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_Dot_Gain_15.tif', Type::TYPE_GRAYSCALE, ColorSpace::COLOR_SPACE_GRAYSCALE],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.jpg', Type::TYPE_PALETTE, ColorSpace::COLOR_SPACE_GRAYSCALE],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.png', Type::TYPE_GRAYSCALE, ColorSpace::COLOR_SPACE_GRAYSCALE],
            [__DIR__ . '/../../resources/PHP-logo_Grayscale_no_profile.tif', Type::TYPE_GRAYSCALE, ColorSpace::COLOR_SPACE_GRAYSCALE],
        ];
    }

    /**
     * @dataProvider provideImages
     *
     * @param string $path
     * @param int    $type
     * @param int    $colorSpace
     */
    public function testGetTypeAndColorSpace($path, $type, $colorSpace)
    {
        $imagick = new \Imagick($path);
        $image = new Image($imagick);

        $this->assertSame($type, $image->getType());
        $this->assertSame($colorSpace, $image->getColorSpace());
    }

    public function testWithColorSpace()
    {
        $imagick = new \Imagick(__DIR__ . '/../../resources/PHP-logo_RGB_no_profile.jpg');
        $image = new Image($imagick);

        $this->assertSame(
            ColorSpace::COLOR_SPACE_CMYK,
            $image->withColorSpace(ColorSpace::COLOR_SPACE_CMYK)->getColorSpace()
        );
        $this->assertSame(ColorSpace::COLOR_SPACE_RGB, $image->getColorSpace());
    }
}
