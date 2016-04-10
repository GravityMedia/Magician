<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magician\Imagick;

use GravityMedia\Magician\Exception\RuntimeException;
use GravityMedia\Magician\MagicianInterface;

/**
 * The Magician class.
 *
 * @package GravityMedia\Magician\Imagick
 */
class Magician implements MagicianInterface
{
    /**
     * @var string
     */
    private static $version;

    /**
     * Create Magician object.
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
        $imagick = new \Imagick($path);

        return new Image($imagick);
    }
}
