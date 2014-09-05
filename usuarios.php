<?php
 require_once "coneccion.php";
 require_once "validaciones.php";
 require_once "error.php"; 
 class Usuarios
 {
 	public $coneccion="";
 	public $validaciones="";
 	public $error="";
 	function Usuarios()
 	{
 		$this->coneccion=new Coneccion();
 		$this->validaciones=new Validaciones();
 		$this->error=new Error();
 	}
 	function formulario_usuarios()
 	{
       echo "
		    <div class='contenedor_principal'>
		    <div class='contenedor_formulario'>
		       <h1>Nuevo Usuario</h1>
			   <form method='POST' action='registrar_usuarios.php'>
			     <table>
			       <tr><td class='texto'>Nick</td></tr>
			       <tr><td><input type='text' name='NAME' class='caja_texto'></td></tr>
			       <tr><td class='texto'>Numero telefonico</td></tr>
			       <tr><td><input type='text' name='exten' class='caja_texto'></td></tr>
			       <tr><td class='texto'>Email</td></tr>
			       <tr><td><input type='text' name='email' class='caja_texto'></td></tr>
			       <tr><td class='texto'>Password</td></tr>
			       <tr><td><input type='password' name='secret' class='caja_texto'></td></tr>
			       <tr><td><input type='hidden' name='nt' value='1'></td></tr>
			       <tr><td><input type='hidden' name='estado' value='1'></td></tr>
			       <tr><td><input type='submit' name='guardar' value='Aceptar' class='boton'></td></tr>	
			     </table>	 
			   </form>
		    </div>
		   <div class='contenedor_footer'>
		   	  <!Todos los derechos reservados> 
		   </div>
       ";
 	}
 	function registrar_usuarios($datos)
 	{
	   if (isset($datos['estado'])) {
	   	   $query="call registrar_usuario('".$datos['NAME']."','".$datos['secret']."','".$datos['exten']."','".$datos['email']."');";
	       echo $query;
	       $this->coneccion->EjecutarConsulta($query);
	       header("location:lista.php?c=".$datos['nt']);
	   }
	}
	function validar_usuarios($datos)
	{
		if (!$this->validaciones->esLetra($datos['NAME']))
			$this->error->letra();
	    if (!$this->validaciones->esNumero($datos['NAME'])) {
	    	$this->error->numero();
	    }
	}
 }
 ?>