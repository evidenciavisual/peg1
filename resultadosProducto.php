<?php
require_once ("src/classes/controlTienda.class.php");
require_once ("src/classes/controlProducto.class.php");
if(isset($_GET["res"]))$resultadoBusqueda=$_GET["res"]; else $resultadoBusqueda=null;
if(isset($_GET["prod"]))$productoABuscar=$_GET["prod"]; else $productoABuscar=null;

//$bus=$_GET["bus"];
$productoBuscado = controlProducto::listarProducto($resultadoBusqueda);
//$numero=controlTienda::contarRubros();
?>  
		<!-- Jquery Library 1.7.1 --
		<script src="src/js/jquery-1.7.1.min.js"></script>
	   	<!-- Fancybox 2.0.6  -->
    	<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
		<!-- iScroll 4.0 --
		<script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>        
    	<!-- Estilo Base --
    	<link rel="stylesheet" href="src/css/base/estilo.base.css" />

<!--  script src="src/js/jquery.ui/jquery.effects.core.js"></script>
<script src="src/js/jquery.ui/jquery.effects.slide.js"></script>-->
<?php  
if ($productoABuscar!=null)
{
	$productoEnTiendas=controlTienda::productoEnTiendas($productoABuscar);
	$productoABuscar= controlProducto::getProducto($productoABuscar);
	//echo "<div id='scroller'><li class='divisor'>".$rubros->getnombre()."</li></div>";
	//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
	?>
	<script>
	$(document).ready(function() {
		/*---- ESTADISTICAS POR PAGINA------*/
        var ur = "resultadoProducto: <?php echo $productoABuscar->getnombre();?>";
        // ur=ur.split("/");
        // ur=ur[4].split(".");
        // ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/
    });
    </script>
	<div class="titulo-rubro">
    		<div class="volver-rubros-btn">
				<span><a href="#" data-transition="slide" data-direction="reverse"  onclick="cargaResultados('null','<?php echo $resultadoBusqueda;?>',null,0)"></a></span></div>
				<?php echo $productoABuscar->getnombre();?>
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
		<div id="scroller">
			<ul id="thelist">
    		<div id="resultadosProducto">
		
		   	<?php
		      $inicial=null;
	  	  	if($productoABuscar!=null)
  		  	{
    			//var_dump($rubros);
	    		//var_dump($rub);
    			?>
    			<?php 
    			//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
    			foreach ($productoEnTiendas as $resultado)
	    		{
    				?>
    				<li><a onclick= 'cargaPagina(<?php echo $resultado->getubiTienda();?>,<?php echo $resultado->getidtienda()?>);'>
    					
             		<?php  if (file_exists('src/img/logos/tiendas/'.$resultado->getlogo())){ ?>   
    				<img src='src/img/logos/tiendas/<?php echo $resultado->getlogo();?>' width='120' height='100'>
            		<?php }
            		else {?>
            		<img src='src/img/logos/tiendas/null.jpg' width='120' height='100'>
            		<?php }?>
    				</a><div class='nombre-tienda'>
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
	    		foreach ($productoBuscado as $result)
    			{
    			?>
    			<li>
    			<a href="#" onclick="cargaResultados('<?php echo $result->getidproducto();?>','<?php echo $resultadoBusqueda;?>',1);" data-transition="slide">
    			</a>
    			<div class='nombre-tienda'>
			<p class="texto-lista"><a href="#" onclick="cargaResultados('<?php echo $result->getidproducto();?>','<?php echo $resultadoBusqueda;?>',1);"><?php echo $result->getnombre();?></a></p></div>
	    		<a href="#" onclick="cargaResultados('<?php echo $result->getidproducto();?>','<?php echo $resultadoBusqueda;?>',1);" class="button-mapa button-rubros" data-transition="slide"></a>
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
	//$.fancybox({type:"iframe", width:900, height:1100,href:"getCaminoMasCorto.php?inicio=39&meta="+ubicacion+"&idTienda="+idTienda+""});
	
	//$.colorbox({iframe:true, width:"900px", height:"1100px",href:"mapa_02.php"});
	//$.colorbox.resize();
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
		
			$('#resultadosProducto').slideToggle('slow', function() {
				$("#resultadosProducto").empty();
				$("#resultadosProducto").load("resultadosProducto.php?prod="+prod+"&res="+res+"");
				$("#resultadosProducto").show();
				
				
 			 });
		}
	else
		{ 
		$('#resultadosProducto').slideToggle('slow', function() {
			$("#resultadosProducto").empty();
			$("#resultadosProducto").load("resultadosProducto.php?res="+res+"");
			$("#resultadosProducto").show();
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

