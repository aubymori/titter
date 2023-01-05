<?php
namespace Titter\Util;

use YukisCoffee\CoffeeRequest\CoffeeRequest;
use YukisCoffee\CoffeeRequest\Enum\PromiseStatus;
use YukisCoffee\CoffeeRequest\Promise;

use function Titter\Async\async;

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

    public static function getGuestToken(): Promise/*<string>*/
    {
        return async(function() {
            if (isset($_COOKIE["gt"]))
            {
                return $_COOKIE["gt"];
            }
            
            return (yield self::getNewGuestToken());
        });
    }

    public static function getNewGuestToken(): Promise/*<YukisCoffee\CoffeeRequest\Network\Response>*/
    {
        return async(function() {
            $response = yield CoffeeRequest::request("https://twitter.com", [
                "headers" => [
                    "User-Agent" => $_SERVER["HTTP_USER_AGENT"]
                ]
            ]);

            if ($cookies = @$response->headers->{"set-cookie"})
            foreach ($cookies as $cookie)
            if (substr($cookie, 0, 9) == "guest_id=")
            {
                $gt = substr($cookie, 14, 18);
                setcookie("gt", $gt, time() + (60 * 60  *24));
                return $gt;
            }
        });
    }
}