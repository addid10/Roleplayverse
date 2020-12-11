<?php
    $mainRole = "Main";
    $main = $connection->prepare(
        "SELECT * FROM roleplay_characters JOIN characters USING(character_id) 
        WHERE roleplay_id=:id AND role=:role AND active=1");
    $main->bindParam("id", $id);
    $main->bindParam("role", $mainRole);
    $main->execute();
    $mainRow = $main->fetchAll();
?>