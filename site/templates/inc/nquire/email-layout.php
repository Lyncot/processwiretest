<?php 

// Include global variables
include('../company.php');

function test($formData) {
	// Build the body of the email
	// Body inline styling
	$tr = "style=\"width: 100%; border: 1px solid #ccc;\"";
	$trblue = "style=\"background-color: #1eb1ed; color: #fff; font-size: 1.5rem; padding: 30px;\"";
	$h1 = "style=\"font-weight: 300; margin: 0px; padding: 10px 0px; line-height: 1rem; font-size: 40px; text-align: center; text-transform: uppercase; letter-spacing: 2px;\"";
	$h2 = "style=\"font-weight: 100; text-align: center; text-transform: uppercase; letter-spacing: 2px; font-size: 15px; margin-bottom: 20px;\"";
	$tdc = "style=\"padding: 10px; width: 260px;\"";
	$tdc100 = "style=\"padding: 5px; width: 260px; text-align: left;\"";
	$header = "style=\"font-weight: 200; padding-bottom: 10px; border-bottom: 1px solid #555;\"";

	$ehtml = "<html style=\"font-family: Arial, Helvetica, sans-serif;\">";
	$ehtml .= "<body style=\"background-color: #eee;\">";
	$ehtml .= "<div style=\"background-color: #fff; width: 600px; margin-left: auto; margin-right: auto; padding: 20px;\">";
	$ehtml .= "<h1 $h1>Website Enquiry</h1>";
	$ehtml .= "<h2 $h2>Your website has received an enquiry</h2>";
	$ehtml .= "<table style=\"width: 100%\">";

	// Customer Details
	$ehtml .= "<tr><td colspan=\"2\" $tdc><h2 $header>Customer Details:</h2></td></tr>";
	// Loop through form data and output results
	foreach ($formData as $key => $val) {
		$ehtml .= "<tr $tr><td $tdc>$key</td><td $tdc>$val</td></tr>";
	}

	$ehtml .= "</table>";
	$ehtml .= "</div>";

	// Email Footer
	$ehtml .= "<div style=\"width: 600px; margin-left: auto; margin-right: auto; padding: 10px; text-align: center; font-size: 14px; color: #555555; font-weight: 200;\">";
	$ehtml .= "Copyright &#9400; " . date("Y") . " " . $GLOBALS['companyName'] . " Ltd";
	$ehtml .= "<br/>Powered by Alpha Marketing Seed.";
	$ehtml .= "</div>";

	$ehtml .= "</body>";
	$ehtml .= "</html>";

	echo $ehtml;
}

$formData = (object) [
	"Name" => "Test Customer",
	"Email" => "paul@lyncot.co.uk",
	"Phone" => "6346346436",
	"Postcode" => "LU7 4SD",
	"Message" => "Test"
];

// Test Layout
test($formData);

?>