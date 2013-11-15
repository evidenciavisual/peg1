<?php

//if(!defined('PATH_SOURCE_CORE')) die ('Directorio de fuentes del nucleo no esta definida, por favor contacte al administrador o implementador.');
require_once(dirname(__FILE__).'/../core/conexionMySQLi.class.php');
require_once(dirname(__FILE__).'/../core/conf.class.php');


class controlCorreos
{
	function getCorreos($estado=null)
	{
		$sql=conexionMySQLi::getInstance();
		$arr=array();
		$consulta="SELECT idcorreo,tipoCorreo,nombre,rut,telefono,correoDestino,cuerpoMensaje,fecha
		 FROM correos where estado = ?";
		if($estado>-1)
		{
			$result= $sql->devDatos($consulta,$estado);
			
			$result->bind_result($idCorreo,$tipoCorreo,$nombre,$rut,$telefono,$correoDestino,$cuerpoMensaje,$fecha);
			
			
			while ($result->fetch())
			{
					
				$arr[] =array('idCorreo' => $idCorreo,'tipoCorreo' => $tipoCorreo,'nombre' => $nombre,'rut' => $rut,'telefono' => $telefono,'correoDestino' => $correoDestino,'cuerpoMensaje'=> $cuerpoMensaje,'fecha' => $fecha);
			}
			
		}
		else $arr=null;
		return $arr;
		
	}

	function insertCorreos($data=null,$estado=null)
	{
		$sql = conexionMySQLi::getInstance();
		$respuesta = null;
		if($estado>-1&&$data!=null)
		{
			$sentencia = "INSERT INTO correos (tipoCorreo,nombre,rut,telefono,correoDestino,cuerpoMensaje,fecha,estado) VALUES(?,?,?,?,?,?,NOW(),'".$estado."')";
			$respuesta = $sql->ejecutarSentencia($sentencia,$data);
		}
		else echo "no entro".$estado;
		
		
		return $respuesta;
	}

	function cambiarEstadoCorreos($idCorreo=null)
	{
		$sql = conexionMySQLi::getInstance();
		$respuesta = null;
		if($idCorreo!=null)
		{
			$sentencia = "UPDATE  `correos` SET  `estado` =  '1' WHERE  `correos`.`idcorreo` =?";
			$respuesta = $sql->ejecutarSentencia($sentencia,$idCorreo);
		}
		
		
		return $respuesta;
	}
	
	
	

	
	
}
?>