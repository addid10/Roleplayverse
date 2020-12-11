<?php

function upload_roleplay_cover() {
	if(isset($_FILES["cover"])) { 
		$bytes = 1024;
		$KB = 1024;
		$totalBytes = $bytes * $KB;
		
		$upload = true;
					
		if($_FILES["cover"]["size"] > $totalBytes) {
			$upload = false;
		}
		if($upload == true) {
		    $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
			if($ext=="png" || $ext=="jpeg" || $ext=="jpg"){
				$folder = '../../../assets/img/roleplay/';
				$newImage = rand() . '.' . $ext;
				$destination = $folder . $newImage;
				move_uploaded_file($_FILES['cover']['tmp_name'], $destination);
				
				//Convert
				$resizeImage = rand() . '.' . $ext;
				$resize = $folder . $resizeImage;
				list($width, $height) = getimagesize($destination);
				$const = 1;
				$newWidth = $width / $const;
				$newHeight = $height / $const;

				$thumb = imagecreatetruecolor($newWidth, $newHeight);

				if($ext == "png") {
					$source  = imagecreatefrompng($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				} else {
					$source = imagecreatefromjpeg($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				}
				imagejpeg($thumb, $resize);
				imagedestroy($thumb);
				imagedestroy($source);

				unlink($destination);
				
				return $resizeImage;
			}
		} else {
			return "default.png";
		}
	}
}

function upload_faceclaim() {
	if(isset($_FILES["faceclaim"])) {  
		$bytes = 1024;
		$KB = 1024;
		$totalBytes = $bytes * $KB;
		
		$upload = true;
					
		if($_FILES["faceclaim"]["size"] > $totalBytes) {
			$upload = false;
		}
		if($upload == true) {
		    $ext = pathinfo($_FILES['faceclaim']['name'], PATHINFO_EXTENSION);
			if($ext=="png" || $ext=="jpeg" || $ext=="jpg"){
				$folder = '../../../assets/img/oc/profile/';
				$newImage = rand() . '.' . $ext;
				$destination = $folder . $newImage;
				move_uploaded_file($_FILES['faceclaim']['tmp_name'], $destination);
				
				//Convert
				$resizeImage = rand() . '.' . $ext;
				$resize = $folder . $resizeImage;
				list($width, $height) = getimagesize($destination);
				$const = 1;
				$newWidth = $width / $const;
				$newHeight = $height / $const;

				$thumb = imagecreatetruecolor($newWidth, $newHeight);

				if($ext == "png") {
					$source  = imagecreatefrompng($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				} else {
					$source = imagecreatefromjpeg($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				}
				imagejpeg($thumb, $resize);
				imagedestroy($thumb);
				imagedestroy($source);

				unlink($destination);
				
				return $resizeImage;
			}
		} else {
			return "default.png";
		}
	}
}
  
function get_image_roleplay_name($id) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT roleplay_cover FROM roleplay WHERE roleplay_id=:id");
    $statement->bindParam('id', $id);
    $statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["roleplay_cover"];
	}
}
 
function get_image_character_name($id) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT faceclaim FROM characters WHERE character_id=:id");
    $statement->bindParam('id', $id);
    $statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["faceclaim"];
	}
}

function get_total_all_records() {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT * FROM roleplay");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_message_records() {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT * FROM messages");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_users_records() {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT * FROM users"
        );
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_oc_records() {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT * FROM characters"
        );
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function get_total_affiliation_records() {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT * FROM affiliation"
        );
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function roleplay_characters($roleplay, $character) {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT COUNT(*) FROM roleplay_characters WHERE roleplay_id=:roleplay AND character_id=:character"
	);
	$statement->bindParam("roleplay", $roleplay);
	$statement->bindParam("character", $character);
	$statement->execute();

	return $statement->fetchColumn();
}

function affiliation_member($affiliation, $member) {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT COUNT(*) FROM affiliation_member WHERE affiliation_id=:affiliation AND character_id=:member"
	);
	$statement->bindParam("affiliation", $affiliation);
	$statement->bindParam("member", $member);
	$statement->execute();

	return $statement->fetchColumn();
}

function favorites($id) {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT COUNT(*) as count FROM favorites WHERE character_id=:id"
	);
	$statement->bindParam("id", $id);
	$statement->execute();

	$result = $statement->fetch();

	return $result['count'];
}

function score($id) {
	require('../database/db.php');
	$statement = $connection->prepare(
        "SELECT (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as score FROM characters_rate WHERE character_id=:id"
	);
	$statement->bindParam("id", $id);
	$statement->execute();

	$result = $statement->fetch();

	return $result['score'];
}

function get_photos($id) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT photos FROM news WHERE news_id=:id");
    $statement->bindParam('id', $id);
    $statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["photos"];
	}
}

function upload_photos() {
	if(isset($_FILES["photos"])) { 
		$bytes = 1024;
		$KB = 1024;
		$totalBytes = $bytes * $KB;
		
		$upload = true;
					
		if($_FILES["photos"]["size"] > $totalBytes) {
			$upload = false;
		}
		if($upload == true) {
		    $ext = pathinfo($_FILES['photos']['name'], PATHINFO_EXTENSION);
			if($ext=="png" || $ext=="jpeg" || $ext=="jpg"){
				$folder = '../../../assets/img/news/';
				$newImage = rand() . '.' . $ext;
				$destination = $folder . $newImage;
				move_uploaded_file($_FILES['photos']['tmp_name'], $destination);
				
				//Convert
				$resizeImage = rand() . '.' . $ext;
				$resize = $folder . $resizeImage;
				list($width, $height) = getimagesize($destination);
				$const = 1;
				$newWidth = $width / $const;
				$newHeight = $height / $const;

				$thumb = imagecreatetruecolor($newWidth, $newHeight);

				if($ext == "png") {
					$source  = imagecreatefrompng($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				} else {
					$source = imagecreatefromjpeg($destination);
					imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
				}
				imagejpeg($thumb, $resize);
				imagedestroy($thumb);
				imagedestroy($source);

				unlink($destination);
				
				return $resizeImage;
			}
		} else {
			return "";
		}
	}
}

?>