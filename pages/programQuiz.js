window.onload = init;

function init()
{
	var sendButton = document.getElementById("send");
	sendButton.onclick = sendProgram;
}

function sendProgram()
{
	var result = document.getElementById("result");
	result.innerHTML = "Compiling...";
	window.scrollTo(0,document.body.scrollHeight); 

	// Send AJAX request to compile program, print result
	var text = encodeURIComponent(document.getElementById("textBox").innerText);
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			result.innerHTML = this.responseText;
		}
	};
	request.open("GET", "programQuiz/sendProgram.php?" + window.location.search.substr(1) + "&text=" + text);
	request.setRequestHeader("Content-Type", "text/x-c;chatset=UTF-8");
	request.send();
}
