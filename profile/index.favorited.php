<?php 
    if(isset($_GET['name'])){
        $favoriteList = $connection->prepare(
            "SELECT * FROM favorites JOIN characters USING(character_id) LEFT JOIN roleplay_characters USING(character_id) LEFT JOIN roleplay USING(roleplay_id) WHERE users_id=:id AND active=1
            GROUP BY character_id ORDER BY favorite_id ASC
        ");
        $favoriteList->bindParam("id", $id);
        $favoriteList->execute();
        $list = $favoriteList->fetchAll();
    
    
        function favorite_check($id) {
            require('../database/db.php');
            $check = $connection->prepare(
                "SELECT COUNT(*) FROM favorites WHERE users_id=:id
            ");
            $check->bindParam("id", $id);
            $check->execute();
            $checked = $check->fetchColumn();
    
            return $checked;
        }
    
        $checked = favorite_check($id);
    }

?>