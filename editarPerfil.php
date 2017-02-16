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
</head>
<body>
  <?php 

      if (isset($_SESSION['sesionIniciada'])) {
         if(isset($_POST['modificar'])) {

          if (checkName() && downloadImage() && checkFirma() && changePass()) {
            
            $_SESSION['usuario'] -> setName($_POST['name']);
            $_SESSION['usuario'] -> setEmail($_POST['email']);
            $_SESSION['usuario'] -> setFirma($_POST['firma']);
            $_SESSION['usuario']->setAvatar($_SESSION['nuevoAvatar']);

            $dataBase = conectarbd();
            $consulta = "UPDATE usuario SET Password='".$_SESSION['usuario']->getPass()."', Nombre='".$_SESSION['usuario']->getName()."', Email='".$_SESSION['usuario']->getEmail()."', Avatar='".$_SESSION['usuario']->getAvatar()."' Where Login='".$_SESSION['usuario']->getUser()."'";
            saveData($dataBase, $consulta); // Guardo los datos nuevos en la base de datos.
            closebd($dataBase);

            echo "<script> alert('Perfil modificado.') </script>";

          }   
          
        } elseif (isset($_POST['final'])){
          echo "<script>
                window.location.pathname='../practica12y13/practica13/usuario.php';
              </script>";
        }
      ?>
        <nav class="nav-extended lime accent-21">
            <div class="nav-wrapper lime accent-21">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="home.php">Home</a></li>
                <li><a href="#">Editar Perfil</a></li>
                <li><a href="nuevoPedido.php">Nuevo Pedido</a></li>
                <li><a href="misPedidos.php">Mis pedidos</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="cerrar.php">Cerrar Sesión</a></li>
            </ul>
            </div>
            <div class="nav-content lime accent-21">
              Bienvenid@ <?php echo $_SESSION['usuario']->getName(); ?>
            </div>
        </nav>
        <h1 class="text-center">Editar Perfil</h1>
        <h2 class="text-center">Datos de la Cuenta</h2>

        <div class="row">
          <form class="col s5 offset-m2" method="post" action="#" ENCTYPE="multipart/form-data">
            <div class="row">
            <div class="input-field col s12">
              <input placeholder="Placeholder" id="user" type="text" value="<?php echo $_SESSION['usuario'] -> getUser(); ?> " readonly>
              <label for="user">User</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
              <input id="name" name="name" type="text" value="<?php echo $_SESSION['usuario'] -> getName(); ?> " required/>
              <label for="name">Name</label>
            </div>
          </div>
          <div class="row">
            <div class="file-field input-field">
              <div class="btn">
                <span>File</span>
                <input type="file" name="imagen">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" id="file" type="text" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" name="email" value="<?php echo $_SESSION['usuario'] -> getEmail(); ?> " required/>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="firma" type="text" name="firma" value="<?php echo $_SESSION['usuario'] -> getFirma(); ?> " required/>
              <label for="firma">Firma</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Placeholder" id="rango" type="text" value="<?php echo $_SESSION['usuario'] -> getTipo(); ?> " readonly>
              <label for="rango">User</label>
            </div>
            </div>
          <h2 class="text-center">Cambiar Contraseña</h2>
          <div class="row">
            <div class="input-field col s12">
              <input name="oldPass" id="oldPass" name="oldPass" type="password">
              <label for="oldPass">Antigua contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input name="newPass" id="newPass" name="NewPass" type="password">
              <label for="newPass">Nueva contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input name="repeatNewPass" id="repeatNewPass" name="repeatNewPass" type="password" >
              <label for="repeatNewPass">Repita nueva contraseña</label>
            </div>
          </div>
          <div class="row">
              <input class="btn waves-effect waves-light" type="submit" name="modificar" id="modificar">
          </div>
        </form>

        <div class="col s3">
          <img src="<?php echo $_SESSION['usuario'] -> getAvatar(); ?>" alt="Avatar" class=" circle responsive-img" with="200px" height="200px">
        </div>
      </div>


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