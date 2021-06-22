<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
   
class Connection{

    public static function Connect(){
        define('server','localhost');
        define('db_name','dbshoplet');
        define('user','uaView');
        define('password','viewpass');
        $options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4');
        
        try{
            $connection = new PDO("mysql:host=".server."; dbname=".db_name,user,password,$options);
            return $connection;
        }catch (PDOException $e){
            echo "Connection Error". $e->getMessage();
            exit();
        }
    }
}
?>
