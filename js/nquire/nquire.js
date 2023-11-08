// Submit the form using AJAX
function nquire(event, $google_analytics_id) {
	event.preventDefault();
	$('#nquireForm').trigger('validate.fndtn.abide');

	// Run Google reCAPTCHA v3
	reCapture();

	$formData = $("#nquireForm");

	$formData.validate({
		errorClass: "invalid",
		validClass: "valid"
	});

	if ($formData.valid() == true){
		$("#qe-loading").css("display", "flex");

		$.ajax({
			method: "POST",
			url: "inc/nquire/nquire-send",
			data: $formData.serialize(),
			success: function(data) {
				$("#nquireForm").html("<div class=\"row\"><div class=\"column small-12\"><i class=\"fal fa-comment-check\"></i><h4>Thank you for your enquiry</h4><p>Your enquiry has been received.</p><p>We will review your requirements and respond as soon as possible.</p></div></div>" + data);
				// Error reporting -> $("#dev-errors").html(data);
				//console.log(data);

				$("#qe-loading").css("display", "none");
			},
			error: function(data) {
				$("#nquireForm").html("Sorry: something went wrong!<br/>" + data.status + "<br/>" +  data.statusText);
				$("#qe-loading").css("display", "none");
			}
		});
	}

	if ($google_analytics_id != "") {
		// Analytics Conversion Tracking
		gtag('event', $trackingTag.action, {'event_category': $trackingTag.category, 'event_label': $trackingTag.label, 'value': $trackingTag.value});
	}

}