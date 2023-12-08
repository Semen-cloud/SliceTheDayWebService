<?php

namespace App\kernel\Router;
use App\kernel\Database\DatabaseInterface;

include_once(APP_PATH . '/kernel/Controller/Controller.php');
include_once(APP_PATH . '/kernel/View/ViewInterface.php');
include_once(APP_PATH . '/kernel/Http/RequestInterface.php');
include_once(APP_PATH . '/kernel/Http/RedirectInterface.php');
include_once(APP_PATH . '/kernel/Session/SessionInterface.php');
include_once(APP_PATH . '/kernel/Router/RouterInterface.php');
include_once(APP_PATH . '/kernel/Database/DatabaseInterface.php');

use App\kernel\Controller\Controller;
use App\kernel\View\ViewInterface;
use App\kernel\Http\RequestInterface;
use App\kernel\Http\RedirectInterface;
use App\kernel\Session\SessionInterface;
use App\kernel\Database\Database;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST'=> [],
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DatabaseInterface $database 
    ) {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method) : void {
        $route = $this->findRoute($uri, $method);
        if(!$route) {
            $this->notFound();
        }

        if(is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    private function notFound() : void {
        echo '404 | Not found';
        exit;
    }

    private function findRoute(string $uri, string $method) : Route | false {

        if(!isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function initRoutes() : void {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route; 
        }
    }

    /**
     * @return Route[]
     */

    private function getRoutes() {
        return require_once APP_PATH . '/config/routes.php';
    }
}