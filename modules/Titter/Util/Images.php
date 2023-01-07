<?php
namespace Titter\Util;

class Images
{
    public const IMAGE_SIZE_REGEX = "/(?<=.)[a-zA-Z0-9]+(?=.(?:jpg|png))/";
 
    public static function resize(string $orig, string $size): string
    {
        return preg_replace(self::IMAGE_SIZE_REGEX, $size, $orig);
    }
}