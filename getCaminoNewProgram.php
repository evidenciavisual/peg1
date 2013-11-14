<?php
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/nodo.class.php';
require_once 'src/classes/controlTotem.class.php';
require_once 'src/classes/controlTienda.class.php';

$inicio=$_GET["inicio"];
$meta=$_GET["meta"];
if (isset ($_GET['id']))$idTienda=$_GET['id'];
else $idTienda=null;
if (isset ($_GET["foto"])&&file_exists("src/img/logos/tiendas/".$_GET["foto"]))
	$foto=$_GET["foto"];
else $foto="null.jpg";
$totem = controlTotem::getTotem($inicio);
//print_r($totem);
$tienda= controlTienda::getTienda($idTienda);
//var_dump( $totem);

?>
<html>
<script type="text/javascript" src="src/js/caminoMasCorto/pathfinding-browser.js"></script>
<script src="src/js/caminoMasCorto/gMatrix1.js"></script>
<script src="src/js/caminoMasCorto/gMatrix2.js"></script>
<script src="src/js/caminoMasCorto/gMatrix3.js"></script>
<script src="src/js/caminoMasCorto/gMatrix4.js"></script>
<script src="src/js/caminoMasCorto/gMatrixSub1.js"></script>

<script src="src/js/jquery-1.7.1.min.js"></script>
<script src="src/js/mapa/Three.js"></script>
<script src="src/js/mapa/Detector.js"></script>
<script src="src/js/mapa/Stats.js"></script>
<script src="src/js/mapa/Tween.js"></script>
<script type='text/javascript' src='src/js/mapa/dat.gui.js'></script>
<script src="src/js/mapa/Curve.js"></script>
<script src="src/js/mapa/TubeGeometry.js"></script>
<script src="src/js/mapa/ExtrudeGeometry.js"></script>
<script src="src/js/mapa/pp/ShaderExtras.js"></script>
<script src="src/js/mapa/pp/EffectComposer.js"></script>
<script src="src/js/mapa/pp/RenderPass.js"></script>
<script src="src/js/mapa/pp/BloomPass.js"></script>
<script src="src/js/mapa/pp/ShaderPass.js"></script>
<script src="src/js/mapa/pp/MaskPass.js"></script>
<script src="src/js/mapa/pp/SavePass.js"></script>
<head>

		<title>Multiplataforma | Módulo WebGL</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
</head>

<body style="overflow:hidden">
<script>
/*---- ESTADISTICAS GLOBAL------*/
$.ajaxSetup({async: false});
$.get("addEstadistica.php", { nomPag: "<?php echo $tienda->getnombre();?>"} );
/*---- ESTADISTICAS GLOBAL------*/
generaMapa(calculaCamino());
//alert(generaCamino("440_160-291_151","2"));
//calculaCamino();

function calculaCamino()
{
	/*
	 * 1 define inicioActual, metaFinal ,caminoParcial=null y caminoMasCorto=null
	 * 2 Si metaFinal->getpiso() == inicioActual->getpiso()
	 * 	-> metaActual=metafinal
	 * 	Sino
	 * 	-> metaActual= getCambiadorPisoMasCercano(inicioActual)
	 * 3 Calcula camino -> caminoParcial=calculaCamino(inicioActual,metaActual)
	 * 4 Si metaFinal=metaActual
	 * 	-> Si caminoMasCorto != null
	 * 		-> return caminoMasCorto
	 * 	-> Sino
	 * 		-> return caminoParcial
	 * 	Sino
	 * 	-> inicioActual = metaActual
	 * 	-> caminoMasCorto = caminoMasCorto."<separador>".caminoParcial
	 * 	-> vuelvo a 2
	 */
	<?php 
				$inicioOriginal = controlCamino::getNodo($inicio);
				$metaFinal = controlCamino::getNodo($meta);
	?>
	function caminoObj(id,camino,largo,idnodo)
	{
		this.id=id;
		this.camino=camino;
		this.largo=largo;
		this.idnodo=idnodo;
	}
	var cpisos = new Array();
	var pisoInicioOriginal= "<?php echo $inicioOriginal->getpiso();?>";
	var pisoMetaFinal= "<?php echo $metaFinal->getpiso();?>";
	var coorInicioOriginal="<?php echo $inicioOriginal->getcoordenadaReal();?>";
	var coorMetaFinal= "<?php echo $metaFinal->getcoordenadaReal();?>";
	var coorMetaActual="";
	var metaActual="";
	var caminoParcial="";
	var direccion="";
	var cambiadores="";
	var pisoInicioActual=pisoInicioOriginal;
	var coorInicioActual = coorInicioOriginal;
	//alert(coorMetaFinal + "->metafinal " + pisoMetaFinal + "->pisoFinal"); 
	$.ajaxSetup({async: false});
	while(true)
	{
		if(pisoMetaFinal==pisoInicioActual)
		{
			coorMetaActual=coorMetaFinal;
			/*********************************************************************/
			//alert(pisoInicioActual + " pisoActual;" + coorMetaActual + " metaActual");
			//alert(coorInicioActual+"-"+coorMetaActual+" "+pisoInicioActual);
			camino=generaCamino(coorInicioActual+"-"+coorMetaActual,pisoInicioActual);
			//alert(pisoInicioActual + " pisoActual;" +coorInicioActual+ " inicioActual;" + coorMetaActual + " metaActual;" + camino + " camino;"); 
			var cami="";
			for (var i = 0; i < camino.length; i++)
			{
				for(var k=0;k<camino[i].length;k++)
				{
					if(i==0&&k==0)cami=camino[i][k];
					else
					{
						if(k%2==0)cami=cami+"-"+camino[i][k];
						else cami=cami+"_"+camino[i][k];
					}
				
				}
			}
			caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cami;
			//alert(caminoParcial + "<- camino; metaFinal-> " + coorMetaFinal  );
			return caminoParcial;
			/*********************************************************************/
		}
		else
		{
			if(pisoInicioActual<pisoMetaFinal) //SUBE
			{
 				if (Math.abs(pisoInicioActual-pisoMetaFinal)>1) // Mas de 1 piso
 				{
 					cambiadoresTotal=new Array();
 					$.get("getCambiadoresPiso.php", { piso: pisoMetaFinal ,direccion:"baja"},
							   function(data){
						   		
						   			cambiadoresPFinal=data;
					});
					cambiadoresPFinal=cambiadoresPFinal.split(";");
					$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"sube"},
							   function(data){
						   		
						   			cambiadoresPInicial=data;
					});
					cambiadoresPInicial=cambiadoresPInicial.split(";");
					for (var f=0;f<cambiadoresPInicial.length;f++)
					{
						if(cambiadoresPFinal.indexOf(cambiadoresPInicial[f])>-1) cambiadoresTotal.push(cambiadoresPInicial[f]);
					}
					cambiadores=cambiadoresTotal;
					for (var l = 0; l < cambiadores.length; l++) 
					{
						//alert(cambiadores[l]);
						//alert(l);
						//alert(coorInicioActual+"-"+cambiadores[l]+"->piso->"+pisoInicioActual);
						camino = generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
						//alert("camino->"+camino);
						for (var i = 0; i < camino.length; i++)
						{
							for(var k=0;k<camino[i].length;k++)
							{
								if(i==0&&k==0)cami=camino[i][k];
								else
								{
									if(k%2==0)cami=cami+"-"+camino[i][k];
									else cami=cami+"_"+camino[i][k];
									//alert(cami);
								}
							}
							
						}
						camin=cami.split("-"); 
						cpisos[l]=new caminoObj(i,cami,cami.length,camin.slice(-1));
					}
					cpisos.sort(function(a,b){return a.largo - b.largo;});
					//alert (cpisos[0].camino + " cpisos");
					caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cpisos[0].camino;
					//alert(caminoParcial+"->camino "+cpisos[0].idnodo);
					//alert("caminoParcial "+caminoParcial);
				//	alert(cpisos[0].idnodo + "idnodo cpisos " + cpisos[0].camino+ "--"+cpisos[0].id);
					$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"sube",piso:pisoInicioActual},
							   function(data){
						   			//alert(data+" ->data de coorpisoreal");
						   			data=data.split(";");
						   			coorInicioActual=data[0];
						   			//pisoInicioActual=data[1];
						   });
					pisoInicioActual=pisoMetaFinal;


 				}
				else
				{	//alert("por aqui");
					//alert(cambiadores);
					//alert("pisoInicioActual "+pisoInicioActual);
					//alert(pisoMetaFinal);
					$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"sube"},
							   function(data){
						   		//	alert("del get "+data);
						   			cambiadores=data;
						   			
						   			//alert("cambiadores del get "+ cambiadores); 
						   			//alert("cambiadores largo "+ cambiadores.length);
					});
					//alert("inicio cambiadores "+cambiadores);
				///	alert(cambiadores[0]);
					cambiadores=cambiadores.split(";");
					//alert("cambiadores->"+cambiadores);
					//alert(cambiadores.length+" tamaño cambiadores");
					for (var l = 0; l < cambiadores.length; l++) 
					{
						//alert(cambiadores[l]);
						//alert(l);
						//alert(coorInicioActual+"-"+cambiadores[l]+"->piso->"+pisoInicioActual);
						camino = generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
						//alert("camino->"+camino);
						if(camino!="")
						{
							for (var i = 0; i < camino.length; i++)
							{
								for(var k=0;k<camino[i].length;k++)
								{
									if(i==0&&k==0)cami=camino[i][k];
									else
									{
										if(k%2==0)cami=cami+"-"+camino[i][k];
										else cami=cami+"_"+camino[i][k];
										//alert(cami);
									}
								}
								
							}
							camin=cami.split("-"); 
							cpisos[l]=new caminoObj(i,cami,cami.length,camin.slice(-1));
						}
						
					}
					cpisos.sort(function(a,b){return a.largo - b.largo;});
					//alert (cpisos[0].camino + " cpisos");
					caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cpisos[0].camino;
					//alert(caminoParcial+"->camino "+cpisos[0].idnodo);
					//alert("caminoParcial "+caminoParcial);
				//	alert(cpisos[0].idnodo + "idnodo cpisos " + cpisos[0].camino+ "--"+cpisos[0].id);
					$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"sube",piso:pisoInicioActual},
							   function(data){
						   			//alert(data+" ->data de coorpisoreal");
						   			data=data.split(";");
						   			coorInicioActual=data[0];
						   			pisoInicioActual=data[1];
						   });
					
					//alert(pisoInicioActual + " pisoActual" + coorMetaActual + " metaActual" + coorInicioActual + " coorInicioActual");
				}
			}
			else //baja
			{
				if (Math.abs(pisoInicioActual-pisoMetaFinal)>1) // Mas de 1 piso
 				{
 					cambiadoresTotal=new Array();
 					$.get("getCambiadoresPiso.php", { piso: pisoMetaFinal ,direccion:"sube"},
							   function(data){
						   		
						   			cambiadoresPFinal=data;
					});
					cambiadoresPFinal=cambiadoresPFinal.split(";");
					//alert(cambiadoresPFinal);
					$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"baja"},
							   function(data){
						   		
						   			cambiadoresPInicial=data;
					});
					cambiadoresPInicial=cambiadoresPInicial.split(";");
					//alert(cambiadoresPInicial);
					for (var f=0;f<cambiadoresPInicial.length;f++)
					{
						if(cambiadoresPFinal.indexOf(cambiadoresPInicial[f])>-1) cambiadoresTotal.push(cambiadoresPInicial[f]);
					}
					//alert(cambiadoresTotal);
					cambiadores=cambiadoresTotal;
					for (var l = 0; l < cambiadores.length; l++) 
					{
						//alert(cambiadores[l]);
						//alert(l);
						//alert(coorInicioActual+"-"+cambiadores[l]+"->piso->"+pisoInicioActual);
						camino = generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
						//alert("camino->"+camino);
						for (var i = 0; i < camino.length; i++)
						{
							for(var k=0;k<camino[i].length;k++)
							{
								if(i==0&&k==0)cami=camino[i][k];
								else
								{
									if(k%2==0)cami=cami+"-"+camino[i][k];
									else cami=cami+"_"+camino[i][k];
									//alert(cami);
								}
							}
							
						}
						camin=cami.split("-"); 
						cpisos[l]=new caminoObj(i,cami,cami.length,camin.slice(-1));
					}
					cpisos.sort(function(a,b){return a.largo - b.largo;});
					//alert (cpisos[0].camino + " cpisos");
					caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+cpisos[0].camino;
					//alert(caminoParcial+"->camino "+cpisos[0].idnodo);
					//alert("caminoParcial "+caminoParcial);
				//	alert(cpisos[0].idnodo + "idnodo cpisos " + cpisos[0].camino+ "--"+cpisos[0].id);
					$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"baja",piso:pisoInicioActual},
							   function(data){
						   			//alert(data+" ->data de coorpisoreal");
						   			data=data.split(";");
						   			coorInicioActual=data[0];
						   			//pisoInicioActual=data[1];
						   });
					pisoInicioActual=pisoMetaFinal;


	 			}
	 			else
	 			{
					$.get("getCambiadoresPiso.php", { piso: pisoInicioActual ,direccion:"baja"},
							   function(data){
						   		//	alert("en baja-> "+ data);
						   			cambiadores=data;
						   });
					cambiadores=cambiadores.split(";");
					for (var l = 0; l < cambiadores.length; l++) 
					{
						camino= generaCamino(coorInicioActual+"-"+cambiadores[l],pisoInicioActual);
					//	alert(camino);
						for (var i = 0; i < camino.length; i++)
						{
							for(var k=0;k<camino[i].length;k++)
							{
								if(i==0&&k==0)cami=camino[i][k];
								else
								{
									if(k%2==0)cami=cami+"-"+camino[i][k];
									else cami=cami+"_"+camino[i][k];
								}
							}
						}
						camin=cami.split("-"); 
					//	alert(cami);
						cpisos[l]=new caminoObj(i,cami,cami.length,camin.slice(-1));
					}
					cpisos.sort(function(a,b){return a.largo - b.largo;});
					caminoParcial=caminoParcial+"*"+pisoInicioActual+"*"+""+cpisos[0].camino;
				//	alert(caminoParcial+" caminoParcial en baja");
					$.get("getPisoPorCoorReal.php", { coor: ""+cpisos[0].idnodo ,direccion:"baja",piso:pisoInicioActual},
							   function(data){
						   		//	alert(data);
						   			data=data.split(";");
						   			coorInicioActual=data[0];
						   			pisoInicioActual=data[1];
						   });
				}
			}
			
			
		}
		
		
	}
	
}

function generaCamino(data,piso)
{
	//alert(data + "<-data piso-> "+piso );
	var data=data.split("-");
	//console.log(data);
	for (var i = 0; i < data.length; i++) 
	{
		o = data[i].split("_");				// fragmenta cada fragmento de camino
		o[0] = parseInt(o[0]);					// convierte a num y asigna al primer slot del fragmento
		o[1] = parseInt(o[1]);					// convierte a num y asigna al segundo slot del fragmento
		data[i] = o;							// reemplaza fragmento continuo por uno fragmentado
	};
	//alert(data + " <-data");

	var camino = [];
	// PASOS

	// LLEGA DESDE HTML
	// idTienda
	// pos incio 								// 39 > 360, 199					// 40, 29
	// pos destino								// 55 > 439, 157

	// grilla original de a 1					// grilla de a 10					// grilla de a 5 (doble)
	// x | 155 - 476							// 16 - 47 -> 31					// 63 (+1, contando los 5 extra)
	// y | 109 -> 0								// 11 - 34 -> 24					// 47 (+1, contando los 5 extra)


	// MAQUINA CALCULA Y DEVUELVE CAMINO
	// coords deben ser (from up to down) > invertir Y
	//alert(piso+"->piso en camino");
	if(piso=="1") {
		//alert("en piso 1");
		var matrix = gMatrix1();
		var grid = new PF.Grid(130, 109, matrix);		
	}

	if(piso=="2") {
		//alert("en piso 1");
		var matrix = gMatrix2();
		var grid = new PF.Grid(130, 109, matrix);		
	}

	if(piso=="3") {
		//alert("en piso 3");
		var matrix = gMatrix3();
		var grid = new PF.Grid(130, 109, matrix);		
	}

	if(piso=="4") {
		//alert("en piso 1");		
		var matrix = gMatrix4();
		var grid = new PF.Grid(130, 109, matrix);		
	}

	if(piso=="-1") {
		//alert("en piso 1");
		var matrix = gMatrixSub1();
		var grid = new PF.Grid(130, 109, matrix);
	}

	var finder = new PF.JumpPointFinder({allowDiagonal: true});
	//alert(finder);
	//console.log(finder);
	dataA = 
	{
		x 	: data[0][0],
		y	: data[0][1]
	}

	dataB = {
		x 	: data[1][0],
		y	: data[1][1]
	}
	//convHaMatrix(dataA);
	//convHaMatrix(dataB);
	//alert(dataA+" dataA "+dataB+" dataB");
	//alert(dataA.x+" "+ dataA.y+" "+dataB.x+" "+dataB.y);
	//console.log(dataB);
	//	alert(dataA.x +"dataAx "+ dataA.y +" dataAy "+  dataB.x +"dataBx "+ dataB.y +" dataBy ");
	//alert(grid);
	var caminoRaw = finder.findPath(dataA.x, dataA.y, dataB.x, dataB.y, grid);
	//alert(caminoRaw);
	for (var i = 0; i < caminoRaw.length; i++) {
		entrada = caminoRaw[i];
		camino.push(entrada);
	};
	return camino;
}

function generaMapa(camino)
{
	// PHP
	// idTienda
	var idTienda = '<?php echo $idTienda; ?>';
	var orientacionTotem = '<?php echo $totem->getorientacion(); ?>';
	var Inicio = 0;
	var Meta = 0;
	var tiendasInicial = 0;
	var tiendasFinal = 0;
	var localesPisoInical;
	var localesPisoMeta; 
	var tiendaAnclas = 0;
	var tiendasAnclaMeta = 0;
	var cambiadoresPisoInicio = 0;
	var cambiadoresPisoMeta = 0;
	var tiendasAsociadorubro; // esta variable recibe todo las tiendas asociadas a (aires, boulevar,terrazas,tiendas anclas, food court, autoplaza)
	var camino=camino.split("*");
	var areaDeNegocios; /* CARGA EL HUBS DE LAS AREAS DE NEGOCIOS PISO 1 */
	var areaDeNegociosMeta; /* CARGA EL HUBS DE LAS AREAS DE NEGOCIOS PISO 1 */
	var otrosVolumenes = [1000,1001,1002,2000,2001,3000,3001,4000,4001,5000,5001];
	var totalPisos =5;
	var subterraneos = 1;
	/*
		
	*/

	Inicio = camino[1];  // capturo el piso inicial
	if(camino[3]) {
		Meta = camino[3];   // capturo el piso meta o destino	
	}
	//---------TIENDAS DE PISOS-------------//
	var tiendasInicial;
	var tiendasFinal=null;
	
	/* CARGA TIENDAS Y LOSA A PISO INICIAL */

	jQuery.get("getTiendasPorPiso.php", { piso: camino[1]},
		function(data)
		{
			tiendasInicial=data;
		}
	);
	 
	localesPisoInical = tiendasInicial.split(";");
	var maxValorVolumen

	if(Inicio>0) {
		maxValorVolumen = (parseInt(Inicio)+1)*1000;

		for (var i = 0; i < otrosVolumenes.length; i++) { 
			// carga losa de el arreglo que dice otrosVolumenes
			if(parseInt(otrosVolumenes[i]) < maxValorVolumen&& Math.floor(parseInt(otrosVolumenes[i])/1000)==parseInt(Inicio)) {
				localesPisoInical.push(parseInt(otrosVolumenes[i]));		
			}	
		};

	} else {
		maxValorVolumen = (totalPisos+1)*1000;
		filtro=((totalPisos-subterraneos)+Math.abs(Inicio))*1000;
		//alert(filtro+" "+maxValorVolumen);

		for (var i = 0; i < otrosVolumenes.length; i++) { 
			// carga losa de el arreglo que dice otrosVolumenes
			if( Math.floor(filtro/1000)==Math.floor(parseInt(otrosVolumenes[i])/1000)) {
				localesPisoInical.push(parseInt(otrosVolumenes[i]));		
			}	
		};

	}

	// variable para cargar volumenes restaste de piso inical
	//console.log("inicial "+losaAsociadaApiso +" "+"tope maximo"+maxValorVolumen);
	

	//localesPisoInical.push(1000,1001,1002);

	/*#################### FIN #######################*/

	jQuery.get("getCambiosDePisoxPiso.php", { piso: Inicio},
		function(data) {
			cambiadoresPisoInicio=data;
			//alert("cambiadores: "+data);
		}
	); 
	cambiadoresPisoInicio = cambiadoresPisoInicio.split(";");	
	//alert("cambiadores: "+cambiadoresPisoInicio);
	jQuery.get("getTiendasAnclasPorPiso.php", { piso: camino[1] , codigo: "1"},
		function(data) {
			tiendaAnclas=data;
			//alert("data sin split :"+data);
		}
	);

	if(tiendaAnclas) {
		tiendaAnclas = tiendaAnclas.split(";"); 
	}
	
	//getRubrosxPiso
	/*
		RUBRO SEGUN LA IDENTIFICACIÓN ASOCIADA POR LA BD:
		9: TERRAZAS
	*/
	jQuery.get("getRubrosxPiso.php", { },
		function(data) {
			tiendasAsociadorubro=data;
			if(tiendasAsociadorubro && tiendasAsociadorubro!=0){tiendasAsociadorubro = tiendasAsociadorubro.split(";");}
			//alert("data sin split :"+data);
		}
	);

	//alert("a pintar total :"+tiendasAsociadorubro);
	//getAreaNegocioCentral.php

	jQuery.get("getAreaNegocioCentral.php", {piso: Inicio },	
		function(data) {
			areaDeNegocios=data;
			if(areaDeNegocios && areaDeNegocios!=0){areaDeNegocios = areaDeNegocios.split(";");}
		}
	);

	//alert("data con split :"+areaDeNegocios);
	if (camino[3]!=null||camino[3]=="") {
		/*CARGA TIENDAS Y OTROS VOLUMENES */

		jQuery.get("getTiendasPorPiso.php", { piso: camino[3]},
			function(data) {
				tiendasFinal=data;
			}
		);
		localesPisoMeta = tiendasFinal.split(";");
		
		var maxValorInicial;
		var maxValorVolumen; // variable para cargar volumenes restaste de piso inical
		//console.log("inicial "+maxValorInicial +" "+"tope maximo :"+maxValorVolumen);

		if(Meta>0) {
			maxValorInicial = (parseInt(Meta))*1000;
			maxValorVolumen = (parseInt(Meta)+1)*1000; 		
			for (var i = 0; i < otrosVolumenes.length; i++) { 
				// carga losa de el arreglo que dice otrosVolumenes
				var vol = parseInt(otrosVolumenes[i]);
				//console.log("valor de otrosVolumenes: "+vol);
				if(vol>=maxValorInicial && vol <maxValorVolumen ) {
					//console.log("piso meta otros volumenes :"+otrosVolumenes[i]);
					localesPisoMeta.push(parseInt(vol));		
				}
			};

		} else {
			maxValorInicial = totalPisos*1000;
			for (var i = 0; i < otrosVolumenes.length; i++) { 
				// carga losa de el arreglo que dice otrosVolumenes
				var vol = parseInt(otrosVolumenes[i]);
				//console.log("valor de otrosVolumenes: "+vol);
				if(vol>=maxValorInicial) {
					//console.log("piso meta otros volumenes :"+otrosVolumenes[i]);
					localesPisoMeta.push(parseInt(vol));		
				}
			};
		}
		

		/*#####################FIN####################*/

		jQuery.get("getAreaNegocioCentral.php", {piso: Meta },
			function(data) {
				areaDeNegociosMeta=data;
				if(areaDeNegociosMeta && areaDeNegociosMeta!=0){areaDeNegociosMeta = areaDeNegociosMeta.split(";");}
				//alert("data con split :"+areaDeNegociosMeta);
			}
		); 

		

		jQuery.get("getTiendasAnclasPorPiso.php", { piso: Meta , codigo: "1"},
				function(data) {
					tiendasAnclaMeta=data;
					//alert("data sin split :"+data);
				}
		);

		if(tiendasAnclaMeta) {
			tiendasAnclaMeta = tiendasAnclaMeta.split(";"); 
		}
		//alert("tienas clas piso meta :"+tiendasAnclaMeta)

		jQuery.get("getCambiosDePisoxPiso.php", { piso: Meta},
			function(data) {
				cambiadoresPisoMeta=data;
			}
		);

	cambiadoresPisoMeta = cambiadoresPisoMeta.split(";");	
	}
	
	
	//alert(localesPisoInical+"<->"+localesPisoMeta);

	//--------FIN TIENDAS DE PISOS ---------//

	/*for (var i = 0; i < camino.length; i++) {
		o = camino[i].split("_");
        o[0] = parseInt(o[0]);
        o[1] = parseInt(o[1]);
        camino[i] = o;
	};*/
	//console.log(camino);
	for (var j = 0; j < camino.length; j=j+2) {
		camino[j]=camino[j].split("-");

		for (var i = 0; i < camino[j].length; i++) {
			o = camino[j][i].split("_");				// fragmenta cada fragmento de camino
	        o[0] = 156 + parseInt(o[0])*1;					// convierte a num y asigna al primer slot del fragmento	//160
	        o[1] = 340 - parseInt(o[1])*1;					// convierte a num y asigna al segundo slot del fragmento	//339
	        camino[j][i] = o;							// reemplaza fragmento continuo por uno fragmentado
		};
	};
	if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

	var SCREEN_WIDTH = window.innerWidth;
	var SCREEN_HEIGHT = window.innerHeight;

	var container,stats;

	var camera, scene, loaded;
	var renderer;

	var mesh, zmesh, geometry;

	var windowHalfX = 450; //window.innerWidth / 2;
	var windowHalfY = 450; //window.innerHeight / 2;

	//var slotCam = { x: 0, y: 0, z:0 };
	var slotCam = new THREE.Vector3( 0, 0, 0 );														// slot Nº1 : posición cámara misma
	var slotTar = new THREE.Vector3( 0, 0, 0 );														// slot Nº2 : posición target

	var tween;

	var cam00	= [];
	var cam01	= [];																				// datos pos cam: inicial
	var cam02	= [];																				// datos pos cam: planta piso
	var dB1 	= [cam00, cam01, cam02];															// datos pos cam gral

	var tar00	= [];
	var tar01	= [];																				// datos pos target: inicial
	var tar02	= [];																				// datos pos target: planta piso
	var dB2 	= [tar00, tar01, tar02];															// datos pos target gral

	var rutap	= [];																				// array pelotas
	var colores = {
		cActivoColor 	: "#ffae23",
		cPasivoColor 	: "#ffae23",
		cPasivoAmb 		: "#ffae23",
		cPisoColor 		: "#ffae23",
		cLuzAmb 		: "#ffae23",
		cLuzDirec 		: "#ffae23"
	}

	var sRutaBase, sRutaOn;

	

	var activo, pasivo;
	var matPisoA, matPisoB;
	var pisoInicio = new THREE.Object3D();	
	var pisoMeta = new THREE.Object3D();
	var piso_T = new THREE.Object3D();


	var slotPiso1 = { y: 0, o: 1 };
	var slotPiso2 = { y: 0, o: 0 };
	var slotPiso1s = { y: 0, o: 0 };

	var slotPuntero = {x: 100, y: 100};
	//var xA = [];// [ 200, 475, 470 ];
	//var yA = [];// [ 100, 50, 120 ];
	var slotHud = {o: 0};
	var nVueltas = 0;

	//var tramoA, tramoV, tramoB;
	var tramos = [];
	var tramosVec = [];
	var huds = [];
	var pasos = 0;

	var totem = { piso: 1, pos: 0, rot: 0 };

	var mTiendaSel; //, coordMedio;

	var composer, effectFXAA;

	var clock = new THREE.Clock();


	var targetRotation = targetElevation = 0;
	var targetElevation = 40;
	var targetRotationOnMouseDown = targetElevationOnMouseDown = 0;

	var mouseX = mouseY = 0;
	var mouseXOnMouseDown = mouseYOnMouseDown = 0;

	var btns = 0;

	var mTotem;

	//var windowHalfX = window.innerWidth / 2;
	//var windowHalfY = window.innerHeight / 2;

	document.addEventListener( 'keydown', onKeyDown, false );
	
	document.addEventListener( 'mousedown', onDocumentMouseDown, false );
	document.addEventListener( 'touchstart', onDocumentTouchStart, false );
	document.addEventListener( 'touchmove', onDocumentTouchMove, false );

	prepare();
	animate();

	
	function init() {

		// SETEOS INICIALES
		//alert("aqui");
		scene = loaded.scene;
		//camera = loaded.currentCamera;
			
		//camera = new THREE.PerspectiveCamera( 65, window.innerWidth / window.innerHeight, 1, 4000 )
		camera = new THREE.PerspectiveCamera( 65, 900 / 900, 1, 4000 );
		scene.add(camera);

		//camera.aspect = window.innerWidth / window.innerHeight;
		camera.aspect = 900/ 900;
		camera.updateProjectionMatrix();

		var ambient = new THREE.AmbientLight( 0x666666 );
		scene.add( ambient );

		var directionalLight = new THREE.DirectionalLight( 0xcccccc );
		//directionalLight.position.set( 0, 0, 1 ).normalize();
		scene.add( directionalLight );

		var plight = new THREE.PointLight( 0xcccccc, 1, 1000 ); 
		plight.position.set( 314, -60, -272 );
		scene.add( plight );
		//tiendasAsociadorubro
		/*COMENZAMOS LA CARGA DE LAS VARAIABLES QUE SERAN TEXTURIZADAS*/
		var mBoulevard = [];
		var mTerrazas  = [];
		var mAutoplaza = [];
		var mAires 	   = [];
		var mAires2	   = [];
		var mComidas   = [];

		for (var i = 0; i < tiendasAsociadorubro.length; i++) 
		{
			
			if(i%2==0)
			{
				if( tiendasAsociadorubro[i]==2)
				{
					mAutoplaza.push(tiendasAsociadorubro[i+1]);	
				}
				else if(tiendasAsociadorubro[i] == 3)
				{
					mComidas.push(tiendasAsociadorubro[i+1]);
				}
				else if(tiendasAsociadorubro[i] == 4)
				{
					mTerrazas.push(tiendasAsociadorubro[i+1]);
				}
				else if(tiendasAsociadorubro[i] == 5)
				{
					mAires.push(tiendasAsociadorubro[i+1]);
				}
				else if(tiendasAsociadorubro[i] == 6)
				{
					mBoulevard.push(tiendasAsociadorubro[i+1]);
				}
			}

		};
		/*alert("terrazas :"+mTerrazas);
		alert("comida :"+mComidas);
		alert("Autoplaza :"+mAutoplaza);
		alert("Aire :"+mAires);
		alert("Boulevard"+mBoulevard);*/
		/*TERMINO DE CARGAS DE VARIABLES TEXTURIZADAS */

		// COMENZAMOS CON EL CAMBIO EN EL MALL

		if(Inicio!=0)
		{
			for (var l = 0; l < localesPisoInical.length; l++) 
			{

				for (var i = 0; i < scene.__objects.length; i++) {

					if ( scene.__objects[i].name == localesPisoInical[l].toString() ) {
						//console.log("objeto "+i+" tiene la iD = "+scene.__objects[i].name[i]);
							
						pisoInicio.add(scene.__objects[i]);

					}
					/*else
					{
						//scene.children[i].visible = false;
					}*/

				
				};

				for (var i = 0; i < scene.__objects.length; i++) 
				{
						if ( scene.__objects[i].name != localesPisoInical[l].toString() )
						 {
						//console.log("objeto "+i+" tiene la iD = "+scene.__objects[i].name[i]);
							
							scene.children[i].visible = false;
						}

				}
				for (var i = 0; i < pisoInicio.children.length; i++) {
					
					pisoInicio.children[i].visible = true;
				};

			};	
      
		}
		

		//########################## CARGA META A LA SCENE ########################
		if(Meta!=0)
		{
			for (var l = 0; l < localesPisoMeta.length; l++) 
			{

				for (var i = 0; i < scene.__objects.length; i++) 
				{

					if ( scene.__objects[i].name == localesPisoMeta[l].toString() ) {
						//console.log("objeto "+i+" tiene la iD = "+localesPiso1[l]);
						pisoMeta.add(scene.__objects[i]);
						
					}
	            };
			};

		}
		
		//################################################################# FIN DEL CAMBIO #######################

			//console.log("asdasd");
			//COMIENZA CAMBIO DE CARGA SCENE PASO 3

		scene.add(pisoInicio);
		scene.add(pisoMeta);
		//FIN DE CAMBIO CARGA ECENE
		
		//scene.add(piso_1);
		//scene.add(piso_2);
		//scene.add(piso_3);
		//scene.add(piso_1s);
		//scene.add(piso_2s);
		scene.add(piso_T);

		// CAMBIO MOVER AL NIVEL CORRESPODIENTE
		if(Meta!=0)
		{
			if(Inicio<Meta) pisoMeta.position.y = 40;
			else pisoMeta.position.y = -40;
		}
		else
		{
			pisoMeta.position.y = -40;
		}
		// FIN CAMBIO MOVER AL NIVEL CORRESPODIENTE
		
		// CAMBIO SLOT GONZALO

		if (camino[3]) 
		{
			//
			if(Meta!=0)
			{
				slotPiso2.y = pisoMeta.position.y;
			}
			else
			{
				slotPiso2.y = 0;
			}

		} 
		else{
			//
		};

		
		// MATERIALES
		var texturas;

		activo 		= new THREE.MeshLambertMaterial( { color: 0x2186ba, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		pasivo 		= new THREE.MeshLambertMaterial( { color: 0x989795, ambient: 0xffffff, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		pisoColor 	= new THREE.MeshLambertMaterial( { color: 0xe1dcd5, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );

		pisoColor1 	= new THREE.MeshLambertMaterial( { color: 0xCCC9C4, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );

		//tiendas
		sFalabella 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tFalabella.jpg' ), transparent: false, opacity: 1 } ); //, ambient: 0x000000 } );
		sParis 		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tParis.jpg' ), transparent: false, opacity: 1 } );
		sRipley 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tRipley.jpg' ), transparent: false, opacity: 1 } );
		sHomy		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tHomy.jpg' ), transparent: false, opacity: 1 } );
		sLider		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tLider.jpg' ), transparent: false, opacity: 1 } );
		sCinemark	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tCinemark.jpg' ), transparent: false, opacity: 1 } );
		sCinemundo	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tCinemundo.jpg' ), transparent: false, opacity: 1 } );
		sEstac	 	= new THREE.MeshLambertMaterial( { color: 0x97E8EB, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sBoulevard 	= new THREE.MeshLambertMaterial( { color: 0x67e1ad, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sTerrazas 	= new THREE.MeshLambertMaterial( { color: 0xffae23, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } ); //ffae23
		sAutoplaza 	= new THREE.MeshLambertMaterial( { color: 0x03579F, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sAires 		= new THREE.MeshLambertMaterial( { color: 0x919191, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sComidas 	= new THREE.MeshLambertMaterial( { color: 0xFFD307, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 1 } );
		sLaPolar 		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tPolar.jpg' ), transparent: false, opacity: 1 } );
		sJohnson	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tJohnson.jpg' ), transparent: false, opacity: 1 } );
		/*
			texturas con indix cambiados asociadeos a nombres de tiendas.
		*/
		texturas = { Falabella: sFalabella,Polar: sLaPolar, Paris: sParis, Ripley: sRipley, Lider: sLider, Homy: sHomy, Cinemark: sCinemark, Cinemundo: sCinemundo,Johnson: sJohnson };
		
		matPisoA = [activo, pasivo, pisoColor, sLaPolar, sFalabella, sParis, sRipley, sHomy, sLider, sCinemark, sEstac, sBoulevard, sTerrazas, sAutoplaza, sAires,sJohnson, sComidas];

		activo2		= new THREE.MeshLambertMaterial( { color: 0x2186ba, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		//pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );
		//pasivo = new THREE.MeshPhongMaterial( { color: 0xA3A3A3, shading: THREE.FlatShading , ambient: 0xffffff } ); //, opacity: 0.2, transparent: false } ); //, wireframe: true } );
		pasivo2		= new THREE.MeshLambertMaterial( { color: 0x989795, ambient: 0xffffff, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		pisoColor2 	= new THREE.MeshLambertMaterial( { color: 0xe1dcd5, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		//tiendas
		sFalabella2	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tFalabella.jpg' ), transparent: false, opacity: 0 } ); //, ambient: 0x000000 } );
		sParis2		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tParis.jpg' ), transparent: false, opacity: 0 } );
		sRipley2 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tRipley.jpg' ), transparent: false, opacity: 0 } );
		sCinemark2	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tCinemark.jpg' ), transparent: false, opacity: 0 } );
		sLaPolar2 	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tPolar.jpg' ), transparent: false, opacity: 0 } );
		sHomy2		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tHomy.jpg' ), transparent: false, opacity: 0 } );
		sJohnson2	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tJohnson.jpg' ), transparent: false, opacity: 0 } );
		sLider2		= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tLider.jpg' ), transparent: false, opacity: 0 } );
		sCinemundo2	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tCinemundo.jpg' ), transparent: false, opacity: 0 } );
		sAutoplaza2 = new THREE.MeshLambertMaterial( { color: 0x03579F, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sEstac2	 	= new THREE.MeshLambertMaterial( { color: 0x97E8EB, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sTerrazas2 	= new THREE.MeshLambertMaterial( { color: 0xffae23, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } ); //ffae23
		

		sE_Azul 	= new THREE.MeshLambertMaterial( { color: 0x888BBE, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Cyan 	= new THREE.MeshLambertMaterial( { color: 0x97E8EB, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Gris 	= new THREE.MeshLambertMaterial( { color: 0x919191, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Rojo 	= new THREE.MeshLambertMaterial( { color: 0xF25252, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sE_Verde 	= new THREE.MeshLambertMaterial( { color: 0x9BFC9D, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		sComidas2 	= new THREE.MeshLambertMaterial( { color: 0xFFD307, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sAires2		= new THREE.MeshLambertMaterial( { color: 0x919191, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );
		sBoulevard2	= new THREE.MeshLambertMaterial( { color: 0x67e1ad, ambient: 0x000000, shading: THREE.FlatShading, transparent: false, opacity: 0 } );

		texturasM = { Falabella: sFalabella2,Polar: sLaPolar2, Paris: sParis2, Ripley: sRipley2, Lider: sLider2, Homy: sHomy2, Cinemark: sCinemark2, Cinemundo: sCinemundo2,Johnson: sJohnson2 };
		matPisoB = [activo2, pasivo2, pisoColor2,sEstac2,sFalabella2,sLaPolar2,sJohnson2,sAutoplaza2, sParis2, sRipley2, sCinemark2, sCinemark , sEstac2, sE_Azul, sE_Cyan, sE_Gris, sE_Rojo, sE_Verde, sComidas2, sAires2, sBoulevard2,sTerrazas2];
		//console.log(tiendasAnclaMeta);
		// Totem
		var num;
		for (var i = 0; i < scene.__objects.length; i++) {
			//console.log(scene.__objects[i].name);
			if ( scene.__objects[i].name == "6666" ) {
				scene.__objects[i].visible = true;
				num = i;
			};
		};



		mTotem = scene.__objects[num];
		sTotem	= new THREE.MeshLambertMaterial( { shading: THREE.FlatShading, map: THREE.ImageUtils.loadTexture( 'src/images/mapa/tTotem.jpg' ) } ); //, transparent: true, opacity: 1 } );
		mTotem.material = sTotem;
		mTotem.position.x = camino[2][0][0];
		mTotem.position.y = 2;
		mTotem.position.z = -camino[2][0][1];
		//console.log(mTotem.position.x);
		//console.log(mTotem.position);
		//Orientacion totem
		switch(orientacionTotem)
		{
			case "N":
				mTotem.rotation.z = -Math.PI/2;
				break;
			case "S":
				mTotem.rotation.z = Math.PI/2;
				break;
			case "O":
				mTotem.rotation.z = Math.PI;
				break;

		}
		//Fin orientacion totem
		piso_T.add( mTotem );
		
		/*
			1 = que parta con 1000 significa que es el piso 1

			1000 = losa interna del mapa
			1001 = losa global del mapa
			1002 = losa estacionamiento
			1003 = losa area de servicios 

			2

			2000
			2001
			2002
		*/

		var losaPiso = Inicio*1000; //esta variable me indica en que piso estoy pintar la losa del piso asociado
		//CAMBIO DE PROCESO EN LOS MATERIALES
		// if(totem.piso == 1)
		// {
			if(Inicio!=0)
			{
					var o=pisoInicio.children.length;
					for (i=0; i<o; i++)
					{
						var bandera =0;
						
						

							for (var j = 0; j < tiendaAnclas.length; j++) 
					 		{
					 			

					 			if(pisoInicio.children[i].name === tiendaAnclas[j].toString())
					 			{
					 				 bandera =3;
					 				//console.log("ancla :"+tiendaAnclas[j]+" nombre Tienda :"+tiendaAnclas[j+1]);
					 				var nombre = tiendaAnclas[j+1];
					 				
					 				//console.log("nombre tienda :"+texturas[nombre]);
					 				if(nombre)
					 				{
					 					//console.log("material :"+nombre);
					 					if(nombre == "La Polar")
					 					{
					 						pisoInicio.children[i].material = texturas["Polar"];	
					 					}
					 					else if(nombre == "Homy")
					 					{
					 							pisoInicio.children[i].material = texturas["Homy"];
					 					}
					 					else if(nombre == "Johnson`s")
					 					{
					 						pisoInicio.children[i].material = texturas["Johnson"];	
					 					}
					 					else
					 					{
					 						pisoInicio.children[i].material = texturas[nombre];	
					 					}
					 				}
					 				
					 			}
					 			
					 		}
					 		/*mañana cambios aqui!!!!!!*/
					 		
						
						if(parseInt(pisoInicio.children[i].name)>=losaPiso)
					 	{
					 		//console.log(pisoInicio.children[i].name);

					 		for (var j = 0; j < otrosVolumenes.length; j++) 
					 		{
					 			// if(pisoInicio.children[i].name == otrosVolumenes[j] && losaPiso == pisoInicio.children[i].name)
					 			// {
					 			// 	pisoInicio.children[i].material = pisoColor1; //losa mall
					 			// 	bandera =3;
					 			// }
					 			//  if (pisoInicio.children[i].name == otrosVolumenes[j] && (losaPiso+1) == pisoInicio.children[i].name && Inicio == 1)
					 			// {
					 			// 	//console.log(pisoInicio.children[i].name);
					 			// 	pisoInicio.children[i].material = pisoColor; //losa calle
					 			// 	bandera =3;
					 			// }
					 			// if(pisoInicio.children[i].name == otrosVolumenes[j] && (losaPiso+2) == pisoInicio.children[i].name && Inicio == 1)
					 			// {
					 			// 	//console.log(pisoInicio.children[i].name);
					 			// 	pisoInicio.children[i].material = sEstac;
					 			// 	bandera =3;	
					 			// }
					 			if(Inicio>0)
					 			{
					 				//console.log(otrosVolumenes[j]+" "+parseInt(pisoInicio.children[i].name));
						 			if(pisoInicio.children[i].name == otrosVolumenes[j]&& Math.floor(parseInt(otrosVolumenes[j])/1000)==Inicio)
						 			{
						 				//console.log(parseInt(pisoInicio.children[i].name));
							 			if (parseInt(pisoInicio.children[i].name)%1000==0)
							 			{
							 				pisoInicio.children[i].material = pisoColor; //losa mall 1000 o 2000
							 				bandera =3;	
							 			}
							 			else if (parseInt(pisoInicio.children[i].name)%1000==3) 
							 			{
							 				//console.log(parseInt(pisoInicio.children[i].name));
							 				pisoInicio.children[i].material = pasivo; //losa calle 1001 o 2001
							 				bandera =3;
							 			}
							 			else if (parseInt(pisoInicio.children[i].name)%1000==2)
							 			{
							 				pisoInicio.children[i].material = sEstac; // estacionamientos 1002 o 2002
							 				matPisoA.push(pisoColor1);
							 				bandera =3;
							 			}
						 			}
					 			}
					 			else
					 			{
					 				
					 				if (parseInt(pisoInicio.children[i].name)==(totalPisos*1000))
							 			{

							 				pisoInicio.children[i].material = pisoColor; //losa mall 1000 o 2000
							 				bandera =3;	
							 			}
							 			else if (parseInt(pisoInicio.children[i].name)==((totalPisos*1000)+3)) 
							 			{
							 				pisoInicio.children[i].material = pasivo; //losa calle 1001 o 2001
							 				bandera =3;
							 			}
							 			else if (parseInt(pisoInicio.children[i].name)==((totalPisos*1000)+2))
							 			{

							 				pisoInicio.children[i].material = sEstac; // estacionamientos 1002 o 2002
							 				matPisoA.push(pisoColor1);
							 				bandera =3;
							 			}
					 			}



					 		}
					 	}					 	 
						

					    if(mTerrazas && mTerrazas.length>0)
						{
							for (var t = 0; t < mTerrazas.length; t++) 
							{
								if(pisoInicio.children[i].name == mTerrazas[t].toString())
								{
									pisoInicio.children[i].material = sTerrazas;
									bandera =3
								}
							}
						}	

						if(mAutoplaza && mAutoplaza.length>0)
						{
							
							for (var t = 0; t < mAutoplaza.length; t++) 
							{
								if(pisoInicio.children[i].name == mAutoplaza[t].toString())
								{

									pisoInicio.children[i].material = sAutoplaza;
									bandera =3
								}
							}
						}

						if(mComidas && mComidas.length>0)
						{
							//console.log("aqui comida");
							for (var t = 0; t < mComidas.length; t++) 
							{
								if(pisoInicio.children[i].name == mComidas[t].toString())
								{
									//console.log("aqui pitando volumen");
									pisoInicio.children[i].material = sComidas;
									bandera =3
								}
							}
						}

						if(mBoulevard && mBoulevard.length>0 )
						{
							
							for (var t = 0; t < mBoulevard.length; t++) 
							{
								if(pisoInicio.children[i].name == mBoulevard[t].toString())
								{
									pisoInicio.children[i].material = sBoulevard;
									bandera =3
								}
							}
						}

						if(mAires && mAires.length>0)
						{
							for (var t = 0; t < mAires.length; t++) 
							{
								if(pisoInicio.children[i].name == mAires[t].toString())
								{
									pisoInicio.children[i].material = sAires;
									bandera =3
								}
							}
						}
						if( pisoInicio.children[i].name === idTienda ) {
							pisoInicio.children[i].material = activo;
							mTiendaSel = pisoInicio.children[i];
							bandera =3;
						}

						if(bandera == 0)
						{
							pisoInicio.children[i].material = pasivo;
						}
						/*
							CARGA DE TEXTURAS PARA AREAS DE NEGOCIO
						*/
						//mTerrazas

						
						
					
					}
					
					

			}
			/*
				tiendasAnclaMeta
			*/

			if(Meta!=0)
			{
				//console.log(tiendasAnclaMeta);
				if(Meta>0)
				{
					losaPiso = Meta*1000;
				}
				else
				{
					losaPiso = totalPisos*1000;
				}
				var o=pisoMeta.children.length;
					for (i=0; i<o; i++)
					{
						var bandera = 0;	
						//if( scene.__objects[i].name === "160" ) {
						
							//console.log(tiendasAnclaMeta);

					 		for (var j = 0; j < tiendasAnclaMeta.length; j++) 
					 		{
					 			if(pisoMeta.children[i].name == tiendasAnclaMeta[j].toString())
					 			{
						 			
					 				bandera = 3;	
						 			var nombre = tiendasAnclaMeta[j+1];
						 			//console.log(tiendasAnclaMeta[j]+" "+tiendasAnclaMeta[j+1]);
						 			if(nombre)
						 			{
						 				if(nombre == "La Polar")
					 					{
					 						pisoMeta.children[i].material = texturasM["Polar"];	
					 					}
					 					else if(nombre == "Homy")
					 					{
					 							pisoMeta.children[i].material = texturasM["Homy"];
					 					}
					 					else if(nombre == "Johnson`s")
					 					{
					 						//console.log("johnson!!!!!!");
					 						pisoMeta.children[i].material = texturasM["Johnson"];	
					 					}
					 					else
					 					{
					 						pisoMeta.children[i].material = texturasM[nombre];	
					 					}
						 			}
						 		}
						 			
					 		}
					 			
					 	
						/*else if( pisoMeta.children[i].name === "2000" ){
					 		pisoMeta.children[i].material = pisoColor2;
					 		bandera =3;
					 	}*/
					 	/*if( pisoMeta.children[i].name === "2001" ){
					 		pisoMeta.children[i].material = pasivo2;
					 		bandera =3;

					 	}*/
					 	
					 	//console.log("Losa piso :"+losaPiso);
					 	if(parseInt(pisoMeta.children[i].name)>=losaPiso)
					 	{
					 		//console.log("afuera :"+pisoMeta.children[i].name);

					 		for (var j = 0; j < otrosVolumenes.length; j++) 
					 		{
					 			// if(pisoMeta.children[i].name == otrosVolumenes[j] && losaPiso == pisoMeta.children[i].name)
					 			// {
					 			// 	//console.log(pisoMeta.children[i].name);
					 			// 	pisoMeta.children[i].material = pisoColor2; //losa mall
					 			// 	bandera =3;
					 			// }
					 			//  if (pisoMeta.children[i].name == otrosVolumenes[j] && (losaPiso+1) == pisoMeta.children[i].name && Meta == 1 )
					 			// {
					 			// 	//console.log(pisoInicio.children[i].name);
					 			// 	pisoMeta.children[i].material = pisoColor; //losa calle
					 			// 	bandera =3;
					 			// }
					 			// if(pisoMeta.children[i].name == otrosVolumenes[j] && (losaPiso+2) == pisoMeta.children[i].name && (Meta == 1 || Meta<0 ) )
					 			// {
					 			// 	//console.log(pisoInicio.children[i].name);
					 			// 	pisoMeta.children[i].material = sEstac;
					 			// 	bandera =3;	
					 			// }
					 			if(pisoMeta.children[i].name == otrosVolumenes[j])
					 			{
					 				if (parseInt(pisoMeta.children[i].name)%1000==0)
					 				{
					 					pisoMeta.children[i].material = pisoColor2; //losa mall 1000 o 2000
					 					bandera =3;	
					 				}
					 				else if (parseInt(pisoMeta.children[i].name)%1000==3) 
					 				{
					 					pisoMeta.children[i].material = pasivo2; //losa calle 1003 o 2003
					 					bandera =3;
					 				}
					 				else if (parseInt(pisoMeta.children[i].name)%1000==2)
					 				{
					 					pisoMeta.children[i].material = sEstac2; // estacionamientos 1002 o 2002
					 					matPisoB.push(pisoColor1);

					 					bandera =3;
					 				}

					 				//console.log(pisoMeta.children[i].name);
					 				//console.log("entro"+j+" "+otrosVolumenes[j]);
					 				
					 			}
					 		}
					 	}			

					 	/*Textura a los focos del mall*/
					 	 if(mTerrazas && mTerrazas.length>0)
						{
							for (var t = 0; t < mTerrazas.length; t++) 
							{
								if(pisoMeta.children[i].name == mTerrazas[t].toString())
								{
									pisoMeta.children[i].material = sTerrazas2;
									bandera =3
								}
							}
						}	

						if(mAutoplaza && mAutoplaza.length>0)
						{
							
							for (var t = 0; t < mAutoplaza.length; t++) 
							{
								if(pisoMeta.children[i].name == mAutoplaza[t].toString())
								{
									pisoMeta.children[i].material = sAutoplaza2;
									bandera =3
								}
							}
						}

						if(mComidas && mComidas.length>0)
						{
							//console.log("aqui comida");
							for (var t = 0; t < mComidas.length; t++) 
							{
								if(pisoMeta.children[i].name == mComidas[t].toString())
								{
									//console.log("aqui pitando volumen");
									pisoMeta.children[i].material = sComidas2;
									bandera =3
								}
							}
						}

						if(mBoulevard && mBoulevard.length>0 )
						{
							
							for (var t = 0; t < mBoulevard.length; t++) 
							{
								if(pisoMeta.children[i].name == mBoulevard[t].toString())
								{
									pisoMeta.children[i].material = sBoulevard2;
									bandera =3
								}
							}
						}

						if(mAires && mAires.length>0)
						{
							for (var t = 0; t < mAires.length; t++) 
							{
								if(pisoMeta.children[i].name == mAires[t].toString())
								{
									pisoMeta.children[i].material = sAires2;
									bandera =3
								}
							}
						}

						if( pisoMeta.children[i].name === idTienda ) 
						{
							pisoMeta.children[i].material = activo2;
							mTiendaSel = pisoMeta.children[i];
							bandera =3;
						}


					 	/*fin texturas*/
					 	if (bandera == 0)
						 {

						 	pisoMeta.children[i].material = pasivo2;	
						 }

						pisoMeta.children[i].visible = false;


					}


			}



		//}else {console.log("Repara la posición de totem, por el momento esta manual")}
		//FIN DE CAMBIO DE PROCESO EN LOS MATERIALES
		// RECORRIDO
		//var planeMaterial =  new THREE.MeshLambertMaterial( { color: 0xF5A331 } ); //, ambient: 0xDEDEDE} );
        //var planeMaterial =  new THREE.MeshBasicMaterial( { color: 0xF5A331 } );
        var planeMaterial =  new THREE.MeshBasicMaterial( { color: 0x2186ba, transparent: false, opacity: 1 } );
        //console.log(camino);		        
        //if (camino[camino.length-1] == "") {pisos = pisos-1};
        if (camino[camino.length-1] == "") {camino.pop();};
        pisos = camino.length-1
        //pisos = pisos / 2;
        //console.log(camino);
        for (var j = 1; j <= pisos; j=j+2) {

        	//console.log(camino[j+1]);
        	// ARMAR arregloVec
        	// pisoAc = camino[j]-1;				// index de piso actual
	        // if (Meta>1 && Meta<3)//(camino[3]==2 ) 
	        // {
	        // 	pisoK = pisoAc*40;
	        // }
	        // else if (Meta ==3 )//(camino[3] == 3)
	        // {
	        // 	pisoK = pisoAc*20;
	        // }
	        // else if(Meta==4)
	        // {
	        // 	pisoK = pisoAc*13.2;
	        // } 
	        // else if (Meta<0)//(camino[3]==-1)
	        // {
	        // 	pisoK = pisoAc*20;
	        // } 
	        // else
	        // {
	        // 	pisoK = pisoAc*40;
	        // }
	        pisoAc=1;
        	pisoK=0.5;
        	//console.log(pisoAc+"<-pisoAc");
        	if(j>1&&Meta!=0&&Inicio>Meta) //camino baja
        	{
        		pisoAc=pisoAc*-1;
        		//console.log(Meta+" baja");
        		switch (Meta)
        		{
        		case 1||2: 
        			pisoK = pisoAc*40;
        			//console.log("aqui!!!!!"+pisoAc+pisoK);

        			break;
        		case -1 || 3:
        			pisoK = pisoAc*20;

        			break;
        		case 4:
        			pisoK = pisoAc*13.2;

        			break;
        		default :
        		pisoK = pisoAc*40;
        		
        			break;

        		}
        		

        	} 
        	if(j>1&&Meta!=0&&Inicio<Meta) //camino sube
        	{
        		pisoAc=pisoAc*1;

        		switch (Meta)
        		{
        		case 2||1: 
        			pisoK = pisoAc*40;

        			break;
        		case -1 || 3:
        			pisoK = pisoAc*20;
        			break;
        		case 4:
        			pisoK = pisoAc*13.2;
        			break;
        		default :pisoK = pisoAc*40;

        			break;

        		}
        	}
        	//console.log(pisoK+" pisoK");

	        var arregloVec = [];				// arreglo con coordenadas de la matriz

	        for (var i = 0; i < camino[j+1].length; i++) {
	        	// convierte a Vector
	        	vecTemp = new THREE.Vector3( camino[j+1][i][0], pisoK, -camino[j+1][i][1] );

	        	// add vector a arreglo gral
	        	arregloVec.push(vecTemp);
	        };

	        
	        // CREA TUBO
	        var curva = new THREE.SplineCurve3( arregloVec );
	        var gTramoA = new THREE.TubeGeometry(curva, 40, 0.4, 5, false, true);	//( path, segments, radius, segmentsRadius, closed, debug )
	        tramo = new THREE.Mesh( gTramoA, planeMaterial );

	        //console.log("cantidad de pisos: "+pisos);

	        /*if (camino[5]) {
	        	//
	        };*/

	        tramo.position.y = 2;

	        tramos.push(tramo);
      		piso_T.add( tramo );
      		tramo.visible = false;


      		// CAMBIO PISO
	        if (camino[j+2]) {
	        	tramoV = new THREE.Mesh( new THREE.CylinderGeometry( 0.4, 0.4, 40, 32, 32 ), planeMaterial);	//( radiusTop, radiusBottom, height, segmentsRadius, segmentsHeight, openEnded )
          		tramoV.position = arregloVec[arregloVec.length-1];
          		
          		if (Inicio < Meta)
          		{
          			tramoV.position.y = 22; // 20
          		}else
          		{
          			tramoV.position.y = -18; // -20
          		};
          		
          		tramos.push(tramoV);
          		piso_T.add( tramoV );
          		tramoV.visible = false;
	        };
	        // PUNTERO
      		var xA = [];
      		var yA = [];

      		var temp = [];

      		// xA / yA
      		for (var i = 0; i < camino[j+1].length; i++) {
      			xA.push(camino[j+1][i][0]);
      			yA.push(-camino[j+1][i][1]);
      		};

      		temp.push(xA);
      		temp.push(yA);

      		tramosVec.push(temp);

      		//console.log("piso "+j);
        };

       // console.log(piso_T);

  		// PUNTERO
  		puntero = new THREE.Mesh(new THREE.SphereGeometry(1.4), new THREE.MeshBasicMaterial({ color: 0x0E374D }) ); 
  		scene.add( puntero );
  		//puntero.position = arregloVec[0];
  		puntero.position.x = camino[2][0][0];
  		puntero.position.z = -camino[2][0][1];
  		puntero.position.y = 2;
  		puntero.visible = false;

  		slotPuntero.x = camino[2][0][0];
  		slotPuntero.y = -camino[2][0][1];
  		
        // CAMARAS

        

        coordDestino = camino[2][camino[2].length-1];
        coordInicio = camino[2][0];        coordMedio = new THREE.Vector3( (coordInicio[0]+coordDestino[0])/2, -15, -(coordInicio[1]+coordDestino[1])/2 );
        //console.log(coordInicio+"  "+coordDestino);

        if (camino[3]) {
			coordDestinoB = camino[4][camino[4].length-1];
	        coordInicioB = camino[4][0];
	        coordMedioB = new THREE.Vector3( (coordInicioB[0]+coordDestinoB[0])/2, -15, -(coordInicioB[1]+coordDestinoB[1])/2 );
		};
        // camaras
        //cam01	= [slotCam.x, slotCam.y, slotCam.z];
		//cam02	= [coordMedio.x , 380, coordMedio.z];
		desv1 = Math.abs( (coordMedio.x-coordInicio[0])*1.5 );

		if (camino[3]) 
		{
			desv2 = Math.abs( (coordMedioB.x-coordInicioB[0])*1.5 );
			//console.log(desv1);
			//console.log(desv2);
			desvMayor = Math.max(desv1,desv2);
		};
		//Rotacion camaras segun orientacion del totem
		switch(orientacionTotem)
		{
			case "N":
				dB1[1]	= [coordMedio.x , 155, coordMedio.z + Math.abs( (coordMedio.x-coordInicio[0])*1.5 )];
				dB1[3]	= [coordInicio[0] , 4, -coordInicio[1] + 10];
				dB2[3]	= [coordInicio[0] , 2, -coordInicio[1] - 10];
				break;
			case "S":
				dB1[1]	= [coordMedio.x , 155, coordMedio.z - Math.abs( (coordMedio.x-coordInicio[0])*1.5 )];
				dB1[3]	= [coordInicio[0] , 4, -coordInicio[1] - 10];
				dB2[3]	= [coordInicio[0] , 2, -coordInicio[1] + 10];
				break;
			case "O":
				dB1[1]	= [coordMedio.x - Math.abs( (coordMedio.x-coordInicio[0])*1.5 ), 155, coordMedio.z];
				dB1[3]	= [coordInicio[0] - 10 , 4, -coordInicio[1]];
				dB2[3]	= [coordInicio[0] + 10 , 2, -coordInicio[1]];
				break;
			case "E":
				dB1[1]	= [coordMedio.x + Math.abs( (coordMedio.x-coordInicio[0])*1.5 ), 155, coordMedio.z];
				dB1[3]	= [coordInicio[0] + 10 , 4, -coordInicio[1]];
				dB2[3]	= [coordInicio[0] - 10 , 2, -coordInicio[1]];
				break;
			default:
				dB1[1]	= [coordMedio.x + Math.abs( (coordMedio.x-coordInicio[0])*1.5 ), 155, coordMedio.z];
				dB1[3]	= [coordInicio[0] + 10 , 4, -coordInicio[1]];
				dB2[3]	= [coordInicio[0] - 10 , 2, -coordInicio[1]];
		}
		//Fin rotacion de las camaras segun orientacion del totem
		//dB1[1]	= [coordMedio.x + Math.abs( (coordMedio.x-coordInicio[0])*1.5 ), 155, coordMedio.z];					// pos cam: plano medio > x = medio + ( 1.5*(pto medio - inicio) )
		dB1[2]	= [coordMedio.x , 450, coordMedio.z];																	// pos cam: plano gral
		//dB1[3]	= [coordInicio[0] + 10 , 4, -coordInicio[1]];
		
		if (camino[3])
		 {
			dB1[4]	= [coordMedioB.x + desvMayor, 155, coordMedioB.z];
		};
		
		if (camino[3] && Meta>Inicio )//(parseInt(camino[3]) == 2 || parseInt(camino[3]) == 3) )  
		{
			dB1[5]	= [224 , 49, -44];
		} 
		else if (camino[3] && Meta<Inicio) //parseInt(camino[3]) == -1) 
		{
			dB1[5]	= [224 , 15, -44];
		};

		if (camino[3]) {
			dB1[6]	= [dB1[5][0]+184 , dB1[5][1]+83, -44];
		} else {
			dB1[6]	= dB1[1];
		};
		//dB1[5]	= [224 , 49, -44];																						// [192 , 127, 70];
		//dB1[6]	= [dB1[5][0]+184 , dB1[5][1]+83, -44];

		dB2[1]	= [coordMedio.x, coordMedio.y, coordMedio.z];															// pos tar: pto medio ruta
		dB2[2]	= [309 , 1, -201];																						// pos tar: pto medio escena
		//dB2[3]	= [coordInicio[0] - 10 , 2, -coordInicio[1]];
		
		if (camino[3]) 
		{
			dB2[4]	= [coordMedioB.x, coordMedioB.y, coordMedioB.z];
		};
		
		dB2[5]	= [309 , 1, -201];

		// asignando camara inicial
		n = 3;

		// poblado de slots					 																			// inicia slot camera con pos 01 > actual (para tween)
        slotCam.x = dB1[n][0];
        slotCam.y = dB1[n][1];
        slotCam.z = dB1[n][2];

        slotTar.x = dB2[n][0];
        slotTar.y = dB2[n][1];
        slotTar.z = dB2[n][2];

        // pos cam 01 																									// asigna pos cam inicial 
        camera.position.x = slotCam.x;										
        camera.position.y = slotCam.y;
        camera.position.z = slotCam.z;
        camera.lookAt( slotTar );

        /*gCilFlecha1 = new THREE.CylinderGeometry( 1, 1, 12, 32, 32 );
		mCilFlechaA = new THREE.Mesh( gCilFlecha1, new THREE.MeshBasicMaterial({ color: 0xff0000 }) );
		mCilFlechaA.position = coordMedio;
		scene.add( mCilFlechaA );*/



        // LINEAS + HUD
        

        //var iHudEsc01 = THREE.ImageUtils.loadTexture( 'src/images/mapa/esc01.png' );   
        
		/*var mLineaInicio = new THREE.Geometry()
		mLineaInicio.vertices.push( new THREE.Vector3( 360, 2, -199 ) );
		mLineaInicio.vertices.push( new THREE.Vector3( 360, 50, -199 ) );

        var lineaInicio = new THREE.Line( mLineaInicio, sLineas );
		scene.add( lineaInicio );	*/

		// LOGOS INICIO Y FINAL

		//var sLineas = new THREE.LineBasicMaterial( { color: 0xff0000, opacity: 1, linewidth: 2 } );
        var iHudInicio = THREE.ImageUtils.loadTexture( 'src/images/mapa/hudInicio.png' );
        var iHudDestino = THREE.ImageUtils.loadTexture( "src/img/logos/tiendas/<?php echo $foto;?>" );

        var spHudInicio = new THREE.Sprite( { map: iHudInicio, useScreenCoordinates: false, color: 0xffffff } );
		spHudInicio.scale.x = 0.06; // era 0.12
		spHudInicio.scale.y = 0.06;
		spHudInicio.position.set( camino[2][0][0]-4, 6, -camino[2][0][1]-2 ); //( camino[2][0], 10, -camino[2][2] )
		scene.add( spHudInicio );
		huds.push(spHudInicio);

		//console.log(camino[2][0][0]+", "+-camino[2][0][1])

		var spHudDestino = new THREE.Sprite( { map: iHudDestino, useScreenCoordinates: false, color: 0xffffff } );
		spHudDestino.scale.x = 0.042; // era 0.084
		spHudDestino.scale.y = 0.035;  // 0.07
		//spHudDestino.position.set( mTiendaSel.position.x, 10, mTiendaSel.position.z );

		if (Meta!=0) {
			spHudDestino.position.set( camino[4][camino[4].length-1][0], 10, -camino[4][camino[4].length-1][1] );
		} else {
			spHudDestino.position.set( mTiendaSel.position.x, 10, mTiendaSel.position.z );
		};
				
		scene.add( spHudDestino );
		spHudDestino.visible = false;
		huds.push(spHudDestino);

		/*mTotem.position.x = camino[2][0][0];
		mTotem.position.y = 0;
		mTotem.position.z = -camino[2][0][1];*/
		//camino[4][camino[4].length-1];

		/*var mLineaDestino = new THREE.Geometry()
		mLineaDestino.vertices.push( mTiendaSel.position );
		mLineaDestino.vertices.push( new THREE.Vector3( mTiendaSel.position.x, 50, mTiendaSel.position.z ) );

        var lineaDestino = new THREE.Line( mLineaDestino, sLineas );
		scene.add( lineaDestino );*/

		// LOGOS CAMINOS Y ESCALERAS

		var iHudInsCa = THREE.ImageUtils.loadTexture( 'src/images/mapa/inCa.png' );
        var iHudInsCb = THREE.ImageUtils.loadTexture( 'src/images/mapa/inCb.png' );
        var iHudInsS = THREE.ImageUtils.loadTexture( 'src/images/mapa/inS.png' );
        var iHudInsBa = THREE.ImageUtils.loadTexture( 'src/images/mapa/inBa.png' );
        var iHudinS3 = THREE.ImageUtils.loadTexture( 'src/images/mapa/inS3.png' );
        var iHudinS4 = THREE.ImageUtils.loadTexture( 'src/images/mapa/inS4.png' );

		var spHudInsCa = new THREE.Sprite( { map: iHudInsCa, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsCa.scale.x = 0.57;
		spHudInsCa.scale.y = 0.1;
		//spHudInsCa.opacity = 0.5;
		spHudInsCa.position.set( 450, 800, 0 );
		scene.add( spHudInsCa );
		spHudInsCa.visible = false;
		huds.push(spHudInsCa);

		var spHudInsCb = new THREE.Sprite( { map: iHudInsCb, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsCb.scale.x = 0.57;
		spHudInsCb.scale.y = 0.1;
		spHudInsCb.position.set( 450, 800, 0 );
		scene.add( spHudInsCb );
		spHudInsCb.visible = false;
		huds.push(spHudInsCb);

		var spHudInsS = new THREE.Sprite( { map: iHudInsS, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsS.scale.x = 0.57;
		spHudInsS.scale.y = 0.1;
		spHudInsS.position.set( 450, 800, 0 );
		scene.add( spHudInsS );
		spHudInsS.visible = false;
		huds.push(spHudInsS);

		var spHudInsBa = new THREE.Sprite( { map: iHudInsBa, useScreenCoordinates: true, color: 0xffffff } );
		spHudInsBa.scale.x = 0.57;
		spHudInsBa.scale.y = 0.1;
		spHudInsBa.position.set( 450, 800, 0 );
		scene.add( spHudInsBa );
		spHudInsBa.visible = false;
		huds.push(spHudInsBa);

		/*
		var spHudinS3 = new THREE.Sprite( { map: iHudinS3, useScreenCoordinates: true, color: 0xffffff } );
		spHudinS3.scale.x = 0.57;
		spHudinS3.scale.y = 0.1;
		spHudinS3.position.set( 450, 800, 0 );
		scene.add( spHudinS3 );
		spHudinS3.visible = false;
		huds.push(spHudinS3);

		var spHudinS4 = new THREE.Sprite( { map: iHudinS4, useScreenCoordinates: true, color: 0xffffff } );
		spHudinS4.scale.x = 0.57;
		spHudinS4.scale.y = 0.1;
		spHudinS4.position.set( 450, 800, 0 );
		scene.add( spHudinS4 );
		spHudinS4.visible = false;
		huds.push(spHudinS4);
        */
		// BOTONES
		var iHudBt1 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_01.png' );
		var iHudBt2 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_02.png' );
		var iHudBt3 = THREE.ImageUtils.loadTexture( 'src/images/mapa/btn_03.png' );

		var spHudBt1 = new THREE.Sprite( { map: iHudBt1, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt1.position.set( 300, 20, 0 );
		spHudBt1.scale.x = 0.6;
		spHudBt1.scale.y = 0.684;
		spHudBt1.visible = false;
		scene.add( spHudBt1 );
		huds.push(spHudBt1);

		var spHudBt2 = new THREE.Sprite( { map: iHudBt2, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt2.position.set( 400, 20, 0 );
		spHudBt2.scale.x = 0.6;
		spHudBt2.scale.y = 0.684;
		spHudBt2.visible = false;
		scene.add( spHudBt2 );
		huds.push(spHudBt2);

		var spHudBt3 = new THREE.Sprite( { map: iHudBt3, useScreenCoordinates: true, alignment: THREE.SpriteAlignment.topLeft } );
		spHudBt3.position.set( 500, 20, 0 );
		spHudBt3.scale.x = 0.6;
		spHudBt3.scale.y = 0.684;
		spHudBt3.visible = false;
		scene.add( spHudBt3 );
		huds.push(spHudBt3);
		//console.log(huds.length);


		// ICONOS ESCALERAS Y ASCENSORES
		var iHudEsc01 = THREE.ImageUtils.loadTexture( 'src/images/mapa/_esc01.png' );
		var iHudAs = THREE.ImageUtils.loadTexture( 'src/images/mapa/elevador.png' );

		

		// piso 1
		
		// cambiadoresPisoInicio
		
		//escalas01 = [esc101, esc102, esc103, esc105, esc106, esc107, esc108, esc109, esc110];
		//escalas02 = [esc201, esc202, esc203, esc205, esc206, esc207, esc208, esc209, esc210];
		//escalas01s = [esc001, esc002, esc003, esc004, esc005, esc006, esc007, esc008];
		
		//var spHudEsc01 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
		// Carga escaleras piso Inicio
		var coordCambiadoresPiso; // aqui se separan las coordenadas ya que en cambiadoresPisoInicio estan de la siguiente forma 140_52
		var imagen;
		
		//console.log(cambiadoresPisoInicio);
		for (var i = 0; i < cambiadoresPisoInicio.length; i++) 
		{
			if(cambiadoresPisoInicio[i+1] == 1)
			{
				coordCambiadoresPiso = cambiadoresPisoInicio[i].split("_");
				imagen = iHudAs;
				

			}
			else
			{
				coordCambiadoresPiso = cambiadoresPisoInicio[i].split("_");
				imagen = iHudEsc01;
				
			}

			if (i%2==0) 
			{
				//console.log(coordCambiadoresPiso);
				var spHudEsc01 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
				spHudEsc01.map= imagen;
				spHudEsc01.scale.x = 0.03; // 0.05
				spHudEsc01.scale.y = 0.03;
				spHudEsc01.position.set( 156 + parseInt(coordCambiadoresPiso[0])*1, 5, -(340 - parseInt(coordCambiadoresPiso[1])*1) );
				//spHudEsc01.position.set(parseInt(coordCambiadoresPiso[0])*1, 5, -(parseInt(coordCambiadoresPiso[1])*1) );
				scene.add( spHudEsc01 );
				pisoInicio.add( spHudEsc01 );
				//spHudEsc01.visible = false;
				matPisoA.push(spHudEsc01);	
			
			}
			
			//console.log("lup cambiadores :"+i);
		}

		if(Meta!=0)
		{
			for (var i = 0; i < cambiadoresPisoMeta.length; i++) 
			{
				if(cambiadoresPisoMeta[i+1] == 1)
				{
					coordCambiadoresPiso = cambiadoresPisoMeta[i].split("_");
					imagen = iHudAs;
				}
				else
				{
					coordCambiadoresPiso = cambiadoresPisoMeta[i].split("_");
					imagen = iHudEsc01;
				}
				if (i%2==0) 
				{
					//console.log(coordCambiadoresPiso);
					var spHudEsc02 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
					spHudEsc02.map= imagen;
					spHudEsc02.scale.x = 0.03; // 0.05
					spHudEsc02.scale.y = 0.03;
					spHudEsc02.position.set( 156 + parseInt(coordCambiadoresPiso[0])*1, 5, -(340 - parseInt(coordCambiadoresPiso[1])*1) );
					//spHudEsc01.position.set(parseInt(coordCambiadoresPiso[0])*1, 5, -(parseInt(coordCambiadoresPiso[1])*1) );
					scene.add( spHudEsc02 );
					pisoMeta.add( spHudEsc02 );
					spHudEsc02.visible = false;
					matPisoB.push(spHudEsc02);	
				}
								
			}
		}
		/*
			INICIO CAMBIO GONZALO CARGA LOGOS DE UNIDADES DE SERVICIO
		*/
		//areaDeNegocios
		var iHudUni1 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_bulevard.png' );
		var iHudUni2 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_terrazas.png' );
		var iHudUni3 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_comidas.png' );
		var iHudUni4 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_autoplaza.png' );
		var iHudUni5 = THREE.ImageUtils.loadTexture( 'src/images/mapa/logo_aires.png');

		var almacenLogosAreaNegocio = { Autoplaza: iHudUni4, Boulevard: iHudUni1, Food: iHudUni3, Terrazas: iHudUni2 , Aires: iHudUni5};
		//console.log(areaDeNegocios);


		for (var i = 0; i < areaDeNegocios.length; i++)
		 {
			//areaDeNegocios[i]
			 var imagen;
			 var coord;
			if(i%2==0)
			{
				if(areaDeNegocios[i] == "Autoplaza")
				{
					imagen = almacenLogosAreaNegocio[areaDeNegocios[i].toString()];
					coord = areaDeNegocios[i+1].split("_");
				}
				else if(areaDeNegocios[i] == "Boulevard")
				{
					imagen = almacenLogosAreaNegocio[areaDeNegocios[i].toString()];
					coord = areaDeNegocios[i+1].split("_");
				}
				else if(areaDeNegocios[i] == "Terrazas")
				{
					imagen = almacenLogosAreaNegocio[areaDeNegocios[i].toString()];
					coord = areaDeNegocios[i+1].split("_");
				}
				else if(areaDeNegocios[i] == "Aires")
				{
					imagen = almacenLogosAreaNegocio[areaDeNegocios[i].toString()];
					coord = areaDeNegocios[i+1].split("_");
				}
				else if(areaDeNegocios[i] == "Food")
				{
					imagen = almacenLogosAreaNegocio[areaDeNegocios[i].toString()];
					coord = areaDeNegocios[i+1].split("_");
				}


				var spHudUni1 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );

				spHudUni1.scale.x = 0.06; // era 0.12
				spHudUni1.scale.y = 0.06;
				console.log("aqui");
				spHudUni1.position.set( 156 + parseInt(coord[0])*1, 15, -(340 - parseInt(coord[1])*1) );

				scene.add( spHudUni1 );
				pisoInicio.add( spHudUni1 );
				matPisoA.push(spHudUni1);		
			}
		}


		if(Meta!=0)
		{
			for (var i = 0; i < areaDeNegociosMeta.length; i++)
			 {
				//areaDeNegocios[i]
				 var imagen;
				 var coord;
				if(i%2==0)
				{
					if(areaDeNegociosMeta[i] == "Autoplaza")
					{
						imagen = almacenLogosAreaNegocio[areaDeNegociosMeta[i].toString()];
						coord = areaDeNegociosMeta[i+1].split("_");
					}
					else if(areaDeNegociosMeta[i] == "Boulevard")
					{
						imagen = almacenLogosAreaNegocio[areaDeNegociosMeta[i].toString()];
						coord = areaDeNegociosMeta[i+1].split("_");
					}
					else if(areaDeNegociosMeta[i] == "Terrazas")
					{
						imagen = almacenLogosAreaNegocio[areaDeNegociosMeta[i].toString()];
						coord = areaDeNegociosMeta[i+1].split("_");
					}
					else if(areaDeNegociosMeta[i] == "Aires")
					{
						imagen = almacenLogosAreaNegocio[areaDeNegociosMeta[i].toString()];
						coord = areaDeNegociosMeta[i+1].split("_");
					}
					else if(areaDeNegociosMeta[i] == "Food")
					{
						imagen = almacenLogosAreaNegocio[areaDeNegociosMeta[i].toString()];
						coord = areaDeNegociosMeta[i+1].split("_");
					}

					var spHudUni1 = new THREE.Sprite( { map: imagen, useScreenCoordinates: false, color: 0xffffff } );
					spHudUni1.scale.x = 0.06; // era 0.12
					spHudUni1.scale.y = 0.06;
					spHudUni1.position.set( 156 + parseInt(coord[0])*1, 15, -(340 - parseInt(coord[1])*1) );
					scene.add( spHudUni1 );
					pisoMeta.add( spHudUni1 );
					spHudUni1.visible = false;
					matPisoB.push(spHudUni1);		
				}
			}
		}

		

		// COMPOSER
		renderer.autoClear = false;

		renderTargetParameters = { minFilter: THREE.LinearFilter, magFilter: THREE.LinearFilter, format: THREE.RGBFormat, stencilBuffer: false };
		//renderTarget = new THREE.WebGLRenderTarget( SCREEN_WIDTH, SCREEN_HEIGHT, renderTargetParameters );
		renderTarget = new THREE.WebGLRenderTarget( 900, 900, renderTargetParameters );
		

		//colorCorrection = new THREE.ShaderPass( THREE.ShaderExtras[ "colorCorrection" ] );
		//colorCorrection.uniforms[ 'powRGB' ].value = new THREE.Vector3( 2, 1.8, 1.8 ) ;  //powRGB, mulRGB
		//colorCorrection.uniforms[ 'powRGB' ].value = new THREE.Vector3( 1, 0.85, 0.85 ) ;
		//colorCorrection.uniforms[ 'mulRGB' ].value = new THREE.Vector3( 1, 1.1, 1.1 ) ; 

		composer = new THREE.EffectComposer( renderer, renderTarget );
		var renderModel = new THREE.RenderPass( scene, camera );

		//var effectFXAA = new THREE.ShaderPass( THREE.FXAAShader );
		//effectFXAA.uniforms['resolution'].value.set(1/SCREEN_WIDTH,1/SCREEN_HEIGHT);
		//effectFXAA.renderToScreen = true;

		effectFXAA = new THREE.ShaderPass( THREE.ShaderExtras[ "fxaa" ] );
		//effectFXAA.uniforms[ 'resolution' ].value.set( 1 / SCREEN_WIDTH, 1 / SCREEN_HEIGHT );
		effectFXAA.uniforms[ 'resolution' ].value.set( 1 / 900, 1 / 900 );
		effectFXAA.renderToScreen = true;

		//effectVignette.renderToScreen = true;
		//vblur.renderToScreen = true;
		//colorCorrection.renderToScreen = true;
		//colorify.renderToScreen = true;
		//screenfx.renderToScreen = true;

		composer = new THREE.EffectComposer( renderer, renderTarget );
		composer.addPass( renderModel );
		composer.addPass( effectFXAA );
		
		//composer.addPass( hblur );
		//composer.addPass( vblur );
		//composer.addPass( colorCorrection );
		//composer.addPass( effectVignette );

		//
		pasos = 1;
		if (pasos == 1) {																	// PASO 1
			animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 1500, 3000 );						// anim camara: 03 Tótem > cam01 (centro tramo A)
			animarTar(  dB2[1][0], dB2[1][1], dB2[1][2], 1500, 3000 );

		};

		//console.log(camino);
		//console.log(camino);

	}

	// ANIMAR CAMARA

	function animarCam( px, py, pz, d, t ) {

		tween = new TWEEN.Tween(slotCam)
			.to({x: px, y: py, z: pz}, t)
			.delay(d)
			//.easing(TWEEN.Easing.Cubic.InOut)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				camera.position.x = slotCam.x;
				camera.position.y = slotCam.y;
				camera.position.z = slotCam.z;
			})
			.onComplete(function(){
				if (pasos == 1) {															// PASO 2
					tramos[0].visible = true;												// tuboA visible
					puntero.visible = true;													// puntero visible
					animarPuntero(tramosVec[0][0], tramosVec[0][1], 5000);					// anima puntero tramoA
					
					
					
					/*if (Meta == 2) 
					{
						huds[3].visible = true;
						//huds[1].visible = true;
						pasos = 2;
					}
					else if(Meta== 3)
					{
						huds[10].visible = false; 
						pasos = 2;
					} 
					else if(Meta== 4)
					{
						huds[10].visible = false; 
						pasos = 2;	
					} 
					else if(Meta == 5)
					{
						
					}*/
					if(camino[3])
					{
						huds[3].visible = true;
						
						pasos = 2;
					} 
					else 
					{
						huds[2].visible = true;
						huds[1].visible = true;
						pasos = 6;
					};
				}else if (pasos == 3)
				{														// PASO 4
					tramos[1].visible = true;												// tramo Vertical visible
					huds[0].visible = false;												// hud Ca no visible
					
					// COMIENZA CAMBIO AQUI
					
					if(Meta!=0 && Meta>Inicio)
					{
						//console.log("la meta es sube "+Meta);
						huds[4].visible = true;
						
						animarInicio(-40, 0, 3000);
						aminarMeta(0, 1, 3000);
								//animarPisos(-40, 0, 3000, 0, 1, Inicio, Meta);
					}
					else if(Meta!=0 && Meta<Inicio)
					{
						//console.log("la meta es Baja "+Meta);
						huds[5].visible = true;
						animarPisos(40, 0, 3000, 0, 1, Inicio, Meta);
					}
					
					pasos = 4;
				}
				else if (pasos == 5)
				{														// PASO 6
					huds[2].visible = true;													// hud Cb visible
					huds[1].visible = true;													// hud logo tienda visible
					animarPuntero(tramosVec[1][0], tramosVec[1][1], 5000);					// anim puntero: tramoB
					pasos = 6;
				}
				else if (pasos == 7){														// PASO 8
					//huds[6].visible = huds[7].visible = huds[8].visible = true;				// hud Cb visible
					huds[6].color = new THREE.Color( 0xdddddd );
					huds[6].opacity = 1
					huds[7].color = huds[8].color = new THREE.Color( 0xffffff );
					huds[7].opacity = huds[8].opacity = 0.6;
					//huds[6].material.color.setHSV( 0.5 * Math.random(), 0.8, 0.9 );
					btns = 1;
					pasos = 8;
				};
			})
		tween.start();

	}

	// ANIMAR TARGET
	function animarTar( px, py, pz, d, t ) {
		tween = new TWEEN.Tween(slotTar)
			.to({x: px, y: py, z: pz}, t)
			.delay(d)
			.easing(TWEEN.Easing.Cubic.InOut)
			/*.onUpdate(function (){
				camera.position.x = slotCam.x;
				camera.position.y = slotCam.y;
				camera.position.z = slotCam.z;

				slotTar.x = dB2[n][0];
		        slotTar.y = dB2[n][1];
		        slotTar.z = dB2[n][2];
			})*/
			.onComplete(function(){
				//
			})
		tween.start();

	}


	// ANIMAR PISOS
	function animarPisos( ny, no, t, ny1, no1, Inicio, Meta)
	{
		animarInicio(ny, no, t);
		aminarMeta(ny1, no1, t);
	}

	function animarInicio(ny, no, t)
	{
		if (no == 1) 
			{
				for (var i = 0; i < pisoInicio.children.length; i++) {
					pisoInicio.children[i].visible = true;
				};
			};

			tween = new TWEEN.Tween(slotPiso1)
			.to({y: ny, o: no}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				pisoInicio.position.y = slotPiso1.y;
				for (var i = 0; i < matPisoA.length; i++) {
					matPisoA[i].opacity = slotPiso1.o;
				};
				sTotem.opacity=slotPiso1.o;
				piso_T.position.y = slotPiso1.y;											// animar piso_T
				//console.log(o);
			})
			.onComplete(function (){
				if (no == 0) {
					for (var i = 0; i < pisoInicio.children.length; i++) {
						pisoInicio.children[i].visible = false;
					};
				};
				mTotem.visible = false;

				if (pasos == 4) {															// PASO 5
					tramos[2].visible = true;												// tubo B visible
					tramos[0].visible = false;												// tubo A no visible
					tramos[1].visible = false;												// tubo V no visible
					huds[4].visible = false;												// apaga huds S y Ba
					huds[5].visible = false;
					animarCam(  dB1[4][0], dB1[4][1], dB1[4][2], 0, 4000  );				// anim camara: cam05 > cam04 (centro tramo B)
					animarTar(  dB2[4][0], dB2[4][1], dB2[4][2], 0, 4000  );
					pasos = 5;
				}else if (pasos == 3){
					//
				};
			})
		tween.start();
	}

	function aminarMeta(ny, no, t)
	{
		if (no == 1) 
		{
			for (var i = 0; i < pisoMeta.children.length; i++) 
			{
				pisoMeta.children[i].visible = true;
			};
		};
				//mTotem.visible = false;

				tween = new TWEEN.Tween(slotPiso2)
					.to({y: ny, o: no}, t)
					.easing(TWEEN.Easing.Cubic.InOut)
					.onUpdate(function (){
						pisoMeta.position.y = slotPiso2.y;
						for (var i = 0; i < matPisoB.length; i++) {
							matPisoB[i].opacity = slotPiso2.o;
						};
						//console.log(o);
					})
					.onComplete(function ()
					{
						if (no == 0) { //console.log("termino animacionMeta False");
							for (var i = 0; i < pisoMeta.children.length; i++) {
								pisoMeta.children[i].visible = false;
							};
						};
					})
				tween.start();
	}	


	// ANIMAR PUNTERO
	function animarPuntero( xA, yA, t ) {
		// nVueltas
		tween = new TWEEN.Tween(slotPuntero)
			.interpolation( TWEEN.Interpolation.CatmullRom )
			.to({x: xA, y: yA}, t)

			.easing(TWEEN.Easing.Sinusoidal.InOut) // Cubic.InOut
			.onUpdate(function (){
				puntero.position.x = slotPuntero.x;
				puntero.position.z = slotPuntero.y;
			})
			.onComplete(function (){
				nVueltas = nVueltas + 1;
				if (nVueltas < 1) {
					slotPuntero.x = 360; //arregloVec[0].x;
  					slotPuntero.y = -199; //arregloVec[0].z;
					puntero.position.x = slotPuntero.x;
					puntero.position.z = slotPuntero.y;
					animarPuntero( 5000 );
				}else if (pasos == 2){														// PASO 3
					huds[3].visible = false;
					
					animarCam(  dB1[5][0], dB1[5][1], dB1[5][2], 0, 5000 );					// anim camara: cam01 > cam05 (de lado)
					pasos = 3;
				}else if (pasos == 6){														// PASO 7
					//Hacemos visible el totem
					sTotem.opacity=1;
					mTotem.visible = true;
					//Fin visitbilidad totem
					huds[2].visible = false;												// hud no Cb visible
					//console.log("ok");
					if (camino[3]) {
						tramos[1].visible = tramos[2].visible = true;						// tubo B visible
					};
					//tramos[2].visible = true;												// tubo B visible
					//tramos[0].visible = true;												// tubo A visible
					tramos[0].visible = true;												// tubo V visible
					animarCam(  dB1[6][0], dB1[6][1], dB1[6][2], 0, 3000 );
					for (var i = 0; i < matPisoA.length; i++) {
						matPisoA[i].opacity = 1;
					};
					for (var i = 0; i < pisoInicio.children.length; i++) {
						pisoInicio.children[i].visible = true; // Hace visible el pisoInicio cuando termina la animacion
					};

					huds[6].visible = huds[7].visible = huds[8].visible = true;				// prender btns
					pasos = 7;
					//console.log(dB2[4]);
				};
			})
		tween.start();
	}

	// ANIMAR TARGET
	function animarHudA( o, t ) {
		tween = new TWEEN.Tween(slotHud)
			.to({o: o}, t)
			.easing(TWEEN.Easing.Cubic.InOut)
			.onUpdate(function (){
				huds[0].opacity = slotHud.o;
			})
			.onComplete(function(){
				//
			})
		tween.start();
	}

	//
	function onDocumentMouseDown( event ) {
		event.preventDefault();

		document.addEventListener( 'mousemove', onDocumentMouseMove, false );
		document.addEventListener( 'mouseup', onDocumentMouseUp, false );
		document.addEventListener( 'mouseout', onDocumentMouseOut, false );

		mouseXOnMouseDown = event.clientX - windowHalfX;
		mouseYOnMouseDown = event.clientY - windowHalfY;
		targetRotationOnMouseDown = targetRotation;
		targetElevationOnMouseDown = targetElevation;

	}

	function onDocumentMouseMove( event ) {

		mouseX = event.clientX - windowHalfX;
		mouseY = event.clientY - windowHalfY;

		targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.02;
		targetElevation = targetElevationOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.02;
		//console.log("MouseDown ok");
	}

	function onDocumentMouseUp( event ) {

		document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
		document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
		document.removeEventListener( 'mouseout', onDocumentMouseOut, false );

		

	}

	function onDocumentMouseOut( event ) {

		document.removeEventListener( 'mousemove', onDocumentMouseMove, false );
		document.removeEventListener( 'mouseup', onDocumentMouseUp, false );
		document.removeEventListener( 'mouseout', onDocumentMouseOut, false );
	}

	function onDocumentTouchStart( event ) {

		if ( event.touches.length == 1 ) {

			event.preventDefault();

			mouseXOnMouseDown = event.touches[ 0 ].pageX - windowHalfX;
			mouseYOnMouseDown = event.touches[ 0 ].pageY - windowHalfY;
			targetRotationOnMouseDown = targetRotation;
			targetElevationOnMouseDown = targetElevation;
		}
	}

	function onDocumentTouchMove( event ) {

		if ( event.touches.length == 1 ) {

			event.preventDefault();

			mouseX = event.touches[ 0 ].pageX - windowHalfX;
			mouseY = event.touches[ 0 ].pageY - windowHalfY;
			targetRotation = targetRotationOnMouseDown + ( mouseX - mouseXOnMouseDown ) * 0.05;
			targetElevation = targetElevationOnMouseDown + ( mouseY - mouseYOnMouseDown ) * 0.05;

			if (mouseYOnMouseDown < -160) {
			if (mouseXOnMouseDown > -140 && mouseXOnMouseDown < -70) {
				//console.log(mouseXOnMouseDown);
				btns = 1;
				huds[6].color = new THREE.Color( 0xdddddd );
				huds[6].opacity = 1
				huds[7].color = huds[8].color = new THREE.Color( 0xffffff );
				huds[7].opacity = huds[8].opacity = 0.6;
				
			} else if (mouseXOnMouseDown > -70 && mouseXOnMouseDown < 70) {
				btns = 2;
				huds[7].color = new THREE.Color( 0xdddddd );
				huds[7].opacity = 1
				huds[6].color = huds[8].color = new THREE.Color( 0xffffff );
				huds[6].opacity = huds[8].opacity = 0.6;

				// reiniciar
				n = 3;
		        slotCam.x = dB1[n][0];
		        slotCam.y = dB1[n][1];
		        slotCam.z = dB1[n][2];

		        slotTar.x = dB2[n][0];
		        slotTar.y = dB2[n][1];
		        slotTar.z = dB2[n][2];

		        camera.position.x = slotCam.x;										
		        camera.position.y = slotCam.y;
		        camera.position.z = slotCam.z;
		        camera.lookAt( slotTar );

		        slotPuntero.x = camino[2][0][0];
  				slotPuntero.y = -camino[2][0][1];

				pasos = 1
				//huds[6].visible = huds[7].visible = huds[8].visible = false;
				huds[1].visible = false;

				puntero.visible = false;	
				tramos[0].visible = false;

				if (camino[3]) {

					tramos[1].visible = tramos[2].visible = false;						// tubo B visible
					for (var i = 0; i < matPisoA.length; i++) {
						matPisoA[i].opacity = slotPiso1.o = 1;
					};

					for (var i = 0; i < matPisoB.length; i++) {
						matPisoB[i].opacity = slotPiso2.o = 0;
					};

					if (Meta!=0 && Meta>0)
					{
						//animarInicio( -40, 0, 3000 );										// anim cambio de piso 2
						
						//animarMeta( -45, 1, 3000 );
						pisoMeta.position.y = slotPiso2.y = 40;

					} else if (Meta!=0 && Meta<0){
						//animarPiso1( 40, 0, 3000 );											// anim cambio de piso -1
						pisoMeta.position.y = slotPiso1s.y = 0;
						//animarPiso1s( 45, 1, 3000 );
					};
				};

				pisoInicio.position.y = piso_T.position.y = slotPiso1.y = 0;

				for (var i = 0; i < pisoMeta.children.length; i++) {
					pisoMeta.children[i].visible = false;
				};

				for (var i = 0; i < pisoMeta.children.length; i++) {
					pisoMeta.children[i].visible = false;
				};
				
				

				//piso_1.position.y = slotPiso1.y;
				


				animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 0, 3000 );
				animarTar(  dB2[1][0], dB2[1][1], dB2[1][2], 0, 3000 );
	
			} else if (mouseXOnMouseDown > 70 && mouseXOnMouseDown < 140) {
				btns = 3;
				huds[8].color = new THREE.Color( 0xdddddd );
				huds[8].opacity = 1;
				huds[6].color = huds[7].color = new THREE.Color( 0xffffff );
				huds[6].opacity = huds[7].opacity = 0.6;

				animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 0, 2000 );
			};
		};

		}
	}
	

	function onKeyDown ( event ) {

		//var vel = 50

		switch( event.keyCode ) {

			case 78: // /*N*/
				//code
				//animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 2000  );
				//piso_2.position.y=0;
				animarPiso1( -40, 0, 2000 );
				animarPiso2( -45, 1, 2000 );
				break;
			
			case 53: // /*5*/
				//code
				//piso_1.position.y=20;
				animarCam(  dB1[5][0], dB1[5][1], dB1[5][2], 0, 2000 );
				break;

			case 50: // 2
				//code
				//animarCam( [0, 200, 1, 2000] );
				//animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 2000 );
				animarCam(  dB1[2][0], dB1[2][1], dB1[2][2], 0, 2000 );
				//piso1.position.y=0;
				break;

			case 49: // 1
				//code
				//console.log(scene.__objects[5].name);
				//console.log(scene.__objects.length);
				//scene.__objects[5].material = new THREE.MeshLambertMaterial( { color: 0xFF0000 , ambient: 0xFF0000} );

				/*var activo = new THREE.MeshLambertMaterial( { color: 0x00ff00, ambient: 0x00ff00} );
				var pasivo = new THREE.MeshLambertMaterial( { color: 0xff0000, ambient: 0xff0000} );

				if( scene.__objects[5].name == "hc_patios" ) {
					console.log("iguales");
					scene.__objects[5].material = activo;
				}else{
					console.log("distintos");
					scene.__objects[5].material = pasivo;
				}*/

				

				/*var o=scene.__objects.length;
				for (i=0; i<o; i++){
					
					if( scene.__objects[i].name === "hc_patio" ) {
						scene.__objects[i].material = activo;
					}else{
						scene.__objects[i].material = pasivo;
					}
				}*/

				animarCam(  dB1[1][0], dB1[1][1], dB1[1][2], 0, 2000  );

				break;

			case 37: // izq
				animarCam(  dB1[3][0], dB1[3][1], dB1[3][2], 500 );
				break;

			case 39: // der
				//code
				//piso_2.position.y=20;
				animarPiso1( 0, 1, 2000 );
				animarPiso2( 0, 0, 2000 );
				break;
			
		}

	}


	function animate() {

		requestAnimationFrame( animate );

		render();
		stats.update();

		TWEEN.update();

	}

	function render() {


		//var timer = Date.now() * 0.0001;

		//var time = Date.now();
		/*var time = clock.getElapsedTime();
		var looptime = 10 * 1000; // era 5 > más rápido
		var t = (time % looptime) / looptime;*/
		//n = t.charAt(2)
		


		//camera.lookAt( scene.position );
		//camera.lookAt( new THREE.Vector3( 309, 1, -201 ) );

		// Rig camara
		//camera.lookAt( rutap[rigCam].position );					// -- > actualiza target
		//camera.lookAt( coordMedio );								// pos target cam01: punto medio del rec
		//camera.position.set(rigCam.x, 125, rigCam.z);

		if(camera)
		{
			camera.lookAt( slotTar );

			if (pasos == 8 && btns == 1) {
				//camera.position.x += ( mouseX - camera.position.x ) * .05;
				//camera.position.y += ( - mouseY - camera.position.y ) * .05;

				if (camino[3]) {
					if (camino[3]==-1) {
			        	n = 2;
			        }else{
			        	n = -2;
			        }
					
				}else{														// PASO 3
					n = 2;
				};

				targetElevation 	= Math.max(targetElevation, n);
				targetElevation 	= Math.min(targetElevation,15);
				camera.position.y += ( targetElevation*12 - camera.position.y  ) * 0.05;

				//camera.position.x += ( (Math.cos( targetRotation ) * camera.position.x) - camera.position.x ) * 0.05;
				//camera.position.z += ( (Math.sin( targetRotation ) * camera.position.z) - camera.position.z ) * 0.05;

				if (camino[3]) {
					m = 4;
				}else{														// PASO 3
					m = 1;
				};


				camera.position.x += (( dB2[m][0] + (Math.cos( targetRotation/5.5 ) * 100) ) - camera.position.x ) * 0.05;
				camera.position.z += (( dB2[m][2] + (Math.sin( targetRotation/5.5 ) * 100) ) - camera.position.z ) * 0.05;

				slotCam.x = camera.position.x;
				slotCam.y = camera.position.y;
				slotCam.z = camera.position.z;
				//console.log( targetRotation );
				//camera.position.y = Math.min(camera.position.y, 0);

				/*if (mouseXOnMouseDown > -140 && mouseXOnMouseDown < -70) {
					console.log(mouseXOnMouseDown);
				} else{
					//
				};*/

			};
			
			//console.log(mouseXOnMouseDown);



			//renderer.render( scene, camera );
			//renderer.autoUpdateObjects = true;
			composer.render( 0.1 );

		}
		
	}

	







	// INTERCAMBIA LA ESCENA

	function onStartClick() {

		$( "progress" ).style.display = "none";

		init();

	}


	// IDENTIFICADOR

	function $( id ) {

		return document.getElementById( id );

	}


	// PRELOADER

	function prepare() {

		container = document.createElement( 'div' );
		document.body.appendChild( container );

		//scene =  new THREE.Scene(),
		//camera = new THREE.PerspectiveCamera( 65, window.innerWidth / window.innerHeight, 1, 1000 )

		renderer = new THREE.WebGLRenderer();
		//renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );
		renderer.setSize( 900, 900 );
		renderer.setClearColorHex(0xf4f4f4, 1);
		//renderer.antialias = true;
		//renderer.domElement.style.position = "absolute";
		//renderer.domElement.style.top = '50px';
		container.appendChild( renderer.domElement );

		stats = new Stats();
		stats.domElement.style.position = 'absolute';
		stats.domElement.style.top = '0px';
		stats.domElement.style.left = '0px';
		//stats.domElement.style.zIndex = 100;
		//container.appendChild( stats.domElement );


		//  UPDATE

		function handle_update( result, pieces ) {

			//refreshSceneView( result );
			//renderer.initWebGLObjects( result.scene );

			var m, material, count = 0;

			for ( m in result.materials ) {

				material = result.materials[ m ];
				if ( ! ( material instanceof THREE.MeshFaceMaterial ) ) {

					if( !material.program ) {

						//console.log(m);
						//renderer.initMaterial( material, result.scene.__lights, result.scene.fog );

						count += 1;
						if( count > pieces ) {

							//console.log("xxxxxxxxx");
							break;

						}

					}

				}

			}

		}


		var callbackProgress = function( progress, result ) {

			var bar = 250,
				total = progress.total_models + progress.total_textures,
				loaded = progress.loaded_models + progress.loaded_textures;

			if ( total )
				bar = Math.floor( bar * loaded / total );

			$( "bar" ).style.width = bar + "px";

			count = 0;
			for ( var m in result.materials ) count++;

			handle_update( result, Math.floor( count/total ) );

		}

		var callbackFinished = function( result ) {

			loaded = result;

			$( "message" ).style.display = "none";
			$( "progressbar" ).style.display = "none";
			$( "start" ).style.display = "block";
			$( "start" ).className = "enabled";

			//$( "progress" ).style.display = "none";
			//init();
			onStartClick();
			//animarFadeInicial();

			handle_update( result, 1 );

		}

		//$( "start" ).addEventListener( 'click', onStartClick, false );
		$( "progress" ).style.display = "block";

		var loader = new THREE.SceneLoader();
		loader.callbackProgress = callbackProgress;

		loader.load( "src/js/mapa/PEG_gral_v03d.js", callbackFinished );
		
	}
}
</script>
<div id="progress">
			<span id="message"></span>
			<center>
				<div id="progressbar" class="shadow"><div id="bar" class="shadow"></div></div>
				<div id="start" class="disabled"></div>
			</center>
		</div>
		<!-- <div id="huds" z-index="100">
			<ul id="btns">
				<li>
					<img src="src/images/mapa/inCa.png" width="120" height = "120">
				</li>

				<li>
					<img src="src/images/mapa/inCa.png" width="120" height = "120">
				</li>
			</ul>
		</div> -->

	</body>
</html>
