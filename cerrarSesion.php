<?php
		session_start(); 	//Iniciamos o Continuamos la sesion
		require_once("conexcion.php");
		
		$conexion = conectar();
		$sql = "UPDATE users SET Estado=1 WHERE Id_usuario=".$_SESSION["usuario"];
		$resul = mysqli_query($conexion, $sql);

		$conexion = null;
		$conexion = conectar();
		session_unset();	//Elimina informaciones de todas las sesiones
		session_destroy();	//Cierra la sesion
 		header("Location:administracion.php");
?>
