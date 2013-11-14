<?php
define('PATH_SOURCE_CLASSES','src/classes/');
define('PATH_SOURCE_CORE','src/core/');
define('PATH_SOURCE_CSS','src/css/');
define('PATH_SOURCE_IMAGES','src/img/');
define('PATH_SOURCE_JS','src/js/');
define('PATH_SOURCE_LIB','src/lib/');
define('PATH_SOURCE_MODULES','src/modulos/');
define('PATH_ABSOLUTE',dirname(__FILE__).DIRECTORY_SEPARATOR);

require_once(PATH_SOURCE_CORE.'conf.class.php');
require_once(PATH_SOURCE_CORE.'conexionMySQLi.class.php');
require_once (PATH_SOURCE_CLASSES.'usuario.php');

	class usuarioControl
	{
		public function preparaUsuario($post)
		{
			/*RETORNA 1 SI REALIZO LA INSERCION.
			 *RETORNA 0 SI LA INSERCION NO PUDO REALIZARSE porque habian valores nulos
			 *RETORNA -4 SI EL USUARIO YA ESTA REGISTRADO EN LA BD			  
			*/
			if( $post["nomComUsuario"]!=null && $post["nomUsuario"] != null && $post["mailUsuario"] != null && $post["passUsuario"] != null && $post["passUsuario2"] != null && $post["privilegioUsuario"] > 0 )
			{
				if (usuarioControl::getIdUsuario($post["nomUsuario"]) == null ) // PREGUNTA SI EL NOMBRE DE USUARIO NO ESTA EN LA BD 
				{	
					if($post["passUsuario"] == $post["passUsuario2"] ){
						$data =array($post["nomComUsuario"], $post["nomUsuario"], $post["mailUsuario"],md5($post["passUsuario"]), $post["privilegioUsuario"]);
						//print_r($post); die();
						usuarioControl::insertUsuario($data); // INSERTA EL USUARIO EN LA BD.
						$id = usuarioControl::getIdUsuario($post["nomUsuario"]);
						if($id != null){
							switch($post["privilegioUsuario"]){
								case 1:
									$privileges = array(
									);
								break;
								case 2:
									$privileges = array(
									);
								break;/*
								case 3:
									$privileges = array(
													"addFichaPaciente"=>false,
													"addIngresoHidrico"=>false,
													"addEgresoHidrico"=>false,
													"addControlDiabetes"=>false,
													"addExamen"=>false,
													"addMedicamentos"=>false,
													"addSignosVitales"=>false,
													"admin"=>false,
													"viewFichaPaciente"=>false,
													"viewIngresoHidrico"=>false,
													"viewEgresoHidrico"=>false,
													"viewControlDiabetes"=>false,
													"viewExamen"=>false,
													"viewMedicamentos"=>false,
													"viewSignosVitales"=>false
									);
								break;*/
								default:
									$privileges = array(
									);

								break;
							}
							usuarioControl::setNodo($id, $privileges);
						}
						return 1;
					}else {
						
						return -3;
					}										
				}
				else{
					return -4;
				}				
			}
			else
			{
				return 0;
			}
		}		
		public function verUsuarios()
		{
			return usuarioControl::listUsuarios();
		}
		
		public function deleteUser(){
			usuarioControl::deleteUser_(func_get_arg(0));
		}		
		
		public function getUser($id){
			$usuario = null;
			$sql = conexionMySQLi::getInstance();
			$usuario = array(); 
			$sentencia = "SELECT id_usuario, nomComUsuario, nomUsuario, mailUsuario, passUsuario, privilegioUsuario FROM usuario WHERE id_usuario =".$id."";
			$resultset = $sql->devDatos($sentencia);
			if($value = $resultset->fetch_assoc()){
			  	$usuario = new usuario($value["id_usuario"], $value["nomComUsuario"], $value["nomUsuario"], $value["mailUsuario"], $value["passUsuario"], $value["privilegioUsuario"]);
			}
			
			if($usuario != null){
				$sentencia = "SELECT * FROM totem WHERE id_usuario = ".$usuario->getIdUsuario();
				
				$result = $sql->devDatos($sentencia);
				
				if($row = $result->fetch_assoc()){
					$nodo = $row["idnodo"];
				}
				
				$usuario->setNodo(nodo);
			}

			return $usuario;
		}		

		public function prepareEditUser($id,$POST){
			if ($POST['nomComUsuario'] != null && $POST['nomUsuario'] != null && $POST['mailUsuario'] !=null && ($POST['passUsuario1'] == $POST['passUsuario2']) && $POST['cboNuevoPrivilegio'] != 0){
				$user = usuarioControl::getUser($id);
				usuarioControl::edituser($id,$POST);		
						
				if($user->getPrivilegio() != $POST['cboNuevoPrivilegio']){

						switch($POST['cboNuevoPrivilegio']){
								case 1:
									$privileges = array(
									);
								break;
								case 2:
									$privileges = array(
									);
								break;
								case 3:
									$privileges = array(
									);
								break;
								default:
									$privileges = array(
									);

								break;
							}
						usuarioControl::setNodo($id, $privileges);
				}
			}
		}
		
		public function prepareCambiarPassword($user,$pass,$con){
			//echo $pass, $user, $con; die();			
			$usuario = usuarioControl::getLoginfromUser($user,$pass);
			//print_r($usuario); die();
			if( $usuario != null){ 
				$id = $usuario->getIdUsuario();
				//echo $id; die();
				//$confinal = md5($con);
										
				usuarioControl::CambiarPassword($id,$con);
				return 1;				
			}
			return null; 
		}
		
		public function CambiarPassword($pass,$id){
			//echo $id, $pass;		
			$sql= conexionMySQLi::getInstance();
			$sentencia = "UPDATE usuario SET passUsuario = ? WHERE id_usuario = ?";
			//print_r($sentencia);
			$data = array($id,$pass);
			//print_r($data); die();			
			$sql->ejecutarSentencia($sentencia,$data);			
		}
		
		public function comparaLogin($user,$pass){
			$usuario = new usuario();
			if($pass != null && $user != null){				
				return usuarioControl::getLoginfromUser($user,$pass);				 
			}else {
				return null;
			}						
		}

		########################################################## INSERCION DE USUARIO #######################################################
/*	
		public function getnomUsuario($nomUsuario)
		{
			
			$sql = conexionMySQLi::getInstance();
			$sentencia = "SELECT nomUsuario FROM usuario WHERE nomUsuario = ? ";
			$resulset = $sql->devDatos($sentencia,$nomUsuario);
			$resulset-> bind_result($nombre);

			if($resulset->fetch())
			{
				return $nombre; //SI ENCUENTRA EN NOMBRE DE USUARIO, LO RETORNA.
					
			}
			return -1;	// retorna -1 si el NOMBRE DE USUARIO, no se encuentra en la BD
		}
	*/	
		public function getIdUsuario($nomUsuario)
		{
			
			$sql = conexionMySQLi::getInstance();
			$sentencia = "SELECT id_usuario FROM usuario WHERE nomUsuario = ? ";
			$resulset = $sql->devDatos($sentencia,$nomUsuario);
			$resulset-> bind_result($id);

			if($resulset->fetch())
			{
				return $id; //SI ENCUENTRA EN NOMBRE DE USUARIO, LO RETORNA.
					
			}
			return null;	// retorna -1 si el NOMBRE DE USUARIO, no se encuentra en la BD
		}
		
	
		public function insertUsuario($data)
		{
			$sql = conexionMySQLi::getInstance();
			$sentencia = "INSERT INTO usuario(nomComUsuario, nomUsuario, mailUsuario, passUsuario, privilegioUsuario)  VALUES (?,?,?,?,?)";
			$sql-> ejecutarSentencia($sentencia,$data);
		}
	
		public function listUsuarios()
		{
			$sql = conexionMySQLi::getInstance();
			$sentencia = "SELECT * FROM usuario WHERE nomUsuario != 'admin' AND nomUsuario != 'developer'";
			$result = $sql-> devDatos($sentencia);
			$response = array();
			while ($fila = $result->fetch_assoc())
			{
				$response[] = $fila;
			}
			return $response;
		}

		public function deleteUser_($id)
		{
			$sql = conexionMySQLi::getInstance();
			$sentencia = "DELETE FROM usuario WHERE id_usuario = '". $id ."'";
			$result = $sql-> devDatos($sentencia);	
		}
	
		public function editUser($id,$elems)
		{
			$sql = conexionMySQLi::getInstance();
			
			if($elems["passUsuario1"]!=null){
				$sentencia = "UPDATE usuario SET nomComUsuario = ?, nomUsuario = ?, mailUsuario = ?, passUsuario = ?, privilegioUsuario = ? WHERE id_usuario = ?";
				$data = array($elems["nomComUsuario"],$elems["nomUsuario"],$elems["mailUsuario"], md5($elems["passUsuario1"]), $elems["cboNuevoPrivilegio"], $id);
			}else{
				$sentencia = "UPDATE usuario SET nomComUsuario = ?, nomUsuario = ?, mailUsuario = ?, privilegioUsuario = ? WHERE id_usuario = ?";
				$data = array($elems["nomComUsuario"],$elems["nomUsuario"],$elems["mailUsuario"], $elems["cboNuevoPrivilegio"], $id);
			}		
			$sql-> ejecutarSentencia($sentencia,$data);	
		}
	
		public function getLoginfromUser($user,$pass){
			$usuario = null;
			$sql = conexionMySQLi::getInstance();
			$sentencia = "SELECT id_usuario, nomComUsuario, nomUsuario, mailUsuario, privilegioUsuario FROM usuario WHERE nomUsuario = ? AND passUsuario = ?";
			$resultset = $sql->devDatos($sentencia,array($user,$pass));

			$resultset->bind_result($id_usuario,$nomComUsuario,$nomUsuario,$mailUsuario,$privilegioUsuario);
			if($resultset-> fetch()){
				$usuario = new usuario($id_usuario,$nomComUsuario,$nomUsuario,$mailUsuario,$privilegioUsuario);
			}
			$resultset->free_result();
			if($usuario != null){
				$sentencia = "SELECT idnodo FROM totem WHERE id_usuario = ".$usuario->getIdUsuario();
				
				$result = $sql->devDatos($sentencia);
				$nodo = null;
				if($row = $result->fetch_assoc()){
					$nodo = $row["idnodo"];
				}
				
				$usuario->setNodo($nodo);
			}
			return $usuario;		
		}
		
		public function setPermisos($userId,$permisos){
			//echo $userId.'<br />';
			//die("bind");
			$sql = conexionMySQLi::getInstance();
			$query = "INSERT INTO perfilUsuario(id_usuario,modulo,credencial) VALUES(?,?,?) ON DUPLICATE KEY UPDATE credencial=?";
			foreach($permisos as $id=>$value){
				$privileges = $value?array($userId,$id,1,1):array($userId,$id,0,0);
				$sql->ejecutarSentencia($query,$privileges);
			}
		}
	}
?>