<?php
namespace Titter\Util;

/**
 * Implements an easy way to work with Twitter cookies.
 * 
 * @author Aubrey Pankow <aubyomori@gmail.com>
 */
class Cookies
{
    public static function isNightMode(): bool
    {
        return (isset($_COOKIE["night_mode"]))
        ? (int) ($_COOKIE["night_mode"]) > 0
        : false;
    }   
}