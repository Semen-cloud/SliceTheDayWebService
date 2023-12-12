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
            $result = $this->db()->Auth([
                'email' => $this->request()->input('authEmail'),
                'password'=> hash("sha256", $this->request()->input('authPassword')), 
            ]);
            if(is_array($result))
            {
                $this->session()->set('Auth', true);
                $this->session()->set('idAuth', $result[0]);
                $this->session()->set('emailAuth', $result[1]);
                $this->session()->set('loginAuth', $result[2]);
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

    public function logout() {
        if($this->session()->has('Auth'))
            $this->session()->remove('Auth');
        $this->redirect('/');
    }
}