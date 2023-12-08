<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');

use App\kernel\Controller\Controller;

class GetController extends Controller{
    public function default() {
        $this->view('default');
    }

    public function personalArea() {
        $this->view('personalArea');
    }
    public function teamBoard() {
        echo "voting list";
    }

    public function otherPersonalArea() {
        echo "list of past";
    }

    public function newTasks() {
        echo "list of past";
    }
}