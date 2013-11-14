<?php
require_once 'src/classes/controlCorreos.class.php';

if (isset ($_GET['nom']))$nombre=$_GET['nom'];else $nombre=null;
if (isset ($_GET['rut']))$rut=$_GET['rut'];else $rut=null;
if (isset ($_GET['tel']))$telefono=$_GET['tel'];else $telefono=null;
if (isset ($_GET['correo']))$correo=$_GET['correo'];else $correo=null;
if (isset ($_GET['mensaje']))$mensaje=$_GET['mensaje'];else $mensaje=null;
if (isset ($_GET['tipo']))$tipo=$_GET['tipo'];else $tipo=null;
if (isset ($_GET['estado']))$estado=$_GET['estado'];else $estado=null;

if($nombre!=null&&$rut!=null&&$telefono!=null&&$correo!=null&&$mensaje!=null&&$estado!=null)
{
	$data=array($nombre,$rut,$telefono,$correo,$mensaje);
	return controlCorreos::insertCorreos($data,$estado);
}
?>
