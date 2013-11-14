<?php 
if(isset($_GET["msg"]))$msg=$_GET["msg"];
else $msg=null;
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
    <!-- Keyboard  -->
    <link rel="stylesheet" type="text/css" href="src/css/keyboard/jsKeyboard.css" />
    <script type="text/javascript" src="src/js/keyboard/jsKeyboard.js"></script>
    <!-- Estilo Base -->
    <link rel="stylesheet" href="src/css/base/estilo.base.css" />
    
   	<script>
	$(document).ready(function() {
         /*---- ESTADISTICAS POR PAGINA------*/
        var ur = window.location.href;
        ur=ur.split("/");
        ur=ur[4].split(".");
        ur=ur[0];
        $.get("addEstadistica.php", { nomPag: ur } );
        /*---- ESTADISTICAS POR PAGINA------*/	
		$(".efecto-pagina").css("display", "none");
		$('.efecto-pagina').fadeIn(800);	
	});
	</script>
	
	<script type="text/JavaScript">
	var timeout;
	document.onmousemove = function(){
  	clearTimeout(timeout);
  	timeout = setTimeout(function(){top.location.href='protector.html'}, 360000);
	}
	</script> 
    </head> 

<body>
<div data-role="page" id="felicitacion" class="mall-inicio-bg">

	<div data-role="content">
    <div class="titulos">
    <div class="volver-btn"><span><a href="inicio.html" rel="external"></a></span></div>
    <div class="titulo-txt">
    <h1>Ayuda</h1>
    </div>
    </div>
    
	<div class="contenedor-busqueda efecto-pagina">
	<div class="bg-busquedas bg-busquedas-large-padding">
    <h1 class="titulos-ayuda">Mensaje Enviado!</h1>
    <br/>
    <h1 class="titulos-ayuda">Tu <?php echo $msg; ?> es importante para nosotros, te contactaremos a la brevedad...</h1>
    <p style="text-align:center;"><a href="inicio.html" data-transition="slide" data-direction="reverse"><input type="submit" class="boton-enviar-correo" value="Volver a Inicio" /></a></p> 
	</div>
	</div>
</div><!-- /contenedor-busqueda -->

    <div class="volver-bottom">
    <div class="volver-btn-bottom"><span><a href="inicio.html" rel="external"></a></span></div>
    </div>
    
<script type="text/javascript">
     $(function () {
         jsKeyboard.init("virtualKeyboard");
         $("#mensaje").val(initText);
     });

     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }

     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }

     var initText = "";
</script> 
    
<script type="text/javascript">
     $(function () {
         jsKeyboard.init("otrokey");
         $("#mensaje-nombre").val(initText);
     });

     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }

     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }

     var initText = "";
</script>

<script type="text/javascript">
     $(function () {
         jsKeyboard.init("otrokey");
         $("#mensaje-correo").val(initText);
     });

     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }

     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }

     var initText = "";
</script>


<script type="text/javascript">
     $(function () {
         jsKeyboard.init("otrokey");
         $("#mensaje-rut").val(initText);
     });

     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }

     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }

     var initText = "";
</script>

<script type="text/javascript">
     $(function () {
         jsKeyboard.init("otrokey");
         $("#mensaje-tel").val(initText);
     });

     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }

     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }

     var initText = "";
</script>            

</div><!-- /content -->
</div><!-- /page -->
</body>
</html>