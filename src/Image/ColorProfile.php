<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image;

use GravityMedia\Magickly\Exception\RuntimeException;

/**
 * Color profile class.
 *
 * @package GravityMedia\Magickly\Image
 */
class ColorProfile
{
    /**
     * @var string
     */
    protected $data;

    /**
     * Create color profile object.
     *
     * @param string $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get data.
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Create color profile object from path.
     *
     * @param string $path
     *
     * @return $this
     */
    public static function fromPath($path)
    {
        if (!file_exists($path) || !is_file($path) || !is_readable($path)) {
            throw new RuntimeException(sprintf('Path %s is an invalid profile file or is not readable', $path));
        }

        return new static(file_get_contents($path));
    }
}
