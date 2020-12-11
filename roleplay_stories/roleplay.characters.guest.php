<?php
    $guestRole = "Guest";
    $guest = $connection->prepare(
        "SELECT * FROM roleplay_characters JOIN characters USING(character_id) 
        WHERE roleplay_id=:id AND role=:role AND active=1");
    $guest->bindParam("id", $id);
    $guest->bindParam("role", $guestRole);
    $guest->execute();
    $guestRow = $guest->fetchAll();
?>