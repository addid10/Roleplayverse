<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["name"]) && isset($_POST['description'])) {

		$name 	= $_POST['name'];
		$info   = $_POST['description'];
		$active = 1;

		//Add
		if($_POST["operation"] == "Add") {

			$add = $connection->prepare(
			"INSERT INTO affiliation (affiliation_name, affiliation_active, affiliation_description) 
			VALUES (:name, :active, :info)
			");

			$add->bindParam("name", $name);
			$add->bindParam("active", $active);
			$add->bindParam("info", $info);
			$add->execute();
		}

		//Edit
		if($_POST["operation"] == "Edit")
		{
			
			$id = $_POST['id'];

			$update = $connection->prepare(
				"UPDATE affiliation SET 
				affiliation_name		= :name, 
				affiliation_description	= :info
				WHERE affiliation_id	= :id"
			);
			
			$update->bindParam("id", $id);
			$update->bindParam("name", $name);
			$update->bindParam("info", $info);
			$update->execute();

		}
	}
}
?>