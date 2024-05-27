<?php

class ApplicationController extends ControllerBase
{
	public function indexAction()
	{
		$ua = $_SERVER['HTTP_USER_AGENT'];

		if (preg_match('/iPhone|iPad|iPod|Macintosh/', $ua))
			$this->response->redirect('https://apps.apple.com/us/app/prospect-%D1%81%D0%B5%D0%B2%D0%B5%D1%80%D0%BD%D1%8B%D0%B9-%D0%BA%D0%B0%D0%B2%D0%BA%D0%B0%D0%B7/id1528231734');
		else
			$this->response->redirect('https://play.google.com/store/apps/details?id=com.prospect.sk');
	}
}
