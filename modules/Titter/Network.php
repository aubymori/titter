<?php
namespace Titter;

use YukisCoffee\CoffeeRequest\{
    CoffeeRequest,
    Promise
};

use Titter\{
    i18n,
    Util\Cookies
};

use function Titter\Async\async;

class NetworkFailedRequestExeception extends \Exception {}

class Network
{
    protected const API_HOST = "https://api.twitter.com";
    protected const API_VERSION = "1.1";
    protected const API_AUTH = "Bearer AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA";

    protected const DNS_OVERRIDE_HOST = "1.1.1.1";

    public static function graphqlRequest(
        string $action,
        array $variables,
        array $features
    ): Promise/*<Response>*/
    {
        $host = self::API_HOST;
        
        return async(function()
            use(
                &$action,
                &$variables,
                &$features,
                &$host
            ) {
                $variables = urlencode(json_encode($variables));
                $features = urlencode(json_encode($features));
                $gt = yield Cookies::getGuestToken();

                $response = yield CoffeeRequest::request(
                    "{$host}/graphql/{$action}?variables={$variables}&features={$features}",
                    [
                        "headers" => [
                            "User-Agent" => $_SERVER["HTTP_USER_AGENT"],
                            "Authorization" => self::API_AUTH,
                            "X-Twitter-Active-User" => "Yes",
                            "X-Twitter-Client-Language" => i18n::$globalLang,
                            "X-Guest-Token" => $gt
                        ],
                        "onError" => "ignore",
                        "dnsOverride" => self::DNS_OVERRIDE_HOST
                    ]
                );

                if (200 == $response->status)
                {
                    return $response;
                }
                else
                {
                    throw new NetworkFailedRequestExeception($response);
                    return;
                }
            }
        );
    }

    /**
     * Run all requests made.
     */
    public static function run(): void
    {
        CoffeeRequest::run();
    }
}