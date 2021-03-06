<?php

class AdminController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		$orderModel = new OrderModel();
		$orders = $orderModel->listAll();

		$userSession = new UserSession();
        if($userSession->getAdmin()==false)
        {
            $http->redirectTo('/'); exit();
        }

		return 
		[
			'orders' =>$orders
		];

    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
    }

}