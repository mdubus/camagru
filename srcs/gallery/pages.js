function	next_page()
{
	var current = document.getElementById('current_page').innerHTML.replace('page ', '');
	location.href="gallery.php?page="+(parseInt(current, 10)+1);
}

function	previous_page()
{
	var current = document.getElementById('current_page').innerHTML.replace('page ', '');
	location.href="gallery.php?page="+(parseInt(current, 10)-1);
}
