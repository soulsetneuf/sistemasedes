<?php 
   require_once "coneccion.php";
   require_once "menu.php";
   $m=new Menu();
   $c=new Coneccion();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista de usuarios</title>
	<link rel="stylesheet" type="text/css" href="stilo.css">
</head>
<body>
     <h1>Lista de usuarios</h1>
    <?php  $c->MostrarTabla($_GET['c']); ?>
        
</body>
</html>