function ageSubmit(){
	event.preventDefault();
	var $gate = document.getElementById("agegate");
	var $age = document.getElementById("age").value;
	var $content = document.getElementById("ag-content");

	if ($age <= 2000) {
		alert("You're old enough");
		$content.classList.remove("age-blur");
		$gate.classList.add("hide");
	} else if ($age > 2000) {
		alert("You're too young");
	} else {
		alert("You're something else");
	}
}

function loadAgeGate() {
	$form = "<form>";
	$form += "<input type=\"tel\" id=\"age\" class=\"ageInput\" maxlength=\"4\" placeholder=\"YYYY\">";
	$form += "<button class=\"ageSubmit\" onclick=\"ageSubmit(event)\">Submit</button>";
	$form += "</form>";


	document.body.insertAdjacentHTML('beforebegin',
    '<div class=\"agegate-bg\" id=\"agegate\"><div class=\"agegate\"><h2>Are you 18 or over?</h2><p>You must be 18 years old or older in order to use this website.</p><p>Please enter your year of birth below:</p>' + $form + '</div></div>');
}

//Initialize
//loadAgeGate();