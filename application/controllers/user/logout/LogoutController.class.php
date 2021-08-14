<?php

class LogoutController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        $userSession->closeSession();

        $http->redirectTo('/');
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        
    }
}