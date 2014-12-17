<?php

namespace CeisSurvey\Bundle\UsersBundle\Entity;

class Person {
    
    protected $username;
    protected $password;
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }


    
    
}
