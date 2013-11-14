<?php
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/nodo.class.php';
require_once 'getCaminoNewProgram.php';

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
if(isset ($_GET['inicioOriginal'])!=null)$inicioOriginal=$_GET['inicioOriginal'];
if(isset ($_GET['meta'])!=null)$inicioOriginal=$_GET['meta'];
?>
<script src="src/js/jquery-1.7.1.min.js"></script>
<script>
function caminoObj(id,camino,largo,idnodo)
{
	this.id=id;
	this.camino=camino;
	this.largo=largo;
	this.idnodo=idnodo;

}
var cpisos=new Array();
<?php 
	$inicioActual = controlCamino::getNodo($inicioOriginal);
	$metaFinal = controlCamino::getNodo($meta);
	
	

?>
var pisoInicioActual= "<?php echo $inicioActual->getpiso();?>";
var pisoMetaFinal= "<?php echo $metaFinal->getpiso();?>";
var coorInicioActual=<?php echo $inicioActual->getcoordenadaReal();?>;
var coorMetaFinal= <?php echo $metaFinal->getcoordenadaReal();?>;
var coorMetaActual="";
var metaActual="";
var caminoParcial="";
var direccion="";
var cambiadores="";
while(true)
{
	if(pisoInicioActual==pisoMetaFinal)
	{
		coorMetaInicial=coorMetaFinal;
		$.get("getCaminoNewProgram.php", { camino: coorInicioActual+"-"+coorMetaActual },
				   function(data){
			   			caminoParcial=caminoParcial+""+data;
			   });
	}
	else
	{
		if(pisoInicioActual<pisoMetaFinal)
		{
			$.get("getCambiadoresPiso.php", { piso: coorInicioActual ,direccion:"sube"},
					   function(data){
				   			cambiadores=data;
				   });
			cambiadores=cambiadores.split(";");
			for (var i = 0; i < cambiadores.length; i++) 
			{
				$.get("getCaminoNewProgram.php", { camino: coorInicioActual+"-"+cambiadores[i] },
						   function(data){
							for (var i = 0; i < data.length; i++)
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
							cpisos[i]=new caminoObj(i,cami,cami.length,camin.slice(-1));
								
					   });
			}
			cpisos.sort(function(a,b){return a.largo - b.largo;});
			caminoParcial=caminoParcial+""+cpisos;
			
			
		}
		else
		{
			$.get("getCambiadoresPiso.php", { piso: coorInicioActual ,direccion:"baja"},
					   function(data){
				   			cambiadores=data;
				   });
			cambiadores=cambiadores.split(";");
			for (var i = 0; i < cambiadores.length; i++) 
			{
				$.get("getCaminoNewProgram.php", { camino: coorInicioActual+"-"+cambiadores[i] },
						   function(data){
							for (var i = 0; i < data.length; i++)
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
							cpisos[i]=new caminoObj(i,cami,cami.length,camin.slice(-1));
								
					   });
			}
			cpisos.sort(function(a,b){return a.largo - b.largo;});
			caminoParcial=caminoParcial+""+cpisos[0].camino;
		}
		
	}
	
}



</script>
			
<?php 
class calculaCamino
{
function getCambiadorPisoMasCercano($inicio,$direccion)
{

	$cambiadores = controlCamino::getCambiadorPiso($inicio->getpiso(),$direccion);
	return $cambiadores;

}


	
	
	function getCalculoCamino($inicioOriginal,$meta)
	{
		?>
		<script>
		function caminoObj(id,camino,largo,idnodo)
		{
			this.id=id;
			this.camino=camino;
			this.largo=largo;
			this.idnodo=idnodo;

		}
		var cpisos=new Array();
		
		</script>
		<?php 
		//echo "inicioOriginal ".$inicioOriginal." meta ".$meta."<br>";
		$inicioActual = controlCamino::getNodo($inicioOriginal);
		
		$metaFinal = controlCamino::getNodo($meta);
		$caminoMasCorto=array();
		
		//aqui empieza el ciclo
		$i=0;
		while(true)
		{
			if($inicioActual->getPiso()==$metaFinal->getpiso())
			{ 
				$metaActual=$metaFinal;
				$caminoParcial=caminonew::getcamino($inicioActual->getcoordenadaReal()."-".$metaActual->getcoordenadaReal());
			
			}
			else 
			{
				if($inicioActual->getpiso()<$metaFinal->getpiso())
				{
					$cambiador= calculaCamino::getCambiadorPisoMasCercano($inicioActual,"sube");
					$direccion="sube";
					$i=0;
					foreach ($cambiador as $cpiso)
					{
						$caminos[]=caminonew::getcamino($inicioActual->getcoordenadaReal()."-".$cpiso->getcoordenadaReal());
						?>
											<script>
												cpisos[<?php echo $i;?>]=new caminoObj("[<?php echo $i;?>]",camino,camino.length);
																		
												
											</script>
											<?php
											$i++; 
										}
										?>
										<script>
											cpisos.sort(function(a,b){return a.largo - b.largo;});
											cpisos[0];
										</script>
										<?php 
					
				}
				else
				{ 
					$cambiador= calculaCamino::getCambiadorPisoMasCercano($inicioActual,"baja");
					$direccion="baja";
					$i=0;
					foreach ($cambiador as $cpiso)
					{
						$caminos[]=caminonew::getcamino($inicioActual->getcoordenadaReal()."-".$cpiso->getcoordenadaReal());
						?>
						<script>
							cpisos[<?php echo $i;?>]=new caminoObj(<?php echo $i;?>,camino,camino.length,<?php echo $cpiso->getidnodo()?>);
													
							
						</script>
						<?php
						$i++; 
					}
					?>
					<script>
						cpisos.sort(function(a,b){return a.largo - b.largo;});
						cpisos[0];
					</script>
					<?php 
					
				}
				
				
			}
			
			//###########################3
			//$caminoParcial= file_get_content('http://localhost/totemsmp/getCaminoNewProgram.php?camino='.$inicioActual->getcoordenadaReal()."-".$metaActual->getcoordenadaReal().'');
			//echo $caminoParcial;
			//$caminoParcial=caminonew::getcamino($inicioActual->getcoordenadaReal()."-".$metaActual->getcoordenadaReal());
			
			//###############################3
			if ($metaActual->getidnodo()==$metaFinal->getidnodo())
			{
				if ($caminoMasCorto !=null)
					{
						$caminoMasCorto[$i]=$caminoParcial; 
						echo "retornando caminomascorto<br>";
						return $caminoMasCorto;
					}
				else 
				{
					//echo "retornando caminoParcial<br>";
					//echo $caminoParcial;
					return $caminoParcial;
				}
				
			}
			else
			{
				//$cambiadorPiso=controlCamino::getDestinoCambiadorPiso($metaActual,$direccion);
				$cambiadorPiso=controlCamino::getDestinoCambiadorPiso($metaActual,$direccion);
				$inicio = $cambiadorPiso->getidnodo();
				$inicioActual = controlCamino::getNodo($inicio);
				
				$caminoMasCorto[$i]=$caminoParcial;
				/*echo"<br>-----------------------------------------------<br>";
				echo "CAMBIO DE PISO".$i;
				echo "<br>----------------------------------------------<br>";*/
				/*print_r($caminoMasCorto);
				print_r($caminoParcial);*/
				
				
			}
			$i++;
		}
		//aqui termina el ciclo	
		
	}
	
	function getCambiadorPisoMasCercano($inicio,$direccion)
	{
		
		$cambiadores = controlCamino::getCambiadorPiso($inicio->getpiso(),$direccion);
		return $cambiadores;
		
	}
	/*
	function getDistancia($inicio,$meta)
	{
		
		if($inicio!=0){
		$nodo= controlCamino::getNodo($inicio);
		//echo $inicio."inicio <br>";
		
		$destino= controlCamino::getNodo($meta); 
		$distancia= sqrt(pow($destino->getubicacionX() - $nodo->getubicacionX(), "2")+
						 pow($destino->getubicacionY() - $nodo->getubicacionY(), "2"));
		//echo "distancia entre destino ".$destino->getidnodo()."( ".$destino->getubicacionX().",".$destino->getubicacionY().")	y nodo ".$nodo->getidnodo()."(".$nodo->getubicacionX().",".$nodo->getubicacionY().") es =".$distancia."<br>";
		return $distancia;
		}
		else{ /*echo "no calcule distancia";*//*return null;}
		
	}
	
	function getAEstrella($inicio,$meta)
	{
		$g=0;
		$nodoActual=$inicio->getidnodo();
		$camino[]=$nodoActual;
		$caminoRecorrido[]=$nodoActual;
		//echo $nodoActual."nodoActual 1 <br>";
		while(true)
		{
			if($nodoActual== $meta)
			{	
				
				return $camino;
			}
			//echo" sdfsdfj";
			$vecinos = controlCamino::getVecinos($nodoActual);
			//echo $nodoActual." nodoActual2 <br>";
			$mejorF=array();
			if(in_array($vecinos->getvecino1(), $caminoRecorrido))$vecino1=0;else $vecino1=$vecinos->getvecino1();
			if(in_array($vecinos->getvecino2(), $caminoRecorrido))$vecino2=0;else $vecino2=$vecinos->getvecino2();
			if(in_array($vecinos->getvecino3(), $caminoRecorrido))$vecino3=0;else $vecino3=$vecinos->getvecino3();
			if(in_array($vecinos->getvecino4(), $caminoRecorrido))$vecino4=0;else $vecino4=$vecinos->getvecino4();
			$vecindad= array($vecino1, $vecino2, $vecino3, $vecino4);
			//echo $vecinos." Vecinos ";
			$j=0;
			for($i=0;$i<4;$i++)
			{
				//unset($mejorF);
					
				if ($vecindad[$i]!=0)$nodo=controlCamino::getNodo($vecindad[$i]);
				
				//echo $vecindad[$i]."-> vecino".$i."<br>";
				
				$h=calculaCamino::getDistancia($vecindad[$i],$meta);
				//echo $h." H <br>";
				
				
				if ($vecindad[$i]!=0){$mejorF[$j]=($g + $h)." ".$nodo->getidnodo();$j++;}
				//echo $mejorF[$i]."->mejorF <br>";
				
			}
			sort($mejorF, SORT_NATURAL | SORT_FLAG_CASE);
			//natsort($mejorF);
			//echo $g."-- Costo camino <br>";
			//echo $mejorF[0]." mejor F <br>";
			unset($mejorNodo);
			$mejorNodo=explode(" ", $mejorF[0]);
			
			$nodoActual=$mejorNodo[1];
			//echo "<br>--------------------<br>".$mejorNodo[1]."<br> mejor nodo <br>";
			//echo $nodoActual."nodo actual <br> ----------------------------------<br>";
			$camino[]=$nodoActual;
			$caminoRecorrido[]=$nodoActual;
			//echo "<br>-------valor de G-------".$g."<br>";
			$g++;
		}*/
	//}
}

?>