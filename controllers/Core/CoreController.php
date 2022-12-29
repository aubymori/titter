<?php
namespace Titter\Controller\Core;

use Titter\Model\Pageframe\{
    Topbar,
    Footer,
    NoScriptForm,
    SkipToContent,
    ShortcutKeys
};

use Titter\{
    ControllerV2\RequestMetadata,
    TemplateManager
};

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
     * 
     * @param object $app               State variable.
     * @param RequestMetadata $request  Request data.
     */
    public function get(object &$app, RequestMetadata $request): void
    {
        $this->onGet($app, $request);
        $this->init($app);
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
     * 
     * @param object $app               State variable.
     * @param RequestMetadata $request  Request data.
     */
    public function post(object $app, RequestMetadata $request): void
    {
        $this->onPost($app, $request);
        $this->init($app);
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