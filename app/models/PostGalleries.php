<?php

class PostGalleries extends ModelBase
{
	public function getContent()
	{
		return [
			'images'      => $this->getImages(),
			'description' => $this->getDescription(),
		];
	}

	public function getImages()
	{
		$images = json_decode($this->images, true);
		if (empty($images)) return [];

		return array_column($images, 'path');
	}

	public function getDescription()
	{
		$blocks = json_decode($this->description, true);
		$blocks = empty($blocks) ? [] : $blocks['blocks'];
		return $blocks;
	}
}
