<?php
namespace Titter\Util;

class UserAgent
{
    public static function operatingSystem(string $ua): string
    {
        return match(true)
        {
            str_contains($ua, "Windows NT") => "Windows",
            str_contains($ua, "Linux") => "Linux",
            str_contains($ua, "Macintosh") => "macOS",
        };
    }
}