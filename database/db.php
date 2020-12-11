<?php
try {
    $username = 'u5830416_addid';
    $password = 'IotR[cnHkS&a';
    // first connect to database with the PDO object. 
    $connection = new \PDO('mysql:host=localhost;dbname=u5830416_roleplayverse;', $username, $password, [
      PDO::ATTR_EMULATE_PREPARES => false, 
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]); 
} 
catch(\PDOException $e){
    echo "Error connecting to mysql: " . $e->getMessage();
}
?>