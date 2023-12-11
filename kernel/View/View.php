<?php

namespace App\kernel\View;

include_once (APP_PATH . "/kernel/Session/SessionInterface.php");
include_once (APP_PATH . "/kernel/View/ViewInterface.php");

use App\kernel\Session\SessionInterface;
use App\kernel\View\ViewInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
    ){}

    public function page(string $name) : void {
        $viewPath = APP_PATH . "/views/pages/$name.php";
        if(!file_exists($viewPath)) {
            echo "Page $name not found";
            return;
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    public function component(string $name) : void {
        $viewPath = APP_PATH . "/views/components/$name.php";
        if(!file_exists($viewPath)) {
            echo "Component $name not found";
            return;
        }

        include_once $viewPath;
    }

    private function defaultData() : array {
        return [
            'view' => $this,
            'session' => $this->session
        ];
    }

}