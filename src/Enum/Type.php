<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Enum;

/**
 * The type enum.
 *
 * @package GravityMedia\Magickly\Enum
 */
class Type
{
    /**
     * Bilevel type.
     */
    const TYPE_BILEVEL = 1;

    /**
     * Grayscale type.
     */
    const TYPE_GRAYSCALE = 2;

    /**
     * Palette type.
     */
    const TYPE_PALETTE = 3;

    /**
     * Truecolor type.
     */
    const TYPE_TRUECOLOR = 4;

    /**
     * Colorseparation type.
     */
    const TYPE_COLORSEPARATION = 5;

    /**
     * Valid values
     *
     * @var int[]
     */
    protected static $values = [
        self::TYPE_BILEVEL,
        self::TYPE_GRAYSCALE,
        self::TYPE_PALETTE,
        self::TYPE_TRUECOLOR,
        self::TYPE_COLORSEPARATION,
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
