<?php

namespace App\Exception;

class UnmatchEmailOrPassword extends \Exception {

    protected $message = 'Email/Password do not match!';
}