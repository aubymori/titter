<?php
namespace Titter\ControllerV2;

/**
 * Implements core behaviours of the Controller v2
 * architecture.
 * 
 * These behaviours include the storing the common
 * state variable. It also provides an API for
 * basic interaction with the system, i.e. importing.
 * 
 * The variables passed to all CV2 controllers are, in this
 * precise order:
 *    - &$state       Reference to the global state variable.
 *    - $request      Contains information about the current
 *                    request.
 * ...and then any custom defined arguments after that.
 * 
 * @author Taniko Yamamoto <kirasicecreamm@gmail.com>
 * @author The Rehike Maintainers
 * @version 2.0
 */
class Core
{
    /** 
     * A reference to global state variable.
     * 
     * This variable gets passed to each controller, but
     * modifications exceed it so that closing services
     * may access its contents.
     * 
     * @var object|array
     */
    public static $state;

    /** Register a state reference. @see $state */
    public static function registerStateVariable(&$state)
    {
        self::$state = &$state;
    }

    /**
     * Import a controller's file or pull it from the session
     * cache.
     * 
     * The contents are cached in order to allow reimports without
     * causing additional errors, such as in the event of a
     * function redeclaration.
     * 
     * @return GetControllerInstance
     */
    public static function import($controllerName, $appendPhp = true)
    {
        if (ControllerStore::hasController($controllerName))
        {
            // Import from cache
            $controller = ControllerStore::getController($controllerName);

            return new GetControllerInstance($controllerName, $controller);
        }
        else
        {
            // Import from file (or die)
            $imports = require $controllerName . ($appendPhp ? ".php" : "");

            ControllerStore::registerController($controllerName, $imports);

            return new GetControllerInstance($controllerName, $imports);
        }
    }

    /**
     * @see CallbackStore::setRedirectHandler
     */
    public static function setRedirectHandler($cb)
    {
        return CallbackStore::setRedirectHandler($cb);
    }
}