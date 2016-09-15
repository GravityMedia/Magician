<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image\Palette;

use GravityMedia\Magickly\Image\ColorProfile;

/**
 * The palette interface.
 *
 * @package GravityMedia\Magickly\Image\Palette
 */
interface PaletteInterface
{
    /**
     * Get color space.
     *
     * @return int
     */
    public function getColorSpace();

    /**
     * Get color profile.
     *
     * @return null|ColorProfile
     */
    public function getColorProfile();

    /**
     * Return palette with color profile.
     *
     * @param ColorProfile $colorProfile
     *
     * @return PaletteInterface
     */
    public function withColorProfile(ColorProfile $colorProfile);
}
