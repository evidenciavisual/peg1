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
require_once(PATH_SOURCE_CLASSES.'producto.class.php');


class controlProducto
{
	public function listarProducto($bus)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT idproducto,nombre,tipo FROM producto WHERE nombre LIKE ? ORDER BY nombre ASC" ;
		$result= $sql->devDatos($consulta,array("%".$bus."%"));
		$result->bind_result($idproducto,$nombre,$tipo);
		while ($result->fetch())
		{
			$arr[] = new producto($idproducto,$nombre,$tipo);
		}
		
		//var_dump($arr);
		return $arr;
	
	}
	public function getProducto($id)
	{
		$arr = null;
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT idproducto,nombre,tipo FROM producto WHERE idproducto= ?" ;
		$result= $sql->devDatos($consulta,array($id));
		$result->bind_result($idproducto,$nombre,$tipo);
		if ($result->fetch())
		{
			$arr = new producto($idproducto,$nombre,$tipo);
		}
		
		//var_dump($arr);
		return $arr;
	
	}
	
	
	

	
}
?>