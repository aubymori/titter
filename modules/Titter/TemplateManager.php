<?php
namespace Titter;

use Twig\{
    TwigFunction,
    TwigFilter
};

class TemplateManager
{
    /** @var \Twig\Environment */
    public static $twig;

    public static string $template = "";

    /** @var object */
    public static $state;

    /** @var string */
    public const STATE_NAME = "app";
    public const TEMPLATE_DIR = "templates";

    public static function __initStatic()
    {
        self::$twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(self::TEMPLATE_DIR)
        );
    }

    public static function registerGlobalState(object &$state): void
    {
        self::$state = &$state;
        self::addGlobal(self::STATE_NAME, $state);
    }

    public static function render(?string $template): string
    {
        $template = (!is_null($template)) ? $template : self::$template;
        return self::$twig->render(
            $template . ".twig",
            (array) self::$state
        );
    }

    public static function addGlobal(string $name, mixed &$value): void
    {
        self::$twig->addGlobal($name, $value);
    }

    public static function addFunction(string $name, callable $callback): void
    {
        self::$twig->addFunction(
            new TwigFunction($name, $callback)
        );
    }

    public static function addFilter(string $name, callable $callback): void
    {
        self::$twig->addFilter(
            new TwigFilter($name, $callback)
        );
    }
}