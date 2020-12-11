<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	$getCharacter  = '';
	$fetchCharacter = array();
	$getCharacter .= "SELECT * FROM affiliation WHERE affiliation_active=1 ";

	if(isset($_POST["search"]["value"]))
	{
		$getCharacter .= 'AND affiliation_name RLIKE :search ';
	}
	if(isset($_POST["order"]))
	{
		$getCharacter .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$getCharacter .= 'ORDER BY affiliation_name ASC ';
	}
	if($_POST["length"] != -1)
	{
		$getCharacter .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}


	$statement = $connection->prepare($getCharacter);
	$statement->bindParam("search", $_POST["search"]["value"]);
	$statement->execute();
	$result    = $statement->fetchAll();
	$data      = array();
	$rowCount  = $statement->rowCount();
	foreach($result as $row)
	{
		$sub_array = array();

		$sub_array[] = '<a target="_blank" href="../../../affiliation/'.$row["affiliation_id"].'">'.$row['affiliation_name'].'</a>';
		$sub_array[] = '<button type="button" id="'.$row["affiliation_id"].'" class="btn btn-success member">Members</button>';
		$sub_array[] = '<button type="button" id="'.$row["affiliation_id"].'" class="btn btn-warning update">Update</button>';
		$sub_array[] = '<button type="button" id="'.$row["affiliation_id"].'" class="btn btn-danger delete">Delete</button>';
		$data[] = $sub_array;
	}
	$fetchCharacter = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$rowCount,
		"recordsFiltered"	=>	get_total_affiliation_records(),
		"data"				=>	$data
	);
	echo json_encode($fetchCharacter);
}
?>


