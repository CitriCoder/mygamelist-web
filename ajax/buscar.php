<?php
	include('../conDB.php');
	$con = conectame();
	$buscar=$_POST['buscar'];
	if(!empty($buscar)){
		$query="SELECT * FROM `juegos` WHERE `name` LIKE '%$buscar%' ORDER BY `name` DESC";
		$result=mysqli_query($con,$query);
		if(!$result){
			die('Query error'.mysqli_error($con));
		}
	} else {
		$query="SELECT * FROM `juegos` ORDER BY `name` DESC";
		$result=mysqli_query($con,$query);
		if(!$result){
			die('Query error'.mysqli_error($con));
		}
	}
	$json=array();
	while ($row = mysqli_fetch_array($result)) {
		$json[]=array(
			'name'=>$row['name'],	
			'fname'=>$row['fname'],
			'id'=>$row['id']

		);
	};
	
	$json_string=json_encode($json);
	echo $json_string;
?>