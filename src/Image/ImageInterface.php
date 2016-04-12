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
     * Set color space.
     *
     * @param int $colorspace
     *
     * @throws RuntimeException
     *
     * @return $this
     */
    public function setColorSpace($colorspace);

    /**
     * Get color profile.
     *
     * @return null|ColorProfile
     */
    public function getColorProfile();

    /**
     * Set color profile.
     *
     * @param ColorProfile $colorProfile
     *
     * @return $this
     */
    public function setColorProfile(ColorProfile $colorProfile);

    /**
     * Get palette.
     *
     * @return PaletteInterface
     */
    public function getPalette();

    /**
     * Set palette.
     *
     * @param PaletteInterface $palette
     *
     * @return $this
     */
    public function setPalette(PaletteInterface $palette);
}
