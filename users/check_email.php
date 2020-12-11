<?php
session_start();
if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require('../database/db.php');

    if(isset($_POST['email']))
    {

        $email = $_POST['email'];
        $statement = $connection->prepare("SELECT COUNT(email) from users where email= :email");
        $statement->bindParam("email", $email);
        $statement->execute();
        $count = $statement->fetchColumn();

        if($count==1){
            echo "Email sudah digunakan!";
        }
        else{
            echo "Terlihat bagus!";
        }
    }
}

