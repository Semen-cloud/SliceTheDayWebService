<?php

namespace App\kernel;

include_once (APP_PATH . '/kernel/Container/Container.php');

use App\kernel\Container\Container;

class App {

    private Container $container;

    public function __construct() {
        $this->container = new Container();
    }

    public function run() : void 
    {
        $this->container
            ->router
            ->dispatch(
                $this->container->request->uri(), 
                $this->container->request->method()
            );
    }
}