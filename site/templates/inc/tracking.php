<?php 
	// Google Analytics Tracking

	if ($google_analytics_id != "") {
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_id; ?>"></script>
<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  // Google Default Consent
		gtag('consent', 'default', {
			'ad_storage': 'denied',
			'analytics_storage': 'denied'
		});

	  gtag('config', '<?php echo $google_analytics_id; ?>');
	  <?php if ($google_ua_id != "") { ?>
		gtag('config', '<?php echo $google_ua_id; ?>');
  <?php } ?>
</script>

<?php } ?>

<script>
	var $trackingTag = {
		action: "<?= $gtag_action ?>",
		category: "<?= $gtag_category ?>",
		label: "<?= $gtag_label ?>",
		value: "<?= $gtag_value ?>"
	};
</script>

<?php // Google reCAPTCHA v3 ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $grcap_site_key; ?>"></script>

<script>
	function reCapture() {
		grecaptcha.ready(function() {
			grecaptcha.execute('<?php echo $grcap_site_key; ?>', {action: 'submit'}).then(function(token) {
				$('#nquireForm').prepend('<input type="hidden" name="token" value="' + token + '">');
        $('#nquireForm').prepend('<input type="hidden" name="action" value="submit">');
        $('#nquireForm').unbind('submit').submit();
			});
		});
	}
</script>