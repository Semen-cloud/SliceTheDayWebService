<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');

use App\kernel\Controller\Controller;

class HomeController extends Controller{
    public function index() : void {
        $this->view('default');
    }
}