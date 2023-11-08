<?php 
	// Sets canonical links site wide
	$canonical = basename($_SERVER['PHP_SELF'], '.php'); /* Returns The Current PHP File Name */
	if ($canonical === "index") { 
		echo '<link rel="canonical" href="'. $website. '/">';
	} else {
		echo '<link rel="canonical" href="'. $website. '/'. $canonical .'">';
	}
?>