
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
var video = document.getElementById('video');

function send_image()
{

	var canvasURL = canvas.toDataURL('image/png');
	document.getElementById('hidden_data').value = canvasURL;
	var fd = new FormData(document.forms["form1"]);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'save_data.php', true);
	xhr.send(fd);
	return (canvasURL);
}

function	disable_buttons(){
	document.getElementById('canvas').style.display = "initial";
	document.getElementById('video').style.display = "none";
	document.getElementById('reset').style.display = "initial";
	document.getElementById('snap').style.display = "none";
	document.getElementById('save').style.display = "initial";
	context.drawImage(video, 0, 0, 400, 300);
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
	var image_URL = send_image();
	document.getElementById("photos").innerHTML += "<div class='photo'><img src='"+image_URL+"'></div>";
}

var	reset = document.getElementById('reset');
reset.onclick = reset_buttons;

var	save = document.getElementById('save');
save.onclick = do_when_saving;

document.getElementById("snap").addEventListener("click", disable_buttons);
