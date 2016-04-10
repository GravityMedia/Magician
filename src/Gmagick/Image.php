<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magician\Gmagick;

use GravityMedia\Magician\ImageInterface;

/**
 * The Image class.
 *
 * @package GravityMedia\Magician\Gmagick
 */
class Image implements ImageInterface
{
    /**
     * @var \Gmagick
     */
    protected $gmagick;

    /**
     * Create image object.
     *
     * @param \Gmagick $gmagick
     */
    public function __construct(\Gmagick $gmagick)
    {
        $this->gmagick = $gmagick;
    }

    /**
     * Get mime type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->gmagick->getImageMimeType();
    }
}
