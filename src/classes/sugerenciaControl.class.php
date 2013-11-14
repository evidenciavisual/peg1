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

class sugerenciaControl{
	
/*
 if(isset($_GET["categoria"])){
	if(isset($_GET["subCategoria"])){
		if(isset($_GET["motivo"])){
			if(isset($_GET["subMotivo"])){
				
			}else{
				//$list = sugerenciaControl::listSubMotivos($_GET["motivo"]);
			}
		}else{
			//$list = sugerenciaControl::listMotivos($_GET["subCategoria"]);
		}
	}else{
		//$list = sugerenciaControl::listSubCategorias($_GET["categoria"]);
	}
}else{
	//$list = sugerenciaControl::listCategorias();
}

 */	
	public function listCategorias(){
		$return = array();
		$sql = conexionMySQLi::getInstance();
		
		$query = "SELECT * FROM categoria";
		$res = $sql->devDatos($query);
		
		while($row = $res->fetch_assoc()){
			$return[] = $row;
		}
		
		return $return;
	}
	
	public function listSubCategorias($id){
		$return = array();
		$sql = conexionMySQLi::getInstance();
		
		$query = "SELECT idSubCategoria,nombreSubCategoria FROM subCategoria WHERE idCategoria = ?";
		$res = $sql->devDatos($query,$id);
		
		$res->bind_result($idSubCategoria, $nombreSubCategoria);
		
		while($res->fetch()){
			$return[] = array("idSubCategoria"=>$idSubCategoria,"nombreSubCategoria"=>$nombreSubCategoria);
		}
		
		return $return;
	}
	
	public function listMotivos($id){
		$return = array();
		$sql = conexionMySQLi::getInstance();
		
		$query = "SELECT idMotivo,nombreMotivo FROM motivo WHERE idSubCategoria = ?";
		$res = $sql->devDatos($query,$id);
		
		$res->bind_result($id, $nombre);
		
		while($res->fetch()){
			$return[] = array("idMotivo"=>$id,"nombreMotivo"=>$nombre);
		}
		
		return $return;
	}
		
	public function listSubMotivos($id){
		$return = array();
		$sql = conexionMySQLi::getInstance();
		
		$query = "SELECT idSubMotivo,nombreSubMotivo FROM subMotivo WHERE idMotivo = ?";
		$res = $sql->devDatos($query,$id);
		
		$res->bind_result($id, $nombre);
		
		while($res->fetch()){
			$return[] = array("idSubMotivo"=>$id,"nombreSubMotivo"=>$nombre);
		}
		
		return $return;
	}
	
	public function sendSugerencia($data){
		$sql = conexionMySQLi::getInstance();
		$query = "INSERT INTO mensaje(mensaje) VALUES (?)"; 
		
		$sql->ejecutarSentencia($query,$data["mensaje"]);
	}
		
	
}?>