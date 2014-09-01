<?php 
  require_once "coneccion.php";
  require_once "menu.php";
  $c=new Coneccion();
  $m=new Menu();
  $consulta="select * from v_usuarios where codigo='".$_GET['c']."'";
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
         $c->MostrarFormulario($consulta,$_GET['n']); 
    ?>
 </body>
 </html>