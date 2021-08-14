<?php

class OrderController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        
        if($userSession->isAuthentificated()!=true )
            $http->redirectTo('/user/login');

       $order = new OrderModel();
       $meals = $order->listMeals();

       return
       [
           'meals' => $meals
       ];
    }
}