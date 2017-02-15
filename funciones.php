<?php 
	function conectarbd() {
		$bdd = new mysqli('localhost', 'root', 'guapa', 'wok');
		$bdd -> set_charset('UTF8'); 
		return $bdd;
	}

	function saveData($registro, $consulta){

		return $registro->query($consulta);
	}

	function closebd($bdd) {
		return $bdd -> close();
	}

	function saveRequest() {
		$conectdb = conectarbd();
		$request = "";
	}

	function numIngr() {
		if(!empty($_POST['check_list'])) {
    		foreach($_POST['check_list'] as $check) {
            	return $check;
			}
		}
	}

 ?>