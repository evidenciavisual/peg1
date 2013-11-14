<?php
require_once 'src/classes/controlCamino.class.php';
require_once 'src/classes/nodo.class.php';

if(isset ($_GET['coor']))$coor = $_GET['coor'];
else $coor=null;
if(isset ($_GET['direccion']))$direccion = $_GET['direccion'];
else $direccion=null;
if(isset ($_GET['piso']))$piso = $_GET['piso'];
else $piso=null;
//echo "coor->".$coor;
$idnodo = controlCamino::getIdNodoPisoPorCoorReal($coor,$piso);
//var_dump($idnodo);
$coordenadaDestino = controlCamino::getDestinoCambiadorPiso($idnodo->getidnodo(),$direccion);
//var_dump($coordenadaDestino);
echo $coordenadaDestino->getcoordenadaReal().";".$coordenadaDestino->getpiso();

?>