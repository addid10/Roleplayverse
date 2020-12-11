<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	$news  = '';
	$resultNews = array();
	$news .= "SELECT * FROM news JOIN category USING(category_id) JOIN profile USING(users_id) WHERE status=1 ";

	if(isset($_POST["search"]["value"]))
	{
		$news .= 'AND title RLIKE :search ';
	}
	if(isset($_POST["order"]))
	{
		$news .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	else
	{
		$news .= 'ORDER BY create_at ASC ';
	}
	if($_POST["length"] != -1)
	{
		$news .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}


	$statement = $connection->prepare($news);
	$statement->bindParam("search", $_POST["search"]["value"]);
	$statement->execute();
	$result    = $statement->fetchAll();
	$data      = array();
	$rowCount  = $statement->rowCount();
	foreach($result as $row)
	{
		$sub_array = array();

		$sub_array[] = '<a target="_blank" href="../../../news/'.$row["news_id"].'">'.$row['title'].'</a>';
		$sub_array[] = $row['category_name'];
		$sub_array[] = $row['fullname'];
		$sub_array[] = '<button type="button" id="'.$row["news_id"].'" class="btn btn-warning update">Update</button>';
		$sub_array[] = '<button type="button" id="'.$row["news_id"].'" class="btn btn-danger delete">Delete</button>';
		$data[] = $sub_array;
	}
	$resultNews = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$rowCount,
		"recordsFiltered"	=>	get_total_affiliation_records(),
		"data"				=>	$data
	);
	echo json_encode($resultNews);
}
?>


