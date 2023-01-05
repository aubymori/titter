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
    
    /**
     * Some key or something??? I don't know.
     * It's planted in the URL between /graphql/
     * and the action.
     */
    protected const GRAPHQL_KEY = "tgMiZwwhWR2sI0KsNsExrA";
    protected const GRAPHQL_AUTH = "Bearer AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA";

    protected const DNS_OVERRIDE_HOST = "1.1.1.1";

    public static function graphqlRequest(
        string $action,
        array $variables,
        array $features
    ): Promise/*<Response>*/
    {
        $host = self::API_HOST;
        $key = self::GRAPHQL_KEY;
        
        return async(function()
            use(
                &$action,
                &$variables,
                &$features,
                &$host,
                &$key
            ) {
                $variables = urlencode(json_encode($variables));
                $features = urlencode(json_encode($features));
                $gt = yield Cookies::getGuestToken();

                CoffeeRequest::request(
                    "{$host}/graphql/{$key}/{$action}?variables={$variables}&features={$features}",
                    [
                        "headers" => [
                            "Authorization" => self::GRAPHQL_AUTH,
                            "X-Twitter-Active-User" => "Yes",
                            "X-Twitter-Client-Language" => i18n::$globalLang,
                            "X-Guest-Token" => $gt
                        ],
                        "onError" => "ignore",
                        "dnsOverride" => self::DNS_OVERRIDE_HOST
                    ]
                )->then(function ($response)
                    {
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