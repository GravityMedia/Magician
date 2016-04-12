<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Imagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\Image\AbstractImage;
use GravityMedia\Magickly\Image\ColorProfile;

/**
 * The image class.
 *
 * @package GravityMedia\Magickly\Imagick
 */
class Image extends AbstractImage
{
    /**
     * @var \Imagick
     */
    protected $imagick;

    /**
     * @var array
     */
    protected static $colorspaceMapping = [
        ColorSpace::COLOR_SPACE_RGB => \Imagick::COLORSPACE_RGB,
        ColorSpace::COLOR_SPACE_CMYK => \Imagick::COLORSPACE_CMYK,
        ColorSpace::COLOR_SPACE_GRAYSCALE => \Imagick::COLORSPACE_GRAY
    ];

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
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        switch ($this->imagick->getImageColorspace()) {
            case \Imagick::COLORSPACE_RGB:
            case \Imagick::COLORSPACE_SRGB:
                return ColorSpace::COLOR_SPACE_RGB;
            case \Imagick::COLORSPACE_CMYK:
                return ColorSpace::COLOR_SPACE_CMYK;
            case \Imagick::COLORSPACE_GRAY:
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

        $this->imagick->setImageColorspace(static::$colorspaceMapping[$colorspace]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorProfile()
    {
        if (!in_array('icc', $this->imagick->getImageProfiles('*', false))) {
            return null;
        }

        return new ColorProfile($this->imagick->getImageProfile('icc'));
    }

    /**
     * {@inheritdoc}
     */
    public function setColorProfile(ColorProfile $colorProfile)
    {
        $this->imagick->setImageProfile('icc', $colorProfile->getData());

        return $this;
    }
}
