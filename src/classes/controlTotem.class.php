<?php
if(!defined('PATH_SOURCE_CORE'))
{
	define('PATH_SOURCE_CLASSES','src/classes/');
	define('PATH_SOURCE_CORE','src/core/');
	define('PATH_ABSOLUTE',dirname(__FILE__).DIRECTORY_SEPARATOR);
}
//if(!defined('PATH_SOURCE_CORE')) die ('Directorio de fuentes del nucleo no esta definida, por favor contacte al administrador o implementador.');
require_once(PATH_SOURCE_CORE.'conexionMySQLi.class.php');
require_once(PATH_SOURCE_CORE.'conf.class.php');
require_once(PATH_SOURCE_CLASSES.'totem.class.php');

class controlTotem
{
	public function inserttotem($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO totem (idtotem,idnodo,nombre,orientacion) VALUES(?,?,?,?)";
	
		$respuesta = null;
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		return $respuesta;
	}

	public static function getTotem($idnodo)
	{
		$arr = null;
		$sql=conexionMySQLi::getInstance();
		
		$consulta="SELECT idtotem,idnodo,nombre,orientacion
			FROM totem
			WHERE idnodo = ?";
		
		$result= $sql->devDatos($consulta,array($idnodo));
		
		$result->bind_result($idTotem,$idnodo,$nombre,$orientacion);
		
		
		if ($result->fetch())
		{
		
			$arr = new totem($idTotem,$idnodo,$nombre,$orientacion);
		}
		return $arr;
	}

	
}
?>
