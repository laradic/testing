<?php
/**
 * Part of the $author$ PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */


namespace Laradic\Testing;


class Util
{
    public static function getFilenameWithoutExtension($path, $extension = null)
    {

        if ( '' === $path ) {
            return '';
        }

        if ( null !== $extension ) {
            // remove extension and trailing dot
            return rtrim(basename($path, $extension), '.');
        }

        return pathinfo($path, PATHINFO_FILENAME);
    }
}
