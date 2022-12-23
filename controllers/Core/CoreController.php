<?php
namespace Titter\Controller\Core;

use Titter\{
    ControllerV2\RequestMetadata,
    TemplateManager
};

class CoreController
{
    /** Use template? */
    public bool $useTemplate = true;

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
        $this->init();
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
        $this->init();
    }

    /**
     * Controller-specific actions for controllers
     * which support the POST method. Is to be extended
     * specific controllers.
     */
    public function onPost(object &$app, RequestMetadata $request)
    {}

    public function init()
    {
        if ($this->useTemplate)
        {
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