<?php

class Database{

public static $connection;

public static function setpConnection(){
    if(!isset(Database::$connection)){
        Database::$connection=new mysqli("localhost","root","ThisisMysqlPW123","eshop","3306");
    }
}

public static function iud($q){
    Database::setpConnection();
    Database::$connection->query($q);
}

public static function search($q){
    Database::setpConnection();
    $resultset = Database::$connection->query($q);
    return $resultset;
}

}
?>