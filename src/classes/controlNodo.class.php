<?php

require_once 'src/core/conexionMySQLi.class.php';
require_once 'src/core/conexionBD.php';
require_once 'src/core/conf.class.php';

class controlNodo
{
	public function insertaNodo($data)
	{
		$sql = conexionMySQLi::getInstance();
		if($data["idcambiadorPiso"]!="NULL")
		{
			$sentencia = "INSERT INTO nodos(idnodo,idcambiadorPiso,ubicacionx,ubicaciony,piso,vecino1,vecino2,vecino3,vecino4,coordenadaReal) VALUES(?,?,?,?,?,?,?,?,?,?)";
		}
		else 
		{
			$sentencia = "INSERT INTO nodos(idnodo,ubicacionx,ubicaciony,piso,vecino1,vecino2,vecino3,vecino4,coordenadaReal) VALUES(?,?,?,?,?,?,?,?,?)";
			//array("idnodo"=>trim($arrTem[0]),"idcambiadorPiso"=>trim($arrTem[1]),"ubicacionx"=>trim($arrTem[2]),"ubicaciony"=>trim($arrTem[3]),"piso"=>trim($arrTem[4]),"vecino1"=>trim($arrTem[5]),"vecino2"=>trim($arrTem[6]),"vecino3"=>trim($arrTem[7]),"vecino4"=>trim($arrTem[8]),"coordenadaReal"=>trim($arrTem[9]));		
			$data = array($data["idnodo"],$data["ubicacionx"],$data["ubicaciony"],$data["piso"],$data["vecino1"],$data["vecino2"],$data["vecino3"],$data["vecino4"],$data["coordenadaReal"]);
		}
		//echo $sentencia;
		//print_r($data);
		//die();
		$respuesta = null;
		
		$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		
		return $respuesta;
	}
	
}

?>