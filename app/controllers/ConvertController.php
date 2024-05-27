<?php
use Phalcon\Mvc\Controller;
use Phalcon\Image\Factory;
use Phalcon\Image\Adapter\Gd;
class ConvertController extends Controller
{
	public function indexAction()
	{
		$posts = Posts::find();

		foreach($posts as $key => $post)
		{
			$data = json_decode($posts[$key]->image, true);
			$posts[$key]->image = json_encode($this->createWebpImg($data));

			// $posts[$key]->save();
		}

	}
	private function createWebpImg($path)
	{
		if(empty($path))
			return $path;

		$newName = $path[0]['path'];
		if(!preg_match('/\.resize.webp|.webp$/i', $path[0]['path']))
			$newName = $this->createScaleImg($path[0]['path']);

		$absPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $newName;
		$webpPath = $this->setWebpExt($newName);
		$webpAbsPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $webpPath;

		if(!file_exists($absPath))
			return false;

		$execPath = $_SERVER['DOCUMENT_ROOT'] . '/element/cwebp';
		exec("{$execPath} {$absPath} -o {$webpAbsPath} -q 80");
		$path[0]['path'] = $webpPath;

		return $path;
	}

	private function setWebpExt($path)
	{
		return preg_replace(['/(.*)\.[^.]+/'], '$1.webp', $path);
	}

	private function createScaleImg($path)
	{
		$newName = $path;

		if(!empty($path) && preg_match('/\.jpeg|.jpg$/i', $path))
		{
			$image  = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'] . $path);
			$newImgSize = imagescale( $image, 650);
			$newName = preg_replace(['/(.*)\.[^.]+/'], '$1.resize.jpeg', $path);
			imagejpeg($newImgSize, $_SERVER['DOCUMENT_ROOT'] . '/' .$newName);
		}
		else if(!empty($path) && preg_match('/\.png$/i', $path))
		{
			$image  = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $path);
			$newImgSize = imagescale( $image, 650);
			$newName = preg_replace(['/(.*)\.[^.]+/'], '$1.resize.png', $path);
			imagepng($newImgSize, $_SERVER['DOCUMENT_ROOT'] . '/' .$newName);
		}

		return $newName;
	}
}
