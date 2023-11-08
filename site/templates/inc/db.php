<?php
function pdoDatabase() {
	//Database details
	$username="root";
	$password="TimmieJ";
	$database="nub";
	$ipaddress="192.168.1.26:3307";

	// PDO Specific
	$dsn = "mysql:host=" . $ipaddress . ";dbname=" . $database;

	// Create a PDO instance
	$pdo = new PDO($dsn ,$username ,$password);

		// Set default object
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	return $pdo;
}

$pdo = pdoDatabase();
?>