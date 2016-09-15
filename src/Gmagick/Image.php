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
use GuzzleHttp\Stream\Utils as StreamUtils;

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
    private $gmagick;

    /**
     * @var array
     */
    protected static $colorSpaceMapping = [
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
     * Clone image object.
     */
    public function __clone()
    {
        $this->gmagick = clone $this->gmagick;
    }

    /**
     * {@inheritdoc}
     */
    public function getColorSpace()
    {
        $this->gmagick->getimagetype(); \Gmagick::IMGTYPE_GRAYSCALE;

        switch ($this->gmagick->getimagecolorspace()) {
            case \Gmagick::COLORSPACE_RGB:
            case \Gmagick::COLORSPACE_SRGB:
                return ColorSpace::COLOR_SPACE_RGB;
            case \Gmagick::COLORSPACE_CMYK:
                return ColorSpace::COLOR_SPACE_CMYK;
            case \Gmagick::COLORSPACE_GRAY:
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
        $image->gmagick->setimagecolorspace(static::$colorSpaceMapping[$colorSpace]);

        return $image;
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

        return new ColorProfile(StreamUtils::create($data));
    }

    /**
     * {@inheritdoc}
     */
    public function withColorProfile(ColorProfile $colorProfile)
    {
        $image = clone $this;
        $image->gmagick->setimageprofile('ICM', $colorProfile->getData());

        return $image;
    }
}
