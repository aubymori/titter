<?php
use Titter\ControllerV2\Router;

Router::funnel([
    "/favicon.ico"
]);

Router::get([
    "/" => "HomeController"
]);