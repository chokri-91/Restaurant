<?php

class UserController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
       

        return 
        [
            '_form' => new UserForm()
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        try
        {
            $user= new UserModel();

            //print_r($formFields); exit();

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
            '_form' => $formField
            ];
        
        }
    
    }
}