<?php
namespace Titter\Model\Profile;

class ProfileHeading
{
    /** @var ProfileTab[] */
    public array $tabs = [];

    public function __construct(
        public string $title
    ) {}

    public function addTab(ProfileTab $tab): void
    {
        $this->tabs[] = $tab;
    }
}

class ProfileTab
{
    public string $activeLabel;

    public function __construct(
        public string $label,
        public string $url,
        public string $tab,
        public bool $active
    )
    {
        $this->activeLabel = Profile::$strings->tabActive($this->label);
    }
}