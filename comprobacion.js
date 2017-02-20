window.onload = function () {
	
	document.getElementById("action").onclick = checkSingUp;
	document.getElementById("modificar").onclick = checkSend;

}
	function checkSingUp() {
		var checkUsuario = checkUser();
		var checkNombre = checkName();
		var checkFirmas = checkFirma();
		var checkPass = checkPassword();

		if(checkUsuario && checkNombre && checkFirmas && checkPass) {
			window.location.pathname='wok/home.php';

			return true;
		} else {
			return false;
		}
	}

	function checkSend() {
		var checkUsuario = checkUser();
		var checkNombre = checkName();
		var checkFirmas = checkFirma();

		if(checkUsuario && checkNombre && checkFirmas) {
			return true;
		} else {
			return false;
		}
	}

	function checkUser() {
		var user = document.getElementById("user");
		if(/^[\w\d]{3,}$/.test(user.value)){
			return true;
		} else {
			alert('Usuario incorrecto, mínimo tres letras o dígitos');
			return false;
		}
	}

	function checkName() {
		var nameUser = document.getElementById("name");
		if(/^[a-zA-Z]{3,}((\s[a-zA-Z]{2,}){0,})?$/.test(nameUser.value)){
			return true;
		} else {
			alert('Nombre incorrecto, mínimo tres letras o dígitos');
			return false;
		}
	}

	function checkFirma() {
		var firma = document.getElementById("firma");
		if(/^[\w]{1,}((\s\w{1,}){0,})?$/.test(firma.value)){
			return true;
		} else {
			alert('Firma incorrecto, mínimo tres letras o dígitos');
			return false;
		}
	}

	function checkPassword() {
		var pass = document.getElementById("password");
		var passDos = document.getElementById("password2");
		if(/^[\w\d]{3,}$/.test(pass.value)){
			if(pass.value === passDos.value){
				return true;
			} else {
				alert('Las contraseñas no coinciden.');
				return false;
			}

		} else {
			alert('Password incorrecto, mínimo tres letras o dígitos');
			return false;
		}
	}	
