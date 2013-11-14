<?php
require_once 'src/classes/controlTienda.class.php';

$piso=isset($_GET["piso"])!=null?$_GET["piso"]:null;
$retorno=null;
if ($piso!=null)
{
	$tiendas=controlTienda::getTiendaPorPiso($piso);
	foreach ($tiendas as $result) 
	{
		if($retorno==null)$retorno=$result['idTienda'];
		else $retorno.=";".$result['idTienda'];
	}
}
echo $retorno;
?>
