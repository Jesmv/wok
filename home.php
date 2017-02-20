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
            $('.slider').slider();
        });
        $(document).ready(function(){
          // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
        });
    </script>
</head>
<body style="background-color: #eceff1;">
  <?php 
      if (isset($_POST['action'])) {


        $database = conectarbd();

        $consulta = "INSERT INTO usuario (Login, Password, Email, Nombre, Firma, Tipo) VALUES ('".$_POST['user']."','".md5($_POST['password'])."','".$_POST['email']."','".$_POST['nameUser']."','".$_POST['firma']."','1')";

        $respuesta = saveData($database,$consulta);

        if($respuesta){
          echo "<script>alert('Su perfil se ha creado con exito. Inicie sesión con su usuario.')</script>";
        } else {
          echo "<script>
              alert('No se ha podido crear su perfil, el nickname o email coincide con el de un usuario.');
              window.location.pathname='wok/registro.php';
              </script>";
        }

        closebd($database);
      }

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
          
          } else {
            echo "<script>
                alert('Usuario o contraseña incorrectos');
              </script>";
              
          } 

        closebd($database);
      }

      if ($_SESSION['sesionIniciada'] && $_SESSION['usuario']->getTipo() ==="1") {
        
      ?>
        <nav class="nav-extended lime accent-21">
            <div class="nav-wrapper lime accent-21">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Home</a></li>
                <li><a href="editarPerfil.php">Editar Perfil</a></li>
                <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
                <li><a href="misPedidos.php">Mis pedidos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="salir.php">Cerrar Sesión</a></li>
            </ul>
            </div>
            <div class="nav-content lime accent-21">
              Bienvenid@ <?php echo $_SESSION['usuario']->getName(); ?> &nbsp;&nbsp; <?php echo date("d/m/o \a \l\a\s H:i:s"); ?>
              
            </div>
        </nav>
      <?php 
      } else if($_SESSION['sesionIniciada'] && $_SESSION['usuario']->getTipo() ==="2") {
      ?>
            <nav class="nav-extended lime accent-21">
            <div class="nav-wrapper lime accent-21">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Home</a></li>
                <li><a href="gestionarUsuarios.php">Gestionar Usuarios</a></li>
                <li><a href="wok.php">Wok</a></li>
                <li><a href="historialPedidos.php">Historial Pedidos</a></li>
                <li><a href="salir.php">Cerrar Sesión</a></li>
            </ul>
            </div>
            <div class="nav-content lime accent-21">
              Bienvenid@ <?php echo $_SESSION['usuario']->getName(),", ",$_SESSION['usuario']->getUser(),", ADMINISTRADOR"; ?> &nbsp;&nbsp; <?php echo date("d/m/o \a \l\a\s H:i:s"); ?>
              
            </div>
        </nav>
      <?php
      } else {
      ?>
        <nav>
            <div class="nav-wrapper lime accent-21">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Home</a></li>
                <li><a href="#modal1">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
            </div>
        </nav>
      <?php
      }
      
   ?>

  <div class="slider">
    <ul class="slides">
      <li>
        <img src="wok1.jpg"> <!-- random image -->
        <div class="caption center-align">
          <h3>Bienvenido!!</h3>
          <h5 class="light grey-text text-lighten-3">Vas a probar una nueva experiencia.</h5>
        </div>
      </li>
      <li>
        <img src="wok2.jpg"> <!-- random image -->
        <div class="caption left-align">
          <h3>Nuestros ingredientes</h3>
          <h5 class="light grey-text text-lighten-3">Ingrecientes frescos.</h5>
        </div>
      </li>
      <li>
        <img src="wok3.jpg"> <!-- random image -->
        <div class="caption right-align">
          <h3>Cocina</h3>
          <h5 class="light grey-text text-lighten-3">Nuestro Chef te hara sentir sabores inimaginables.</h5>
        </div>
      </li>
    </ul>
  </div>
  <div class="container">
      <div class="row">
          <div class="col s12">
             <h1><center>Wok to Walk</center></h1>
            <p class="flow-text">Somos un restaurante moderno de cocina wok vanguardista aquí en la isla. <br> Como funciona nuestra web:
            <ul class="flow-text">
               <li>Registrate</li>
               <li>Entra como usuario.</li>
               <li>En Nuevo pedido selecciona una base y los ingredientes que más te gusten.</li>
               <li>Y en menos de 45 minutos tendrás en la mesa un wok delicioso.</li>
             </ul> </p>   
          </div>
      </div>

      <div class="row">

        <h2><center>Algunas de nuestras bases</center></h2>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/fideo.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Noodle</span>
              <p>7.50 €</p>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/arroz.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Arroz</span>
              <p>6.65 €</p>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/verduras.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Verduras</span>
              <p>7.95 €</p>
            </div>
          </div>
        </div>
      </div>
 
  <div class="row">

        <h2><center>Nuestros Ingredientes</center></h2>
        <p><center>Cada ingrediente a 1€.</center></p>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/fideo.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Noodle</span>
              <p>7.50 €</p>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/arroz.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Arroz</span>
              <p>6.65 €</p>
            </div>
          </div>
        </div>
        <div class="col s4">
          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="imagenes/verduras.jpg">
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Base de Verduras</span>
              <p>7.95 €</p>
            </div>
          </div>
        </div>

      </div>
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
          <h5 class="white-text">De interes</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#!">Sobre nuestra compañia</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Nuestros restaurantes</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Historia</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Trabaja con nosotros</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      © 2014 Copyright Text
      <a class="grey-text text-lighten-4 right" href="#!">Jessica Manso</a>
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