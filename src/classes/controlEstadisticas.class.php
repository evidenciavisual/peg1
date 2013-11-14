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


class controlEstadisticas
{

	
	public function listPaginaEstadisticaHoyByName($nomPagina=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT idestadisticasPagina,nomPagina,contadorVisitas,fechaVisita
		FROM estadisticasPagina";
		if($nomPagina!=null)
		{
			$consulta.=" WHERE nomPagina = ? 
			AND fechaVisita=DATE(NOW())";
		}
		else
		{
			$nomPagina=0;
			$consulta.=" WHERE fechaVisita <> ? ORDER BY fechaVisita DESC,contadorVisitas DESC";
		}

		$result= $sql->devDatos($consulta,array($nomPagina));
		$result->bind_result($idEstPag,$nomPag,$contVis,$fecVis);
		if($nomPagina==null)
		{
			while ($result->fetch())
			{
				$arr[] = array('idEstPag'=>$idEstPag,'nomPag'=>$nomPag,'contVis'=>$contVis,'fecVis'=>$fecVis);
			}
		}
		else
		{
			if ($result->fetch())
			{
				$arr = array('idEstPag'=>$idEstPag,'nomPag'=>$nomPag,'contVis'=>$contVis,'fecVis'=>$fecVis);
			}	
		}
		
		return $arr;
		
	}

	
	public function insertNewEstVisitaHoy($nomPagina)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO estadisticasPagina (nomPagina,contadorVisitas,fechaVisita) VALUES(?,'1',DATE(NOW()))";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$nomPagina);
		
		return $resultado;
	}


	public function sumaContadorVisitaPagina($idEstPag)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "UPDATE estadisticasPagina SET `contadorVisitas`=`contadorVisitas`+1  WHERE idestadisticasPagina= ? AND fechaVisita=DATE(NOW())";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$idEstPag);
		
		return $resultado;
	}

	//############################ FIN ESTADISTICAS PAGINA ############################################


	//############################ INICIO  ESTADISTICAS TIENDA ########################################

	public function listTiendaEstadisticaHoyByName($nomTienda=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT idestadisticasTienda,nomTienda,contadorVisitas,fechaVisita
		FROM estadisticasTienda";
		if($nomTienda!=null)
		{
			$consulta.=" WHERE nomTienda = ? 
			AND fechaVisita=DATE(NOW())";
		}
		else
		{
			$nomTienda=0;
			$consulta.=" WHERE fechaVisita <> ? ORDER BY fechaVisita DESC,contadorVisitas DESC";
		}

		$result= $sql->devDatos($consulta,array($nomTienda));
		$result->bind_result($idEstTie,$nomTie,$contVis,$fecVis);
		if($nomTienda==null)
		{
			while ($result->fetch())
			{
				$arr[] = array('idEstTie'=>$idEstTie,'nomTie'=>$nomTie,'contVis'=>$contVis,'fecVis'=>$fecVis);
			}
		}
		else
		{
			if ($result->fetch())
			{
				$arr = array('idEstTie'=>$idEstTie,'nomTie'=>$nomTie,'contVis'=>$contVis,'fecVis'=>$fecVis);
			}	
		}
		
		return $arr;
		
	}

	public function insertNewEstVisitaHoyTienda($nomTienda)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO estadisticasTienda (nomTienda,contadorVisitas,fechaVisita) VALUES(?,'1',DATE(NOW()))";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$nomTienda);
		
		return $resultado;
	}


	public function sumaContadorVisitaTienda($idEstTie)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "UPDATE estadisticasTienda SET `contadorVisitas`=`contadorVisitas`+1  WHERE idestadisticasTienda= ? AND fechaVisita=DATE(NOW())";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$idEstTie);
		
		return $resultado;
	}

	//############################ FIN ESTADISTICAS PAGINA ############################################

	//#################### INICIO ESTADISTICAS GLOBALES ##########################################

	public function insertNewEstadistica($nomPagina)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO estadisticasGlobal (nombre,hora,fecha) VALUES (?,curtime(),curdate())";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$nomPagina);
		
		return $resultado;
	}

	//#################### INICIO ESTADISTICAS GLOBALES ##########################################

	
}
?>
