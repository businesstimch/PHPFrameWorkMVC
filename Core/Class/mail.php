<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DocumentPath__."Core/Module/phpmailer/Exception.php";
require __DocumentPath__."Core/Module/phpmailer/PHPMailer.php";
require __DocumentPath__."Core/Module/phpmailer/SMTP.php";


class mail extends GGoRok
{
	function sendGMail($Data)
	{
		
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $Data['From'];
		//Password to use for SMTP authentication
		$mail->Password = $Data['Password'];
		//Set who the message is to be sent from
		$mail->setFrom($Data['From'], $Data['FromName']);
		//Set an alternative reply-to address
		$mail->addReplyTo($Data['From'], $Data['FromName']);
		//Set who the message is to be sent to
		$mail->addAddress($Data['To']);
		//Set the subject line
		$mail->Subject = $Data['Subject'];
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($Data['Body_HTML']);
		//Replace the plain text body with one created manually
		$mail->AltBody = (isset($Data['Body_Plain']) ? $Data['Body_Plain'] : "");
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			echo "Message sent!";
		}
		
		
	}
	
}
?>