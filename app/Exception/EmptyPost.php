<?php

namespace App\Exception;

class EmptyPost extends \Exception {

    protected $message = 'Please enter Email/Password';
}