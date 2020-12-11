<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');

    if(isset($_POST["new_password"]) && isset($_POST["old_password"]) && isset($_SESSION['usernameMember']))
    {
        $id           = $_SESSION['userAccountId'];
        $oldPass      = $_POST['old_password'];
        $newPass      = $_POST['new_password'];
        $newHashPass  = password_hash($newPass, PASSWORD_DEFAULT);

        $statement    = $connection->prepare(
            "SELECT * FROM users WHERE users_id=:id"
        );
        $statement->bindParam("id", $id);
        $statement->execute();
        $validation   = $statement->fetch();
        $oldHashPass  = $validation['password'];

        if(password_verify($oldPass, $oldHashPass)==$oldPass){
            $statement = $connection->prepare(
                "UPDATE users SET 
                password        = :password
                WHERE users_id  = :id"
            );

            $statement->bindParam("password", $newHashPass);
            $statement->bindParam("id", $id);
            $result = $statement->execute();
            if(!empty($result))
            {
                echo 1;
            }
        }
        else {
            echo 0;
        }
    }
}
?>