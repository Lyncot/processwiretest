// Development Tools

// Insert development output box
$box = "<div class=\"dev-box\">";
$box += "<h3>Developer Box:</h3>";
$box += "<div class=\"dev-output\"></div>";
$box += "</div>";

$("body").prepend($box);


// Insert error output box

$errorbox = "<div class=\"dev-errors\" id=\"dev-errors\">";
$errorbox += "</div>";

$("body").prepend($errorbox);