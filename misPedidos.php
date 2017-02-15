<?php
    require_once('objetos.php');
    require_once('funciones.php');
    session_start();

    saveRequest();
    if(!empty($_POST['$rowIng["nombreIng"]'])) {
    		foreach($_POST['$rowIng["nombreIng"]'] as $check) {
            	echo $check;
			}
		}
?>