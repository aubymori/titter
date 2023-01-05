<?php
namespace Titter\Model\Profile;

#[\AllowDynamicProperties]
class Profile
{
    /**
     * This doesn't need localization,
     * so we store it here.
     */
    private const TITLE_FORMAT = "%s (@%s) | Twitter";

    public function __construct(object $data)
    {
        $this->title =
        sprintf(
            self::TITLE_FORMAT,
            $data->user->legacy->name ?? "",
            $data->user->legacy->screen_name ?? ""
        );
    }
}