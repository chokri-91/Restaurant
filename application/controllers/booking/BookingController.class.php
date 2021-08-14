<?php

class BookingController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
		$userSession = new UserSession();
		if($userSession->isAuthentificated()==false)
        {
            $http->redirectTo('/');
        }
    	
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $booking = new BookingModel();
        
        $date = $formFields['year'].'-'.$formFields['month'].'-'.$formFields['day'];
        $time = $formFields['hour'].':'.$formFields['minutes'];

		$now = date_create();
		$bookingDate = date_create($date);

		if(date_diff($now,$bookingDate)->format('%a') <= 2)
		{
			return
			[
				'errorMessage'	=>	'La réservation doit être dans 2 jours d\'avance!'
			];
		}

        $booking->create($date,$time,$formFields['seats'],21);

		$flashbag = new FlashBag();

		$flashbag->add('Votre réservation a bien été enregistrée');

		$http->redirectTo('/');
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}