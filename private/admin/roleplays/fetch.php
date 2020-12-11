<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	$getRoleplay  = '';
	$fetchRoleplay = array();
	$getRoleplay .= "SELECT * FROM roleplay WHERE roleplay_active=1 ";

	if(isset($_POST["search"]["value"]))
	{
		$getRoleplay .= 'AND roleplay_name RLIKE :search ';
	}
	if(isset($_POST["order"]))
	{
		$getRoleplay .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$getRoleplay .= 'ORDER BY roleplay_name ASC ';
	}
	if($_POST["length"] != -1)
	{
		$getRoleplay .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}


	$statement = $connection->prepare($getRoleplay);
	$statement->bindParam("search", $_POST["search"]["value"]);
	$statement->execute();
	$result    = $statement->fetchAll();
	$data      = array();
	$rowCount  = $statement->rowCount();
	foreach($result as $row)
	{
		$sub_array = array();

		$sub_array[] = '<a target="_blank" href="../../../roleplay_stories/'.$row["roleplay_id"].'">'.$row['roleplay_name'].'</a>';
		$sub_array[] = $row["roleplay_creator"];
		$sub_array[] = $row["roleplay_type"];
		if(!empty($row['roleplay_score'])){
			$sub_array[] = $row["roleplay_score"];
		} else { 
			$sub_array[] = '<span class="badge badge-pill badge-danger">Belum Dinilai</span>';
		}
		$sub_array[] = '<button type="button" name="score" id="'.$row["roleplay_id"].'" class="btn btn-info score"><i class="fa fa-star"></i> Score</button>';
		$sub_array[] = '<button type="button" name="update" id="'.$row["roleplay_id"].'" class="btn btn-warning update">Update</button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["roleplay_id"].'" class="btn btn-danger delete">Delete</button>';
		$data[] = $sub_array;
	}
	$fetchRoleplay = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$rowCount,
		"recordsFiltered"	=>	get_total_all_records(),
		"data"				=>	$data
	);
	echo json_encode($fetchRoleplay);
}
?>


