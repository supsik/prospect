<?php

class TestController extends ControllerBase
{
	public function indexAction()
	{
		echo "<pre>";
		print_r(2);
		echo "</pre>";
		exit();
		$posts = Posts::findByCategory('photoprojects');
		foreach ($posts as $post)
		{
			$blocks = json_decode($post->post_content, true);
			if (empty($blocks)) continue;
			$blocks = $blocks['blocks'];
			foreach ($blocks as $block)
			{
				if ($block['type'] !== 'image') continue;

				$url = str_replace('element/', '', $block['data']['file']['url']);

				$res = rename(ROOT.$url, ROOT.$block['data']['file']['url']);
				echo "<pre>";
				print_r([$res, $block['data']['file']['url']]);
				echo "</pre>";
			}
		}
	}
	public function getFromWpContentPhotoproject($post)
	{
		$blocks = [];
		$content = $post->test;
		preg_match_all('/^(.*)/m', $content, $contentArr);
		$contentArr = $contentArr[0];

		foreach ($contentArr as $contentItem)
		{
			$blockItem = [ 'data' => [ 'text' => ''], 'type' => '' ];
			if (preg_match('/<span/', $contentItem))
			{
				if (preg_match('/<img/', $contentItem))
				{
					$blocks[] = $this->getImageBlock($contentItem);
					$contentItem = preg_replace('/(<img.*?>)/', '', $contentItem);
				}

				preg_match('/<span.*?>(.*?)<\/span/', $contentItem, $text);
				$blockItem['type'] = 'paragraph';
				$blockItem['data']['text'] = $text[1] ?? '';
				$blockItem['data']['text'] = preg_replace(['/strong/m', '/<em>/m', '/<\/em>/m', '/<span.*?>/', '/<\/span>/'], ['b', '<i>', '</i>', '', ''], $blockItem['data']['text']);
			}
			else if (preg_match('/\[spb_image/', $contentItem))
			{
				preg_match('/\[spb_image image="(.*?)"/', $contentItem, $id);
				$id = $id[1];
				$image = WpPosts::findFirst($id);
				$blockItem = $this->getImageBlock(null, $image->guid);
			}
			else continue;

			$blocks[] = $blockItem;
		}
		// echo "<pre>";
		// print_r($blocks);
		// echo "</pre>";
		// exit();

		$time = round(microtime(true) * 1000);
		$result = [
			'version' => '2.19.1',
			'time'    => $time,
			'blocks'  => $blocks,
		];
		$post->test = json_encode($result, JSON_UNESCAPED_UNICODE);
		$post->save();
	}
	public function getFromWpContent($post)
	{
		$blocks = [];
		$content = $post->test;
		preg_match_all('/^(.*)/m', $content, $contentArr);
		$contentArr = $contentArr[0];

		foreach ($contentArr as $contentItem)
		{
			$blockItem = [ 'data' => [ 'text' => ''], 'type' => '' ];

			if (preg_match('/<h1/', $contentItem))
			{
				preg_match('/<strong>(.*?)<\/strong>/', $contentItem, $text);
				$blockItem['type'] = 'header';
				$blockItem['level'] = 2;
				$blockItem['data']['text'] = $text[1] ?? '';
			}
			else if (preg_match('/<span/', $contentItem))
			{
				if (preg_match('/<img/', $contentItem))
				{
					$blocks[] = $this->getImageBlock($contentItem);
					$contentItem = preg_replace('/(<img.*?>)/', '', $contentItem);
				}

				preg_match('/<span.*?>(.*?)<\/span/', $contentItem, $text);
				$blockItem['type'] = 'paragraph';
				$blockItem['data']['text'] = $text[1] ?? '';
				$blockItem['data']['text'] = preg_replace(['/strong/m', '/<em>/m', '/<\/em>/m', '/<span.*?>/', '/<\/span>/'], ['b', '<i>', '</i>', '', ''], $blockItem['data']['text']);
			}
			else if (preg_match('/<img/', $contentItem))
				$blockItem = $this->getImageBlock($contentItem);
			else if (empty($contentItem))
				$blockItem['type'] = 'paragraph';
			else continue;
			$blocks[] = $blockItem;
		}
		echo "<pre>";
		print_r($blockItem);
		echo "</pre>";
		exit();
		$time = round(microtime(true) * 1000);
		$result = [
			'version' => '2.19.1',
			'time'    => $time,
			'blocks'  => $blocks,
		];
		// $post->test = json_encode($result, JSON_UNESCAPED_UNICODE);
		// $post->save();
	}
	public function uploadImage($url)
	{
		$savedPath = ROOT.'/public/upload/';
		preg_match('/[^\/]*$/', $url, $fileName);
		$fileName = $fileName[0];
		$fileName = preg_replace('/\.[a-zA-Z]*$/', '', $fileName);
		preg_match('/\.[a-zA-Z]*$/', $url, $extension);
		$extension = $extension[0];

		$newName = md5($fileName . time()) . $extension;
		// $newName = $fileName . $extension;
		$file = file_put_contents($savedPath.$newName, file_get_contents($url));

		return '/element/public/upload/'.$newName;
	}

	public function getImageBlock($html, $src = null)
	{
		$blockItem = [];

		if (empty($src))
		{
			preg_match('/src="(.*?)"/', $html, $url);
			$url = $url[1] ?? '';
		}
		else
			$url = $src;

		$newUrl = $this->uploadImage($url);
		$blockItem['data'] = [
			'caption' => '',
			'file' => [ 'url' => $newUrl ],
			'stretched' => 'false',
			'withBackground' => 'false',
			'withBorder' => 'false',
		];
		$blockItem['type'] = 'image';
		return $blockItem;
	}
	/*
		foreach (Posts::find() as $post) {
			if (!empty($post->image))
			{
				$post->image = json_encode(json_decode($post->image, true), JSON_UNESCAPED_SLASHES);
				$post->save();
			}
		}
		foreach (Posts::find() as $post) {
			if (empty($post->image) || preg_match('/upName/', $post->image)) continue;

			$ch = curl_init('http://prospect-web.dev3.odva.pro/element/api/field/em_file/index/upload/');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
				'tableCode'  => 'posts',
				'fieldCode'  => 'image',
				'typeUpload' => 'link',
				'link'       => $post->image,
			]));
			$res = curl_exec($ch);
			$result = json_decode($res, true);
			curl_close($ch);

			if (!$result['success'])
			{
				echo "<pre>";
				print_r([$post->id, $res]);
				echo "</pre>";
				continue;
			}

			$update = [
				'table' => 'posts',
				'set' => [
					'image' => $result['value'],
				],
				'where' => [
					'operation' => 'AND',
					'fields' => [
						[
							'code' => 'id',
							'operation' => 'IS',
							'value' => $post->id,
						],
					],
				],
			];
			$ch = curl_init('http://prospect-web.dev3.odva.pro/element/api/el/update/');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
				'update'  => $update,
			]));
			$result = json_decode(curl_exec($ch), true);
		}
	*/
}
