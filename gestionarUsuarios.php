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
      $('.collapsible').collapsible();
    });
  </script>
</head>
<body>
  <?php
    if($_SESSION['sesionIniciada'] && $_SESSION['usuario']->getTipo() ==="2") {
      $dbconection = conectarbd();
      if (isset($_GET['login'])) {
      	$usuario = $_GET['login'];
      	$deleteUser = "DELETE FROM usuario WHERE login='$usuario'";
      	$resultadoDeleteUser = saveData($dbconection, $deleteUser);
      }
      $consultaUsers = "SELECT * FROM usuario";
      $resultadoUsers = saveData($dbconection, $consultaUsers);
      closebd($dbconection);
  ?>
    <nav class="nav-extended grey darken-1">
        <div class="nav-wrapper grey darken-1">
        <a href="#" class="brand-logo">WOK</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="home.php">Home</a></li>
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
    <h3>Gestion de Usuarios</h3>
    <h5>Usuarios:</h5>
    <ul class="collection">

      <?php while($row = $resultadoUsers->fetch_array()) { 
      	$login = urlencode($row[0]);
      ?>
      	
	    <li class="collection-item avatar">
	      <img src="<?php echo $row[5] ?>" alt="" class="circle">
	      <span class="title"><?php echo $row[0] ?></span>
	      <p><?php echo $row[3] ?> <br>
	         <?php echo $row[4] ?>
	      </p>
	      <p class="secondary-content">
	      	<a href="editarPerfil.php?login=<?php echo $login ?>" class="btn-floating waves-effect waves-light green"><i class="material-icons">mode_edit</i></a>
	      	<a href="gestionarUsuarios.php?login=<?php echo $login ?>" class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a>

	      </p>
	    </li>

      <?php } ?>
    </ul>
  <?php
       } else {
  ?>
   <script>
      alert("Solo usuarios registrados pueden visitar esta página.");
      window.location.pathname='wok/home.php';
    </script>
<?php
  }
      
?>
  
</body>
</html>