<?php 
   require_once "coneccion.php";
   $c=new Coneccion();
   $query="call usuario_nuevo('".$_POST['nick']."','".$_POST['password']."');";
   echo $query;
   $c->EjecutarConsulta($query) or die(mysql_error());
   header("location:lista.php?c=".$_POST['nt']);
 ?>