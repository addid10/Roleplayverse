<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST["author"]) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['contents'])) {

		$author		= $_POST['author'];
		$title		= $_POST['title'];
		$category	= $_POST['category'];
		$contents	= $_POST['contents'];
		$status		= 1;
		$date		= date('Y-m-d');

		//Add
		if($_POST["operation"] == "Add") {

			$image = '';
			if($_FILES["photos"]["name"] != '') {
				$image = upload_photos();
			}

			$add = $connection->prepare(
				"INSERT INTO news (title, photos, create_at, contents, category_id, users_id, status) 
				VALUES (:title, :image, :date, :contents, :category, :author, :status)
			");

			$add->bindParam("title", $title);
			$add->bindParam("image", $image);
			$add->bindParam("date", $date);
			$add->bindParam("contents", $contents);
			$add->bindParam("category", $category);
			$add->bindParam("author", $author);
			$add->bindParam("status", $status);
			$add->execute();
		}

		//Edit
		if($_POST["operation"] == "Edit") {
			
			$image = '';
			$id = $_POST['id'];

			if($_FILES["photos"]["name"] != '') {
				$image    = upload_photos();
				$oldImage = get_photos($id);

				if($image != $oldImage) {
					unlink("../../../assets/img/news/".$oldImage);
				}

			} else {
				$image = $_POST["hidden_foto"];
			}

			$update = $connection->prepare(
				"UPDATE news SET 
				title			= :title, 
				photos			= :image,
				create_at		= :date, 
				contents		= :contents,
				category_id		= :category, 
				users_id		= :author,
				status			= :status 
				WHERE news_id	= :id"
			);
			
			$update->bindParam("id", $id);
			$update->bindParam("title", $title);
			$update->bindParam("image", $image);
			$update->bindParam("date", $date);
			$update->bindParam("contents", $contents);
			$update->bindParam("category", $category);
			$update->bindParam("author", $author);
			$update->bindParam("status", $status);
			$update->execute();

		}
	}
}
?>