<?php
class UserModel

{
    public function signUp($name, $lastName, $birthDate, $adress, $city, $zipCode,$country,$phoneNumber,$mail,$password)
    {
        $database = new Database();
        
        $sql2 = 'SELECT * FROM `user` WHERE `Email`=?';
        $sql2 = $database->queryOne($sql2,[$mail]);
        
        if(!empty($sql2))
        {
            throw new Exception ('email already exist');
        }
        
    
        $sql = 'INSERT INTO user (`FirstName`, `LastName`, `BirthDate`, `Address`, `City`, `ZipCode`, `Country`, `Phone`, `Email`, `Password`,`CreationTimestamp`,LastLoginTimestamp) 
        VALUES(?,?,?,?,?,?,?,?,?,?, NOW(), NOW())';
        
        $sql = $database->executeSql($sql, [$name, $lastName, $birthDate, $adress, $city, $zipCode,$country,$phoneNumber,$mail,$password]);    
    }
    
    public function findWithEmailPassword($mail,$password)
    {
        $database = new Database();
        
        $sql = 'SELECT * FROM `user` WHERE `Email`=?';
        $user = $database->queryOne($sql,[$mail]);

        //print_r($user); die();
        
        if(empty($user))
        {
            throw new Exception ('E-mail ou mot de passe incorrect');
        }
        
        
        if (!password_verify($password,$user['Password'] )) {

            throw new Exception ('E-mail ou mot de passe incorrect');
        }
       return $user;
    }

    public function UpdateLastLogin($userId)
    {
        $database = new Database();
        $sql = 'UPDATE `user` SET `LastLoginTimestamp`=NOW()
        WHERE Id=?';
        $database->executeSql($sql,[$userId]);
    }

    public function users($userId) ///////////// afficher liste users dans admin/user //////////
    {
        $database = new Database();
        $sql = 'SELECT * FROM `user` WHERE Id!=?';
        $usersList = $database->query($sql, [$userId]);

        return $usersList;
    }

    public function deleteUser($Id)
    {
        $database = new Database();
        $sql ='DELETE FROM `user` WHERE Id= ?';

       $database->executeSql($sql,[$Id]);

    }

    public function switchUser($Id)
    {
        $database = new Database();
        $sql ="UPDATE `user` SET `Admin`= 1 WHERE Id IN ($Id)";

        $database->executeSql($sql);
        $sql ="UPDATE `user` SET `Admin`= 0 WHERE Id NOT IN ($Id)";

        $database->executeSql($sql);
    }

    public function findUser($userId) ///////////// afficher liste users dans admin/user //////////
    {
        $database = new Database();
        $sql = 'SELECT * FROM `user` WHERE Id=?';
        $user = $database->queryOne($sql, [$userId]);

        return $user;
    }
}