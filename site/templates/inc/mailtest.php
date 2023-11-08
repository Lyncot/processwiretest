<?php

	$email_to = "paul@lyncot.co.uk";
	$email_subject = "Testing Email";
	$email_from = "website@alpha-marketing.co.uk";

	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=iso-8859-1';

	// Additional headers
	$headers[] = 'To: ' . $email_to;
	$headers[] = 'From: Mail Tester <' . $email_from . '>';

	$ehtml = "Test";

	@mail($email_to, $email_subject, $ehtml, implode("\r\n", $headers)) or die("Error!");

?>