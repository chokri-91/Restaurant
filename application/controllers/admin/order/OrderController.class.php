<?php

class OrderController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
       
        $userSession = new UserSession();
        if($userSession->getAdmin()==false)
        {
            $http->redirectTo('/'); exit();
        }

        $dataOrders = new OrderModel();

        $orders=$dataOrders->listAll();
        $orderDetails= $dataOrders->orderLine($queryFields['id']);
        //print_r($orderDetails); die();


        return 
        ['_form' => new UserForm(),
        'orders' => $orders,
        'orderDetails' => $orderDetails
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {      
    
    }
}