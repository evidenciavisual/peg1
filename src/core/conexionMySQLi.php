<?php
class conexionMySQLi{
	protected $usuario;
	protected $dir;
	protected $password;
	protected $nameBD;
	
	function __construct(){
		if(func_num_args()==4){
			$this->usuario = func_get_arg(0);
			$this->dir = func_get_arg(1);
			$this->password = func_get_arg(2);
			$this->nameBD = func_get_arg(3);
		}else{
			$this->usuario = $_SESSION["config"]->getUsuarioBD();
			$this->dir = $_SESSION["config"]->getDireccion();
			$this->password = $_SESSION["config"]->getPasswd();
			$this->nameBD = $_SESSION["config"]->getBD();
		}
	}
	
/*	function __construct($dirConfig){
		require_once($dirConfig);
		$this->usuario = $usuariobd;
		$this->dir = $direccion;
		$this->password = $passwd;
		$this->nameBD = $basedatos;
	}*/
	
	function mostrar(){
		echo $this->usuario.',';
		echo $this->dir.',';
		echo $this->password.',';
		echo $this->nameBD;
	}
	
	function ejecutarSentencia($sentencia, $params = null){
		$mysqli = new mysqli($this->dir,$this->usuario,$this->password,$this->nameBD);
		
		//$stmt->bind_param("s",$id);

		if($params !=null){
			$stmt = $mysqli->prepare($sentencia);
			if(is_array($params)){
				foreach($params as $param){
					$stmt->bind_param("s", $param);
				}
			}else{
				$stmt->bind_param("s",$params);
			}
			$stmt->execute();
			$stmt->close();
		}else{
			$mysqli->query($sentencia)or die($mysqli->error);
			
		}
		$mysqli->close();
		
	}
	
	function devDatos($consulta, $params = null){
		$mysqli = new mysqli($this->dir,$this->usuario,$this->password,$this->nameBD);			

		if($params !=null){
			$stmt = $mysqli->prepare($consulta);
			if(is_array($params)){
				foreach($params as $param){
					$stmt->bind_param("s", $param);
				}
			}else{
				$stmt->bind_param("s",$params);
			}
			$stmt->execute();
			
			return $stmt;
		}
			$resultado = $mysqli->query($consulta)or die($mysqli->error);
			return $resultado;
	}
	
	function contarDatos($consulta){
		mysql_connect($this->dir,$this->usuario,$this->password)or die ('Ha fallado la conexion: '.mysql_error());			
		mysql_select_db($this->nameBD)or die ('Error al seleccionar la Base de Datos: '.mysql_error());		
		$resultado = mysql_query($consulta);
		$numeroDatos = mysql_num_rows($resultado);
		$this->cerrarConexion($resultado);
		return $numeroDatos;
	}
	
	function conectar(){
		mysql_connect($this->dir,$this->usuario,$this->password)or die ('Ha fallado la conexion: '.mysql_error());
	}
	function desconectar(){
		mysql_close();
	}
	
	function cerrarConexion($resultado){
		mysql_free_result($resultado);
		mysql_close();
	}
}
?>
