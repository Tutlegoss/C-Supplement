const evtSource = new EventSource("receiveMsg.php");

evtSource.onmessage = function(event)
{
	// Load received message in page
	var newDiv = "<div class='chatMsg'>" + event.data + "</div>";
	var msgList = document.getElementById("msgList");
	msgList.innerHTML += newDiv;
	window.scrollTo(0,document.body.scrollHeight); // Scroll to end of page
}

window.onload = init;

function init()
{
	var sendButton = document.getElementById("send");
	sendButton.onclick = sendMsg;
/*
	// This will click the submit button when the user hits enter, credit to kdenney from stackoverflow:
	// https://stackoverflow.com/questions/155188/trigger-a-button-click-with-javascript-on-the-enter-key-in-a-text-box
	document.getElementById("msgBox")
		.addEventListener("keyup", function(event) {
		event.preventDefault();
		if (event.keyCode === 13) {
			if (event.shiftKey) {
				document.getElementById("br").innerHTML = " ";
			}
			else {
				document.getElementById("send").click();
			}
		}
	});
*/
	window.scrollTo(0,document.body.scrollHeight); // Scroll to end of page (so user is at most recent message)
}

function sendMsg() {
	// Send message to server via AJAX request
	var msg = encodeURIComponent(document.getElementById("msgBox").value); // Get and encode message
	document.getElementById("msgBox").value = ""; // Clear message box
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() { // Get full message from server
		if (this.readyState == 4 && this.status == 200) {
			// Load sent message in page
			var newDiv = "<div class='chatMsg'>" + this.responseText + "</div>";
			var msgList = document.getElementById("msgList");
			msgList.innerHTML += newDiv;
			window.scrollTo(0,document.body.scrollHeight); // Scroll to end of page
		}
	};
	request.open("GET", "sendMsg.php?text=" + msg);
	request.setRequestHeader("Content-Type", "text/plain;chatset=UTF-8");
	request.send();
}
