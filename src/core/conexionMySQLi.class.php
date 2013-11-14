<?php
class conexionMySQLi{
	protected $direccion;
	protected $usuario;
	protected $password;
	protected $nameBD;
	protected $conexion;
	protected $is_conected = false;

	static $_instance;

	//patron Singleton
	private function __clone(){
		trigger_error('Objeto conexionMySQLi no se puede clonar.', E_USER_ERROR);	
	}
	
	public static function getInstance(){
		if (!(self::$_instance instanceof self)){
			self::$_instance=new self();
	}
	 return self::$_instance;
	}
	
	private function __construct(){
		$this->setConexion();
		$this->conectar();
	}
	
	//genera la la conexion con los parametros de configuracion
	private function setConexion(){
		$conf = Config::getInstance();
		$this->direccion=$conf->getDireccion();
		$this->nameBD=$conf->getBD();
		$this->usuario=$conf->getUsuarioBD();
		$this->password=$conf->getPasswd();
	}

	//metodo para conectar
	public function conectar(){
		$this->conexion = new mysqli($this->direccion,$this->usuario,$this->password,$this->nameBD);
		$this->conexion->query("SET NAMES 'utf8'");
		$this->is_conected = true;
	}

	//esta conectado?
	public function isConnected(){
		return $this->is_conected;
	}
		
	//desconecta la conexion
	public function desconectar(){
		$this->conexion->close();
		unset($this->conexion);
		$this->is_conected = false;
	}
	
	//retorna el tipo de dato ingresado por parametro, s para String, i para Int y d para Double
	private function getType($value){
		switch($value) {
			case is_string($value):
				return "s";
			break;
			case is_int($value):
				return "i";
			break;
			case is_double($value):
				return "d";
			break;
			default:
				return "s";
			break;
		}
	}
	
	//ejecuta una sentencia de tipo INSERT, UPDATE DROP, etc..
	public function ejecutarSentencia($sentencia, $params = null){
		//die($sentencia);
		if($this->is_conected){
	
			if($params !=null){
				$stmt = $this->conexion->prepare($sentencia);
				if(is_array($params)){
					$types = "";
					foreach($params as $param){
						//$type = $this->getType($param);
						$types .= $this->getType($param);
					}
					array_unshift($params,$types);
					//print_r($params);
				   @call_user_func_array(array($stmt,'bind_param'),$this->referenciateArray($params)) or die('bind err&oacute;neo: par&aacute;metros recibidos no coinciden o tabla no existe en la base de datos.');
					//call_user_func_array(array($stmt,'bind_param'),$this->referenciateArray($params)); 
				}else{
					$type = $this->getType($params);
					$stmt->bind_param($type,$params);
				}
				$stmt->execute();
				return $stmt->affected_rows;
			}else{
				$this->conexion->query($sentencia)or trigger_error("Dios SQL ha dicho: ".$this->conexion->error.", Codigo ".$this->conexion->errno, E_USER_ERROR);
				return $this->conexion->affected_rows;
			}
		}else{
			trigger_error('Conexion cerrada, hacer llamada a $object->conectar() antes de ejecucion.', E_USER_ERROR);
		}
	}
	
	//retorna un ResultSet de un conjunto de datos solicitados mediane una consulta SELECT
	public function devDatos($consulta, $params = null){
		if($this->is_conected){

			if($params !=null){
				$stmt = $this->conexion->prepare($consulta)or trigger_error("Dios SQL ha dicho: ".$this->conexion->error.", Codigo ".$this->conexion->errno, E_USER_ERROR);
				if(is_array($params)){
					$types = "";
					foreach($params as $param){
						//$type = $this->getType($param);
						$types .= $this->getType($param);
					}
					
					array_unshift($params,$types);
					@call_user_func_array(array($stmt,'bind_param'),$this->referenciateArray($params)) or die('Error en Bind: '. $this->conexion->error);
				}
				else{
					$type = $this->getType($params);
					$stmt->bind_param($type,$params);
				}
				$stmt->execute();

				return $stmt;
			}
				$resultado = $this->conexion->query($consulta)or trigger_error("Dios SQL ha dicho: ".$this->conexion->error.", Codigo ".$this->conexion->errno, E_USER_ERROR);
				return $resultado;
		}
		trigger_error('Conexion cerrada, hacer llamada a $object->conectar() antes de ejecucion.', E_USER_ERROR);
	}
	
	/*
	//retornaba la conexion pero no funciono
	public function getConnection(){
		if($this->is_conected){
			return $this->conexion;
		}
		return null;
	}
	*/
	
	
	/*
	Este metodo es para corregir el siguiente warning:
	Warning: Parameter 2 to mysqli_stmt::bind_param() expected to be a reference, 
	value given in /var/www/html/rsys/src/core/conexionMySQLi.class.php on line 112 
	*/
	//retorna un array con datos referenciales de otro array enviado por parametro
	private function referenciateArray($array){
		foreach($array as $p => $v) $array[$p] = &$array[$p];
		return $array;		
	}
	

}
?>
