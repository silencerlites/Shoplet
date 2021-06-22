<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbh = new PDO('mysql:host=localhost;dbname=dbshoplet', 'uaView', 'viewpass');

$stmt = $dbh->prepare("SELECT * FROM tbl_users;");
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($rows as $row){
//     echo $row['usr_email'];
// }

?>