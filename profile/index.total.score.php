<?php 
        $avgRate = $connection->prepare(
            "SELECT AVG(rate) as rated FROM characters JOIN characters_rate USING(character_id) 
            WHERE author=:id GROUP BY author 
            ");
        $avgRate->bindParam("id", $id);
        $avgRate->execute();
        $avgRating = $avgRate->fetch();
        
?>