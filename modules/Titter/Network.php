<?php
namespace Titter;

use YukisCoffee\CoffeeRequest\{
    CoffeeRequest,
    Promise
};

use Titter\i18n;

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
        
        return new Promise(function($resolve, $reject)
            use(
                $action,
                $variables,
                $features,
                $host,
                $key
            ) {
                $variables = urlencode(json_encode($variables));
                $features = urlencode(json_encode($features));

                CoffeeRequest::request(
                    "{$host}/graphql/{$key}/{$action}?variables={$variables}&features={$features}",
                    [
                        "headers" => [
                            "Authorization" => self::GRAPHQL_AUTH,
                            "X-Twitter-Active-User" => "Yes",
                            "X-Twitter-Client-Language" => i18n::$globalLang,
                            "X-Guest-Token" => "1610054669849468928"
                        ],
                        "onError" => "ignore",
                        "dnsOverride" => self::DNS_OVERRIDE_HOST
                    ]
                )->then(function ($response) use ($resolve, $reject)
                    {
                        if (200 == $response->status)
                        {
                            $resolve($response);
                        }
                        else
                        {
                            $reject(new NetworkFailedRequestExeception($response));
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