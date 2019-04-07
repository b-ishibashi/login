<?php

namespace App\Http\Controller;

use App\Model\User;
use App\Exception\EmptyPost;
use App\Exception\UnmatchEmailOrPassword;

class Login extends \App\Http\Controller {

    private $request;

    public function run()
    {
        if ($this->isLoggedIn())
        {
            header('Location: /');
        }
    }

    public function postProcess($request)
    {
        try {

            $this->request = $request;

            // validate
            $this->validate();
        } catch (EmptyPost $e) {
            $this->setErrors('login', $e->getMessage());
        }

        $this->setValues('email' , $this->request['email']);

        if ($this->hasError())
        {
            return;
        } else {

            // login
            try {
                $userModel = new User();
                $user = $userModel->login([
                    'email' => $request['email'],
                    'password' => $request['password']
                ]);
            } catch (UnmatchEmailOrPassword $e) {
                $this->setErrors('login', $e->getMessage());
                return;
            }

        }

        //login処理
        session_regenerate_id(true);
        $_SESSION['me'] = $user;

        // redirect to home
        header('Location: /');
    }

    private function validate()
    {
        if (!isset($this->request['token']) || $this->request['token'] !== $_SESSION['token'])
        {
            echo 'Invalid token!';
            exit;
        }

        if (!isset($this->request['email']) || !isset($this->request['password']))
        {
            echo 'Invalid form!';
            exit;
        }

        if ($this->request['email'] === '' || $this->request['password'] === '')
        {
            throw new EmptyPost();
        }
    }
}