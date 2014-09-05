<?php 
  require_once "coneccion.php";
  $c=new coneccion();
  $c->EjecutarConsulta("call eliminar_usuario(".$_GET['c'].")");
  header("location:lista.php")
?>