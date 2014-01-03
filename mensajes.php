
<?php


//SMTP needs accurate times, and the PHP time zone MUST be set


//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');


require_once 'src/classes/class.phpmailer.php';


require_once 'src/classes/controlCorreos.class.php';

//Create a new PHPMailer instance

$mail = new PHPMailer();



//Tell PHPMailer to use SMTP

$mail->IsSMTP();


//Enable SMTP debugging

// 0 = off (for production use)

// 1 = client messages

// 2 = client and server messages

//$mail->SMTPDebug  = 2;


//Ask for HTML-friendly debug output

//$mail->Debugoutput = 'html';


$mail->Mailer = "smtp";

//Set the hostname of the mail server

$mail->Host       = "ssl://smtp.gmail.com";


//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission

$mail->Port       = 465;



//Whether to use SMTP authentication

$mail->SMTPAuth   = true;


//Username to use for SMTP authentication - use full email address for gmail

$mail->Username   = "ddmallplaza@gmail.com";


//Password to use for SMTP authentication

$mail->Password   = "jolding159753";


//Set who the message is to be sent from

$mail->SetFrom("ddmallplaza@gmail.com");


//Set an alternative reply-to address

$mail->AddReplyTo("jotarola@gmail.com");


//Set who the message is to be sent to

$mail->AddAddress("supervisorescontactcenter@mallplaza.cl");
$mail->AddBCC("marcela.leiva@mallplaza.cl");
$mail->AddBCC("jonatan.burgos@mallplaza.cl");
$mail->AddBCC("juan.martinez@mallplaza.cl");
$mail->AddBCC("Joshua.ruminot@mallplaza.cl");
$mail->AddBCC("jotarola@gmail.com");






//Set the subject line

$mail->Subject = "Envio de Mensajes";


$mail->Body = "Contacto Mall Plaza Egaña";







$correos=controlCorreos::getCorreos('0');

if(count($correos)>0)
{

	$mail->Body = "Los siguientes mensajes fueron emitidos desde Mall Plaza Egaña, estos son:\n\n";
	foreach($correos as $result)
	{
			$mail->Body.="Tipo de mensaje: ".$result['tipoCorreo']."\nNombre: ".$result['nombre']."\nRUT: ".$result['rut']."\nTelefono: ".$result['telefono']."\nCorreo: ".$result['correoDestino']."\nMensaje: ".$result['cuerpoMensaje']."\n\n\n";
	}

//Send the message, check for errors

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {

foreach($correos as $enviados)
		{
			controlCorreos::cambiarEstadoCorreos($enviados['idCorreo']);	
		}



echo "Enviados!";

}
	
	
}






?>
