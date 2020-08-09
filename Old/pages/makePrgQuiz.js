var outputIndex = 1;
var outputDiv = document.getElementById("outputList");

var tipIndex = 1;
var tipDiv = document.getElementById("tipList");

window.onload = init;

function init()
{
	var addOutputBtn = document.getElementById("addOutput");
	addOutputBtn.onclick = addOutput;

	var addTipBtn = document.getElementById("addTip");
	addTipBtn.onclick = addTip;
}

function addOutput()
{
	outputIndex++;

	var inputId = "input" + outputIndex;
	var label = document.createElement("label");
	label.for = inputId;
	label.innerHTML = "Input " + outputIndex + ': ';
	var input = document.createElement("input");
	input.type = "text";
	input.id = inputId;
	input.name = inputId;
	outputDiv.appendChild(document.createElement("br"));
	outputDiv.appendChild(document.createElement("br"));
	outputDiv.appendChild(label);
	outputDiv.appendChild(input);

	var p = document.createElement("p");
	p.innerHTML = "Output " + outputIndex;
	var ta = document.createElement("textarea");
	ta.name = "output" + outputIndex;
	ta.cols = 50;
	ta.rows = 3;
	outputDiv.appendChild(document.createElement("br"));
	outputDiv.appendChild(document.createElement("br"));
	outputDiv.appendChild(p);
	outputDiv.appendChild(ta);
}

function addTip()
{
	tipIndex++;

	var p = document.createElement("p");
	p.innerHTML = "Tip " + tipIndex;
	var ta = document.createElement("textarea");
	ta.name = "tip" + tipIndex;
	ta.cols = 50;
	ta.rows = 3;
	tipDiv.appendChild(document.createElement("br"));
	tipDiv.appendChild(document.createElement("br"));
	tipDiv.appendChild(p);
	tipDiv.appendChild(ta);
}
