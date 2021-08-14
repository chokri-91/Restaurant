<?php

class ValidationController
{

    public function httpPostMethod(Http $http, array $formFields)
    {      
      
        $userSession = new UserSession();
        
        if($userSession->isAuthentificated()== false || array_key_exists('items',$formFields) == false)
        {
            $http->sendJsonResponse(null);    
        }

        else
        {
            $orderModel = new OrderModel();
            $orderId = $orderModel->addOrder($formFields["items"]);
            
            $http->sendJsonResponse($orderId);
        }
        
    }
}