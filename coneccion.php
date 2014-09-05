<link rel="stylesheet" type="text/css" href="stilo.css">
<?php 
  class Coneccion
  {
  	public $base = "asteriskrealtime";
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $conexion="";
    public $query="";
    public $array = array(
    "1" => "v_usuarios",
    "2" => "extensions",
    "3" => "voicemail_users",
    "4" => "queue_table",
    "5" => "queue_member_table",
    "6" => "meet_me",
    "7" => "vista_usuarios",
    "8" => "v_buzon_de_voz",
    );
  	function __construct()
  	{
  		# code...
  		$this->conexion = mysqli_connect($this->host,$this->user,$this->password, $this->base) or die("No se puede conectar con el servidor");
  	}
  	public function EjecutarConsulta($consulta)
  	{
  		# code...
  		$this->query=mysqli_query($this->conexion,$consulta);
  		return $this->query;
    } 
    public function MostrarField($consulta)
    {
          $fields = mysqli_fetch_fields($this->query); 
          echo "<tr>";
	      foreach($fields as $fi => $f)  
	      { 
	      	echo "<td>".$f->name."</td>"; 
	      } 
	      echo "<td>Accion</td><td>Buzon de voz</td><td>Extension</td>";
          echo "</tr>";
    }
    public function MostrarTabla($nt)
    {
        $tabla=$this->array[$nt];
        $consulta="select * from ".$tabla; 
    	  echo "<table>";
    	  $codigo="";
        $numero="";
          $this->query = $this->EjecutarConsulta($consulta);
          $this->MostrarField($consulta);
          $rows = mysqli_num_rows($this->query);
		  for ($i=0;$i<$rows;$i++)
	      { 
	      	  $row = mysqli_fetch_array($this->query, MYSQLI_ASSOC);
	          $fields = mysqli_fetch_fields($this->query); 
	          echo "<tr>";
		      foreach($fields as $fi => $f)  
		      { 
		      	echo "<td class='texto'>".$row[$f->name]."</td>";
		      	if ($f->name=="cod") {
		      	 	$codigo=$row[$f->name];
		      	 } 
             if ($f->name=="Numero") {
              $numero=$row[$f->name];
             } 
		      } 
		      echo "<td><a href='eliminar.php?c=$codigo&&n=$nt'>eliminar</a> 
                    <a href='actualizar.php?c=$codigo&&n=$nt'>actualizar</a>
                </td>
                <td><a href='actualizar.php?c=$numero&&n=8'>Editar</a></td>";
	          echo "</tr>";
	      }
	      echo "</table>";
    }
    public function MostrarFormulario($cod,$nt)
    {
        $tabla=$this->array[$nt];
        $consulta="select * from ".$tabla." where cod='".$cod."'";
        $this->query = $this->EjecutarConsulta($consulta);
	      $row = mysqli_fetch_array($this->query, MYSQLI_ASSOC);
	      $fields = mysqli_fetch_fields($this->query); 
		  echo "<form method='POST' action='actualizar2.php'>";
		  echo "<table >";
		  foreach($fields as $fi => $f)  
		  { 
		  	echo "<tr><td class='texto'>".$f->name."</td><td><input type='text' name='".$f->name."' value='".$row[$f->name]."' class='caja_texto'></td></tr>";
		  } 
		  echo "<input type=hidden value=".$nt." name='nt'>";
		  echo "<tr><td><input type=submit value=Guardar class='boton'></td></tr>";
		  echo "</table>";
		  echo "</form>";
    }
    public function Actualizar($vector)
    {
    	   
    	  $n = (count($vector)-1);
    	  $ct=1;
          $tabla=$this->array[$vector['nt']];
          $this->query = $this->EjecutarConsulta("select * from ".$tabla);
	      $fields = mysqli_fetch_fields($this->query); 
		  
		  foreach($fields as $fi => $f)  
		  {
		  	 if ($f->name!="cod") {
		  	 	$consulta=" update ".$tabla." set "; 
		  	    $consulta=$consulta.$f->name."='".$vector[$f->name]."'";
		        $consulta=$consulta." where cod='".$vector['cod']."'";
            $this->EjecutarConsulta($consulta); 
		  	 }
		  }     
    }
   };
 ?>