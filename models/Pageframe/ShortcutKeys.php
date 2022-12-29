<?php
namespace Titter\Model\Pageframe;

use Titter\i18n;

#[\AllowDynamicProperties]
class ShortcutKeys
{
    public function __construct()
    {
        $strings = new i18n("shortcut_keys");
        $this->Enter = $strings->openTweetDetails;
        $this->o = $strings->expandPhoto;
        $this->{"/"} = $strings->search;
        $this->{"?"} = $strings->thisMenu;
        $this->j = $strings->nextTweet;
        $this->k = $strings->prevTweet;
        $this->Space = $strings->pageDown;
        $this->{"."} = $strings->loadNewTweets;
        $this->gu = $strings->goToUser;
    }
}