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
    <!-- iScroll 4.0 -->
	<script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>        
	<!-- Jquery UI -->
    <link rel="stylesheet" href="src/css/jquery.ui/jquery-ui.css" />
    <script src="src/js/jquery.ui/jquery-ui.min.js"></script>
    <!-- Final Keyboard -->
    <link rel="stylesheet" href="src/css/finalkeyboard/jquery.mobile-1.1.0-rc.1.min.css" />
    <script src="src/js/finalkeyboard/jquery.mobile-1.1.0-rc.1.min.js"></script>
    <link rel="stylesheet" href="src/css/finalkeyboard/keyboard.css" />
    <script src="src/js/finalkeyboard/jquery.keyboard.js"></script>
    <script src="src/js/finalkeyboard/jquery.keyboard.extension-mobile.js"></script>    
    <!-- Estilo Base -->
    <link rel="stylesheet" href="src/css/base/estilo.base.css" />
    <script type="text/JavaScript">
	var timeout;
	document.onmousemove = function(){
  	clearTimeout(timeout);
  	timeout = setTimeout(function(){top.location.href='protector.html';}, 360000);
	}
	</script>  
	</head>

<body>
<div data-role="page" id="busqueda-productos" class="mall-inicio-bg">
	<script>
	$(document).ready(function() {
		/*---- ESTADISTICAS POR PAGINA------*/
        var ur = window.location.href;
        ur=ur.split("/");
        ur=ur[4].split(".");
        ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/	
    var k = $('.keyboard'),
    s = $('#switcher').find('input'),
    set = $('#switcher').find('.ui-controlgroup-controls'),
    kbOptions = {
        keyBinding : 'mousedown touchstart',
        //alwaysOpen : false,
        usePreview  : false,
        autoAccept  : true,
        position: {
            of: ".emailContainer", 
        },
        css : {
            input          : '',
            container      : '',
            buttonDefault  : '',
            buttonHover    : '',
            buttonActive   : '',
            buttonDisabled : ''
        }       
    };

    k
        .keyboard(kbOptions)
        .addMobile({
            container    : { theme:'c' },
            buttonMarkup : { theme:'c', shadow:'true', inline:'true', corners:'false' },
            buttonAction : { theme:'b' },
            buttonActive : { theme:'e' },
        });

		$(".efecto-pagina").css("display", "none");
		$('.efecto-pagina').fadeIn(2100);	
	 });

	//$(window).bind("load", function() {
	//    $('#dvLoading').fadeOut(1700);
	//});
	</script>
	<!-- <div id="dvLoading"></div> -->
    
	<div data-role="content">
		<div class="titulos">
    		<div class="volver-btn"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
    		<div class="titulo-txt">
    			<h1>Busca como quieras</h1>
    		</div>
    	</div>

    	<div class="contenedor-busqueda">
			<div  class="contenedor-busquedas-btn">
				<ul class="busquedas">
				<li><a href="busquedaTiendas.php" data-transition="fade" rel="external">Por Tienda</a></li>
				<li><a href="busquedaRubros.php" data-transition="fade" rel="external">Por Rubro</a></li>
				<li><a href="busquedaMarcas.php" data-transition="fade" rel="external">Por Marcas</a></li>
				<li class="current"><a href="#">Por Productos</a></li>
				</ul> 
			</div>
			<div class="contenedor-flechas">
				<div class="flecha"></div>
				<div class="flecha "></div>
				<div class="flecha"></div>
				<div class="flecha flecha-current"></div>
			</div>

			<div class="bg-busquedas bg-busquedas-padding">
				<!--########## BUSCADOR ##############################-->
				<div class="emailContainer">			
				<input type="text" name="res"  class="keyboard search" id="txtContent" onchange="buscaTiendas();"  value=""/> 
				</div>
				<!--########## FIN BUSCADOR ##############################-->
				<div id="resultadosProducto" class="efecto-pagina" style="text-align: center; margin: 0; padding: 0;">
					<img src="src/img/escribe.jpg">
				</div>
			</div>
			
			
		</div><!-- /contenedor-busqueda -->
        
    <div class="volver-bottom">
    <div class="volver-btn-bottom"><span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span></div>
    </div>
    
	</div><!-- /content -->
</div><!-- /page -->

<script>
var i=1;
var a="";
function buscaTiendas(){
	//##################### BUSCADOR ###################### 
		 if (document.getElementById("txtContent").value=="")
			 { 
			 $("#resultadosProducto").empty();
			 i=1;
			 } 
		 else 
			 {
				if (i>=3)$("#resultadosProducto").load("resultadosProducto.php?"+$("#txtContent").serialize());
				i++;
			 }
		// ###################### FIN BUSCADOR #############################			 
			return true;
}
</script>
</body> 
</html>
