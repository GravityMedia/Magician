<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Enum;

/**
 * The color space enum.
 *
 * @package GravityMedia\Magickly\Enum
 */
class ColorSpace
{
    /**
     * RGB color space.
     */
    const COLOR_SPACE_RGB = 1;

    /**
     * CMYK color space.
     */
    const COLOR_SPACE_CMYK = 2;

    /**
     * Grayscale color space.
     */
    const COLOR_SPACE_GRAYSCALE = 3;

    /**
     * Valid values
     *
     * @var int[]
     */
    protected static $values = [
        self::COLOR_SPACE_RGB,
        self::COLOR_SPACE_CMYK,
        self::COLOR_SPACE_GRAYSCALE
    ];

    /**
     * Return valid values
     *
     * @return int[]
     */
    public static function values()
    {
        return static::$values;
    }
}
