<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magician\Gmagick;

use GravityMedia\Magician\Exception\RuntimeException;
use GravityMedia\Magician\MagicianInterface;

/**
 * The Magician class.
 *
 * @package GravityMedia\Magician\Gmagick
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
        $gmagick = new \Gmagick($path);

        return new Image($gmagick);
    }
}
