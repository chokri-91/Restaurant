<?php
class MealModel

{
    public function listAll()
    {
        $database = new Database();

        $sql = 'SELECT * FROM `meal`';
        
        return $database->query($sql,[]);
    }

    public function deleteMeal($meal)
    {
        $database = new Database();
        $sql ="DELETE FROM `meal` WHERE Id IN ($meal)";

        $database->executeSql($sql);
    }
    
    public function addMeal($name,$photo,$description,$quantity,$buyPrice,$salePrice)
    {
        $database = new Database();
        $sql ='INSERT INTO `meal`(`Name`, `Photo`, `Description`, `QuantityInStock`, `BuyPrice`, `SalePrice`) VALUES (?,?,?,?,?,?)';
        
        $database->executeSql($sql, [$name,$photo,$description,$quantity,$buyPrice,$salePrice]);
    }

    public function getMeal($Id)
    {
        $database = new Database();
        $sql = 'SELECT * FROM `meal` WHERE Id=?';
        
        return $database->queryOne($sql,[$Id]);
    }
}


