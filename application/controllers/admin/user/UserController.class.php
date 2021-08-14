<?php

class UserController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        if($userSession->getAdmin()==false)
        {
            $http->redirectTo('/'); exit();
        }

        ////////////aficher users dans admin/user//////////

        $users = new UserModel();
        
        if(isset($queryFields['id']))
        {
            $users->deleteUser($queryFields['id']);
        }

        $allUsers = $users->users($userSession->getId());
        

        return 
        ['_form' => new UserForm(),
        'allUsers' => $allUsers
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $user= new UserModel();
        $usersId = join(',',$formFields['checkAdmin']);
        
        $user->switchUser($usersId);
       
        $http->redirectTo("/admin/user");

        try
        {
            $user= new UserModel();

            $dateNaissance = $formFields['year']. '-'. $formFields['month']. '-'.$formFields['day'];
            $password = password_hash($formFields['password'],PASSWORD_DEFAULT);

            $user->signUp($formFields['nom'], $formFields['prenom'],$dateNaissance,$formFields['adress'],$formFields['ville'],$formFields['codePostal'],$formFields['pays'],$formFields['phoneNumber'],$formFields['mail'],$password);

            $flashbag = new FlashBag();

            $flashbag->add('Votre compte a été bien crée');

            $http->redirectTo('/');
        }

        catch(Exception $e)
        {
            $formField = new UserForm();
            $formField->bind($formFields);
            $formField->setErrorMessage($e->getMessage());

            $userSession = new UserSession();


            return
            [
            '_form' => $formField,
            'allUsers' => $allUsers
            ];
        
        }
    
    }
}