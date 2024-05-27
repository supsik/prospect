<?php

$db = mysqli_connect('mysql', 'root', '4VBRg75zA8');
$db_selected = mysqli_select_db($db, 'prospect-web');
echo "<pre>".htmlentities(print_r($db_selected, true))."</pre>";exit();
$resData = mysqli_query($db, 'SELECT id, image, big_img FROM posts');
$result = [];
while($res = mysqli_fetch_assoc($resData))
{
	echo "<pre>".htmlentities(print_r($res, true))."</pre>";exit();
	foreach($res as $key => $value)
	{
		if($key == 'id')
			continue;
		else
		{
			if(!empty(json_decode($res[$key], true)))
			{
				foreach(json_decode($res[$key], true)[0] as $key => $value)
				{

				}
			}
		}
	}
}exit();
