<?php
session_start(); 
$nom=$_POST['nom']; 
$mail=$_POST['mail']; 
$objet=$_POST['sujet']; 
$message=$_POST['message']; 

$headers = "MIME-Version: 1.0\r\n"; 

$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n"; 

$headers .= "From: $nom <$mail>\r\nReply-to : $nom <$mail>\nX-Mailer:PHP"; 

$subject="$objet"; 
$destinataire="mathack_74@hotmail.fr"; //remplacez "webmaster@votre-site.com" par votre adresse e-mail
$body="$message";
if($nom!="" && $mail!="" && $objet!="" && $message!="") 
{
	$_SESSION["mail_message_error"] = "Une erreur s'est produite dans envoye du mail"; 
	header('Location:../?page=contact');
}
if (mail($destinataire,$subject,$body,$headers)) { 
	$_SESSION["mail_message_ok"] = "Votre mail a bien été envoyé";
	header('Location:../?page=contact');

} 
else { 
	$_SESSION["mail_message_error"] = "Une erreur s'est produite dans envoye du mail"; 
	header('Location:../?page=contact');
} 


?>
