<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	$lihatUsers  = '';
	$hasilUsers  = array();
	$lihatUsers .= "SELECT * FROM users WHERE active=1 ";

	if(isset($_POST["search"]["value"]))
	{
		$lihatUsers .= 'AND username RLIKE :search ';
	}
	if(isset($_POST["order"]))
	{
		$lihatUsers .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	}
	if($_POST["length"] != -1)
	{
		$lihatUsers .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	$statement = $connection->prepare($lihatUsers);
	$statement->bindParam("search", $_POST["search"]["value"]);
	$statement->execute();
	$result    = $statement->fetchAll();
	$data      = array();
	$filtered_rows = $statement->rowCount();
	foreach($result as $row)
	{
		$sub_array = array();
		$sub_array[] = '<a target="_blank" href="../../../profile/'.$row["username"].'">'.$row["username"].'</a>';

		$tgl_dibuat  = $row["create_at"];
		$bergabung   = date("jS M Y", strtotime("$tgl_dibuat"));
		
		$sub_array[] = $bergabung;
		$sub_array[] = $row["email"];
		if ($row["role_id"]==1) {
			$sub_array[] = '<label class="label label-info">Member</label>';
			$sub_array[] = '<button type="button" name="delete" id="'.$row["users_id"].'" class="btn btn-danger delete"><i class="fa fa-ban"></i> Blokir</button>';
		}
		else if($row["role_id"]==2) {
			$sub_array[] = '<label class="label label-success">Admin</label>';
			$sub_array[] = '<button type="button" name="delete" id="'.$row["users_id"].'" class="btn btn-danger delete"><i class="fa fa-ban"></i> Blokir</button>';
		}
		else if($row["role_id"]==3) {
			$sub_array[] = '<label class="label label-danger">Super Admin</label>';		
			$sub_array[] = '';	
		}

		$data[] 	 = $sub_array;
	}
	$hasilUsers = array(
		"draw"				=>	intval($_POST["draw"]),
		"recordsTotal"		=> 	$filtered_rows,
		"recordsFiltered"	=>	get_total_users_records(),
		"data"				=>	$data
	);
	echo json_encode($hasilUsers);
}
?>


