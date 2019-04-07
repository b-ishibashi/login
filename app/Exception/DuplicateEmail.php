<?php

namespace App\Exception;

class DuplicateEmail extends \Exception {

    protected $message = 'Duplicate Email!';
}