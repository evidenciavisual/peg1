<?php
require_once ("src/classes/controlTienda.class.php");
if(!isset($_GET["rubro"])) header("Location: index.html");
$rub=$_GET["rubro"];
//$bus=$_GET["bus"];
$rubros=controlTienda::listarRubros($rub);
$numero=controlTienda::contarRubros();
?>
<!-- Fancybox 2.0.6 -->
<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
<!-- iScroll 4.0 -->
<script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>
<script type="text/JavaScript">
	var timeout;
	document.onmousemove = function(){
  	clearTimeout(timeout);
 	timeout = setTimeout(function(){location.reload(true);}, 360000);
	}
</script>  

<?php  
	$tiendasConRubro=controlTienda::tiendasConRubros($rub);
	//echo "<div id='scroller'><li class='divisor'>".$rubros->getnombre()."</li></div>";
	//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
	?>

	<script>

	$(document).ready(function() {
		$(".efecto-pagina").css("display", "none");
		$('.efecto-pagina').fadeIn(1400);
	  }); 
    /*---- ESTADISTICAS POR PAGINA------*/
        var ur = "Tiendas de servicio - <?php echo $rubros->getnombre();?>";
        // ur=ur.split("/");
        // ur=ur[4].split(".");
        // ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/	  
	</script>
	
<div class="titulo-rubro">
<div class="volver-rubros-btn">
	<span><a href="rubros.html" rel="external"></a></span></div>
	<?php echo $rubros->getnombre();?>
</div>
  			   
<div id="wrapper" class="wrapper wrapper-extendido-rubros efecto-pagina">
		<div id="scroller">
			<ul id="thelist">
	   	<?php
    	$inicial=null;
    		//var_dump($rubros);
    		//var_dump($rub);
    		?>
    		<?php 
    		//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
    		foreach ($tiendasConRubro as $tiendas)
    		{
    			?>
    			<li class="piso_<?php echo $tiendas->getpiso();?>"><a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    				<?php  if (file_exists('src/img/logos/tiendas/'.$tiendas->getlogo())){ ?>   
                	<img src='src/img/logos/tiendas/<?php echo $tiendas->getlogo();?>' width='120' height='100'>
                	<?php }
                	else {?>
                	<img src='src/img/logos/tiendas/null.jpg' width='120' height='100'>
                <?php }?>
                </a>
    			<div class='nombre-tienda'>
    			<a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			<p class="texto-lista"><?php echo $tiendas->getnombre();?></p>
    			</a>
				<?php if ($tiendas->getpiso()=="-1")$piso = "0";
                    else $piso = $tiendas->getpiso();?>
    			<p class="subtexto-lista">Nivel <?php echo $piso?></p></div>
    			<a class='button-mapa'
    				name="<?php echo $tiendas->getidtienda();?>"
    				onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			</a>   	    			
    			<?php 
    		}
    		?>
    	    			
    	    <?php 
    	?>
    	<!---<script> alert('<?php // echo  $_GET["res"];?>');</script>-->
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
</script>