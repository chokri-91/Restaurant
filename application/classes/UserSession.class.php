<?php

class UserSession
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function addToSession(array $user)
    {
            $_SESSION['user'] = 
            [
                'Id'=> $user['Id'],
                'Email'=> $user['Email'],
                'FirstName'=> $user['FirstName'],
                'LastName'=> $user['LastName'],
                'Admin'=> $user['Admin']
            ];
    }

    public function isAuthentificated()
    {
        if(!array_key_exists('user',$_SESSION))
        {
            return False;
        }

        else
        {
            return true;
        }
    }

  
    public function closeSession()
    {
        session_destroy();
    }

    public function getId()
    {
        if($this->isAuthentificated())
            return $_SESSION['user']['Id'];
        return false;
    }

    public function getFirstName()
    {
        if($this->isAuthentificated())
            return $_SESSION['user']['FirstName'];
        return false;
        }

    public function getLastName()
    {
        if($this->isAuthentificated())
            return $_SESSION['user']['LastName'];
        return false;
    }

    public function getEmail()
    {
        if($this->isAuthentificated())
            return $_SESSION['user']['Email'];
        return false;
    }

    public function getAdmin()
    {
        if($this->isAuthentificated())
            return $_SESSION['user']['Admin'];
        return false;
    }

}