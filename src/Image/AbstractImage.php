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
    public function setPalette(PaletteInterface $palette)
    {
        if ($this->getColorSpace() === $palette->getColorSpace()) {
            return $this;
        }

        if (null === $this->getColorProfile()) {
            $this->setColorProfile($this->getPalette()->getColorProfile());
        }

        $this->setColorProfile($palette->getColorProfile());
        $this->setColorSpace($palette->getColorSpace());

        return $this;
    }
}
