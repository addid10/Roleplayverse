<?php
    $favorites = $connection->prepare(
        "SELECT *, COUNT(favorite_id) as favorited FROM characters LEFT JOIN favorites USING(character_id)
        WHERE active=1
        GROUP BY character_id ORDER BY favorited DESC LIMIT 100;
    ");
    $favorites->execute();
    $topFavorites = $favorites->fetchAll();

    $rankingFavorite = 1;
?>