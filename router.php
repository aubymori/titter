<?php
use Titter\ControllerV2\Router;
use Titter\Controller;

Controller::funnel([
    "/favicon.ico",
    "/opensearch.xml"
]);

Controller::redirect([
    "/hashtag/(*)" => "/search?q=%23$1"
]);

Controller::route([
    "get" => [
        "/" => "HomeController",
        "default" => "ProfileController"
    ]
]);