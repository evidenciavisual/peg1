<?php
//require_once 'calculaCamino.php';
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/controlTienda.class.php';
//$camino= calculaCamino::getCalculoCamino("2","53");

$inicio="256";		// era 219
$meta=$_GET['meta'];
$idTienda=$_GET['idTienda'];

?>
<!-- Jquery Library 1.7.1 -->
<script src="src/js/jquery-1.7.1.min.js"></script>
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
		<?php $tienda= controlTienda::getTienda($idTienda); ?>

    <div class="titulo-iframe">

	         <?php  if (file_exists('src/img/logos/tiendas/'.$tienda->getlogo())){ ?>   
	    	<img src="src/img/logos/tiendas/<?php echo $tienda->getlogo();?>" width='120' height='100'>
	        <?php }
	        else {?>
	        <img src='src/img/logos/tiendas/null.jpg' width='120' height='100'>
	        <?php }?>
            
            <div class="nombre-tienda">
                <p class="texto-lista"><?php echo $tienda->getnombre()?></p>
                <p class="subtexto-lista">Nivel <?php echo $tienda->getpiso()?></p>
            </div>
    </div>
	<h1 class="titulo-mapa">Ruta a tu tienda en Nivel <?php echo $tienda->getpiso()?></h1>

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
    $("#mapa").load("getCaminoNewProgram.php?id=<?php echo $idTienda; ?>&inicio=<?php echo $inicio;?>&meta=<?php echo $meta;?>&foto=<?php echo $tienda->getlogo()?>");
    });
    </script>
	</div>

