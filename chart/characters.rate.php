<?php 
    $rate = $connection->prepare(
        "SELECT *, 
        (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as average 
        FROM characters 
        LEFT JOIN characters_rate USING(character_id)
        WHERE active=1
        GROUP BY character_id ORDER BY average DESC LIMIT 100
    ");
    $rate->execute();
    $topRate = $rate->fetchAll();

    $ranking = 1;
?>