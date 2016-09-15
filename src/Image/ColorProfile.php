<?php
/**
 * This file is part of the Magickly project.
 *
 * @author Daniel Schröder <daniel.schroeder@gravitymedia.de>
 */

namespace GravityMedia\Magickly\Image;

use GravityMedia\Magickly\Exception\RuntimeException;
use GuzzleHttp\Stream\StreamInterface;
use GuzzleHttp\Stream\Utils as StreamUtils;

/**
 * Color profile class.
 *
 * @package GravityMedia\Magickly\Image
 */
class ColorProfile
{
    /**
     * @var StreamInterface
     */
    private $stream;

    /**
     * Create color profile object.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Get stream.
     *
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Get data.
     *
     * @return string
     */
    public function getData()
    {
        $offset = $this->stream->tell();
        $this->stream->seek(0);

        $data = $this->stream->getContents();
        $this->stream->seek($offset);

        return $data;
    }

    /**
     * Create color profile object from filename.
     *
     * @param string $filename
     *
     * @return $this
     */
    public static function fromFilename($filename)
    {
        if (!file_exists($filename) || !is_file($filename) || !is_readable($filename)) {
            throw new RuntimeException(sprintf('Filename %s is an invalid profile file or is not readable', $filename));
        }

        return new static(StreamUtils::open($filename, 'r'));
    }
}
