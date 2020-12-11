<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');
    if(isset($_SESSION['usernameMember']) && isset($_POST['id']) && isset($_POST['comment'])) {
        $pattern = '/^[<>$#=]+$/';
        if(preg_match($pattern, $_POST['comment'])) {
            echo 1;
        } else {
            $id      = $_POST['id'];
            $user    = $_SESSION['userAccountId'];
            $comment = $_POST['comment'];
            $date    = date('Y-m-d');
    
            $add = $connection->prepare(
                "INSERT INTO news_comments (comments, news_id, users_id, comment_at) 
                VALUES (:comment, :id, :user, :date)"
            );
            $add->bindParam("id", $id);
            $add->bindParam("user", $user);
            $add->bindParam("comment", $comment);
            $add->bindParam("date", $date);
            $add->execute();
        }
    }
}

?>