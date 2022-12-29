<?php
\Titter\TemplateManager::addFunction("jsName", function(string $name, string $lang): ?string
{
    $constants = include "js_path_constants.php";
    if ($a = @$constants->{$name})
    {
        return sprintf($a, $lang);
    }
    return null;
});