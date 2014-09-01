<!DOCTYPE html>
<html>
<head>
	<title>
		Registrar SIP
	</title>
	<link rel="stylesheet" type="text/css" href="stilo.css">
</head>
<body>
<a href="sip.php">Registrar usuarios</a><br>
<a href="lista.php">Lista</a><br>
<div class="contenedor_principal">
    <div class="contenedor_formulario">
       <h1>Registro de usuarios SIP</h1>
	   <form method="POST" action="sip2.php">
	     <table>
	       <tr><td class="texto">Nombre</td></tr>
	       <tr><td><input type="text" name="NAME" class="caja_texto"></td></tr>
	       <tr><td class="texto">Password</td></tr>
	       <tr><td><input type="password" name="secret" class="caja_texto"></td></tr>
	       <tr><td class="texto">Numero</td></tr>
	       <tr><td><input type="text" name="exten" class="caja_texto"></td></tr>
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


