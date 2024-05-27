<?php

class Contacts extends ModelBase
{
	/**
	 * получить картинку
	 */
	public function getPhoto($size = null)
	{
		$photo = json_decode($this->photo, true);
		if (!empty($photo))
			return !empty($photo[0]['sizes'][$size]) ? $photo[0]['sizes'][$size] : $photo[0]['path'];
		return '';
	}
}
