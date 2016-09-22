<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Imagick;

use GravityMedia\Magickly\Enum\ColorSpace;
use GravityMedia\Magickly\Enum\Type;
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
    protected static $typeMapping = [
        Type::TYPE_BILEVEL => \Imagick::IMGTYPE_BILEVEL,
        Type::TYPE_GRAYSCALE => \Imagick::IMGTYPE_GRAYSCALE,
        Type::TYPE_PALETTE => \Imagick::IMGTYPE_PALETTE,
        Type::TYPE_TRUECOLOR => \Imagick::IMGTYPE_TRUECOLOR,
        Type::TYPE_COLORSEPARATION => \Imagick::IMGTYPE_COLORSEPARATION,
    ];

    /**
     * @var array
     */
    protected static $colorSpaceMapping = [
        ColorSpace::COLOR_SPACE_RGB => \Imagick::COLORSPACE_RGB,
        ColorSpace::COLOR_SPACE_CMYK => \Imagick::COLORSPACE_CMYK,
        ColorSpace::COLOR_SPACE_GRAYSCALE => \Imagick::COLORSPACE_GRAY,
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
    public function getStream()
    {
        return StreamUtils::create($this->imagick->getImagesBlob());
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat()
    {
        $format = $this->imagick->getImageFormat();
        if (!in_array($format, static::$supportedFormats)) {
            throw new RuntimeException('Unsupported image format');
        }

        return $format;
    }

    /**
     * {@inheritdoc}
     */
    public function withFormat($format)
    {
        if (!in_array($format, static::$supportedFormats)) {
            throw new RuntimeException('Unsupported image format');
        }

        $image = clone $this;
        $image->imagick->setImageFormat($format);

        return $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        switch ($this->imagick->getImageType()) {
            case \Imagick::IMGTYPE_BILEVEL:
                return Type::TYPE_BILEVEL;
            case \Imagick::IMGTYPE_GRAYSCALE:
            case \Imagick::IMGTYPE_GRAYSCALEMATTE:
                return Type::TYPE_GRAYSCALE;
            case \Imagick::IMGTYPE_PALETTE:
            case \Imagick::IMGTYPE_PALETTEMATTE:
                if ('JPEG' === $this->getFormat() && ColorSpace::COLOR_SPACE_GRAYSCALE === $this->getColorSpace()) {
                    return Type::TYPE_GRAYSCALE;
                }
                return Type::TYPE_PALETTE;
            case \Imagick::IMGTYPE_TRUECOLOR:
            case \Imagick::IMGTYPE_TRUECOLORMATTE:
                return Type::TYPE_TRUECOLOR;
            case \Imagick::IMGTYPE_COLORSEPARATION:
            case \Imagick::IMGTYPE_COLORSEPARATIONMATTE:
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
        $image->imagick->setImageType(static::$typeMapping[$type]);

        return $image;
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
