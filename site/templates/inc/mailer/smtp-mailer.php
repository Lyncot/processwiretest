<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/SMTP.php';
	
	// SMTP Mailer
	function smtpMailer($htmlBody, $smtpDeets) {
		//PHPMailer Object
		$mail = new PHPMailer(true);

		//SMTP Config
		$mail->SMTPDebug = 3;
		$mail->isSMTP();
		$mail->Host = 'mail.smtp2go.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'test@alpha-marketing.co.uk';
		$mail->Password = 'vRLrvrBPHizdQmOL';
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		$mail->CharSet = "UTF-8";
		$mail->Debugoutput = function($str, $level) {
		   error_log($str, 3, __DIR__ . '/mailererror.log');
		};

		/* Disable some SSL checks. */
	   	$mail->SMTPOptions = array(
		     'ssl' => array(
		     'verify_peer' => false,
		     'verify_peer_name' => false,
		     'allow_self_signed' => true
		    )
		);

		//From email address and name
		$mail->From = $smtpDeets['from'];
		$mail->FromName = $smtpDeets['companyName'];

		//To address and name
		//$mail->addAddress("paul@lyncot.co.uk", "Paul Nicholls");
		$mail->addAddress($smtpDeets['to']);

		//Address to which recipient will reply
		$mail->addReplyTo($smtpDeets['from'], $smtpDeets['companyName']);

		//CC and BCC
		if (!empty($smtpDeets['cc'])) {
			$mail->addCC($smtpDeets['cc']);
		}

		if (!empty($smtpDeets['bcc'])) {
			$mail->addBCC($smtpDeets['bcc']);
		}

		//Send HTML or Plain Text email
		$mail->isHTML(true);

		$mail->Subject = $smtpDeets['subject'];
		$mail->Body = $htmlBody;
		$mail->AltBody = "This is the plain text version of the email content";

		try {
		    $mail->send();
		    echo "Message has been sent successfully";
		} catch (Exception $e) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
?>