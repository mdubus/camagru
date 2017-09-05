function	do_plus()
{
	width[i - 1] += width[i - 1] * 10 / 100;
	height[i - 1] += height[i - 1] * 10 / 100;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}


function	do_less()
{
	width[i - 1] -= width[i - 1] * 10 / 100;
	height[i - 1] -= height[i - 1] * 10 / 100;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_left()
{
	x[i - 1] -= 10;
	x[i - 1] -= 10;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_right()
{
	x[i - 1] += 10;
	x[i - 1] += 10;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_top()
{
	y[i - 1] -= 10;
	y[i - 1] -= 10;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_bot()
{
	y[i - 1] += 10;
	y[i - 1] += 10;
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.restore();
	for (var j = 0; j < i; j++)
	{
		context_filters.drawImage(saved[j], x[j], y[j], width[j], height[j]);
	}
}

function	do_reset()
{
	reset_buttons();
	context_filters.clearRect(0, 0, 400, 300);
	context_filters.save();
	var snap = document.getElementById('snap');
	snap.removeAttribute("onclick");
	snap.style.backgroundColor = "#FFA69E";
	snap.style.borderColor = "#FF686B";
	for (var j = 0; j < i; j++)
	{
		delete saved[j];
	}
	i = 0;
	var move = document.getElementById('move');
	move.style.display = 'none';
}
