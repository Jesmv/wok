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

	function checkName() {
		$text = trim($_POST['name']);
		if($text== ""){
			echo "<script> alert('Introduzca un nombre.') </script>";
			return false;
		} else {
			return true;
		}
	}

	function checkFirma() {
		$text = trim($_POST['firma']);
		if($text== null){
			echo "<script> alert('Introduzca la firma.') </script>";
			return false;
		} else {
			return true;
		}
	}

	/*Guarda la imagen en una carpeta. Primero comprueba que el campo no esté vacio. Lo hago comprobando si es el error 4, que indica que se encuentra vacio el input del file, si es así me devuelve true, ya que considero que se puede tener vacio porque no se quiera cambiar la imagen.. */
	function downloadImage() {

		if ($_FILES['imagen']['error']==4) {
			
			return true;
		} else {

			/*En este if else se comprueba que la imagen se ha subido. Si es correcto creamos una variable */
			if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )) {
				$fileName = $_FILES['imagen']['name'];
				$directoryName = "imagenes/";
				$finalName = $directoryName.$fileName;

				/*Si la imagen es mayor de 500kb nos devolverá un error y no continuará*/
				if ($_FILES['imagen']['size'] > 500000) {
					echo "<script> alert('La imagen supera el tamaño. Máximo 500kb.') </script>";
					return false;
				} 
				
				/*En el caso de que no tuviesemos permisos no nos dejaria subir la foto y nos mostraría un error, en el caso de que todo fuese correcto, la imagen se guardaría en la carpeta de imágenes y se guarda en una sesión llamada nuevo Avatar para despues guardar la dirección en la base de datos.*/
				if (is_dir($directoryName)){ 
					$timeName = time();
					$fileName = $timeName."-".$fileName;
					$finalName = $directoryName.$fileName;
					move_uploaded_file ($_FILES['imagen']['tmp_name'],$finalName);
					
					$_SESSION['nuevoAvatar']=$finalName;
					
					return true;
				} else {
					echo "<script> alert('Error al cargar la imagen') </script>";
					return false;
				}
				
			} else {
				echo "<script> alert('Error al cargar la imagen.') </script>";
				return false;
			}
		}	

	}

	function changePass() {

		/*Si los tres campos de la contraseña están vacios, devolverá true porque se entiende que no se quiere hacer ningún cambio, si alguno de los tres esta rellenado continuará haciendo la comprobación.*/
		if($_POST['oldPass'] == "" && $_POST['newPass'] == "" && $_POST['repeatNewPass'] == ""){
				return true;
			}

		/*Guardo las contraseñas encriptadas. Lo primero comprueblo que la contraseña coincide con la del usuario, en el caso de que no sea así devuelve un alert. Despues comprueba que las dos contraseñas nuevas son iguales, si lo son devuelve true, sino muestra un alert diciendo que no coinciden. */
		$oldPass = md5($_POST['oldPass']);
		$newPass = md5($_POST['newPass']);
		$repeatNewPass = md5($_POST['repeatNewPass']);

		if($oldPass === $_SESSION['usuario']->getPass()) {
			if($_POST['newPass'] === $_POST['repeatNewPass']){
				$_SESSION['usuario']->setPass(md5($_POST['repeatNewPass']));
				return true;
				
			} else {
				echo "<script> alert('Las contraseñas no coinciden.') </script>";
				return false;
			}
		} else {
			echo "<script> alert('Contraseña incorrecta.') </script>";
			return false;
		}
	}

	function saveRequest() {
		$conectdb = conectarbd();
		$request = "";
	}

	function numIngr() {
		foreach($_POST['ingredientes'] as $check) {
			return $check;
		}
		
	}

 ?>