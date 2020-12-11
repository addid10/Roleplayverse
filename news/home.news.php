<?php 
    require_once('../database/db.php');

    $news = $connection->prepare(
        "SELECT * FROM news JOIN category USING(category_id) 
        JOIN profile USING(users_id) WHERE status=1 ORDER BY create_at ASC"
    );
    $news->execute();
    $rows = $news->fetchAll(PDO::FETCH_OBJ);

    $bulan = array(
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Apr',
        '05' => 'Mei',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Agt',
        '09' => 'Sep',
        '10' => 'Okt',
        '11' => 'Nov',
        '12' => 'Des',
    );
?>