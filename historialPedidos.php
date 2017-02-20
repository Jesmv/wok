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
      $result = mostrarPedidos();
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
    <main class="row">
      <div class="col offset-s1 s10">
      <h3><center>Historial de pedidos</center></h3>
      <table>
        <tr>
            <th>Nº Pedido</th>
            <th>Usuario</th>
            <th>IdBase</th>
            <th>Nº Ingredientes</th>
            <th>Ingredientes</th>
            <th>Fecha</th>
            <th>Servido</th>
        </tr>

    <?php
        while($row = $result->fetch_array()) {
            if($row[6]==1){
                echo "<tr class='teal accent-1'>";
                echo "<td>",$row[0],"</td>";
                echo "<td>",$row[1],"</td>";
                echo "<td>",$row[2],"</td>";
                echo "<td>",$row[3],"</td>";
                echo "<td>",$row[4],"</td>";
                echo "<td>",$row[5],"</td>";
                echo "<td>Servido</td>";
                echo "</tr>";
            } else {
                echo "<tr class='red lighten-4'>";
                echo "<td><b>",$row[0],"</b></td>";
                echo "<td><b>",$row[1],"</b></td>";
                echo "<td><b>",$row[2],"</b></td>";
                echo "<td><b>",$row[3],"</b></td>";
                echo "<td><b>",$row[4],"</b></td>";
                echo "<td><b>",$row[5],"</b></td>";
                echo "<td><b>Pendiente</b></td>";
                echo "</tr>";
            }
            
            
        }
        echo "</table>";
  ?>
      </div>
    </main>
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