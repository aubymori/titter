<?php
namespace Titter\Model\Profile;

class ProfileSuspended
{
    public string $title;
    public string $message;

    public function __construct()
    {
        $strings = Profile::$strings;
        $this->title = $strings->suspendedTitle;
        $this->message = $strings->suspendedMessage;
    }
}