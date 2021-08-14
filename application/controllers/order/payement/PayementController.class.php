<?php

class PayementController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $userSession = new UserSession();
        $userModel = new UserModel();
        $userId = $userSession->getId();
        $user = $userModel->findUser($userId);

        $orderModel = new OrderModel();
        $order = $orderModel->getOrder($queryFields['id']);

        $orderLine = $orderModel->orderLine($queryFields['id']);

        // print_r($order);
        // exit();

        return
        [
            'user'=> $user,
            'order'=> $order,
            'orderLine'=> $orderLine
        ];
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {      
        // integer le module de paiement

        //rediriger vers la page de succes de paiement
        $http->redirectTo('/order/payement/success');        
    }
}