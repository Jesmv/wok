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
     $(document).ready(function() {
        $('select').material_select();
      });
  </script>
</head>
<body>

<?php
  if (isset($_SESSION['sesionIniciada'])) {

    $dbconect = conectarbd();

    $consultaBases = "SELECT * from bases";
    $consultaIngredientes = "SELECT * from ingredientes";  
    
?>
    <nav class="nav-extended lime accent-21">
        <div class="nav-wrapper lime accent-21">
        <a href="#" class="brand-logo">WOK</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="home.php">Home</a></li>
            <li><a href="editarPerfil.php">Editar Perfil</a></li>
            <li><a href="#">Nuevo Pedido</a></li>
            <li><a href="misPedidos.php">Mis pedidos</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="salir.php">Cerrar Sesión</a></li>
        </ul>
        </div>
        <div class="nav-content lime accent-21">
          Bienvenid@ <?php echo $_SESSION['usuario']->getName(); ?>
        </div>
    </nav>
    

    <img src="imagenes/ingredientes.png" alt="ingredientes">

    <div>
      <h1>1º Elige tu base preferida</h1>
      <p>Cada wok de Wok to Walk es único y no existen reglas para disfrutarlo. Mezclalo como quieras, pon los ingrecientes que más te gusten y a disfrutar.</p>
      <p>¿Has pensado ya qué base elegir?</p>
    </div>
    <div>
      <form action="misPedidos.php" method="post" class='offset-s4 col s4'>
      <?php
        $resultBases = saveData($dbconect, $consultaBases);
        echo "<div class='row'><div class='input-field'><select class='col offset-s4 s4'>";
         while($rowBases = $resultBases->fetch_array()) {
        
         echo "<option value='".$rowBases["idBase"]."'>".$rowBases["descripcion"]."  ".$rowBases["precio"]."</option>";
        }
        echo "</select>";

         $resultIngredientes = saveData($dbconect, $consultaIngredientes);
        echo "<div class='row'><p class='col offset-s4 s4'>";
    
         while($rowIng = $resultIngredientes->fetch_array()) {
        
         echo "<input type='checkbox' id='".$rowIng["nombreIng"]."' name='".$rowIng["nombreIng"]."'/>";
         echo "<label for='".$rowIng["nombreIng"]."'>".$rowIng["nombreIng"]." ".$rowIng["descripcion"]."</label><br>";
        }
        echo "</p></div>";

        
      ?>
       <input type="submit" name="sendPedido" value="Enviar pedido">
      
      </form>
    </div>
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