<?php

class Journals extends ModelBase
{
	public function getImagePath($size = 'main')
	{
		$imageArr = json_decode($this->image,true);
		if(empty($imageArr))
			return false;
		if(empty($imageArr[0]['sizes'][$size]))
			return false;
		return $imageArr[0]['sizes'][$size];
	}

	public function getPublicDate()
	{
		$monthes = [
			1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
			5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
			9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
		];

		return $monthes[(date('n', strtotime($this->date)))] . ' ' .date('Y', strtotime($this->date));
	}
}
