<?php
require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controldetalleRubro
{
	public function insertDetalleRubro($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO detalleRubro(iddetalleRubro,idtienda,idrubro) VALUES(?,?,?)";
		$respuesta = null;
		
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
	}
	
}
?>