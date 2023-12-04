<?php

namespace App\kernel\Controller;

include_once (APP_PATH . '/kernel/View/View.php');
include_once (APP_PATH . '/kernel/Http/Request.php');

use App\kernel\View\View;
use App\kernel\Http\Request;

abstract class Controller {
    private View $view;
    private Request $request;

    public function view(string $name) : void {
        $this->view->page($name);
    }

    public function setView(View $view) : void {
        $this->view = $view;
    }

    public function request() : Request {
        return $this->request;
    }

    public function setRequest(Request $request) : void {
        $this->request = $request;
    }
}