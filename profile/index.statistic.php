<?php
    $id = $row['users_id'];

    $statistic = $connection->prepare(
        "SELECT 
        SUM(CASE WHEN rate = 10 THEN 1 ELSE 0 END) as ten,
        SUM(CASE WHEN rate = 9 THEN 1 ELSE 0 END) as nine,
        SUM(CASE WHEN rate = 8 THEN 1 ELSE 0 END) as eight,
        SUM(CASE WHEN rate = 7 THEN 1 ELSE 0 END) as seven,
        SUM(CASE WHEN rate = 6 THEN 1 ELSE 0 END) as six,
        SUM(CASE WHEN rate = 5 THEN 1 ELSE 0 END) as five,
        SUM(CASE WHEN rate = 4 THEN 1 ELSE 0 END) as four,
        SUM(CASE WHEN rate = 3 THEN 1 ELSE 0 END) as three,
        SUM(CASE WHEN rate = 2 THEN 1 ELSE 0 END) as two,
        SUM(CASE WHEN rate = 1 THEN 1 ELSE 0 END) as one,
        author FROM characters_rate JOIN characters USING(character_id) WHERE author=:id AND active=1;
    ");
    $statistic->bindParam("id", $id);
    $statistic->execute();
    $stats = $statistic->fetch();

?>