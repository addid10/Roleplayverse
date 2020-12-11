<?php 
    if(isset($_SESSION['usernameMember'])) {
        if(isset($_GET['name'])) {
            $user = $_SESSION['userAccountId'];

            $privacy = $connection->prepare(
                "SELECT COUNT(*) FROM users WHERE users_id:id
            ");

            $privacy->bindParam('id', $id);
            $privacy->execute();
            $privacyMember = $privacy->fetchColumn();
        }
    }
?>