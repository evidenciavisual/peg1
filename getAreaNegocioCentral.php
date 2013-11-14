<?php
require_once 'src/classes/controlTienda.class.php';

$piso=isset($_GET["piso"])!=null?$_GET["piso"]:null;
$retorno=null;
if ($piso!=null)
{
	$areaN=controlTienda::listaAreasDeNegocioxPiso($piso);
	foreach ($areaN as $result) 
	{
		if($retorno==null)$retorno=$result['nombre'].";".$result["coordenada"];
		else $retorno.=";".$result['nombre'].";".$result["coordenada"];
	}
}
echo $retorno;
?>