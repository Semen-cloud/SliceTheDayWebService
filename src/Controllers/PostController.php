<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');
include_once(APP_PATH . '/kernel/Utils/Utils.php');

use App\kernel\Controller\Controller;
use App\kernel\Utils\Utils;

class PostController extends Controller{
    public function register() {
        if($this->request()->validate([
            'registerLogin' => ['required', 'min:3', 'max:15'],
            'registerEmail' => ['required', 'email'],
            'passwordFirst' => ['required', 'min:6', 'max:15']
        ]))
        {
            if($this->request()->input('passwordSecond') === $this->request()->input('passwordFirst')){
                if(!$this->db()->register([
                    'login' => $this->request()->input('registerLogin'),
                    'email' => $this->request()->input('registerEmail'),
                    'password'=> hash("sha256", $this->request()->input('passwordFirst')),
                ]))
                {
                    $this->session()->set('userExist', true);
                    $this->session()->set('registerModal', true);
                }
            }
            else
            {
                $this->session()->set('notSamePass', true);
                $this->session()->set('registerModal', true);
            }
        }
        else 
        {
            $this->session()->set('validationFailed', true);

            $this->session()->set('login', $this->request()->input('registerLogin'));
            $this->session()->set('email', $this->request()->input('registerEmail'));
            $this->session()->set('registerModal', true);
        }
        $this->redirect('/');
    }

    public function authOfUser() {
        if($this->request()->validate([
            'authEmail' => ['required', 'email'],
            'authPassword'=> ['required', 'min:3', 'max:15'],
        ]))
        {
            echo hash("sha256", $this->request()->input('authPassword'));
            $result = $this->db()->Auth([
                'email' => $this->request()->input('authEmail'),
                'password'=> hash("sha256", $this->request()->input('authPassword')), 
            ]);
            if(is_array($result))
            {
                Utils::addUserDataToSession($this->session(), $result);
            }
            else
            {
                $this->session()->set('authDataCheckFailed', true);
                $this->session()->set('modalAuth', true);
            }
        }
        else
        {
            $this->session()->set('authDataCheckFailed', true);
            $this->session()->set('modalAuth', true);
        }
        $this->redirect('/');
    }

    public function logout() : void {
        if($this->session()->has('Auth'))
            $this->session()->remove('Auth');
        $this->redirect('/');
    }

    public function voteFor() : void{
        $id = $this->request()->input('idVoteFor');
        echo $this->session()->get('userId') . " => userId";
        echo "voteFor " . $this->request()->input('idVoteFor');
        $this->db()->insert('votes', [
            'UserId' => $this->session()->get('userId'),
            'VariantId' => $this->request()->input('idVoteFor'),
        ]);
        $this->redirect('/votings');
    }

    public function updateData() : void {
        if($this->request()->validate([
            'loginForUpdate'=> ['required', 'min:3', 'max:15'],
        ])) {
            $this->db()->update(['login' => $this->request()->input('loginForUpdate')], $this->session()->get('userId'));
        } else {
            $this->session()->set('validationFailed', true);
            $this->redirect('/personalArea');
        }

        if($this->request()->validate([
            'passForUpdate'=> ['required', 'min:3', 'max:15'],
        ])) {
            $this->db()->update(['password' => hash("sha256", $this->request()->input('loginForUpdate'))], $this->session()->get('userId'));
        } else {
            $this->session()->set('passwordValidationFailed', true);
            $this->redirect('/personalArea');
        }
    }
}