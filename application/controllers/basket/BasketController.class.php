<?php

class BasketController
{

    public function httpGetMethod(Http $http, array $queryFields)
    {
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        //print_r($formFields); die;
        if(array_key_exists('panier',$formFields) == false)
        {
            $basketItems = [];
        }
        else
        {
            $basketItems = $formFields['panier'];
        }

        return
        [
            'items' => $basketItems,
            '_raw_template' => true
        ];
    }
}