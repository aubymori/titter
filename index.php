<?php
set_include_path($_SERVER["DOCUMENT_ROOT"]);

// Get autoloaders for composer and titter modules
require "vendor/autoload.php";
require "modules/autoloader.php";

include "modules/polyfill/AllowDynamicProperties.php";

// Global state variable
$app = (object) [];

// Define basic variables
$app->lang = "en"; // TODO: i18n
$app->dir = "ltr";

$app->nightMode = \Titter\Util\Cookies::isNightMode();
$app->os = \Titter\Util\UserAgent::operatingSystem($_SERVER["HTTP_USER_AGENT"]);
$app->url = $_SERVER["REQUEST_URI"];

// CSS revision number
$app->cssRev = 1545257567;

// Import template functions
foreach (glob("modules/TemplateFunctions/*") as $file)
{
    include $file;
}

use Titter\ControllerV2\Core as ControllerV2;
use Titter\TemplateManager;

// Initialize global state variable for
// controllers and templates
ControllerV2::registerStateVariable($app);
TemplateManager::registerGlobalState($app);

require "router.php";