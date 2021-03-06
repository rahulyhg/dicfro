<?php

/**
 * Dicfro
 *
 * PHP 5
 *
 * @category  DicFro
 * @package   Controller
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2008-2012 Michel Corne
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'Base/String.php';
require_once 'Base/View.php';

/**
 * Front controller
 *
 * @category  DicFro
 * @package   Controller
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2008-2012 Michel Corne
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class Controller_Front
{
    /**
     * Name of the controller action
     * @var string
     */
    public $action;

    /**
     * Action parameters
     * @var string
     */
    public $actionParams = [];

    /**
     * Configuration directives
     * @var array
     */
    public $config;

    /**
     * List of controller classes
     * @var array
     */
    protected $controllerClasses = [
        'interface' => 'Controller_Interface',
    ];

    /**
     * Name of the controller
     * @var string
     */
    public $controllerName;

    /**
     * Input parameters
     * @var array
     */
    public $params;

    /**
     * View object
     * @var object
     */
    public $view;

    /**
     * Constructor
     *
     * @param  string $config the configuration directives
     * @param  object $view   the view
     * @return void
     */
    public function __construct($config, Base_View $view)
    {
        $this->config = $config;
        $this->view = $view;
    }

    /**
     * Executes the controller action
     *
     * @param  object $view the view
     * @return void
     */
    public function callController()
    {
        // instantiate the controller
        $class = $this->controllerClasses[$this->controllerName];
        $file = str_replace('_', '/', $class) . '.php';
        require_once $file;
        $controller = new $class($this);

        // calls the controller action
        $controller->init();
        $method = $this->action . 'Action';
        $controller->$method();
        $controller->finish();
    }


    /**
     * Returns a posted parameter
     *
     * @param string $param
     * @return mixed
     */
    public function getPost($param)
    {
        if (isset($_POST[$param])) {
            return $_POST[$param];
        }

        return null;
    }

    /**
     * Matches the route to a controller name, action and function name
     *
     * @return void
     */
    public function matchRoute()
    {
        // format: [/domain-subpath][/action][/param1]...
        // ex. "dicfro/search/vandaele/xyz"
        // note: not capturing controller name
        if (empty($this->config['domain-subpath'])) {
            $baseUrl = '';
        } else {
            $baseUrl = "/{$this->config['domain-subpath']}";
        }

        $routePattern = "~^$baseUrl(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?(?:/([^/?]+))?~";

        if (preg_match($routePattern, $_SERVER['REQUEST_URI'], $this->actionParams)) {
            array_shift($this->actionParams);
            $this->setAction();
        }

        $this->controllerName = 'interface';
    }

    /**
     * Runs the front controller
     *
     * @return void
     */
    public function run()
    {
        $this->matchRoute();
        $this->setParams();
        $this->callController();
    }

    /**
     * Sets the action
     *
     * @return void
     */
    public function setAction()
    {
        $action = array_shift($this->actionParams);
        $string = new Base_String;
        $this->action = $string->dash2CamelCase($action);
    }

    /**
     * Sets URL parameters
     *
     * @return void
     */
    public function setParams()
    {
        $this->params = [];

        if (! empty($_GET)) {
            $this->params += $_GET;
        }

        if (! empty($_POST)) {
            $this->params += $_POST;
        }

        if (! empty($_COOKIE)) {
            $this->params += $_COOKIE;
        }
    }
}