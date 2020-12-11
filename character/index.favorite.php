<?php
if(isset($_SESSION['userAccountId'])){
    
    $user = $_SESSION['userAccountId'];

    $favorite = $connection->prepare("SELECT COUNT(*) FROM favorites WHERE character_id=:id AND users_id=:user");
    $favorite->bindParam("id", $id);
    $favorite->bindParam("user", $user);
    $favorite->execute();
    $favorited = $favorite->fetchColumn();
        
}
?>