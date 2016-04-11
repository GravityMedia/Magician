<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Imagick;

use GravityMedia\Magickly\ImageInterface;

/**
 * The Image class.
 *
 * @package GravityMedia\Magickly\Imagick
 */
class Image implements ImageInterface
{
    /**
     * @var \Imagick
     */
    protected $imagick;

    /**
     * Create image object.
     *
     * @param \Imagick $imagick
     */
    public function __construct(\Imagick $imagick)
    {
        $this->imagick = $imagick;
    }

    /**
     * Get mime type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->imagick->getImageMimeType();
    }
}
