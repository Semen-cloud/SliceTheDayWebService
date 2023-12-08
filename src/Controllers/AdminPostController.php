<?php

namespace App\Controllers;

include_once (APP_PATH . "/kernel/Controller/Controller.php");

use App\kernel\Controller\Controller;

class AdminPostController extends Controller
{
    public function newTasks() {
        echo "newTasks";
    }

    public function patchTasks() {
        echo "deleteVoting";
    }

    public function deleteTask() {
        echo "deleteVoting";
    }

    public function addUserToTeam() {
        echo "deleteVoting";
    }
}