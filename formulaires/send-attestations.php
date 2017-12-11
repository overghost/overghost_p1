<?php
require('phpmailer/class.phpmailer.php'); 
$errors = array();
$destinataire = 'attestations@cnldb.be';

if(!isset($_POST['nom'])|| $_POST['nom'] == ''){
    $errors['nom'] = "Vous n'avez pas renseigné votre nom";
}

if(!isset($_POST['prenom'])|| $_POST['prenom'] == ''){
    $errors['prenom'] = "Vous n'avez pas renseigné votre prénom";
}

if(!isset($_POST['debut'])|| $_POST['debut'] == ''){
    $errors['debut'] = "Vous n'avez pas renseigné de date de début";
}

if(!isset($_POST['fin'])|| $_POST['fin'] == ''){
    $errors['fin'] = "Vous n'avez pas renseigné de date de fin";
}

/*if (isset($_FILES['pj']) AND $_FILES['pj']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['pj']['size'] <= 1000000)
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['pj']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['pj']['tmp_name'], 'uploads/' . basename($_FILES['pj']['name']));
                        echo "L'envoi a bien été effectué !";
                }
        }
}*/

session_start();

if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    $_SESSION['inputs'] = $_POST;
    header('Location: absences.php');
}else{
    $_SESSION['success'] = 1;
	$texte=str_replace(array("\r\n","\n"),'<br>',htmlspecialchars($_POST['commentaires']));	    

	/**
	* This example shows making an SMTP connection with authentication.
	*/
	//SMTP needs accurate times, and the PHP time zone MUST be set
	//This should be done in your php.ini, but this is how to do it if you don't have access to that
	// date_default_timezone_set('Etc/UTC');
	require 'phpmailer/PHPMailerAutoload.php';
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = "smtp.office365.com";
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 587;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication
	$mail->Username = "absences@cnldb.be";
	//Password to use for SMTP authentication
	$mail->Password = "MOVI83seb";
	//Set who the message is to be sent from
	$mail->setFrom('absences@cnldb.be', 'First Last');
	//Set an alternative reply-to address
	$mail->addReplyTo('absences@cnldb.be', 'First Last');
	//Set who the message is to be sent to
	$mail->addAddress('absences@cnldb.be', 'John Doe');
	//Set the subject line
	$mail->Subject = $_POST['nom'] . ' ' . $_POST['prenom'] . ' a signalé(e) son absence';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML('
	<html>
	<head></head>
	<body>
		<div>
			<b>Nom : </b>'.htmlspecialchars($_POST['nom']).'<br />
			<b>Prénom : </b>'.htmlspecialchars($_POST['prenom']).'<br />
			<b>Implantation(s) </b>:'. htmlspecialchars($_POST['bruxelles']) . '     ' . htmlspecialchars($_POST['jodoigne']).'<br />
			<b>Date de début de l\'absence : </b>'.htmlspecialchars($_POST['debut']).'<br />
			<b>jusqu\'au : </b>'.htmlspecialchars($_POST['fin']).'<br />
			<b>Commentaires : </b>'.$texte.'<br /><br />
		</div>
		
		
		<div>
			<table style="border:1px solid black;border-collapse:collapse;">
				<thead>
					<tr>
						<th width="200px" style="border:1px solid black;border-collapse:collapse;">NOM</th>
						<th width="200px" style="border:1px solid black;border-collapse:collapse;">Prénom</th>
						<th width="200px" style="border:1px solid black;border-collapse:collapse;">Implantation</th>
						<th width="200px" style="border:1px solid black;border-collapse:collapse;">Début absence</th>
						<th width="200px" style="border:1px solid black;border-collapse:collapse;">Jusqu\'au (inclus)</th>
						<th width="800px" style="border:1px solid black;border-collapse:collapse;">Commentaires</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($_POST['nom']).'</td>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($_POST['prenom']).'</td>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($_POST['bruxelles']).'   '.$_POST['jodoigne'].'</td>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($_POST['debut']).'</td>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($_POST['fin']).'</td>
						<td style="border:1px solid black;border-collapse:collapse;">'.htmlspecialchars($texte).'</td>
					</tr>
				</tbody>
			</table>
		</div>
	</body>
	</html>
	');
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
	}
    header('Location: absences.php');
}
