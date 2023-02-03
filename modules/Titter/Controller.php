<?php
namespace Titter;

use Titter\Util\GlobToRegexp;
use Titter\RequestMetadata;
use Titter\SimpleFunnel;

class Controller
{
    public const CONTROLLER_ROOT = "controllers";

    /**
     * Global variable for templates
     */
    public static object $app;

    /**
     * Router definitions
     */
    private static array $routes = [];

    /**
     * Redirect definitions
     */
    private static array $redirects = [];

    /**
     * Funnel definitions
     */
    private static array $funnels = [];

    public static function __initStatic()
    {
        self::$app = (object) [];
    }

    /**
     * Add definitons for the router.
     * They should be in the following format.
     * 
     * array(1) {
     *     ["method"]=>
     *     array(1) {
     *         ["/relative/url"]=>
     *         string(22) "path/to/controller"
     *     }
     * }
     * 
     * URLs are in a glob/Unix style pattern,
     * and controller paths are relative from
     * the CONTROLLER_ROOT const, and the .php
     * extension is omitted.
     */
    public static function route(array $routes): void
    {
        self::$routes += $routes;
    }

    /**
     * Add redirect definitions.
     * They should be in the following format.
     * 
     * array(1) {
     *     ["/from/here"]=>
     *     string(9) "/to/there"
     *     ["/glob/expression?param=(*)"]=>
     *     string(17) "/new/url?param=$1"
     *     ["/function/redirect"]=>
     *     object(Closure)#1 (0) {
     *     }
     * }
     * 
     * When you use a function, the user will be
     * redirect to the return value of that
     * function. Functions also get passed a
     * RequestMetadata option as the only parameter.
     */
    public static function redirect(array $redirects): void
    {
        self::$redirects += $redirects;
    }

    public static function funnel(array $funnels): void
    {
        self::$funnels += $funnels;
    }

    public static function run(): void
    {   
        foreach (self::$funnels as $url)
        if (\fnmatch($url, explode("?", $_SERVER["REQUEST_URI"])[0]))
        {
            SimpleFunnel::funnelCurrentPage(true);
            die();
        }

        // Check redirects and do that
        // if applicable
        foreach(self::$redirects as $from => $to)
        {
            // Make current definition into regexp
            // to compare
            $regexp = GlobToRegexp::convert($from, $_SERVER["REQUEST_URI"]);

            if (preg_match($regexp, $_SERVER["REQUEST_URI"]))
            {
                $url = null;

                if (is_callable($to))
                {
                    $url = $to(new RequestMetadata());

                    // Prevent unexpected behavior
                    if (!is_string($url)) return;
                }
                else
                {
                    // Quick and easy behavior
                    $url = preg_replace($regexp, $to, $_SERVER["REQUEST_URI"]);
                }

                // Finally, redirect
                header("Location: {$url}");
                die();
            }
        }

        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        $match = null;
        if (isset(self::$routes[$method]))
        {
            foreach(self::$routes[$method] as $url => $cpath)
            {
                if (\fnmatch($url, explode("?", $_SERVER["REQUEST_URI"])[0]))
                {
                    $match = $cpath;
                }
            }

            if (!is_null($match))
            {
                self::runController($match);
            }
            else if (isset(self::$routes[$method]["default"]))
            {
                self::runController(self::$routes[$method]["default"]);
            }
            else
            {
                throw new \Exception(
                    "No matching controllers or default definition"
                );
            }
        }
        else
        {
            throw new \Exception(
                "HTTP method " .
                $_SERVER["REQUEST_METHOD"] .
                " not defined in router"
            );
        }
    }

    /**
     * Run a controller.
     * 
     * @param string $path    Path to the controller.
     */
    private static function runController(string $path): void
    {
        try
        {
            $controller = include self::CONTROLLER_ROOT . "/" . $path . ".php";
        }
        catch (\Throwable $e)
        {
            throw new \Exception(
                "Controller " .
                $path .
                " does not exist"
            );
            return;
        }
        $method = strtolower($_SERVER["REQUEST_METHOD"]);

        if (method_exists($controller, $method))
        {
            $controller->{$method}();
        }
        else
        {
            throw new \Exception(
                "Controller " .
                $path .
                " does not contain a function for HTTP method " .
                $_SERVER["REQUEST_METHOD"]
            );
        }
    }
}