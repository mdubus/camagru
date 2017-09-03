function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.src);
}

var saved = new Array;
var width = new Array;
var height = new Array;
var x = new Array;
var y = new Array;
var canva_filters = document.getElementById("canva_filters");
var context_filters = canva_filters.getContext("2d");
var i = 0;

function getMousePos(canvas, evt) {
	var rect = canvas.getBoundingClientRect();
	return {
		x: (evt.clientX - rect.left) / (rect.right - rect.left) * canvas.width,
		y: (evt.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height
	};
}


function drop(ev) {
	if (ev.target.nodeName != "IMG")
	{
		ev.preventDefault();
		var data = ev.dataTransfer.getData("text");
		var node = document.createElement("img");
		node.src = data;
		width[i] = node.width/2;
		height[i] = node.height/2;
		var pos = getMousePos(canva_filters, ev);
		x[i] = pos.x;
		y[i] = pos.y;
		context_filters.drawImage(node, x[i], y[i], width[i], height[i]);
		context_filters.save();
		saved[i] = node;
		i++;
	}
	var buttons = document.getElementById('move');
	buttons.style.display = "flex";

	var snap = document.getElementById("snap");
	snap.setAttribute("onclick", "disable_buttons()");

	snap.style.backgroundColor = "#FF686B";
	snap.style.borderColor = "#EE575A";
}


// FF686B
// EE575A
// button{
// 	background-color: #FFA69E;
// 	color:white;
// 	font-weight: bold;
// 	font-size:1.5vw;
// 	font-family: 'Open Sans', sans-serif;
// 	padding: 5px;
// 	border:2px solid #FF686B;
