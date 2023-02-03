<?php
namespace Titter\Model\Profile;

use Titter\i18n;
use Titter\Util\NumberFormat;
use Titter\Util\Images;
use Titter\Model\Traits\Runs;
use Titter\Model\Common\EdgeButton;

#[\AllowDynamicProperties]
class Profile
{
    /**
     * This doesn't need localization,
     * so we store it here.
     */
    private const TITLE_FORMAT = "%s (@%s) | Twitter";

    public const TWEET_TABS = [
        "",
        "with_replies",
        "media"
    ];

    public static i18n $strings;

    public function __construct(object $data, string $tab)
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

        $this->canopy = new ProfileCanopy($data->user->legacy, $data->user->is_blue_verified, (int) $data->user->rest_id, $tab);
        $this->info = new ProfileInfo($data->user->legacy, $data->user->is_blue_verified);
        $this->sidebar = new ProfileSidebar();

        if (in_array($tab, self::TWEET_TABS) && isset($data->tweets))
        {
            $this->content = new ProfileTweets(
                timeline: $data->tweets, 
                tab: $tab, 
                screenName: $data->user->legacy->screen_name
            );
        }
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

    public function __construct(object $data, bool $blueVerified, int $id, string $tab)
    {
        $strings = Profile::$strings;
        $this->banner = $data->profile_banner_url ?? null;   
        $this->avatar = new ProfileAvatar($data);
        $this->card = new ProfileCanopyCard($data, $blueVerified);
        $this->id = $id;

        $stats = &$this->stats;
        $name = $data->screen_name;

        $stats[] = new ProfileCanopyStat(
            "tweets",
            $strings->statTweets,
            $data->statuses_count,
            $strings->statTweetsTip,
            "/{$name}",
            in_array($tab, Profile::TWEET_TABS)
        );

        $stats[] = new ProfileCanopyStat(
            "following",
            $strings->statFollowing,
            $data->friends_count,
            $strings->statFollowingTip,
            "/{$name}/following",
            $tab == "following"
        );

        $stats[] = new ProfileCanopyStat(
            "followers",
            $strings->statFollowers,
            $data->followers_count,
            $strings->statFollowersTip,
            "/{$name}/followers",
            $tab == "followers"
        );

        $stats[] = new ProfileCanopyStat(
            "likes",
            $strings->statLikes,
            $data->favourites_count, // br*tish twitter devs 🤢
            $strings->statLikesTip,
            "/{$name}/likes",
            $tab == "likes"
        );

        $stats[] = new ProfileCanopyStat(
            "lists",
            $strings->statLists,
            $data->listed_count,
            $strings->statListsTip,
            "/{$name}/lists",
            $tab == "lists"
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
    public bool   $verified;

    public function __construct(object $info, bool $blueVerified)
    {
        $this->avatar = $info->profile_image_url_https;
        $this->name = $info->name;
        $this->screenName = $info->screen_name;
        $this->verified = ($info->verified && !$blueVerified);
    }
}

class ProfileCanopyStat
{
    public int    $count;
    public string $value;
    public string $tooltip;
    public string $activeLabel;

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
        $this->activeLabel = Profile::$strings->tabActive($this->label);
    }
}

class ProfileInfo
{
    public string $name;
    public string $screenName;
    public object $bio;
    public string $location;
    public object $url;
    public string $joinDate;
    public string $birthDate;

    public bool $verified;

    public function __construct(object $info, bool $blueVerified)
    {
        $this->name = $info->name;
        $this->screenName = $info->screen_name;
        $this->verified = ($info->verified && !$blueVerified);
        $links = [];
        if (isset($info->entities->description->urls))
        foreach($info->entities->description->urls as $url)
        {
            $links[] = $url->display_url;
        }
        $this->bio = Runs::from($info->description, $links);
    }
}

class ProfileSidebar
{
    public ProfileSignupPromo $signupPromo;
    
    public function __construct()
    {
        $this->signupPromo = new ProfileSignupPromo();
    }
}

class ProfileSignupPromo
{
    public string     $header;
    public string     $message;
    public EdgeButton $button;

    public function __construct()
    {
        $strings = Profile::$strings;
        $this->header = $strings->signupPromoHeader;
        $this->message = $strings->signupPromoMessage;
        $this->button = new EdgeButton(
            style: "primary",
            size: "large",
            label: $strings->signupPromoAction,
            url: "/signup",
            class: [
                "SignupForm-submit",
                "u-block",
                "js-signup"
            ]
        );
    }
}