<?php
use Titter\{
    ControllerV2\RequestMetadata,
    Controller\Core\CoreController
};

class HomeController extends CoreController
{
    public string $template = "home";

    public function onGet(object &$app, RequestMetadata $request)
    {
        $app->testValue = "Hello, titter!";
    }
}

return new HomeController();