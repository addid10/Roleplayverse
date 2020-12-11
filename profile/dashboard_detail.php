<?php

require_once('../database/db.php');

$profile = $connection->prepare(
    "SELECT *, COUNT(*) as count FROM users JOIN profile USING(users_id) WHERE username=:name
");
$profile->bindParam("name", $name);
$profile->execute();
$row = $profile->fetch();


    
function date_convert($date) {
    $month = array (1 =>   'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            );
    $split = explode('-', $date);
    return $month[ (int)$split[1] ] . ', ' . $split[2] . ' ' . $split[0];
}
?>