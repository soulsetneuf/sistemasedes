<?php 
  /*require_once "base/coneccion.php";
  $c=new Coneccion(); */
  $c = new mysqli('localhost', 'root', '', 'tesis');
  $sql="insert into pagina values('".$_POST['descripcion']."','".$_POST['area']."','".$_POST['url']."',now())";
  if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
  }
 ?>
