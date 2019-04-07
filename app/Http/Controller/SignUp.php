<?php

namespace App\Http\Controller;

use App\Exception\InvalidEmail;
use App\Exception\InvalidPassword;
use App\Model\User;
use App\Exception\DuplicateEmail;

class SignUp extends \App\Http\Controller {

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
        } catch (InvalidEmail $e) {
            $this->setErrors('email', $e->getMessage());
        } catch (InvalidPassword $e) {
            $this->setErrors('password', $e->getMessage());
        }

        $this->setValues('email' , $this->request['email']);

        if ($this->hasError())
        {
            return;
        } else {

            // create user
            try {
                $userModel = new User();
                $userModel->create([
                    'email' => $request['email'],
                    'password' => $request['password']
                ]);
            } catch (DuplicateEmail $e) {
                $this->setErrors('email', $e->getMessage());
                return;
            }

        }

        // redirect to login
        header('Location: /login.php');
    }

    private function validate()
    {
        if (!isset($this->request['token']) || $this->request['token'] !== $_SESSION['token'])
        {
            echo 'Invalid token!';
            exit;
        }

        if (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL))
        {
            throw new InvalidEmail();
        }

        if (!preg_match('/\A[a-zA-Z0-9]+\z/', $this->request['password']))
        {
            throw new InvalidPassword();
        }
    }
}