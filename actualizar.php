<?php 
  require_once "coneccion.php";
  require_once "menu.php";
  $c=new Coneccion();
  $m=new Menu();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Actualizar</title>
 	<link rel="stylesheet" type="text/css" href="stilo.css">
 </head>
 <body>
    <h1>Actualizar SIP</h1>
    <?php 
         $c->MostrarFormulario($_GET['c'],$_GET['n']); 
    ?>
 </body>
 </html>