<?php 
   require_once "menu.php";
   require_once "coneccion.php";
   $c=new Coneccion();
   $m=new Menu();
   if (isset($_POST['estado'])) {
   	   $query="call registrar_usuario('".$_POST['NAME']."','".$_POST['secret']."','".$_POST['exten']."','".$_POST['email']."');";
       $c->EjecutarConsulta($query);
       header("location:lista.php?c=".$_POST['nt']);
   }
   else
   {
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Nuevo usuario</title>
 	<link rel="stylesheet" type="text/css" href="stilo.css">
 </head>
 <body>
    <div class="contenedor_principal">
    <div class="contenedor_formulario">
       <h1>Nuevo Usuario</h1>
	   <form method="POST" action="nuevo_usuario.php">
	     <table>
	       <tr><td class="texto">Nick</td></tr>
	       <tr><td><input type="text" name="NAME" class="caja_texto"></td></tr>
	       <tr><td class="texto">Numero telefonico</td></tr>
	       <tr><td><input type="text" name="exten" class="caja_texto"></td></tr>
	       <tr><td class="texto">Email</td></tr>
	       <tr><td><input type="text" name="email" class="caja_texto"></td></tr>
	       <tr><td class="texto">Password</td></tr>
	       <tr><td><input type="password" name="secret" class="caja_texto"></td></tr>
	       <tr><td><input type="hidden" name="nt" value="7"></td></tr>
	       <tr><td><input type="hidden" name="estado" value="1"></td></tr>
	       <tr><td><input type="submit" name="guardar" value='Aceptar' class="boton"></td></tr>	
	     </table>	 
	   </form>
    </div>
   <div class="contenedor_footer">
   	  <!Todos los derechos reservados> 
   </div>
</div>
 </body>
 </html>
<?php 
  }
?>