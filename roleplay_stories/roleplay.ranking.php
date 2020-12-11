<?php
    $rank = $connection->prepare(
    "SELECT * FROM (
        SELECT s.*, @rank := @rank + 1 rank FROM (
          SELECT roleplay_name, roleplay_score, roleplay_id FROM roleplay
        ) s, (SELECT @rank := 0) init
        ORDER BY roleplay_score DESC
      ) r
    WHERE roleplay_id=:id;
    "); 
    $rank->bindParam('id', $id);
    $rank->execute();
    $ranking = $rank->fetch();
?>