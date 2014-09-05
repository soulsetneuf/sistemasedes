<?php 
   require_once "usuarios.php";
   require_once "menu.php";
   $u=new Usuarios();
   $m=new Menu();

   if (isset($_POST['value'])) {
   	 $u->registrar_usuarios($_POST);
   }
   else
   {
     $u->formulario_usuarios();
   }
 ?>