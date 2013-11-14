<?php
require_once 'src/classes/controlTienda.class.php';

$piso=isset($_GET["piso"])!=null?$_GET["piso"]:null;
$codigoGrupo = isset($_GET["codigo"])!=null?$_GET["codigo"]:null;

$retorno=null;
if ($piso!=null)
{
	$tiendas=controlTienda::getTiendasAnclasPorPiso($piso,$codigoGrupo);
	foreach ($tiendas as $result) 
	{
		if($retorno==null)$retorno=$result['idTienda'].";".$result['nombre'];
		else $retorno.=";".$result['idTienda'].";".$result['nombre'];
	}
}
$retorno = str_replace('í', 'i', $retorno);
echo $retorno;
?>