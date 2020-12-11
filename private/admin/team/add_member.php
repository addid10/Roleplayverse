<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST["member"]) && isset($_POST['position']) && isset($_POST['affiliation'])) {

		$member         = $_POST['member'];
        $position       = $_POST['position'];
        $affiliation    = $_POST['affiliation'];
        $cek            = affiliation_member($affiliation, $member);

        if($cek == 0) {
            $add = $connection->prepare(
                "INSERT INTO affiliation_member (affiliation_id, character_id, position) 
                VALUES (:affiliation, :member, :position)
            ");
    
            $add->bindParam("affiliation", $affiliation);
            $add->bindParam("member", $member);
            $add->bindParam("position", $position);
            $add->execute();
        }
        else {
            echo 1;
        }

    }
}
?>

