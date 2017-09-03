var img = document.getElementsByClassName('hidden_path');
var filter = document.getElementsByClassName('image_filter');
for (i = 0; i < 5; i++)
{
	filter[i].src = img[i].src;
	filter[i].id = img[i].id;
}
var j = 0;
function	to_bot()
{
	j++;
	if (j >= img.length)
	{
		j = 0;
	}
	var k = j;
	var l = 0;
	while (l < 5)
	{
		if (k <= 0)
		{
			k = img.length + j;
		}
		if (k >= img.length)
		{
			k = 0;
		}
		filter[l].src = img[k].src;
		filter[l].id = img[k].id;
		l++;
		k++;

	}
}

function	to_top()
{
	j--;
	if (j <= -(img.length + 1))
	{
		j = -1;
	}

	var k = j;
	var l = 0;
	while (l < 5)
	{
		if (k <= 0)
		{
			k = img.length + j;
		}
		if (k >= img.length)
		{
			k = 0;
		}
		filter[l].src = img[k].src;
		filter[l].id = img[k].id;
		l++;
		k++;

	}
}
