<?php
function conectame(){
		$usuario="root";
		$pass   ="";
		$server ="localhost";
		$base   ="mygamelist";
		$mysqli = new mysqli($server,$usuario,$pass,$base );
		
		if( mysqli_connect_errno() ){
			echo "Error".mysqli_connect_error();
			exit();

		}/*else{
			echo "Todo OK";
		}*/

		return $mysqli;
	}
?>