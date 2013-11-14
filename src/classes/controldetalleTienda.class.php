<?php
require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controldetalleTienda
{
	public function insertDetalleTienda($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO detalletienda(iddetalleTienda,idtienda,idproducto) VALUES(?,?,?)";
		$respuesta = null;
		
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
		
	}
}

?>