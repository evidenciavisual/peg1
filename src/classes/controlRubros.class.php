<?php

require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controlRubros
{
	public function insertRubros($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO rubro(idrubro,nombre,logo) VALUES(?,?,?)";
		$respuesta = null;

		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
	}
}
?>
