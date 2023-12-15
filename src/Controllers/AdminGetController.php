<?php

namespace App\Controllers;

include_once (APP_PATH . "/kernel/Controller/Controller.php");

use App\kernel\Controller\Controller;

class AdminGetController extends Controller
{
    public function personalAreaAdmin() : void {
        $this->session()->set('allUsers', $this->db()->allUsers());
        $this->session()->set('allVotings', $this->db()->allVotings());
        $this->view('admin/adminPersonalArea');
    }
}