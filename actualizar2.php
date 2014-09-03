<?php 
  require_once "coneccion.php";
  $c=new coneccion();
  $c->Actualizar($_POST);
  header("location:lista.php?c=".$_POST['nt']);
 ?>