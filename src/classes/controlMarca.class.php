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
require_once(PATH_SOURCE_CLASSES.'marca.class.php');


class controlMarca
{

	public function insertMarcas($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO marca (idmarca,nombre) VALUES(?,?)";
		
		$respuesta = null;
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		return $respuesta;
	}
	
	public function listarMarca($bus)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT idmarca,nombre FROM marca WHERE nombre LIKE ? ORDER BY nombre ASC" ;
		$result= $sql->devDatos($consulta,array("%".$bus."%"));
		$result->bind_result($idmarca,$nombre);
		while ($result->fetch())
		{
			$arr[] = new marca($idmarca,$nombre);
		}
		
		//var_dump($arr);
		return $arr;
	
	}
	public function getMarca($id)
	{
		$arr = null;
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT idmarca,nombre FROM marca WHERE idmarca= ?" ;
		$result= $sql->devDatos($consulta,array($id));
		$result->bind_result($idmarca,$nombre);
		if ($result->fetch())
		{
			$arr = new marca($idmarca,$nombre);
		}
		
		//var_dump($arr);
		return $arr;
	
	}
	
	
	

	
}
?>
