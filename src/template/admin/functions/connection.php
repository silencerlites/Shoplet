<?php 

// class DBc {
//     private $servername;
//     private $username;
//     private $password;
//     private $dbname;
//     private $charset;


//  public function connect(){
//     $this->servername = "localhost";
//     $this->username = "uaAdministrator";
//     $this->password = "admins";
//     $this->dbname = "dbshoplet";
//     $this->charset = "utf8mb4";

//     try{
//         $dsn = "mysql:host=".$this->servername.";dbname=".$this->username.";chartset=".$this->charset.";";
//         $pdo = new PDO($dsn, $this->username, $this->password);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         return $pdo;
//     }catch (PDOException $e){
//         die('Sorry');
//         echo"Connection failed: ".$e->getMessage();
//     }
// }
// }



// $username = "uaAdministrator";
// $password = "admin";


// try{
//     $dsn = 'mysql:host=localhost;dbname=dbshoplet';
//     $con = new PDO($dsn, $username, $password);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo 'done';
//     return $con;
// }catch (PDOException $e){
//     echo"Connection failed: ".$e->getMessage();
// }

// $connection = new mysqli("localhost", "uaAdministrator", "admin", "dbshoplet");
// 		if($connection->connect_errno > 0){ die("Unable to connect: " . $connection->connect_error); }

// const USERNAME = "uaAdministrator";
// const PASSWORD = "admin";
// const DSN = "mysql:host=localhost;dbname=dbshoplet;charset=utf8mb4";

// try{
//     $conn = new PDO(DSN, USERNAME, PASSWORD);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
// } catch(PDOException $e){
//     echo "Error". $e->getMessage();
//     exit();
// }
    
class Connection{

    public static function Connect(){
        define('server','localhost');
        define('db_name','dbshoplet');
        define('user','uaAdministrator');
        define('password','admin');
        $options=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4');
        
        try{
            $connection = new PDO("mysql:host=".server."; dbname=".db_name,user,password,$options);
            return $connection;
        }catch (PDOException $e){
            echo "Connection Error". $e->getMessage();
            exit();
        }
    }

    // private $host = 'localhost';
    // private $dbName = 'dbshoplet';
    // private $user = 'root';
    // private $pass = '';

    // public function Connect()
    // {
    //     try
    //     {
    //         $conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //         return $conn;
    //     }
    //     catch(PDOException $e)
    //     {
    //         echo 'DATABASE Error:' . $e->getMessage();
    //     }

    // }
}
?>
