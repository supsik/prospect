<?php 

class Posts extends ModelBase
{
	public $categoryTitles = [
		'news'          => 'Новости',
		'interview'     => 'Интервью',
		'person'        => 'Персона',
		'photoprojects' => 'Фотопроекты',
	];

	public function initialize()
	{
		$this->hasMany('id', 'PostGalleries', 'post_id', [
			'alias' => 'galleryInfo'
		]);
		$this->hasOne('post_author', 'Authors', 'id', [
			'alias' => 'author'
		]);
	}
	public function getUrl()
	{
		return "/article/{$this->post_name}/";
	}

	public function getBigImagePath($size = null)
	{
		if(!empty($this->big_img) && $this->is_wide == '1')
		{
			$imageData = json_decode($this->big_img, true)[0];
			return empty($size) ? $imageData['path'] : $imageData['sizes'][$size];
		}
	}

	public function getImagePath($size = null)
	{
		if (empty($this->image)) return '';
		$imageData = json_decode($this->image, true)[0];

		return empty($size) ? $imageData['path'] : $imageData['sizes'][$size];
	}

	public function getCategoryName()
	{
		return $this->categoryTitles[$this->category] ?? '';
	}

	public function getPublicDate()
	{
		$monthes = [
			1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
			5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
			9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
		];
		return $monthes[(date('n'))] . date(' Y');
	}

	public function getGallery()
	{
		$result = [];
		if (empty($this->galleryInfo)) return null;
		foreach ($this->galleryInfo as $gallery)
			$result[] = $gallery->getContent();

		return $result;
	}

	public function toArray($columns = NULL)
	{
		$result = parent::toArray();
		$result['imagePath']    = $this->getImagePath();
		$result['url']          = $this->getUrl();
		$result['categoryName'] = $this->getCategoryName();

		return $result;
	}
}
