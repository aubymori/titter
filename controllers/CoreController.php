<?php
namespace Titter\Controller;

use Titter\Controller;
use Titter\RequestMetadata;
use Titter\TemplateManager;
use Titter\Network;

use Titter\Model\Pageframe\Topbar;
use Titter\Model\Pageframe\Footer;
use Titter\Model\Pageframe\NoScriptForm;
use Titter\Model\Pageframe\SkipToContent;
use Titter\Model\Pageframe\ShortcutKeys;

class CoreController
{
    /** Use template? */
    public bool $useTemplate = true;

    /** Template uses core template? */
    public bool $useCoreTemplate = true;

    /** Template path minus .twig extension */
    public string $template = "";

    /**
     * Initialize for GET requests.
     */
    public function get(): void
    {
        $this->onGet(Controller::$app, new RequestMetadata());
        $this->init(Controller::$app);
    }

    /**
     * Controller-specific actions for controllers
     * which support the GET method. Is to be extended
     * specific controllers.
     */
    public function onGet(object &$app, RequestMetadata $request)
    {}

    /**
     * Initialize for GET requests.
     */
    public function post(): void
    {
        $this->onPost(Controller::$app, new RequestMetadata());
        $this->init(Controller::$app);
    }

    /**
     * Controller-specific actions for controllers
     * which support the POST method. Is to be extended
     * specific controllers.
     */
    public function onPost(object &$app, RequestMetadata $request)
    {}

    public function init(object &$app)
    {
        Network::run();

        if ($this->useTemplate)
        {
            if ($this->useCoreTemplate)
            {
                $app->topbar = new Topbar();
                $app->footer = new Footer();
                $app->noScriptForm = new NoScriptForm();
                $app->skipToContent = new SkipToContent();
                $app->shortcutKeys = new ShortcutKeys();
            }

            if ($this->template === "")
            {
                throw new \ValueError("Missing template name in " . get_class($this));
            }
            else
            {
                echo TemplateManager::render($this->template);
            }
        }
    }
}