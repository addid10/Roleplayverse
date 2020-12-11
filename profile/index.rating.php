<?php 
        $rate = $connection->prepare(
            "SELECT * FROM characters_rate JOIN characters USING(character_id) 
            WHERE users_id=:id AND active=1
            ORDER BY character_fullname ASC
            ");
        $rate->bindParam("id", $id);
        $rate->execute();
        $myRating = $rate->fetchAll();

        $noRating = 1;
        
?>