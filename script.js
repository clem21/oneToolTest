document.getElementById("myForm").addEventListener("submit",function(evt) {
	var response = grecaptcha.getResponse();
	if(response.length == 0) {
		alert("You have to tick the box");
		evt.preventDefault();
		return false;
	}
});
