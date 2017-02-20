<?php 
  require_once('objetos.php');
  require_once('funciones.php');
  session_start();

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

        $_SESSION['usuario'] = new Users();

        $consulta = "SELECT * from Usuario where Login='".$_POST['user_Name']."' and Password='".md5($_POST['user_Password'])."'";

        $respuesta = saveData($database,$consulta);

        if($respuesta->num_rows==1){ 
          
            $nombre = $respuesta->fetch_row();
            $_SESSION['usuario'] -> setUsers($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4],$nombre[5],$nombre[6]);
            $_SESSION['sesionIniciada'] =true;
          
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

      if ($_SESSION['sesionIniciada'] && $_SESSION['usuario']->getTipo() ==="1") {
         
      ?>
        <nav class="nav-extended lime accent-21">
            <div class="nav-wrapper lime accent-21">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="home.php">Home</a></li>
                <li><a href="editarPerfil.php">Editar Perfil</a></li>
                <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
                <li><a href="misPedidos.php">Mis pedidos</a></li>
                <li><a href="#">Contacto</a></li>
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
                <li><a href="home.php">Home</a></li>
                <li><a href="#modal1">Entrar</a></li>
                <li><a href="registro.php">Registrarse</a></li>
                <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            </div>
        </nav>
      <?php
      }
      
   ?>
  <div id="contacto">
      <h1 style="text-align:center;">Aqui me encontrarás</h1>
      <div class="row">
        <div class="col s12">
        <div class="col offset-s2 s4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6155.899768424299!2d2.531906668389593!3d39.515620779379375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12978933899f0e69%3A0x85a7562f7d19ffcd!2sCarrer+Mare+Nostrum%2C+1%2C+07181+Calvi%C3%A0%2C+Illes+Balears!5e0!3m2!1ses!2ses!4v1478019949638" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="col offset-s1 s4">
        <div style="vertical-align: center;">
          <p style="vertical-align: center;">
            <span class="glyphicon glyphicon-map-marker"></span>  Palmanova, Calvià
          </p>
          <p style="vertical-align: center;">
            <span class="glyphicon glyphicon-phone-alt"></span>  Teléfono: +34 681 396 236
          </p>
          <p style="vertical-align: center;">
            <span class="glyphicon glyphicon-send"></span>  Email: jesmv83@gmail.com
          </p>
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