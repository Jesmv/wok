<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Compiled and minified JavaScript--> 
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
    <script>
        window.onload = function () {
            document.getElementById("action").onclick = validar;

            function validar () {
                var validarContrasenya = contrasenya();
                var validarCondiciones = confirmarCondiciones()

                if (validarContrasenya && validarCondiciones) {
                    return true;
                    
                } else {
                    return false;
                }
                
            }

            function contrasenya () {
                var contrasenya = document.getElementById("password");
                var contrasenya2 = document.getElementById("password2");

                if(contrasenya.value === contrasenya2.value){
                    return true;
                } else {
                    alert("Las contraseñas no coinciden.");
                    return false;
                }  
            }

            function confirmarCondiciones(){
                elemento = document.getElementById("test6");
                    if( !elemento.checked ) {
                        alert("* Acepte los terminos y condiciones para continuar.");
                        return false;
                    } else {
                        return true;
                    }
            }
        }
    </script>
</head>

<body>
    <nav>
        <div class="nav-wrapper lime accent-21">
        <a href="#" class="brand-logo">WOK</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="home.php">Entrar</a></li>
            <li><a href="sass.html">Registrarse</a></li>
            <li><a href="badges.html">Nuevo Pedido</a></li>
            <li><a href="collapsible.html">Contacto</a></li>
        </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <form class="col s12 m8 offset-m2" method="post" action="home.php">
            <div class="row">
                <div class="input-field col s6">
                <input name="user" id="user" type="text" required/>
                <label for="user">Usuario</label>
                </div>
                <div class="input-field col s6">
                <input id="name" type="text" name="nameUser" required/>
                <label for="name">Nombre</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                <input name="firma" id="firma" type="text" required/>
                <label for="disabled">Firma</label>
                </div>
                <div class="input-field col s6">
                <input id="email" type="email" name="email" class="validate" required/>
                <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                <input name="password" id="password" type="password" required/>
                <label for="password">Contraseña</label>
                </div>
                <div class="input-field col s6">
                <input name="password2" id="password2" type="password" required/>
                <label for="password2">Repita contraseña</label>
                </div>
            </div>
            
            <div class="row">
                <div class="col s12">
                    <input type="checkbox" id="test6">   
                    <label for="test6">Acepto los términos y condiciones de uso.</label>     
                </div>
            </div>
            <div class="row">
                <input class="btn waves-effect waves-light" type="submit" name="action" id="action">
            </div>
            </form>
        </div>
    </div>
    <footer class="page-footer lime accent-21">
        <div class="container">
        <div class="row">
            <div class="col l6 s12">
            <h5 class="white-text">WOK</h5>
            <p class="grey-text text-lighten-4">C/Mare Nostrum 4</p>
            <p class="grey-text text-lighten-4">Palmanova</p>
            <p class="grey-text text-lighten-4"><i class="material-icons">phone</i> 971 687 843</p>
            </div>
            <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Links</h5>
            <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
            </div>
        </div>
        </div>
        <div class="footer-copyright">
        <div class="container">
        © 2014 Copyright Text
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
        </div>
    </footer>
</body>
</html>