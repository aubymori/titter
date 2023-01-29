<?php
namespace Titter\Util;

use YukisCoffee\CoffeeRequest\CoffeeRequest;
use YukisCoffee\CoffeeRequest\Enum\PromiseStatus;
use YukisCoffee\CoffeeRequest\Promise;
use Titter\i18n;

use function Titter\Async\async;

/**
 * Implements an easy way to work with Twitter cookies.
 * 
 * @author Aubrey Pankow <aubyomori@gmail.com>
 */
class Cookies
{
    protected const API_AUTH = "Bearer AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA";

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

    /**
     * Validate the new guest token, and if it is
     * invalid, generate a new one.
     */
    public static function validateGuestToken(): Promise/*<string>*/
    {
        return async(function() {
            $response = yield CoffeeRequest::request("https://api.twitter.com/1.1/hashflags.json", [
                "headers" => [
                    "User-Agent" => $_SERVER["HTTP_USER_AGENT"],
                    "Authorization" => self::API_AUTH,
                    "X-Guest-Token" => $_COOKIE["gt"],
                    "X-Twitter-Active-User" => "Yes",
                    "X-Twitter-Client-Language" => i18n::$globalLang
                ]
            ]);

            
        });
    }

    public static function getNewGuestToken(): Promise/*<string>*/
    {
        return async(function() {
            $response = yield CoffeeRequest::request("https://twitter.com", [
                "headers" => [
                    "User-Agent" => $_SERVER["HTTP_USER_AGENT"]
                ]
            ]);

            // Cookie string for later request (see below)
            $cookiestr = "";

            if ($cookies = @$response->headers->{"set-cookie"})
            foreach ($cookies as $cookie)
            {
                $cookiestr .= substr($cookie, 0, strpos($cookie, ";")) . ";";
            }

            // "Activate" the new guest ID
            $activate = yield CoffeeRequest::request("https://api.twitter.com/1.1/guest/activate.json", [
                "headers" => [
                    "User-Agent" => $_SERVER["HTTP_USER_AGENT"],
                    "Authorization" => self::API_AUTH,
                    "Cookie" => $cookiestr,
                    "X-Twitter-Active-User" => "Yes",
                    "X-Twitter-Client-Language" => i18n::$globalLang
                ],
                "method" => "POST"
            ]);

            $activate = $activate->getJson();
            
            setcookie("gt", $activate->guest_token, time() + (60 * 60 * 24));
            return $activate->guest_token;
        });
    }
}