<?php
require_once 'src/classes/controlCorreos.class.php';

if (isset ($_GET['nom']))$nombre=$_GET['nom'];else $nombre=null;
if (isset ($_GET['rut']))$rut=$_GET['rut'];else $rut=null;
if (isset ($_GET['tel']))$telefono=$_GET['tel'];else $telefono=null;
if (isset ($_GET['correo']))$correo=$_GET['correo'];else $correo=null;
if (isset ($_GET['mensaje']))$mensaje=$_GET['mensaje'];else $mensaje=null;
if (isset ($_GET['tipo']))$tipo=$_GET['tipo'];else $tipo=null;
if (isset ($_GET['facebook']))$face=$_GET['facebook'];else $face=null;


$from_name = "Mall Plaza Alameda";
$from_email = "mensajes.mallplaza@gmail.com";
$headers = "From: $from_name <$from_email>";

if($face==null)
{
  $subject = "Correo desde Mall Plaza Alameda ($tipo)";
  $body = "El siguiente mensaje fue enviado desde el totem T1 en Mall Plaza Alameda con el siguiente mensaje:\n
	   Tipo de Mensaje: $tipo \n
	   Nombre: $nombre \n
	   RUT: $rut\n
	   Telefono: $telefono\n
	   Correo: $correo\n
	   Mensaje: $mensaje\n\n\n
	   Gracias";

  
  $to = "callcenter@fidelis.cl,ropazo@fidelis.cl,juan.martinez@mallplaza.cl";
}
else
{
  $subject = "Hazte amigo de Mall Plaza en Facebook!";
  $body = "Haz click en el siguiente enlace para hacerte amigo de Mall Plaza\n
	   \n
	   http://www.facebook.com/mallplaza
	   \n\n
	   
	   Gracias";

  $to = $face;
}
if (($nombre!=null&&$rut!=null&&$telefono!=null&&$correo!=null&&$mensaje!=null)||($face!=null&&strstr($face,'@')!=false))
{
    if (mail($to, $subject, $body, $headers)) 
    {
	echo "success!";
    } 
    else 
    {
	echo "fail…";
    }
    echo controlCorreos::insertCorreos($data,$estado);
}

?>
