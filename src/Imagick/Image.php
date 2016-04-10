<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magician\Imagick;

use GravityMedia\Magician\ImageInterface;

/**
 * The Image class.
 *
 * @package GravityMedia\Magician\Imagick
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
