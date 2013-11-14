<?php

require_once ('src/core/conexionMySQLi.class.php');
require_once ('src/core/conexionBD.php');
require_once 'src/core/conf.class.php';

require_once ('src/classes/controlTienda.class.php');
require_once ('src/classes/controlProducto.class.php');
require_once ('src/classes/controlMarca.class.php');
require_once ('src/classes/controlRubros.class.php');

require_once ('src/classes/controldetalleRubro.class.php');
require_once ('src/classes/controldetalleTienda.class.php');
require_once ('src/classes/controldetalleMarca.class.php');
require_once ('src/classes/controlNodo.class.php');
require_once ('src/classes/controlCambiadores.class.php');
require_once ('src/classes/controlpropiedadesTienda.class.php');

require_once ('src/classes/controlTotem.class.php');
class archivo
{
	public function upload($arch)
	{
		
		if($_FILES && $_FILES["archivo"]["type"]=="text/plain" && $_FILES["archivo"]["size"]<=1073741824)
		{
			$prefijo = substr(md5(uniqid(rand())),0,6);
			$ruta = "src/file/";
			$archivo = $_FILES["archivo"]['name'];
			$destino = $ruta.$prefijo."_".$archivo; //$ruta.$archivo;
     		move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
     		//echo "upload".$destino."_".$arch["radio1"];
     		$control = archivo::load($destino,$arch["radio1"]);
     		//unlink($destino);//una ves cargado el archivo a la base de datos se eliminara
     		return $control;
     		
		}
		else
		{
			return -21;
		}
		
	}
	public function load($root,$type=null) 
	{
		/*
		 * type corresponde a la tabla que se genera la carga de datos estan pueden ser:
		 * tienda,rubro,productos,marcas,promociones
		 * 
		 */	
			$files = file($root);//("src/file/maestro.txt");
			$arr = array();
			$arrTem = null;
			foreach ($files as $linea)
			{
				
				
				switch ($type)
				{
					case "tienda":
					
							$arrTem = split(",",$linea);
							
							if(isset($arrTem) && count($arrTem)==3 && $arrTem[0]!=null)
							{ 
								$arr[] = array("id"=>trim($arrTem[0]),"nombre"=>trim($arrTem[1]),"logo"=>trim($arrTem[2]));
							}
					
					break;
					
					case "productos":
						
						$arrTem = split(",",$linea);
							
						if(isset($arrTem) && count($arrTem)==4 && $arrTem[0]!=null)
						{
							$arr[] = array("idproducto"=>trim($arrTem[0]),"nombre"=>trim($arrTem[1]),"genero"=>trim($arrTem[2]),"tipo"=>trim($arrTem[3]));
						}
						
						break;
						
					case "marcas":
						
						$arrTem = split(",",$linea);
							
						if(isset($arrTem) && count($arrTem)==2 && $arrTem[0]!=null)
						{
							$arr[] = array("idmarca"=>trim($arrTem[0]),"nombre"=>trim($arrTem[1]));
						}

						break;

					case "rubro":
						
							$arrTem = split(",",$linea);
							//echo "aqui";
							
							if(isset($arrTem) && count($arrTem)==3 && $arrTem[0]!=null)
							{
								
								$arr[] = array("idrubro"=>trim($arrTem[0]),"nombre"=>trim($arrTem[1]),"logo"=>trim($arrTem[2]));
							}
						
					   break;

					   case "detallerubro":
					   
					   	$arrTem = split(",",$linea);
					   	//echo "aqui";
					   		
					   	if(isset($arrTem) && count($arrTem)==3 && $arrTem[0]!=null)
					   	{
					   
					   		$arr[] = array("iddetalleRubro"=>trim($arrTem[0]),"idtienda"=>trim($arrTem[1]),"idrubro"=>trim($arrTem[2]));
					   	}
					   
					   	break;
						
					   case "detalletienda":
					   	
					   	$arrTem = split(",",$linea);
					   	//echo "aqui";
					   	
					   	if(isset($arrTem) && count($arrTem)==3 && $arrTem[0]!=null)
					   	{
					   	
					   		$arr[] = array("iddetalleTienda"=>trim($arrTem[0]),"idtienda"=>trim($arrTem[1]),"idproducto"=>trim($arrTem[2]));
					   	}
					   	
					   	break;
					   	
					   	case "detallemarca":
					   			
					   		$arrTem = split(",",$linea);
					   		//echo "aqui";
					   			
					   		if(isset($arrTem) && count($arrTem)==3 && $arrTem[0]!=null)
					   		{
					   				
					   			$arr[] = array(trim($arrTem[0]),trim($arrTem[1]),trim($arrTem[2])); //array("iddetalleMarca"=>trim($arrTem[0]),"idproducto"=>trim($arrTem[1]),"idmarca"=>trim($arrTem[2]),"idtienda"=>trim($arrTem[3]));
					   		}
					   		else {echo "no entro<br>";}
					   			
					   		break;
					   		
					   		case "nodos":
					   			 
					   			$arrTem = split(",",$linea);
					   			//echo "aqui";
					   			 //print_r($arrTem);
					   			 
					   			if(isset($arrTem) && count($arrTem)==10 && $arrTem[0]!=null)
					   			{
					   		
					   				$arr[] = array("idnodo"=>trim($arrTem[0]),"idcambiadorPiso"=>trim($arrTem[1]),"ubicacionx"=>trim($arrTem[2]),"ubicaciony"=>trim($arrTem[3]),"piso"=>trim($arrTem[4]),"vecino1"=>trim($arrTem[5]),"vecino2"=>trim($arrTem[6]),"vecino3"=>trim($arrTem[7]),"vecino4"=>trim($arrTem[8]),"coordenadaReal"=>trim($arrTem[9]));
					   				//print_r($arr);
					   				//die();
					   			}
					   			 
					   			break;
					   			
				   			case "cambiadores":
				   			
				   				$arrTem = split(",",$linea);
				   				//echo "aqui";
				   			
				   				if(isset($arrTem) && count($arrTem)==7 && $arrTem[0]!=null)
				   				{
				   			
				   					$arr[] = array("idcambiadorPiso"=>trim($arrTem[0]),"idnodo"=>trim($arrTem[1]),"tipo"=>trim($arrTem[2]),"sube"=>trim($arrTem[3]),"baja"=>trim($arrTem[4]),"idnodoSubida"=>trim($arrTem[5]),"idnodoBajada"=>trim($arrTem[6]));
				   				}
					   		
				   				break;
							case "propiedadesTienda":

				   				$arrTem = split(",",$linea);
				   				//echo "aqui";
				   				
				   				if(isset($arrTem) && count($arrTem)==4 && $arrTem[0]!=null)
				   				{
				   				
				   					$arr[] = array("idpropiedadesTienda"=>trim($arrTem[0]),"idtienda"=>trim($arrTem[1]),"idnodo"=>trim($arrTem[2]),"modulo"=>trim($arrTem[3]));
				   				}
				   				
				   				break;

						case "totem":
				   				$arrTem = split(",",$linea);
				   				//echo "aqui";
				   				 
				   				if(isset($arrTem) && count($arrTem)==4 && $arrTem[0]!=null)
				   				{
				   					 
				   					$arr[] = array("idtotem"=>trim($arrTem[0]),"idnodo"=>trim($arrTem[1]),"nombre"=>trim($arrTem[2]),"orientacion"=>trim($arrTem[3]));
				   				}
				   				
				   				break;		
					   	
				}
			}
				
			//print_r($arr); 
			//die();
				 switch ($type)
				 {
				 	case "tienda":
				 		
					 		if(count($arr)>0)
					 		 {
						 		foreach ($arr as $tienda)
						 		{
						 			controlTienda::insertTienda($tienda);
						 		}
						 		return 30;
						 	}
					 		else
					 		{
					 			return -20;
					 		}
				 		
				 		break;

				 	case "productos":

					 		if(count($arr)>0)
					 		{
					 			foreach ($arr as $producto)
					 			{
					 				controlProducto::insertProducto($producto);
					 			}
					 			return 30;
					 		}
					 		else
					 		{
					 			return -20;
					 		}
				 		
				 		break;

				 	case "marcas":
				 		
				 		if(count($arr)>0)
				 		{
				 			foreach ($arr as $marcas)
				 			{
				 				controlMarca::insertMarcas($marcas);
				 			}
				 			return 30;
				 		}
				 		else
				 		{
				 			return -20;
				 		}
				 		
				 		break;
				 		
				 		case "rubro":
				 				
				 			if(count($arr)>0)
				 			{
				 				foreach ($arr as $rubro)
				 				{
				 					controlRubros::insertRubros($rubro);
				 				}
				 				return 30;
				 			}
				 			else
				 			{
				 				return -20;
				 			}
				 				
				 			break;

				 			case "detallerubro":
				 				 
				 				if(count($arr)>0)
				 				{
				 					foreach ($arr as $detalleR)
				 					{
				 						controldetalleRubro::insertDetalleRubro($detalleR);
				 					}
				 					return 30;
				 				}
				 				else
				 				{
				 					return -20;
				 				}
				 				 
				 				break;

				 			 case "detalletienda":
				 				
				 				if(count($arr)>0)
				 				{
				 					foreach ($arr as $detalleT)
				 					{
				 						controldetalleTienda::insertDetalleTienda($detalleT);
				 					}
				 					return 30;
				 				}
				 				else
				 				{
				 					return -20;
				 				}
				 			
				 				break;
				 				
				 				case "detallemarca":
				 					 
				 					if(count($arr)>0)
				 					{
				 						foreach ($arr as $detalleM)
				 						{
				 							//$dat = $arr[0];
				 							//print_r($arr[0]);
				 							 controldetalleMarca::insertDetalleMarca($detalleM);
				 							//controldetalleMarca::insertDetalleMarca($detalleM);
				 						}
				 						return 30;
				 					}
				 					else
				 					{
				 						return -20;
				 					}
				 				
				 					break;

				 				case "nodos":

				 					if(count($arr)>0)
				 					{
				 						foreach ($arr as $nodo)
				 						{
				 							controlNodo::insertaNodo($nodo);
				 						}
				 						return 30;
				 					}
				 					else
				 					{
				 						return -20;
				 					}
				 						
				 					break;
				 					
				 				case "cambiadores":
				 					
				 					if(count($arr)>0)
				 					{
				 						foreach ($arr as $cambiador)
				 						{
											//controlNodo::insertaNodo($nodo);
											controlCambiadores::insertCambiadores($cambiador);
			 							}
			 							return 30;
			 						}
			 						else
				 					{
				 						return -20;
				 					}
				 						
				 						break;
				 				
								case "propiedadesTienda":
				 						
				 						if(count($arr)>0)
				 						{
				 							foreach ($arr as $pro)
				 							{
				 								//controlNodo::insertaNodo($nodo);
				 								//controlCambiadores::insertCambiadores($cambiador);
				 								controlpropiedadesTienda::insertPropiedadesTienda($pro);
				 							}
				 							return 30;
				 						}
				 						else
				 						{
				 							return -20;
				 						}
				 						
				 						
				 						break;	
								case "totem":
										
				 						if(count($arr)>0)
				 						{
				 							foreach ($arr as $pro)
				 							{
				 								//controlNodo::insertaNodo($nodo);
				 								//controlCambiadores::insertCambiadores($cambiador);
				 								controlTotem::inserttotem($pro);
				 							}
				 							return 30;
				 						}
				 						else
				 						{
				 							return -20;
				 						}
				 						
				 							
				 						break;
				 }	
				/*if(count($arr)>0) 
				{
					foreach ($arr as $tienda)
					{
						controlTienda::insertTienda($tienda);
					}
					return 30;
				}
				else
				{
					return -20;
				}*/
	 
	  
	}
	
	public function loadPropiety($datos)
	{//10 y 20
		//$data=  array($post["rol"],$post["subRol"],$post["nombreCta"],$post["nombrePropiedad"],$region,$post["region"],$comuna,$post["comuna"],$post["areaTD"],$post["direccion"],$post["observaciones"],$estado);
		//print_r($datos);
		//die();
		//$i=1;
		foreach ($datos as $data)
		{
			$rolSubrol = array();																	//ciudad,codCiudad      ,comuna,codComuna    			
			$rolSubrol = split("-",$data["rol"]);
			$codcomuna = Datacollector::getcodComuna($data["codCiudad"],$data["comuna"]);
			$ciudad = Datacollector::getnomregion($data["codCiudad"]);
			$estado = 1;
			$leasing = null;
			$empresa = null;
			if(strpos($data["leasing"],"í")==1)
			{
				//echo "ok"."<br>";
				$leasing = -2;
			}
			else
			{
				//echo "no"."<br>";
				$leasing = 0;
			}
			
			$paramInserPropiedad = array($rolSubrol[0],$rolSubrol[1],strtoupper($data["nombreCta"]),strtoupper($data["nombrePropiedad"]),$ciudad,$data["codCiudad"],strtoupper($data["comuna"]),$codcomuna,strtoupper($data["areaTD"]),strtoupper($data["direccion"]),strtoupper($data["obsevaciones"]),$estado,$leasing,$data["EmpLeasing"]);
			bienesRaicesControl::prepareinsertPropiedad($paramInserPropiedad);
			//"mConstruido"=>$corte[10],"mTerreno"=>$corte[11],"mCiudad"=>$corte[12],"mCerro"=>$corte[13],"fundo"=>$corte[14]
			$id_Propiedad = Datacollector::getIdPropiedad($rolSubrol[0],$rolSubrol[1],strtoupper($data["nombrePropiedad"]));
			bienesRaicesControl::preparaSuperficie($id_Propiedad,$data["mConstruido"],$data["mTerreno"],$data["mCiudad"],$data["mCerro"],$data["fundo"]);
			//$id_detalle = Datacollector::getIdDetalleP($id_Propiedad);
			//"UFmVC"=>$corte[15],"UFVC"=>$corte[16],"UFmVF"=>$corte[17],"UFVF"=>$corte[18],"anoContribucion"=>$corte[19],"UFmVL"=>$corte[20],"UFVL"=>$corte[21]
			//preparaDetalleValor($id_Propiedad,$valorCompUFm,$valorCompUF,$valorFiscalUFm,$valorFiscalUF,$contribucionAnoUF,$valorCompLibroUFm,$valorCompraLibroUF)
			bienesRaicesControl::preparaDetalleValor($id_Propiedad,$data["UFmVC"],$data["UFVC"],$data["UFmVF"],$data["UFVF"],$data["anoContribucion"],$data["UFmVL"],$data["UFVL"]);
			//$i++;
		}		
		
	}
	public function loadArchivoPropiedad($arch)  // NO ESTA GENERICO REALIZAR NUEVANMENTE SIN PRESION
	{	//RUTAAAAAAAA->  "src/docs/"
		$ruta = "src/docs/";
		$documento = "Documento";
		$plano = "Planos";
		$otro = "Otro";
		$rol = $arch["rol"];
		$subRol = $arch["subRol"];
		$nombrePropiedad = $arch["nombrePropiedad"];
		$id_Propiedad = Datacollector::getIdPropiedad($rol,$subRol,$nombrePropiedad);
		$dato=0;
		
		//if($_FILES["archivo"]["name"]!="" && $_FILES["archivi1"]["name"]!="" && $_FILES["archivo2"]["name"]!="")
		 if($_FILES["archivo"]["name"]!="")
		 {	
			if( strpos($_FILES["archivo"]["type"],".bin")==0 && strpos($_FILES["archivo"]["type"],".sh")==0 && strpos($_FILES["archivo"]["type"],".exe")==0 && strpos($_FILES["archivo"]["type"],".msi")==0 && strpos($_FILES["archivo"]["type"],".php")==0 && strpos($_FILES["archivo"]["type"],".rmp")==0  && strpos($_FILES["archivo"]["type"],".deb")==0 && $_FILES["archivo"]["size"]<=1073741824)
			{
					
					$archivo = $_FILES["archivo"]['name'];
					$type = $_FILES["archivo"]["type"];
					$nombre = $id_Propiedad.$documento.$archivo;
					$destino = $ruta.$nombre;//$id_Propiedad."_".$documento.$archivo; //$ruta.$archivo;
		     		move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
		     		archivo::cargaBDArchivo($id_Propiedad,$ruta,$nombre,$type);
    		 		$dato =+$dato;
	     		
			}
		 	else
			{
				return -50;
			}
		 }
		 if($_FILES["archivo1"]["name"]!="")
		 {
		 if( strpos($_FILES["archivo1"]["type"],".bin")==0 && strpos($_FILES["archivo1"]["type"],".sh")==0 && strpos($_FILES["archivo1"]["type"],".exe")==0 && strpos($_FILES["archivo1"]["type"],".msi")==0 && strpos($_FILES["archivo1"]["type"],".php")==0 && strpos($_FILES["archivo1"]["type"],".rmp")==0  && strpos($_FILES["archivo1"]["type"],".deb")==0 && $_FILES["archivo1"]["size"]<=1073741824)
			{
					
					$archivo = $_FILES["archivo1"]['name'];
					$type = $_FILES["archivo1"]["type"];
					$nombre = $id_Propiedad.$plano.$archivo;
					$destino = $ruta.$nombre;//$id_Propiedad."_".$plano.$archivo; //$ruta.$archivo;
		     		move_uploaded_file($_FILES['archivo1']['tmp_name'],$destino);
		     		archivo::cargaBDArchivo($id_Propiedad,$ruta,$nombre,$type);
		     		$dato =+$dato;
	     		
			}
			else
			{
				return -50;
			}
		 }
		 if($_FILES["archivo2"]["name"]!="")
		 {
		  if( strpos($_FILES["archivo2"]["type"],".bin")==0 && strpos($_FILES["archivo2"]["type"],".sh")==0 && strpos($_FILES["archivo2"]["type"],".exe")==0 && strpos($_FILES["archivo2"]["type"],".msi")==0 && strpos($_FILES["archivo2"]["type"],".php")==0 && strpos($_FILES["archivo2"]["type"],".rmp")==0  && strpos($_FILES["archivo2"]["type"],".deb")==0 && $_FILES["archivo2"]["size"]<=1073741824)
			{
					
					$archivo = $_FILES["archivo2"]['name'];
					$type = $_FILES["archivo2"]["type"];
					$nombre = $id_Propiedad.$otro.$archivo;
					$destino = $ruta.$nombre;//$id_Propiedad."_".$otro.$archivo; //$ruta.$archivo;
		     		move_uploaded_file($_FILES['archivo2']['tmp_name'],$destino);
		     		$dato =+$dato;
    		 		archivo::cargaBDArchivo($id_Propiedad,$ruta,$nombre,$type);
	     		
			}
			else
			{
				return -50;
			}
		 }
		 
	}
	public function loarArc($data)
	{
		$ruta ="src/docs/";
		$tipoDocumento = null;
		//print_r($data);
		//die();
		$ite = 0;
		if(!isset($data["radio"]))
		{
			$id_Propiedad= Datacollector::getIdPropiedad($data["rol"],$data["subRol"],$data["nombrePropiedad"]);
			if(count($_FILES)>0)
					{
						foreach ($_FILES as $fil)
							{
								if($fil["size"]>0)
								{
									$extension = archivo::extensionArchivo($fil["name"]);
									if($ite==0)
									{
										$tipoDocumento = "Documento";
									}
									if($ite==1)
									{
										$tipoDocumento = "Planos";
									}
									if($ite==2)
									{
										$tipoDocumento = "Otro";
									}
									if(!is_readable($fil["name"]) && archivo::is_executableA($extension)) // ver el tema de controlar los archivos por el id de la tabla archivo
									{
										/* 
										 * id_Propiedad,ruta,nombreUs,nombreHd,extension,tipo
										 */
										/*
										 * nombreControl este sera un numero autoincrementable a nivel de software que identificara el nombre
										 * del archivo a nivel de sistema. 
										 */
										$fil["name"] = str_replace(" ", "_", $fil["name"]);
										$conta = archivo::contadorArchivos()+100;
										$nombreHd = time()."_".$conta."_".$fil["name"];
										$destino = $ruta.$nombreHd;
										move_uploaded_file($fil["tmp_name"],$destino);
										archivo::cargaBDArchivo($id_Propiedad,$ruta,$fil["name"],$nombreHd,$fil["type"],$tipoDocumento);
								
									}
									else
									{
										//echo "es ejecutable";
										return -150;
									}	
								}
						
							$ite++;
							}
							return 1;
					}
		}
		else
		{
		
			if(count($_FILES)>0)
				{
					foreach ($_FILES as $fil)
						{
							if($fil["size"]>0)
							{
								$extension = archivo::extensionArchivo($fil["name"]);
							
								if(!is_readable($fil["name"]) && archivo::is_executableA($extension)) // ver el tema de controlar los archivos por el id de la tabla archivo
								{
									/* 
									 * id_Propiedad,ruta,nombreUs,nombreHd,extension,tipo
									 */
									/*
									 * nombreControl este sera un numero autoincrementable a nivel de software que identificara el nombre
									 * del archivo a nivel de sistema. 
									 */
									$fil["name"] = str_replace(" ", "_", $fil["name"]);
									//print_r($fil["name"]);
									//die();
									$conta = archivo::contadorArchivos()+100;
									$nombreHd = time()."_".$conta."_".$fil["name"];
									$destino = $ruta.$nombreHd;
									move_uploaded_file($fil["tmp_name"],$destino);
									archivo::cargaBDArchivo($data["id_Propiedad"],$ruta,$fil["name"],$nombreHd,$fil["type"],$data["radio"]);
								
								}
								else
								{
									//echo "es ejecutable";
									return -150;
								}	
							}
						
						
						}
						return 1;
				}
		}		
	}
	public function extensionArchivo($filename)
	{
		return substr(strrchr($filename, '.'), 1);
	}
	public function is_executableA($extension)
	{
		if($extension =="sh" || $extension=="bin" || $extension=="exe" || $extension=="rpm" || $extension=="dev" || $extension=="msi" || $extension=="php" || $extension=="pl" || $extension=="py")
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	public function cargaBDArchivo($id_Propiedad,$ruta,$nombreUs,$nombreHd,$extension,$tipo)
	{
		$sql = conexionMySQLi::getInstance();
		$param = array($id_Propiedad,$ruta,$nombreUs,$nombreHd,$extension,$tipo);
		$sentencia = "INSERT INTO archivo(id_Propiedad,ruta,nombreUs,nombreHd,extension,tipo) VALUES(?,?,?,?,?,?)";
		$sql ->ejecutarSentencia($sentencia,$param);
	}
	public function verificarArchivoBD($idP)
	{
		$sql = conexionMySQLi::getInstance();
		$arr = array();
		$sentencia = "SELECT id_archivo,id_Propiedad,ruta,nombreUs,nombreHd,extension,tipo FROM archivo WHERE id_Propiedad=? ORDER BY tipo ASC";
		$resulset = $sql->devDatos($sentencia,$idP);
		$resulset-> bind_result($id_archivo,$id_Propiedad,$ruta,$nombreUs,$nombreHd,$extension,$tipo);
		while($resulset -> fetch())
		{
			$arr[] = array("id_archivo"=>$id_archivo,"id_Propiedad"=>$id_Propiedad,"ruta"=>$ruta,"nombreUs"=>$nombreUs,"nombreHd"=>$nombreHd,"extension"=>$extension,"tipo"=>$tipo);
		}
		return $arr;
	}
	public function getDatarchivoid($id_archivo)
	{
		$sql = conexionMySQLi::getInstance();
		$arr = array();
		$sentencia = "SELECT id_archivo,id_Propiedad,ruta,nombreUs,nombreHd,extension,tipo FROM archivo WHERE id_archivo=?";
		$resulset = $sql->devDatos($sentencia,$id_archivo);
		$resulset-> bind_result($id_archivo,$id_Propiedad,$ruta,$nombreUs,$nombreHd,$extension,$tipo);
		if($resulset -> fetch())
		{
			$arr = array("id_archivo"=>$id_archivo,"id_Propiedad"=>$id_Propiedad,"ruta"=>$ruta,"nombreUs"=>$nombreUs,"nombreHd"=>$nombreHd,"extension"=>$extension,"tipo"=>$tipo);
		}
		return $arr;
	}
	public function contadorArchivos()
	{
		$sql = conexionMySQLi::getInstance();
		$sentencia = "SELECT id_archivo  FROM archivo Order by id_archivo desc Limit 0,1";
		$resulset = $sql->devDatos($sentencia);
		if($value = $resulset->fetch_assoc()) //$value = $resultset->fetch_assoc()
		{
			return $value["id_archivo"];
		}
		return 0;
		// SELECT id_Propiedad FROM `Propiedad` Order by id_Propiedad desc Limit 0,1
	}
	public function deleteArchivoBD($data)
	{
		$sql = conexionMySQLi::getInstance();
		$param = array($data["id_archivo"]);
		$sentencia = "DELETE FROM archivo WHERE id_archivo=?";
		$sql -> ejecutarSentencia($sentencia,$param);
		return 1;
		
	}
	public function deletearchivoDisk($data)
	{
		$ruta ="src/docs/";
		if(is_readable($ruta.$data["nombreHd"]))
		{
			unlink($ruta.$data["nombreHd"]);
			return 1;
		}
		else
		{
			return -70;
		}
	}
	public function deletearchivoSys($data)
	{
		if(archivo::deletearchivoDisk($data)==1)
		{
			if(archivo::deleteArchivoBD($data)==1)
			{
				return 1;
			}
			else
			{
				return -81;
			}
		}
		else
		{
			return -81;
		}
		
	}
}

/*
 * 	$vigencia = null; // Vigente
	  	$clasificacion = null; // Clasificacion
	  	$nombreCta = null;    //Nombre_Cta 
	  	$nombrePropiedad = null;  //Propiedad
	  	$direccion = null; //direccion
	  	$region = null;     //codCiudad	  	
	  	$ciudad = null; // Region
	  	$comuna = null; // comuna
	  	$sector = null;  // comuna(creo)
	  	$areaTD = null;
	  	$mCiudad = null;    // m Ciudad
	  	$mCerro = null; 	// m Cerro
	  	$fundo = null;		// Ha Fundo
	  	$ufmVCC = null;		// mUF Valor compra aproximado
	  	$ufvcVCC = null;	// uf Valor Compra
	  	$ufmVF = null;       // m UF Valor Fiscal 
	  	$ufvfVF = null;		// UF valor fiscal
	  	$AnoUF = null; 		// contribuciones 
	  	$ufmVLL = null;		//valor compra (libro) mUF
	  	$ufVLL = null;		//valor compra (libro) ufvl
	  	$duenoActual = null; // dueno Actual 
	  	$rol= null; //ROLII
	  	$leasing = null;			//ok
	  	$empLeasing = null;			//ok	
	  	$arrendatario = null;		//ok
	  	$valorArriendo = null;		//ok
	  	$participacion = null;		//ok
	  	$observacionesGenerales = null;	//ok
	  	$rolCompartido = null;			//ok
	  	$ProRolCompartido = null;		//ok
	  	//32
 * */
?>
