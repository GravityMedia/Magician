<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Gmagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Enum\Type;
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
    protected static $typeMapping = [
        Type::TYPE_BILEVEL => \Gmagick::IMGTYPE_BILEVEL,
        Type::TYPE_GRAYSCALE => \Gmagick::IMGTYPE_GRAYSCALE,
        Type::TYPE_PALETTE => \Gmagick::IMGTYPE_PALETTE,
        Type::TYPE_TRUECOLOR => \Gmagick::IMGTYPE_TRUECOLOR,
        Type::TYPE_COLORSEPARATION => \Gmagick::IMGTYPE_COLORSEPARATION,
    ];

    /**
     * @var array
     */
    protected static $colorSpaceMapping = [
        ColorSpace::COLOR_SPACE_RGB => \Gmagick::COLORSPACE_RGB,
        ColorSpace::COLOR_SPACE_CMYK => \Gmagick::COLORSPACE_CMYK,
        ColorSpace::COLOR_SPACE_GRAYSCALE => \Gmagick::COLORSPACE_GRAY,
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
    public function getType()
    {
        switch ($this->gmagick->getimagetype()) {
            case \Gmagick::IMGTYPE_BILEVEL:
                return Type::TYPE_BILEVEL;
            case \Gmagick::IMGTYPE_GRAYSCALE:
            case \Gmagick::IMGTYPE_GRAYSCALEMATTE:
                return Type::TYPE_GRAYSCALE;
            case \Gmagick::IMGTYPE_PALETTE:
            case \Gmagick::IMGTYPE_PALETTEMATTE:
                return Type::TYPE_PALETTE;
            case \Gmagick::IMGTYPE_TRUECOLOR:
            case \Gmagick::IMGTYPE_TRUECOLORMATTE:
                return Type::TYPE_TRUECOLOR;
            case \Gmagick::IMGTYPE_COLORSEPARATION:
            case \Gmagick::IMGTYPE_COLORSEPARATIONMATTE:
                return Type::TYPE_COLORSEPARATION;
            default:
                throw new RuntimeException('Unsupported image type');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function withType($type)
    {
        if (!isset(static::$typeMapping[$type])) {
            throw new RuntimeException('Unsupported image type');
        }

        $image = clone $this;
        $image->gmagick->setimagetype(static::$typeMapping[$type]);

        return $image;
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
