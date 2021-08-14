<?php

class MealController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $newMeal = new MealModel();
     
       $meal = $newMeal->getMeal($queryFields['id']);

      

       $http->sendJsonResponse($meal);
       print_r($queryFields);
    }
}