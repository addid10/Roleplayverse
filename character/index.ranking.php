<?php
    $rank = $connection->prepare(
    "SELECT * FROM (
        SELECT s.*, @rank := @rank + 1 rank FROM (
          SELECT character_id, (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) score 
          FROM characters_rate
          GROUP BY character_id
        ) s, (SELECT @rank := 0) init
        ORDER BY score DESC
      ) r
    WHERE character_id=:id "); 
    $rank->bindParam('id', $id);
    $rank->execute();
    $ranking = $rank->fetch();
?>