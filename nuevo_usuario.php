<?php 
   require_once "menu.php";
   $m=new Menu();
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
	   <form method="POST" action="nuevo_usuario2.php">
	     <table>
	       <tr><td class="texto">Nick</td></tr>
	       <tr><td><input type="text" name="nick" class="caja_texto"></td></tr>
	       <tr><td class="texto">Password</td></tr>
	       <tr><td><input type="password" name="password" class="caja_texto"></td></tr>
	       <tr><td><input type="hidden" name="nt" value="7"></td></tr>
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