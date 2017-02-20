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

      if (isset($_POST['guardarBase'])) {
        modificarBase(); 
      }

      if (isset($_POST['guardarIng'])) {
         modificarIng();   
      }

      if (isset($_POST['eliminarBase'])) {
         eliminarBase();   
      }

      if (isset($_POST['eliminarIng'])) {
         modificarIng();   
      }

      if (isset($_POST['nuevaBase'])) {
         introducirBase();   
      }

      if (isset($_POST['nuevoIng'])) {
         introducirIng();   
      }

      $dbconection = conectarbd();
      $consultaBases = "SELECT * FROM bases";
      $resultadoBases = saveData($dbconection, $consultaBases);

      $consultaIng = "SELECT * FROM ingredientes";
      $resultadoIng = saveData($dbconection, $consultaIng);

      closebd($dbconection);

      

  ?>
        <nav class="nav-extended grey darken-1">
        <div class="nav-wrapper grey darken-1">
        <a href="#" class="brand-logo">WOK</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="home.php">Home</a></li>
            <li><a href="gestionarUsuarios.php">Gestionar Usuarios</a></li>
            <li><a href="#">Wok</a></li>
            <li><a href="historialPedidos.php">Historial Pedidos</a></li>
            <li><a href="salir.php">Cerrar Sesión</a></li>
        </ul>
        </div>
        <div class="nav-content grey darken-1">
          Bienvenid@ <?php echo $_SESSION['usuario']->getName(),", ",$_SESSION['usuario']->getUser(),", ADMINISTRADOR"; ?> &nbsp;&nbsp; <?php echo date("d/m/o \a \l\a\s H:i:s"); ?>
          
        </div>
    </nav>
    <h3>Bases e Ingredientes</h3>
    <h5>Bases:</h5>
    <ul class="collapsible popout" data-collapsible="accordion">

      <?php while($row = $resultadoBases->fetch_array()) { ?>
      <li>
        <div class="collapsible-header"><?php echo $row[1] ?></div>
        <div class="collapsible-body">
          <div class="row">
            <form action="#" method="post" class="col s6">
            <input type="hidden" name="idBase" value="<?php echo $row[0] ?>">
              <div class="row">
                <div class="input-field col s6">
                  <input name="nombre" type="text" value="<?php echo $row[1] ?>" required/>
                  <label for="nombre">Nombre de base</label>
                </div>
                <div class="input-field col s6">
                  <input name="precio" type="text" value="<?php echo $row[2] ?>" required/>
                  <label for="precio">Precio en €</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input id="first_name" type="submit" name="guardarBase" value="Modificar">
                </div>
                <div class="input-field col s6">
                  <input id="first_name" type="submit" name="eliminarBase" value="Eliminar"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </li>
      <?php } ?>
      <li>
        <div class="collapsible-header"><b>Introducir nueva base</b></div>
        <div class="collapsible-body">
          <div class="row">
            <form action="#" method="post" class="col s6">
              <div class="row">
                <div class="input-field col s4">
                  <input name="idBaseNuevo" type="number" required/>
                  <label for="idBaseNuevo">Id de base</label>
                </div>
                <div class="input-field col s4">
                  <input name="nombreNuevo" type="text" required/>
                  <label for="nombreNuevo">Nombre de base</label>
                </div>
                <div class="input-field col s4">
                  <input name="precioNuevo" type="text" required/>
                  <label for="precioNuevo">Precio en €</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <input id="first_name" type="submit" name="nuevaBase" value="Introducir">
                </div>
              </div>
            </form>
          </div>
        </div>
      </li>
    </ul>
    <h5>Ingredientes</h5>
    <ul class="collapsible popout" data-collapsible="accordion">
    <?php while($row = $resultadoIng->fetch_array()) { ?>
      <li>
        <div class="collapsible-header"><?php echo $row[0] ?></div>
        <div class="collapsible-body">
          <div class="row">
            <form action="#" method="post" class="col s6">
            <input type="hidden" name="nombreIng" value="<?php echo $row[0] ?>">
              <div class="row">
                <div class="input-field col s6">
                  <input name="descripcion" type="text" value="<?php echo $row[1] ?>" required/>
                  <label for="descripcion">Modificar Descripción</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s2">
                  <input type="submit" name="guardarIng" value="Modificar"> 
                </div>
                <div class="input-field col s2">
                  <input type="submit" name="eliminarIng" value="Eliminar"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </li>
      <?php } ?>

      <li>
        <div class="collapsible-header"><b>Introduce ingrediente nuevo</b></div>
        <div class="collapsible-body">
          <div class="row">
            <form action="#" method="post" class="col s6">
            <input type="hidden" name="nombreIng">
              <div class="row">
                <div class="input-field col s6">
                  <input name="nombreIngNuevo" type="text" required/>
                  <label for="nombreIngNuevo">Nombre ingrediente</label>
                </div>
                <div class="input-field col s6">
                  <input name="descripcionNueva" type="text">
                  <label for="descripcionNueva">Descripción</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s2">
                  <input type="submit" name="nuevoIng" value="Introducir"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </li>
    </ul>

  <?php

  } else {
  ?>
   <script>
        alert("Solo usuarios registrados pueden realizar pedidos.");
        window.location.pathname='wok/home.php';
      </script>
<?php
  }
      
?>
  
</body>
</html>