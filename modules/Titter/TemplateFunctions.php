<?php
namespace Titter;

class TemplateFunctions
{
    public static function __callStatic(string $name, array $args): void
    {
        $cb = TemplateManager::getFunction($name);
        if ($cb != null)
        {
            $cb(...$args);
        }
    }
}