<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');

use App\kernel\Controller\Controller;

class GetController extends Controller{
    public function default() {
        $this->view('default');
    }

    public function personalArea() {
        if($this->session()->get('userIsAdmin')) {
            $this->redirect('/admin/personalArea');
        }
        else {
            $this->view('personalArea');
        }
    }

    public function votings() {
        $res = $this->db()->availableVotings();

        $this->session()->set('votings', $res);
        $this->view('votings');
    }

    public function oneVoting() {
        $res = $this->db()->votingInfo($this->request()->input('idOfVoting'), $this->session()->get('userId'));
        $this->session()->set('votingInfo', $res);
        $this->view('oneVoting');
    }

    public function pastVotings() {
        $res = $this->db()->pastVotings();
        $this->session()->set('pastVotings', $res);
        $this->view('pastVotings');
    }
}