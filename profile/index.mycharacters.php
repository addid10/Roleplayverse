<?php 
        $myCharacters = $connection->prepare(
            "SELECT * FROM (
                SELECT s.*, @rank := @rank + 1 rank FROM (
                    SELECT *, (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) score FROM characters
                    LEFT JOIN characters_rate USING(character_id) GROUP BY character_id ORDER BY character_id
                ) s, (SELECT @rank := 0) init
                ORDER BY score DESC
            ) r 
            WHERE author=:id AND active=1
            ");
        $myCharacters->bindParam("id", $id);
        $myCharacters->execute();
        $characters = $myCharacters->fetchAll();
        
?>