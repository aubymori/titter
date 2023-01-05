<?php
use Titter\{
    ControllerV2\RequestMetadata,
    Controller\Core\CoreController,
    NumberFormat,
    Util\Cookies
};

class HomeController extends CoreController
{
    public string $template = "home";

    public function onGet(object &$app, RequestMetadata $request)
    {
        Cookies::getNewGuestToken();
    }
}

return new HomeController();