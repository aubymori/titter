<?php
namespace Titter\Model\Profile;

use Titter\i18n;
use Titter\Util\{
    NumberFormat,
    Images
};

#[\AllowDynamicProperties]
class Profile
{
    /**
     * This doesn't need localization,
     * so we store it here.
     */
    private const TITLE_FORMAT = "%s (@%s) | Twitter";

    public static i18n $strings;

    public function __construct(object $data)
    {
        self::$strings = new i18n("profile");

        if (@$data->user->__typename == "UserUnavailable" && @$data->user->reason == "Suspended")
        {
            $this->title = self::$strings->suspendedPageTitle;
            $this->error = new ProfileSuspended();
            return;
        }

        $this->title =
        sprintf(
            self::TITLE_FORMAT,
            $data->user->legacy->name ?? "",
            $data->user->legacy->screen_name ?? ""
        );

        $this->canopy = new ProfileCanopy($data->user->legacy, (int) $data->user->rest_id);
    }
}

class ProfileCanopy
{
    public ?string $banner;

    public ProfileAvatar $avatar;

    /** @var ProfileCanopyStat[] */
    public array $stats = [];

    public ProfileCanopyCard $card;

    public int $id;

    public function __construct(object $data, int $id)
    {
        $strings = Profile::$strings;
        $this->banner = $data->profile_banner_url ?? null;   
        $this->avatar = new ProfileAvatar($data);
        $this->card = new ProfileCanopyCard($data);
        $this->id = $id;

        $stats = &$this->stats;
        $name = $data->screen_name;

        $stats[] = new ProfileCanopyStat(
            "tweets",
            $strings->statTweets,
            $data->statuses_count,
            $strings->statTweetsTip,
            "/{$name}",
            true
        );

        $stats[] = new ProfileCanopyStat(
            "following",
            $strings->statFollowing,
            $data->friends_count,
            $strings->statFollowingTip,
            "/{$name}/following"
        );

        $stats[] = new ProfileCanopyStat(
            "followers",
            $strings->statFollowers,
            $data->followers_count,
            $strings->statFollowersTip,
            "/{$name}/followers"
        );

        $stats[] = new ProfileCanopyStat(
            "likes",
            $strings->statLikes,
            $data->favourites_count, // br*tish twitter devs 🤢
            $strings->statLikesTip,
            "/{$name}/likes"
        );

        $stats[] = new ProfileCanopyStat(
            "lists",
            $strings->statLists,
            $data->listed_count,
            $strings->statListsTip,
            "/{$name}/lists"
        );
    }
}

class ProfileAvatar
{
    public string $url;
    public string $tooltip;

    public function __construct(object $data)
    {
        $this->url = Images::resize($data->profile_image_url_https, "400x400");
        $this->tooltip = $data->name;
    }
}

class ProfileCanopyCard
{
    public string $avatar;
    public string $name;
    public string $screenName;

    public function __construct(object $data)
    {
        $this->avatar = $data->profile_image_url_https;
        $this->name = $data->name;
        $this->screenName = $data->screen_name;
    }
}

class ProfileCanopyStat
{
    public int    $count;
    public string $value;
    public string $tooltip;

    public function __construct(
        public string $id,
        public string $label,
               int    $count,
               string $tooltip,
        public string $url,
        public bool $active = false
    ) {
        $this->count = $count;
        $this->value = NumberFormat::shorten($count);
        $this->tooltip = sprintf($tooltip, number_format($count));
    }
}