<?php 
  require_once('objetos.php');
  require_once('funciones.php');
  session_start();

  if (isset($_SESSION['sesionIniciada'])) {
    $_SESSION['sesionIniciada'];
  } else {
    $_SESSION['sesionIniciada'] = false;
  }
 ?>
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
        $(document).ready(function(){
          // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
        });
    </script>
    
</head>

<body>
<?php 
    if (isset($_POST['send'])) { 

        $database = conectarbd();

        $usuario =  new Users();

        $consulta = "SELECT * from usuario where Login='".$_POST['user_Name']."' and Password='".md5($_POST['user_Password'])."'";

        $respuesta = saveData($database,$consulta);
        $filasCount = $respuesta->num_rows;
        
        if($filasCount === 1){ 
            $nombre = $respuesta->fetch_row();

            $usuario->setUsers($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4],$nombre[5],$nombre[6]);

            $_SESSION['sesionIniciada'] =true;

            $_SESSION['usuario'] = $usuario;
            header ("Location: home.php");
          
          } else {
            if (isset($_SESSION['numErrores'])) {
              $_SESSION['numErrores']++;
            } else {
              $_SESSION['numErrores'] = 0;
            }
            echo "<script>
                alert('Usuario o contraseña incorrectos');
              </script>";
              
          } 

        closebd($database);
      }

    ?>
    <nav>
        <div class="nav-wrapper lime accent-21">
        <a href="#" class="brand-logo">WOK</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="home.php">Home</a></li>
            <li><a href="#modal1">Entrar</a></li>
            <li><a href="#">Registrarse</a></li>
            <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
            <li><a href="contacto.php">Contacto</a></li>
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
                <input id="email" type="email" name="email" required/>
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
            <script type="text/javascript" src="comprobacion.js"></script>
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
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>Iniciar Sesion</h4>
        <form action="#" method="post">
           <div class="row">
            <div class="input-field col s6">
              <input name="user_Name" id="user_Name" type="text" required/>
              <label for="user_Name">Usuario</label>
            </div>
            <div class="input-field col s6">
              <input name="user_Password" id="user_Password" type="password" required/>
              <label for="user_Password">Contraseña</label>
            </div>
            <div class="modal-footer">
              <input class="btn waves-effect waves-light" type="submit" name="send" id="send">
            </div>
        </form>
      </div> 
    </div>
    
</body>
</html>