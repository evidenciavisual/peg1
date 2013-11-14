<?php
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/nodo.class.php';

if(isset($_GET['piso']))$piso = $_GET['piso'];
else $piso=null;
if(isset($_GET['direccion']))$direccion = $_GET['direccion'];
else $direccion=null;
$cambiadores = controlCamino::getCambiadorPiso($piso,$direccion);
$retorno="";
//echo $piso.$direccion;
//var_dump($cambiadores);
foreach ($cambiadores as $cambio)
{
	if ($retorno=="")$retorno=$cambio->getcoordenadaReal();
	else $retorno=$retorno.";".$cambio->getcoordenadaReal();
}

echo $retorno;

?>