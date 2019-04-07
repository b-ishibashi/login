<?php

namespace App\Model;

use App\Exception\DuplicateEmail;
use App\Exception\UnmatchEmailOrPassword;


class User extends \App\Model {

    public function create($values)
    {
        $stmt = $this->db->prepare("insert into users (email, password, created, modified) values (:email, :password, now(), now())");
        $res = $stmt->execute([
            ':email' => $values['email'],
            ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
        ]);

        if ($res === false)
        {
            throw new DuplicateEmail();
        }
    }

    public function login($values)
    {
        $stmt = $this->db->prepare("select * from users where email = :email");
        $stmt->execute([
            ':email' => $values['email'],
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $user = $stmt->fetch();

        if (empty($user))
        {
            throw new UnmatchEmailOrPassword();
        }

        if (!password_verify($values['password'], $user->password))
        {
            throw new UnmatchEmailOrPassword();
        }

        return $user;
    }

    public function findAll()
    {
        $stmt = $this->db->query("select * from users order by id");
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $stmt->fetchAll();
    }
}