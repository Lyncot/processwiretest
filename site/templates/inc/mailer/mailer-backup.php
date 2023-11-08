<?php
	// Backup Enquiries to Database
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

	function mailBackup($formData) {
		$pdo = pdoDatabase();
		//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$formString = "";

		// Create form data string
		foreach ($formData as $key => $val) {
			$formString .= $key . ": " . $val . ", ";
		}

		$stmt = $pdo->prepare("INSERT INTO mailbackup (`email`, `enquiry`, `date`) VALUES (?,?,?)");
		$stmt->execute([$formData['Email'], $formString, date('Y-m-d')]);

		//print_r($pdo->errorInfo());
	}

	// Delete all data older than 6 months
	function gdprCleanse() {
		$pdo = pdoDatabase();

		$stmt = $pdo->prepare("DELETE FROM mailbackup WHERE `date` < '2020-07-10';");
		$stmt->execute();
	}
?>