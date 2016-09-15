<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image\Palette;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Image\ColorProfile;

/**
 * The RGB palette.
 *
 * @package GravityMedia\Magickly\Image\Palette
 */
class RGB implements PaletteInterface
{
    /**
     * @var null|ColorProfile
     */
    private $colorProfile;

    /**
     * Clone palette object.
     */
    public function __clone()
    {
        if (null === $this->colorProfile) {
            return;
        }

        $this->colorProfile = clone $this->colorProfile;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        return ColorSpace::COLOR_SPACE_RGB;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorProfile()
    {
        if (null === $this->colorProfile) {
            $this->colorProfile = ColorProfile::fromFilename(__DIR__ . '/../../../resources/sRGB_IEC61966-2-1.icc');
        }

        return $this->colorProfile;
    }

    /**
     * {@inheritdoc}
     */
    public function withColorProfile(ColorProfile $colorProfile)
    {
        $palette = clone $this;
        $palette->colorProfile = $colorProfile;

        return $palette;
    }
}
