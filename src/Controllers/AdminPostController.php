<?php

namespace App\Controllers;

include_once (APP_PATH . "/kernel/Controller/Controller.php");

use App\kernel\Controller\Controller;

class AdminPostController extends Controller
{
    public function blockVoting() : void {
        $id = $this->request()->input('deletingVotingId');
        $this->db()->blockVoting($id);
        $this->redirect('/admin/personalArea');
    }

    public function makeCreator() : void {
        $id = $this->request()->input('userId');
        $this->db()->addUserCreatorRights(intval($id), 5);
        $this->redirect('/admin/personalArea');
    }
}