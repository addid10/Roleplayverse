<?php 

    $featured = $connection->prepare(
        "SELECT character_fullname, faceclaim, character_id, 
        (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as average FROM characters 
        LEFT JOIN characters_rate USING(character_id)
        WHERE author=:id AND active=1 GROUP BY character_id ORDER BY average DESC LIMIT 1
    ");
    $featured->bindParam("id", $id);
    $featured->execute();
    $charaFeatured = $featured->fetch();
?>