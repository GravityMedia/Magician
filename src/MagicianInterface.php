<?php
/**
 * This file is part of the Magician project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magician;

use GravityMedia\Magician\Exception\RuntimeException;

/**
 * The Magician interface.
 *
 * @package GravityMedia\Magician
 */
interface MagicianInterface
{
    /**
     * Opens an existing image from $path.
     *
     * @param string $path
     *
     * @throws RuntimeException
     *
     * @return ImageInterface
     */
    public function open($path);
}
