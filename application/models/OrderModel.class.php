<?php
class OrderModel

{
    public function listAll()
    {
        $database = new Database();

        $sql = 'SELECT * FROM `order`';
        
        return $database->query($sql,[]);
    }
    
    public function orderLine($orderId)
    {
        $database = new Database();
        $sql = 'SELECT * FROM `orderline` INNER JOIN meal
        ON meal.Id=orderline.Meal_Id WHERE `Order_Id`=? ';

        return $database->query($sql,[$orderId]);
    }

    public function listMeals()
    {
        $database = new Database();

        $sql = 'SELECT * FROM `meal`';
        
        return $database->query($sql,[]);
    }

    public function addOrder($items)
    {
        
       // var_dump($items);die;
        $database = new Database();
        $userSession = new UserSession();
        
        $sql = 'INSERT INTO `order`(`User_Id`,  `TaxRate`, `CreationTimestamp`) VALUES (?,20,NOW())';
        $orderId = $database->executeSql($sql, [$userSession->getId()]); 


        $totalAmount = 0;
        foreach($items as $item)
        {
            $sql3 = 'INSERT INTO `orderline`(`QuantityOrdered`, `Meal_Id`, `Order_Id`, `PriceEach`) VALUES (?,?,?,?)';
            $database->executeSql($sql3, [$item['quantity'], $item['id'],$orderId , $item['price']]); 
            $totalAmount += $item['quantity']*$item['price'];
        }

        $taxAmount = $totalAmount * 0.2;


        $sql2 = "UPDATE `order` SET `TotalAmount`=?,`TaxAmount`=?,`CompleteTimestamp`=Now() WHERE Id = ?";
        $database->executeSql($sql2,[$totalAmount,$taxAmount,$orderId ]);

        return $orderId;
    }

    public function getOrder($orderId)
    {
        $database = new Database();
        $sql = 'SELECT * FROM `order` WHERE `Id`=? ';

        return $database->queryOne($sql,[$orderId]);
    }


}