function increment_like(this_element){
	var nb_like = document.getElementById('compteur').innerHTML;
	nb_like++;
	this_element.removeAttribute ('onmouseover');
	this_element.removeAttribute ('onmouseout');
	this_element.removeAttribute ('onclick');
	this_element.setAttribute ('title', 'Tu aimes déjà cette image !');
	document.getElementById('compteur').innerHTML = nb_like;
	this_element.src = "../../img/paw-grey.png";
	var fd = new FormData(document.forms["form_photo"]);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'update_nb_like_photo.php', true);
	xhr.send(fd);
}
