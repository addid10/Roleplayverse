<?php
 
 function get_image_name($id) {
	require_once('database/db.php');
	$statement = $connection->prepare("SELECT picture FROM profile WHERE users_id=:id");
    $statement->bindParam('id', $id);
    $statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["picture"];
	}
}

function favorites($chara, $user) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT COUNT(*) FROM favorites WHERE users_id=:user AND character_id=:chara");
    $statement->bindParam('user', $user);
    $statement->bindParam('chara', $chara);
    $statement->execute();
	$result = $statement->fetchColumn();
	return $result;
}


function upload_photo() {
	if(isset($_FILES["picture"])) { 
		$bytes = 1024;
		$KB = 1024;
		$totalBytes = $bytes * $KB;
		
		$upload = true;
					
		if($_FILES["picture"]["size"] > $totalBytes) {
			$upload = false;
		}
		if($upload == true) {
			$ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
			if($ext=="png" || $ext=="jpeg" || $ext=="jpg"){
				$folder = '../assets/img/users/profile/';
				$newImage = rand() . '.' . $ext;
				$destination = $folder . $newImage;
				move_uploaded_file($_FILES['picture']['tmp_name'], $destination);
				
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

function get_picture_name($id) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT picture FROM profile WHERE users_id=:id");
    $statement->bindParam('id', $id);
    $statement->execute();
	$result = $statement->fetch();
	
	return $result["picture"];
}

function picture_name($id) {
	require('../database/db.php');
	$statement = $connection->prepare("SELECT picture FROM profile WHERE users_id=:id");
	$statement->bindParam('id', $id);
	$statement->execute();
	$result = $statement->fetch();
	echo $result['picture'];
}

function date_converted($date) {
	$month = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $date);
	return $split[2] . ' ' . $month[ (int)$split[1] ] . ' ' . $split[0];
}

?>