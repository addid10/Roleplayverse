<?php

    $id = addslashes($_GET['id']);
    require_once('../database/db.php');

    $character = $connection->prepare(
        "SELECT *, COUNT(*) as count FROM characters LEFT JOIN race USING(race_id) 
        WHERE character_id=:id AND active=1");
    $character->bindParam("id", $id);
    $character->execute();
    $row = $character->fetch();

    function partner_name($id) {
        require('../database/db.php');
        $partner = $connection->prepare("SELECT character_fullname FROM characters WHERE character_id=:id");
        $partner->bindParam("id", $id);
        $partner->execute();
        $partnerName = $partner->fetch();
        return $partnerName['character_fullname'];
    }

    function author_name($id) {
        require('../database/db.php');
        $author = $connection->prepare("SELECT fullname FROM profile WHERE users_id=:id");
        $author->bindParam("id", $id);
        $author->execute();
        $authorName = $author->fetch();
        return $authorName['fullname'];
    }

    function username($id) {
        require('../database/db.php');
        $author = $connection->prepare("SELECT username FROM users WHERE users_id=:id");
        $author->bindParam("id", $id);
        $author->execute();
        $authorName = $author->fetch();
        return $authorName['username'];
    }
?>