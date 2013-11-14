<?php
require_once ("src/classes/controlTienda.class.php");
require_once ("src/classes/controlMarca.class.php");
if(isset($_GET["res"]))$resultadoBusqueda=$_GET["res"]; else $resultadoBusqueda=null;
if(isset($_GET["prod"]))$marcaABuscar=$_GET["prod"]; else $marcaABuscar=null;

//$bus=$_GET["bus"];
$marcaBuscado = controlMarca::listarMarca($resultadoBusqueda);
//$numero=controlTienda::contarRubros();
?>  
		<!-- Jquery Library 1.7.1
		<script src="src/js/jquery-1.7.1.min.js"></script> -->
	   	<!-- Fancybox 2.0.6  -->
    	<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
		<!-- iScroll 4.0 -->
		<!--script type="text/javascript" src="src/js/iscroll/iscroll.js"></script> -->        
    	<!-- Estilo Base
    	<link rel="stylesheet" href="src/css/base/estilo.base.css" /> -->
<?php  
if ($marcaABuscar!=null)
{
	$marcaEnTiendas=controlTienda::marcaEnTiendas($marcaABuscar);
	$marcaABuscar= controlMarca::getMarca($marcaABuscar);
	//echo "<div id='scroller'><li class='divisor'>".$rubros->getnombre()."</li></div>";
	//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
	?>
	<script>
	$(document).ready(function() {
		/*---- ESTADISTICAS POR PAGINA------*/
        var ur = "resultadoMarca: <?php echo $marcaABuscar->getnombre();?>";
        // ur=ur.split("/");
        // ur=ur[4].split(".");
        // ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/
    });
    </script>
	<div class="titulo-rubro">
    <div class="volver-rubros-btn">
	<span><a href="#" data-transition="slide" data-direction="reverse"  onclick="cargaResultados('null','<?php echo $resultadoBusqueda;?>',null,0)"></a></span>
    </div>
	<?php echo $marcaABuscar->getnombre();?>
	</div>
	<div id="wrapper" class="wrapper-corto">
 <?php 
} 
else 
{
?> 
<div id="wrapper" class="wrapper-margin"> 
<?php 
}
?>
		<div id="scroller" >
			<ul id="thelist">
    		<div id="resultadosMarca">
		
		   	<?php
		      $inicial=null;
	  	  	if($marcaABuscar!=null)
  		  	{
    			//var_dump($rubros);
	    		//var_dump($rub);
    			?>
    			<?php 
    			//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
    			foreach ($marcaEnTiendas as $resultado)
	    		{
    				?>
    				<li><a onclick= 'cargaPagina(<?php echo $resultado->getubiTienda();?>,<?php echo $resultado->getidtienda()?>);'>
    					
		             <?php  if (file_exists('src/img/logos/tiendas/'.$resultado->getlogo())){ ?>   
		    			<img src='src/img/logos/tiendas/<?php echo $resultado->getlogo();?>' width='120' height='100'>
		            <?php }
		            else {?>
		            <img src='src/img/logos/tiendas/null.jpg' width='120' height='100'>
		            <?php }?>
    				</a>
    				<div class='nombre-tienda'>
    				<p class="texto-lista"><a onclick= 'cargaPagina(<?php echo $resultado->getubiTienda();?>,<?php echo $resultado->getidtienda()?>);'><?php echo $resultado->getnombre();?></a></p>
    				<?php if ($resultado->getpiso()=="-4")$piso = "-1";
    				else $piso = $resultado->getpiso();?>
    				<p class="subtexto-lista">Nivel <?php echo $piso; ?></p></div>
	    			<a class='button-mapa' name="<?php echo $resultado->getidtienda();?>" onclick= 'cargaPagina(<?php echo $resultado->getubiTienda();?>,<?php echo $resultado->getidtienda()?>);'>
    				</a>   	    			
    			<?php 
    			}
    			?>
    	    		<?php 
    			}
    			else
    			{
	    		foreach ($marcaBuscado as $result)
    			{
    			?>
    			<li>
    			<a href="#" onclick="cargaResultados('<?php echo $result->getidmarca();?>','<?php echo $resultadoBusqueda;?>',1);" data-transition="slide">
    			</a>
    			<div class='nombre-tienda'>
			<p class="texto-lista"><a href="#" onclick="cargaResultados('<?php echo $result->getidmarca();?>','<?php echo $resultadoBusqueda;?>',1);"><?php echo $result->getnombre();?></a></p></div>
	    		<a href="#" onclick="cargaResultados('<?php echo $result->getidmarca();?>','<?php echo $resultadoBusqueda;?>',1);" class="button-mapa button-rubros" data-transition="slide"></a>
    			</li>	
    			<?php 
	    		} 
    		}
    		?>
	    	<!---<script> alert('<?php // echo  $_GET["res"];?>');</script>-->
    		</div>
    		</ul>
		</div><!-- / Fin container slidejs -->
	</div>



<script>var myScroll = new iScroll('wrapper');</script>

<script> 
function cargaPagina(ubicacion,idTienda)
{
	$.fancybox({
		type		: "iframe",
		fitToView	: true,
		width		: 900,
		height		: 1100,
		padding 	: 40,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'fade',
		closeEffect	: 'elastic',
		openSpeed	: 'normal',
		helpers 	: { overlay : {opacity: 0.5, css : {'background-color' : '#440007'} } },
		href		: "getCaminoMasCorto.php?inicio=263&meta="+ubicacion+"&idTienda="+idTienda+""
		
	});
}
function cargaResultados(prod,res,op)
{
	if (op=="1")
		{
		
			$('#resultadosMarca').slideToggle('slow', function() {
				$("#resultadosMarca").empty();
				$("#resultadosMarca").load("resultadosMarca.php?prod="+prod+"&res="+res+"");
				$("#resultadosMarca").show();
 			 });
		}
	else
		{ 
		$('#resultadosMarca').slideToggle('slow', function() {
			$("#resultadosMarca").empty();
			$("#resultadosMarca").load("resultadosMarca.php?res="+res+"");
			$("#resultadosMarca").show();
			 /*---- ESTADISTICAS POR PAGINA------*/
            var ur = window.location.href;
            ur=ur.split("/");
            ur=ur[4].split(".");
            ur=ur[0];
            $.get("addEstadistica.php", { nomPag: ur } );
            /*---- ESTADISTICAS POR PAGINA------*/
			 })
			
		}
}

</script>

