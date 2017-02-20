<?php 
	function conectarbd() {
		$bdd = new mysqli('localhost', 'root', '', 'wok');
		$bdd -> set_charset('UTF8'); 
		return $bdd;

	}

	function saveData($registro, $consulta){

		return $registro->query($consulta);
	}

	function closebd($bdd) {
		return $bdd -> close();
	}

	function checkUser() {
		$regex = "/^[\w]{3,}$/";
		$user = $_POST['user'];
		if(preg_match($regex, $user)){
			return true;
		} else {
			echo "<script> alert('Usuario incorrecto, mínimo tres letras o dígitos') </script>";
			return false;
		}
	}

	function checkName() {
		$regex = "/^[a-zA-Z]{3,}((\s[a-zA-Z]{3,}){0,})?$/";
		$name = $_POST['name'];
		if(preg_match($regex, $name)){
			return true;
		} else {
			echo "<script> alert('Nombre incorrecto, mínimo tres letras.') </script>";
			return false;
		}
	}

	function checkFirma() {
		$regex = "/^[\w]{1,}((\s\w{1,}){0,})?$/";
		$firma = $_POST['firma'];
		if(preg_match($regex, $firma)){
			return true;
		} else {
			echo "<script> alert('Firma incorrecta, mínimo tres letras.') </script>";
			return false;
		}
	}

	function checkRango() {
		$regex = "/^[1|2]{1}$$/";
		$rango = $_POST['rango'];
		if(preg_match($regex, $rango)){
			return true;
		} else {
			echo "<script> alert('Rango incorrecto, solo 1 o 2.') </script>";
			return false;
		}
	}

	function checkPassword() {
		$regex = "/^[\w\d]{3,}$/";
		$password = $_POST['password'];
		if(preg_match($regex, $user)){
			return true;
		} else {
			echo "<script> alert('Contraseña incorrecta, mínimo tres letras o dígitos') </script>";
			return false;
		}
	}


	/*Guarda la imagen en una carpeta. Primero comprueba que el campo no esté vacio. Lo hago comprobando si es el error 4, que indica que se encuentra vacio el input del file, si es así me devuelve true, ya que considero que se puede tener vacio porque no se quiera cambiar la imagen.. */
	function downloadImage() {

		if ($_FILES['imagen']['error']==4) {
			$_SESSION['nuevoAvatar']=$_SESSION['usuarioCambiar']->getAvatar();
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
					echo "<script> alert('Error al cargar la imagen2') </script>";
					return false;
				}
				
			} else {
				echo "<script> alert('Error al cargar la imagen 1.') </script>";
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

		if($oldPass === $_SESSION['usuarioCambiar']->getPass()) {
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

	function guardarPedido() {
		$base = $_POST['bases'];
        $resultado = "";

        foreach ($_POST['ingredientes'] as $extra)
            $resultado = $resultado."$extra ";
        
        
        $numIngredientes = count($_POST['ingredientes']);
        $fecha = date("d/m/o \a \l\a\s H:i:s");

        $dbconect = conectarbd();

        $consulta = "INSERT INTO pedidos (login, idBase, numIng, ingredientes, fechayhora, servido) VALUES ('".$_SESSION['usuario']->getUser()."', '".$base."', '".$numIngredientes."','".$resultado."' ,'".$fecha."', 0)";
        

        $check = saveData($dbconect, $consulta); // Guardo los datos nuevos en la base de datos.
        
        closebd($dbconect);

        if ($check) {
        	return true;
        } else {
        	return false;
        }
        
	}

	function misPedidos() {
		$dbconect = conectarbd();

		$consulta = "SELECT p.*, b.precio, b.descripcion FROM pedidos p, bases b WHERE p.idBase=b.idBase and p.login='".$_SESSION['usuario']->getUser()."' ORDER BY p.servido";
		$result=saveData($dbconect, $consulta);
		
		closebd($dbconect);
		return $result;
	}

	function modificarBase() {
		$idBase = htmlspecialchars($_POST['idBase']);
        $nombreBase = $_POST['nombre'];
        $precioBase = $_POST['precio'];
        
        $dbconection = conectarbd(); 
        
        $consultaBases = "UPDATE bases SET descripcion='".$nombreBase."', precio='".$precioBase."' WHERE idBase='$idBase'";

        $resultadoBases = saveData($dbconection, $consultaBases); 
        
        closebd($dbconection); 
	}

	function modificarIng() {
		$nomIng = htmlspecialchars($_POST['nombreIng']);
        $descripcion = $_POST['descripcion'];
        
        $dbconection = conectarbd(); 
        
        $consultaIng = "UPDATE ingredientes SET descripcion='".$descripcion."' WHERE nombreIng='".$nomIng."'";

        $resultadoBases = saveData($dbconection, $consultaIng); 
        
        closebd($dbconection); 
	}

	function eliminarBase() {
		$idBase = htmlspecialchars($_POST['idBase']);
        
        $dbconection = conectarbd(); 
        
        $consultaBases = "DELETE FROM bases WHERE idBase='$idBase'";

        $resultadoBases = saveData($dbconection, $consultaBases); 
        
        closebd($dbconection); 
	}

	function IntroducirBase() {
		$idBase = $_POST['idBaseNuevo'];
		$nombreBase = $_POST['nombreNuevo'];
        $precioBase = $_POST['precioNuevo'];
        
        $dbconection = conectarbd(); 
        
        $consultaBases = "INSERT INTO bases (idBase, descripcion, precio) VALUES ('$idBase','$nombreBase', '$precioBase')";

        $resultadoBases = saveData($dbconection, $consultaBases); 
        
        closebd($dbconection); 
	}

	function IntroducirIng() {
		$nombreIng = $_POST['nombreIngNuevo'];
        $precioIng = $_POST['descripcionNueva'];
        
        $dbconection = conectarbd(); 
        
        $consultaBases = "INSERT INTO ingredientes (nombreIng, descripcion) VALUES ('$nombreIng', '$precioIng')";

        $resultadoBases = saveData($dbconection, $consultaBases); 
        
        closebd($dbconection); 
	}

	function mostrarPedidos() {
		$dbconect = conectarbd();

		$consulta = "SELECT * FROM pedidos ORDER BY servido";
		$result=saveData($dbconect, $consulta);
		
		closebd($dbconect);
		return $result;
	}

	function saveProfile () {
		$name = checkName();
		$imagen = downloadImage();
		$firma = checkFirma();
		$password = changePass();

		if ($name && $imagen  && $firma && $password) {
            
	       $_SESSION['usuarioCambiar'] -> setName($_POST['name']);
	       $_SESSION['usuarioCambiar'] -> setEmail($_POST['email']);
	       $_SESSION['usuarioCambiar'] -> setFirma($_POST['firma']);
	       $_SESSION['usuarioCambiar']->setAvatar($_SESSION['nuevoAvatar']);

	       $dataBase = conectarbd();
	       $consulta = "UPDATE usuario SET Password='".$_SESSION['usuarioCambiar']->getPass()."', Nombre='".$_SESSION['usuarioCambiar']->getName()."', Email='".$_SESSION['usuarioCambiar']->getEmail()."', Avatar='".$_SESSION['usuarioCambiar']->getAvatar()."' Where Login='".$_SESSION['usuarioCambiar']->getUser()."'";
	       saveData($dataBase, $consulta); // Guardo los datos nuevos en la base de datos.
	       closebd($dataBase);

	       return true;

	    } else {
	       return false;
	    }
	}

	function saveProfileAdmin () {
		$dataBase = conectarbd();

		if(checkUser()) {
			$comprobarLogin = loginExist();
			if ($comprobarLogin && checkName() && downloadImage()  && checkFirma() && changePass() && checkRango()) {
	            
	           	$_SESSION['usuarioCambiar'] -> setUser($_POST['user']);
		       	$_SESSION['usuarioCambiar'] -> setName($_POST['name']);
		       	$_SESSION['usuarioCambiar'] -> setEmail($_POST['email']);
		       	$_SESSION['usuarioCambiar'] -> setFirma($_POST['firma']);
		       	$_SESSION['usuarioCambiar']->setAvatar($_SESSION['nuevoAvatar']);
		       	$_SESSION['usuarioCambiar'] -> setTipo($_POST['rango']);

		       
		       	$consulta = "UPDATE usuario SET Password='".$_SESSION['usuarioCambiar']->getPass()."', Nombre='".$_SESSION['usuarioCambiar']->getName()."', Email='".$_SESSION['usuarioCambiar']->getEmail()."', Avatar='".$_SESSION['usuarioCambiar']->getAvatar()."' Where Login='".$_SESSION['usuarioCambiar']->getUser()."'";
		       	saveData($dataBase, $consulta); // Guardo los datos nuevos en la base de datos.
		       	closebd($dataBase);

		       return true;

		    } else {
		    	$dataBase = conectarbd();
		       	return false;
		    }
		}
	}

	function loginExist() {
		if ($_POST['user'] === $_SESSION['usuarioCambiar'] -> getUser()) {
			return true;
		} else {
			if(checkUser()) {
				$dataBase = conectarbd();
				$consulta = "SELECT * from usuario where Login='".$_POST['user']."'";
				$respuesta = saveData($dataBase, $consulta); // Guardo los datos nuevos en la base de datos.
			    $filasCount = $respuesta->num_rows;
			    closebd($dataBase);
			    if($filasCount === 1){
			    	echo "<script>
	                		alert('El usuario ya existe.');
	              			</script>";
	              	return false;
			    } else {
			    	return true;
			    }
			}
		}
	}

 ?>