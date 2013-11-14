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
    <!-- Keyboard  -->
    <link rel="stylesheet" type="text/css" href="src/css/keyboard/jsKeyboard.css" />
    <script type="text/javascript" src="src/js/keyboard/jsKeyboard.js"></script>
    <!-- Estilo Base -->
    <link rel="stylesheet" href="src/css/base/estilo.base.css" />
    <!-- Fancybox 2.0.6 -->
    <link rel="stylesheet" href="src/css/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="src/js/fancybox/jquery.fancybox.pack.js"></script>
    </head> 

<body> 
<div data-role="page" id="busqueda-sugerencias" class="mall-inicio-bg">


	<div data-role="content">
    <div class="titulos">
    <div class="volver-btn"><span><a href="inicio.html" rel="external"></a></span></div>
    <div class="titulo-txt">
    <h1>Sugerencias para:</h1>
    </div>
    </div>
    
<div class="contenedor-busqueda">
<div class="bg-busquedas">
<div id="resultadosRubros" style= "margin:0; padding: 0;"></div>
</div>

</div><!-- /contenedor-busqueda -->

<div class="volver-bottom">
<div class="volver-btn-bottom"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
</div>

</div><!-- /content -->
</div><!-- /page -->


 <script>
//#######################################--- INICIO SCRIPT DE BUSQUEDA---##############################3
$(document).ready(function () {
     /*---- ESTADISTICAS POR PAGINA------*/
        var ur = window.location.href;
        ur=ur.split("/");
        ur=ur[4].split(".");
        ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/
	buscaRubros();
});
var i=1;
var a="";
function buscaRubros(){
	$("#resultadosRubros").load("sugerencia.php");
		return true;
}
</script>
<div style="margin:0 auto; width:100%"><div id="virtualKeyboard" style="z-index:1000;"></div></div>
</body>
</html>