<?php
	include('../conDB.php');
	$con = conectame();
	$comentario = $_POST['comentario'];
    $puntuacion = $_POST['puntuacion'];
    $userGame = $_POST['userGame'];
    $userGame_explode = explode('|', $userGame);

	//if(!empty($dni) && !empty($actividad) && !empty($nombre) && !empty($cargaHoraria) && !empty($fecha)){
		$query="UPDATE `resenia` SET `comentario` = '$comentario',`puntaje` = $puntuacion WHERE `idusuario` = $userGame_explode[0] AND `idjuego` = $userGame_explode[1]";
		//$query = "UPDATE `estudiantes` SET `dni`='32007681',`actividad`='Curso de columpiarse en una silla',`nombre`='Pepe Adolfo',`carga_horaria`='31',`fecha_certificado`='2021-01-02' WHERE `pkcertificado` = '4861'";

        if ($con->query($query) == true) {
            echo "Editado correctamente";
          } else {
            echo "Error: " . $query . "<br>" . $con->error;
        }
	//}
?>