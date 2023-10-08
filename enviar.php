<?php


require ("class.phpmailer.php");
require ("class.smtp.php");

$email_to = "contacto@casafran.com.ar";
$email_subject = "Consulta sobre alojamiento";
$email_from = $_POST['email']  ;

$nombre = $_POST[nombre];

$email_message = "Detalles del formulario de contacto:\n\n";
$email_message .= "Nombre: " .$_POST['Nombre'] . "\n";
$email_message .= "Email: " .$_POST['email'] . "\n";
$email_message .= "Consulta: " .$_POST['consulta'] . "\n";



// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c1572373.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "contacto@casafran.com.ar";  // Mi cuenta de correo
$smtpClave = "0yLmG*m0lE";  // Mi contraseña


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email_from; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($email_to); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = $email_subject; // Este es el titulo del email.
$mensajeHtml = nl2br($email_message);
$mail->Body = "{$mensajeHtml} <br /><br />Contacto desde CASAFRAN.COM.AR<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Formulario de contacto desde casafran.com.ar"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    header("Location: index.php");
} else {
    echo "Ocurrió un error inesperado.";
}




?>

