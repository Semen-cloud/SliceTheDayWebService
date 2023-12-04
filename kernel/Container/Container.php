<?php

namespace App\kernel\Container;

include_once(APP_PATH . '/kernel/Http/Request.php');
include_once(APP_PATH . '/kernel/Router/Router.php');
include_once(APP_PATH . '/kernel/View/View.php');

use App\kernel\Http\Request;
use App\kernel\Router\Router;
use App\kernel\View\View;

class Container {
    public readonly Request $request;
    public readonly Router $router;
    public readonly View $view;

    public function __construct() {
        $this->registerServices();
    }

    private function registerServices() : void {
        $this->request = Request::createFromGlobals();
        $this->view = new View();
        $this->router = new Router($this->view, $this->request);
    }
}