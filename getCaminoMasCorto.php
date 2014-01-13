<?php
//require_once 'calculaCamino.php';
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/controlTienda.class.php';
//$camino= calculaCamino::getCalculoCamino("2","53");

$inicio="240";		// era 219
$meta=$_GET['meta'];
$idTienda=$_GET['idTienda'];
$piso=$_GET['piso'];
$nombre=$_GET['nombre'];
$logo=$_GET['logo'];

?>
<!-- Jquery Library 1.7.1 -->
<script src="src/js/jquery-1.8.3.min.js"></script>
	<script src="src/js/mapa/Three.js"></script>
		<script src="src/js/mapa/Detector.js"></script>
		<script src="src/js/mapa/Stats.js"></script>
		<script src="src/js/mapa/Tween.js"></script>
		<script type='text/javascript' src='src/js/mapa/dat.gui.js'></script>
		<script src="src/js/mapa/Curve.js"></script>
	    <script src="src/js/mapa/TubeGeometry.js"></script>
	    <script src="src/js/mapa/ExtrudeGeometry.js"></script>
	    <link rel="stylesheet" href="src/css/base/iframes.css" />
	    <link rel="stylesheet" href="src/css/jquery.mobile/jquery.mobile.custom.theme.min.css" />

    <div class="titulo-iframe">
	        <img src='<?php echo $logo ?>' width='120' height='100'>
            <div class="nombre-tienda">
                <p class="texto-lista"><?php echo $nombre ?></p>				
                <p class="subtexto-lista">Nivel <?php echo $piso ?></p>
            </div>
    </div>
	<h1 class="titulo-mapa">Ruta a tu tienda en Nivel <?php echo $piso ?></h1>

    <script>
	$(window).bind("load", function() {
    $('#dvLoading').fadeOut(2100);
    });
	</script>
	<div id="dvLoading">
		<!-- <img src="src/img/espera.jpg" width="403" height="403"> -->
	</div>
    
	<div id="mapa"></div>
	<script>
    //$("#mapa").load("src/view/mapaView.php?idTienda=<?php //echo $idTienda;?>&camino=<?php //echo $cam;?>");
    $(document).ready(function() {
    $("#mapa").load("getCaminoNewProgram.php?id=<?php echo $idTienda; ?>&inicio=<?php echo $inicio;?>&meta=<?php echo $meta;?>&foto=<?php echo $logo;?>");
    });
    </script>
	</div>