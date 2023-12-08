<?php

namespace App\kernel\Container;

include_once(APP_PATH . '/kernel/Http/Request.php');
include_once(APP_PATH . '/kernel/Router/Router.php');
include_once(APP_PATH . '/kernel/View/View.php');
include_once(APP_PATH . '/kernel/Validator/Validator.php');
include_once(APP_PATH . '/kernel/Http/Redirect.php');
include_once(APP_PATH . '/kernel/Session/Session.php');
include_once(APP_PATH . '/kernel/Config/Config.php');
include_once(APP_PATH . '/kernel/Database/Database.php');
include_once(APP_PATH . '/kernel/Http/RequestInterface.php');
include_once(APP_PATH . '/kernel/Router/RouterInterface.php');
include_once(APP_PATH . '/kernel/View/ViewInterface.php');
include_once(APP_PATH . '/kernel/Validator/ValidatorInterface.php');
include_once(APP_PATH . '/kernel/Http/RedirectInterface.php');
include_once(APP_PATH . '/kernel/Session/SessionInterface.php');
include_once(APP_PATH . '/kernel/Config/ConfigInterface.php');
include_once(APP_PATH . '/kernel/Database/DatabaseInterface.php');

use App\kernel\Http\Request;
use App\kernel\Router\Router;
use App\kernel\View\View;
use App\kernel\Validator\Validator;
use App\kernel\Http\Redirect;
use App\kernel\Session\Session;
use App\kernel\Config\Config;
use App\kernel\Database\Database;
use App\kernel\Http\RequestInterface;
use App\kernel\Router\RouterInterface;
use App\kernel\View\ViewInterface;
use App\kernel\Validator\ValidatorInterface;
use App\kernel\Http\RedirectInterface;
use App\kernel\Session\SessionInterface;
use App\kernel\Config\ConfigInterface;
use App\kernel\Database\DatabaseInterface;

class Container {
    public readonly RequestInterface $request;
    public readonly RouterInterface $router;
    public readonly ViewInterface $view;
    public readonly ValidatorInterface $validator;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly ConfigInterface $config;
    public readonly DatabaseInterface $database;

    public function __construct() {
        $this->registerServices();
    }

    private function registerServices() : void {
        $this->request = Request::createFromGlobals();
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
        $this->redirect = new Redirect();
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->router = new Router($this->view, $this->request, $this->redirect, $this->session, $this->database);
    }
}