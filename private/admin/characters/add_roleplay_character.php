<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST["roleplay"]) && isset($_POST['character_id'])) {

		$story = $_POST['roleplay'];
		$role  = $_POST['role'];
        $chara = $_POST['character_id'];
        $cek   = roleplay_characters($story, $chara);

        if($cek == 0) {
            $add = $connection->prepare(
                "INSERT INTO roleplay_characters (roleplay_id, character_id, role) 
                VALUES (:story, :chara, :role)
            ");
    
            $add->bindParam("story", $story);
            $add->bindParam("chara", $chara);
            $add->bindParam("role", $role);
            $add->execute();
        }
        else {
            echo 1;
        }

    }
}
?>

