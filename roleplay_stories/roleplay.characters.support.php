<?php
    $supportRole = "Supporting";
    $support = $connection->prepare(
        "SELECT * FROM roleplay_characters JOIN characters USING(character_id) 
        WHERE roleplay_id=:id AND role=:role AND active=1");
    $support->bindParam("id", $id);
    $support->bindParam("role", $supportRole);
    $support->execute();
    $supportRow = $support->fetchAll();
?>