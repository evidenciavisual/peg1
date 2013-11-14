<?php

require_once ('src/classes/ControlArchivo.class.php');

session_start();



/*if($_POST)
{
	//print_r($_POST);
	//
	//$archivo = $_POST["archivo"];
	//echo $archivo;
	 //$uploaddir = "uploads/";
	//$ruta = $uploaddir.basename($_FILES['up']['name']);
	//echo $ruta;
	//$status = "";
	// $tamano = $_FILES[$_POST["archivo"]]['size'];
    //$tipo = $_FILES[$_POST["archivo"]]['txt'];
  	archivo::upload($_POST);
    //die();
    //$prefijo = substr(md5(uniqid(rand())),0,6);
   /*
    if ($archivo != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "src/file/".$prefijo."_".$archivo;
        if (copy($_FILES['archivo']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo."</b>";
        } else {
            $status = "Error al subir el archivo";
        }
    } else {
        $status = "Error al subir archivo";
    }
	die();*/ 
	
	
/*	
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Mall</title>
	<link rel="stylesheet" href="src/css/index.css" type="text/css" media="screen" />
	<script type="text/javascript" src="src/js/ajax.js"></script>
	<script type="text/javascript" src="src/jquery/jquery.js"></script>
	<script src="src/jquery/jqModal.js" type="text/javascript"></script>
	<script>
	/*
	$(document).ready(function()
		{
			$("#subCuerpo").load("ViewBegin.php");
			var refreshId = setInterval(function() {
		      	$("#subCuerpo").load("ViewBegin.php");
		   		}, 9000);
		   		$.ajaxSetup({ cache: false });			
		});*/
	
	</script>
</head>
<body>
<?php //HTMLViews::getHeader($_SESSION["usuario_sbr"]); ?>
<div class="cuerpo">
	
	<div id="menuprincipal">
	<?php 
		if($_POST)
		{
			$control = archivo::upload($_POST); 
			//echo $control;
			if($control==30)
			{
				?>
			<div class="titulomenuprincipal" >La carga se efectuo exitosamente</div>
			<div style="margin-top: 10px; text-align: center;">
			<!-- <a href="../TransSBRJ/addPropiedad.php">Volver</a>-->
			</div>
				<?php 
			}
			else
			{
				if($control==-21)
				{
					?>
					<div class="titulomenuprincipal" >No se puede efectuar la carga de datos</div>
					<div style="margin-top: 10px; text-align: center;">
					<!-- <a href="../TransSBRJ/addPropiedad.php">Volver</a>-->
					</div>
					<?php 
				}
			}
		}
		else
		{
	?>
	<form action="UploaderData.php" method="post"  enctype="multipart/form-data">
		<table id="upload" border="0">
			<tr><th colspan="3">Carga de archivos masivos</th></tr>
			<tr><td colspan="3" style="background-color: #FFF; color: #000000; font-size: 14px; text-align: center;">Seleccione el tipo de carga que es: </td></tr>
			<tr><th style="background-color: #FFF; color: #000000; font-size: 12px;">Seleccione</th><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Tienda</td><td><input type="radio" name="radio1" id="tienda" value="tienda"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Productos</td><td><input type="radio" name="radio1" id="productos" value="productos"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Marcas</td><td><input type="radio" name="radio1" id="marcas" value="marcas"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">rubro</td><td><input type="radio" name="radio1" id="rubro" value="rubro"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Detalle rubro</td><td><input type="radio" name="radio1" id="detallerubro" value="detallerubro"/></td><td>&nbsp;</td></tr>	
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Detalle Tienda</td><td><input type="radio" name="radio1" id="detalletienda" value="detalletienda"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Detalle Marca</td><td><input type="radio" name="radio1" id="detallemarca" value="detallemarca"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Cambiadores de piso</td><td><input type="radio" name="radio1" id="cambiadores" value="cambiadores"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Nodos</td><td><input type="radio" name="radio1" id="nodos" value="nodos"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Propiedades Tienda</td><td><input type="radio" name="radio1" id="propiedadesTienda" value="propiedadesTienda"/></td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Totem</td><td><input type="radio" name="radio1" id="totem" value="totem"/></td><td>&nbsp;</td></tr>	
			<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td style="background-color: #FFF; color: #000000; font-size: 14px;">Carga</td><td>:</td><td><input type="file" name="archivo" size="35"/></td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td><td align="right"><input type="submit" name="subir" id="subir" value="Cargar Archivo"/></td></tr>
		</table>	
	</form>	
	<?php 
		}
	?>
	</div>
	 <div class="volver">
			<a href="UploaderData.php">Volver</a>
	</div> 
	
<div class="clear"></div>

</div>

</body>

</html>
