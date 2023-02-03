<?php
set_include_path($_SERVER["DOCUMENT_ROOT"]);

// Get autoloaders for composer and titter modules
require "vendor/autoload.php";
require "modules/autoloader.php";

include "modules/polyfill/AllowDynamicProperties.php";
include "error_handler.php";

use Titter\Controller;
use Titter\TemplateManager;

// Global state variable
$app = &Controller::$app;

// Define basic variables
$app->lang = &\Titter\i18n::$globalLang;
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

$msgs = new \Titter\i18n("global");
$app->msgs = $msgs->getStrings();

// Initialize global state variable for
// controllers and templates
TemplateManager::registerGlobalState($app);

require "router.php";

Controller::run();