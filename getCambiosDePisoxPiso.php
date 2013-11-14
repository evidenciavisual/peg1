<?php
require_once 'src/classes/controlcambiadoresPiso.class.php';

$piso=isset($_GET["piso"])!=null?$_GET["piso"]:null;
$retorno=null;
if ($piso!=null)
{
	$cambiadores=controlcambiadoresPiso::getCambiadorPiso($piso);
	foreach ($cambiadores as $result) 
	{
		if($retorno==null)$retorno=$result['coordenadaReal'].";".$result['tipo'];
		else $retorno.=";".$result['coordenadaReal'].";".$result['tipo'];
	}
}
echo $retorno;
?>