<?php

class Authors extends ModelBase
{
	public function getAvatar()
	{
		if (empty($this->avatar)) return '';
		$avatar = json_decode($this->avatar, true);
		return $avatar[0]['sizes']['small'];
	}
}
