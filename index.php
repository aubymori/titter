<?php
set_include_path($_SERVER["DOCUMENT_ROOT"]);

// Get autoloaders for composer and titter modules
require "vendor/autoload.php";
require "modules/autoloader.php";

// Global state variable
$app = (object) [];

use Titter\ControllerV2\Core as ControllerV2;
use Titter\TemplateManager;

// Initialize global state variable for
// controllers and templates
ControllerV2::registerStateVariable($app);
TemplateManager::registerGlobalState($app);

require "router.php";