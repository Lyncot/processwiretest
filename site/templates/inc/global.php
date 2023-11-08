<!-- Global - Dev Environment  -->

<?php
	if (php_uname('s') === "Windows NT") {
		$path = basename(dirname(__DIR__, 3));
	} else {
		$path = '~' . get_current_user() . '/' . basename(dirname(__DIR__, 3));
	}

	$baseUrl = "/$path/";
	$website = $path;
 
 	include(dirname(__FILE__) . '/settings.php');

 	echo $font;
?>
