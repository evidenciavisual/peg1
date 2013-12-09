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
require_once(PATH_SOURCE_CLASSES.'tienda.class.php');
require_once(PATH_SOURCE_CLASSES.'rubro.class.php');

class controlTienda
{

	public function insertTienda($data)
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "INSERT INTO tienda (idtienda,nombre,logo) VALUES(?,?,?) ON DUPLICATE KEY UPDATE idtienda=values(idtienda), nombre=values(nombre), logo=values(logo)";
		$resultado = null;
		$resultado = $sql->ejecutarSentencia($sentencia,$data);
		
		return $resultado;
		
	}

	function getTienda($id)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		
		$consulta="SELECT tienda.idtienda, tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.idtienda= ?";
		
		$result= $sql->devDatos($consulta,array($id));
		
		$result->bind_result($idTienda,$nombre,$logo,$piso,$ubi);
		
		
		if ($result->fetch())
		{
		
			$arr = new tienda($idTienda,$nombre,$logo,$piso,$ubi);
		}
		return $arr;
	}
	
	public static function buscarTienda($nombre,$buscador)
	{
		$sql=conexionMySQLi::getInstance();
		$arr= array();
		
		if ($nombre!="[0-9]")
		{
			$consulta="SELECT tienda.idtienda,tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
					FROM tienda, nodos, propiedadesTienda
					WHERE nodos.idnodo = propiedadesTienda.idnodo
					AND tienda.idtienda = propiedadesTienda.idtienda
					AND tienda.nombre <> 'Vacancy'
					AND tienda.nombre NOT LIKE 'Vacante%' AND tienda.nombre NOT LIKE 'vacante%' 
					AND tienda.nombre LIKE ?
					ORDER BY tienda.nombre,nodos.piso ASC ";
		
		
			
		}
		else 
		{
			$consulta="SELECT tienda.idtienda, tienda.nombre, tienda.logo, nodos.piso,propiedadesTienda.idnodo
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre <> 'Vacancy'
			AND tienda.nombre NOT LIKE 'Vacante%' AND tienda.nombre NOT LIKE 'vacante%' 
			AND tienda.nombre RLIKE ?
			ORDER BY tienda.nombre,nodos.piso  ASC ";
			
			
		}
		if ($nombre!="todo")
		{
			if ($nombre!="[0-9]") $result= $sql->devDatos($consulta,array($nombre.'%'));
			else $result= $sql->devDatos($consulta,array("[0-9]"));
		}
		else  $result= $sql->devDatos($consulta,array('%%'));
		  
		
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
	
		}
		return $arr;
	}
	
	public static function contarTienda($nombre,$buscador)
	{
		$sql=conexionMySQLi::getInstance();
		if ($nombre!="[0-9]")
		{
			$consulta="SELECT count( tienda.nombre ) 
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre <> 'Vacancy'
			AND tienda.nombre NOT LIKE 'Vacante%' AND tienda.nombre NOT LIKE 'vacante%' 
			AND tienda.nombre LIKE ?
			ORDER BY tienda.nombre ASC ";
				
		}
		else
		{
			$consulta="SELECT count( tienda.nombre ) 
			FROM tienda, nodos, propiedadesTienda
			WHERE nodos.idnodo = propiedadesTienda.idnodo
			AND tienda.idtienda = propiedadesTienda.idtienda
			AND tienda.nombre <> 'Vacancy'
			AND tienda.nombre NOT LIKE 'Vacante%' AND tienda.nombre NOT LIKE 'vacante%' 
			AND tienda.nombre RLIKE ?
			ORDER BY tienda.nombre ASC ";
				
				
		}
		
		if ($nombre!="todo")
		{
			if ($nombre!="[0-9]") $result= $sql->devDatos($consulta,array($nombre.'%'));
			else $result= $sql->devDatos($consulta,array("[0-9]"));
		}
		else $result= $sql->devDatos($consulta,array('%%'));
		$result->bind_result($numero);
		if ($result->fetch())return $numero;
		
		
	}
	
	public static function listarRubros($rubro=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		if ($rubro==null)$consulta= "SELECT idrubro,nombre,logo FROM rubro where idrubro <> ? order by nombre asc ";
		else $consulta= "SELECT idrubro,nombre,logo FROM rubro where idrubro = ? ";
		$result= $sql->devDatos($consulta,array("".$rubro.""));
		$result->bind_result($idrubro,$nombre,$logo);
		if ($rubro==null)
		{
			while ($result->fetch())
			{
				$arr[] = new rubro($idrubro,$nombre,$logo);
			}
		}
		else
		{
			if ($result->fetch()) $arr = new rubro($idrubro,$nombre,$logo);
		}
		//var_dump($arr);
		return $arr;
	}
	
	public static function contarRubros()
	{
		$vac="";
		$sql=conexionMySQLi::getInstance();
		$consulta= "SELECT count(idrubro) FROM rubro where idrubro <> ?";
		$result= $sql->devDatos($consulta,array($vac));
		$result->bind_result($numero);
		if ($result->fetch())return $numero;
		
	}
	
	public function tiendasConRubros($idrubro)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, detalleRubro, rubro,nodos,propiedadesTienda
		WHERE tienda.idtienda = detalleRubro.idtienda
		AND detalleRubro.idrubro = rubro.idrubro
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND rubro.idrubro = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idrubro));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		return $arr;
		
		
	}
	

	public function productoEnTiendas($idproducto)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, nodos,propiedadesTienda, detalleTienda,producto
		WHERE producto.idproducto = detalleTienda.idproducto
		AND tienda.idtienda = detalleTienda.idtienda
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND producto.idproducto = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idproducto));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		
		return $arr;
		
		
	}
	
	public function marcaEnTiendas($idmarca)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, nodos,propiedadesTienda,detalleMarca,marca
		WHERE marca.idmarca = detalleMarca.idmarca
		AND tienda.idtienda = detalleMarca.idtienda
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND marca.idmarca = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idmarca));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = new tienda($idtienda,$nombre,$logo,$piso,$ubiTienda);
		
		}
		
		return $arr;
		
		
	}
		public function getNodoConNombreTienda($nomTienda)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idTienda,nodos.idnodo,tienda.logo
		FROM tienda, nodos,propiedadesTienda
		WHERE tienda.idtienda = propiedadesTienda.idtienda 
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.nombre like ?";
		$result= $sql->devDatos($consulta,array($nomTienda."%"));
		$result->bind_result($idtienda,$idnodo,$logo);
		if ($result->fetch())
		{
			$arr = array('idtienda'=>$idtienda,'idnodo'=>$idnodo,'logo'=>$logo);
		
		}
		
		return $arr;
		
		
	}

	public function getTiendaPorPiso($piso=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idTienda,tienda.nombre,tienda.logo 
			from tienda,propiedadesTienda,nodos 
			where tienda.idtienda = propiedadesTienda.idtienda 
			and propiedadesTienda.idnodo = nodos.idnodo 
			and nodos.piso = ?";
		if($piso!=null)
		{
			

		$result= $sql->devDatos($consulta,array($piso));
		$result->bind_result($idTienda,$nombre,$logo);
		
			while ($result->fetch())
			{
				$arr[] = array('idTienda'=>$idTienda,'nombre'=>$nombre,'logo'=>$logo);
			}
				
		}
		return $arr;
		
	}

	public function getTiendasAnclasPorPiso($piso=null, $codigoAreaNegocio=null)
	{
		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta = "SELECT tienda.idTienda, tienda.nombre, tienda.logo FROM tienda, propiedadesTienda, nodos  WHERE tienda.idtienda = propiedadesTienda.idtienda AND nodos.idnodo=propiedadesTienda.idnodo AND nodos.piso = ? AND tienda.areaNegocio = ?";

		if($piso!=null && $codigoAreaNegocio!=null)
		{
			$result= $sql->devDatos($consulta,array($piso,$codigoAreaNegocio));
			$result->bind_result($idTienda,$nombre,$logo);

			while($result->fetch())
			{
				$arr[] = array('idTienda'=>$idTienda,'nombre'=>$nombre,'logo'=>$logo);
			}
			
			return $arr;	
		}
	}

	public function tiendasConRubrosxPiso($idrubro,$piso)
	{

		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.idtienda,tienda.nombre,tienda.logo,nodos.piso,propiedadesTienda.idnodo
		FROM tienda, detalleRubro, rubro,nodos,propiedadesTienda
		WHERE tienda.idtienda = detalleRubro.idtienda
		AND detalleRubro.idrubro = rubro.idrubro
		AND nodos.idnodo = propiedadesTienda.idnodo
		AND tienda.idtienda = propiedadesTienda.idtienda 
		AND rubro.idrubro = ? AND nodos.piso = ?
		ORDER BY tienda.nombre ASC ";
		$result= $sql->devDatos($consulta,array($idrubro,$piso));
		$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($result->fetch())
		{
			$arr[] = array('idnodo'=>$ubiTienda);
		
		}
		return $arr;

	}

	public function listaTiendasConAreasDeNegocio()
	{

		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT tienda.areaNegocio,nodos.idnodo FROM tienda,propiedadesTienda, nodos WHERE tienda.idtienda=propiedadesTienda.idtienda AND propiedadesTienda.idnodo = nodos.idnodo AND tienda.areaNegocio != 0 AND tienda.areaNegocio!=1";
		$result= $sql->devDatos($consulta);
		//$result->bind_result($idtienda,$nombre,$logo,$piso,$ubiTienda);
		while ($value = $result->fetch_assoc())
		{
			$arr[] = array('areaN'=>$value["areaNegocio"],'idnodo'=>$value["idnodo"]);
		
		}
		return $arr;

	}

	public function listaAreasDeNegocioxPiso($piso)
	{

		$arr = array();
		$sql=conexionMySQLi::getInstance();
		$consulta="SELECT areaNegocios.nombre, nodos.coordenadaReal FROM nodos, areaNegocios,posAreaNegocio where areaNegocios.idareaNegocio = posAreaNegocio.idareaNegocio and posAreaNegocio.idnodo = nodos.idnodo and nodos.piso = ?";
		$result= $sql->devDatos($consulta,array($piso));
		$result->bind_result($nombre,$coordenada);

		while ($result->fetch())
		{
			$arr[] = array('nombre'=>$nombre,'coordenada'=>$coordenada);
		
		}
		return $arr;

	}
	
	
	
	

	
}
?>
