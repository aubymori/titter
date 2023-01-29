<?php
use Titter\ControllerV2\Router;

Router::funnel([
    "/favicon.ico",
    "/opensearch.xml"
]);

Router::redirect([
    "/hashtag/(*)" => "/search?q=%23$1"
]);

Router::get([
    "/" => "HomeController",
    "default" => "ProfileController"
]);