<?php
    $position = "Leader";
    $leader = $connection->prepare(
        "SELECT *, COUNT(*) as counts FROM affiliation_member JOIN characters USING(character_id)
        WHERE affiliation_id=:id AND position=:position AND active=1
    ");
    $leader->bindParam("id", $id);
    $leader->bindParam("position", $position);
    $leader->execute();
    $leaderRow = $leader->fetch();
?>