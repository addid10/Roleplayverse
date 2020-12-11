<?php 
    $id = addslashes($_GET['id']);
    require_once('../database/db.php');

    $roleplay = $connection->prepare(
        "SELECT *, COUNT(*) as count FROM roleplay 
        WHERE roleplay_id=:id AND roleplay_active=1");
    $roleplay->bindParam("id", $id);
    $roleplay->execute();
    $row = $roleplay->fetch();


    //Function
    function date_convert($date) {
        $month = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split = explode('-', $date);
        return $split[2] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];
    }
?>