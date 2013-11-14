<?php
require_once 'src/classes/controlEstadisticas.class.php';

$nomPag=isset($_GET["nomPag"])!=null?$_GET["nomPag"]:null;

//var_dump($estadistica);
if ($nomPag!=null)
{
	
	controlEstadisticas::insertNewEstadistica($nomPag);
}
else
{
	foreach ($estadistica as $result) 
	{
		echo "idPagina-> ".$result['idEstPag']." ;nombrePagina-> ".$result['nomPag']." ; cantVisitas-> ".$result['contVis']." ; fecha-> ".$result['fecVis']."<br>";
	}
}
?>
