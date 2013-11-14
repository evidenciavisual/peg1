<?php
require_once 'src/classes/controlTienda.class.php';

$piso=isset($_GET["piso"])!=null?$_GET["piso"]:null;
$rubro=isset($_GET["rubro"])!=null?$_GET["rubro"]:null;
$retorno=null;
if ($piso!=null && $rubro!=null)
{
	$rubro=controlTienda::tiendasConRubrosxPiso($rubro,$piso);
	foreach ($rubro as $result) 
	{
		if($retorno==null)$retorno=$result['idnodo'];
		else $retorno.=";".$result['idnodo'];
	}
}//listaTiendasConAreasDeNegocio
else
{
	$rubro = controlTienda::listaTiendasConAreasDeNegocio();
	
	foreach ($rubro as $result) 
	{
		if($retorno==null)$retorno=$result['areaN'].";".$result["idnodo"];
		else $retorno.=";".$result['areaN'].";".$result["idnodo"];	
	}
}
echo $retorno;
?>