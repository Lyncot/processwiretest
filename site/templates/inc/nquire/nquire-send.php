<?php
	
	// Include global variables
	include('../company.php');
	include('../global.php');
	require('../mailer/smtp-mailer.php');
	require('../mailer/mailer-backup.php');

	// Validate POST Data
	function checkSet($value) {
		if (isset($value)) {
			return htmlspecialchars($value);
		} else {
			$value = "";
			return $value;
		}
	}

	// Enquiry Email
	function enquiryEmail($formData, $honeypot) {
		// Build the body of the email
		// Body inline styling
		$tr = "style=\"width: 100%;\"";
		$trblue = "style=\"background-color: #1eb1ed; color: #fff; font-size: 1.5rem; padding: 30px;\"";
		$h1 = "style=\"font-weight: 300; margin: 0px; padding: 10px 0px; line-height: 1rem; font-size: 40px; text-align: center; text-transform: uppercase; letter-spacing: 2px;\"";
		$h2 = "style=\"font-weight: 100; text-align: center; text-transform: uppercase; letter-spacing: 2px; font-size: 15px; margin-bottom: 20px;\"";
		$tdc = "style=\"padding: 10px; width: 260px;\"";
		$tdc100 = "style=\"padding: 5px; width: 260px; text-align: left;\"";
		$header = "style=\"font-weight: 200; padding-bottom: 10px; border-bottom: 1px solid #555;\"";

		$ehtml = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
		$ehtml .= "<html xmlns=\"http://www.w3.org/1999/xhtml\" style=\"font-family: Arial, Helvetica, sans-serif;\">";
		$ehtml .= "<body style=\"background-color: #eee;\">";
		$ehtml .= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse; background-color: #fff;\">";
		$ehtml .= "<tr>";
		$ehtml .= "<td bgcolor=\"#ffffff\" style=\"padding: 5px 25px;\">";
		$ehtml .= "<h1 $h1>Website Enquiry</h1>";
		$ehtml .= "<h2 $h2>Your website has received an enquiry</h2>";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "<tr>";
		$ehtml .= "<td>";
		$ehtml .= "<table style=\"width: 100%\">";

		// Customer Details
		$ehtml .= "<tr><td colspan=\"2\" $tdc><h2 $header>Customer Details:</h2></td></tr>";
		// Loop through form data and output results
		foreach ($formData as $key => $val) {
			$ehtml .= "<tr><td $tdc>$key</td><td $tdc>$val</td></tr>";
		}

		$ehtml .= "</table>";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "</table>";

		$ehtml .= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse;\">";
		$ehtml .= "<tr>";
		$ehtml .= "<td style=\"text-align: center; font-size: 14px; color: #555555; font-weight: 200; padding-top: 20px;\">";
		$ehtml .= "Copyright &#9400; " . date("Y") . " " . $GLOBALS['companyName'] . " Ltd";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "</table>";


		$ehtml .= "</body>";
		$ehtml .= "</html>";

		// Check Honeypot and then send email
		if ($honeypot == false) {
			// Override the email details here
			$smtpDeets = [
				"subject" => "SPAM: You've received an email enquiry",
				"to" => $GLOBALS['email_to'],
				"from" => $GLOBALS['email_from'],
				"companyName" => $GLOBALS['companyName'],
				"cc" => "",
				"bcc" => ""
			];

			mailBackup($formData);
			smtpMailer($ehtml, $smtpDeets);
			
		} else {
			// Override the email details here
			$smtpDeets = [
				"subject" => "You've received an email enquiry",
				"to" => $GLOBALS['email_to'],
				"from" => $GLOBALS['email_from'],
				"companyName" => $GLOBALS['companyName'],
				"cc" => "",
				"bcc" => ""
			];

			mailBackup($formData);
			smtpMailer($ehtml, $smtpDeets);
		}

	}

	// Customer Confirmation Email
	function confirmEmail($formData, $honeypot) {
		// Body inline styling
		$tr = "style=\"width: 100%;\"";
		$trblue = "style=\"background-color: #1eb1ed; color: #fff; font-size: 1.5rem; padding: 30px;\"";
		$tdc = "style=\"padding: 5px; width: 260px;\"";
		$tdc100 = "style=\"padding: 5px; width: 260px; text-align: left;\"";
		$dlbtn = "style=\"display: block; margin: 10px 5px; padding: 10px 20px; font-size: 18px; border: 1px solid #999; border-radius: 5px; text-decoration: none; color: #555; text-align: center;\"";
		$eread = "style=\"font-size: 18px; color: #333;\"";

		$ehtml = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
		$ehtml .= "<html xmlns=\"http://www.w3.org/1999/xhtml\" style=\"font-family: Arial, Helvetica, sans-serif;\">";
		$ehtml .= "<body style=\"background-color: #eee;\">";
		$ehtml .= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse; background-color: #fff;\">";
		$ehtml .= "<tr>";
		$ehtml .= "<td bgcolor=\"#ffffff\" style=\"padding: 5px 25px;\">";
		$ehtml .= "<img src=\"" . $GLOBALS['website'] . "/img/logo.png\" alt=\"" . $GLOBALS['companyName']. "\" title=\"" . $GLOBALS['companyName']. "\" height=\"51\" width=\"350\" />";
		$ehtml .= "<h1 style=\"margin: 0; padding: 0;\">Website Enquiry</h1>";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "<tr>";
		$ehtml .= "<td>";
		$ehtml .= "<table style=\"width: 100%\">";

		$ehtml .= "<tr><td style=\"padding: 5px 25px;\">";
		$ehtml .= "<h2 style=\"font-size: 20px;\">Your enquiry has been received</h2>";
		$ehtml .= "<p $eread>Thanks, we've received your enquiry and a member of our team will get back you within 24-48 hours.</p>";
		$ehtml .= "</td></tr>";
		$ehtml .= "</table>";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "</table>";

		$ehtml .= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse;\">";
		$ehtml .= "<tr>";
		$ehtml .= "<td style=\"text-align: center; font-size: 14px; color: #555555; font-weight: 200; padding-top: 20px;\">";
		$ehtml .= "Copyright &#9400; " . date("Y") . " " . $GLOBALS['companyName'] . " Ltd";
		$ehtml .= "</td>";
		$ehtml .= "</tr>";
		$ehtml .= "</table>";

		$ehtml .= "</body>";
		$ehtml .= "</html>";

		// Override the email details here
		$smtpDeets = [
			"subject" => "Thanks for your enquiry",
			"to" => $formData['Email'],
			"from" => $GLOBALS['email_from'],
			"companyName" => $GLOBALS['companyName'],
			"cc" => "",
			"bcc" => ""
		];

		// Check Honeypot and then send email
		if ($honeypot == false) {

			smtpMailer($ehtml, $smtpDeets);
			//@mail($GLOBALS['$email_to'], 'SPAM: ' . $email_subject, $ehtml, implode("\r\n", $headers)) or die("Error!");
		} else {
			smtpMailer($ehtml, $smtpDeets);
			//@mail($formData['Email'], $email_subject, $ehtml, implode("\r\n", $headers)) or die("Error!");
		}
	}

	// Declare variables
	$honeypot = "";

	// Loop through form data and add to array
	$formData = array();

	foreach ($_POST as $key => $val) {
		// Exclude honeypot value
		if ($key == "honeypot") {
			// Test Honeypot
			if ($val != '') {
				$honeypot = false;
			} else {
				$honeypot = true;
			}
		} else if ($key == "token") {
			$token = $val;
		} else if ($key == "action") {

		} else {
			// Capitalize Key
			$key = ucfirst($key);

			$val = checkSet($val);

			// Add to array
			$formData[$key] = $val;
		}
	}

	// Run Google reCatcha v3 Check
	$captchaScore = grecaptcha($token);

	if(($captchaScore["success"] == '1') && ($captchaScore["score"] >= 0.5)) {
		// Send enquiry email to business
		enquiryEmail($formData, $honeypot);

		// Send confirmation email to customer
		confirmEmail($formData, $honeypot);
	} else {

	}
?>