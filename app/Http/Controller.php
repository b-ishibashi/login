<?php

namespace App\Http;

class Controller {

    private $error;
    private $value;

    public function __construct()
    {
        if (!isset($_SESSION['token']))
        {
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
        }

        $this->error = new \stdClass();
        $this->value = new \stdClass();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['me']) && !empty($_SESSION['me']);
    }

    protected function setErrors($key, $error)
    {
        $this->error->$key = $error;
    }

    public function getErrors($key)
    {
        return $this->error->$key ?? '';
    }

    protected function setValues($key, $value)
    {
        $this->value->$key = $value;
    }

    public function getValues()
    {
        return $this->value;
    }

    protected function hasError()
    {
        return !empty(get_object_vars($this->error));
    }

}