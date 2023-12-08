<?php

namespace App\kernel\Controller;

include_once (APP_PATH . '/kernel/View/ViewInterface.php');
include_once (APP_PATH . '/kernel/Http/RequestInterface.php');
include_once(APP_PATH . '/kernel/Http/RedirectInterface.php');
include_once(APP_PATH . '/kernel/Session/SessionInterface.php');
include_once(APP_PATH . '/kernel/Database/DatabaseInterface.php');

use App\kernel\View\ViewInterface;
use App\kernel\Http\RequestInterface;
use App\kernel\Http\RedirectInterface;
use App\kernel\Session\SessionInterface;
use App\kernel\Database\DatabaseInterface;

abstract class Controller 
{
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;

    public function view(string $name) : void {
        $this->view->page($name);
    }

    public function setView(ViewInterface $view) : void {
        $this->view = $view;
    }

    public function request() : RequestInterface {
        return $this->request;
    }

    public function setRequest(RequestInterface $request) : void {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect) : void {
        $this->redirect = $redirect;
    }

    public function redirect($url) : void {
        $this->redirect->to($url);
    }

    public function session() : SessionInterface {
        return $this->session;
    }

    public function setSession(SessionInterface $session) : void {
        $this->session = $session;
    }

    public function db() : DatabaseInterface {
        return $this->database;
    }

    public function setDatabase(DatabaseInterface $database) : void {
        $this->database = $database;
    }
}