var video = document.getElementById('video');


if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
		video.src = window.URL.createObjectURL(stream);
		video.play();
	});
}
else if(navigator.getUserMedia) { // Standard
	navigator.getUserMedia({ video: true }, function(stream) {
		video.src = stream;
		video.play();
	}, errBack);
} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
	navigator.webkitGetUserMedia({ video: true }, function(stream){
		video.src = window.webkitURL.createObjectURL(stream);
		video.play();
	}, errBack);
} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
	navigator.mozGetUserMedia({ video: true }, function(stream){
		video.src = window.URL.createObjectURL(stream);
		video.play();
	}, errBack);
}

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

var canvas2 = document.getElementById('canva_filters');
var context2 = canvas2.getContext('2d');

var video = document.getElementById('video');
var imageuploaded = document.getElementById('uploaded_file');

var canvasURL;
var canvasURL2;

function send_image()
{
	canvasURL = canvas.toDataURL('image/png');
	document.getElementById('hidden_data').value = canvasURL;

	canvasURL2 = canvas2.toDataURL('image/png');
	document.getElementById('hidden_data2').value = canvasURL2;

	var fd = new FormData(document.forms["form1"]);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'save_data.php', true);
	xhr.send(fd);
}

function	disable_buttons(){
	document.getElementById('canvas').style.display = "initial";
	document.getElementById('video').style.display = "none";
	document.getElementById('reset').style.display = "initial";
	document.getElementById('snap').style.display = "none";
	document.getElementById('save').style.display = "initial";
	if (imageuploaded)
	{
		var image = new Image();
		image.src = imageuploaded.src;
		context.drawImage(image, 0, 0, 400, 300);
	}
	else {
		context.drawImage(video, 0, 0, 400, 300);
	}
}

function	reset_buttons(){
	document.getElementById('video').style.display = "initial";
	document.getElementById('canvas').style.display = "none";
	document.getElementById('reset').style.display = "none";
	document.getElementById('snap').style.display = "initial";
	document.getElementById('save').style.display = "none";
}

function	do_when_saving(){
	reset_buttons();
	send_image();

	context.drawImage(canvas2, 0, 0);
	var image = canvas.toDataURL('image/png');
	document.getElementById("photos").innerHTML += "<div class='photo'><img src='"+image+"'></div>";
	// var snap = document.getElementById('snap');
	// snap.removeAttribute("onclick");
	// snap.style.backgroundColor = "#FFA69E";
	// snap.style.borderColor = "#FF686B";
}

var	reset = document.getElementById('reset');
reset.onclick = reset_buttons;

var	save = document.getElementById('save');
save.onclick = do_when_saving;

window.onload = function()
{
	if (imageuploaded)
	{
		var image = new Image();
		image.src = imageuploaded.src;
		context.drawImage(image, 0, 0, 400, 300);
		context.save;
	}

}

// document.getElementById("snap").addEventListener("click", disable_buttons);
