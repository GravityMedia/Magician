<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image;

use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\Image\Palette\PaletteInterface;

/**
 * The image interface.
 *
 * @package GravityMedia\Magickly\Image
 */
interface ImageInterface
{
    /**
     * Get color space.
     *
     * @throws RuntimeException
     *
     * @return int
     */
    public function getColorSpace();

    /**
     * Return image with color space.
     *
     * @param int $colorSpace
     *
     * @throws RuntimeException
     *
     * @return ImageInterface
     */
    public function withColorSpace($colorSpace);

    /**
     * Get color profile.
     *
     * @return null|ColorProfile
     */
    public function getColorProfile();

    /**
     * Return image with color profile.
     *
     * @param ColorProfile $colorProfile
     *
     * @return ImageInterface
     */
    public function withColorProfile(ColorProfile $colorProfile);

    /**
     * Get palette.
     *
     * @return PaletteInterface
     */
    public function getPalette();

    /**
     * Return image with palette.
     *
     * @param PaletteInterface $palette
     *
     * @return ImageInterface
     */
    public function withPalette(PaletteInterface $palette);
}
