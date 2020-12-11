<?php
session_start();
if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require('../database/db.php');

    if(isset($_POST['username'])) {
        if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
            $username  = strtolower($_POST['username']);
            $statement = $connection->prepare("SELECT COUNT(username) from users where username=:username");
            $statement->bindParam("username", $username);
            $statement->execute();
            $count = $statement->fetchColumn();
    
            if($count == "1"){
                echo "Username sudah digunakan!";
            }
            else{
                echo "Terlihat bagus!";
            }
        } else {
            echo "Tidak boleh menggunakan spasi dan karakter spesial lainnya!";
        }
    }
}

