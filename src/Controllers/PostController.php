<?php

namespace App\Controllers;

include_once(APP_PATH . '/kernel/Controller/Controller.php');

use App\kernel\Controller\Controller;

class PostController extends Controller{
    public function register() {
        if($this->request()->validate([
            'registerLogin' => ['required', 'min:3', 'max:15'],
            'registerEmail' => ['required', 'email'],
            'passwordFirst' => ['required', 'min:6', 'max:15']
        ]))
        {
            if(!$this->db()->register([
                'login' => $this->request()->input('registerLogin'),
                'email' => $this->request()->input('registerEmail'),
                'password'=> $this->request()->input('passwordFirst'),
            ]))
            {
                $this->session()->set('userExist', true);
            }
        }
        else 
        {
            $this->session()->set('validationFailed', true);

            $this->session()->set('login', $this->request()->input('registerLogin'));
            $this->session()->set('email', $this->request()->input('registerEmail'));
            $this->session()->set('registerModal', true);
        }
        $this->redirect('/default');
    }

    public function authOfUser() {
        if($this->request()->validate([
            'authEmail' => ['required', 'email'],
            'authPassword'=> ['required', 'min:3', 'max:15'],
        ]))
        {
            $result = $this->db()->Auth([
                'email' => $this->request()->input('authEmail'),
                'password'=> $this->request()->input('authPassword'), 
            ]);
            if(is_array($result))
            {
                $this->session()->set('Auth', true);
                $this->session()->set('idAuth', $result[0]);
                $this->session()->set('emailAuth', $result[1]);
                $this->session()->set('loginAuth', $result[2]);
                $this->redirect('/personalArea');
            }
            else
            {
                $this->session()->set('authDataCheckFailed', true);
            }
        }
        else
        {
            $this->session()->set('authValidationFailed', true);
        }
    }
}