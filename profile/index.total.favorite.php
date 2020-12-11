<?php 
        $totalFavorite = $connection->prepare(
            "SELECT COUNT(favorite_id) as total_favorite FROM characters 
            JOIN favorites USING(character_id) WHERE author=:id GROUP BY author 
            ");
        $totalFavorite->bindParam("id", $id);
        $totalFavorite->execute();
        $totalFavorited = $totalFavorite->fetch();
        
        
?>