<?php

class LoginController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
       /* $userSession = new UserSession();
        if($userSession->isAuthentificated()==false)
        {
            $http->redirectTo('/user/login'); exit();
        }*/

        return 
        [
            '_form' => new LoginForm()
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        try
        {
            $userModel = new UserModel();

          
            $user = $userModel->findWithEmailPassword($formFields['email'], $formFields['password']);
            $userModel->UpdateLastLogin($user['Id']);

            $userSession = new UserSession();
            $userSession->addToSession($user);
            $http->redirectTo('/');

            // $flashbag = new FlashBag();
        
            // $flashbag->add($user['FirstName']);
            // $flashbag->add($user['LastName']);
            // $flashbag->add($user['Id']);
            // $flashbag->add($user['Email']);
            // $flashbag->add($user['Admin']);
        }

        catch(Exception $e)
        {
            $formField = new LoginForm();
            $formField->bind($formFields);
            $formField->setErrorMessage($e->getMessage());

            return ['_form' => $formField];
        }
    }
}