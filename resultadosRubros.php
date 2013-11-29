<?php
require_once ("src/classes/controlTienda.class.php");
if(isset($_GET["rubro"]))$rub=$_GET["rubro"];
else $rub=null;

//$bus=$_GET["bus"];
$rubros = controlTienda::listarRubros($rub);
$numero=controlTienda::contarRubros();
?>  
<!-- Fancybox 2.0.6 -->
<link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
<?php  
if ($rub!=null)
{
	$tiendasConRubro=controlTienda::tiendasConRubros($rub);
	//echo "<div id='scroller'><li class='divisor'>".$rubros->getnombre()."</li></div>";
	//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
	?>
    <script>
    $(document).ready(function() {
        /*---- ESTADISTICAS POR PAGINA------*/
        var ur = "resultadoRubro: <?php echo $rubros->getnombre();?>";
        // ur=ur.split("/");
        // ur=ur[4].split(".");
        // ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/
    });
    </script>

	<div class="titulo-rubro">
    		<div class="volver-rubros-btn">
				<span><a href="#" onclick="cargaResultados(null,0)"></a></span>
            </div>
				<?php echo $rubros->getnombre();?>
	</div>
	<div id="wrapper" class="wrapper-extendido-rubros">
<?php 
} 
else 
{
?> 
	<div id="wrapper" class="wrapper-extendido wrapper-margin"> 
<?php 
}
?>
		<div id="scroller">
			<ul id="thelist">
    		<div id="resultadosRubros">
		
	   	<?php
    	$inicial=null;
    	if($rub!=null)
    	{
    		//var_dump($rubros);
    		//var_dump($rub);
    		?>
    		<?php 
    		//echo "<li class='divisor'>".$rubros->getnombre()."</li>";
    		foreach ($tiendasConRubro as $tiendas)
    		{
    			?>
    			<li class="piso_<?php echo $tiendas->getpiso();?>">
    			<a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			
                <?php  if (file_exists('src/img/logos/tiendas/'.$tiendas->getlogo())){ ?>   
                <img src='src/img/logos/tiendas/<?php echo $tiendas->getlogo();?>' width='120' height='100'>
                <?php }
                else {?>
                <img src='src/img/logos/tiendas/null.jpg' width='120' height='100'>
                <?php }?>
    			</a>

    			<div class='nombre-tienda'>
    			<p class="texto-lista"><a href="#" onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'><?php echo $tiendas->getnombre();?></a></p>
                <?php if ($tiendas->getpiso()=="-4")$piso = "-1";
                    else $piso = $tiendas->getpiso();?>

                <p class="subtexto-lista">Nivel <?php echo  $piso;?></p>
                </div>

    			<a class='button-mapa' 
    				name="<?php echo $tiendas->getidtienda();?>"
    				onclick= 'cargaPagina(<?php echo $tiendas->getubiTienda();?>,<?php echo $tiendas->getidtienda()?>);'>
    			</a>   	    			
    			<?php 
    		}
    		?>
    	    			
    	    <?php 
    	}
    	else
    	{
    		foreach ($rubros as $result)
    		{
    		?>
    		<li>
    		<a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);">
    		<img src='src/img/logos/rubros/<?php echo $result->getlogo();?>' width='120' height='100'>
    		</a>

    		<div class='nombre-tienda'>
    		<p class="texto-lista"><a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);"><?php echo $result->getnombre();?></a></p></div>
    		
    		
    		<a href="#" onclick="cargaResultados(<?php echo $result->getidrubro();?>,1);"class="button-mapa button-rubros"></a>
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

function cargaResultados(idRubro,op)
{
	if (op=="1")
		{
			$('#resultadosRubros').slideToggle('slow', function() {
				$("#resultadosRubros").empty();
				$("#resultadosRubros").load("resultadosRubros.php?rubro="+idRubro+"");
				$("#resultadosRubros").show();
				
				
 			 });
		}
	else
		{ 
		$('#resultadosRubros').slideToggle('slow', function() {
			$("#resultadosRubros").empty();
			$("#resultadosRubros").load("resultadosRubros.php");
			$("#resultadosRubros").show();
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

