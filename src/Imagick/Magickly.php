<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Imagick;

use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\MagicklyInterface;

/**
 * The Magickly class.
 *
 * @package GravityMedia\Magickly\Imagick
 */
class Magickly implements MagicklyInterface
{
    /**
     * @var string
     */
    private static $version;

    /**
     * Create Magickly object.
     *
     * @throws RuntimeException
     */
    public function __construct()
    {
        if (!class_exists('Imagick')) {
            throw new RuntimeException('Imagick not installed');
        }

        $version = $this->getVersion();
        if (version_compare('6.2.9', $version) > 0) {
            throw new RuntimeException(sprintf('ImageMagick version 6.2.9 or higher is required, %s provided', $version));
        }
    }

    /**
     * Get version.
     *
     * @return string
     */
    public function getVersion()
    {
        if (null === self::$version) {
            $imagick = new \Imagick();
            $version = $imagick->getVersion();

            list(self::$version) = sscanf($version['versionString'], 'ImageMagick %s %04d-%02d-%02d %s %s');
        }

        return self::$version;
    }

    /**
     * {@inheritdoc}
     */
    public function open($path)
    {
        try {
            $imagick = new \Imagick($path);
        } catch (\ImagickException $exception) {
            throw new RuntimeException(sprintf('Unable to open image %s', $path), 0, $exception);
        }

        return new Image($imagick);
    }
}
