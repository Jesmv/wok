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
    <?php

         if(isset($_POST['sendPedido'])) {
            $base = $_POST['bases'];
            $resultado = "";
            foreach ($_POST['ingredientes'] as $extra)
                $resultado = $resultado."$extra ";
        }

            print_r("$resultado");
        $dbconect = conectarbd();

        $consultaBases = "SELECT * from bases";
        $consultaIngredientes = "SELECT * from ingredientes"; 
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
</body>
</html>