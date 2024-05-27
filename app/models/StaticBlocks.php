<?php

class StaticBlocks extends ModelBase
{
	public function getContent()
	{
		return $this->content ? json_decode($this->content, true)['blocks'] : [];
	}

	public function getImagePath($size = null)
	{
		if (empty($this->image)) return '';
		$imageData = json_decode($this->image, true)[0];

		return empty($size) ? $imageData['path'] : $imageData['sizes'][$size];
	}
}
