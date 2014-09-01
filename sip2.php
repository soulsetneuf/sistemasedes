<?php 
   require_once "coneccion.php";
   $c=new Coneccion();
   $query="call registrar_usuario('".$_POST['NAME']."','".$_POST['secret']."','".$_POST['exten']."');";
   $c->EjecutarConsulta($query);
 ?>