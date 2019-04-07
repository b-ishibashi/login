<?php

namespace App\Http\Controller;

use App\Model\User;

class Index extends \App\Http\Controller {

    public function run()
    {
        if (!$this->isLoggedIn())
        {
            header('Location: /login.php');
        }

        $userModel = new User();
        $this->setValues('users', $userModel->findAll());
    }
}