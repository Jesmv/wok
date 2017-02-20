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

      if ($_SESSION['sesionIniciada']) {

        if(isset($_GET['login'])){

          $database = conectarbd();

          $_SESSION['usuarioCambiar'] =  new Users();

          $consulta = "SELECT * from usuario where Login='".$_GET['login']."'";

          $respuesta = saveData($database,$consulta);
          
          $nombre = $respuesta->fetch_row();

            $_SESSION['usuarioCambiar']->setUsers($nombre[0],$nombre[1],$nombre[2],$nombre[3],$nombre[4],$nombre[5],$nombre[6]);
          $mostrar = true;

        } else {
          $_SESSION['usuarioCambiar'] =  new Users();
          $_SESSION['usuarioCambiar'] = $_SESSION['usuario'];

          $mostrar = false;
        }

        //var_dump(isset($_POST['modificar']));
         if(isset($_POST['modificar'])) {

          if ($mostrar === false) {
            $guardar = saveProfile();
            if ($guardar) {
              echo "<script> alert('Perfil modificado.') </script>";
            } else {
              echo "<script> alert('No se ha podido modificar el perfil.') </script>";
            } 

          } else {
            $guardar = saveProfileAdmin();
            if ($guardar) {
              echo "<script> alert('Perfil modificado.') </script>";
            } else {
              echo "<script> alert('No se ha podido modificar el perfil.') </script>";
            }
          } 
          
      } 

      if ($mostrar) { 
      ?>
        <nav class="nav-extended grey darken-1">
            <div class="nav-wrapper grey darken-1">
            <a href="#" class="brand-logo">WOK</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#">Home</a></li>
                <li><a href="gestionarUsuarios.php">Gestionar Usuarios</a></li>
                <li><a href="wok.php">Wok</a></li>
                <li><a href="historialPedidos.php">Historial Pedidos</a></li>
                <li><a href="salir.php">Cerrar Sesión</a></li>
            </ul>
            </div>
            <div class="nav-content grey darken-1">
              Bienvenid@ <?php echo $_SESSION['usuario']->getName(),", ",$_SESSION['usuario']->getUser(),", ADMINISTRADOR"; ?> &nbsp;&nbsp; <?php echo date("d/m/o \a \l\a\s H:i:s"); ?>
              
            </div>
        </nav>
      <?php 
      } else {
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
                <li><a href="salir.php">Cerrar Sesión</a></li>
            </ul>
            </div>
            <div class="nav-content lime accent-21">
              Bienvenid@ <?php echo $_SESSION['usuario']->getName(); ?> &nbsp;&nbsp; <?php echo date("d/m/o \a \l\a\s H:i:s"); ?>
            </div>
        </nav>
      <?php } ?>
        <h1 class="text-center">Editar Perfil</h1>
        <h2 class="text-center">Datos de la Cuenta</h2>

        <div class="row">
          <form class="col s5 offset-m2" method="post" action="#" ENCTYPE="multipart/form-data">
            <div class="row">
            <div class="input-field col s12">
              <input id="user" name="user" type="text" value="<?php echo $_SESSION['usuarioCambiar'] -> getUser(); ?>" <?php if($mostrar === true){ ?> required/ <?php }else{ ?> readonly <?php } ?>>
              <label for="user">User</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
              <input id="nameUser" name="name" type="text" value="<?php echo $_SESSION['usuarioCambiar'] -> getName(); ?>" required/>
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
              <input id="email" type="email" name="email" value="<?php echo $_SESSION['usuarioCambiar'] -> getEmail(); ?>" required/>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="firma" type="text" name="firma" value="<?php echo $_SESSION['usuarioCambiar'] -> getFirma(); ?>" required/>
              <label for="firma">Firma</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Placeholder" id="rango" name="rango" type="text" value="<?php echo $_SESSION['usuarioCambiar'] -> getTipo();?>" <?php if($mostrar === true){ ?> required/ <?php }else{ ?> readonly <?php } ?>>
              <label for="rango">Rango</label>
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
          <img src="<?php echo $_SESSION['usuarioCambiar'] -> getAvatar(); ?>" alt="Avatar" class=" circle responsive-img" with="200px" height="200px">
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
        <?php 
      } else {
        header ("Location: home.php");
      }
      
   ?>
</body>
</html>