<?php
	// Include database file
 	include_once('../db.php');

	// Save newsletter subscriber to database

	// Validate POST Data
	function checkSet($value) {
		if (isset($value)) {
			return htmlspecialchars($value);
		} else {
			$value = "";
			return $value;
		}
	}

	$subscriber = "";

	if (isset($_POST['email'])) {
		$subscriber = checkSet($_POST['email']);
	}
	
	if ($subscriber != "") {
		// Prepare PDO statement
		$sql = "INSERT INTO newsletter(email) VALUES(?)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$subscriber]);
	}
	
?>