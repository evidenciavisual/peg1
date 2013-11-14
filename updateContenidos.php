<?php
//phpinfo();
//echo "hola";

if($_GET)
{
	$ren=isset($_GET['file'])?$_GET['file']:null;
	if($ren!=null)
	{
		switch($ren)
		{
			case "desc": 
				rename('src/xml/descuentos3.xml','src/xml/descuentos.xml');
				break;
			case "cine": 
				rename('src/xml/cine3.xml','src/xml/cine.xml');
				break;
			case "evento": 
				rename('src/xml/eventos3.xml','src/xml/eventos.xml');
				break;
		}
		echo "Carga realizada!";
		echo "<a href='updateContenidos.php'> Actualizar algo mas </a><br>";
		echo "<a href='index.html'> Volver al sistema </a>";


	}

}
else
{
	if($_POST)
{
	if (isset($_POST['radio1'])) $opc=$_POST['radio1']; else $opc=null;
	//echo $opc;
	switch($opc)
	{
		case "desc":
			$url  = 'http://www.mallplaza.cl/xml/descuentos.php?siteid=mallplaza-alameda';
			$path = 'src/xml/descuentosDesc.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
		case "cine":
			$url  = 'http://www.mallplaza.cl/xml/cine.php?siteid=mallplaza-alameda';
			$path = 'src/xml/cineDesc.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
		case "evento":
			$url  = 'http://www.mallplaza.cl/xml/eventos.php?siteid=mallplaza-alameda';
			$path = 'src/xml/eventosDesc.xml';
			 
			$fp = fopen($path, 'w');
			 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_FILE, $fp);
			 
			$data = curl_exec($ch);
			 //var_dump($data);
			curl_close($ch);
			fclose($fp);
			break;
	}
	echo "<div id='base' style='background-color:white; cursor:auto!important;'>";
	echo "Carga realizada!";
	echo "<a href='updateContenidos.php'> Actualizar algo mas </a><br>";
	echo "<a href='#' onclick='preview(".'"'.$opc.'"'.")'> Ver un preview del contenido actualizado </a><br>";
	echo "<a href='index.html'> Volver al sistema </a><br>";
	echo "</div>";

}
else
{
?>

<form action="updateContenidos.php" method="post" enctype="multipart/form-data">
		<table id="upload" border="0">
			<tr><th colspan="3">Actualizacion de contenidos</th></tr>
			<tr><td colspan="3" style="background-color: #FFF; color: #000000; font-size: 14px; text-align: center;">Seleccione la actualizacion de contenido: </td></tr>
			<tr><th style="background-color: #FFF; color: #000000; font-size: 12px;">Seleccione</th><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Descuento</td><td><input type="radio" name="radio1" id="tienda" value="desc"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Cartelera de cine</td><td><input type="radio" name="radio1" id="productos" value="cine"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Eventos</td><td><input type="radio" name="radio1" id="marcas" value="evento"/></td><td>&nbsp;</td></tr>
			

			
			<tr><td>&nbsp;</td><td>&nbsp;</td><td align="right"><input type="submit" name="subir" value="Cargar Archivo"/></td></tr>
		</table>	
	</form>	
<?php }
}
?>
<script src="src/js/jquery-1.7.1.min.js"></script> 
<!-- iScroll 4.0 -->
    <script type="text/javascript" src="src/js/iscroll/iscroll.js"></script>

<script>
	function preview(file)
	{
		switch(file)
		{
			case "desc":
				$("#auth").html('<hr><link rel="stylesheet" href="src/css/base/estilo.base.css" /><a href="updateContenidos.php?file='+file+'" style="background-color:white; cursor:auto!important;">Mantener este cambio</a><div id="preview"></div>').css("display","block");
				$('#preview').load('descuentosPreview.php');	

				break;
			case "cine":
				$("#auth").html('<hr><link rel="stylesheet" href="src/css/base/estilo.base.css" /><a href="updateContenidos.php?file='+file+'" style="background-color:white; cursor:auto!important;">Mantener este cambio</a><div id="preview"></div>').css("display","block");
				$('#preview').load('cinePreview.php');	
				break;
			case "evento":
				$("#auth").html('<hr><link rel="stylesheet" href="src/css/base/estilo.base.css" /><a href="updateContenidos.php?file='+file+'" style="background-color:white; cursor:auto!important;">Mantener este cambio</a><div id="preview"></div>').css("display","block");
				$('#preview').load('eventosPreview.php');	
				break;

		}
		


	}
</script>

<div id="auth" style="display:none; cursor:auto!important;">

	<div id="preview" >
	
	</div>
</div>