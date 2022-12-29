<?php
namespace Titter\Model\Pageframe;

use Titter\i18n;

class SkipToContent
{
    public string $message;

    public function __construct()
    {
        $strings = new i18n("common");
        $this->message = $strings->skipToContent;
    }
}