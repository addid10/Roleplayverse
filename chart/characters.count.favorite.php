<?php
    //Check Favorite
    if(isset($_SESSION['userAccountId'])){
        function check_favorite($id) {
            require('../database/db.php');
            $user = $_SESSION['userAccountId'];
            $favorite = $connection->prepare(
                "SELECT COUNT(favorite_id) as favorited FROM characters LEFT JOIN favorites USING(character_id)
                WHERE character_id=:id AND users_id=:user;
            ");
    
            $favorite->bindParam("id", $id);
            $favorite->bindParam("user", $user);
            $favorite->execute();
            $favorited = $favorite->fetchColumn();

            return $favorited;
        }
    } 
?>