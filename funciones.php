<?php 
	function conectarbd() {
		return $bdd = new mysqli('localhost', 'root', 'guapa', 'wok');
	}

	function saveData($registro, $consulta){

		return $registro->query($consulta);
	}

	function closebd($bdd) {
		return $bdd -> close();
	}
 ?>