<?php

namespace Element\Hooks;

class PostsHooks extends HooksBase
{
	private $convertable = ['image', 'big_img'];
	public function afterUpdateHook($request, $result)
	{
		if (!isset($request['converted']))
		{
			$element = $this->getElement($request['set']['id']);
			$set     = $this->buildNewJson($element, $request['set']['is_wide']);
			$updateElementResult = $this->updateElement($set, $request['where']);
		}
		return $result;
	}

	public function afterInsertHook($request, $result)
	{
		if($result)
		{
			if (!isset($request['converted']))
			{
				$id      = $this->getDi()->get('eldb')->getLastInsertId();
				$element = $this->getElement($id);
				$set     = $this->buildNewJson($element, $request['values'][0]['is_wide']);
				$where   = [
					'operation' => 'AND',
					'fields'    => [[
						'code'      => 'id',
						'operation' => 'IS',
						'value'     => $id
					]]
				];

				$this->updateElement($set, $where);
			}
		}

	}

	private function updateElement($set, $where)
	{
		return $this->getDi()->get('element')->update([
			'converted' => true,
			'table'     => 'posts',
			'set'       => $set,
			'where'     => $where
		]);
	}

	private function buildNewJson($element, $widePost = 0)
	{
		$set = [];
		foreach($this->convertable as $field)
		{
			if(!empty($element['result']['items'][0][$field]))
				$set[$field] = $this->processField($element['result']['items'][0][$field], $widePost);
		}

		return $set;
	}

	private function processField($data, $widePost)
	{
		if(empty($data))
			return json_encode($data);

		foreach($data as $imageKey => $image)
		{
			$webpPath = $this->generateWebp($image['localPath'], $widePost);

			if($webpPath)
			{
				if(array_key_exists('path', $data[$imageKey]))
					$data[$imageKey]['path'] = $webpPath;

				if(array_key_exists('upName', $data[$imageKey]))
					$data[$imageKey]['upName'] = $this->setWebpExt($image['upName']);

				if(array_key_exists('localPath', $data[$imageKey]))
					$data[$imageKey]['localPath'] = $this->setWebpExt($image['localPath']);
			}

			if(!empty($data[$imageKey]['sizes']))
			{
				foreach($image['sizes'] as $sizeKey => $size)
				{
					if(is_array($image['sizes'][$sizeKey]))
						$image['sizes'][$sizeKey] = $image['sizes'][$sizeKey]['localPath'];
					$webpPath = $this->generateWebp($image['sizes'][$sizeKey], $widePost);

					if($webpPath)
					{
						$data[$imageKey]['sizes'][$sizeKey] = $webpPath;
					}
				}
			}
		}

		return json_encode($data);
	}

	private function generateWebp($path, $widePost = 0)
	{
		$newName = $path;

		if(!preg_match('/\.resize.webp$/i', $path) && !$widePost)
			$newName = $this->createScaleImg($path);

		if($widePost && preg_match('/\.resize.webp|.webp$/i', $path))
		{
			$oldPath = str_replace(['.resize.webp', '.webp'], '.jpeg', $path);
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $oldPath))
				$newName = $oldPath;

			$oldPath = str_replace(['.resize.webp', '.webp'], '.png', $path);
			if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $oldPath))
				$newName = $oldPath;
		}

		$absPath = $_SERVER['DOCUMENT_ROOT'] . $newName;
		$webpPath = $this->setWebpExt($newName);
		$webpAbsPath = $_SERVER['DOCUMENT_ROOT'] . $webpPath;

		if(!file_exists($absPath))
			return false;

		$execPath = $_SERVER['DOCUMENT_ROOT'] . '/element/cwebp';
		exec("{$execPath} {$absPath} -o {$webpAbsPath} -q 80");

		return $webpPath;
	}

	private function setWebpExt($path)
	{
		return preg_replace(['/(.*)\.[^.]+/'], '$1.webp', $path);
	}

	private function createScaleImg($path)
	{
		$newName = $path;

		if(preg_match('/\.jpeg|.jpg$/i', $path))
		{
			$image  = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'] . $path);
			$newImgSize = imagescale( $image, 650);
			$newName = preg_replace(['/(.*)\.[^.]+/'], '$1.resize.jpeg', $path);
			imagejpeg($newImgSize, $_SERVER['DOCUMENT_ROOT'] . '/' .$newName);
		}
		else if(preg_match('/\.png$/i', $path))
		{
			$image  = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $path);
			$newImgSize = imagescale( $image, 650);
			$newName = preg_replace(['/(.*)\.[^.]+/'], '$1.resize.png', $path);
			imagepng($newImgSize, $_SERVER['DOCUMENT_ROOT'] . '/' .$newName);
		}
		else if(preg_match('/\.webp$/i', $path))
		{
			$image  = imagecreatefromwebp($_SERVER['DOCUMENT_ROOT'] . $path);
			$newImgSize = imagescale( $image, 650);
			$newName = preg_replace(['/(.*)\.[^.]+/'], '$1.resize.webp', $path);
			imagepng($newImgSize, $_SERVER['DOCUMENT_ROOT'] . '/' .$newName);
		}

		return $newName;
	}

	private function getElement($id)
	{
		return $this->getDi()->get('element')->select([
			'from' => 'posts',
			'where' => [
				'operation' => "AND",
				'fields' => [[
					'code' => 'id',
					'operation' => 'IS',
					'value' => $id
				]]
			],
		]);
	}
}
