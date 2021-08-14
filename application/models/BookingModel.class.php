<?php

class BookingModel
{
    public function create($date, $time, $seats, $userId)
    {
        $database = new Database();

        $sql = 'INSERT INTO booking (BookingDate,BookingTime,NumberOfSeats,User_Id,CreationTimestamp) 
        VALUES(?,?,?,?,NOW())';
        
        $database->executeSql($sql, [$date, $time, $seats, $userId]);      
    }
}