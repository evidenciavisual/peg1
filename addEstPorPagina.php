<?php
require_once 'src/classes/controlEstadisticas.class.php';

$nomPag=isset($_GET["nomPag"])!=null?$_GET["nomPag"]:null;
$estadistica=controlEstadisticas::listPaginaEstadisticaHoyByName($nomPag);
//var_dump($estadistica);
if ($nomPag!=null)
{
	
	if($estadistica==null)controlEstadisticas::insertNewEstVisitaHoy($nomPag);
	else controlEstadisticas::sumaContadorVisitaPagina($estadistica['idEstPag']);
}
else
{
	foreach ($estadistica as $result) 
	{
		echo "idPagina-> ".$result['idEstPag']." ;nombrePagina-> ".$result['nomPag']." ; cantVisitas-> ".$result['contVis']." ; fecha-> ".$result['fecVis']."<br>";
	}
}
?>
