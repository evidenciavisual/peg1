<?php

require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controlpropiedadesTienda
{
	public function insertPropiedadesTienda($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO propiedadestienda (idpropiedadesTienda,idtienda,idnodo,modulo) VALUES(?,?,?,?)";
	
		$respuesta = null;
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		return $respuesta;
	}
	
}
?>