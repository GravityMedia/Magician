<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Image\Palette\PaletteInterface;

/**
 * Abstract image class.
 *
 * @package GravityMedia\Magickly\Image
 */
abstract class AbstractImage implements ImageInterface
{
    /**
     * @var array
     */
    protected static $supportedFormats = [
        'GIF',
        'JPEG',
        'PNG',
        'TIFF',
    ];

    /**
     * {@inheritdoc}
     */
    public function getPalette()
    {
        switch ($this->getColorSpace()) {
            default:
                $palette = new Palette\RGB();
                break;
            case ColorSpace::COLOR_SPACE_CMYK:
                $palette = new Palette\CMYK();
                break;
            case ColorSpace::COLOR_SPACE_GRAYSCALE:
                $palette = new Palette\Grayscale();
                break;
        }

        $colorProfile = $this->getColorProfile();
        if (null !== $colorProfile) {
            $palette->setColorProfile($colorProfile);
        }

        return $palette;
    }

    /**
     * {@inheritdoc}
     */
    public function withPalette(PaletteInterface $palette)
    {
        $image = clone $this;

        if ($image->getColorSpace() === $palette->getColorSpace()) {
            return $image;
        }

        if (null === $image->getColorProfile()) {
            $image = $image->withColorProfile($image->getPalette()->getColorProfile());
        }

        $image = $image
            ->withColorProfile($palette->getColorProfile())
            ->withColorSpace($palette->getColorSpace());

        return $image;
    }
}
