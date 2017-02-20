<?php 
	require_once('objetos.php');
	require_once('funciones.php');
	session_start();
 
	//Hago sesión destroy para borrarlas todas y así salir.
	if ($_SESSION['sesionIniciada']) {
 
			session_destroy();
    header ("Location: home.php");

	} else{
	     header ("Location: home.php");
	}

?>
