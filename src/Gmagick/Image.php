<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Gmagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\Image\AbstractImage;
use GravityMedia\Magickly\Image\ColorProfile;

/**
 * The image class.
 *
 * @package GravityMedia\Magickly\Gmagick
 */
class Image extends AbstractImage
{
    /**
     * @var \Gmagick
     */
    protected $gmagick;

    /**
     * @var array
     */
    protected static $colorspaceMapping = [
        ColorSpace::COLOR_SPACE_RGB => \Gmagick::COLORSPACE_RGB,
        ColorSpace::COLOR_SPACE_CMYK => \Gmagick::COLORSPACE_CMYK,
        ColorSpace::COLOR_SPACE_GRAYSCALE => \Gmagick::COLORSPACE_GRAY
    ];

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
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        switch ($this->gmagick->getimagecolorspace()) {
            case \Gmagick::COLORSPACE_RGB:
            case \Gmagick::COLORSPACE_SRGB:
                return ColorSpace::COLOR_SPACE_RGB;
            case \Gmagick::COLORSPACE_CMYK:
                return ColorSpace::COLOR_SPACE_CMYK;
            case \Gmagick::COLORSPACE_GRAY:
                return ColorSpace::COLOR_SPACE_GRAYSCALE;
            default:
                throw new RuntimeException('Only RGB, grayscale and CMYK colorspace are currently supported');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setColorSpace($colorspace)
    {
        if (!isset(static::$colorspaceMapping[$colorspace])) {
            throw new RuntimeException('Only RGB, grayscale and CMYK colorspace are currently supported');
        }

        $this->gmagick->setimagecolorspace(static::$colorspaceMapping[$colorspace]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorProfile()
    {
        try {
            $data = $this->gmagick->getimageprofile('ICM');
        } catch (\GmagickException $exception) {
            return null;
        }

        return new ColorProfile($data);
    }

    /**
     * {@inheritdoc}
     */
    public function setColorProfile(ColorProfile $colorProfile)
    {
        $this->gmagick->setimageprofile('ICM', $colorProfile->getData());

        return $this;
    }
}
