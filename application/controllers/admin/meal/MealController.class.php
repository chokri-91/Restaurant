<?php

class MealController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
       $meals = new MealModel();
       $mealsList = $meals->listAll();

       $userSession = new UserSession();
       if($userSession->getAdmin()==false)
       {
           $http->redirectTo('/'); exit();
       }

       return
       [
           'mealsList' => $mealsList
       ];
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {   
        $meals = new MealModel();

        if(isset($formFields['checkMeal']))
        {
            $mealId = join(',',$formFields['checkMeal']);
            
            $meals->deleteMeal($mealId);
           
        }

        elseif(isset($formFields['nom']))
        {
            $photo = $http->moveUploadedFile('photo', '/images/meals');

            
            if(empty($photo))
            {
                $photo = 'no-photo.png';
            }
            
            $meals->addMeal($_POST['nom'],$photo ,$_POST['description'],$_POST['stock'],$_POST['achat'],$_POST['vente'] );
        }

        $http->redirectTo("/admin/meal");
        
    }
}