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
 * The CMYK palette.
 *
 * @package GravityMedia\Magickly\Image\Palette
 */
class CMYK implements PaletteInterface
{
    /**
     * @var null|ColorProfile
     */
    protected $colorProfile;

    /**
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        return ColorSpace::COLOR_SPACE_CMYK;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorProfile()
    {
        if (null === $this->colorProfile) {
            $this->colorProfile = ColorProfile::fromPath(__DIR__ . '/../../../resources/USWebUncoated.icc');
        }

        return $this->colorProfile;
    }

    /**
     * {@inheritdoc}
     */
    public function setColorProfile(ColorProfile $iccProfile)
    {
        $this->colorProfile = $iccProfile;
        return $this;
    }
}
