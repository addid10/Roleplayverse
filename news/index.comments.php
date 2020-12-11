<?php
    $comments = $connection->prepare(
        "SELECT * FROM news_comments JOIN profile USING(users_id) JOIN users USING(users_id) WHERE news_id=:id"
    );
    $comments->bindParam("id", $id);
    $comments->execute();
    $comment = $comments->fetchAll();

    //Function
    function date_convert($date) {
        $month = array (1 =>   'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Ags',
                    'Sep',
                    'Okt',
                    'Nov',
                    'Des'
                );
        $split = explode('-', $date);
        return  $month[(int)$split[1]].', '.$split[2].' '.$split[0];
    }

    function comments_count($id) {
        require('../database/db.php');

        $count = $connection->prepare(
            "SELECT COUNT(*) FROM news_comments WHERE news_id=:id"
        );
        $count->bindParam("id", $id);
        $count->execute();
        $result = $count->fetchColumn();

        return $result;
    }
?>