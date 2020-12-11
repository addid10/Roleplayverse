<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["contributor"]) && isset($_POST['character_id'])) {

		$contributor = $_POST['contributor'];
		$attraction  = $_POST['attraction'];
		$id     	 = $_POST['character_id'];
		

		$add = $connection->prepare(
		    "UPDATE characters SET 
            character_contributor	= :contributor,
			character_attraction	= :attraction
            WHERE character_id = :id
		");

		$add->bindParam("id", $id);
		$add->bindParam("attraction", $attraction);
		$add->bindParam("contributor", $contributor);
		$add->execute();
    }
}
?>

