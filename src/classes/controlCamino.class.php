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
require_once(PATH_SOURCE_CLASSES.'nodo.class.php');

class controlCamino
{
	function getNodo($id)
	{
		$sql=conexionMySQLi::getInstance();
		
		$consulta="SELECT idnodo, idcambiadorPiso , ubicacionx , ubicaciony, piso,
				vecino1, vecino2, vecino3, vecino4,coordenadaReal FROM nodos where idnodo = ?";
		
		$result= $sql->devDatos($consulta,array($id));
		
		$result->bind_result($idNodo,$idCambiadorPiso,$ubx,$uby,$piso,$vecino1,$vecino2,$vecino3,$vecino4,$coorReal);
		
		
		if ($result->fetch())
		{
				
			$arr = new nodo($idNodo,$idCambiadorPiso,$ubx,$uby,$piso,$vecino1,$vecino2,$vecino3,$vecino4,$coorReal);
		}
		return $arr;
	}
	
	function getCambiadorPiso($piso,$direccion)
	{
		$sql = conexionMySQLi::getInstance();
		$cambiador=null;
		if($direccion=="sube")
		$sentencia="SELECT nodos.idnodo,ubicacionX,ubicacionY,coordenadaReal FROM `nodos`,`cambiadorPiso` 
					WHERE nodos.idcambiadorPiso=cambiadorPiso.idcambiadorPiso and 
					piso = ? and cambiadorPiso.sube=1";
		else 
		$sentencia="SELECT nodos.idnodo,ubicacionX,ubicacionY,coordenadaReal FROM `nodos`,`cambiadorPiso`
					WHERE nodos.idcambiadorPiso=cambiadorPiso.idcambiadorPiso and
					piso = ? and cambiadorPiso.baja=1";
		$resulset = $sql->devDatos($sentencia,array($piso));
		$resulset->bind_result($idnodo,$ubx,$uby,$coorReal);
		while($resulset->fetch())
		{
			$cambiador[] = new nodo($idnodo,null,$ubx,$uby,null,null,null,null,null,$coorReal);
		}
		
		return $cambiador;
		
	}
	
	function getDestinoCambiadorPiso($id,$direccion)
	{
		$sql = conexionMySQLi::getInstance();
		$cambiador=null;
		if($direccion=="sube")
			$sentencia="SELECT nodos.coordenadaReal,nodos.piso FROM cambiadorPiso, nodos
				WHERE cambiadorPiso.idnodoSubida= nodos.idnodo
				and cambiadorPiso.idcambiadorPiso = ?";
		else
			$sentencia="SELECT nodos.coordenadaReal,nodos.piso FROM cambiadorPiso, nodos
				WHERE cambiadorPiso.idnodoBajada= nodos.idnodo
				and cambiadorPiso.idcambiadorPiso = ?";
		$resulset = $sql->devDatos($sentencia,array($id));
		$resulset->bind_result($coorReal,$piso);
		if($resulset->fetch())
		{
			$cambiador = new nodo(null,null,null,null,$piso,null,null,null,null,$coorReal);
		}
		//echo "asda";
		//var_dump($cambiador);
		
		return $cambiador;
	}
	
	function getVecinos($id)
	{
		$sql=conexionMySQLi::getInstance();
		$algo=" ";
		$consulta="SELECT idnodo,ubicacionx,ubicaciony, vecino1, vecino2, vecino3, vecino4 FROM nodos 
			where idnodo='".$id."' ";
		
	
		$result= $sql->devDatos($consulta,$algo);
		//echo "Despues de consulta";
	
		$result->bind_result($idnodo,$ubx,$uby,$vecino1,$vecino2,$vecino3,$vecino4);
		
	
	
		if ($result->fetch())
		{
	
			$arr= new nodo($idnodo,null,$ubx,$uby,null,$vecino1,$vecino2,$vecino3,$vecino4,null);
			//echo $arr[$i]->getvecino1()."->arr <br>";
			
		}
		return $arr;
	}
	
	function getCoordenadaReal($id)
	{
		$sql=conexionMySQLi::getInstance();
		$algo=" ";
		$consulta="SELECT coordenadaReal FROM nodos
		where idnodo='".$id."' ";
	
	
		$result= $sql->devDatos($consulta,$algo);
		//echo "Despues de consulta";
	
		$result->bind_result($coorReal);
	
	
	
		if ($result->fetch())
		{
	
			$arr= new nodo(null,null,null,null,null,null,null,null,null,$coorReal);
			//echo $arr[$i]->getvecino1()."->arr <br>";
				
		}
		return $arr;
	}
	
	function getIdNodoPisoPorCoorReal($coor,$piso)
	{
		$sql=conexionMySQLi::getInstance();
		//$algo=" ";
		$arr=null;
		$consulta="SELECT idcambiadorPiso FROM nodos
		where coordenadaReal= ? 
		AND piso = ?";
		
	
	
		$result= $sql->devDatos($consulta,array($coor,$piso));
		//echo "Despues de consulta";
	
		$result->bind_result($idNodo);
	
	
	
		if ($result->fetch())
		{
	
			$arr= new nodo($idNodo,null,null,null,null,null,null,null,null,null);
			//echo $arr[$i]->getvecino1()."->arr <br>";
	
		}
		return $arr;
	}
	
	
	

	
	
}
?>