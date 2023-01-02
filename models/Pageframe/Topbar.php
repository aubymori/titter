<?php
namespace Titter\Model\Pageframe;

use Titter\i18n;
use Titter\Model\Common\EdgeButton;

use function PHPSTORM_META\map;

class Topbar
{
    private i18n $strings;

    public HeaderNav $nav;
    public HeaderSearchbox $searchbox;

    public function __construct()
    {
        $this->strings = new i18n("topbar");
        $this->nav = new HeaderNav($this->strings);
        $this->searchbox = new HeaderSearchbox($this->strings);
        $this->signinLink = new HeaderSigninLink($this->strings);
    }
}

class HeaderNav
{
    public array $items = [];

    public function __construct(i18n $strings)
    {
        $this->items[] = new HeaderNavItem(
            $strings,
            "home",
            "bird",
            $strings->tabHome,
            "/",
            false
        );
    }
}

class HeaderNavItem
{
    public string $activeLabel;

    public function __construct(
        i18n $strings,
        public string $id,
        public string $icon,
        public string $label,
        public string $url,
        public bool $activeIcon
    )
    {
        $this->activeLabel = $strings->tabActive($this->label);
    }
}

class HeaderSearchbox
{
    public string $placeholder;
    public string $a11yLabel;
    public string $btnLabel;

    public function __construct(i18n $strings)
    {
        $this->placeholder = $strings->searchPlaceholder;
        $this->a11yLabel = $strings->searchA11yLabel;
        $this->btnLabel = $strings->searchPlaceholder;
    }
}

class HeaderSigninLink
{
    public string $question;
    public string $action;
    public string $url;
    public HeaderSigninDialog $dialog;

    public function __construct(i18n $strings)
    {
        $this->question = $strings->signinPromo;
        $this->action = $strings->signinPromoAction;
        $this->url = "/login";
        $this->dialog = new HeaderSigninDialog($strings);
    }
}

class HeaderSigninDialog
{
    public string $title;
    public string $usernamePlaceholder;
    public string $passwordPlaceholder;
    public string $rememberMeLabel;
    public object $forgotPasswordLink;
    public EdgeButton $loginButton;
    public string $signUpTitle;
    public EdgeButton $signUpButton;

    public function __construct(i18n $strings)
    {
        $this->title = $strings->signinPromo;
        $this->usernamePlaceholder = $strings->usernamePlaceholder;
        $this->passwordPlaceholder = $strings->passwordPlaceholder;
        $this->rememberMeLabel = $strings->rememberMeLabel;
        $this->forgotPasswordLink = (object) [
            "text" => $strings->forgotPasswordLink,
            "url" => "/account/begin_password_reset"
        ];
        $this->loginButton = new EdgeButton(
            style: "primary",
            size: "medium",
            label: $strings->signinPromoAction,
            asInput: true
        );
        $this->signUpTitle = $strings->signUpHeader;
        $this->signUpButton = new EdgeButton(
            style: "secondary",
            size: "medium",
            label: $strings->signUpButton,
            url: "/signup",
            class: [
                "u-block",
                "js-signup"
            ]
        );
    }
}