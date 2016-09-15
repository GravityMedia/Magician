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
use GuzzleHttp\Stream\Utils as StreamUtils;

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
    private $imagick;

    /**
     * @var array
     */
    protected static $colorSpaceMapping = [
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
     * Clone image object.
     */
    public function __clone()
    {
        $this->imagick = clone $this->imagick;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        $this->imagick->getImageType(); \Imagick::IMGTYPE_GRAYSCALE;

        switch ($this->imagick->getImageColorspace()) {
            case \Imagick::COLORSPACE_RGB:
            case \Imagick::COLORSPACE_SRGB:
                return ColorSpace::COLOR_SPACE_RGB;
            case \Imagick::COLORSPACE_CMYK:
                return ColorSpace::COLOR_SPACE_CMYK;
            case \Imagick::COLORSPACE_GRAY:
                return ColorSpace::COLOR_SPACE_GRAYSCALE;
            default:
                throw new RuntimeException('Only RGB, grayscale and CMYK color space are currently supported');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function withColorSpace($colorSpace)
    {
        if (!isset(static::$colorSpaceMapping[$colorSpace])) {
            throw new RuntimeException('Only RGB, grayscale and CMYK color space are currently supported');
        }

        $image = clone $this;
        $image->imagick->setImageColorspace(static::$colorSpaceMapping[$colorSpace]);

        return $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorProfile()
    {
        if (!in_array('icc', $this->imagick->getImageProfiles('*', false))) {
            return null;
        }

        $data = $this->imagick->getImageProfile('icc');

        return new ColorProfile(StreamUtils::create($data));
    }

    /**
     * {@inheritdoc}
     */
    public function withColorProfile(ColorProfile $colorProfile)
    {
        $image = clone $this;
        $image->imagick->setImageProfile('icc', $colorProfile->getData());

        return $image;
    }
}
