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
        
    }
}

return new HomeController();