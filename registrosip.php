<?php

// Conexion a la base de Datos

$base = "asterisk";
$host = "localhost";
$user = "asterisk";
$password = "sistemas";
$conexion = mysqli_connect($host,$user,$password, $base) or die("No se puede conectar con el servidor");
//$conexion = mysql_connect($host,$user,$password);
//$result = mysql_select_db($base,$conexion) or die ("Error en la Conexion a BD");

session_start();

// Si no estamos logeados

if (!$_SESSION['login'])
{
 if(isset($_POST['loginsubmit']))
 {
 $usuario = $_POST['usuario'];
 $password = $_POST['password'];

 if((!$usuario) || (!$password))
 {
 echo "Error 1<br>";
 exit();
 }
 //$password = $usuario.":asterisk:".$password;
 //$password = md5($password);
 $password = $password;
 echo "SELECT * FROM sip_buddies WHERE name='$usuario' AND md5secret = '$password' AND useradmin = '1'";
 $query = mysqli_query($conexion,"SELECT * FROM sip_buddies WHERE name='$usuario' AND md5secret = '$password' AND useradmin = '1'");
 if (mysqli_num_rows($query) > 0)
 {
 session_register('login');
 $_SESSION['login'] = '1';
 }
 else
 echo "Error 2<br><br>";

 echo "<a href='index.php'>Home</a>";
 }
 else
 {
 echo "<form method='post' action='?'>";
 echo "Usuario: <input name='usuario' type='text'><br>";
 echo "Contrase&ntilde;a: <input name='password' type='password'><br>";
 echo "<input type='submit' name='loginsubmit'>";
 echo "</form>";
 }

}
else
{
 // Salida del Sistema
 if(isset($_REQUEST['exit']))
 {
 session_destroy();

 if(!session_is_registered('login'))
 echo "<a href='index.php'>Home</a>";

 }
 // Insercion de un nuevo Registro
 elseif(isset($_POST['insertsubmit']))
 {
 $sipuser = $_POST['sipuser'];
 $sippass = $_POST['sippass'];
 $sippass = $sipuser.":asterisk:".$sippass;
 $sippass = $sippass;
 $query = mysqli_query($conexion,"INSERT INTO sip_buddies (`name`, `host`, `nat`, `type`, `cancallforward`, `canreinvite`, `context`, 
 `md5secret`, `qualify`, `disallow`, `allow`, `fullcontact`, `ipaddr`, `port`, `regseconds`, `lastms`, `username`, `defaultuser`) 
 VALUES ('$sipuser', 'dynamic', 'no', 'friend', 'yes', 'yes', 'extensiones', '$sippass', 'yes', 'all', 'g729;ilbc;gsm;ulaw;alaw', '', '', 
 '0','0', '0', '', '')");

 echo "<a href='index.php'>Home</a><br>";
 echo "<a href='index.php?exit'>Exit</a>";
 }
 // Borrado de un Registro
 elseif(isset($_POST['deletesubmit']))
 {
 $sipid = $_POST['sipid'];
 $query = mysqli_query($conexion,"DELETE FROM sip_buddies WHERE id = '$sipid'");

 echo "<a href='index.php'>Home</a><br>";
 echo "<a href='index.php?exit'>Exit</a>";
 }
 // Formularios de Insercion y Borrado
 else
 {
 echo "Insertar Registro:<br>"; 
 echo "<p><form method='post' action='?'>";
 echo "Usuario: <input name='sipuser' type='text'><br>";
 echo "Contrase&ntilde;a: <input name='sippass' type='password'><br>";
 echo "<input type='submit' name='insertsubmit' value='Insertar'>";
 echo "</form></p>";

 echo "<table border='1'>";
 echo "<tr><td colspan ='2' align='center'>SIP Peers Activos</td></tr>";
 echo "<tr><td>Usuario</td><td>Borrar</td></tr>"; 

 $query = mysqli_query($conexion,"SELECT * FROM sip_buddies WHERE type = 'friend'");
 $rows = mysqli_num_rows($query);
 for ($i=0;$i<$rows;$i++)
 {
 $sippeersarray = mysqli_fetch_array($query, MYSQLI_ASSOC);
 $sipuser = $sippeersarray['name'];
 $sipid = $sippeersarray['id'];

 echo "<tr>";
 echo "<td>".$sipuser."</td>";
 echo "<td>";
 echo "<form method='post' action='?'>";
 echo "<input type=hidden name='sipid' value='$sipid'>";
 echo "<input type=submit name='deletesubmit' value='Borrar'>";
 echo "</form>";
 echo "</td>"; 
 echo "</tr>";

 } 
 echo "</table>"; 
 echo "<a href='index.php?exit'>Exit</a>";

 }
}

?>