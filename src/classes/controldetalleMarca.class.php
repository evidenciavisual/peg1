<?php

require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controldetalleMarca
{
	public function insertDetalleMarca($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO detallemarca(iddetalleMarca,idmarca,idtienda) VALUES(?,?,?)";
		$respuesta = null;
		
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
		
	}	
}


?>