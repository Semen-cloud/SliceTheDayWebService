<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');

use App\kernel\Controller\Controller;

class NewVotingController extends Controller{
    public function index() : void {
        $this->view('admin/newVoting');
    }

    public function createNew() : void {
        var_dump($_POST);
        echo("create new function");
    }
}