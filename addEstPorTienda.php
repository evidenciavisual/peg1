<?php
require_once 'src/classes/controlEstadisticas.class.php';

$nomTie=isset($_GET["nomTienda"])!=null?$_GET["nomTienda"]:null;
$estadistica=controlEstadisticas::listTiendaEstadisticaHoyByName($nomTie);
//var_dump($estadistica);
if ($nomTie!=null)
{
	
	if($estadistica==null)controlEstadisticas::insertNewEstVisitaHoyTienda($nomTie);
	else controlEstadisticas::sumaContadorVisitaTienda($estadistica['idEstTie']);
}
else
{
	foreach ($estadistica as $result) 
	{
		echo "idEstTienda-> ".$result['idEstTie']." ;nombreTienda-> ".$result['nomTie']." ; cantVisitas-> ".$result['contVis']." ; fecha-> ".$result['fecVis']."<br>";
	}
}
?>
