<script src="<?php echo $baseUrl; ?>node_modules/jquery/dist/jquery.js"></script>
<script src="<?php echo $baseUrl; ?>js/vendor/jquery/jqueryui/jquery-ui.js"></script>
<script src="<?php echo $baseUrl ?>js/vendor/jquery/unveil/jquery.unveil.js"></script>
<script src="<?php echo $baseUrl; ?>node_modules/jquery-validation/dist/jquery.validate.js"></script>
<script src="<?php echo $baseUrl; ?>js/vendor/jquery/equalize/equalize.js"></script>
<script src="<?php echo $baseUrl; ?>js/nquire/nquire.js"></script>
<script src="<?php echo $baseUrl; ?>js/subscout/subscout.js"></script>
<script src="<?php echo $baseUrl; ?>js/legal/cookielaw.js"></script>

<?php /* <script src="<?php echo $baseUrl; ?>js/legal/agegate.js"></script> */ ?>

<?php 
	// Load all the files in js/aop
	// $appJs = glob("../js/app/*.js");

	// foreach($appJs as $js) {
	// 	echo "<script src=\"" . $baseUrl . str_replace("../", "", $js) . "\"></script>" . "\r\n";
	// }
?>

<script src="<?php echo $baseUrl; ?>js/app/accordion.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/tabs.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/headerScroll.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/nav.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/reveal.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/scrollAnimate.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/scrollProg.js"></script>
<script src="<?php echo $baseUrl; ?>js/app/trackynav.js"></script>

<script src="<?php echo $baseUrl; ?>js/vendor/slick/slick.js"></script>
<script src="<?php echo $baseUrl; ?>js/vendor/slick/elements/slideshow.js"></script>	
<script src="<?php echo $baseUrl; ?>js/vendor/slick/elements/carousel.js"></script>

<?php 
	// Include development Javascript
	/*
	<script src="<?php echo $baseUrl; ?>js/dev/tools.js"></script>
	*/ 
?>

<?php
	include_once("tracking.php");
?>