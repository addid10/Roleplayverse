<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require('../database/db.php');
    if(isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['message'])) {
        
        $fullname  = $_POST['fname'];
        $email     = $_POST['email'];
        $message   = $_POST['message'];
        
                
        $add = $connection->prepare(
            "INSERT INTO messages (name, email, messages) 
            VALUES (:name, :email, :message)"
        );
    
        $add->bindParam("name", $fullname);
        $add->bindParam("email", $email);
        $add->bindParam("message", $message);

        $add->execute();
    }
}

?>