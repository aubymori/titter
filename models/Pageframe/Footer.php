<?php
namespace Titter\Model\Pageframe;

use Titter\i18n;

class Footer
{
    public string $copyright;
    public array $links = [];

    /**
     * This doesn't need localization,
     * so we store it here.
     */
    private const COPYRIGHT_FORMAT = "© %s Twitter";

    public function __construct()
    {
        $strings = new i18n("footer");
        $links = &$this->links;

        $this->copyright = sprintf(self::COPYRIGHT_FORMAT, date("Y"));

        $links[] = new FooterLink(
            $strings->linkAbout,
            "/about"
        );
        $links[] = new FooterLink(
            $strings->linkHelp,
            "//support.twitter.com/"
        );
        $links[] = new FooterLink(
            $strings->linkTerms,
            "/tos"
        );
        $links[] = new FooterLink(
            $strings->linkPrivacy,
            "/privacy"
        );
        $links[] = new FooterLink(
            $strings->linkCookies,
            "//support.twitter.com/articles/20170514"
        );
        $links[] = new FooterLink(
            $strings->linkAdsInfo,
            "//support.twitter.com/articles/20170451"
        );
        $links[] = new FooterLink(
            $strings->linkRepo,
            "//github.com/aubymori/titter"
        );
    }
}

class FooterLink
{
    public function __construct(
        public string $label,
        public string $url
    )
    {}
}