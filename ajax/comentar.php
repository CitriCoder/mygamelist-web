<?php
	include('../conDB.php');
	$con = conectame();

	$puntos=$_POST['puntosPuestos'];
	$comentario=$_POST['comentarioTxtarea'];
	$juegoId=$_POST['juegoId'];
	$usuarioId=$_POST['usuarioId'];
	$estado=$_POST['estado'];

	if ($estado == 1) {
		$query="UPDATE `resenia` SET `estado`= !`estado`,`comentario` = '$comentario' WHERE `idusuario` = $usuarioId AND `idjuego` = $juegoId";
		$result=mysqli_query($con,$query);

		if (!$result) {
			die('Query error'.mysqli_error($con));
		}
	} else{
		$query="INSERT INTO `resenia`(`idusuario`, `comentario`, `puntaje`, `idjuego`) VALUES ('$usuarioId','$comentario','$puntos','$juegoId')";
		$result=mysqli_query($con,$query);

		if (!$result) {
			die('Query error'.mysqli_error($con));
		}
	}
	
	$json=array();
		while ($row = mysqli_fetch_array($result)) {
			$json[]=array(
				'idusuario'=>$row['idusuario'],	
				'idjuego'=>$row['idjuego'],
				'comentario'=>$row['comentario'],
				'puntaje'=>$row['puntaje']

			);
		};
		
		$json_string=json_encode($json);
		echo $json_string;
?>