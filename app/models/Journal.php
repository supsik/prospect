<?php

class journal extends ModelBase
{
	public function getImage()
	{
		$image = json_decode($this->image)[0]->path;
		return $image;
	}
}
