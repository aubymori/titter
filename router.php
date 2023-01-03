<?php
use Titter\ControllerV2\Router;

Router::funnel([
    "/favicon.ico",
    "/opensearch.xml"
]);

Router::get([
    "/" => "HomeController",
    "default" => "ProfileController"
]);