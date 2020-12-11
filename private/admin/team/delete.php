<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST['id'])) {
		
		$id	   = $_POST['id'];

		$statement = $connection->prepare(
			"UPDATE affiliation SET affiliation_active=0 WHERE affiliation_id=:id"
		);
		
		$statement->bindParam("id", $id);
		$result = $statement->execute();
	}
}
?>