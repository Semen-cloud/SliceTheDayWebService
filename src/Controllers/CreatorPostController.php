<?php

namespace App\Controllers;

include_once (APP_PATH . "/kernel/Controller/Controller.php");

use App\kernel\Controller\Controller;

class CreatorPostController extends Controller
{
    public function createNew() {
        if($this->request()->validate([
            'newVotingTitle' => ['required', 'min:3', 'max:30'],
            'newVotingExpirationDate' => ['required', 'min:9'],
        ])) {
            $index = 1;
            while(!empty($this->request()->input('newTitle' . $index)) && !empty($this->request()->input('newDescription' . $index))){
                if(!$this->request()->validate([
                    'newTitle' . $index => ['required', 'min:3', 'max:20'],
                    'newDescription' . $index => ['required', 'min:3'],
                ])){
                    $this->session()->set('variantsValidationFailed', $index);
                    $this->redirect('/creator/newVoting');
                }
                $index++;
            }

            $insertedId = $this->db()->insert('voting', [
                'Title' => $this->request()->input('newVotingTitle'),
                'Description' => $this->request()->input('newVotingDescription'),
                'CreateDate' => date('Y-m-d'),
                'ExpirationDate' => $this->request()->input('newVotingExpirationDate'),
                'isAvailable' => true,
            ]);
            $index = 1;
            while(!empty($this->request()->input('newTitle'. $index)) && !empty($this->request()->input('newDescription'. $index))) {
                $this->db()->insert('variants', [
                    'VotingId'=> $insertedId,
                    'Title'=> $this->request()->input('newTitle'. $index),
                    'Description'=> $this->request()->input('newDescription'. $index),
                ]);
                $index++;
            }
        }
        else {
            $this->session()->set('votingValidationFailed', true);
        }

        $this->redirect('/creator/newVoting');
    }
}