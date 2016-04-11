<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly;

use GravityMedia\Magickly\Exception\RuntimeException;

/**
 * The Magickly interface.
 *
 * @package GravityMedia\Magickly
 */
interface MagicklyInterface
{
    /**
     * Opens an existing image from $path.
     *
     * @param string $path
     *
     * @throws RuntimeException
     *
     * @return ImageInterface
     */
    public function open($path);
}
