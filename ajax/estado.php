<?php
	include('../conDB.php');
	$con = conectame();

	$estadoId = $_POST["estado"];



	$query="UPDATE `usuarios` SET `estado`= !`estado` WHERE `id` = $estadoId";
	$result=mysqli_query($con,$query);

	if (!$result) {
		die('Query error'.mysqli_error($con));
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);

	/*$json=array();
	while ($row = mysqli_fetch_array($result)) {
		$json[]=array(
			'idusuario'=>$row['idusuario'],	
			'idjuego'=>$row['idjuego'],
			'comentario'=>$row['comentario'],
			'puntaje'=>$row['puntaje']

		);
	};
	
	$json_string=json_encode($json);
	echo $json_string;*/
?>