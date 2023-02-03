<?php
namespace Titter\Controller;

use Titter\RequestMetadata;
use Titter\Util\NumberFormat;
Use Titter\Util\Cookies;

class HomeController extends CoreController
{
    public string $template = "home";

    public function onGet(object &$app, RequestMetadata $request)
    {
        Cookies::getNewGuestToken();
    }
}

return new HomeController();