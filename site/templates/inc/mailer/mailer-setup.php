<?php 
// DELETE THIS FILE AFTER USE

function pdoDatabase() {
    //Database details
    $username = $GLOBALS['eb_username'];
    $password = $GLOBALS['eb_password'];
    $database = $GLOBALS['eb_database'];
    $ipaddress = $GLOBALS['eb_ipaddress'];

    // PDO Specific
    $dsn = "mysql:host=" . $ipaddress . ";dbname=" . $database;

    // Create a PDO instance
    $pdo = new PDO($dsn ,$username ,$password);

  	// Set default object
  	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    return $pdo;
}

function createBUTable() {
	$pdo = pdoDatabase();
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->prepare("CREATE TABLE `mailbackup` (`id` int(0) NOT NULL AUTO_INCREMENT PRIMARY KEY, `email` text NOT NULL, `enquiry` longtext NOT NULL, `date` date NOT NULL)");
	$stmt->execute();
}

function createSpamTable() {
    $pdo = pdoDatabase();
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("CREATE TABLE `spamfails` (`id` int(0) NOT NULL AUTO_INCREMENT PRIMARY KEY, `email` text NOT NULL, `enquiry` longtext NOT NULL, `date` date NOT NULL)");
    $stmt->execute();
}

createBUTable();

// Deletes itself when used
unlink(__FILE__);

?>