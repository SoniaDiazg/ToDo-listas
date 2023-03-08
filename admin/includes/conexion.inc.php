<?php 

	$servidorBD = "localhost";
	$usuarioBD = "root";
	$claveBD = "1234";
	$nombreBD = "DoThings_bd";

	$conectar = mysqli_connect($servidorBD, $usuarioBD, $claveBD, $nombreBD); 
	
	mysqli_set_charset($conectar, 'utf8mb4');

	/*comprobar si se ha establecido la conexion con la BD, esto luego lo quitamos*/

	if (!$conectar) {
		echo "Error 0x0001: contacte con el administrador del sitio";
	}

?>