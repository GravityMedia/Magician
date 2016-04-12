<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Gmagick;

use GravityMedia\Magickly\Exception\RuntimeException;
use GravityMedia\Magickly\MagicklyInterface;

/**
 * The Magickly class.
 *
 * @package GravityMedia\Magickly\Gmagick
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
        if (!class_exists('Gmagick')) {
            throw new RuntimeException('Gmagick not installed');
        }

        $version = $this->getVersion();
        if (version_compare('1.3.0', $version) > 0) {
            throw new RuntimeException(sprintf('ImageMagick version 1.3.0 or higher is required, %s provided', $version));
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
            $gmagick = new \Gmagick();
            $version = $gmagick->getVersion();

            list(self::$version) = sscanf($version['versionString'], 'GraphicsMagick %s %04d-%02d-%02d %s %s');
        }

        return self::$version;
    }

    /**
     * {@inheritdoc}
     */
    public function open($path)
    {
        try {
            $gmagick = new \Gmagick($path);
        } catch (\GmagickException $exception) {
            throw new RuntimeException(sprintf('Unable to open image %s', $path), 0, $exception);
        }

        return new Image($gmagick);
    }
}
