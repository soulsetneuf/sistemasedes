<?php 
   require_once "usuarios.php";
   require_once "menu.php";
   require_once "coneccion.php";

   $u=new Usuarios();
   $u->formulario_usuarios();
   $c=new Coneccion();
   if (isset($_POST['exten'])) {
   	 echo "Entro";
   }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<link rel="stylesheet" type="text/css" href="stilo.css">
 </head>
 <body>
 
 </body>
 </html>