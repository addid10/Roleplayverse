<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST["score"]) && isset($_POST['roleplay_id'])) {

		$score  = $_POST['score'];
		$id     = $_POST['roleplay_id'];
		

		$add = $connection->prepare(
		    "UPDATE roleplay SET 
            roleplay_score	 		= :score
            WHERE roleplay_id       = :id
		");

		$add->bindParam("id", $id);
		$add->bindParam("score", $score);
		$add->execute();
    }
}
?>

