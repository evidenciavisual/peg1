<?php 
?>
<!DOCTYPE html> 
<html> 
	<head> 
    <meta charset="UTF-8" />
	<title>Mall Plaza</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- Jquery Library 1.7.1 -->
	<script src="src/js/jquery-1.7.1.min.js"></script>
    <!-- Jquery Mobile 1.1.0 -->
	<script src="src/js/jquery.mobile/jquery.mobile.custom.min.js"></script>
	<link rel="stylesheet" href="src/css/jquery.mobile/jquery.mobile.custom.theme.min.css" />
    <link rel="stylesheet" href="src/css/jquery.mobile/jquery.mobile.custom.structure.css" />
    <!-- iScroll 4.0 -->
    <script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>
    <!-- Estilo Base -->
    <link rel="stylesheet" href="src/css/base/estilo.base.css" />
    <!-- Fancybox 2.0.6 -->
    <link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
	
	<script type="text/JavaScript">
	var timeout;
	document.onmousemove = function(){
  	clearTimeout(timeout);
  	timeout = setTimeout(function(){top.location.href='protector.html'}, 360000);
	}
	</script>  
    </head> 

<body> 
<div data-role="page" id="busqueda-rubros" class="mall-inicio-bg">
	<script>
	$(window).bind("load", function() {
    $('#dvLoading').fadeOut(1700);
    });
	
	$(document).ready(function() {
	$(".efecto-pagina").css("display", "none");
	$('.efecto-pagina').fadeIn(2500);	
	/*---- ESTADISTICAS POR PAGINA------*/
        var ur = window.location.href;
        ur=ur.split("/");
        ur=ur[4].split(".");
        ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/	
	});
	</script>
	<div id="dvLoading"></div>

<div data-role="content">
<div class="titulos">
<div class="volver-btn"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
<div class="titulo-txt">
<h1>Busca como quieras</h1>
</div>
</div>
    
<div class="contenedor-busqueda">
<div class="contenedor-busquedas-btn">
<ul class="busquedas">
<li><a href="busquedaTiendas.php" data-transition="fade" rel="external">Por Tienda</a></li>
<li class="current"><a href="#" >Por Rubro</a></li>
<li><a href="busquedaMarcas.php" data-transition="fade" rel="external">Por Marcas</a></li>
<li><a href="busquedaProductos.php" data-transition="fade" rel="external">Por Productos</a></li>
</ul> 
</div>

<div class="contenedor-flechas">
<div class="flecha"></div>
<div class="flecha flecha-current"></div>
<div class="flecha"></div>
<div class="flecha"></div>
</div>

<div class="bg-busquedas">
<div id="resultadosRubros" class="efecto-pagina" style= "margin: 0; padding: 0;"></div>
</div>
</div><!-- /contenedor-busqueda -->

    <div class="volver-bottom">
    <div class="volver-btn-bottom"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
    </div>

</div><!-- /content -->
</div><!-- /page -->

<script>
//######################## INICIO SCRIPT DE BUSQUEDA ##################
$(document).ready(function () {
	buscaRubros();
});
var i=1;
var a="";
function buscaRubros(){
	$("#resultadosRubros").load("resultadosRubros.php");
		return true;
}
</script>

</body>
</html>