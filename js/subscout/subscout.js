/* SubScout Newsletter Subscriber Capture*/

function subscout(event) {
	event.preventDefault();

	// Validate Fields
	$('#nquireForm').trigger('validate.fndtn.abide');

	$formData = $("#subscout");

	$formData.validate({
		errorClass: "invalid",
		validClass: "valid"
	});

	if ($formData.valid() == true){
		$("#ss-loading").show();

		$.ajax({
			method: "POST",
			url: "inc/subscout/subscout",
			data: $formData.serialize(),
			success: function(data) {
				$("#ss-loading").hide();
				$(".sleek-form").addClass("send");
				$(".sleek-thanks").addClass("activate");
			},
			error: function(data) {
				$("#subscout").html("Sorry: something went wrong!<br/>" + data.status + "<br/>" +  data.statusText);
				$("#ss-loading").hide();
			}
		});
	}
}