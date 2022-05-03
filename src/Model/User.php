<?php

namespace App\Model;

class User extends Model
{
    public $id;

    public $username;

    public $email;

    public $password;


    public function getUsername()
    {
        return $this->username;
    }



    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = $password;
    }

    // the name of your model (and table)
    public static function getName() : string
    {
        return "user";
    }

}
