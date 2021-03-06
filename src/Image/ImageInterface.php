<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image;

use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\Image\Palette\PaletteInterface;
use GuzzleHttp\Stream\StreamInterface;

/**
 * The image interface.
 *
 * @package GravityMedia\Magickly\Image
 */
interface ImageInterface
{
    /**
     * Get image data as stream.
     *
     * @return StreamInterface
     */
    public function getStream();

    /**
     * Get format.
     *
     * @throws RuntimeException
     *
     * @return int
     */
    public function getFormat();

    /**
     * Return image with format.
     *
     * @param int $format
     *
     * @throws RuntimeException
     *
     * @return ImageInterface
     */
    public function withFormat($format);

    /**
     * Get type.
     *
     * @throws RuntimeException
     *
     * @return int
     */
    public function getType();

    /**
     * Return image with type.
     *
     * @param int $type
     *
     * @throws RuntimeException
     *
     * @return ImageInterface
     */
    public function withType($type);

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
