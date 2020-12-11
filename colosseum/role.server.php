<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');
    
    function upload_assignment() {
        if(isset($_FILES["file"])) { 
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $fileName = basename($_FILES['file']['name'], "." . $ext);
            if($ext=="rar" || $ext=="zip" || $ext=="7z"){
                $new_name = $fileName. '_' . date("Ymd") . '_' . rand() . '.' . $ext;
                $destination = 'file/' . $new_name;
                move_uploaded_file($_FILES['file']['tmp_name'], $destination);
                return $new_name;
            }
        }
    }
    
	if(isset($_FILES["file"])) {
		
		$file = '';
		if($_FILES["file"]["name"] != '') {
			$file = upload_assignment();
        }
        
		$add = $connection->prepare(
			"INSERT INTO colosseum_files (files) 
			VALUES (:file)
		");

		$add->bindParam("file", $file);
		$add->execute();
		
        if($add) {
            header('location: role');
        }
    } 
    
}
?>