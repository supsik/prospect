<?php

class CodexToHtml
{

	private $templates = [];
	private $beautify = false;

	function __construct($templates = false, $beautify = false)
	{
		$this->templates = [
			'raw' => function($info) {
				return $info['html'];
			},
			'header' => function($info) {
				$level = $info['level'];
				$text = $info['text'];
				return "<h{$level}>{$text}</h{$level}>";
			},
			'paragraph' => function($info) {
				$text = $info['text'];
				return "<p>{$text}</p>";
			},
			'image' => function($info) {
				$caption = $info['caption'];
				$src = $info['file']['url'];
				$stretched = json_decode($info['stretched']);

				if($stretched)
				{
					return "
					</div>
					<div class='crystal__litle-img' style='background-image: url({$src})'></div>
					<div class='container crystal__container crystal__info'>
					";
				}
				else
				{
					return"
					<figure>
					<img class='zero__img' src=\"{$src}\" title=\"{$caption}\" alt=\"{$caption}\">
					<figcaption>{$caption}</figcaption>
					</figure>
					";
				}

			},
			'list' => function($info) {
				$list = $info['items'];
				$output = "<ul>";
				foreach($list as $block)
				{
					$output .= "<li>{$block['content']}</li>";
				}
				$output .= "</ul>";
				return $output;
			},
			'quote' => function($info){
				$quote = $info['text'];
				$author = $info['caption'];
				return "
				<div class='news__absolute'>
				<span class='news__text'>{$quote}</span>
				<div class='news__border'></div>
				<span class='news__note'>{$author}</span>
				</div>
				";
			},
		];

		if($templates !== false)
			$this->templates = $templates;
		$this->beautify = $beautify;
	}

	public function render($blocks)
	{
		$result = [];

		foreach ($blocks as $block)
		{
			if (array_key_exists($block['type'], $this->templates))
			{
				$template = $this->templates[$block['type']];
				$result[] = call_user_func($template, $block['data']);
			}
		}

		$html = implode($result);

		return $html;
	}

}